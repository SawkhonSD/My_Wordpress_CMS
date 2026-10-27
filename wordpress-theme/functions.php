<?php
/**
 * Warta Nusa - fungsi dan definisi tema.
 *
 * @package Warta_Nusa
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Cegah akses langsung.
}

define( 'WARTA_NUSA_VERSION', '1.0.0' );

/**
 * Pengaturan dasar tema dan dukungan fitur WordPress.
 */
function warta_nusa_setup() {
	load_theme_textdomain( 'warta-nusa', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 240,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Ukuran gambar unggulan.
	set_post_thumbnail_size( 800, 500, true );
	add_image_size( 'warta-hero', 1100, 700, true );
	add_image_size( 'warta-card', 600, 375, true );
	add_image_size( 'warta-thumb', 160, 100, true );

	// Lokasi menu navigasi.
	register_nav_menus( array(
		'primary' => __( 'Menu Utama', 'warta-nusa' ),
		'topbar'  => __( 'Menu Atas (Top Bar)', 'warta-nusa' ),
		'footer'  => __( 'Menu Footer', 'warta-nusa' ),
	) );
}
add_action( 'after_setup_theme', 'warta_nusa_setup' );

/**
 * Lebar konten untuk embed.
 */
function warta_nusa_content_width() {
	$GLOBALS['content_width'] = 800;
}
add_action( 'after_setup_theme', 'warta_nusa_content_width', 0 );

/**
 * Memuat stylesheet dan script.
 */
function warta_nusa_scripts() {
	wp_enqueue_style( 'warta-nusa-style', get_stylesheet_uri(), array(), WARTA_NUSA_VERSION );
	wp_enqueue_script( 'warta-nusa-main', get_template_directory_uri() . '/assets/js/main.js', array(), WARTA_NUSA_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'warta_nusa_scripts' );

/**
 * Mendaftarkan area widget.
 */
function warta_nusa_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar Utama', 'warta-nusa' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Widget yang tampil di sisi kanan halaman.', 'warta-nusa' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	for ( $i = 1; $i <= 3; $i++ ) {
		register_sidebar( array(
			/* translators: %d: nomor kolom footer */
			'name'          => sprintf( __( 'Footer Kolom %d', 'warta-nusa' ), $i ),
			'id'            => 'footer-' . $i,
			'description'   => __( 'Widget di area footer.', 'warta-nusa' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	}
}
add_action( 'widgets_init', 'warta_nusa_widgets_init' );

/**
 * Panjang dan akhiran kutipan (excerpt).
 */
function warta_nusa_excerpt_length( $length ) {
	return is_admin() ? $length : 28;
}
add_filter( 'excerpt_length', 'warta_nusa_excerpt_length' );

function warta_nusa_excerpt_more( $more ) {
	return is_admin() ? $more : '&hellip;';
}
add_filter( 'excerpt_more', 'warta_nusa_excerpt_more' );

/**
 * Perkiraan waktu baca (kata per menit = 200).
 *
 * @param int|null $post_id ID post.
 * @return string
 */
function warta_nusa_reading_time( $post_id = null ) {
	$post_id = $post_id ? $post_id : get_the_ID();
	$words   = str_word_count( wp_strip_all_tags( get_post_field( 'post_content', $post_id ) ) );
	$minutes = max( 1, (int) ceil( $words / 200 ) );
	/* translators: %d: menit */
	return sprintf( _n( '%d menit baca', '%d menit baca', $minutes, 'warta-nusa' ), $minutes );
}

/**
 * Cetak meta post: tanggal, penulis, waktu baca, komentar.
 */
function warta_nusa_post_meta( $show_author = true ) {
	echo '<p class="post-meta">';
	printf(
		'<span class="posted-on"><time datetime="%1$s">%2$s</time></span>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);
	if ( $show_author ) {
		printf(
			'<span class="byline">%s <a href="%s">%s</a></span>',
			esc_html__( 'Oleh', 'warta-nusa' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		);
	}
	echo '<span class="reading-time">' . esc_html( warta_nusa_reading_time() ) . '</span>';
	echo '</p>';
}

/**
 * Cetak badge kategori pertama dari post.
 */
function warta_nusa_category_badge() {
	$cats = get_the_category();
	if ( ! empty( $cats ) ) {
		printf(
			'<a class="cat-badge" href="%s">%s</a>',
			esc_url( get_category_link( $cats[0]->term_id ) ),
			esc_html( $cats[0]->name )
		);
	}
}

/**
 * Cetak thumbnail, atau placeholder jika tidak ada gambar unggulan.
 */
function warta_nusa_thumbnail( $size = 'warta-card' ) {
	if ( has_post_thumbnail() ) {
		the_post_thumbnail( $size, array( 'loading' => 'lazy' ) );
	} else {
		$initial = mb_substr( get_bloginfo( 'name' ), 0, 1 );
		echo '<div class="thumb-placeholder" aria-hidden="true">' . esc_html( $initial ) . '</div>';
	}
}

/**
 * Pagination bernomor.
 */
function warta_nusa_pagination() {
	$links = paginate_links( array(
		'prev_text' => '&larr; ' . __( 'Sebelumnya', 'warta-nusa' ),
		'next_text' => __( 'Berikutnya', 'warta-nusa' ) . ' &rarr;',
		'type'      => 'list',
	) );
	if ( $links ) {
		echo '<nav class="pagination" aria-label="' . esc_attr__( 'Navigasi halaman', 'warta-nusa' ) . '">';
		echo wp_kses_post( str_replace( array( "<ul class='page-numbers'>", '<ul class="page-numbers">' ), '<ul class="nav-links" style="list-style:none;display:flex;flex-wrap:wrap;gap:8px;padding:0;margin:0">', $links ) );
		echo '</nav>';
	}
}

/**
 * Fallback menu jika menu belum diatur.
 */
function warta_nusa_menu_fallback() {
	echo '<ul class="nav-menu" id="primary-menu">';
	echo '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Beranda', 'warta-nusa' ) . '</a></li>';
	wp_list_categories( array(
		'title_li' => '',
		'orderby'  => 'count',
		'order'    => 'DESC',
		'number'   => 6,
	) );
	echo '</ul>';
}

/**
 * Ambil post populer berdasarkan jumlah komentar (fallback: terbaru).
 */
function warta_nusa_popular_posts( $number = 5 ) {
	return new WP_Query( array(
		'posts_per_page'      => $number,
		'orderby'             => 'comment_count date',
		'order'               => 'DESC',
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	) );
}

/**
 * Kelas body tambahan.
 */
function warta_nusa_body_classes( $classes ) {
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar-widgets';
	}
	return $classes;
}
add_filter( 'body_class', 'warta_nusa_body_classes' );

/**
 * Judul tampilan arsip tanpa awalan "Kategori:" dsb.
 */
function warta_nusa_archive_title( $title ) {
	if ( is_category() || is_tag() || is_tax() ) {
		return single_term_title( '', false );
	}
	if ( is_author() ) {
		return get_the_author();
	}
	return $title;
}
add_filter( 'get_the_archive_title', 'warta_nusa_archive_title' );
