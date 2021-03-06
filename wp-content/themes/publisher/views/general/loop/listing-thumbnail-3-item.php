<?php
/**
 * Thumbnail listing item template
 *
 * @author     BetterStudio
 * @package    Publisher
 * @version    1.9.0
 */

// Creates main term ID that used for custom category color style
$main_term = publisher_get_post_primary_cat();
if ( ! is_wp_error( $main_term ) && is_object( $main_term ) ) {
	$main_term_class = 'main-term-' . $main_term->term_id;
} else {
	$main_term_class = 'main-term-none';
}

$thumbnail_size  = publisher_get_prop_thumbnail_size( 'publisher-tb1' );
$thumbnail       = publisher_get_thumbnail( $thumbnail_size, get_the_ID(), FALSE );
$subtitle        = publisher_prop_is( 'show-subtitle', 1 );
$section_tag     = publisher_get_prop( 'item-tag', 'article' ) . ' ';
$heading_tag     = publisher_get_prop( 'item-heading-tag', 'h2' );
$sub_heading_tag = publisher_get_prop( 'item-sub-heading-tag', 'h3' );

?>
<<?php echo $section_tag; ?> <?php publisher_attr( 'post', publisher_get_prop_class() . ' clearfix listing-item listing-item-thumbnail listing-item-tb-3 ' . $main_term_class ); ?>>
<?php if ( ! empty( $thumbnail['src'] ) ) { ?>
	<div class="featured">
		<a <?php publisher_the_thumbnail_attr( $thumbnail_size ); ?>
				class="img-holder" href="<?php publisher_the_permalink(); ?>"></a>
		<?php publisher_edit_post_link(); ?>
	</div>
<?php }

if ( $subtitle && publisher_prop_is( 'subtitle-location', 'before-title' ) ) {
	$subtitle = FALSE;
	publisher_the_subtitle( '<' . $sub_heading_tag . ' class="post-subtitle">', '</' . $sub_heading_tag . '>', publisher_get_prop( 'subtitle-limit', 0 ) );
}

echo '<', $heading_tag, ' class="title">'; ?>
<a <?php publisher_attr( 'post-url' ); ?>>
		<span <?php publisher_attr( 'post-title' ); ?>>
			<?php publisher_echo_html_limit_words( publisher_get_the_title(), publisher_get_prop( 'title-limit' ) ); ?>
		</span>
</a>
<?php echo '</', $heading_tag, '>';

if ( $subtitle && publisher_prop_is( 'subtitle-location', 'before-meta' ) ) {
	$subtitle = FALSE;
	publisher_the_subtitle( '<' . $sub_heading_tag . ' class="post-subtitle">', '</' . $sub_heading_tag . '>', publisher_get_prop( 'subtitle-limit', 0 ) );
}

if ( publisher_get_prop( 'show-meta', TRUE ) ) {
	publisher_loop_meta();
}

if ( $subtitle && publisher_prop_is( 'subtitle-location', 'after-meta' ) ) {
	publisher_the_subtitle( '<' . $sub_heading_tag . ' class="post-subtitle">', '</' . $sub_heading_tag . '>', publisher_get_prop( 'subtitle-limit', 0 ) );
}

?>
</<?php echo $section_tag; ?>>
