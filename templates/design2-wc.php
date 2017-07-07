<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	<?php do_action( 'amp_post_wc_specific_template_css', $this ); ?>
	</style>
</head>


<body class="ampforwp-style <?php echo esc_attr( $this->get( 'body_class' ) ); ?>">
	<?php $this->load_parts( array( 'header-bar' ) ); ?>

	<div class="cb"></div>
	<div class="amp-wp-content post-title-meta amp-wp-article-header">

		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
		<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( ) ) );?>
	</div>
	
	<?php 
	// Featured Image
		$featured_image = $this->get( 'featured_image' );
		if ($featured_image) {
			$amp_html = $featured_image['amp_html'];
			$caption = $featured_image['caption'];
			?>
		<div class="amp-wp-content featured-image-content"> 
			<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
				<figure class="amp-wp-article-featured-image wp-caption">
					<?php echo $amp_html; // amphtml content; no kses ?>
					<?php if ( $caption ) : ?>
						<p class="wp-caption-text">
							<?php echo wp_kses_data( $caption ); ?>
						</p>
					<?php endif; ?>
				</figure>
			</div> 
		</div><?php 
		} ?>
	

	<div class="amp-wp-content the_content amp-wp-article-content">

  		<?php do_action('amp_woocommerce_before_the_content'); ?>

  		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>

		 <?php do_action('amp_woocommerce_after_the_content'); ?>

  </div>

</article>

<?php
// $this->load_parts( array( 'footer' ) );
?>
<?php
 $this->load_parts( array( 'footer' ) );
 do_action( 'amp_post_template_footer', $this );
?>
<?php
// do_action( 'amp_post_template_footer', $this );
?>
</body>
</html>