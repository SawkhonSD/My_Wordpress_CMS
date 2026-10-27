<?php
/**
 * Footer.
 *
 * @package Warta_Nusa
 */
?>
	</div><!-- .container -->
</main><!-- #content -->

<footer class="site-footer">
	<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
		<div class="container footer-widgets">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<div class="footer-col">
					<?php dynamic_sidebar( 'footer-' . $i ); ?>
				</div>
			<?php endfor; ?>
		</div>
	<?php else : ?>
		<div class="container footer-widgets">
			<section class="widget">
				<h2 class="widget-title"><?php bloginfo( 'name' ); ?></h2>
				<p><?php echo esc_html( get_bloginfo( 'description' ) ? get_bloginfo( 'description' ) : __( 'Portal berita terpercaya, cepat, dan berimbang.', 'warta-nusa' ) ); ?></p>
			</section>
			<section class="widget">
				<h2 class="widget-title"><?php esc_html_e( 'Kategori', 'warta-nusa' ); ?></h2>
				<ul><?php wp_list_categories( array( 'title_li' => '', 'number' => 6, 'orderby' => 'count', 'order' => 'DESC' ) ); ?></ul>
			</section>
			<section class="widget">
				<h2 class="widget-title"><?php esc_html_e( 'Arsip', 'warta-nusa' ); ?></h2>
				<ul><?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 6 ) ); ?></ul>
			</section>
		</div>
	<?php endif; ?>

	<div class="footer-bottom">
		<div class="container">
			<span>
				&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
				<?php esc_html_e( 'Hak cipta dilindungi.', 'warta-nusa' ); ?>
				<?php esc_html_e( 'Tema Warta Nusa.', 'warta-nusa' ); ?>
			</span>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'container'      => false,
				'menu_class'     => 'footer-menu',
				'depth'          => 1,
				'fallback_cb'    => false,
			) );
			?>
		</div>
	</div>
</footer>

<button class="back-to-top" aria-label="<?php esc_attr_e( 'Kembali ke atas', 'warta-nusa' ); ?>">&uarr;</button>

<?php wp_footer(); ?>
</body>
</html>
