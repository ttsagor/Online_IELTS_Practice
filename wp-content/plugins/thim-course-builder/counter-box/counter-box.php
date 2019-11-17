<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Thim_SC_Counter_Box' ) ) {

	class Thim_SC_Counter_Box {

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
			$this->name        = esc_attr__( 'Thim: Counter Box', 'course-builder' );
			$this->description = esc_attr__( 'Display a counter box.', 'course-builder' );
			$this->base        = 'counter-box';
			//====================== END: CONFIG =====================


			$this->map();
			add_action( 'wp_enqueue_scripts', array( $this, 'assets' ) );
			add_shortcode( 'thim-' . $this->base, array( $this, 'shortcode' ) );
		}

		/**
		 * Load assets
		 */
		public function assets() {
			wp_register_script( 'thim-counter-box', THIM_CB_URL . $this->base . '/assets/js/counter-box.js', array(
				'jquery',
				'waypoints'
			), '', true );
			wp_enqueue_script( 'thim-counter-box' );
		}

		/**
		 * vc map shortcode
		 */
		public function map() {
			vc_map( array(
				'name'        => $this->name,
				'base'        => 'thim-' . $this->base,
				'category'    => esc_attr__( 'Thim Shortcodes', 'course-builder' ),
				'description' => $this->description,
				'icon'        => THIM_CB_URL . $this->base . '/assets/images/icon/sc-counter-box.png',
				'params'      => array(
					array(
						'type'             => 'dropdown',
						'heading'          => esc_html__( '* Counter Box Style', 'course-builder' ),
						'param_name'       => 'counter_style',
						'edit_field_class' => 'vc_col-sm-12',
						'value'            => array(
							esc_html__( 'Style 1', 'course-builder' ) => 'style-1',
							esc_html__( 'Style 2', 'course-builder' )   => 'style-2',
						),
						'admin_label'      => true,
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => esc_attr__( 'Counter Box Title', 'course-builder' ),
						'param_name'  => 'title',
						'value'       => '',
					),
					array(
						"type"             => "checkbox",
						'admin_label'      => true,
						"heading"          => esc_html__( "Show symbol separator", 'course-builder' ),
						"param_name"       => "line_counter",
						"std"              => false,
						'edit_field_class' => 'vc_col-sm-12',
					),

					array(
						'type'       => 'param_group',
						'value'      => '',
						'param_name' => 'counter_box',
						'group'      => esc_html__( 'Box Settings', 'course-builder' ),
						'params'     => array(
							array(
								"type"        => "number",
								"heading"     => esc_attr__( "* Quantity", 'course-builder' ),
								"param_name"  => "number_counter",
								"value"       => "1000",
								"description" => esc_attr__( "Enter quantity number", 'course-builder' ),
							),

							array(
								"type"             => "textfield",
								"heading"          => esc_attr__( "Currency", 'course-builder' ),
								"param_name"       => "currency_counter",
								"value"            => "",
								'edit_field_class' => 'vc_col-sm-4',
							),

							array(
								"type"             => "textfield",
								"heading"          => esc_attr__( "Unit", 'course-builder' ),
								"param_name"       => "unit",
								'edit_field_class' => 'vc_col-sm-4',
							),

							array(
								"type"             => "textfield",
								"heading"          => esc_attr__( "Box title", 'course-builder' ),
								"param_name"       => "title_counter",
								'edit_field_class' => 'vc_col-sm-4',
							),

							array(
								"type"       => "dropdown",
								"heading"    => esc_attr__( "Select type of icon", 'course-builder' ),
								"param_name" => "icon",
								"std"        => "no",
								"value"      => array(
									esc_attr__( '-- No Icon --', 'course-builder' ) => 'no',
									esc_attr__( "Font Awesome", 'course-builder' )  => "font_awesome",
									esc_attr__( "Ionicons", 'course-builder' )      => "font_ionicons",
									esc_attr__( "Upload", 'course-builder' )        => "upload_icon",
								),
							),

							// Fontawesome Picker
							array(
								"type"       => "iconpicker",
								"heading"    => esc_attr__( "Font Awesome", 'course-builder' ),
								"param_name" => "font_awesome",
								"settings"   => array(
									'emptyIcon' => true,
									'type'      => 'fontawesome',
								),
								'dependency' => array(
									'element' => 'icon',
									'value'   => array( 'font_awesome' ),
								),
							),

							// Ionicons Picker
							array(
								"type"       => "iconpicker",
								"heading"    => esc_attr__( "Ionicons", 'course-builder' ),
								"param_name" => "font_ionicons",
								"settings"   => array(
									'emptyIcon' => true,
									'type'      => 'ionicons',
								),
								'dependency' => array(
									'element' => 'icon',
									'value'   => array( 'font_ionicons' ),
								),
							),
							// Upload icon image
							array(
								"type"        => "attach_image",
								"heading"     => esc_attr__( "Upload Icon", 'course-builder' ),
								"param_name"  => "icon_upload",
								"admin_label" => true,
								"description" => esc_attr__( "Select images from media library.", 'course-builder' ),
								"dependency"  => array(
									"element" => "icon",
									"value"   => array( "upload_icon" )
								),
							),

							array(
								"type"             => "colorpicker",
								"heading"          => esc_html__( "Title color", 'course-builder' ),
								"param_name"       => "color_title",
								'edit_field_class' => 'vc_col-sm-3',
							),

							array(
								"type"             => "colorpicker",
								"heading"          => esc_html__( "Icon color", 'course-builder' ),
								"param_name"       => "color_icon",
								'edit_field_class' => 'vc_col-sm-3',
							),

							array(
								"type"             => "colorpicker",
								"heading"          => esc_html__( "Quantity color", 'course-builder' ),
								"param_name"       => "color_number",
								'edit_field_class' => 'vc_col-sm-3',
							),

							array(
								"type"             => "colorpicker",
								"heading"          => esc_html__( "Symbol separator color", 'course-builder' ),
								"param_name"       => "color_separator",
								'edit_field_class' => 'vc_col-sm-3',
							),

						)
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => esc_attr__( 'Extra class name', 'course-builder' ),
						'param_name'  => 'el_class',
						'value'       => '',
						'description' => esc_attr__( 'Add extra class name for Thim Counter Box shortcode to use in CSS customizations.', 'course-builder' ),
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
				'title'         => '',
				'line_counter'  => '',
				'counter_style' => 'style-1',
				'counter_box'   => '',
				'el_class'      => '',
			), $atts );

			$params['counter_box'] = vc_param_group_parse_atts( $params['counter_box'] );

			ob_start();

			thim_get_template( 'default', array( 'params' => $params ), $this->base . '/tpl/' );

			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		}

	}

	new Thim_SC_Counter_Box();
}