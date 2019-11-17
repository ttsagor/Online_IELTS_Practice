<?php
global $wpdb;

$column  = 'col-md-4';
$columns = empty( $params["columns"] ) ? '3' : $params["columns"];
$column  = 'col-md-' . ( 12 / $columns );

$limit          = empty( $params["limit"] ) ? '9' : $params["limit"];
$text_load_more = empty( $params["text_load_more"] ) ? '' : $params["text_load_more"];
$offset         = $params['rank'];

$blog_id = '';
$capabilities = $wpdb->prefix.'capabilities';
if(is_multisite()) {
    $blog_id = get_current_blog_id();
    if($blog_id != 1) {
        $capabilities = 'wp_'. $blog_id . '_capabilities';
    }
}
$ARRAY = array('%lp_teacher%','%administrator%');

$query = $wpdb->prepare( "
	SELECT *
	FROM {$wpdb->usermeta}
	 WHERE meta_value LIKE %s OR meta_value LIKE %s
	AND meta_key = '{$capabilities}'
	ORDER BY user_id
", $ARRAY );


$instructor = $wpdb->get_results( $query );
$i             = 0;
$class_columns = '';
$row_index     = 1;

$query2 = $wpdb->prepare( "
	SELECT *
	FROM {$wpdb->usermeta}
	 WHERE meta_value LIKE %s OR meta_value LIKE %s
	AND meta_key = '{$capabilities}'
	ORDER BY user_id
", $ARRAY);

$instructor2       = $wpdb->get_results( $query2 );
$count_instructors = count( $instructor2 );
$max_page          = intval( $count_instructors / $limit );
if ( ( $count_instructors % $limit ) != 0 ) {
    $max_page = $max_page + 1;
}

echo '<div class="row wrap-teachers">';
?>
<?php foreach ( $instructor as $key => $user ) { ?>
    <?php
    $i ++;
    if ( ( $i - 1 ) % $columns == 0 ) {
        $class_columns = 'first';
    } else {
        $class_columns = 'last';
    }
    if ( $i > $limit ) {
        break;
    }

    if ( $row_index > 1 && ( $row_index - 1 ) % $columns == 0 ) {
        echo '<div class="row wrap-teachers">';
    }

    $facebook  = get_the_author_meta( 'lp_info_facebook', $user->user_id );
    $twitter   = get_the_author_meta( 'lp_info_twitter', $user->user_id );
    $email     = get_the_author_meta( 'lp_info_google_plus', $user->user_id );
    $skype     = get_the_author_meta( 'lp_info_skype', $user->user_id );
    $pinterest = get_the_author_meta( 'lp_info_pinterest', $user->user_id );
    $major     = get_the_author_meta( 'lp_info_major', $user->user_id );
    $description     = get_the_author_meta( 'description', $user->user_id );
    ?>

    <div class="item <?php echo esc_attr( $column ); ?> <?php echo esc_attr( $class_columns ); ?>">
        <div class="avatar-item">
            <div class="avatar-instructors">
                <?php
                $image   = get_avatar( $user->user_id, 500 );
                $pattern = '/src="([^"]*)"/';
                preg_match( $pattern, $image, $matches );
                if ( ! isset($matches[1])) {
                    $matches[1] = null;
                }
                $src        = $matches[1];
                $image_crop = thim_aq_resize( $src, 495, 323, true );
                ?>
                <?php if ( $image_crop ) { ?>
                    <a class="avatar" href="<?php echo learn_press_user_profile_link( $user->user_id ); ?>">
                        <img src="<?php echo esc_url( $image_crop ); ?>" alt="<?php echo get_the_author_meta( 'display_name', $user->user_id ); ?>" />
                    </a>
                <?php } else { ?>
                    <a class="avatar-small" href="<?php echo learn_press_user_profile_link( $user->user_id ); ?>">
                        <?php echo $image; ?>
                    </a>
                <?php } ?>
                <div class="author-social">
                    <?php
                    if ( $facebook ) {
                        echo '<a href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a>';
                    }
                    if ( $twitter ) {
                        echo '<a href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a>';
                    }
                    if ( $skype ) {
                        echo '<a href="skype:' . esc_attr( $skype ) . '?call"><i class="fa fa-skype"></i></a>';
                    }
                    if ( $pinterest ) {
                        echo '<a href="' . esc_url( $pinterest ) . '"><i class="fa fa-pinterest"></i></a>';
                    }
                    if ( $email ) {
                        echo '<a href="mailto:' . esc_attr( $email ) . '"><i class="fa fa-google-plus"></i></a>';
                    }
                    ?>
                </div>
            </div>
            <div class="avartar-info">
                <h5>
                    <a href="<?php echo learn_press_user_profile_link( $user->user_id ); ?>"><?php echo get_the_author_meta( 'display_name', $user->user_id ); ?></a>
                </h5>
                <?php echo '<div class="author-major">' . ( isset( $major ) ? $major : esc_attr__( 'Teachers', 'course-builder' ) ) . '</div>'; ?>
                <?php if ( ! empty( $description ) ) : ?>
                    <div class="description"><?php echo $description; ?></div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    if ( $row_index > 1 && $row_index % $columns == 0 ) {
        echo '</div>';
    }
    $row_index ++;
}
echo '</div>';
?>
