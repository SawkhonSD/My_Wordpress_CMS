<?php
/**
 * Header: topbar, branding, navigasi, ticker.
 *
 * @package Warta_Nusa
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="screen-reader-text" href="#content"><?php esc_html_e( 'Lompat ke konten', 'warta-nusa' ); ?></a>

<div class="topbar">
	<div class="container">
		<span class="topbar-date"><?php echo esc_html( date_i18n( 'l, j F Y' ) ); ?></span>
		<?php
		wp_nav_menu( array(
			'theme_location' => 'topbar',
			'container'      => false,
			'menu_class'     => 'topbar-menu',
			'depth'          => 1,
			'fallback_cb'    => false,
		) );
		?>
	</div>
</div>

<header class="site-header">
	<div class="container branding">
		<div class="site-branding">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php else : ?>
				<?php
				$name  = get_bloginfo( 'name' );
				$parts = explode( ' ', $name, 2 );
				?>
				<p class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<?php
						echo esc_html( $parts[0] );
						if ( ! empty( $parts[1] ) ) {
							echo ' <span>' . esc_html( $parts[1] ) . '</span>';
						}
						?>
					</a>
				</p>
			<?php endif; ?>
			<?php $desc = get_bloginfo( 'description', 'display' ); ?>
			<?php if ( $desc ) : ?>
				<p class="site-description"><?php echo esc_html( $desc ); ?></p>
			<?php endif; ?>
		</div>
		<div class="header-search">
			<?php get_search_form(); ?>
		</div>
	</div>

	<nav class="main-navigation" aria-label="<?php esc_attr_e( 'Navigasi utama', 'warta-nusa' ); ?>">
		<div class="container">
			<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
				<span class="bars" aria-hidden="true"></span> <?php esc_html_e( 'Menu', 'warta-nusa' ); ?>
			</button>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'nav-menu',
				'menu_id'        => 'primary-menu',
				'fallback_cb'    => 'warta_nusa_menu_fallback',
			) );
			?>
		</div>
	</nav>

	<?php
	$ticker = new WP_Query( array(
		'posts_per_page'      => 6,
		'ignore_sticky_posts' => true,
		'no_found_rows'       => true,
	) );
	if ( $ticker->have_posts() ) :
		?>
		<div class="ticker">
			<div class="container">
				<span class="ticker-label"><?php esc_html_e( 'Terkini', 'warta-nusa' ); ?></span>
				<div class="ticker-track">
					<div class="ticker-inner">
						<?php while ( $ticker->have_posts() ) : $ticker->the_post(); ?>
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
		</div>
		<?php
		wp_reset_postdata();
	endif;
	?>
</header>

<main id="content" class="site-content">
	<div class="container">
