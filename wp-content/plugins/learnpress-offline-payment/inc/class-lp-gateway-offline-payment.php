<?php
/**
 * Offline payment gateway class.
 *
 * @author   ThimPress
 * @package  LearnPress/Offline-Payment/Classes
 * @version  3.0.0
 */

// Prevent loading this file directly
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'LP_Gateway_Offline_Payment' ) ) {
	/**
	 * Class LP_Gateway_Offline_Payment.
	 */
	class LP_Gateway_Offline_Payment extends LP_Gateway_Abstract {

		/**
		 * @var LP_Settings
		 */
		public $settings;

		/**
		 * Instructions for making a payment.
		 *
		 * @var mixed|string
		 */
		public $instructions = '';

		/**
		 * @var string
		 */
		public $id = 'offline-payment';

		/**
		 * Constructor for the gateway.
		 */
		public function __construct() {
			parent::__construct();

			$this->icon               = $this->settings->get( 'icon', LP_Addon_Offline_Payment::instance()->plugin_url( 'assets/images/cod.png' ) );
			$this->method_title       = __( 'Offline Payment', 'learnpress-offline-payment' );
			$this->method_description = __( 'Make a payment with cash.', 'learnpress-offline-payment' );

			// Get settings
			$this->title        = $this->settings->get( 'title', $this->method_title );
			$this->description  = $this->settings->get( 'description', $this->method_description );
			$this->instructions = $this->settings->get( 'instructions' );

			if ( did_action( 'learn_press/offline-payment-add-on/loaded' ) ) {
				return;
			}

			add_action( 'learn-press/order/received', array( $this, 'instructions' ), 99 );
			add_filter( 'learn-press/payment-gateway/' . $this->id . '/available', array(
				$this,
				'offline_payment_available'
			) );

			do_action( 'learn_press/offline-payment-add-on/loaded' );
		}

		/**
		 * Check gateway available.
		 *
		 * @return bool
		 */
		public function offline_payment_available() {
			if ( LP()->settings->get( "{$this->id}.enable" ) != 'yes' ) {
				return false;
			}

			return true;
		}

		/**
		 * Output for the order received page.
		 *
		 * @param $order
		 */
		public function instructions( $order ) {
			if ( $order && ( $this->id == $order->payment_method ) && $this->instructions ) {
				echo stripcslashes( wpautop( wptexturize( $this->instructions ) ) );
			}
		}

		protected function _get( $name ) {
			return LP()->settings->get( $this->id . '.' . $name );
		}

		/**
		 * Admin payment settings.
		 *
		 * @return array
		 */
		public function get_settings() {

			return apply_filters( 'learn-press/gateway-payment/offline-payment/settings',
				array(
					array(
						'title'   => __( 'Enable', 'learnpress-offline-payment' ),
						'id'      => '[enable]',
						'default' => 'no',
						'type'    => 'yes-no'
					),
					array(
						'title'      => __( 'Title', 'learnpress-offline-payment' ),
						'id'         => '[title]',
						'default'    => $this->title,
						'type'       => 'text',
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes'
								),
								array(
									'field'   => '[test_mode]',
									'compare' => '!=',
									'value'   => 'yes'
								)
							)
						)
					),
					array(
						'title'      => __( 'Description', 'learnpress-offline-payment' ),
						'id'         => '[description]',
						'default'    => $this->description,
						'type'       => 'textarea',
						'editor'     => array( 'textarea_rows' => 5 ),
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes'
								),
								array(
									'field'   => '[test_mode]',
									'compare' => '!=',
									'value'   => 'yes'
								)
							)
						)
					),
					array(
						'title'      => __( 'Instructions', 'learnpress-offline-payment' ),
						'id'         => '[instructions]',
						'default'    => '',
						'type'       => 'textarea',
						'editor'     => array( 'textarea_rows' => 10 ),
						'desc'       => __( 'Some instructions to user, e.g: What need to do next in order to complete the order.', 'learnpress-offline-payment' ),
						'visibility' => array(
							'state'       => 'show',
							'conditional' => array(
								array(
									'field'   => '[enable]',
									'compare' => '=',
									'value'   => 'yes'
								),
								array(
									'field'   => '[test_mode]',
									'compare' => '!=',
									'value'   => 'yes'
								)
							)
						)
					)
				)
			);
		}

		/**
		 * Payment form.
		 */
		public function get_payment_form() {
			return LP()->settings->get( $this->id . '.description' );
		}

		/**
		 * Process the payment and return the result
		 *
		 * @param $order_id
		 *
		 * @return array
		 * @throws Exception
		 */
		public function process_payment( $order_id ) {

			$order = learn_press_get_order( $order_id );

			// Mark as processing (payment won't be taken until delivery)
			$order->update_status( 'processing', __( 'Payment to be made upon delivery.', 'learnpress-offline-payment' ) );

			// Remove cart
			LP()->cart->empty_cart();

			// Return thank you redirect
			return array(
				'result'   => 'success',
				'redirect' => $this->get_return_url( $order )
			);
		}
	}
}
