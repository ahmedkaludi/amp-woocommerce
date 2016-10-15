<?php global $redux_builder_amp;  ?>
<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
	<?php $this->load_parts( array( 'style' ) ); ?>
	<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>
<body class="single-post">
<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php do_action( 'ampforwp_after_header', $this ); ?>


	<div class="amp-wp-content post-title-meta">
		<?php if($redux_builder_amp['enable-single-post-meta'] == true) { ?>
			<ul class="amp-wp-meta">
				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author') ) ); ?>

				<li> <?php _e(' on ','ampforwp'); the_time( get_option( 'date_format' ) ) ?></li> 

				<?php  $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array('meta-taxonomy' ) ) ); ?>

				<li class="cb"></li>
			</ul>
		<?php } ?>
		
		
		
		<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
		this is the WC title.
	</div>
	<div class="amp-wp-content featured-image-content">
    <?php if($redux_builder_amp['enable-single-featured-img'] == true) {
        if ( has_post_thumbnail() ) { ?>
        <?php
        $thumb_id = get_post_thumbnail_id();
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
        $thumb_url = $thumb_url_array[0];            
        ?> 
        <div class="post-featured-img"><amp-img src=<?php echo $thumb_url ?> width=512 height=300 layout=responsive></amp-img></div>
    <?php } } ?>
	</div>
	<div class="amp-wp-content the_content">

        <?php do_action( 'ampforwp_before_post_content', $this ); ?>
		
		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
		<?php do_action( 'ampforwp_after_post_content', $this ); ?>
    
    <?php if ( class_exists( 'WooCommerce' ) ) { ?>
    		<div class="fn_cart_total">
    		    <?php
    		    global $woocommerce, $product;
    		    // get cart quantity
    		    $qty = $woocommerce->cart->get_cart_contents_count();
    		    // get cart total
    		    $total = $woocommerce->cart->get_cart_item_quantities();
    		    // get cart url
    		    $cart_url = wc_get_cart_url();
    		    // if multiple products in cart
    		    if($qty>1)
    		    echo '<a href="'.$cart_url.'">Cart items <i>'.$qty.'</i></a>';
    		    // if single product in cart
    		    if($qty==1)
    		    echo '<a href="'.$cart_url.'">Cart item <i>1</i></a>';
    		    if($qty==0)
    		    echo '<a href="'.$cart_url.'">Your Cart is empty with <i>0</i> items.</a>';
						
						// Price of the product (html), including sale price strikeout & new price
						$amp_product_price =  $woocommerce->product_factory->get_product()->get_price_html();
			 			echo '<br /> Price: ' . $amp_product_price .'<br />';
    		    ?>
    		</div>
    <?php }?>
    
    <?php 
		 // All code in this php tag is 100% working. You can use this code while templating.		
		// Rating
		$rating_count = $woocommerce->product_factory->get_product()->get_rating_count();
		$review_count = $woocommerce->product_factory->get_product()->get_review_count();
		$average 			= $woocommerce->product_factory->get_product()->get_average_rating();
		$rating_html 	= $woocommerce->product_factory->get_product()->get_rating_html();
	 	echo '$rating_count 	= ' . $rating_count . '<br />' ;
	 	echo '$review_count 	= ' . $review_count . '<br />' ;
	 	echo '$average 			= ' . $average . '<br />' ;
	 	// echo '$rating_html 		= ' . $rating_html . '<br />' ;
		
		// Meta info 
		$categories 		=	$woocommerce->product_factory->get_product()->get_categories(); 
		$tags 				=	$woocommerce->product_factory->get_product()->get_tags(); 
	  	echo '$categories 	= ' . $categories . '<br />' ;
	  	echo '$tags 		= ' . $tags . '<br />' ;
		
		// Check sale status
		$sale					=	$woocommerce->product_factory->get_product()->is_on_sale();
		// $sale has boolean value 
		 echo '$sale 				= ' . $sale . '<br />' ;
	
		// Add to cart button with button text and button url
		$add_to_cart 			= $woocommerce->product_factory->get_product()->add_to_cart_url();	
		$add_to_cart_text = $woocommerce->product_factory->get_product()->add_to_cart_text();	
		  echo '<div class="ampforwp-add-to-cart-button"> <a href="' .  $add_to_cart . '"> ' . $add_to_cart_text .' </a> </div> <br /> <br />';
		
		// Featured Image for WooCommerce Product
		$get_image = $woocommerce->product_factory->get_product()->get_image();
		//  echo $get_image . '<br />';

		//  var_dump($get_image);
		
		// Product Description.
		 woocommerce_template_single_excerpt();
		
		 // the_excerpt();
		
		// PHP tag ends
		?>
		
		<?php 
		
		echo "<br /><br /><br />";
			// Images and gallery
			$gallery	=	$woocommerce->product_factory->get_product()->get_gallery_attachment_ids(); 
			// 
			//echo $gallery . '<br />';
			//var_dump($gallery); 
			
			

			
		?>
    
    
	</div>

	<div class="amp-wp-content post-pagination-meta">
		<?php $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-taxonomy' ) ) ); ?> 


    <?php if($redux_builder_amp['enable-next-previous-pagination'] == true) { ?>
		<div id="pagination">
			<div class="next"><?php next_post_link(); ?></div>
			<div class="prev"><?php previous_post_link(); ?></div>
			<div class="clearfix"></div>
		</div>
    <?php } ?>
	</div>

	<?php if($redux_builder_amp['enable-single-social-icons'] == true)  { ?>
		<div class="sticky_social">          
			<?php if($redux_builder_amp['enable-single-facebook-share'] == true)  { ?>
		    	<amp-social-share type="facebook"    data-param-app_id="<?php echo $redux_builder_amp['amp-facebook-app-id']; ?>" width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-twitter-share'] == true)  { ?>
		    	<amp-social-share type="twitter"    width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-gplus-share'] == true)  { ?>
		    	<amp-social-share type="gplus"      width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-email-share'] == true)  { ?>
		    	<amp-social-share type="email"      width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-pinterest-share'] == true)  { ?>
		    	<amp-social-share type="pinterest"  width="50" height="28"></amp-social-share>
		  	<?php } ?>
		  	<?php if($redux_builder_amp['enable-single-linkedin-share'] == true)  { ?>
		    	<amp-social-share type="linkedin"   width="50" height="28"></amp-social-share>
		  	<?php } ?>
		</div>
	<?php } ?>


<?php do_action( 'amp_post_template_footer', $this ); ?>
</body>
</html>
