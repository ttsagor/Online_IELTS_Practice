<?php

class LP_Certificate_Course_Name_Layer extends LP_Certificate_Layer {
	public function apply( $data ) {

		$this->options['text'] = get_the_title( $data['course_id'] );
	}
}