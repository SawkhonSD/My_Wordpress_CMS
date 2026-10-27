<?php
/**
 * Kartu artikel (grid).
 *
 * @package Warta_Nusa
 */

$compact = ! empty( $args['compact'] );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'card' ); ?>>
	<a class="card-thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php warta_nusa_thumbnail( 'warta-card' ); ?>
	</a>
	<div class="card-body">
		<div style="margin-bottom:10px"><?php warta_nusa_category_badge(); ?></div>
		<h3 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php if ( ! $compact ) : ?>
			<p class="card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24, '&hellip;' ) ); ?></p>
		<?php endif; ?>
		<?php warta_nusa_post_meta( ! $compact ); ?>
	</div>
</article>
