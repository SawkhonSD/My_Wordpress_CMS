<?php
/**
 * Template komentar.
 *
 * @package Warta_Nusa
 */

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
			$count = get_comments_number();
			/* translators: %s: jumlah komentar */
			printf( esc_html( _n( '%s Komentar', '%s Komentar', $count, 'warta-nusa' ) ), esc_html( number_format_i18n( $count ) ) );
			?>
		</h2>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 44,
			) );
			?>
		</ol>
		<?php the_comments_navigation(); ?>
		<?php if ( ! comments_open() ) : ?>
			<p><?php esc_html_e( 'Komentar ditutup.', 'warta-nusa' ); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'        => esc_html__( 'Tinggalkan Komentar', 'warta-nusa' ),
		'label_submit'       => esc_html__( 'Kirim Komentar', 'warta-nusa' ),
		'comment_notes_after' => '',
	) );
	?>
</div>
