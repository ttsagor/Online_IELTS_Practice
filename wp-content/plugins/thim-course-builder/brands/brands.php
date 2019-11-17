<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Thim_SC_Brands' ) ) {

	class Thim_SC_Brands {

		/**
		 * Shortcode name
		 * @var string
		 */
		protected $name = '';

		/**
		 * Shortcode description
		 * @var string
		 */
		protected $description = '';

		/**
		 * Shortcode base
		 * @var string
		 */
		protected $base = '';


		public function __construct() {

			//======================== CONFIG ========================
			$this->name        = esc_attr__( 'Thim: Brands', 'course-builder' );
			$this->description = esc_attr__( 'Display brands slider', 'course-builder' );
			$this->base        = 'brands';
			//====================== END: CONFIG =====================


			$this->map();
			add_shortcode( 'thim-' . $this->base, array( $this, 'shortcode' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
		}

		/**
		 * Load assets
		 */
		public function assets() {
			wp_register_script( 'thim-brands', THIM_CB_URL . $this->base . '/assets/js/brands-custom.js', array(
				'jquery',
				'owlcarousel'
			), '', true );
			wp_enqueue_script( 'thim-brands' );
		}

		/**
		 * vc map shortcode
		 */
		public function map() {
			vc_map( array(
				'name'        => $this->name,
				'base'        => 'thim-' . $this->base,
				'category'    => esc_html__( 'Thim Shortcodes', 'course-builder' ),
				'description' => $this->description,
				'icon'        => THIM_CB_URL . $this->base . '/assets/images/icon/sc-brands.png',
				'params'      => array(

					array(
						'type'       => 'param_group',
						'heading'    => esc_html__( 'Brands', 'course-builder' ),
						'param_name' => 'items',
						'value'      => '',
						'params'     => array(
							array(
								'type'       => 'attach_image',
								'heading'    => esc_html__( 'Brand Image', 'course-builder' ),
								'param_name' => 'brand_img',
							),
							array(
								'type'       => 'textfield',
								'heading'    => esc_html__( 'Brand Link', 'course-builder' ),
								'param_name' => 'brand_link',
							),
						)
					),

					array(
						'type'             => 'number',
						'heading'          => esc_html__( 'Visible Items', 'course-builder' ),
						'param_name'       => 'items_visible',
						'value'            => '6',
						'admin_label'      => true,
						'edit_field_class' => 'vc_col-xs-4',
					),

					array(
						'type'             => 'number',
						'heading'          => esc_html__( 'Tablet Items', 'course-builder' ),
						'param_name'       => 'items_tablet',
						'value'            => '4',
						'admin_label'      => true,
						'edit_field_class' => 'vc_col-xs-4',
					),

					array(
						'type'             => 'number',
						'heading'          => esc_html__( 'Mobile Items', 'course-builder' ),
						'param_name'       => 'items_mobile',
						'value'            => '2',
						'admin_label'      => true,
						'edit_field_class' => 'vc_col-xs-4',
					),

					array(
						'type'        => 'checkbox',
						'heading'     => esc_html__( 'Show dots navigation?', 'course-builder' ),
						'param_name'  => 'nav',
						'value'       => array(
							esc_html__( 'Yes', 'course-builder' ) => esc_attr( 'yes' ),
						),
						'admin_label' => true,
					),

					// Extra class
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => esc_html__( 'Extra class', 'course-builder' ),
						'param_name'  => 'el_class',
						'value'       => '',
						'description' => esc_html__( 'Add extra class name for Thim Brands shortcode to use in CSS customizations.', 'course-builder' ),
					),

				)
			) );
		}

		/**
		 * Add shortcode
		 *
		 * @param $atts
		 */
		public function shortcode( $atts ) {
			$params = shortcode_atts( array(
				'items'         => '',
				'items_visible' => '6',
				'items_tablet'  => '4',
				'items_mobile'  => '2',
				'nav'           => '',
				'el_class'      => '',
			), $atts );

			$params['items'] = vc_param_group_parse_atts( $params['items'] );

			ob_start();
			thim_get_template( 'default', array( 'params' => $params ), $this->base . '/tpl/' );
			$html = ob_get_contents();
			ob_end_clean();

			return $html;

		}


	}

	new Thim_SC_Brands();
}