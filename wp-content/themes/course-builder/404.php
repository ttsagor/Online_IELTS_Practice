<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */
?>

<section class="error-404 not-found">
	<div class="page-content">
		<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/404.png' ); ?>" alt="><?php esc_html_e( 'Page not found!', 'course-builder' ); ?>" />
		<h3 class="intro"><?php esc_html_e( 'Page not found!', 'course-builder' ); ?></h3>
		<p class="404-message"><?php echo wp_kses( sprintf( __( "Sorry, we can't find the page you are looking for. Please go to  <a href='%s'>Home.</a>", 'course-builder' ), esc_url( home_url( '/' ) ) ), array(
				'a' => array(
					'href'  => array(),
					'title' => array()
				)
			) ); ?></p>
	</div><!-- .page-content -->
</section><!-- .error-404 -->