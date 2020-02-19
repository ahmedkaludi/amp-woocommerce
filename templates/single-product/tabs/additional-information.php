<?php
/**
 * Additional Information tab
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$heading = esc_html( apply_filters( 'woocommerce_product_additional_information_heading', __( 'Additional information', 'amp-woocommerce' ) ) );

?>

<?php if ( $heading ) : ?>
	<h2><?php echo esc_html($heading); ?></h2>
<?php endif; ?>

<?php do_action( 'woocommerce_product_additional_information', $product ); ?>
