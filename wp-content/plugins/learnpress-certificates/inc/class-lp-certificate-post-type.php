<?php

/**
 * Class LP_Certificates_Post_Type
 *
 * Manage post type for certificates
 *
 * @since 3.0.0
 */
class LP_Certificates_Post_Type {

	/**
	 * @var bool|LP_Addon_Certificates
	 */
	public $factory = null;

	/**
	 * LP_Certificates_Post_Type constructor.
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'register_post_type' ), 1000 );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'edit_form_after_editor', array( $this, 'cert_editor' ) );
		add_action( 'manage_' . LP_ADDON_CERTIFICATES_CERT_CPT . '_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );
		add_action( 'manage_' . LP_COURSE_CPT . '_posts_custom_column', array( $this, 'columns_content' ), 10, 2 );

		add_filter( 'manage_edit-' . LP_COURSE_CPT . '_columns', array( $this, 'columns_head' ) );
		add_filter( 'manage_edit-' . LP_ADDON_CERTIFICATES_CERT_CPT . '_columns', array( $this, 'columns_head' ) );
		add_filter( 'post_row_actions', array( $this, 'row_actions' ), 10, 2 );
		add_filter( 'learn-press/' . LP_COURSE_CPT . '/tabs', array( $this, 'tab_certificates' ) );

		LP_Request::register_ajax( 'update-course-certificate', array( $this, 'update_course_certificate' ) );
	}

	public function update_course_certificate( $post ) {
		$course_id = LP_Request::get_int( 'course_id' );
		$cert_id   = LP_Request::get_int( 'cert_id' );

		if ( $cert_id ) {
			update_post_meta( $course_id, '_lp_cert', $cert_id );
		} else {
			delete_post_meta( $course_id, '_lp_cert' );
		}

		die();
	}

	public function tab_certificates( $tabs ) {
		$tabs['certificates'] =
			array(
				'id'       => 'course-certificates',
				'title'    => __( 'Certificates', 'learnpress-certificates' ),
				'pages'    => LP_COURSE_CPT,
				'icon'     => 'dashicons-welcome-learn-more',
				'callback' => array( $this, 'display_certificates' )
			);

		return $tabs;
	}

	public function display_certificates() {
		LP_Addon_Certificates::instance()->admin_view( 'course-certificates' );
	}

	/**
	 * Register Certificate post type
	 *
	 * @since 3.0.0
	 */
	public function register_post_type() {
		$this->factory = LP_Addon_Certificates::instance();

		register_post_type( LP_ADDON_CERTIFICATES_CERT_CPT,
			array(
				'labels'             => array(
					'name'          => __( 'Certificate', 'learnpress-certificates' ),
					'menu_name'     => __( 'Certificates', 'learnpress-certificates' ),
					'singular_name' => __( 'Certificate', 'learnpress-certificates' ),
					'add_new_item'  => __( 'Add New Certificate', 'learnpress-certificates' ),
					'edit_item'     => __( 'Edit Certificate', 'learnpress-certificates' ),
					'all_items'     => __( 'Certificates', 'learnpress-certificates' ),
				),
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => true,
				'has_archive'        => false,
				'capability_type'    => LP_COURSE_CPT,
				'map_meta_cap'       => true,
				'show_in_menu'       => 'learn_press',
				'show_in_admin_bar'  => true,
				'show_in_nav_menus'  => true,
				'supports'           => array(
					'title',
					'author'
				),
				'rewrite'            => array( 'slug' => 'certificate' )
			)
		);

		register_post_type( LP_ADDON_CERTIFICATES_USER_CERT_CPT,
			array(
				'labels'             => array(
					'name'          => __( 'User Certificate', 'learnpress-certificates' ),
					'menu_name'     => __( 'User Certificates', 'learnpress-certificates' ),
					'singular_name' => __( 'User Certificate', 'learnpress-certificates' ),
					'add_new_item'  => __( 'Add New Certificate', 'learnpress-certificates' ),
					'edit_item'     => __( 'Edit Certificate', 'learnpress-certificates' ),
					'all_items'     => __( 'User Certificates', 'learnpress-certificates' ),
				),
				'public'             => false,
				'publicly_queryable' => false,
				'show_ui'            => false,
				'has_archive'        => false,
				'capability_type'    => LP_COURSE_CPT,
				'map_meta_cap'       => true,
				'show_in_menu'       => false,
				'show_in_admin_bar'  => false,
				'show_in_nav_menus'  => false,
				'supports'           => array(
					'title',
					'author'
				),
				'rewrite'            => array( 'slug' => 'user-certificate' )
			)
		);
	}

