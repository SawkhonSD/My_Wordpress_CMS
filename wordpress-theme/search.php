<?php
/**
 * Hasil pencarian.
 *
 * @package Warta_Nusa
 */

get_header();
?>
<div class="content-wrap">
	<div class="primary">
		<header class="archive-header">
			<h1>
				<?php
				/* translators: %s: kata kunci */
				printf( esc_html__( 'Hasil pencarian: %s', 'warta-nusa' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
				?>
			</h1>
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
