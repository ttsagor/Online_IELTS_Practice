<?php
/**
 * Created by lucky boy.
 * User: dong-it
 */

global $post;

$column          = $params['column'];
$gutter          = $params['gutter'];
$item_size       = $params['item_size'];
$paging          = $params['paging'];

// Gutter
if ( $gutter == true ) {
	$class_gutter = " gutter";
} else {
	$class_gutter = "";
}

// Column
if ( $column == '2' ) {
	$class_column = "two-col";
} elseif ( $column == '3' ) {
	$class_column = "three-col";
} elseif ( $column == '4' ) {
	$class_column = "four-col";
} else {
	$class_column = "three-col";
}

// Paging
if ( $paging == 'paging' ) {
	if ( is_front_page() ) {
		$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
	} else {
		$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	}

	$argss = array(
		'post_type' => 'portfolio',
		'paged'     => $paged
	);

} else {
	if ( $paging == 'limit' ) {
		$argss = array(
			'post_type' => 'portfolio'
		);

	} else {
		if ( $paging == 'infinite_scroll' ) {
			if ( is_front_page() ) {
				$paged = ( get_query_var( 'page' ) ) ? get_query_var( 'page' ) : 1;
			} else {
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
			}
			$argss = array(
				'post_type' => 'portfolio',
				'paged'     => $paged
			);
		} else { // show all post
			$argss = array(
				'post_type'      => 'portfolio',
				'posts_per_page' => - 1
			);
		}
	}
}

$gallery = new WP_Query( $argss );
global $portfolio_data;


$number_total = max( $gallery->post_count, $paging );
if ( is_array( $gallery->posts ) && !empty( $gallery->posts ) && $gallery->post_count ) {
	foreach ( $gallery->posts as $gallery_post ) {
		$post_taxs = wp_get_post_terms( $gallery_post->ID, 'portfolio_category', array( "fields" => "all" ) );
		if ( is_array( $post_taxs ) && !empty( $post_taxs ) ) {
			foreach ( $post_taxs as $post_tax ) {
				$portfolio_taxs[urldecode( $post_tax->slug )] = $post_tax->name;
			}
		}
	}
} else {
	exit;
}

