<?php
/**
 * Template for displaying all certificates in course editor.
 *
 * @author  ThimPress
 * @package LearnPress/Admin/Views
 * @since   3.0.0
 */

defined( 'ABSPATH' ) or exit;
global $post;
if ( empty( $post ) ) {
	return;
}
$course_cert  = LP_Certificate::get_course_certificate( $post->ID );
$certificates = LP_Certificate::get_certificates( $course_cert );

?>
<div id="certificate-browser" class="theme-browser">
    <input type="hidden" name="course-certificate" value="<?php echo $course_cert; ?>">
    <div class="themes wp-clearfix">

		<?php if ( $certificates ) { ?>

			<?php foreach ( $certificates as $id ) {

				$certificate = new LP_Certificate( $id );

				?>
                <div class="theme<?php echo $id == $course_cert ? ' active' : ''; ?>" data-id="<?php echo $id; ?>">
                    <div class="theme-screenshot">
                        <img src="<?php echo $certificate->get_preview(); ?>"
                             alt="<?php echo $certificate->get_desc(); ?>">
                    </div>

                    <div class="theme-author">
						<?php echo $certificate->get_author(); ?>
                    </div>
                    <div class="theme-id-container">
                        <h2 class="theme-name" id="twentysixteen-name">
                            <span><?php _e( 'Active:', 'learnpress-certificates' ); ?></span>
							<?php echo $certificate->get_desc(); ?>
                        </h2>

                        <div class="theme-actions">
                            <a class="button button-primary button-remove-certificate"
                               href="">
								<?php esc_html_e( 'Remove', 'learnpress-certificate' ); ?>
                            </a>
                            <a class="button button-primary button-assign-certificate"
                               href="">
								<?php esc_html_e( 'Assign', 'learnpress-certificate' ); ?>
                            </a>
                            <a class="button"
                               target="_blank"
                               href="<?php echo esc_url( admin_url( 'post.php?post=' . $certificate->get_id() . '&action=edit' ) ); ?>">
								<?php esc_html_e( 'Edit', 'learnpress-certificate' ); ?>
                            </a>
                        </div>
                    </div>
                </div>
			<?php } ?>
		<?php } ?>

        <div class="theme add-new-theme">
            <a target="_blank"
               href="<?php echo esc_url( admin_url( 'post-new.php?post_type=' . LP_ADDON_CERTIFICATES_CERT_CPT ) ); ?>">
                <div class="theme-screenshot"><span></span></div>
                <h2 class="theme-name"><?php esc_html_e( 'Add new Certificate', 'learnpress-certificates' ); ?></h2>
            </a>
        </div>
    </div>
</div>
