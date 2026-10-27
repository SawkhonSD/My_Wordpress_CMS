<?php
/**
 * Arsip: kategori, tag, penulis, tanggal.
 *
 * @package Warta_Nusa
 */

get_header();
?>
<div class="content-wrap">
	<div class="primary">
		<header class="archive-header">
			<?php the_archive_title( '<h1>', '</h1>' ); ?>
			<?php the_archive_description( '<p class="archive-desc">', '</p>' ); ?>
		</header>

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
