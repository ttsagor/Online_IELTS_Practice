<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package thim
 */
if ( ! is_active_sidebar( 'buddypress' ) ) {
	return;
}

$thim_options = get_theme_mods();
$sticky_sidebar = isset( $thim_options['sticky_sidebar'] ) && ( $thim_options['sticky_sidebar'] == true ) ? ' sticky-sidebar' : '';


$wrapper_layout = 'sidebar-left';
if ( get_theme_mod( 'buddypress_archive_layout' ) != '' ) {
	$wrapper_layout = get_theme_mod( 'buddypress_archive_layout' );
}

// Get class layout
$sidebar_class_col = 'flex-last';
if ( $wrapper_layout == 'sidebar-left' ) {
	$sidebar_class_col = "flex-first";
}
if ( $wrapper_layout == 'sidebar-right' ) {
	$sidebar_class_col = 'flex-last';
}
?>
<?php if ( $wrapper_layout != 'full-sidebar' ) { ?>
	<aside id="secondary" class="sidebar-buddypress widget-area col-md-3<?php echo esc_attr( $sticky_sidebar ); ?> <?php echo esc_attr( $sidebar_class_col ); ?>">
		<?php if ( ! dynamic_sidebar( 'buddypress' ) ) :
			dynamic_sidebar( 'buddypress' );
		endif; // end sidebar widget area ?>
	</aside><!-- #secondary -->
<?php } ?>