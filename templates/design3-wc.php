<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
    <link rel="dns-prefetch" href="https://cdn.ampproject.org">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	<?php do_action( 'amp_post_wc_specific_template_css', $this ); ?>
	</style>
</head>
<body class="design_3_wrapper single-post <?php if(is_page()){ echo'amp-single-page'; };?>">
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>
<main>
	<article class="amp-wp-article">
		<?php do_action('ampforwp_post_before_design_elements') ?>
	
		<?php do_action('ampforwp_above_the_title',$this); ?>
		<header class="amp-wp-content amp-wp-article-header ampforwp-title">
			<h1 class="amp-wp-title"> <?php 
				$ampforwp_title = $this->get( 'post_title' ) ;
				$ampforwp_title =  apply_filters('ampforwp_filter_single_title', $ampforwp_title);
				echo wp_kses_data( $ampforwp_title ); ?>
			</h1>
			<?php do_action('ampforwp_below_the_title',$this); ?>
			<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( ) ) );?>

		</header>


		<?php do_action('ampforwp_before_featured_image_hook',$this);
		$featured_image = $this->get( 'featured_image' );
			if (  $featured_image ) {
				$amp_html = $featured_image['amp_html'];
				$caption = $featured_image['caption']; ?>
				<div class="amp-wp-article-featured-image amp-wp-content featured-image-content">
					<div class="post-featured-img">
						<figure class="amp-wp-article-featured-image wp-caption">
							<?php echo $amp_html; // amphtml content; no kses ?>
							<?php if ( $caption ) : ?>
								<p class="wp-caption-text">
									<?php echo wp_kses_data( $caption ); ?>
								</p>
							<?php endif; ?> 
						</figure>
					</div>
				</div> <?php 
			}
		do_action('ampforwp_after_featured_image_hook',$this); ?>
	
		<div class="amp-wp-article-content">
			<div class="amp-wp-content the_content">
				<?php do_action('amp_woocommerce_before_the_content'); 
				echo $this->get( 'post_amp_content' );
				do_action('amp_woocommerce_after_the_content'); ?>
			</div>
		</div>

		<?php do_action('ampforwp_post_after_design_elements') ?>
	</article>
</main>
<?php do_action( 'amp_post_template_above_footer', $this ); ?>
<?php $this->load_parts( array( 'footer' ) ); ?>
<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>