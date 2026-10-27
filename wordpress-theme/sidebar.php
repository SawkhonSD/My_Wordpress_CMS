<?php
/**
 * Sidebar: widget terdaftar, atau komponen bawaan jika belum ada widget.
 *
 * @package Warta_Nusa
 */
?>
<aside class="sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'warta-nusa' ); ?>">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>

		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'Berita Populer', 'warta-nusa' ); ?></h2>
			<?php $popular = warta_nusa_popular_posts( 5 ); ?>
			<?php if ( $popular->have_posts() ) : ?>
				<ul class="popular-list">
					<?php while ( $popular->have_posts() ) : $popular->the_post(); ?>
						<li>
							<div>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								<time datetime="<?php echo esc_attr( get_the_date( DATE_W3C ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
				<?php wp_reset_postdata(); ?>
			<?php endif; ?>
		</section>

		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'Kategori', 'warta-nusa' ); ?></h2>
			<ul><?php wp_list_categories( array( 'title_li' => '', 'show_count' => true ) ); ?></ul>
		</section>

		<section class="widget">
			<h2 class="widget-title"><?php esc_html_e( 'Tag', 'warta-nusa' ); ?></h2>
			<?php wp_tag_cloud( array( 'smallest' => 13, 'largest' => 13, 'unit' => 'px', 'number' => 15 ) ); ?>
		</section>

	<?php endif; ?>
</aside>
