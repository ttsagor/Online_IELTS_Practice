<?php
/*
 * Section LearnPress / Features
 * */

thim_customizer()->add_section(
	array(
		'id'       => 'learnpress_features',
		'panel'    => 'learnpress',
		'title'    => esc_html__( 'Features', 'course-builder' ),
		'priority' => 10,
	)
);

// Enable or Disable Login Popup when buy this course
thim_customizer()->add_field(
	array(
		'id'          => 'enable_lp_single_popup',
		'type'        => 'switch',
		'label'       => esc_html__( 'Purchase Course Popup', 'course-builder' ),
		'tooltip'     => esc_html__( 'Enable login popup when buy this course with user not logged in.', 'course-builder' ),
		'section'     => 'learnpress_features',
		'default'     => true,
		'priority'    => 9,
		'choices'     => array(
			true  	  => esc_html__( 'Show', 'course-builder' ),
			false	  => esc_html__( 'Hide', 'course-builder' ),
		),
	)
);


thim_customizer()->add_field(
	array(
		'id'       => 'learnpress_new_course_duration',
		'type'     => 'number',
		'label'    => esc_html__( 'New Course Period ( Days )', 'course-builder' ),
		'tooltip'  => esc_html__( 'How long a course is considered as new course. A new course will have NEW label on their them. Value "0" is off.', 'course-builder' ),
		'section'  => 'learnpress_features',
		'default'  => 3,
		'priority' => 10,
		'choices'  => array(
			'min'  => '0',
			'max'  => '7',
			'step' => '1',
		),
	)
);

thim_customizer()->add_field( array(
	'label'   => esc_html__( 'Hidden Ads', 'course-builder' ),
	'id'      => 'thim_learnpress_hidden_ads',
	'type'    => 'switch',
	'section' => 'learnpress_features',
	'tooltip' => 'Check this box to hide/unhide advertisement',
	'default' => 1,
	'choices' => array(
		true  => esc_html__( 'On', 'course-builder' ),
		false => esc_html__( 'Off', 'course-builder' ),
	),
) );

thim_customizer()->add_field( array(
	'label'   => esc_html__( 'Show/Hidden Lesson Comment', 'course-builder' ),
	'id'      => 'thim_learnpress_lesson_comment',
	'type'    => 'switch',
	'section' => 'learnpress_features',
	'tooltip' => 'Check this box to hide/unhide advertisement',
	'default' => 1,
	'choices' => array(
		true  => esc_html__( 'On', 'course-builder' ),
		false => esc_html__( 'Off', 'course-builder' ),
	),
) );

// Tab Course
thim_customizer()->add_field(
	array(
		'id'       => 'group_tabs_course',
		'type'     => 'sortable',
		'label'    => esc_html__( 'Sortable Tab Course', 'course-builder' ),
		'tooltip'  => esc_html__( 'Click on eye icons to show or hide buttons. Use drag and drop to change the position of tabs...', 'course-builder' ),
		'section'  => 'learnpress_features',
		'priority' => 50,
		'default'  => array(
			'overview',
			'curriculum',
			'announcements',
			'instructor',
			'students-list',
			'review',
		),
		'choices'  => array(
			'overview'  => esc_html__( 'Overview', 'course-builder' ),
			'curriculum'   => esc_html__( 'Curriculum', 'course-builder' ),
			'announcements' => esc_html__( 'Announcements', 'course-builder' ),
			'instructor' => esc_html__( 'Instructors', 'course-builder' ),
			'students-list' => esc_html__( 'Student list', 'course-builder' ),
			'review'    => esc_html__( 'Reviews', 'course-builder' ),
		),
	)
);

//thim_customizer()->add_field(
//	array(
//		'id'       => 'default_tab_course',
//		'type'     => 'select',
//		'label'    => esc_html__( 'Select Tab Default', 'course-builder' ),
//		'tooltip'  => esc_html__( 'Select tab you want set to default', 'course-builder' ),
//		'section'  => 'learnpress_features',
//		'priority' => 50,
//		'choices'   => array(
//			'overview'  => esc_html__( 'Overview', 'course-builder' ),
//			'curriculum'   => esc_html__( 'Curriculum', 'course-builder' ),
//			'announcements' => esc_html__( 'Announcements', 'course-builder' ),
//			'instructor' => esc_html__( 'Instructors', 'course-builder' ),
//			'students-list' => esc_html__( 'Student list', 'course-builder' ),
//			'review'    => esc_html__( 'Reviews', 'course-builder' ),
//
//		),
//		'default'   => 'curriculum',
//	)
//);