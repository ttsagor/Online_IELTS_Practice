<?php
#todo check with empty string
$default_instance = array(
	'text_register' => esc_attr__( 'Register', 'course-builder' ),
	'text_login'    => esc_attr__( 'Login', 'course-builder' ),
	'text_logout'   => esc_attr__( 'Logout', 'course-builder' ),
	'link'          => get_permalink( get_page_by_path( 'account' ) ),
	'shortcode'     => '[wordpress_social_login]',
	'popup'         => false,
);

$instance = array(
	'text_register' => $params['text_register'],
	'text_login'    => $params['text_login'],
	'text_logout'   => $params['text_logout'],
	'link'          => $params['link'],
	'shortcode'     => $params['content'],
	'popup'         => (bool) $params['popup'],
);

$instance = wp_parse_args( (array) $instance, $default_instance);

?>

<div class="thim-sc-login <?php echo esc_attr($params['el_class'])?>">
	<?php
	do_action( 'thim_login_widget_before' );

	the_widget( 'Thim_Login_Widget', $instance );

	do_action( 'thim_login_widget_after' );
	?>
</div>
