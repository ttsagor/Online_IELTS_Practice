<?php
/**
 * Template for displaying user profile cover image.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/profile/profile-cover.php.
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
$user    = $profile->get_user();


$user_meta = get_user_meta( $user->get_id() );
$user_meta = array_map( function ( $a ) {
	return $a[0];
}, $user_meta );

	?>
	<div class="list-contact">
		<?php if ( ! empty( $user_meta['lp_info_phone'] ) ): ?>
			<div class="item">
				<a class="contact-icon" href="tel:<?php echo esc_attr( $user_meta['lp_info_phone'] ); ?>" title="<?php esc_attr_e( 'Phone', 'course-builder' ) ?>"><i class="fa fa-phone"></i></a>
				<div class="contact-content">
					<div class="title"><?php esc_html_e( 'Phone Number', 'course-builder' ) ?></div>
					<a href="tel:<?php echo esc_attr( $user_meta['lp_info_phone'] ); ?>"><?php echo esc_html( $user_meta['lp_info_phone'] ); ?></a>
				</div>
			</div>
		<?php endif; ?>

		<div class="item">
			<a class="contact-icon" href="mailto:<?php echo esc_attr( $user->get_email() ); ?>" title="<?php esc_attr_e( 'Email', 'course-builder' ) ?>"><i class="fa fa-envelope-o"></i></a>
			<div class="contact-content">
				<div class="title"><?php esc_html_e( 'Email', 'course-builder' ) ?></div>
				<a href="mailto:<?php echo esc_attr( $user->get_email() ); ?>"><?php echo esc_html( $user->get_email() ); ?></a>
			</div>
		</div>

		<?php if ( ! empty( $user_meta['lp_info_skype'] ) ): ?>
			<div class="item">
				<a class="contact-icon" href="skype:<?php echo $user_meta['lp_info_skype']; ?>?call" title="<?php esc_attr_e( 'Skype', 'course-builder' ) ?>"><i class="fa fa-skype"></i></a>
				<div class="contact-content">
					<div class="title"><?php esc_html_e( 'Skype', 'course-builder' ) ?></div>
					<a href="skype:<?php echo esc_attr( $user_meta['lp_info_skype'] ); ?>?call"><?php echo esc_html( $user_meta['lp_info_skype'] ); ?></a>
				</div>
			</div>
		<?php endif; ?>
	</div>

<div class="info-general">
	<div class="avatar">
		<?php
		echo( $user->get_profile_picture( null, '496' ) ); ?>
	</div>

	<div class="biographical">
		<h4 class="title"><?php esc_html_e( 'About', 'course-builder' ) ?></h4>
		<?php if ( ! empty( $user_meta['description'] ) ) : ?>
			<div class="content"><?php echo( $user_meta['description'] ); ?></div>
		<?php endif; ?>
	</div>
</div>



