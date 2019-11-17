<?php
/**
 * Template for displaying Start assignment button.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/assignments/content-assignment/buttons/start.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Assignments/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course             = LP_Global::course();
$assignments        = LP_Global::get_custom_posts( 'assignment' );
$current_assignment = current( $assignments );
?>

<?php do_action( 'learn-press/before-assignment-start-button' ); ?>

<form name="start-assignment" class="start-assignment" method="post" enctype="multipart/form-data">

	<?php do_action( 'learn-press/begin-assignment-start-button' ); ?>

    <button type="submit" class="button"><?php _e( 'Start', 'learnpress-assignments' ); ?></button>

	<?php do_action( 'learn-press/end-assignment-start-button' ); ?>

	<?php assignment_action( 'start', $current_assignment->get_id(), $course->get_id(), true ); ?>
    <input type="hidden" name="noajax" value="yes">

</form>

<?php do_action( 'learn-press/after-assignment-start-button' ); ?>
