<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
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

global $product;
global $redux_builder_amp;
if ( ! $product->is_purchasable() ) {
	return;
}

echo wc_get_stock_html( $product ); // WPCS: XSS ok.
$allStaticData = amp_woo_product_json_generator('array'); 
$cart_url = $allStaticData['product']['cart_url'].'amp/';
$submit_url = admin_url('admin-ajax.php?action=amp_woo_add_to_cart_submit');
$actionXhrUrl = preg_replace('#^https?:#', '', $submit_url); 
$nonce        = wp_create_nonce( 'wc_shop_wpnonce' );
if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart"  method="post" action-xhr="<?php echo  esc_url($actionXhrUrl)."&ampsubmit=1"; ?>" enctype='multipart/form-data'>
		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		<?php
		do_action( 'woocommerce_before_add_to_cart_quantity' );
    do_action("amp_wc_pro_before_select_opt",$allStaticData);

		woocommerce_quantity_input( array(
			'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
			'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
			'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( wp_unslash( $_POST['quantity'] ) ) : $product->get_min_purchase_quantity(), // WPCS: CSRF ok, input var ok.
		) );

		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>

		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>    
		<input type="hidden" id="wc_shop_wpnonce" name="wc_shop_wpnonce" value="<?php echo $nonce; ?>">  



		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

		<div submit-success class="amp-form-status-success-new woocommerce-notices-wrapper" >
        <div class="amp_wc_cart_success woocommerce-message"><?php if (class_exists( 'YITH_WC_Min_Max_Qty_Premium' )) { ?>{{{message}}} <?php }
          else{echo '“'.$allStaticData['product']['name'].'”&nbsp;&nbsp;';esc_html_e('has been added to your cart&nbsp;','amp-woocomerce' );} ?><?php
          if ( class_exists( 'YITH_WC_Min_Max_Qty_Premium' ) ) { 
            add_filter( 'woocommerce_add_to_cart_validation', array( $this, 'ywmmq_add_to_cart_validation' ), 11, 6 );
          }else { ?><a class="view_cart_button" href="<?php echo $cart_url; ?>"><?php esc_html_e('View Cart', 'amp-woocomerce'); ?></a><?php } ?> 
           </div>
</div>
<div submit-error id="add_to_cart_error"  class="woocommerce-notices-wrapper">
      <div class="ampforwp-form-status amp_gravity_error">
              <?php 
                global $product;
               if(function_exists('WC')){
                $product_sold_indv = $product->is_sold_individually();
                $product_name = $product->get_name();
              }
        if(empty($product_sold_indv)){           
                   echo esc_html__('Cart not added! Please try again.');         
        }?>
      <div class="ampforwp-form-status amp_gravity_error woocommerce-error">
         <?php if( !empty($product_sold_indv) && $product_sold_indv == 1 ){ ?>  
         <div class = "sold_individual">     
            <p style="margin-top: 10px; "> You cannot add another  <?php echo esc_html($product_name); ?> to your cart </p>
            <a  href="<?php echo $cart_url; ?>" class="button wc-forward" > <?php echo esc_html__('View Cart'); ?> </a>
          </div> 
          <?php } ?>
      </div> 
      </div>
</div>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
