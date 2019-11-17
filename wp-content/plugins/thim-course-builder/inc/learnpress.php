<?php

include_once( THIM_CB_PATH . 'inc/plugins/learnpress-tabs/learnpress-tabs.php' );

if ( ! function_exists( 'lp_get_courses_popular' ) ) {
	function lp_get_courses_popular() {
		global $wpdb;
		$popular_courses_query = $wpdb->prepare(
			"SELECT po.*, count(*) as number_enrolled 
					FROM {$wpdb->prefix}learnpress_user_items ui
					INNER JOIN {$wpdb->posts} po ON po.ID = ui.item_id
					WHERE ui.item_type = %s
						AND ( ui.status = %s OR ui.status = %s )
						AND po.post_status = %s
					GROUP BY ui.item_id 
					ORDER BY ui.item_id DESC
				",
			LP_COURSE_CPT,
			'enrolled',
			'finished',
			'publish'
		);
		$popular_courses       = $wpdb->get_results(
			$popular_courses_query
		);

		$temp_arr = array();
		foreach ( $popular_courses as $course ) {
			array_push( $temp_arr, $course->ID );
		}

		return $temp_arr;
	}
}