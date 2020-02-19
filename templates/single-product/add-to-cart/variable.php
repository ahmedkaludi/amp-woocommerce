<?php
/**
 * Variable product add to cart
 */

defined( 'ABSPATH' ) || exit;

global $product; global $redux_builder_amp;

$default_varprice = '';
$default_variation = $product->get_default_attributes();
$show_class = "hide";

  if(!empty($default_variation)){
      $dflt_var_arr = array();
      foreach ($default_variation as $new_key => $def_value) {
        $dflt_var_arr['attribute_' .$new_key] = $def_value;
      }


  $variable_product = wc_get_product( absint( $product->get_id() ) );
  $data_store   = WC_Data_Store::load( 'product' );
  $variation_id = $data_store->find_matching_product_variation( $variable_product, $dflt_var_arr );
  $variation    = $variation_id ? $variable_product->get_available_variation( $variation_id ) : false;

  $default_varprice = $variation['display_price'];
  $show_class = '';
  }


$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );


$allStaticData = amp_woo_product_json_generator('array');

$cart_url = $allStaticData['product']['cart_url'].'amp/';
$submit_url = admin_url('admin-ajax.php?action=amp_woo_add_to_cart_submit');
$action_url = preg_replace('#^https?:#', '', $submit_url); 
$actionXhrUrl =  $action_url."&ampsubmit=1";

if(function_exists('wc_get_price_decimals')  && function_exists('get_woocommerce_price_format') ) {
    if(!isset($args)){ 
      $args = "";
    }
    $args = apply_filters('wc_price_args', wp_parse_args($args,
                                      array(
                                        'ex_tax_label'       => false,
                                        'currency'           => '',
                                        'decimals'           => wc_get_price_decimals(),
                                        'decimal_separator'  => wc_get_price_decimal_separator(),
                                        'thousand_separator' => wc_get_price_thousand_separator(),
                                        'price_format'       => get_woocommerce_price_format(),
                                            )
                                           )
                            );
  }

do_action( 'woocommerce_before_add_to_cart_form' );
 // WPCS: XSS ok. 
$variation_js_src = str_replace('http:','https:',AMP_WOO_PLUGIN_URI).'amp-scripts/amp_woo_variation_calc.js';
 ?>
<amp-script src="<?php echo esc_url($variation_js_src);?>">

<form class="variations_form cart" id="amp_variations" action-xhr="<?php echo  esc_url($actionXhrUrl); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-site-url="<?php echo esc_url(get_site_url()); ?>">

  <?php do_action( 'woocommerce_before_variations_form' ); ?>

  <?php if ( empty( $available_variations ) && false !== $available_variations ) : ?>
    <p class="stock out-of-stock">
      <?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'amp-woocommerce' ) ) ); ?>
    </p>
  <?php else : ?>
    <table class="variations" cellspacing="0">
      <tbody>
        <?php foreach ( $attributes as $attribute_name => $options ) : ?>
          <tr>
            <td class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></td>
            <td class="value">
              <?php
                wc_dropdown_variation_attribute_options( array(
                  'options'   => $options,
                  'attribute' => $attribute_name,
                  'product'   => $product,
                ) );
                echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'amp-woocommerce' ) . '</a>' ) ) : '';
              ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

   <div id="var_display_price"  class="single_variation_wrap <?php echo esc_attr($show_class); ?>">
        <div class="var_show_price ">
          <span class="price">
            <span class="woocommerce-Price-amount amount">
              <span class="woocommerce-Price-currencySymbol">
                <?php echo esc_attr($allStaticData['product']['currency_sym']); ?>
                </span>
                <span id="var_price" >
                  <?php echo esc_attr($default_varprice); ?>
                </span>
              </span>
            </span>
        </div>
      <?php
        /**
         * Hook: woocommerce_before_single_variation.
         */
        do_action( 'woocommerce_before_single_variation' );

        /**
         * Hook: woocommerce_single_variation. Used to output the cart button and placeholder for variation data.
         *
         * @since 2.4.0
         * @hooked woocommerce_single_variation - 10 Empty div for variation data.
         * @hooked woocommerce_single_variation_add_to_cart_button - 20 Qty and cart button.
         */
        do_action( 'woocommerce_single_variation' );

        /**
         * Hook: woocommerce_after_single_variation.
         */
        do_action( 'woocommerce_after_single_variation' );
      ?>
    </div>
    <span id="error_msg"> </span>
  <?php endif; ?>

  <?php do_action( 'woocommerce_after_variations_form' ); ?>
    <div submit-success class="amp-form-status-success-new woocommerce-notices-wrapper" >
        <div class="amp_wc_cart_success woocommerce-message">
          <?php if (class_exists( 'YITH_WC_Min_Max_Qty_Premium' )) { ?>
            {{{message}}} 
          <?php }
          else{
            echo esc_html__('“'.$allStaticData['product']['name'].'”&nbsp;&nbsp; has been added to your cart&nbsp;','amp-woocommerce');
          } ?>
          <?php if ( class_exists( 'YITH_WC_Min_Max_Qty_Premium' ) ) { 
            add_filter( 'woocommerce_add_to_cart_validation', array( $this, 'ywmmq_add_to_cart_validation' ), 11, 6 );
          }else { ?>
            <a class="view_cart_button" href="<?php echo esc_url($cart_url); ?>">
              <?php echo esc_html__('View Cart','amp-woocommerce'); ?></a>
          <?php } ?> 
           </div>
   </div>
  <div submit-error id="add_to_cart_error"  class="woocommerce-notices-wrapper">
  <template type="amp-mustache">
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
       {{#errors}} 
          <div>{{error_detail}}</div>
         <?php if( !empty($product_sold_indv) && $product_sold_indv == 1 ){ ?>  
         <div class = "sold_individual">     
        <p style="margin-top: 10px; "> <?php echo esc_html__('You cannot add another.'.$product_name.' to your cart','amp-woocommerce'); ?></p>
        <a  href="<?php echo  esc_url($cart_url); ?>" class="button wc-forward" >
              <?php echo esc_html__('View Cart','amp-woocommerce');?>
                </a> 
                </div> 
          <?php } ?>
       {{/errors}} 
      </div> 
      </div>
  </template>
</div>
</form>
</amp-script>
<?php
do_action( 'woocommerce_after_add_to_cart_form' );
