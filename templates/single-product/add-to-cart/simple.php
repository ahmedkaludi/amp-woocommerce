<?php
/**
 * Simple product add to cart
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
$action_url = preg_replace('#^https?:#', '', $submit_url); 
$actionXhrUrl =  $action_url."&ampsubmit=1";
$nonce        = wp_create_nonce( 'wc_shop_wpnonce' );
if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart"  method="post" action-xhr="<?php echo  esc_url($actionXhrUrl); ?>" enctype='multipart/form-data'>
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
		<input type="hidden" id="wc_shop_wpnonce" name="wc_shop_wpnonce" value="<?php echo esc_attr($nonce); ?>">

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

  <div submit-success class="amp-form-status-success-new woocommerce-notices-wrapper" >
          <div class="amp_wc_cart_success woocommerce-message">
            <?php if (class_exists( 'YITH_WC_Min_Max_Qty_Premium' )) { ?>
            {{{message}}} 
            <?php }
            else{echo esc_html_e('“'.$allStaticData['product']['name'].'”&nbsp;&nbsp;has been added to your cart&nbsp;','amp-woocommerce' );
             } ?>
             <?php if ( class_exists( 'YITH_WC_Min_Max_Qty_Premium' ) ) { 
              add_filter( 'woocommerce_add_to_cart_validation', array( $this, 'ywmmq_add_to_cart_validation' ), 11, 6 );
            }else { ?>
              <a class="view_cart_button" href="<?php echo esc_url($cart_url); ?>"><?php esc_html_e('View Cart', 'amp-woocommerce'); ?></a>
            <?php } ?> 
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
            echo esc_html__('Cart not added! Please try again.','amp-woocommerce');         
          }?>
          <div class="ampforwp-form-status amp_gravity_error woocommerce-error">
             <?php if( !empty($product_sold_indv) && $product_sold_indv == 1 ){ ?>  
             <div class = "sold_individual">     
                <p style="margin-top: 10px; ">  
                  <?php echo esc_html__('You cannot add another.'.$product_name.' to your cart','amp-woocommerce'); ?>
                </p>
                <a  href="<?php echo esc_url($cart_url); ?>" class="button wc-forward" > 
                  <?php echo esc_html__('View Cart','amp-woocommerce'); ?>
                </a>
              </div> 
              <?php } ?>
          </div> 
        </div>
  </div>
	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
