<?php
/**
 * Section Blog General
 *
 * @package Course_Builder
 */

thim_customizer()->add_section(
	array(
		'id'       => 'learnpress_general',
		'panel'    => 'learnpress',
		'title'    => esc_html__( 'Settings', 'course-builder' ),
		'priority' => 10,
	)
);

// Enable or disable Top Sidebar Archive
thim_customizer()->add_field(
	array(
		'id'      => 'learnpress_top_sidebar_archive_display',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Top Widget Area', 'course-builder' ),
		'tooltip' => esc_html__( 'Turn on to show Top Widget Area on LearnPress archive pages.', 'course-builder' ),
		'section' => 'learnpress_general',
		'default' => 1,
		'choices' => array(
			'on'  => esc_attr__( 'On', 'course-builder' ),
			'off' => esc_attr__( 'Off', 'course-builder' )
		),
	)
);

thim_customizer()->add_field( array(
	'label'   => esc_attr__( 'Page Style', 'course-builder' ),
	'id'      => 'learnpress_cate_style',
	'type'    => 'select',
	'section' => 'learnpress_general',
	'choices' => array(
		'grid' => esc_attr__( 'Grid', 'course-builder' ),
		'list' => esc_attr__( 'List', 'course-builder' ),
	),
	'default' => 'grid',
) );

thim_customizer()->add_field( array(
	'label'           => esc_attr__( 'Grid Columns', 'course-builder' ),
	'id'              => 'learnpress_cate_grid_column',
	'type'            => 'select',
	'section'         => 'learnpress_general',
	'choices'         => array(
		'2' => esc_attr__( '2', 'course-builder' ),
		'3' => esc_attr__( '3', 'course-builder' ),
		'4' => esc_attr__( '4', 'course-builder' )
	),
	'default'         => '3',
	'active_callback' => array(
		array(
			'setting'  => 'learnpress_cate_style',
			'operator' => '===',
			'value'    => 'grid',
		),
	),
) );
thim_customizer()->add_field( array(
	'label'   => esc_attr__( 'Collection Columns', 'course-builder' ),
	'id'      => 'learnpress_cate_collection_column',
	'type'    => 'select',
	'section' => 'learnpress_general',
	'choices' => array(
		'2' => esc_attr__( '2', 'course-builder' ),
		'3' => esc_attr__( '3', 'course-builder' ),
		'4' => esc_attr__( '4', 'course-builder' ),
	),
	'default' => '3',
) );

thim_customizer()->add_field(
	array(
		'id'      => 'learnpress_icon_archive_display',
		'type'    => 'switch',
		'label'   => esc_html__( 'Show Icons Archive Page', 'course-builder' ),
		'tooltip' => esc_html__( 'Turn on to show icons on LearnPress archive pages.', 'course-builder' ),
		'section' => 'learnpress_general',
		'default' => 1,
		'choices' => array(
			'on'  => esc_attr__( 'On', 'course-builder' ),
			'off' => esc_attr__( 'Off', 'course-builder' )
		),
	)
);
