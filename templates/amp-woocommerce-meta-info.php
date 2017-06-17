<div class="amp-woocommerce-meta-info">
    <div class="amp-wp-meta amp-woocommerce-price" >
	<?php if ( ! function_exists( 'get_price_html' )) {
		global $woocommerce;
		$amp_product_price 	=  $woocommerce->product_factory->get_product()->get_price_html();
		$context = '';
		$allowed_tags 		= wp_kses_allowed_html( $context );

		if ( $amp_product_price ) {
			echo 'Price: ' .  wp_kses( $amp_product_price,  $allowed_tags  )  ;
		} else {
				echo "Sorry, this item is not for sale at the moment, please check out more products <a href=" . esc_url( home_url('/shop') ) . "> Here </a> " ;
		}
	} ?>
</div>

<?php global $woocommerce;
    if ( $amp_product_price && $woocommerce->product_factory->get_product()->product_type !== "variable" )  { ?>
        <div class="amp-wp-meta amp-woocommerce-add-cart" ><?php 
            global $woocommerce;
            global $product;

            $add_to_cart_text	=	$woocommerce->product_factory->get_product()->add_to_cart_text();
            $product_id 		= $woocommerce->product_factory->get_product()->id;

            $product_url 		=  trailingslashit(get_permalink( $product_id ));
            $add_to_cart_url    = "?add-to-cart=$product_id";
            $product_url 		= $product_url . $add_to_cart_url;

            if ($product->product_type  === 'external') {
                $product_url  = $product->product_url;
            }

            echo '<div class="ampforwp-add-to-cart-button"> <a target="_blank" href="' .  esc_url($product_url) . '"> ' . esc_html($add_to_cart_text) .' </a> </div> ';?>
        </div>
        <?php 
    } 

if( $woocommerce->product_factory->get_product()->product_type === "variable" ) { ?>
           <div class="amp-wp-meta amp-woocommerce-add-cart"><div class="ampforwp-add-to-cart-button"> <a href="#amp-wp-content">Add to cart</a> </div>
               </div> 
    <?php } ?>
</div>