<?php
while ( have_posts() ) : the_post(); ?>
	<?php learn_press_get_template( 'content-single-course.php' ); ?>
	<?php
	// If comments are open or we have at least one comment, load up the comment template
	if ( comments_open() || '0' != get_comments_number() ) :
		//	comments_template();
	endif;
	?>
<?php endwhile; // end of the loop. ?>
