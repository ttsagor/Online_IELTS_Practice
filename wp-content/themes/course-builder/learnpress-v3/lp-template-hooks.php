<?php
/**
 * Build courses content
 */

defined( 'ABSPATH' ) || exit();


remove_action( 'learn-press/before-main-content', 'learn_press_search_form', 15 );
remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );

if ( get_theme_mod( 'thim_learnpress_lesson_comment' ) == false ) {
	remove_action( 'learn-press/after-course-item-content', 'learn_press_lesson_comment_form', 10 );
}

/**
 * Landing
 */
//remove_action( 'learn_press_courses_loop_item_title', 'learn_press_courses_loop_item_title', 10 );
//remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 15 );
//remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 70 );
//remove_action( 'learn-press/content-landing-summary', 'learn_press_course_students', 30 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_students', 10 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_tabs', 20 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_price', 25 );
remove_action( 'learn-press/content-landing-summary', 'learn_press_course_buttons', 30 );

add_action( 'learn-press/content-landing-summary', 'thim_landing_tabs', 22 );
if ( ! function_exists( 'thim_landing_tabs' ) ) {
	function thim_landing_tabs() {
		learn_press_get_template( 'single-course/tabs/tabs-landing.php' );
	}
}
add_action( 'learn-press/content-landing-summary', 'learn_press_course_overview_tab', 51 );
add_action( 'learn-press/content-landing-summary', 'learn_press_course_curriculum_tab', 60 );
add_action( 'learn-press/content-landing-summary', 'learn_press_course_instructor', 65 );

if ( class_exists( 'LP_Addon_Course_Review' ) ) {
	add_action( 'learn-press/content-landing-summary', 'thim_course_rate', 70 );
}

add_action( 'learn-press/content-landing-summary', 'thim_related_courses', 75 );

add_action( 'learn-press/content-landing-summary', 'thim_infobar_position_single', 71 );
function thim_infobar_position_single() { ?>
	<div class="wrapper-info-bar infobar-single">
		<?php learn_press_get_template( 'single-course/infobar.php' ); ?>
	</div>
	<?php
}

/*
 * Landing course navigation tab
 * */
add_action( 'thim_lp_landing_course_tab', 'learn_press_course_price', 10 );
add_action( 'thim_lp_landing_course_tab', 'learn_press_course_buttons', 15 );


/**
 * Learning
 */
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_students', 15 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_progress', 25 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_remaining_time', 30 );
remove_action( 'learn-press/content-learning-summary', 'learn_press_course_buttons', 40 );
//remove_action( 'learn-press/content-learning-summary', 'learn_press_course_status', 15 );
//remove_action( 'learn-press/content-learning-summary', 'learn_press_course_instructor', 45 );
//remove_action( 'learn-press/content-learning-summary', 'learn_press_course_progress', 45 );
//remove_action( 'learn-press/content-learning-summary', 'learn_press_course_students', 25 );
//remove_action( 'learn-press/content-learning-summary', 'learn_press_course_remaining_time', 55 );
//remove_action( 'learn-press/content-learning-summary', 'learn_press_course_buttons', 65 );

add_action( 'thim_learning_after_tabs_wrapper', 'learn_press_course_remaining_time', 10 );
add_action( 'thim_learning_end_tab_curriculum', 'learn_press_course_buttons', 65 );
add_action( 'learn-press/begin-section-loop-item', 'thim_add_format_icon' );
//add_action( 'comment_form_course', 'thim_course_get_avatar', 60 );


//remove tab instructor learning page
add_filter( 'learn_press_course_tabs', function ( $tabs ) {
	if ( ! empty( $tabs['co-instructor'] ) ) {
		unset( $tabs['co-instructor'] );
	}

	return $tabs;
}, 10 );

//Remove Wishlist
if ( thim_plugin_active( 'learnpress-wishlist/learnpress-wishlist.php' ) || class_exists( 'LP_Addon_Wishlist' ) ) {
	$addon_wishlist = LP_Addon_Wishlist::instance();
	remove_action( 'learn-press/content-learning-summary', array( $addon_wishlist, 'wishlist_button' ), 100 );
}

// Remove default forum link in single course
if ( thim_plugin_active( 'learnpress-bbpress/learnpress-bbpress.php' ) || class_exists( 'LP_Addon_BBPress_Course_Forum' ) ) {
	$addon_bbpress = LP_Addon_BBPress_Course_Forum::instance();
	remove_action( 'learn_press_after_single_course_summary', array( $addon_bbpress, 'forum_link' ) );
}

//Profile Page
remove_action( 'learn_press_after_profile_loop_course', 'learn_press_after_profile_tab_loop_course', 5, 2 );
if ( thim_plugin_active( 'learnpress-co-instructor/learnpress-co-instructor.php' ) || class_exists( 'LP_Addon_Co_Instructor' ) ) {
	$addon_co_instructor = LP_Addon_Co_Instructor::instance();
	remove_filter( 'learn_press_user_profile_tabs', array(
		$addon_co_instructor,
		'learn_press_add_tab_instructor_in_profile'
	), 15, 2 );
}

