<article id="tp_event-<?php the_ID(); ?>" <?php post_class( 'tp_single_event' ); ?>>

	<?php
	/**
	 * tp_event_single_event_thumbnail hook
	 */
	do_action( 'tp_event_single_event_thumbnail' );

	?>


	<div class="summary entry-summary">
		<div class="sticky-sidebar">
			<?php thim_social_share( 'event_' ); ?>
		</div>
		<div class="entry-right">
			<?php
			/**
			 * tp_event_before_single_event hook
			 *
			 */
			do_action( 'tp_event_before_single_event' );

			/**
			 * tp_event_loop_event_countdown hook
			 */
			do_action( 'tp_event_loop_event_countdown' );

			/**
			 * tp_event_single_event_content hook
			 */
			do_action( 'tp_event_single_event_content' );

			/**
			 * tp_event_loop_event_location hook
			 */
			do_action( 'tp_event_loop_event_location' );

			?>
		</div>
	</div><!-- .summary -->


</article><!-- #product-<?php the_ID(); ?> -->