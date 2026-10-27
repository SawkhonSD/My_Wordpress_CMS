<?php
/**
 * Halaman 404.
 *
 * @package Warta_Nusa
 */

get_header();
?>
<div class="empty-state">
	<p class="big">404</p>
	<h1><?php esc_html_e( 'Halaman tidak ditemukan', 'warta-nusa' ); ?></h1>
	<p><?php esc_html_e( 'Berita atau halaman yang Anda cari mungkin sudah dipindahkan atau dihapus. Coba gunakan pencarian.', 'warta-nusa' ); ?></p>
	<?php get_search_form(); ?>
	<p style="margin-top:24px"><a class="button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Kembali ke Beranda', 'warta-nusa' ); ?></a></p>
</div>
<?php
get_footer();
