<?php
/**
 * Halaman utama: hero berita utama, berita terbaru, dan blok per kategori.
 *
 * @package Warta_Nusa
 */

get_header();

// 1. Hero: 3 berita terbaru (utama + 2 samping).
$hero = new WP_Query( array(
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => false,
	'no_found_rows'       => true,
) );

$hero_ids = array();
?>

<?php if ( $hero->have_posts() ) : ?>
	<section class="hero" aria-label="<?php esc_attr_e( 'Berita utama', 'warta-nusa' ); ?>">
		<?php
		$i = 0;
		while ( $hero->have_posts() ) :
			$hero->the_post();
			$hero_ids[] = get_the_ID();
			$i++;

			if ( 1 === $i ) :
				?>
				<article class="hero-main">
					<div class="hero-media"><?php warta_nusa_thumbnail( 'warta-hero' ); ?></div>
					<div class="hero-overlay">
						<?php warta_nusa_category_badge(); ?>
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<?php warta_nusa_post_meta(); ?>
					</div>
				</article>
				<div class="hero-side">
			<?php else : ?>
				<article class="hero-side-item">
					<div class="hero-media"><?php warta_nusa_thumbnail( 'warta-card' ); ?></div>
					<div class="hero-overlay">
						<?php warta_nusa_category_badge(); ?>
						<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php warta_nusa_post_meta( false ); ?>
					</div>
				</article>
			<?php endif; ?>
		<?php endwhile; ?>
		<?php if ( $i >= 1 ) : ?>
			</div><!-- .hero-side -->
		<?php endif; ?>
	</section>
	<?php wp_reset_postdata(); ?>
<?php endif; ?>

<div class="content-wrap">
	<div class="primary">

		<!-- 2. Berita terbaru -->
		<section class="section-block">
			<h2 class="section-title"><?php esc_html_e( 'Berita Terbaru', 'warta-nusa' ); ?></h2>
			<?php
			$latest = new WP_Query( array(
				'posts_per_page'      => 6,
				'post__not_in'        => $hero_ids,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			) );
			?>
			<?php if ( $latest->have_posts() ) : ?>
				<div class="card-grid two-col">
					<?php
					while ( $latest->have_posts() ) :
						$latest->the_post();
						get_template_part( 'template-parts/content', 'card' );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>
			<?php
			$posts_page = get_option( 'page_for_posts' );
			$all_url    = $posts_page ? get_permalink( $posts_page ) : home_url( '/?s=' );
			?>
			<p style="margin-top:24px;text-align:center">
				<a class="button" href="<?php echo esc_url( $all_url ); ?>"><?php esc_html_e( 'Lihat Semua Berita', 'warta-nusa' ); ?></a>
			</p>
		</section>

		<!-- 3. Blok per kategori (3 kategori dengan artikel terbanyak) -->
		<?php
		$categories = get_categories( array(
			'orderby'    => 'count',
			'order'      => 'DESC',
			'number'     => 3,
			'hide_empty' => true,
		) );
		foreach ( $categories as $cat ) :
			$cat_query = new WP_Query( array(
				'cat'                 => $cat->term_id,
				'posts_per_page'      => 3,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			) );
			if ( ! $cat_query->have_posts() ) {
				continue;
			}
			?>
			<section class="section-block">
				<h2 class="section-title">
					<a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
				</h2>
				<div class="card-grid">
					<?php
					while ( $cat_query->have_posts() ) :
						$cat_query->the_post();
						get_template_part( 'template-parts/content', 'card', array( 'compact' => true ) );
					endwhile;
					wp_reset_postdata();
					?>
				</div>
			</section>
		<?php endforeach; ?>

	</div>
	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
