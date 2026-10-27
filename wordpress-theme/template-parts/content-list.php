<?php
/**
 * Item artikel horizontal (arsip, blog, pencarian).
 *
 * @package Warta_Nusa
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'list-item' ); ?>>
	<a class="card-thumb" href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
		<?php warta_nusa_thumbnail( 'warta-card' ); ?>
	</a>
	<div class="card-body">
		<div style="margin-bottom:10px"><?php warta_nusa_category_badge(); ?></div>
		<h2 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<p class="card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 30, '&hellip;' ) ); ?></p>
		<?php warta_nusa_post_meta(); ?>
	</div>
</article>
