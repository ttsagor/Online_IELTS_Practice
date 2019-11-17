<?php
/**
 * Group Utilities
 *
 * @package Course_Builder
 */

thim_customizer()->add_section(
	array(
		'id'       => 'utilities',
		'panel'    => 'general',
		'title'    => esc_html__( 'Utilities', 'course-builder' ),
		'priority' => 80,
	)
);

// Feature: Auto Login
thim_customizer()->add_field(
	array(
		'type'     => 'switch',
		'id'       => 'auto_login',
		'label'    => esc_html__( 'Disable Auto Login', 'course-builder' ),
		'section'  => 'utilities',
		'tooltip'  => esc_html__( 'Disable auto login on the account page.', 'course-builder' ),
		'default'  => false,
		'priority' => 1,
		'choices'  => array(
			true  => esc_html__( 'On', 'course-builder' ),
			false => esc_html__( 'Off', 'course-builder' ),
		),
	)
);

// Feature: Allow Register Popup
thim_customizer()->add_field(
	array(
		'type'     => 'switch',
		'id'       => 'register_popup',
		'label'    => esc_html__( 'Allow Register Popup', 'course-builder' ),
		'section'  => 'utilities',
		'tooltip'  => esc_html__( 'Allow register popup on the header.', 'course-builder' ),
		'default'  => true,
		'priority' => 2,
		'choices'  => array(
			true  => esc_html__( 'On', 'course-builder' ),
			false => esc_html__( 'Off', 'course-builder' ),
		),
	)
);

// Register Redirect
thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'thim_register_redirect',
		'section'  => 'utilities',
		'label'    => esc_html__( 'Register Redirect', 'course-builder' ),
		'tooltip'  => esc_html__( 'Allows register redirect url. Blank will redirect to current page.', 'course-builder' ),
		'priority' => 3,
	)
);

// Login Redirect
thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'thim_login_redirect',
		'section'  => 'utilities',
		'label'    => esc_html__( 'Login Redirect', 'course-builder' ),
		'tooltip'  => esc_html__( 'Allows login redirect url. Blank will redirect to current page.', 'course-builder' ),
		'priority' => 4,
	)
);

// Feature: Google Analytics
thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'thim_google_analytics',
		'label'    => esc_html__( 'Google Analytics', 'course-builder' ),
		'tooltip'  => esc_html__( 'Enter your ID Google Analytics.', 'course-builder' ),
		'section'  => 'utilities',
		'priority' => 10,
	)
);

// Feature: Facebook Pixel
thim_customizer()->add_field(
	array(
		'type'     => 'text',
		'id'       => 'thim_facebook_pixel',
		'label'    => esc_html__( 'Facebook Pixel', 'course-builder' ),
		'tooltip'  => esc_html__( 'Enter your ID Facebook Pixel.', 'course-builder' ),
		'section'  => 'utilities',
		'priority' => 20,
	)
);