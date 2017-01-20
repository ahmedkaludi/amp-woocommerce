<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">

<?php $this->load_parts( array( 'header-bar' ) );

	global $woocommerce;

  if( $woocommerce->product_factory->get_product()->product_type === "variable" ) {

    $get_available_variations  = $woocommerce->product_factory->get_product()->get_available_variations();
    $total_vartiants = count($get_available_variations);

?>

<article class="amp-wp-article">

	<header class="amp-wp-article-header">
		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
		<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( ) ) ); ?>


	</header>

	<?php $this->load_parts( array( 'featured-image' ) ); ?>

	<div class="amp-wp-article-content">
    <div class="Add-to-cart">
      <A HREF="#amp-wp-content">Add to cart</A>
      </div>
    </div>
		<?php do_action('amp_woocommerce_before_the_content'); ?>

		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
		<div class="amp-wp-content"><!--start of main div for variant-->
						<div class="amp-conatiner">
							<div class="varients-title">
								<h3>VARIENTS</h3>
							</di><!-- /.variant-title -->

              <a name="amp-wp-content"></a>
					<?php
					for ( $i=0 ; $i<$total_vartiants ; $i++) { ?>
					 <div><!--start of div for description-->
						 <?php
						 /// code start for description of the variant
						 $variant_attr_count = count($get_available_variations[$i]['attributes']);
						 $variant_attr = array_values($get_available_variations[$i]['attributes']);
						 /// code end for descriptio of the variant
							?>
					 </div><!--end of div for description-->
						<div class="main-container">
							<div class="amp-buttons">
								<div class="product-size"> <?php
									echo 'Varient attributes : ';
					for ($j=0; $j<$variant_attr_count ; $j++) {
						echo $variant_attr[$j];
						echo ' ';
					} ?>
								</div>
							 <div class="amp-img">
										<a href="<?php echo trailingslashit(get_permalink()).'?add-to-cart='.$get_available_variations[$i]["variation_id"]; ?>">
								 <amp-img src="<?php echo $get_available_variations[$i]['image_src'];?>" height="500" layout="responsive" width="500">
								 </amp-img>
								</a>

											 <?php echo $get_available_variations[$i]['price_html'] ?>

								<div class="add-cart">
									<a href="<?php echo trailingslashit(get_permalink()).'?add-to-cart='.$get_available_variations[$i]["variation_id"]; ?>">Add to Cart</a>
								</div><!-- /.add-cart -->
							 </div><!-- /.amp-img -->
						 </div><!-- /.amp-buttons -->
					 </div><!-- /.main-container -->
					<?php
				} // end of for loop
			} // end of if loop
		?>
				</div><!-- amp-conatiner -->
			</div><!--end of main div for variant-->
		<?php do_action('amp_woocommerce_after_the_content'); ?>

	</div>

	<footer class="amp-wp-article-footer">
		<?php $this->load_parts( apply_filters( 'amp_post_article_footer_meta', array( ) ) ); ?>
	</footer>

</article>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>
