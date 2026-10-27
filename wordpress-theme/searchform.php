<?php
/**
 * Formulir pencarian.
 *
 * @package Warta_Nusa
 */
$unique_id = wp_unique_id( 'search-form-' );
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $unique_id ); ?>"><?php esc_html_e( 'Cari berita:', 'warta-nusa' ); ?></label>
	<input type="search" id="<?php echo esc_attr( $unique_id ); ?>" class="search-field" placeholder="<?php esc_attr_e( 'Cari berita&hellip;', 'warta-nusa' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s">
	<button type="submit" class="search-submit"><?php esc_html_e( 'Cari', 'warta-nusa' ); ?></button>
</form>
