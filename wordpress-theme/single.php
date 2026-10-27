<?php
/**
 * Detail artikel (single post).
 *
 * @package Warta_Nusa
 */

get_header();
?>
<div class="content-wrap">
	<div class="primary">
		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'single-article' ); ?>>
				<header class="single-header">
					<?php
					foreach ( get_the_category() as $cat ) {
						printf(
							'<a class="cat-badge" href="%s">%s</a>',
							esc_url( get_category_link( $cat->term_id ) ),
							esc_html( $cat->name )
						);
					}
					?>
					<h1 class="single-title"><?php the_title(); ?></h1>
					<?php warta_nusa_post_meta(); ?>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="single-thumb">
						<?php the_post_thumbnail( 'warta-hero' ); ?>
						<?php
						$caption = get_the_post_thumbnail_caption();
						if ( $caption ) :
							?>
							<figcaption><?php echo esc_html( $caption ); ?></figcaption>
						<?php endif; ?>
					</figure>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages( array(
						'before' => '<p class="page-links">' . esc_html__( 'Halaman:', 'warta-nusa' ),
						'after'  => '</p>',
					) );
					?>
				</div>

				<footer class="entry-footer">
					<?php the_tags( '<div class="tag-list">', '', '</div>' ); ?>
					<div class="share-box">
						<strong><?php esc_html_e( 'Bagikan:', 'warta-nusa' ); ?></strong>
						<?php
						$url   = rawurlencode( get_permalink() );
						$title = rawurlencode( get_the_title() );
						?>
						<a href="<?php echo esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . $url ); ?>" target="_blank" rel="noopener noreferrer">Facebook</a>
						<a href="<?php echo esc_url( 'https://twitter.com/intent/tweet?url=' . $url . '&text=' . $title ); ?>" target="_blank" rel="noopener noreferrer">X</a>
						<a href="<?php echo esc_url( 'https://wa.me/?text=' . $title . '%20' . $url ); ?>" target="_blank" rel="noopener noreferrer">WhatsApp</a>
					</div>
				</footer>
			</article>

			<!-- Kotak penulis -->
			<div class="author-box">
				<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
				<div>
					<h3><?php the_author_posts_link(); ?></h3>
					<p><?php echo esc_html( get_the_author_meta( 'description' ) ? get_the_author_meta( 'description' ) : __( 'Penulis di ', 'warta-nusa' ) . get_bloginfo( 'name' ) . '.' ); ?></p>
				</div>
			</div>

			<!-- Navigasi artikel sebelumnya / berikutnya -->
			<nav class="post-nav" aria-label="<?php esc_attr_e( 'Navigasi artikel', 'warta-nusa' ); ?>">
				<?php
				$prev = get_previous_post();
				$next = get_next_post();
				if ( $prev ) :
					?>
					<a class="prev" href="<?php echo esc_url( get_permalink( $prev ) ); ?>">
						<small>&larr; <?php esc_html_e( 'Sebelumnya', 'warta-nusa' ); ?></small>
						<?php echo esc_html( get_the_title( $prev ) ); ?>
					</a>
				<?php else : ?>
					<span></span>
				<?php endif; ?>
				<?php if ( $next ) : ?>
					<a class="next" href="<?php echo esc_url( get_permalink( $next ) ); ?>">
						<small><?php esc_html_e( 'Berikutnya', 'warta-nusa' ); ?> &rarr;</small>
						<?php echo esc_html( get_the_title( $next ) ); ?>
					</a>
				<?php endif; ?>
			</nav>

			<!-- Berita terkait (kategori sama) -->
			<?php
			$cats    = wp_get_post_categories( get_the_ID() );
			$related = new WP_Query( array(
				'category__in'        => $cats,
				'post__not_in'        => array( get_the_ID() ),
				'posts_per_page'      => 3,
				'ignore_sticky_posts' => true,
				'no_found_rows'       => true,
			) );
			if ( $related->have_posts() ) :
				?>
				<section class="related">
					<h2 class="section-title"><?php esc_html_e( 'Berita Terkait', 'warta-nusa' ); ?></h2>
					<div class="card-grid">
						<?php
						while ( $related->have_posts() ) :
							$related->the_post();
							get_template_part( 'template-parts/content', 'card', array( 'compact' => true ) );
						endwhile;
						wp_reset_postdata();
						?>
					</div>
				</section>
			<?php endif; ?>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		endwhile;
		?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
