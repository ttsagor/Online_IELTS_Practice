<?php

$line_counter  = $params['line_counter'] ? 'has-line' : 'no-line';
$counter_style = $params['counter_style'];

if ( ! $params['el_class'] ) {
	$params['el_class'] = $params['counter_style'];
} else {
	$params['el_class'] .= ' ' . $params['counter_style'];
}

?>
<div class="thim-sc-counter-box <?php echo esc_attr( $params['el_class'] ); ?>" data-line="<?php echo esc_attr( $line_counter ); ?>">
	<?php if ( $params['title'] ) : ?>
		<h3 class="sc-title"><?php echo esc_html( $params['title'] ); ?></h3>
	<?php endif; ?>

	<?php if ( $params['counter_box'] ): ?>
		<?php foreach ( $params['counter_box'] as $counter_box ): ?>
			<?php
			$number_counter_dis = 0;
			$number_counter     = $counter_box['number_counter'] ? intval( $counter_box['number_counter'] ) : 0;

			$style_title     = ! empty( $counter_box['color_title'] ) ? 'color: ' . $counter_box['color_title'] : '';
			$style_icon      = ! empty( $counter_box['color_icon'] ) ? 'color: ' . $counter_box['color_icon'] : '';
			$style_separator = ! empty( $counter_box['color_separator'] ) ? 'background-color: ' . $counter_box['color_separator'] : '';
			$style_number    = ! empty( $counter_box['color_number'] ) ? 'color: ' . $counter_box['color_number'] : '';

			if ( ! empty( $counter_box['color_separator'] ) ) {
				if ( $counter_style == 'style-2' ) {
					$style_separator = 'background-color: ' . $counter_box['color_separator'];
				} else { // style 1
					$style_separator = 'background-image: radial-gradient(circle 5px,' . $counter_box['color_separator'] . ' 12%, transparent 16%)';
				}
			}
			?>
			<div class="counter_box <?php echo esc_attr( $line_counter ); ?>">
				<?php if ( $line_counter == 'has-line' ): ?>
					<span class="separator" style="<?php echo esc_attr( $style_separator ); ?>"></span>
				<?php endif; ?>

				<?php
				switch ( $counter_box['icon'] ) {
					case 'font_awesome':
						if ( ! empty( $counter_box['font_awesome'] ) ) {
							?>
							<div class="icon_counter" style="<?php echo esc_attr( $style_icon ); ?>">
								<i class="icon_counter <?php echo esc_attr( $counter_box['font_awesome'] ) ?>" aria-hidden="true"></i>
							</div>
							<?php
						}
						break;
					case 'font_ionicons':
						if ( ! empty( $counter_box['font_ionicons'] ) ) {
							?>
							<div class="icon_counter" style="<?php echo esc_attr( $style_icon ); ?>">
								<i class="icon_counter <?php echo esc_attr( $counter_box['font_ionicons'] ) ?>" aria-hidden="true"></i>
							</div>
							<?php
						}
						break;
					case 'upload_icon':
						if ( ! empty( $counter_box['icon_upload'] ) ) {
							$icon_upload = wp_get_attachment_image_src( $counter_box['icon_upload'], 'full' );
							echo '<img class="image-upload" src="' . $icon_upload[0] . '">';
						}
						break;
				}
				?>

				<div class="number" style="<?php echo esc_attr( $style_number ); ?>">
					<?php
					if ( $number_counter ) {
						$thousands_sep = ( $counter_style == 'style-2' ) ? 0 : 1;

						$number_counter_output = '';
						if ( ! empty( $counter_box['currency_counter'] ) ) {
							$number_counter_output .= '<span class="currency">' . $counter_box['currency_counter'] . '</span>';
						}

						$number_counter_output .= '<span class="number_counter" data-number="' . $number_counter . '" data-thousands-sep="' . $thousands_sep . '"></span>';

						if ( ! empty( $counter_box['unit'] ) ) {
							$number_counter_output .= '<span class="text-number">' . $counter_box['unit'] . '</span>';
						}

						echo( $number_counter_output );
					}
					?>
				</div>

				<?php if ( ! empty( $counter_box['title_counter'] ) ) : ?>
					<div class="title_counter">
						<h4 class="title" style="<?php echo esc_html( $style_title ); ?>"><?php echo esc_html( $counter_box['title_counter'] ); ?></h4>
					</div>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>