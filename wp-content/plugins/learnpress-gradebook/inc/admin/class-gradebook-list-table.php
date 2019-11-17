<?php

/**
 * Class LP_Gradebook_List_Table
 */
class LP_Gradebook_List_Table extends WP_List_Table {

	/**
	 * @var int
	 */
	private $course_id = 0;

	/**
	 * LP_Course object
	 *
	 * @var null
	 */
	private $course = null;

	/**
	 * @var int
	 */
	private $items_count = 0;

	/**
	 * @var int
	 */
	public $rows_count = 0;

	/**
	 * @var int
	 */
	public $per_page = 5;

	/**
	 * @var null
	 */
	public $course_result_type = null;

	/**
	 * @var string
	 */
	protected $s = '';

	/**
	 * @var string
	 */
	protected $from = '';

	/**
	 * @var string
	 */
	protected $to = '';

	/**
	 * @var null
	 */
	protected $columns = null;

	/**
	 * @var int
	 */
	protected $max_columns = 3;

	protected $paged = 1;

	/**
	 * LP_Gradebook_List_Table constructor.
	 *
	 * @param array|string $args
	 */
	function __construct( $args ) {
		parent::__construct(
			array(
				'singular' => __( 'Gradebook', 'learnpress-gradebook' ),
				'plural'   => __( 'Gradebook', 'learnpress-gradebook' )
			)
		);
		$args            = wp_parse_args( $args,
			array(
				'course_id' => 0,
				's'         => '',
				'from'      => '',
				'to'        => ''
			)
		);
		$this->course_id = ! empty( $args['course_id'] ) ? $args['course_id'] : 0;
		$this->course    = LP_Course::get_course( $this->course_id );
		$this->s         = $args['s'];
		$this->from      = $args['from'];
		$this->to        = $args['to'];
		$this->per_page  = $this->get_items_per_page( 'users_per_page', $this->per_page );
		$this->paged     = learn_press_get_request( 'paged', 1 );
	}

	function column_cb( $item ) {
		return sprintf(
			'<input type="checkbox" name="bulk-delete[]" value="%s" />', $item['ID']
		);
	}

	/**
	 *
	 */
	public function get_columns() {
		if ( empty( $this->columns ) ) {
			$columns                  = array(
				'student' => __( 'Student', 'learnpress-gradebook' )
			);
			$course                   = LP_Course::get_course( $this->course_id );
			$this->course_result_type = get_post_meta( $this->course_id, '_lp_course_result', true );
			$average_title            = '';
			$items                    = array();
			switch ( $this->course_result_type ) {
				case 'evaluate_lesson':
					$items         = $course->get_items( LP_LESSON_CPT );
					$average_title = __( 'Average', 'learnpress-gradebook' );
					break;
				case 'evaluate_quizzes':
					$items         = $course->get_items( LP_QUIZ_CPT );
					$average_title = __( 'Average', 'learnpress-gradebook' );
					break;
				case 'evaluate_final_quiz':
					$items         = $course->get_items( LP_QUIZ_CPT );
					$average_title = __( 'Average (Final)', 'learnpress-gradebook' );
			}

			if ( $items ) {
				$final = $course->final_quiz;
				if ( ( $count = sizeof( $items ) ) <= $this->max_columns ) {
					foreach ( $items as $item_id ) {
						if ( $final == $item_id && get_post_type( $item_id ) == 'lp_quiz' ) {
							$columns[ $item_id ] = sprintf( '%s (%s)', get_the_title( $item_id ), __( 'Final', 'learnpress-gradebook' ) );
						} else {
							$columns[ $item_id ] = get_the_title( $item_id );
						}
					}
				}
				$this->items_count = $count;
			}
			$columns['email']      = __( 'Email', 'learnpress-gradebook' );
			$columns['start_time'] = __( 'Enrolled', 'learnpress-gradebook' );
			$columns['average']    = $average_title;
			$columns['status']     = __( 'Status', 'learnpress-gradebook' );

			$this->columns = $columns;
		}

		return $this->columns;
	}

