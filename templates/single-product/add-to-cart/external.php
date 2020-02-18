<?php
/**
 * External product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/external.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;
global $redux_builder_amp;
$allStaticData = amp_woo_product_json_generator('array'); 
$submit_url = admin_url('admin-ajax.php?action=amp_woo_add_to_cart_submit');
$actionXhrUrl = preg_replace('#^https?:#', '', $submit_url);  
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" action-xhr="<?php echo  esc_url($actionXhrUrl)."&ampsubmit=1"; ?>" method="post">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

<!-- 	<button type="submit" class="single_add_to_cart_button button alt"><?php // echo esc_html( $button_text ); ?></button> -->
      <?php 
	     if($allStaticData['product']['product_type']=='external'){
              //This link show only when product type is "external" ?>        
                <a class="single_add_to_cart_button button alt"  href="<?php echo $allStaticData['product']['add_cart_url']; ?>" target="_blank"><?php echo esc_html__($allStaticData['product']['add_cart_text'],'amp-woocommerce'); ?></a>
              <?php
              } ?>

	<?php wc_query_string_form_fields( $product_url ); ?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
