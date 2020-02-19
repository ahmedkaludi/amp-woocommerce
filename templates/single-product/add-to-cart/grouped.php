<?php
/**
 * Grouped product add to cart
 */

defined( 'ABSPATH' ) || exit;

global $product, $post;
$allStaticData = amp_woo_product_json_generator('array'); 
$cart_url = $allStaticData['product']['cart_url'].'amp/';
$submit_url = admin_url('admin-ajax.php?action=amp_woo_add_to_cart_submit');
$action_url = preg_replace('#^https?:#', '', $submit_url); 
$actionXhrUrl =  $action_url."&ampsubmit=1";
$nonce        = wp_create_nonce( 'wc_shop_wpnonce' );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart grouped_form" action-xhr="<?php echo  esc_url($actionXhrUrl); ?>" method="post" enctype='multipart/form-data'>
	<table cellspacing="0" class="woocommerce-grouped-product-list group_table">
		<tbody>
			<?php
			$quantites_required      = false;
			$previous_post           = $post;
			$grouped_product_columns = apply_filters( 'woocommerce_grouped_product_columns', array(
				'quantity',
				'label',
				'price',
			), $product );

			foreach ( $grouped_products as $grouped_product_child ) {
				$post_object        = get_post( $grouped_product_child->get_id() );
				$quantites_required = $quantites_required || ( $grouped_product_child->is_purchasable() && ! $grouped_product_child->has_options() );
				$post               = $post_object; // WPCS: override ok.
				setup_postdata( $post );

				echo '<tr id="product-' . esc_attr( $grouped_product_child->get_id() ) . '" class="woocommerce-grouped-product-list-item ' . esc_attr( implode( ' ', wc_get_product_class( '', $grouped_product_child ) ) ) . '">';

				// Output columns for each product.
				foreach ( $grouped_product_columns as $column_id ) {
					do_action( 'woocommerce_grouped_product_list_before_' . $column_id, $grouped_product_child );

					switch ( $column_id ) {
						case 'quantity':
							ob_start();

							if ( ! $grouped_product_child->is_purchasable() || $grouped_product_child->has_options() || ! $grouped_product_child->is_in_stock() ) {
								woocommerce_template_loop_add_to_cart();
							} elseif ( $grouped_product_child->is_sold_individually() ) {
								echo '<input type="checkbox" name="' . esc_attr( 'quantity[' . $grouped_product_child->get_id() . ']' ) . '" value="1" class="wc-grouped-product-add-to-cart-checkbox" />';
							} else {
								do_action( 'woocommerce_before_add_to_cart_quantity' );

								woocommerce_quantity_input( array(
									'input_name'  => 'quantity[' . $grouped_product_child->get_id() . ']',
									'input_value' => isset( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ? wc_stock_amount( wc_clean( wp_unslash( $_POST['quantity'][ $grouped_product_child->get_id() ] ) ) ) : 0, // WPCS: CSRF ok, input var okay, sanitization ok.
									'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 0, $grouped_product_child ),
									'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $grouped_product_child->get_max_purchase_quantity(), $grouped_product_child ),
								) );

								do_action( 'woocommerce_after_add_to_cart_quantity' );
							}

							$value = ob_get_clean();
							break;
						case 'label':
							$value  = '<label for="product-' . esc_attr( $grouped_product_child->get_id() ) . '">';
							$value .= $grouped_product_child->is_visible() ? '<a href="' . esc_url( apply_filters( 'woocommerce_grouped_product_list_link', $grouped_product_child->get_permalink(), $grouped_product_child->get_id() ) ) . '">' . $grouped_product_child->get_name() . '</a>' : $grouped_product_child->get_name();
							$value .= '</label>';
							break;
						case 'price':
							$value = $grouped_product_child->get_price_html() . wc_get_stock_html( $grouped_product_child );
							break;
						default:
							$value = '';
							break;
					}

					echo '<td class="woocommerce-grouped-product-list-item__' . esc_attr( $column_id ) . '">' . apply_filters( 'woocommerce_grouped_product_list_column_' . $column_id, $value, $grouped_product_child ) . '</td>'; // WPCS: XSS ok.

					do_action( 'woocommerce_grouped_product_list_after_' . $column_id, $grouped_product_child );
				}

				echo '</tr>';
			}
			$post = $previous_post; // WPCS: override ok.
			setup_postdata( $post );
			?>
		</tbody>
	</table>

	<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" />

	<?php if ( $quantites_required ) : ?>

		<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>
		<input type="hidden" id="wc_shop_wpnonce" name="wc_shop_wpnonce" value="<?php echo esc_attr($nonce); ?>">
		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button> 

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	<?php endif; ?>


	<div submit-success class="amp-form-status-success-new woocommerce-notices-wrapper" >
	        <div class="amp_wc_cart_success woocommerce-message">
	        <?php if (class_exists( 'YITH_WC_Min_Max_Qty_Premium' )) { ?>
	        	{{{message}}} 
	        	<?php }else{
	          esc_html_e('“'.$allStaticData['product']['name'].'”&nbsp;&nbsp;has been added to your cart&nbsp;','amp-woocommerce' );
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
		            <p style="margin-top: 10px; "> <?php  esc_html_e('You cannot add another'.$product_name.'to your cart','amp-woocommerce'); ?> </p>
		            <a  href="<?php echo esc_url($cart_url); ?>" class="button wc-forward" > <?php echo esc_html__('View Cart','amp-woocommerce'); ?> </a>
		          </div> 
		          <?php } ?>
		      </div> 
	      </div>
	</div>


</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