	protected function display_tablenav( $which ) {
		?>
        <div class="tablenav  <?php echo esc_attr( $which ); ?>">

			<?php if ( $this->has_items() && ! empty( $this->_actions ) ): ?>
                <div class="alignleft actions bulkactions">
					<?php $this->bulk_actions( $which ); ?>
                </div>
			<?php endif;
			$this->extra_tablenav( $which );
			$this->pagination( $which );
			?>

            <br class="clear"/>
        </div>
		<?php
	}

	protected function extra_tablenav( $which ) {
		global $wp_query;
		if ( $which != 'top' ) {
			return;
		}

		?>
        <div class="alignleft actions">
			<?php _e( 'Student', 'learnpress-gradebook' ); ?>
            <input type="search" id="post-search-input"
                   placeholder="<?php esc_html_e( 'username, email, display name, etc...', 'learnpress-gradebook' ); ?>"
                   name="s" value="<?php _admin_search_query(); ?>" />
			<?php _e( 'From', 'learnpress-gradebook' ); ?>
            <input type="text" name="date-from" autocomplete="off" value="<?php echo learn_press_get_request( 'date-from' ); ?>"/>
			<?php _e( 'To', 'learnpress-gradebook' ); ?>
            <input type="text" name="date-to" autocomplete="off" value="<?php echo learn_press_get_request( 'date-to' ); ?>"/>
            <input type="submit" id="search-submit" class="button" value="Search student" />
            <input type="submit" id="clear-submit" class="button" value="Clear Filter" />
        </div>
		<?php
	}

	function column_default( $item, $column_name ) {
		switch ( $column_name ) {

			case 'student':
				printf(
					'<strong><a class="row-titles" href="%s">%s</a></strong>',
					learn_press_user_profile_link( $item['user']->ID ),
					! empty( $item['user']->display_name ) ? $item['user']->display_name : $item['user']->user_login
				);
//				if ( $this->items_count > $this->max_columns ) {
				$url_details = learn_press_gradebook_nonce_url(
					array(
						'course_id' => $this->course_id,
						'user_id'   => $item['user']->ID,
						's'         => $this->s,
						'date-from' => $this->from,
						'date-to'   => $this->to,
						'paged'     => $this->paged
					)
				);
				echo '<div class="row-actions">';
				echo '<span class="details"><a href="' . $url_details . '" class="gradebook-details">' . __( 'Details', 'learnpress-gradebook' ) . '</a></span>';
				echo '</div>';
//				}
				break;
			case 'email':
				echo esc_html( $item['user']->user_email );
				break;
			case 'start_time':
				$user        = learn_press_get_user( $item['user']->ID );
				$course_info = $user->get_course_data( $this->course_id );

				echo $course_info->get_start_time( get_option( 'date_format' ) );
				break;
			case 'average':
				printf( '%1.0f%%', $item['user_course_info']['result'] );
				break;
			case 'status':
				echo '<span class="lp-label lp-label-' . ( $item['user_course_info']['status'] == 'finished' ? 'completed' : 'in-progress' ) . '">';
				echo $item['user_course_info']['status'] == 'finished' ? __( 'Finished', 'learnpress-gradebook' ) : __( 'In Progress', 'learnpress-gradebook' );
				echo '</label>';
				break;
			default:
				if ( is_numeric( $column_name ) ) {
					$user        = learn_press_get_user( $item['user']->ID );
					$course_id   = LP_Request::get( 'course_id' );
					$course_data = $user->get_course_data( $course_id );
					$grade       = $course_data->get_item_result( $column_name, 'grade' );
					$citem       = $course_data->get_item( $column_name );
					if ( $status = $citem->get_status() ) {
						echo '<span class="lp-label lp-label-' . ( $status ) . '">';
						if ( $grade && $citem->get_type() == LP_QUIZ_CPT ) {
							echo $citem->get_status_label( $grade );
						} else {
							echo $citem->get_status_label();
						}
						echo '</label>';
					} else {
						echo '-';
					}
				}
		}
	}

