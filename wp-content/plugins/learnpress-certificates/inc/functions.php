<?php
/**
 * @param string $template_name
 * @param array  $args
 */
function learn_press_certificate_get_template( $template_name, $args = array() ) {
	learn_press_get_template( $template_name, $args, learn_press_template_path() . '/addons/certificates/', LP_ADDON_CERTIFICATES_PATH . '/templates/' );
}

/**
 * @param string $template_name
 * @param array  $args
 *
 * @return string
 */
function learn_press_certificate_locate_template( $template_name ) {
	return learn_press_locate_template( $template_name, learn_press_template_path() . '/addons/certificates/', LP_ADDON_CERTIFICATES_PATH . '/templates/' );
}

function learn_press_certificates_button_download( $certificate ) {
	learn_press_certificate_get_template( 'buttons/download.php', array( 'certificate' => $certificate ) );
}

/**
 * @param LP_User_Certificate $certificate
 */
function learn_press_certificates_buttons( $certificate ) {

	if ( $socials = LP()->settings->get( 'certificates.socials' ) ) {

		$socials   = array_flip( $socials );
		$permalink = $certificate->get_permalink( '' );
		$text      = $certificate->get_title();

		foreach ( $socials as $k => $v ) {
			ob_start();
			switch ( $k ) {
				case 'twitter':
					?>
                    <a href="http://twitter.com/share" data-count="none" class="twitter-share-button" lang="en"
                       data-url="<?php echo esc_url( $permalink ); ?>"
                       data-text="<?php echo esc_attr( $text ); ?>"></a>
                    <script type="text/javascript">jQuery.getScript('https://platform.twitter.com/widgets.js')</script>
					<?php
					break;
				case 'facebook':
					?>
                    <div class="fb-like" href="<?php echo esc_url( $permalink ); ?>" width="180" send="false"
                         showfaces="false" action="like" data-share="true" data-layout="button"></div>
                    <script type="text/javascript">LP_Certificate.loadJs('//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5')</script>
					<?php
					break;
				case 'plusone':
					?>
                    <div class="g-plusone" data-href="<?php echo esc_url( $permalink ); ?>" data-size="medium"
                         data-annotation="none">
                    </div>
                    <script type="text/javascript">LP_Certificate.loadJs('https://apis.google.com/js/plusone.js')</script>
					<?php
					break;
			}
			$socials[ $k ] = ob_get_clean();
		}
	}
	learn_press_certificate_get_template( 'buttons.php',
		array(
			'socials'     => $socials,
			'certificate' => $certificate
		)
	);
}

add_action( 'learn-press/certificates/after-certificate-content', 'learn_press_certificates_buttons', 10 );