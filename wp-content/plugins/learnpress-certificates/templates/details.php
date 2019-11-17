<?php
/**
 * Template for displaying certificate in user profile.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/certificates/details.php.
 *
 * @package LearnPress/Templates/Certificates
 * @author  ThimPress
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or die();

if ( ! isset( $certificate ) ) {
	return;
}

$template_id = $certificate->get_uni_id();
?>
<div class="certificate">
	<?php
	do_action( 'learn-press/certificates/before-certificate-content', $certificate );
	?>
    <div id="<?php echo $template_id; ?>" class="certificate-preview">
        <div class="certificate-preview-inner">
            <img class="cert-template" src="<?php echo $certificate->get_template(); ?>">
            <canvas></canvas>
        </div>
    </div>
	<?php
	do_action( 'learn-press/certificates/after-certificate-content', $certificate );
	?>
    <script type="text/javascript">

        jQuery(function ($) {
            window.certificates = window.certificates || [];
            window.certificates.push(new LP_Certificate('#<?php echo $template_id;?>', <?php echo $certificate;?>));
        })

    </script>
</div>