	/**
	 * Certificates row actions.
	 *
	 * @param array   $actions
	 * @param WP_Post $post
	 *
	 * @return mixed
	 */
	public function row_actions( $actions, $post ) {
		//check for your post type
		if ( LP_ADDON_CERTIFICATES_CERT_CPT == $post->post_type ) {
			$actions['export_cert'] = sprintf( '<a href="%s">%s</a>', admin_url( 'edit.php?post_type=lp_cert&export=' . $post->ID ), __( 'Export', 'learnpress-certificates' ) );
		}

		return $actions;
	}

	/**
	 * Add column to custom post type.
	 *
	 * @param array $columns
	 *
	 * @return array
	 */
	function columns_head( $columns ) {

		switch ( get_post_type() ) {
			case LP_ADDON_CERTIFICATES_CERT_CPT:
				$columns['courses'] = __( 'Courses', 'learnpress-certificates' );
				break;
			case LP_COURSE_CPT:
				$columns['certificate'] = __( 'Certificate', 'learnpress-certificates' );

		}

		return $columns;
	}

	/**
	 * Custom column content.
	 *
	 * @param string $column
	 * @param int    $post_id
	 */
	function columns_content( $column, $post_id ) {
		global $wpdb;
		switch ( $column ) {
			case 'certificate':

				if ( get_post_type( $post_id ) == LP_ADDON_CERTIFICATES_CERT_CPT ) {
					$certificate_id = $post_id;
				} else {
					$certificate_id = get_post_meta( $post_id, '_lp_cert', true );
				}

				$certificate = new LP_Certificate( $certificate_id );

				if ( $certificate->get_id() ) {
					if ( $preview = $certificate->get_preview() ) {
						echo '<div class="course-cert-preview">';
						echo sprintf( '<a href="%s"><img src="%s" alt="%s" /></a>', get_edit_post_link( $certificate_id ), $preview, $certificate->get_name() );
						echo '</div>';
					}
				} else {
					_e( '-', 'learnpress-certificates' );
				}
				break;

			case 'courses':
				if ( get_post_type() !== LP_ADDON_CERTIFICATES_CERT_CPT ) {
					return;
				}

				$output = '';
				$query  = $wpdb->prepare( "
					SELECT p.ID, p.post_title
					FROM {$wpdb->posts} p
					INNER JOIN {$wpdb->postmeta} pm ON pm.post_id = p.ID AND pm.meta_key = %s
					INNER JOIN {$wpdb->posts} c ON c.ID = pm.meta_value AND pm.meta_key = %s
				    WHERE c.ID = %d
				", '_lp_cert', '_lp_cert', $post_id );

				if ( $courses = $wpdb->get_results( $query ) ) {
					$links = array();
					foreach ( $courses as $course ) {
						$links[] = sprintf( '<a href="%s">%s</a>', get_edit_post_link( $course->ID ), $course->post_title );
					}
					$output = join( ' | ', $links );
				}
				if ( $output ) {
					echo $output;
				} else {
					_e( 'Unassigned', 'learnpress-certificates' );
				}
		}
	}

	/**
	 * Remove unused meta boxes
	 */
	public function remove_meta_boxes() {
		remove_meta_box( 'authordiv', LP_ADDON_CERTIFICATES_CERT_CPT, 'normal' );
	}

	/**
	 * Add meta box to certificate screen
	 */
	public function add_meta_boxes() {
		$this->remove_meta_boxes();

		if ( in_array( get_post_status(), array( 'auto-draft' ) ) ) {
			return;
		}

		add_meta_box(
			'certificates-layers',
			__( 'Layers', 'learnpress-certificates' ),
			array( $this, 'layers' ),
			LP_ADDON_CERTIFICATES_CERT_CPT,
			'side'
		);
		add_meta_box(
			'certificates-options',
			__( 'Layer Options', 'learnpress-certificates' ),
			array( $this, 'layer_options' ),
			LP_ADDON_CERTIFICATES_CERT_CPT,
			'side'
		);
	}

	public function layers() {
		$this->factory->admin_view( 'box-layers' );
	}

	public function layer_options() {
		$this->factory->admin_view( 'box-layer-options' );
	}

	public function cert_editor() {
		if ( get_post_type() !== LP_ADDON_CERTIFICATES_CERT_CPT ) {
			return;
		}
		$this->factory->admin_view( 'cert-editor' );
	}
}

//
return new LP_Certificates_Post_Type();