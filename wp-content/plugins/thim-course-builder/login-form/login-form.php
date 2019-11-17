<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Thim_SC_Login_Forms' ) ) {

	class Thim_SC_Login_Form {

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
			$this->name        = esc_attr__( 'Thim: Login', 'course-builder' );
			$this->description = esc_attr__( 'Add login form.', 'course-builder' );
			$this->base        = 'login-form';
			//====================== END: CONFIG =====================


			$this->map();
			add_shortcode( 'thim-' . $this->base, array( $this, 'shortcode' ) );
		}

		/**
		 * vc map shortcode
		 */
		public function map() {
			vc_map( array(
					'name'        => $this->name,
					'base'        => 'thim-' . $this->base,
					'category'    => esc_attr__( 'Thim Shortcodes', 'course-builder' ),
					'icon'        => THIM_CB_URL . $this->base . '/assets/images/icon/sc-login-form.png',
					'description' => $this->description,
					'params'      => array(
						array(
							"type"       => "dropdown",
							"heading"    => esc_attr__( "Display", 'course-builder' ),
							"param_name" => "display",
							"value"      => array(
								esc_attr__( "Login Form", 'course-builder' )         => 'form',
								esc_attr__( "Link to Login Form", 'course-builder' ) => 'link-form',
							),
						),
						array(
							"type"       => "textfield",
							"heading"    => esc_html__( "Register Text", 'course-builder' ),
							"param_name" => "text_register",
							"value"      => 'Register',
							"dependency" => array(
								"element" => "display",
								"value"   => array( "link-form" ),
							),
						),
						array(
							"type"       => "textfield",
							"heading"    => esc_html__( "Login Text", 'course-builder' ),
							"param_name" => "text_login",
							"value"      => 'Login',
							"dependency" => array(
								"element" => "display",
								"value"   => array( "link-form" ),
							),
						),
						array(
							"type"       => "textfield",
							"heading"    => esc_html__( "Logout Text", 'course-builder' ),
							"param_name" => "text_logout",
							"value"      => 'Logout',
							"dependency" => array(
								"element" => "display",
								"value"   => array( "link-form" ),
							),
						),
						array(
							"type"       => "textfield",
							"heading"    => esc_html__( "Account Page URL", 'course-builder' ),
							"param_name" => "link",
							"std"        => get_permalink( get_page_by_path( 'account' ) ),
							"dependency" => array(
								"element" => "display",
								"value"   => array( "link-form" ),
							),
						),
						array(
							"type"       => "exploded_textarea",
							"heading"    => esc_html__( "Social Login Shortcode", 'course-builder' ),
							"param_name" => "content",
							"dependency" => array(
								"element" => "display",
								"value"   => array( "link-form" ),
							),
						),

						array(
							'type'        => 'checkbox',
							'heading'     => esc_html__( 'Enable Login Popup feature?', 'course-builder' ),
							'std'         => false,
							'param_name'  => 'popup',
							'admin_label' => true,
							"dependency"  => array(
								"element" => "display",
								"value"   => array( "link-form" ),
							),
						),

						//Hide Separator
						array(
							'type'       => 'checkbox',
							'heading'    => esc_html__( 'Display Captcha', 'course-builder' ),
							'param_name' => 'captcha',
							"dependency" => array(
								"element" => "display",
								"value"   => array( "form" ),
							),
						),
						// Extra class
						array(
							'type'        => 'textfield',
							'admin_label' => true,
							'heading'     => esc_html__( 'Extra class', 'course-builder' ),
							'param_name'  => 'el_class',
							'value'       => '',
							'description' => esc_html__( 'Add extra class name for Thim Login shortcode to use in CSS customizations.', 'course-builder' ),
						),
					)
				)
			);
		}

		/**
		 * Add shortcode
		 *
		 * @param $atts
		 */
		public function shortcode( $atts, $content = null ) {

			$params = shortcode_atts( array(
				'display'       => 'form',
				'text_login'    => __('Login','course-builder'),
				'text_logout'   => __('Logout','course-builder'),
				'text_register' => __('Register', 'course-builder'),
				'content'       => '',
				'popup'         => false,
				'link'          => get_permalink( get_page_by_path( 'account' ) ),
				'captcha'       => false,
				'el_class'      => '',
			), $atts );

			$params['content'] = wpb_js_remove_wpautop( $content, true ); // fix unclosed/unwanted paragraph tags in $content

			ob_start();

			thim_get_template( $params['display'], array( 'params' => $params ), $this->base . '/tpl/' );

			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		}

	}

	new Thim_SC_Login_Form();
}