<?php
/*
 * Section Event / Features
 * */

thim_customizer()->add_section(
	array(
		'id'       => 'event_features',
		'panel'    => 'events',
		'title'    => esc_html__( 'Features', 'course-builder' ),
		'priority' => 10,
	)
);

// Enable or Disable Login Popup when buy this course
thim_customizer()->add_field(
	array(
		'id'          => 'enable_event_single_popup',
		'type'        => 'switch',
		'label'       => esc_html__( 'Buy Ticket Popup', 'course-builder' ),
		'tooltip'     => esc_html__( 'Enable login popup when buy ticket with user not logged in.', 'course-builder' ),
		'section'     => 'event_features',
		'default'     => true,
		'priority'    => 9,
		'choices'     => array(
			true  	  => esc_html__( 'Show', 'course-builder' ),
			false	  => esc_html__( 'Hide', 'course-builder' ),
		),
	)
);