<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own.
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$tabs = apply_filters( 'woocommerce_product_tabs', array() );

if ( ! empty( $tabs ) ) : ?>
	<div class="woocommerce-tabs wc-tabs-wrapper">
		   <amp-selector class="tabs-with-selector" role="tablist"
        on="select:myTabPanels.toggle(index=event.targetOption, value=true)">
			<?php $count = 0; foreach ( $tabs as $key => $tab ) : ?>
				<?php if($count == 0){
					$selected = "selected";
				}else{
					$selected = "";
				} ?>
				<div class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>" role="tab" aria-controls="tab-<?php echo esc_attr( $key ); ?>" option="<?php echo $count; ?>" <?php echo $selected; ?> >
			<?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
				</div>
				<?php $count++; ?>
			<?php endforeach; ?>
		   </amp-selector>
		    <amp-selector id="myTabPanels" class="tabpanels">
		<?php $count = 0; foreach ( $tabs as $key => $tab ) : ?>
			<?php if($count == 0){
					$selected = "selected";
				}else{
					$selected = "";
				} ?>
			<div class="woocommerce-Tabs-panel woocommerce-Tabs-panel--<?php echo esc_attr( $key ); ?> panel entry-content wc-tab" id="tab-<?php echo esc_attr( $key ); ?>" role="tabpanel" aria-labelledby="tab-title-<?php echo esc_attr( $key ); ?>" option <?php echo $selected; ?> >
				<?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
			</div>
			<?php $count++; ?>
		<?php endforeach; ?>
		</amp-selector>
	</div>
<?php endif; ?>
