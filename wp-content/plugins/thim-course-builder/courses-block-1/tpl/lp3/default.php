<?php
/**
 * Template for displaying Course block 2 shortcode for Learnpress v3.
 *
 * @author  ThimPress
 * @package Course Builder/Templates
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

/**
 * Extract $params to parameters
 * @var $list_courses
 * @var $cat_courses
 * @var $featured_courses
 */
extract( $params );

$cat_courses      = isset( $cat_courses ) ? $cat_courses : '';
$featured_courses = empty( $featured_courses ) ? '' : $featured_courses;

if ( $cat_courses ) {
	$tax_query_value = array(
		array(
			'taxonomy' => 'course_category',
			'field'    => 'slug',
			'terms'    => $cat_courses,
		)
	);
} else {
	$tax_query_value = '';
}

$args_list_courses = array(
	'posts_per_page' => 4,
	'post_type'      => 'lp_course',
	'post_status'    => 'publish',
	'tax_query'      => $tax_query_value,
);

if ( $list_courses === 'latest' ) {
	$args_list_courses['orderby'] = 'date';
}

if ( $list_courses == 'popular' ) {
	$args_list_courses['post__in'] = lp_get_courses_popular();
}

// Get featured courses
if ( $featured_courses != '' ) {
	$args_list_courses['meta_query'] = array(
		array(
			'key'   => '_lp_featured',
			'value' => 'yes',
		)
	);
}

$query_list_courses = new WP_Query( $args_list_courses );
$first_post         = true;

if ( $query_list_courses->have_posts() ) : ?>
    <div class="thim-block-1">
		<?php while ( $query_list_courses->have_posts() ): $query_list_courses->the_post(); ?>
			<?php $course_id = get_the_ID(); ?>
			<?php if ( ! $first_post ) : ?>

                <div class="course-item">


                    <div class="feature-img">

						<?php thim_thumbnail( $course_id, '138x161', 'post', false ) ?>

                        <div class="wrap-author">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), 40 ); ?>
                            <span class="name">
								<a href="<?php echo esc_url( learn_press_user_profile_link( $query_list_courses->post->post_author ) ); ?>">
									<?php echo get_the_author(); ?>
								</a>
							</span>
                            <div class="sc-review-stars">
								<?php
								$course_id = get_the_ID();
								if ( function_exists( 'learn_press_get_course_rate' ) ) {
									$course_rate = learn_press_get_course_rate( $course_id );
									learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );
								}
								?>
                            </div>
                        </div>

                    </div>

                    <div class="course-detail">
                        <h3 class="title">
                            <a href="<?php echo esc_url( get_the_permalink() ) ?>"><?php echo esc_html( get_the_title() ) ?></a>
                        </h3>

                        <div class="meta">
							<?php
							$course            = new LP_Course( $course_id );
							// course curd
							$curd = new LP_Course_CURD();
							$students_enrolled_real      = sizeof($curd->get_user_enrolled($course_id, -1));

							$students_enrolled_fake = get_post_meta($course_id, '_lp_students', true) ? intval(get_post_meta($course_id, '_lp_students', true)) : 0;

							$students_enrolled = apply_filters('thim_number_students_enrolled', $students_enrolled_real + $students_enrolled_fake);
							$course_price = LP_Global::course();
							$price             = $course_price->get_price_html();
							?>
                            <span class="number-students">
	                                    <?php
	                                    if ( $students_enrolled ) {
		                                    echo esc_html( $students_enrolled ) . esc_html__( ' Students', 'course-builder' );
	                                    } else {
		                                    echo esc_html( $students_enrolled ) . esc_html__( ' Student', 'course-builder' );
	                                    }
	                                    ?>
                                    </span>

							<?php
							$price_class = $course_price->is_free() ? 'free' : '';
							global  $post;
							$course_pri      = LP_Course::get_course( $post->ID );
							$is_required = $course_pri->is_required_enroll();

							if ( $course_pri->is_free() || ! $is_required ) :
                                echo '<span class="price ' . $price_class . '">'. esc_html__( 'Free', 'course-builder' ). '</span>';
                            else:
	                            echo '<span class="price ' . $price_class . '">' . $price . '</span>';
                            endif;

							?>
                        </div>

                    </div>

                </div>

			<?php else: $first_post = false; ?>

                <div class="main-course">
					<?php
					$video_src = get_post_meta( $course_id, 'thim_course_media' );
					?>

                    <div class="featured-img">
                        <span class="course-label"><?php esc_html_e( 'new', 'course-builder' ) ?></span>
						<?php
						thim_thumbnail( $course_id, '1012x562', 'post', false );
						?>

                        <div class="content-video">
							<?php if ( $video_src ): ?>
                                <span class="ion-ios-play-outline"
                                      data-mfp-src="<?php echo esc_attr( $video_src[0] ); ?>"></span>
							<?php endif; ?>

                            <h3 class="title">
                                <a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo esc_html( get_the_title() ); ?></a>
                            </h3>
                            <p class="description"><?php echo esc_html( get_the_excerpt() ); ?></p>
                        </div>
                    </div>
                </div>

			<?php endif; ?>
		<?php endwhile; ?>
    </div>
<?php endif; ?>
<?php wp_reset_postdata();