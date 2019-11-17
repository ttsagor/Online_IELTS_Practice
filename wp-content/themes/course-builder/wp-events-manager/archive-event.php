<?php
/**
 * The Template for displaying all archive products.
 *
 * Override this template by copying it to yourtheme/tp-event/templates/archive-event.php
 *
 * @author        ThimPress
 * @package       tp-event/template
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
global $wp_query;
$_wp_query = $wp_query;

$events_layout = get_theme_mod( 'event_style' );
$has_param      = '';
if ( isset( $_GET['layout'] ) && $_GET['layout'] != '' ) {
	$events_layout = $_GET['layout'];
	$has_param      = 'has-layout';
}

?>

<?php
/**
 * tp_event_before_main_content hook
 *
 * @hooked tp_event_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked tp_event_breadcrumb - 20
 */
do_action( 'tp_event_before_main_content' );
?>

<?php
/**
 * tp_event_archive_description hook
 *
 * @hooked tp_event_taxonomy_archive_description - 10
 * @hooked tp_event_room_archive_description - 10
 */
do_action( 'tp_event_archive_description' );
?>
    <div class="list-tab-event">
        <ul class="nav nav-tabs clearfix" role="tablist">

                <li>
                    <a class="active" href="#tab-happening" data-toggle="tab"
                       data-tab="happening" role="tab"></i><?php esc_html_e('Happening', 'course-builder'); ?></a>
                </li>

                <li>
                    <a  href="#tab-upcoming" data-toggle="tab" data-tab="upcoming"
                       role="tab"><?php esc_html_e('Upcoming', 'course-builder'); ?></a>
                </li>

                <li>
                    <a href="#tab-expired" data-toggle="tab" data-tab="expired"
                       role="tab"><?php esc_html_e('Expired', 'course-builder'); ?></a>
                </li>
        </ul>

        <div class="archive_switch tab-content thim-list-event">
            <?php
            foreach ( array( 'happening', 'upcoming', 'expired' ) as $type ) :
                get_template_part( 'wp-events-manager/archive-event', $type );
            endforeach;
            ?>
        </div>
    </div>

<?php
/**
 * tp_event_after_main_content hook
 *
 * @hooked tp_event_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'tp_event_after_main_content' );
?>

<?php
/**
 * tp_event_sidebar hook
 *
 * @hooked tp_event_get_sidebar - 10
 */
do_action( 'tp_event_sidebar' );
