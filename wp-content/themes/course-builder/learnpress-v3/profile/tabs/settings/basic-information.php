<?php
/**
 * Template for displaying editing basic information form of user in profile page.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/settings/tabs/basic-information.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

if ( ! isset( $section ) ) {
	$section = 'basic-information';
}

$major  = ! empty( $user_meta['lp_info_major'] ) ? $user_meta['lp_info_major'] : '';
$status = ! empty( $user_meta['lp_info_status'] ) ? $user_meta['lp_info_status'] : '';
?>
<div class="section-wrap">
	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/before-profile-basic-information-fields', $profile );

	?>
	<ul class="lp-form-field-wrap">

		<?php
		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/begin-profile-basic-information-fields', $profile );
		?>

		<li class="lp-form-field">
			<label class="lp-form-field-label" for="display_name"><?php esc_html_e( 'Name', 'course-builder' ); ?></label>
			<div class="lp-form-field-input">
				<input type="text" name="display_name" id="display_name" value="<?php echo esc_attr( $user->get_display_name() ); ?>" class="regular-text" />
			</div>
		</li>

		<li class="lp-form-field">
			<label class="lp-form-field-label" for="lp_info_major"><?php esc_html_e( 'Job - Major', 'course-builder' ); ?></label>
			<div class="lp-form-field-input">
				<input type="text" name="lp_info_major" id="lp_info_major" value="<?php echo esc_attr( $major ) ?>" class="regular-text" />
			</div>
		</li>

		<li class="lp-form-field">
			<label class="lp-form-field-label" for="description"><?php esc_html_e( 'About', 'course-builder' ); ?></label>
			<div class="lp-form-field-input">
				<textarea name="description" id="description" rows="5" cols="30"><?php echo esc_html( $user->get_description() ); ?></textarea>
			</div>
		</li>

		<li class="lp-form-field">
			<label class="lp-form-field-label" for="lp_info_status"><?php esc_html_e( 'Status', 'course-builder' ); ?></label>
			<div class="lp-form-field-input">
				<textarea name="lp_info_status" id="lp_info_status" rows="3" cols="30"><?php echo esc_html( $status ); ?></textarea>
			</div>
		</li>

		<?php
		/**
		 * @since 3.0.0
		 */
		do_action( 'learn-press/end-profile-basic-information-fields', $profile );

		?>
	</ul>

	<?php
	/**
	 * @since 3.0.0
	 */
	do_action( 'learn-press/after-profile-basic-information-fields', $profile );
	?>
	<input type="hidden" name="save-profile-basic-information" value="<?php echo wp_create_nonce( 'learn-press-save-profile-basic-information' ); ?>" />
</div>
