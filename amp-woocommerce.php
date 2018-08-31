<?php
/*
Plugin Name: AMP WooCommerce
Description: WooCommerce for AMP (Accelerated Mobile Pages). This plugin enables e-commerce store functionality with WooCommerce for AMP. AMP for Ecommerce out of the box.
Author: Mohammed Kaludi
Version: 0.4
Author URI: http://ampforwp.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) exit;
	
	// Enable WooCommerce support for AMP
	function amp_woocommerce_add_woocommerce_support() {
		// Check if the dependent plugins are activated, if not, then return.
		// As there is no use of this plugin, if parent plugins are not activated.
		if ( ! defined( 'AMP__FILE__' ) ) {  return; }

		add_rewrite_endpoint( AMP_QUERY_VAR, EP_PERMALINK | EP_PAGES | EP_ROOT );
		add_post_type_support( 'product', AMP_QUERY_VAR );
	}
	add_action( 'amp_init', 'amp_woocommerce_add_woocommerce_support',11);


	add_filter( 'amp_post_template_file', 'amp_woocommerce_custom_woocommerce_template', 10, 3 );
	function amp_woocommerce_custom_woocommerce_template( $file, $type, $post ) {
		global  $redux_builder_amp;
		if ( 'single' === $type && 'product' === $post->post_type ) {

			if ( class_exists( 'Ampforwp_Init' ) && $redux_builder_amp['amp-design-selector'] == 2) {
					$file = dirname(__FILE__) . '/templates/design2-wc.php';
			} elseif( class_exists( 'Ampforwp_Init' ) && $redux_builder_amp['amp-design-selector'] == 3 ) {
					$file = dirname(__FILE__) . '/templates/design3-wc.php';
			}else {
					$file = dirname(__FILE__) . '/templates/wc.php';
			}

		}
		return $file;
	}

/* Add WooCommerce elements in the page

	1. Add WooCommerce container
	2. Add Custom Style for WooCommerce Page
	3. Add WooCommerce gallery
	4. Add WooCommerce amp-carousel script
	5. Remove Default Post Meta from header
	6. Add WooCommerce Meta information
	7. Add Product Description
*/
	// 1. Add WooCommerce container
	// Add container for WooCommerce elements
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_container_starts',9);
	function amp_woocommerce_container_starts(){
		echo ' <div class="amp-woocommerce-container">' ;
	}

	add_action('amp_woocommerce_after_the_content','amp_woocommerce_container_ends',20);
	function amp_woocommerce_container_ends() {
      global $woocommerce;

      if( $woocommerce->product_factory->get_product()->product_type === "variable" ) {
        $get_available_variations  = $woocommerce->product_factory->get_product()->get_available_variations();
        $total_vartiants = count($get_available_variations);
    ?>

    <!--start of main div for variant-->
    <!-- amp-wp-conatiner -->
    <div class="amp-wp-content">
            <div class="amp-conatiner">
              <!--variant-title -->
                <div class="varients-title">
                  <h3>VARIENTS</h3>
                </div>
              <!-- /.variant-title -->
                <!-- main-container -->
                  <div class="wcv-main-container">

              <!-- /.placeholder -->
                <a name="amp-wp-content"></a>
              <!-- /.placeholder -->

              <?php
              for ( $i=0 ; $i < $total_vartiants ; $i++ ) { ?>
                <!--start of div for description-->
                   <?php
                   /// code start for description of the variant
                   $variant_attr_count = count($get_available_variations[$i]['attributes']);
                   $variant_attr = array_values($get_available_variations[$i]['attributes']);
                   /// code end for description of the variant
                    ?>
                <!--end of div for description-->

                    <!--amp-buttons-->
                      <div class="amp-buttons <?php if($get_available_variations[$i]['image_src']) { ?><?php } else { ?>ampwc-noimg-varients<?php } ?>">

                        <!--attributes div-->
                          <div class="product-size"> <?php
                            for ($j=0; $j<$variant_attr_count ; $j++) {
                              echo $variant_attr[$j];
                            } ?>
                          </div>
                        <!--attributes div-->

                       <!--amp-img -->
                         <div class="amp-img">
<a href="<?php echo trailingslashit(get_permalink()).'?add-to-cart='.$get_available_variations[$i]["variation_id"]; ?>">
<?php if($get_available_variations[$i]['image_src']) { ?>
<amp-img src="<?php echo $get_available_variations[$i]['image_src'];?>" height="500" layout="responsive" width="500">
</amp-img>
<?php } else { ?>
<?php } ?></a>
                            <?php echo $get_available_variations[$i]['price_html'] ?>
                            <div class="add-cart">
                              <a href="<?php echo trailingslashit(get_permalink()).'?add-to-cart='.$get_available_variations[$i]["variation_id"]; ?>">Select</a>
                            </div>
                        </div>
                     </div>
              <?php } ?>
                </div>
 </div> 
        </div> 
         <div class="cb"></div>
      </div>
		<?php }// end of if condition
    echo '</div>' ; }

