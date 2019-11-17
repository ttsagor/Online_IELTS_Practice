<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Thim_SC_Steps' ) ) {

	class Thim_SC_Steps {

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
			$this->name        = esc_attr__( 'Thim: Steps', 'course-builder' );
			$this->description = esc_attr__( 'Display a steps box.', 'course-builder' );
			$this->base        = 'steps';
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
				'description' => $this->description,
				'icon'        => THIM_CB_URL . $this->base . '/assets/images/icon/sc-steps.png',
				'params'      => array(

					array(
						'type'        => 'textarea',
						'admin_label' => true,
						'heading'     => esc_attr__( 'Thim Steps title', 'course-builder' ),
						'param_name'  => 'title',
						'value'       => '',
					),
					array(
						"type"        => "radio_image",
						"heading"     => esc_attr__( "Layout", 'course-builder' ),
						"param_name"  => "layout",
						"options"     => array(
							'layout-1' => THIM_CB_URL . $this->base . '/assets/images/layouts/layout-1.jpg',
							'layout-2' => THIM_CB_URL . $this->base . '/assets/images/layouts/layout-2.jpg',
							'layout-3' => THIM_CB_URL . $this->base . '/assets/images/layouts/layout-3.jpg',
							'layout-4' => THIM_CB_URL . $this->base . '/assets/images/layouts/layout-4.jpg',
						),
					),

					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => esc_attr__( 'Video URL', 'course-builder' ),
						'param_name'  => 'video_url',
						'value'       => '',
						'description' => esc_attr__( 'Support Youtube and Vimeo format', 'course-builder' ),
						"dependency"  => array(
							"element" => "layout",
							"value"   => array( "layout-4" )
						),
					),
					array(
						"type"        => "textfield",
						"heading"     => esc_html__( "Step circle text", 'course-builder' ),
						"param_name"  => "circle-text",
						"value"       => 'step',
						"description" => "Enter text in step circle. However icon is preferred.",
//						"dependency"  => array(
//							"element" => "layout",
//                            "value"   => array( 'layout-1', 'layout-2')
//						),
					),
					array(
						"type"        => "dropdown",
						"heading"     => esc_attr__( "Style", 'course-builder' ),
						"param_name"  => "style_layout",
						"value"       => array(
							esc_attr__( "Default", 'course-builder' ) => 'default',
							esc_attr__( "With description", 'course-builder' ) => "style-02",
						),
						"dependency"  => array(
							"element" => "layout",
							"value"   => array( "layout-1" ),
						),
					),
					array(
						"type"        => "textarea",
						"heading"     => esc_html__( "Description", 'course-builder' ),
						"param_name"  => "description",
						"dependency"  => array(
							"element" => "style_layout",
							"value"   => 'style-02',
						),
					),
					array(
						"type"             => "attach_image",
						"heading"          => esc_attr__( "Image", 'course-builder' ),
						"param_name"       => "image",
						"admin_label"      => true,
						"description"      => esc_attr__( "Select an image to upload ", 'course-builder' ),
						'edit_field_class' => "vc_col-sm-6",
						"dependency"       => array(
							"element" => "layout",
							"value"   => array( 'layout-1', 'layout-2', 'layout-3' )
						),
					),

					array(
						"type"             => "attach_image",
						"heading"          => esc_attr__( "Background Image", 'course-builder' ),
						"param_name"       => "background_image",
						"admin_label"      => true,
						"description"      => esc_attr__( "Select an image to upload", 'course-builder' ),
						'edit_field_class' => "vc_col-sm-6",
						"dependency"       => array(
							"element" => "layout",
							"value"   => array( 'layout-3', 'layout-4' )
						),
					),

					array(
						'type'       => 'param_group',
						'value'      => '',
						'param_name' => 'steps',
						'params'     => array(

							array(
								"type"       => "textfield",
								"heading"    => esc_html__( "Step Title", 'course-builder' ),
								"param_name" => "title",
							),

							array(
								"type"       => "textarea",
								"heading"    => esc_html__( "Step Description", 'course-builder' ),
								"param_name" => "description",
							),

							array(
								"type"       => "textfield",
								"heading"    => esc_html__( "Read more URL", 'course-builder' ),
								"param_name" => "readmore",
							),

							array(
								"type"             => "dropdown",
								"heading"          => esc_attr__( "Select type of icon", 'course-builder' ),
								"param_name"       => "icon",
								"admin_label"      => true,
								"value"            => array(
									esc_attr__( "Font Awesome icon", 'course-builder' ) => "font_awesome",
									esc_attr__( "Ionicons", 'course-builder' )          => "font_ionicons",
									esc_attr__( "Upload icon", 'course-builder' )       => "upload_icon",
								),
								'edit_field_class' => "vc_col-sm-6",
							),
							// Fontawesome Picker
							array(
								"type"             => "iconpicker",
								"heading"          => esc_attr__( "Font Awesome", 'course-builder' ),
								"param_name"       => "font_awesome",
								"settings"         => array(
									'emptyIcon' => true,
									'type'      => 'fontawesome',
								),
								'dependency'       => array(
									'element' => 'icon',
									'value'   => array( 'font_awesome' ),
								),
								'edit_field_class' => "vc_col-sm-6",
							),

							// Ionicons Picker
							array(
								"type"             => "iconpicker",
								"heading"          => esc_attr__( "Ionicons", 'course-builder' ),
								"param_name"       => "font_ionicons",
								"settings"         => array(
									'emptyIcon' => true,
									'type'      => 'ionicons',
								),
								'dependency'       => array(
									'element' => 'icon',
									'value'   => array( 'font_ionicons' ),
								),
								'edit_field_class' => "vc_col-sm-6",
							),
							// Upload icon image
							array(
								"type"             => "attach_image",
								"heading"          => esc_attr__( "Upload Icon", 'course-builder' ),
								"param_name"       => "icon_upload",
								"admin_label"      => true,
								"description"      => esc_attr__( "Select an image to upload", 'course-builder' ),
								"dependency"       => array(
									"element" => "icon",
									"value"   => array( "upload_icon" )
								),
								'edit_field_class' => "vc_col-sm-6",
							),

							/*array(
								"type"             => "iconpicker",
								"heading"          => esc_html__( "Icon", 'course-builder' ),
								"param_name"       => "icon",
								"settings"         => array(
									'emptyIcon' => true,
									'type'      => 'ionicons',
								),
								'edit_field_class' => "vc_col-sm-6",
							),*/

						)
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => esc_attr__( 'Extra class name', 'course-builder' ),
						'param_name'  => 'el_class',
						'value'       => '',
						'description' => esc_attr__( 'Add extra class name for Thim Steps shortcode to use in CSS customizations.', 'course-builder' ),
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
				'title'            => '',
				'description'      => '',
				'circle-text'      => 'step',
				'style_layout'     => '',
				'layout'           => 'layout-1',
				'video_url'        => '',
				'image'            => '',
				'background_image' => '',
				'steps'            => '',
				'el_class'         => '',
			), $atts );


			$params['base']  = $this->base;
			$params['steps'] = vc_param_group_parse_atts( $params['steps'] );

			ob_start();
			thim_get_template( 'default', array( 'params' => $params ), $this->base . '/tpl/' );
			$html = ob_get_contents();
			ob_end_clean();

			return $html;
		}

		public static function get_video( $url = '' ) {
			$video_id = $html = '';
			switch ( self::video_type( $url ) ) {
				case 'vimeo':
					$video_id = self::parse_vimeo( $url );
					$html     .= '<iframe src="https://player.vimeo.com/video/' . $video_id . '?title=0&byline=0" width="640" height="268"  webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
					break;
				case 'youtube':
					$video_id = self::parse_youtube( $url );
					$html     .= '<iframe width="560" height="315" src="https://www.youtube.com/embed/' . $video_id . '" allowfullscreen></iframe>';
					break;
				default:
					$html .= esc_html_e( 'Supported: Vimeo, Youtube', 'course-builder' );
					break;
			}

			return $html;
		}

		public static function video_type( $url ) {
			if ( strpos( $url, 'youtube' ) > 0 ) {
				return 'youtube';
			} elseif ( strpos( $url, 'vimeo' ) > 0 ) {
				return 'vimeo';
			} else {
				return 'unknown';
			}
		}

		public static function parse_youtube( $link ) {

			$regexstr = '~
			# Match Youtube link and embed code
			(?:				 				# Group to match embed codes
				(?:&lt;iframe [^&gt;]*src=")?	 
				|(?:				 		# Group to match if older embed
					(?:&lt;object .*&gt;)?		# Match opening Object tag
					(?:&lt;param .*&lt;/param&gt;)*  # Match all param tags
					(?:&lt;embed [^&gt;]*src=")?  # Match embed tag to the first quote of src
				)?				 			# End older embed code group
			)?				 				# End embed code groups
			(?:				 				# Group youtube url
				https?:\/\/		         	# Either http or https
				(?:[\w]+\.)*		        # Optional subdomains
				(?:               	        # Group host alternatives.
				youtu\.be/      	        # Either youtu.be,
				| youtube\.com		 		# or youtube.com 
				| youtube-nocookie\.com	 	# or youtube-nocookie.com
				)				 			# End Host Group
				(?:\S*[^\w\-\s])?       	# Extra stuff up to VIDEO_ID
				([\w\-]{11})		        # $1: VIDEO_ID is numeric
				[^\s]*			 			# Not a space
			)				 				# End group
			"?				 				# Match end quote if part of src
			(?:[^&gt;]*&gt;)?			 			# Match any extra stuff up to close brace
			(?:				 				# Group to match last embed code
				&lt;/iframe&gt;		         
				|&lt;/embed&gt;&lt;/object&gt;	        # or Match the end of the older embed
			)?				 				# End Group of last bit of embed code
			~ix';

			preg_match( $regexstr, $link, $matches );

			return $matches[1];

		}

		public static function parse_vimeo( $link ) {

			$regexstr = '~
			# Match Vimeo link and embed code
			(?:&lt;iframe [^&gt;]*src=")?	
			(?:							# Group vimeo url
				https?:\/\/				# Either http or https
				(?:[\w]+\.)*			# Optional subdomains
				vimeo\.com				# Match vimeo.com
				(?:[\/\w]*\/videos?)?	# Optional video sub directory this handles groups links also
				\/						# Slash before Id
				([0-9]+)				# $1: VIDEO_ID is numeric
				[^\s]*					# Not a space
			)							# End group
			"?							# Match end quote if part of src
			(?:[^&gt;]*&gt;&lt;/iframe&gt;)?	
			(?:&lt;p&gt;.*&lt;/p&gt;)?		        # Match any title information stuff
			~ix';

			preg_match( $regexstr, $link, $matches );

			return $matches[1];

		}


	}

	new Thim_SC_Steps();
}