	public function prepare_items() {
		$columns               = $this->get_columns();
		$hidden                = array();
		$sortable              = array();
		$this->_column_headers = array( $columns, $hidden, $sortable );
		$this->items           = $this->get_items();
	}

	/**
	 * Generates content for a single row of the table
	 *
	 * @since  3.1.0
	 * @access public
	 *
	 * @param object $item The current item
	 */
	public function single_row( $item ) {
		parent::single_row( $item );
		if ( ! empty( $_REQUEST['user_id'] ) && $_REQUEST['user_id'] == $item['user']->ID ) {
			$course_id = $_REQUEST['course_id'];
			$user_id   = $_REQUEST['user_id'];
			$data      = learn_press_gradebook_get_user_data( $user_id, $course_id );
			echo '<tr>';
			echo '<td colspan="' . count( $this->get_columns() ) . '">';
			$this->user_details( $data );
			echo '</td>';
			echo '</tr>';
		}
	}

	private function user_details( $datas ) {
		require LP_ADDON_GRADEBOOK_PLUGIN_PATH . '/inc/admin/views/gradebook-details.php';
	}

	private function get_items() {
		$items  = array();
		$paged  = $this->get_pagenum();
		$start  = ( $paged - 1 ) * $this->per_page;
		$course = learn_press_get_course( $this->course_id );

		$students = $this->get_students_list();
		$total    = intval( $this->get_total_students_list() );

		$this->set_pagination_args(
			array(
				'total_items' => $total,
				'per_page'    => $this->per_page
			)
		);

		for ( $i = 0, $n = count( $students ); $i < $n; $i ++ ) {
			$user             = learn_press_get_user( $students[ $i ]->ID );
			$user_course_info = $user->get_course_info( $this->course_id );

			$items[] = array(
				'user'             => $students[ $i ],
				'user_course_info' => $user_course_info,
				'user_datas'       => array()#$user_datas
			);
		}
		$this->rows_count = $course->get_users_enrolled();

		return $items;
	}

	private function get_students_list() {
		global $wpdb;
		$paged       = isset( $_GET['paged'] ) ? $_GET['paged'] : 1;
		$limit_start = ( $paged - 1 ) * $this->per_page;

		$params = array();
		$sql = "SELECT DISTINCT u.*
				FROM {$wpdb->users} u
					INNER JOIN {$wpdb->prefix}learnpress_user_items ui 
						ON ui.user_id = u.ID
				WHERE ui.item_id = %d
					AND ui.item_type = %s ";
		$params = array( 
			$this->course_id,
			LP_COURSE_CPT,
		);
		if( $this->s ) {
			$sql .= ' AND ( u.user_login LIKE %s OR u.user_email LIKE %s OR u.user_nicename LIKE %s ) ';
			$params[] = '%'.$wpdb->esc_like($this->s).'%';
			$params[] = '%'.$wpdb->esc_like($this->s).'%';
			$params[] = '%'.$wpdb->esc_like($this->s).'%';
		}
		if( $this->from ){
			$sql .= ' AND ui.start_time >= %s ';
			$params[] = $this->from;
		}
		if( $this->to ){
			$sql .= ' AND ui.start_time <= %s ';
			$params[] = $this->to;
		}
		$sql .= "
				LIMIT %d, %d";
		$params[] = $limit_start;
		$params[] = $this->per_page;
		
		$query       = $wpdb->prepare( $sql, $params );
		$students    = $wpdb->get_results( $query );
		return $students;
	}

	private function get_total_students_list() {
		$course = learn_press_get_course( $this->course_id );

		return $course->count_in_order();
	}
}