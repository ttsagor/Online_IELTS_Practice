<?php
/**
 * Template for displaying layout 1 content of landing course.
 *
 * @author  ThimPress
 * @package  CourseBuilder/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<div class="landing-1">

	<?php learn_press_get_template( 'single-course/course-info.php' ); ?>

	<?php learn_press_get_template( 'single-course/thumbnail.php' ); ?>

    <div class="course-landing-summary">

        <div class="share sticky-sidebar">
			<?php thim_social_share( 'learnpress_single_' ); ?>
        </div>

        <div class="content-landing-1">
			<?php do_action( 'learn-press/content-landing-summary' ); ?>
        </div>

    </div>

</div>