?>
<div class="thim-sc-portfolio">
    <div class="wapper_portfolio  <?php echo esc_attr( $class_gutter ); ?> <?php echo esc_attr( $item_size ); ?> <?php echo esc_attr( $paging ); ?>">

        <div class="portfolio-tabs-wapper filters">
            <ul class="portfolio-tabs">
                <li>
                    <a href="#" class="filter active" data-filter="*"><?php echo esc_html__( 'All', 'course-builder' ); ?></a>
                </li>
				<?php foreach ( $portfolio_taxs as $portfolio_tax_slug => $portfolio_tax_name ): ?>
                    <li>
                        <a class="filter" href="#" data-filter=".<?php echo ent2ncr( $portfolio_tax_slug ); ?>"><?php echo ent2ncr( $portfolio_tax_name ); ?></a>
                    </li>
				<?php endforeach; ?>
            </ul>
        </div>

        <div class="portfolio_column">
            <ul class="content_portfolio">
				<?php
				while ( $gallery->have_posts() ): $gallery->the_post();

					$image_crop     = '';
					$feature_images = get_post_meta( get_the_ID(), 'feature_images', true );

					$images_size  = 'portfolio_size11';
					$style_layout = '';

					$class_size = "";
					if ( $item_size == "multigrid" ) {
						if ( $feature_images == 'size11' ) {
							$images_size = 'portfolio_size11';
							$class_size  = "";
						} elseif ( $feature_images == 'size12' ) {
							$images_size = 'portfolio_size12';
							$class_size  = " height_large";
						} elseif ( $feature_images == 'size21' ) {
							$images_size = 'portfolio_size21';
							$class_size  = " item_large";
						} elseif ( $feature_images == 'size22' ) {
							$images_size = 'portfolio_size22';
							$class_size  = " height_large item_large";
						} else {
							$array       = array(
								'portfolio_size11' => 'size11',
								'portfolio_size12' => 'size12',
								'portfolio_size21' => 'size21',
								'portfolio_size22' => 'size22'
							);
							$images_size = array_rand( $array, 1 );
							if ( $images_size == 'portfolio_size11' ) {
								$class_size = "";
							} else {
								if ( $images_size == 'portfolio_size12' ) {
									$class_size = " height_large";
								} else {
									if ( $images_size == 'portfolio_size21' ) {
										$class_size = " item_large";
									} else {
										$class_size = " height_large item_large";
									}
								}
							}
						}
						$class_size = $class_size . " " . $class_column;
					} else {
						if ( $item_size == "masonry" ) {
							$class_size  = "";
							$images_size = "full";

							$class_size = $class_size . " " . $class_column;
						} else {
							//$images_size = 'portfolio_same_size';
							$images_size = 'portfolio_size11';
							$class_size  = $class_size . " " . $class_column;
						}
					}

					$item_classes = '';
					$terms_id     = array();
					$item_cats    = get_the_terms( $post->ID, 'portfolio_category' );
					if ( $item_cats ):
						foreach ( $item_cats as $item_cat ) {
							$item_classes .= $item_cat->slug . ' ';
							$terms_id[] = $item_cat->term_id;
						}
					endif;

					$image_id = get_post_thumbnail_id( $post->ID );
					$imgurl_popup = wp_get_attachment_image_src( $image_id, 'full' );
					$image_crop_popup = aq_resize( $imgurl_popup[0], 800, 640, true );

					if ( $item_size == "masonry" ) {
						$height = null;
						$width  = '600';
						$crop   = ( $height == null ) ? false : true;

						$imgurl = wp_get_attachment_image_src( $image_id, 'full' );

						if ( $image_crop = aq_resize( $imgurl[0], $width, $height, $crop ) ) {
							$imgurl[0] = $image_crop;
						}

						$image_url = '<img src="' . $imgurl[0] . '" alt= ' . get_the_title() . ' title = ' . get_the_title() . ' />';

					} else {
						$crop       = true;
						$dimensions = isset( $portfolio_data['thim_portfolio_option_dimensions'] ) ? $portfolio_data['thim_portfolio_option_dimensions'] : array();
						if ( $images_size == 'portfolio_size11' ) {
							$w = isset( $dimensions['width'] ) ? $dimensions['width'] : '480';
							$h = isset( $dimensions['height'] ) ? $dimensions['height'] : '320';
						} else {
							if ( $images_size == 'portfolio_size12' ) {
								$w = isset( $dimensions['width'] ) ? $dimensions['width'] : '480';
								$h = isset( $dimensions['height'] ) ? ( intval( $dimensions['height'] ) * 2 ) : '640';
							} else {
								if ( $images_size == 'portfolio_size21' ) {
									$w = isset( $dimensions['width'] ) ? ( intval( $dimensions['width'] ) * 2 ) : '960';
									$h = isset( $dimensions['height'] ) ? $dimensions['height'] : '320';
								} else {
									$w = isset( $dimensions['width'] ) ? ( intval( $dimensions['width'] ) * 2 ) : '960';
									$h = isset( $dimensions['height'] ) ? ( intval( $dimensions['height'] ) * 2 ) : '640';
								}
							}
						}
						$imgurl     = wp_get_attachment_image_src( $image_id, 'full' );

						if ( $image_crop = aq_resize( $imgurl[0], $w, $h, $crop ) ) {
							$imgurl[0] = $image_crop;
						}
						//$image_crop = aq_resize( $imgurl[0], $w, $h, $crop );

						if ( $item_size == "multigrid" && $gutter == "on" ) {
							$image_url = '<div class="thumb-img" style="background: url(' . $imgurl[0] . ');background-size: cover;background-repeat: no-repeat;background-position: center center;height: inherit;"><img style="visibility: hidden;" src="' . $imgurl[0] . '" alt= ' . get_the_title() . ' title = ' . get_the_title() . ' /></div>';
						} else {
							$image_url = '<img src="' . $imgurl[0] . '" alt= ' . get_the_title() . ' title = ' . get_the_title() . ' />';
						}
					}

					// check postfolio type
					if ( get_post_meta( get_the_ID(), 'selectPortfolio', true ) == "portfolio_type_1" ) {
						if ( get_post_meta( get_the_ID(), 'style_image_popup', true ) == "Style-01" ) { // prettyPhoto
							$imclass = "image-popup-01";
							if ( get_post_meta( get_the_ID(), 'project_item_slides', true ) != "" ) { //overide image
								$att     = get_post_meta( get_the_ID(), 'project_item_slides', true );
								$imImage = wp_get_attachment_image_src( $att, 'full' );
								$imImage = $imImage[0];
							} else {
								if ( has_post_thumbnail( $post->ID ) ) {// using thumb
									$image   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
									$imImage = $image[0];
								} else {// no thumb and no overide image
									$imclass  = "";
									$imImage  = get_permalink( $post->ID );
								}
							}

						} else { // magnific
							$imclass = "image-popup-02";
							if ( get_post_meta( get_the_ID(), 'project_item_slides', true ) != "" ) {
								$att     = get_post_meta( get_the_ID(), 'project_item_slides', true );
								$imImage = wp_get_attachment_image_src( $att, 'full' );
								$imImage = $imImage[0];
							} else {
								if ( has_post_thumbnail( $post->ID ) ) {

									$image   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
									$imImage = $image[0];
								} else {
									$imclass  = "";
									$imImage  = get_permalink( $post->ID );
								}
							}

						}
					} else {
						if ( get_post_meta( get_the_ID(), 'selectPortfolio', true ) == "portfolio_type_3" ) {
							$imclass = "video-popup";
							if ( get_post_meta( get_the_ID(), 'project_video_embed', true ) != "" ) {

								if ( get_post_meta( get_the_ID(), 'project_video_type', true ) == "youtube" ) {
									$imImage = 'http://www.youtube.com/watch?v=' . get_post_meta( get_the_ID(), 'project_video_embed', true );
								} else {
									if ( get_post_meta( get_the_ID(), 'project_video_type', true ) == "vimeo" ) {
										$imImage = 'https://vimeo.com/' . get_post_meta( get_the_ID(), 'project_video_embed', true );
									}
								}


							} else {
								if ( has_post_thumbnail( $post->ID ) ) {
									$image   = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
									$imImage = $image[0];
								} else {
									$imclass  = "";
									$imImage  = get_permalink( $post->ID );
								}
							}
						} else {
							if ( get_post_meta( get_the_ID(), 'selectPortfolio', true ) == "portfolio_type_2" ) {
								$imclass   = "slider-popup";
								$imImage   = "#" . $post->post_name;
							} else {
								$imclass   = "";
								$imImage   = get_permalink( $post->ID );
							}
						}
					}

					/* end check portfolio type */

					echo '<li class="element-item ' . $item_classes . ' item_portfolio ' . $class_size . $style_layout . '">';
					echo '<div class="portfolio-image">';
					echo '<div class="img-portfolio">' . $image_url . '</div>';
					echo '<div class="portfolio-hover"><div class="thumb-bg"><div class="mask-content">';
					echo '<div class="popup"><a class="view-gallery" href="'. $image_crop_popup .'"><i class="ion-android-add"></i></a></div>';
					echo '<div class="info">';
					echo '<h3><a href="' . esc_url( get_permalink( $post->ID ) ) . '" title="' . esc_attr( get_the_title( $post->ID ) ) . '" >' . get_the_title( $post->ID ) . '</a></h3>';
					$terms    = get_the_terms( $post->ID, 'portfolio_category' );
					$cat_name = "";
					if ( $terms && !is_wp_error( $terms ) ) :
						foreach ( $terms as $term ) {
							if ( $cat_name ) {
								$cat_name .= ', ';
							}
							$cat_name .= '<a href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . "</a>";
						}
						echo '<div class="cat_portfolio">' . $cat_name . '</div>';
					endif;
					echo '</div></div></div></div></div>';
					echo '</li>';
					?>

				<?php endwhile;
				wp_reset_postdata();
				?>
            </ul>
			<?php
			if ( $paging == 'paging' ) {
				portfolio_pagination( $gallery->max_num_pages, $range = 2, $paged );
			}

			if ( $paging == 'infinite_scroll' ) {
				portfolio_pagination( $gallery->max_num_pages, $range = 2, $paged );
			}
			?>
        </div>
    </div>
</div>