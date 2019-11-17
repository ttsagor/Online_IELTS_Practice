<?php
/**
 * Template for displaying download button.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/addons/certificates/buttons.php.
 *
 * @author  ThimPress
 * @package LearnPress/Templates/Certificates
 * @cersion 3.0.0
 */

defined( 'ABSPATH' ) or die();

if ( ! isset( $certificate ) ) {
	return;
}
?>

<ul class="certificate-actions">
    <li class="download">
        <a href=""
           data-cert="<?php echo $certificate->get_uni_id(); ?>" data-type="jpg"></a>
    </li>
	<?php if ( $socials ) {
		foreach ( $socials as $social ) { ?>
            <li>
				<?php echo $social; ?>
            </li>
		<?php }
	} ?>
</ul>

