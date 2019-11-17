<?php
/**
 * Template for displaying user's BIO in profile.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

defined( 'ABSPATH' ) or die();

$profile = LP_Profile::instance();
$user    = $profile->get_user();


$user_meta = get_user_meta( $user->get_id() );
$user_meta = array_map( function ( $a ) {
	return $a[0];
}, $user_meta );

?>
<div class="user-status">
	<?php if ( ! empty( $user_meta['lp_info_status'] ) ) : ?>
        <div class="content"><?php echo( $user_meta['lp_info_status'] ); ?></div>
	<?php endif; ?>
</div>

