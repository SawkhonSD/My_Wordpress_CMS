<?php
/**
 * Halaman statis.
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
					<h1 class="single-title"><?php the_title(); ?></h1>
				</header>
				<?php if ( has_post_thumbnail() ) : ?>
					<figure class="single-thumb"><?php the_post_thumbnail( 'warta-hero' ); ?></figure>
				<?php endif; ?>
				<div class="entry-content">
					<?php
					the_content();
					wp_link_pages();
					?>
				</div>
			</article>
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