// Change finished purchased courses tab to in progress tab
add_filter( 'learn-press/profile/purchased-courses-filters', 'thim_change_profile_purchased_course_tab', 10 );
if ( ! function_exists( 'thim_change_profile_purchased_course_tab' ) ) {
	function thim_change_profile_purchased_course_tab( $defaults ) {
		$profile = LP_Global::profile();
		$url     = $profile->get_current_url( false );

		$has_finished_tab = array_key_exists( 'finished', $defaults );

		if ( $has_finished_tab ) {
			unset( $defaults['finished'] );
		}

		// TODO look like hard code
		$defaults['all']         = sprintf( '<a href="%s">%s</a>', esc_url( $url ), esc_html__( 'All', 'course-builder' ) );
		$defaults['finished']    = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'finished', $url ) ), esc_html__( 'Finished', 'course-builder' ) );
		$defaults['passed']      = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'passed', $url ) ), esc_html__( 'Passed', 'course-builder' ) );
		$defaults['failed']      = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'failed', $url ) ), esc_html__( 'Failed', 'course-builder' ) );
		$defaults['in_progress'] = sprintf( '<a href="%s">%s</a>', esc_url( add_query_arg( 'filter-status', 'in_progress', $url ) ), __( 'In Progress', 'course-builder' ) );

		return $defaults;
	}
}

// Get in progress tab content
add_filter( 'learn-press/query/user-purchased-courses', 'thim_add_profile_in_progress_tab', 10, 3 );
if ( ! function_exists( 'thim_add_profile_in_progress_tab' ) ) {
	function thim_add_profile_in_progress_tab( $sql, $user_id, $args ) {
		if ( $args['status'] == 'in_progress' ) {
			$sql['where'] .= ' AND ui.status = "enrolled"';
		}

		return $sql;
	}
}

// Remove section content
$profile = LP_Profile::instance();
remove_action( 'learn-press/before-profile-content', array( $profile, 'output_section' ), 10 );

add_filter( 'learn-press/profile-tabs', 'thim_modify_profile_tab' );
if ( ! function_exists( 'thim_modify_profile_tab' ) ) {
	function thim_modify_profile_tab( $defaults ) {
		$defaults['settings']['sections']['additional-information'] = array(
			'title'    => esc_html__( 'Additional Information', 'course-builder' ),
			'slug'     => 'additional-information',
			'priority' => 50
		);

		return $defaults;
	}
}

//Collections
remove_action( 'learn_press_collections_before_single_summary', 'learn_press_collections_title', 5 );

//Lesson Quiz
remove_action( 'learn_press/after_course_item_content', 'learn_press_lesson_comment_form', 10 );

// Add media for only Lesson
add_action( 'learn-press/before-content-item-summary/lp_lesson', 'thim_add_media_lesson_content',1 );
if ( ! function_exists( 'thim_add_media_lesson_content' ) ) {
	function thim_add_media_lesson_content() {
		$course_item      = LP_Global::course_item();
		$lesson_media_meta = get_post_meta( $course_item->get_id(), '_lp_lesson_video_intro', true );

		if ( !empty( $lesson_media_meta ) ) {
			echo '<div class="thim-lesson-media"><div class="wrapper">' . ( $lesson_media_meta ) . '</div></div>';
		}

	}
}
// Certificates
if ( ! is_user_logged_in() ) {
	if ( thim_plugin_active( 'learnpress-certificates/learnpress-certificates.php' ) || class_exists( 'LP_Addon_Certificates' ) ) {
		$addon_certificates = LP_Addon_Certificates::instance();
		remove_filter( 'learn_press_user_profile_tabs', array( $addon_certificates, 'certificates_tab' ), 105 );
	}
}

function thim_course_instructor() {
	learn_press_get_template( 'single-course/instructor.php' );
}

function thim_course_rate() {
	echo '<div class="landing-review">';
	    learn_press_course_review_template( 'course-rate.php' );
	    learn_press_course_review_template( 'course-review.php' );
	echo '</div>';
}

function thim_course_review() {
	learn_press_course_review_template( 'course-review.php' );
}


function add_review_button() {
	learn_press_course_review_template( 'review-form.php' );
}

// Change redirect enroll to theme's account page
add_filter( 'learn-press/enroll-course-redirect-login', 'thim_modify_redirect_enroll' );
if ( ! function_exists( 'thim_modify_redirect_enroll' ) ) {
	function thim_modify_redirect_enroll( $url ) {
		$current_course_id = $_REQUEST['enroll-course'];
		if ( empty( $current_course_id ) ) {
			return false;
		}
		$url = add_query_arg( 'redirect_to', get_the_permalink( $current_course_id ), thim_get_login_page_url() );

		return $url;
	}
}

// No require password strength in LearnPress's register form (Checkout page)
add_filter( 'learn-press/register-fields', 'thim_lp_modify_password_field' );
if ( ! function_exists( 'thim_lp_modify_password_field' ) ) {
	function thim_lp_modify_password_field( $fields ) {
		if ( isset( $fields['reg_password']['desc'] ) ) {
			unset( $fields['reg_password']['desc'] );
		}

		remove_filter( 'learn-press/register-validate-field', array(
			'LP_Forms_Handler',
			'register_validate_field'
		), 10 );

		return $fields;
	}
}