add_action('amp_woocommerce_before_the_content','amp_woocommerce_bfr_content');
function amp_woocommerce_bfr_content() {
  // end of if condition for variant check
} // end of amp_woocommerce_bfr_content()

	// 2. Add Custom Style for WooCommerce Page
	add_action('amp_post_wc_specific_template_css','amp_woocommerce_custom_style');
	function amp_woocommerce_custom_style() {
		if ( function_exists( 'is_on_sale' ) ) {
			global $woocommerce;
			$amp_woocommerce_sale =	$woocommerce->product_factory->get_product()->is_on_sale();
			if ( $amp_woocommerce_sale == 1 ) { ?>
				.amp-wp-article-featured-image::before {
					content: 'Sale';
					background: #0a89c0;
					padding: 20px 15px;
					border-radius: 50%;
					color: #fff;
					position: relative;
					z-index: 1;
					left: 5%px;
					top: 30px;
				}
			<?php } ?>
				.amp-woocommerce-container amp-carousel {
					background: none;
				}

			<?php } ?>
			.amp-wp-meta.amp-woocommerce-add-cart{
			        display: block;
			}
			.amp-wp-article .ampforwp-add-to-cart-button a{
			color:#fff
			}
			input,select{vertical-align:middle}
			*,*:after,*:before {box-sizing: border-box;-webkit-box-sizing: border-box;-moz-box-sizing: border-box;-ms-box-sizing: border-box;-o-box-sizing: border-box;}

			.wcv-main-container{
				width:100%;
			    display:inline-block
			}
			.amp-buttons{
				width:50%;
			    padding:10px;
				height:auto;
				float:left;
				line-height:0;
			}
			.amp-img > img{
				width:100%;
				height:auto;
			}
			.amp-img{
				position:relative;
			}

			.price{
			color: #999; 
			}
            .amp-woocommerce-container .price{    color: #999; text-align:center;
    display: block;font-size:14px; 
    height: 30px;}
			.add-cart {
			  bottom: 40px;
			  position: absolute;
			  right: 15px;
			}
			.amp-img {
			  margin-top: 20px;
			}
			.product-size {
			   text-align: center;
			}
			.amp-wp-meta.amp-woocommerce-price {
			  float: left;
			  width: 50%;
			}
			.amp-wp-meta.amp-woocommerce-add-cart {
			   float: left;
			   width: 50%;
			   text-align:right;
			}
			.Add-to-cart {
			  float: right;
			  width: 20%;
			  text-align:right;
			  font-size:12px;
			}
			.add-cart a {
			    background: #0a89c0;
			    padding: 10px 20px;
			    border-radius: 60px;
			    color: #fff;
			}
			.amp-wp-content{
			font-size:13px;
			padding:8px 10px;
			}
			.amp-wp-content, .amp-wp-title-bar div, .amp-woocommerce-container {
			  clear: both;
			}
			.amp-woocommerce-container > div {
			  padding-top: 20px;
			}
			.ampforwp-add-to-cart-button {
			  display: block;
			}
			.amp-wp-content.the_content.amp-wp-article-content p {
			  text-align: justify;
			}
			.varients-title {
			    text-align: center;
			    margin-top: 20px;
			}
			.varients-title h3 {
			  color: #373737;
			  font-size: 16px;
			  letter-spacing: 0.5px;
			  margin: 0;
			}
			.amp-wp-meta .ampforwp-add-to-cart-button a {
				padding: 7px 20px;
			}
			.ampforwp-add-to-cart-button a {
			    background: #0a89c0;
			    color: #fff;
			    padding: 7px 20px;
			    text-decoration: none;
			    border-radius: 40px;
			}
			.amp-woocommerce-meta-info {
			    display: inline-block;
			    width: 100%;
			    padding:10px;
			}
			.amp-woocommerce-meta-info .amp-wp-meta{
			    font-size:15px;
			}
			.amp-wp-article amp-carousel {
				background: none
			}
			/* responsive styles for mobile */
			@media (max-width:767px){
			.amp-wp-content, .amp-wp-content.post-title-meta.amp-wp-article-header{
				width: 100%;
				padding:0 10px;
			}
			.amp-img {
			  margin-top: 14px;
			}
			.amp-buttons {
			  width:50%;
			  padding-bottom: 5px;
			}

			.product-size {
			  font-size: 13px;
			}
			.add-cart {
			  bottom: 25px;
			  font-size: 11px;
			  left: 0;
			  margin: 0 auto;
			  position: absolute;
			  right: 0;
			  text-align: center;
			  top: auto;
			}

			.amp-conatiner {
			  clear: both;
			  margin: 0 auto;
			  width: 100%;
			}
			.add-cart a {
			  padding: 4px 8px;
			}
			.product-size {
			  padding-top: 10px;
			line-height:1.5
			}

			.amp-wp-meta.amp-woocommerce-price {
			  float: left;
			 }
			.amp-wp-meta.amp-woocommerce-add-cart {
			  display:block;
			  float: left;
			  text-align: center;
			 }
			.Add-to-cart {
			  float: right;
			  font-size: 12px;
			  text-align: right;
			  width: 30%;
			}
			.amp-wp-content, .amp-wp-content.post-title-meta.amp-wp-article-header {
			  clear: both;
			}
			.amp-wp-content.the_content.amp-wp-article-content p {
			  text-align: justify;
			  line-height:21px;
			}
			.amp-woocommerce-container > div {
			  padding-top: 10px;
			}
			}
			@media (max-width:375px){
			 .wcv-main-container .amp-buttons{width:100%;margin:0;padding:0}
			}
			@media (min-width:768px) and (max-width:979px){
			.amp-wp-content{
				width: 750px;
			}
			}
			@media (min-width:980px) and (max-width:1199px){
			.amp-wp-content{
				width: 950px;
			}
			}
			@media (min-width:480px) and (max-width:767px){
			.amp-buttons {
			  width: 50%;
			}

			.add-cart a {
			  padding: 6px 15px;
			}
			.product-size {
			  padding-top: 20px;
			}
			.amp-wp-meta.amp-woocommerce-price {
			  width: 50%;
			}
			.amp-wp-meta {
			  font-size: 12px;
			}
			.amp-wp-meta.amp-woocommerce-add-cart {
			  float: left;
			  text-align: right;
			}
			}
			.amp-wp-article .add-cart a{
			color:#fff
			}
			.ampwc-noimg-varients .add-cart{
			    position: relative;
			    text-align:center;
			    bottom: 0;
			    right: 0;
			}
			.ampwc-noimg-varients{
			    display: inline-block;
			    margin-bottom: 15px;
			}
			.ampwc-noimg-varients .product-size{    float: none;
			    margin-right: 7px;
			    display: block;
			    margin-bottom: 30px;}
			.ampwc-noimg-varients .amp-img{float:none}
			.ampwc-noimg-varients .add-cart a{padding:6px 16px}
			<?php }
	// 3. Add WooCommerce gallery
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_add_wc_elements_gallery');

	function amp_woocommerce_add_wc_elements_gallery(){
		if ( ! function_exists( 'get_gallery_attachment_ids' ) ) {
			global $woocommerce;
				$amp_woocommerce_gallery =	$woocommerce->product_factory->get_product()->get_gallery_attachment_ids();
				if ( $amp_woocommerce_gallery ) { ?>
					<amp-carousel width="400"
					  height="300"
					  layout="responsive"
					  autoplay
					  delay="2000"
					  type="slides">
						<?php
						foreach ($amp_woocommerce_gallery as $amp_woocommerce_image) {
							$attachment_image = wp_get_attachment_image_src( $amp_woocommerce_image, $size = 'large');
							$attachment_image = $attachment_image[0];
							?>
							<amp-img src="<?php echo esc_url($attachment_image); ?>"
							    width="400"
							    height="300"
							    layout="responsive"></amp-img>
							<?php
						} ?>
					</amp-carousel>
					<?php
				}
		}
	}

	// 4. Add WooCommerce amp-carousel script only if WC galley is available
	add_filter( 'amp_post_template_data', 'amp_woocommerce_add_amp_carousel_script', 20 );
	function amp_woocommerce_add_amp_carousel_script( $data ) {
		global $redux_builder_amp;
		$post_type = '';
		$post_type = get_post_type();

		if ( $post_type == 'product' &&  ! function_exists( 'get_gallery_attachment_ids' ) ) { 
			if ( empty( $data['amp_component_scripts']['amp-carousel'] ) ) {
				$data['amp_component_scripts']['amp-carousel'] = 'https://cdn.ampproject.org/v0/amp-carousel-0.1.js';
			}
		}

		return $data;
	}

	// 5. Remove Default Post Meta from header

	// removed directly for now, but will use filters

		// 	// 5.1 Remove Meta Author info
		// add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_remove_meta_author' );
		// function amp_woocommerce_remove_meta_author( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-author', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }
		// 	// 5.2 Remove Meta Time info
		// add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_remove_meta_time' );
		// function amp_woocommerce_remove_meta_time( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-time', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }
		// 	// 5.3 Remove Comments button

		// if ( 'product' === $post->post_type ) {
		// 	add_filter( 'amp_post_article_footer_meta', 'amp_woocommerce_remove_comment_button' );
		// }

		// function amp_woocommerce_remove_comment_button( $meta_parts ) {
		// 	foreach ( array_keys( $meta_parts, 'meta-comments-link', true ) as $key ) {
		// 		unset( $meta_parts[ $key ] );
		// 	}
		// 	return $meta_parts;
		// }

	// 6. Add WooCommerce Meta information
	add_filter( 'amp_post_article_header_meta', 'amp_woocommerce_add_wc_meta' );
	function amp_woocommerce_add_wc_meta( $meta_parts ) {
		$meta_parts[] = 'amp-woocommerce-meta-info';
		return $meta_parts;
	}

	add_filter( 'amp_post_template_file', 'amp_woocommerce_add_wc_meta_path', 10, 3 );
	function amp_woocommerce_add_wc_meta_path( $file, $type, $post ) {
		if ( 'amp-woocommerce-meta-info' === $type  && 'product' === $post->post_type ) {

			$file = dirname( __FILE__ ) . '/templates/amp-woocommerce-meta-info.php';

		}
		return $file;
	}

	// 7. Add Product Description
	add_action('amp_woocommerce_after_the_content','amp_woocommerce_add_product_description', 11);

	function amp_woocommerce_add_product_description(){

		global $post;
		$sanitized_excerpt = '';
		$post_excerpt = '';

		$post_excerpt = $post->post_excerpt;
		$post_excerpt = wpautop( $post_excerpt );

		$sanitized_excerpt = new AMPFORWP_Content( $post_excerpt, array(), 
			apply_filters( 'ampforwp_content_sanitizers',
				array( 
					'AMP_Style_Sanitizer' 		=> array(),
					'AMP_Blacklist_Sanitizer' 	=> array(),
					'AMP_Img_Sanitizer' 		=> array(),
					'AMP_Video_Sanitizer' 		=> array(),
					'AMP_Audio_Sanitizer' 		=> array(),
					'AMP_Iframe_Sanitizer' 		=> array(
						'add_placeholder' 		=> true,
					)
				) ) );
		$sanitized_excerpt = $sanitized_excerpt->get_amp_content();

		echo $sanitized_excerpt;
	}