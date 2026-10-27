<?php
/**
 * Tampilan saat tidak ada konten.
 *
 * @package Warta_Nusa
 */
?>
<div class="empty-state">
	<h2><?php esc_html_e( 'Belum ada berita', 'warta-nusa' ); ?></h2>
	<?php if ( is_search() ) : ?>
		<p><?php esc_html_e( 'Tidak ada hasil untuk kata kunci tersebut. Coba kata kunci lain.', 'warta-nusa' ); ?></p>
	<?php elseif ( current_user_can( 'publish_posts' ) ) : ?>
		<p>
			<?php
			printf(
				wp_kses(
					/* translators: %s: tautan tambah post */
					__( 'Siap menerbitkan berita pertama? <a href="%s">Mulai di sini</a>.', 'warta-nusa' ),
					array( 'a' => array( 'href' => array() ) )
				),
				esc_url( admin_url( 'post-new.php' ) )
			);
			?>
		</p>
	<?php else : ?>
		<p><?php esc_html_e( 'Konten belum tersedia. Silakan kembali lagi nanti.', 'warta-nusa' ); ?></p>
	<?php endif; ?>
	<?php get_search_form(); ?>
</div>
