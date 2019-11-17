<?php

class LP_Certificates_Settings extends LP_Abstract_Settings_Page {
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->id   = 'certificates';
		$this->text = __( 'Certificates', 'learnpress-certificates' );

		parent::__construct();
	}

	public function get_settings( $section = '', $tab = '' ) {
		return array(
			array(
				'title'   => __( 'Google Fonts', 'learnpress-certificates' ),
				'id'      => 'certificates[google_fonts]',
				'default' => 'no',
				'type'    => 'google-fonts'
			),
			array(
				'name'            => __( 'Social Sharing', 'learnpress-certificates' ),
				'id'              => 'certificates[socials]',
				'default'         => '',
				'type'            => 'checkbox_list',
				'options'         => array(
					'twitter'  => __( 'Twitter', 'learnpress-certificates' ),
					'facebook' => __( 'Facebook', 'learnpress-certificates' ),
					'plusone'  => __( 'Plusone', 'learnpress-certificates' )
				),
				'select_all_none' => true
			)
		);
	}
}

return new LP_Certificates_Settings();