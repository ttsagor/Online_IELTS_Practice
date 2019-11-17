<?php
/**
 * Class LP_Assignment.
 *
 * @author  ThimPress
 * @package LearnPress/Assignments/Classes
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! class_exists( 'LP_Assignment' ) ) {

	/**
	 * Class LP_Assignment
	 */
	class LP_Assignment extends LP_Course_Item implements ArrayAccess {
		/**
		 * @var array
		 *
		 * @deprecated
		 */
		static protected $_meta = array();

		/**
		 * @var string
		 */
		protected $_item_type = LP_ASSIGNMENT_CPT;

		/**
		 * @var int
		 */
		protected static $_loaded = 0;

		/**
		 * @var array
		 */
		protected $_data = array(
			'retake_count'  => 0,
			'passing_grade' => 0
		);

		/**
		 * Constructor gets the post object and sets the ID for the loaded course.
		 *
		 * @param mixed $the_assignment
		 * @param mixed $args
		 */
		public function __construct( $the_assignment, $args = array() ) {

			//parent::__construct( $the_assignment, $args );

			$this->_curd = new LP_Assignment_CURD();

			if ( is_numeric( $the_assignment ) && $the_assignment > 0 ) {
				$this->set_id( $the_assignment );
			} elseif ( $the_assignment instanceof self ) {
				$this->set_id( absint( $the_assignment->get_id() ) );
			} elseif ( ! empty( $the_assignment->ID ) ) {
				$this->set_id( absint( $the_assignment->ID ) );
			}
			if ( $this->get_id() > 0 ) {
				$this->load();
			}

			self::$_loaded ++;
			if ( self::$_loaded == 1 ) {
				add_filter( 'debug_data', array( __CLASS__, 'log' ) );
			}
		}

		/**
		 * Log debug data.
		 *
		 * @since 3.0.0
		 *
		 * @param $data
		 *
		 * @return array
		 */
		public static function log( $data ) {
			$data[] = __CLASS__ . '( ' . self::$_loaded . ' )';

			return $data;
		}

		/**
		 * @param string $context
		 *
		 * @return string
		 */
		public function get_heading_title( $context = '' ) {
			return $this->get_title( $context );
		}

		/**
		 * Load assignment data.
		 *
		 * @throws Exception
		 */
		public function load() {
			$this->_curd->load( $this );
		}

		/**
		 * Get default assignment meta.
		 *
		 * @since 3.0.0
		 *
		 * @return mixed
		 */
		public static function get_default_meta() {
			$meta = array(
				'duration'          => '3 day',
				'passing_grade'     => 5,
				'retake_count'      => 0,
				'mark'              => 10,
				'upload_file_limit' => 2,
				'upload_files'      => 1,
				'file_extension'    => 'jpg,txt,zip,pdf,doc,docx,ppt'
			);

			return apply_filters( 'learn-press/assignment/default-meta', $meta );
		}

		/**
		 * Save assignment data.
		 *
		 * @return mixed
		 *
		 * @throws Exception
		 */
		public function save() {
			if ( $this->get_id() ) {
				$return = $this->_curd->update( $this );
			} else {
				$return = $this->_curd->create( $this );
			}

			return $return;
		}

		public function set_mark( $mark ) {
			$this->_set_data( 'mark', $mark );
		}

		/**
		 * Set assignment retake count.
		 *
		 * @since 3.0.0
		 *
		 * @param $count
		 */
		public function set_retake_count( $count ) {
			$this->_set_data( 'retake_count', $count );
		}

		/**
		 * @return array|mixed
		 */
		public function get_retake_count() {
			return $this->get_data( 'retake_count' );
		}

		/**
		 * @param $intro
		 */
		public function set_introduction( $intro ) {
			$this->_set_data( 'introduction', $intro );
		}

		/**
		 * @return array|mixed
		 */
		public function get_introduction() {
			return $this->get_data( 'introduction' );
		}

		/**
		 * @param $value
		 */
		public function set_file_extension( $value ) {
			$value = ( $value ) ? $value : 'jpg,doc,png,zip';
			$value = preg_replace( '#\s#', '', $value );
			$this->_set_data( 'file_extension', $value );
		}

		/**
		 * @return array|mixed
		 */
		public function get_file_extension() {
			return $this->get_data( 'file_extension' );
		}

		/**
		 * @param $value
		 */
		public function set_files_amount( $value ) {
			$this->_set_data( 'upload_files', $value );
		}

		/**
		 * @return array|mixed
		 */
		public function get_files_amount() {
			return $this->get_data( 'upload_files' );
		}

		/**
		 * @param $show_result
		 */
		public function set_show_result( $show_result ) {
			$this->_set_data( 'show_result', $show_result );
		}

		/**
		 * @return array|mixed
		 */
		public function get_show_result() {
			return $this->get_data( 'show_result' ) === 'yes';
		}

		/**
		 * @param $value
		 */
		public function set_passing_grade( $value ) {
			$this->_set_data( 'passing_grade', $value );
		}

		/**
		 * @return array|mixed
		 */
		public function get_passing_grade() {
			$value = $this->get_data( 'passing_grade' );

			return $value;
		}

		/**
		 * @param $value
		 */
		public function set_archive_history( $value ) {
			$this->_set_data( 'archive_history', $value );
		}

		/**
		 * Return true if archive history is enabled.
		 *
		 * @return bool
		 */
		public function enable_archive_history() {
			return apply_filters( 'learn-press/assignment/enable-archive-history', $this->get_data( 'archive_history' ) == 'yes', $this->get_id() );
		}

		/**
		 * Return total mark of assignment by calculating total mark of the assignment.
		 *
		 * @return int
		 */
		public function get_mark() {
			$mark = $this->get_data( 'mark' );

			return apply_filters( 'learn-press/assignment-mark', $mark, $this->get_id() );
		}

		/**
		 * Get duration of assignment
		 *
		 * @return LP_Duration
		 */
		public function get_duration() {
			$duration = parent::get_duration();

			return apply_filters( 'learn-press/assignment-duration', $duration, $this->get_id() );
		}

		/**
		 * Get assignment duration html.
		 *
		 * @return mixed
		 */
		public function get_duration_html() {
			$duration = get_post_meta( $this->get_id(), '_lp_duration', true );
			if ( absint( $duration ) > 1 ) {
				$duration .= 's';
			} else {
				$duration = __( 'Unlimited', 'learnpress-assignments' );
			}
			$duration = '<span>' . $duration . '</span>';

			return apply_filters( 'learn_press_assignment_duration_html', $duration, $this );
		}

		/**
		 * Get js localize script in frontend. [NOT USED]
		 *
		 * @return mixed
		 */
		public function get_localize() {
			$localize = array(
				'confirm_finish_assignment' => array(
					'title'   => __( 'Finish assignment', 'learnpress-assignments' ),
					'message' => __( 'Are you sure you want to finish this assignment?', 'learnpress-assignments' )
				),
				'confirm_retake_assignment' => array(
					'title'   => __( 'Retake assignment', 'learnpress-assignments' ),
					'message' => __( 'Are you sure you want to retake this assignment?', 'learnpress-assignments' )
				),
				'assignment_time_is_over'   => array(
					'title'   => __( 'Time\'s up!', 'learnpress-assignments' ),
					'message' => __( 'The time is up! Your assignment will automate come to finish', 'learnpress-assignments' )
				),
				'finished_assignment'       => __( 'Congrats! You have finished this assignment', 'learnpress-assignments' ),
				'retaken_assignment'        => __( 'Congrats! You have re-taken this assignment. Please wait a moment and the page will reload', 'learnpress-assignments' )
			);

			return apply_filters( 'learn_press_single_assignment_localize', $localize, $this );
		}

		/**
		 * __isset function.
		 *
		 * @param mixed $key
		 *
		 * @return bool
		 */
		public function __isset( $key ) {
			return metadata_exists( 'post', $this->get_id(), '_' . $key );
		}

		/**
		 * __get function.
		 *
		 * @param string $key
		 *
		 * @return mixed
		 */
		public function __get( $key ) {
			echo '@deprecated[' . $key . ']';
			learn_press_debug( debug_backtrace() );

			return false;
		}

		/**
		 * @param $feature
		 *
		 * @return mixed
		 * @throws Exception
		 */
		public function has( $feature ) {
			$args = func_get_args();
			unset( $args[0] );
			$method   = 'has_' . preg_replace( '!-!', '_', $feature );
			$callback = array( $this, $method );
			if ( is_callable( $callback ) ) {
				return call_user_func_array( $callback, $args );
			} else {
				throw new Exception( sprintf( __( 'The function %s doesn\'t exist', 'learnpress-assignments' ), $feature ) );
			}
		}

		/**
		 * @param mixed $the_assignment
		 * @param array $args
		 *
		 * @return LP_Assignment|bool
		 */
		public static function get_assignment( $the_assignment = false, $args = array() ) {

			if ( is_numeric( $the_assignment ) && isset( LP_Global::$custom_posts['assignment'][ $the_assignment ] ) ) {
				return LP_Global::$custom_posts['assignment'][ $the_assignment ];
			}

			$the_assignment = self::get_assignment_object( $the_assignment );

			if ( ! $the_assignment ) {
				return false;
			}

			if ( isset( LP_Global::$custom_posts['assignment'][ $the_assignment->ID ] ) ) {
				return LP_Global::$custom_posts['assignment'][ $the_assignment->ID ];
			}

			if ( ! empty( $args['force'] ) ) {
				$force = ! ! $args['force'];
				unset( $args['force'] );
			} else {
				$force = false;
			}
			$key_args = wp_parse_args( $args, array(
				'id'   => $the_assignment->ID,
				'type' => $the_assignment->post_type
			) );

			$key = LP_Helper::array_to_md5( $key_args );

			if ( $force ) {
				LP_Global::$custom_posts['assignment'][ $key ]                = false;
				LP_Global::$custom_posts['assignment'][ $the_assignment->ID ] = false;
			}

			if ( empty( LP_Global::$custom_posts['assignment'][ $key ] ) ) {
				$class_name = self::get_assignment_class( $the_assignment, $args );
				if ( is_string( $class_name ) && class_exists( $class_name ) ) {
					$assignment = new $class_name( $the_assignment->ID, $args );
				} elseif ( $class_name instanceof LP_Course_Item ) {
					$assignment = $class_name;
				} else {
					$assignment = new self( $the_assignment->ID, $args );
				}
				LP_Global::$custom_posts['assignment'][ $key ]                = $assignment;
				LP_Global::$custom_posts['assignment'][ $the_assignment->ID ] = $assignment;
			}

			return LP_Global::$custom_posts['assignment'][ $key ];
		}

		/**
		 * @param  string $assignment_type
		 *
		 * @return string|false
		 */
		private static function get_class_name_from_assignment_type( $assignment_type ) {
			return LP_ASSIGNMENT_CPT === $assignment_type ? __CLASS__ : 'LP_Assignment_' . implode( '_', array_map( 'ucfirst', explode( '-', $assignment_type ) ) );
		}

		/**
		 * Get the lesson class name
		 *
		 * @param  WP_Post $the_assignment
		 * @param  array $args (default: array())
		 *
		 * @return string
		 */
		private static function get_assignment_class( $the_assignment, $args = array() ) {
			$assignment_id = absint( $the_assignment->ID );
			$type          = $the_assignment->post_type;

			$class_name = self::get_class_name_from_assignment_type( $type );

			// Filter class name so that the class can be overridden if extended.
			return apply_filters( 'learn-press/assignment/object-class', $class_name, $type, $assignment_id );
		}

		/**
		 * Get the assignment object
		 *
		 * @param  mixed $the_assignment
		 *
		 * @uses   WP_Post
		 * @return WP_Post|bool false on failure
		 */
		private static function get_assignment_object( $the_assignment ) {
			if ( false === $the_assignment ) {
				$the_assignment = get_post_type() === LP_ASSIGNMENT_CPT ? $GLOBALS['post'] : false;
			} elseif ( is_numeric( $the_assignment ) ) {
				$the_assignment = get_post( $the_assignment );
			} elseif ( $the_assignment instanceof LP_Course_Item ) {
				$the_assignment = get_post( $the_assignment->get_id() );
			} elseif ( ! ( $the_assignment instanceof WP_Post ) ) {
				$the_assignment = false;
			}

			return apply_filters( 'learn-press/assignment/post-object', $the_assignment );
		}

		/**
		 * @param $the_assignment
		 *
		 * @return mixed
		 */
		public function get_attachments_assignment( $the_assignment ) {
			$attachments_id = get_post_meta( $the_assignment->get_id(), '_lp_attachments' );
			if ( isset( $attachments_id[0] ) && is_array( $attachments_id[0] ) ) {
				$attachments_id = $attachments_id[0];
			}

			return $attachments_id;
		}

		/**
		 * Get template name of item.
		 *
		 * @return string
		 */
		/*public function get_template() {
			$item_type = $this->get_item_type();

			//return apply_filters( 'learn-press/section-item-assignment-template', LP_ADDON_ASSIGNMENT_PATH . '/templates/single-course/section/' . 'item-' . str_replace( 'lp_', '', $item_type ), $item_type );
		}*/

		/**
		 * @param mixed $offset
		 */
		public function offsetUnset( $offset ) {
			// Do not allow to unset value directly!
		}
	}
}