<?php
/**
 * Header Mobile Menu Template
 *
 * @package Thim_Starter_Theme
 */
$login = '';
if ( is_user_logged_in() ) {
	$login = 'logined';
}
?>

<div class="inner-off-canvas">
	<div class="menu-mobile-effect navbar-toggle" data-effect="mobile-effect">
		<span class="thim-mobile-login hidden-lg-up <?php echo esc_attr( $login ) ?>">
		<?php
		$html = '';
		if ( is_user_logged_in() ) {
			$user                 = wp_get_current_user();
			$user_profile_setting = get_edit_user_link();
			$user_avatar          = get_avatar( $user->ID, 45 );
			if ( class_exists( 'LearnPress' ) ) {
				$user_profile_setting = learn_press_user_profile_link( $user->ID, "settings" );
			}
			$html .= '<a href="' . esc_url( $user_profile_setting ) . '" class="user-name">' . ( $user_avatar ) . '</a>';
			$html .= '<span class="menu-item menu-item-log-out">' . '<a href="' . wp_logout_url( apply_filters( 'thim_default_logout_redirect', 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] ) ) . '">' . esc_html( 'Logout' ) . '</a></span>';
		} else {
			$current_page_id = get_queried_object_id();

			$login_redirect_url    = get_theme_mod( 'thim_login_redirect' ) ? get_theme_mod( 'thim_login_redirect' ) : get_permalink( $current_page_id );
			$register_redirect_url = get_theme_mod( 'thim_register_redirect' ) ? get_theme_mod( 'thim_register_redirect' ) : get_permalink( $current_page_id );

			$login_url    = thim_get_login_page_url($login_redirect_url);
			$register_url = thim_get_register_url($register_redirect_url);
			$html         .= '<div class="thim-link-login">';
			if ( get_option( 'users_can_register' )) {
				$html         .= '<a href="' . esc_url( $register_url ) . '" class="register">' . esc_html__( 'Register', 'course-builder' ) . '</a> '.' / ';
            }

            $html         .= '<a href="' . esc_url( $login_url ) . '" class="login">' . esc_html__( 'Login', 'course-builder' ) . '</a>';
		    $html         .= '</div>';

		}
		echo $html;
		?>
	</span>

		<?php esc_html_e( 'Close', 'course-builder' ); ?> <i class="fa fa-times" aria-hidden="true"></i>
	</div>

	<div class="thim-mobile-search-cart <?php if ( ! class_exists( 'WC_Widget_Cart' ) ) {
		echo 'no-cart';
	} ?>">
        <?php
        if ( get_theme_mod( 'search_text_on_header' ) ) {
	        $custom_search = get_theme_mod( 'search_text_on_header' );
        } else {
	        $custom_search = 'What are you looking for ?';
        }
        ?>
		<div class="thim-search-wrapper hidden-lg-up">
            <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
                <input type="search" class="search-field"
                       placeholder="<?php echo esc_attr( $custom_search ) ?>"
                       value="<?php echo get_search_query() ?>" name="s"
                       title="<?php echo esc_attr__( 'Search for:', 'course-builder' ) ?>" />
                <button type="submit" class="search-submit"><span class="ion-android-search"></span></button>
            </form>
		</div>
		<?php if ( class_exists( 'WC_Widget_Cart' ) ) { ?>
			<div class="thim-mini-cart hidden-lg-up">
				<?php the_widget( 'Thim_Custom_WC_Widget_Cart' ); ?>
			</div>
		<?php } ?>
	</div>

	<ul class="nav navbar-nav">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'items_wrap'     => '%3$s'
			) );
		} else {
			echo '<li class="alert alert-danger">';
			echo esc_html__( 'To set which menu will appear, navigate to Appearance > Menus > Manage Locations and set your desired menu in the Primary Menu.', 'course-builder' );
			echo '</li>';
		}
		?>
	</ul>

	<div class="off-canvas-widgetarea">
		<?php dynamic_sidebar( 'off_canvas_menu' ); ?>
	</div>
</div>