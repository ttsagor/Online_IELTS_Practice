<?php
/**
 * Template for displaying change password form in profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/settings/tabs/change-password.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$profile = LP_Profile::instance();
if ( ! isset( $section ) ) {
	$section = 'change-password';
} ?>

<div class="section-wrap">
	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/before-profile-change-password-fields', $profile ); ?>
	<div id="lp-profile-edit-password-form">
		<label class="lp-form-field-label" for="pass0"><?php esc_attr_e( 'Change Password', 'course-builder' ); ?></label>
		<ul class="lp-form-field-wrap">

			<?php
			// @deprecated
//			do_action( 'learn_press_before_' . $section . '_edit_fields' );

			/**
			 * @since 3.0.0
			 */
			do_action( 'learn-press/begin-profile-change-password-fields', $profile );
			?>

			<li class="lp-form-field">
				<div class="lp-form-field-input">
					<input type="password" id="pass0" name="pass0" autocomplete="off" class="regular-text" placeholder="<?php esc_attr_e('Old Password','course-builder') ?>" />
				</div>
			</li>

			<li class="lp-form-field">
				<div class="lp-form-field-input">
					<input type="password" name="pass1" id="pass1" class="regular-text" value="" placeholder="<?php esc_attr_e('New Password','course-builder') ?>"/>
				</div>
			</li>
			<li class="lp-form-field">
				<div class="lp-form-field-input">
					<input name="pass2" type="password" id="pass2" class="regular-text" value="" placeholder="<?php esc_attr_e('Confirm New Password','course-builder') ?>"/>
<!--					<p id="lp-password-not-match" class="description lp-field-error-message hide-if-js">--><?php //esc_html_e( 'New password does not match!', 'course-builder' ); ?><!--</p>-->
				</div>
			</li>

			<?php
			/**
			 * @since 3.0.0
			 */
			do_action( 'learn-press/end-profile-change-password-fields', $profile );

			// @deprecated
//			do_action( 'learn_press_after_' . $section . '_edit_fields' );
			?>

		</ul>
	</div>

	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-profile-change-password-fields', $profile );
	?>

	<p>
		<input type="hidden" name="save-profile-password"
		       value="<?php echo wp_create_nonce( 'learn-press-save-profile-password' ); ?>">
	</p>
</div>