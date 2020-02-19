<?php
/**
 * External product add to cart
 *
 */

defined( 'ABSPATH' ) || exit;
global $redux_builder_amp;
$allStaticData = amp_woo_product_json_generator('array'); 
$submit_url = admin_url('admin-ajax.php?action=amp_woo_add_to_cart_submit');
$action_url = preg_replace('#^https?:#', '', $submit_url); 
$actionXhrUrl =  $action_url."&ampsubmit=1";
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart" action-xhr="<?php echo  esc_url($actionXhrUrl); ?>" method="post">
	<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
      <?php 
	     if($allStaticData['product']['product_type']=='external'){
              //This link show only when product type is "external" ?>        
                <a class="single_add_to_cart_button button alt"  href="<?php echo esc_url($allStaticData['product']['add_cart_url']); ?>" target="_blank"><?php echo esc_html__($allStaticData['product']['add_cart_text'],'amp-woocommerce'); ?></a>
              <?php
              } ?>

	<?php wc_query_string_form_fields( $product_url ); // XSS OK.?>

	<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
