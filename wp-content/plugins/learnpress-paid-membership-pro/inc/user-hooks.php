<?php

class LP_PMPro_User_Hooks 
{

	public function __construct(){
		# add hook for CAN ENROLL COURSE
		add_filter( 'learn_press_user_can_enroll_course', array( $this, 'can_enroll_course_callback' ), 11, 3 );
		add_filter( 'learn-press/can-enroll-course', array( $this, 'can_enroll_course_callback' ), 11, 3 );

		# add hook for CAN PURCHASE COURSE
		add_filter( 'learn-press/user/can-purchase-course', array($this, 'can_purchase_course_callback'), 11, 3 );
		
		# add hook for can_retake_course
		add_filter( 'learn_press_user_can_retake_course', array($this, 'can_retake_course_callback'), 11, 3 );
	}


	public function get_course_levels($course_id){
		return learn_press_pmpro_get_course_levels($course_id);
	}

	public function can_enroll_course_callback( $can_enroll, $course_id, $user_id ) {
		$buy_membership = ( LP()->settings->get( 'buy_through_membership' ) === 'yes' );
		$course_levels  = $this->get_course_levels( $course_id );
		$user = learn_press_get_user( $user_id );
		if( $user->has_purchased_course( $course_id ) ) {
			return $can_enroll;
		}
		if( !$course_levels || empty($course_levels) ) {
			return $can_enroll;
		}
		$has_membership_level = learn_press_pmpro_hasMembershipLevel( $course_levels, $user_id );
		if ( $buy_membership ) {
			$can_enroll = $has_membership_level;
		} elseif( !$can_enroll ) {
			$can_enroll = $has_membership_level;
		}
		return $can_enroll;
	}

	public function can_purchase_course_callback( $can_purchase, $user_id, $course_id ) {
		$course_levels = $this->get_course_levels( $course_id );
		if( empty( $course_levels ) ) {
			return $can_purchase;
		}
		$buy_membership = ( LP()->settings->get( 'buy_through_membership' ) === 'yes' );
		// hide purchase button if only buy course via membership
		if( $buy_membership && !empty($course_levels)) {
			$can_purchase = false;
		}
		return $can_purchase;
	}

	public function can_retake_course_callback( $can_retake, $course_id, $user_id ) {
		if($can_retake){
		    return $can_retake;
		}
		$course_levels  = $this->get_course_levels($course_id);
		if( empty($course_levels) ) {
		    return $can_retake;
		}
		$has_membership_level = learn_press_pmpro_hasMembershipLevel( $course_levels, $user_id );
		if($has_membership_level){
			if( !$can_retake || $can_retake<1 ) {
				$can_retake = 1;
			}
		}
		return $can_retake;
	}
}


$pmpro_user = new LP_PMPro_User_Hooks();

?>