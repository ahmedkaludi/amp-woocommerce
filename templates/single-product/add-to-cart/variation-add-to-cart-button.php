<?php
/**
 * Single variation cart button
 *
 */

defined( 'ABSPATH' ) || exit;

global $product; global $redux_builder_amp;
$nonce        = wp_create_nonce( 'wc_shop_wpnonce' );
?>
<div class="woocommerce-variation-add-to-cart variations_button">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

	<?php
	do_action( 'woocommerce_before_add_to_cart_quantity' );
	$allStaticData = amp_woo_product_json_generator('array'); 
?>
	  <div class="addtional-field">
           <span class="subb" tabindex="2" role="click" on="tap:AMP.setState({
                        product:{
                                selectedqty: (product.selectedqty==product.minqty? 2: product.selectedqty)-1
                             }
        })">-</span>
        <span class="numb" [text]="product.selectedqty">1</span>
        <span class="addi" tabindex="2" role="click" on="tap:AMP.setState({
                        product:{
                                selectedqty: (product.selectedqty==product.maxqty? <?php echo$allStaticData['maxqty']-1; ?>: product.selectedqty)+1
                             }
        })">+</span>
      
    <input type="hidden" name="quantity" value="<?php echo absint($allStaticData['minqty']); ?>" [value]="product.selectedqty">
</div>
<?php 
	do_action( 'woocommerce_after_add_to_cart_quantity' );
	?>

	<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<input type="hidden" name="add-to-cart" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="product_id" value="<?php echo absint( $product->get_id() ); ?>" />
	<input type="hidden" name="variation_id" class="variation_id" value="0" />
	<input type="hidden" id="wc_shop_wpnonce" name="wc_shop_wpnonce" value="<?php echo esc_attr($nonce); ?>">  
</div>
