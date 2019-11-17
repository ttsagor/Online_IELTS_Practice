<?php

global $wpdb;

$column  = 'col-md-4';
$columns = empty( $params["columns"] ) ? '2' : $params["columns"];
$column  = 'col-md-' . ( 12 / $columns );

$limit          = empty( $params["limit"] ) ? '4' : $params["limit"];
$text_load_more = empty( $params["text_load_more"] ) ? '' : $params["text_load_more"];
$link_load_more = empty( $params["link_load_more"] ) ? '' : $params["link_load_more"];

$offset         = $params['rank'];


$ARRAY = array('_lp_co_teacher');

$query = $wpdb->prepare( "
	SELECT COUNT( u.ID ) as courses, u . *
	FROM {$wpdb->users} u
	INNER JOIN {$wpdb->postmeta} c ON u.ID = c.meta_value
	WHERE c.meta_key =  %s
	GROUP BY u.ID
	ORDER BY courses DESC LIMIT {$limit} OFFSET {$offset}
", '_lp_co_teacher' );

$instructor = $wpdb->get_results( $query );
$i             = 0;
$class_columns = '';
$row_index     = 1;

$query2            = $wpdb->prepare( "
	SELECT COUNT( u.ID ) as courses, u . *
	FROM {$wpdb->users} u
	INNER JOIN {$wpdb->postmeta} c ON u.ID = c.meta_value
	WHERE c.meta_key =  %s
	GROUP BY u.ID
	ORDER BY courses DESC
", '_lp_co_teacher' );

$instructor2       = $wpdb->get_results( $query2 );
$count_instructors = count( $instructor2 );
$max_page          = intval( $count_instructors / $limit );
if ( ( $count_instructors % $limit ) != 0 ) {
    $max_page = $max_page + 1;
}

echo '<div class="row wrap-teachers columns-'. $params["columns"] .'">';
?>
<?php foreach ( $instructor as $user_id => $course_id ) { ?>
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

	$facebook  = get_the_author_meta( 'lp_info_facebook', $course_id->ID );
	$twitter   = get_the_author_meta( 'lp_info_twitter', $course_id->ID );
	$email     = get_the_author_meta( 'lp_info_google_plus', $course_id->ID );
	$skype     = get_the_author_meta( 'lp_info_skype', $course_id->ID );
	$pinterest = get_the_author_meta( 'lp_info_pinterest', $course_id->ID );
	$major     = get_the_author_meta( 'lp_info_major', $course_id->ID );
	$description     = get_the_author_meta( 'description', $course_id->ID );

	?>

	<div class="item <?php echo esc_attr( $column ); ?> <?php echo esc_attr( $class_columns ); ?>">
		<div class="avatar-item">
			<div class="avatar-instructors">
				<?php

				$image   = get_avatar( $course_id->ID, 680 );
				$pattern = '/src="([^"]*)"/';
				preg_match( $pattern, $image, $matches );
                if ( ! isset($matches[1])) {
                    $matches[1] = null;
                }
				$src        = $matches[1];
				$image_crop = thim_aq_resize( $src, 553, 300, true );
				?>
				<?php if ( $image_crop ) { ?>
						<img src="<?php echo esc_url( $image_crop ); ?>" alt="<?php echo get_the_author_meta( 'display_name', $course_id->ID ); ?>" />
				<?php } else { ?>
						<?php echo $image; ?>
				<?php } ?>
				<div class="avartar-info">
					<h5>
						<a href="<?php echo learn_press_user_profile_link( $course_id->ID ); ?>"><?php echo get_the_author_meta( 'display_name', $course_id->ID ); ?></a>
					</h5>
					<?php echo '<div class="author-major">' . ( isset( $major ) ? $major : esc_attr__( 'Teachers', 'course-builder' ) ) . '</div>'; ?>

					<?php if ( ! empty( $description ) ) : ?>
						<div class="description"><?php echo wp_trim_words( $description, 20 ); ?></div>
					<?php endif; ?>
					<a href="<?php echo learn_press_user_profile_link( $course_id->ID ); ?>"><span><?php echo esc_html__('Read more','course-builder') ?></span><i class="ion-ios-arrow-right"></i></a>

				</div>
			</div>

		</div>
	</div>
	<?php
}
echo '</div>';
if (  $text_load_more != '' ) {
    echo '<div class="view-more"><a href="' . esc_html($link_load_more) . '">' . esc_html($text_load_more) . '<i class="ion-ios-arrow-right"></i></a></div>';
}
?>