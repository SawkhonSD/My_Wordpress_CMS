<?php
/**
 * Template utama (fallback) - daftar artikel / halaman blog.
 *
 * @package Warta_Nusa
 */

get_header();
?>
<div class="content-wrap">
	<div class="primary">
		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="archive-header">
				<h1><?php single_post_title(); ?></h1>
			</header>
		<?php else : ?>
			<h2 class="section-title"><?php esc_html_e( 'Berita Terbaru', 'warta-nusa' ); ?></h2>
		<?php endif; ?>

		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content', 'list' );
			endwhile;
			warta_nusa_pagination();
			?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php
get_footer();
