<?php
/**
 * Template for displaying the form let user fill out their information to become a teacher.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/become-teacher-form.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
?>

<div id="learn-press-become-teacher-form" class="become-teacher-form learn-press-form">

    <form name="become-teacher-form" method="post" enctype="multipart/form-data" action="">

        <div class="title">
            <h4 class="title-form">
                <?php echo esc_html__( 'Start the change', 'course-builder' ) ?>
            </h4>
            <h3 class="register">
                <?php echo esc_html__( 'Register to become an Instructor', 'course-builder' ) ?>
            </h3>
        </div>

        <?php do_action( 'learn-press/before-become-teacher-form' ); ?>

        <?php do_action( 'learn-press/become-teacher-form' ); ?>

		<?php do_action( 'learn-press/after-become-teacher-form' ); ?>

    </form>

</div>
