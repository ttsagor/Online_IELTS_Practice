<?php

/**
 * Add sidebar
 */
add_action( 'widgets_init', 'thim_bp_widgets_init' );
function thim_bp_widgets_init() {
	register_sidebar( array(
		'name'          => esc_attr__( 'BuddyPress - Sidebar', 'course-builder' ),
		'id'            => 'buddypress',
		'description'   => esc_attr__( 'Sidebar of BuddyPress', 'course-builder' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}

/**
 * Disables BuddyPress' registration process.
 */

remove_action( 'bp_init', 'bp_core_wpsignup_redirect' );
remove_action( 'bp_screens', 'bp_core_screen_signup' );
