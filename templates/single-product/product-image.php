<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<figure class="woocommerce-product-gallery__wrapper">

	<?php $allStaticData = ampwoo_product_json_generator('array');


          $variant_slug = array();
      foreach($allStaticData['attributes'] as $attrKey=>$attr){
      
          if($attr['is_variation']==0){
            continue;
          }
          $attributeName = "a".$attr['id'];
          $variant_slug[] = $attributeName; 
      }   
    $variant_slug = implode(".sOpt+",$variant_slug);
    $variant_slug = $variant_slug.'.sOpt+';
    $variant_slug = substr_replace($variant_slug,"", -1);

   ?>
<amp-state id="img_prev_next">
  <script type="application/json"><?php 
        $img_array = array();
       foreach ($allStaticData['bigImage'] as $key => $gallery) {
            $img_array['images'][] = $gallery[0];
       } $img_array['next_img'] = 1; 
        $img_array['prev_img'] = count($img_array['images']) - 1; 
       echo json_encode($img_array);
   ?></script>
</amp-state>

<div class="gallery-big-image">
        <?php
        foreach ($allStaticData['bigImage'] as $key => $gallery) {
            $class="hide";
            $swatch_src = $swatch_width = $swatch_height = '';
            $default_width = 494; $default_height = round(((494/esc_attr($gallery[1]))*(esc_attr($gallery[2]))),3);
             $vriant_attrbtes_bind = '.variant_attributes['.$variant_slug.']';
            if($variant_slug == '.sOpt'){
              $vriant_attrbtes_bind = '';
            }
            if($key==0){
                $class="show fadeIn";
                if($allStaticData['product']['product_type'] == "variable"){
                  $swatch_src = 'data-openbracksrcclosebrack = "(product'.$vriant_attrbtes_bind.'.swatch_image.bigswatch_url)? product'.$vriant_attrbtes_bind.'.swatch_image.bigswatch_url:\''.esc_url($gallery[0]).'\'"'; 
                  $swatch_width = 'data-openbrackwidthclosebrack = "((product'.$vriant_attrbtes_bind.'.swatch_image.bigswatch_url))?494:'.$default_width.'"'; 
                  $swatch_height = 'data-openbrackheightclosebrack = "((product'.$vriant_attrbtes_bind.'.swatch_image.bigswatch_url))?product'.$vriant_attrbtes_bind.'.swatch_image.height:'.$default_height.'"';
                  } 
            }
          if($gallery[0] != NULL) { ?>
            <amp-img  src="<?php echo esc_url($gallery[0]); ?>" <?php echo  $swatch_src;
            echo $swatch_height; ?>   width="<?php echo esc_attr($gallery[1]); ?>" class="<?php echo $class; ?>" [class]="(+product.selectedImage)==<?php echo $key; ?> ? 'show fadeIn' : 'hide'" height="<?php echo esc_attr($gallery[2]); ?>" layout=responsive></amp-img> 
          <?php } 
          else{ 
            $placeholder_url = AMP_WOO_PLUGIN_URI.'assets/placeholder.png';  ?>
              <amp-img  src="<?php echo esc_url($placeholder_url); ?>" width="450px" class="show fadeIn" height="450px" layout=responsive></amp-img> 
         <?php }
        } ?>
        <?php  if(count($img_array['images']) > 1 ) { ?>
    <div class="img_prev"  role="click" tabindex="3" on="tap:AMP.setState({
                      img_prev_next:{prev_img:(img_prev_next.prev_img <= 0 ? <?php echo count($img_array['images']) - 1; ?>: (img_prev_next.prev_img)-1 )},
                      product: {selectedImage: img_prev_next.prev_img }
                  })" ><span></span>
    </div> 
    <div class="img_next"  role="click" tabindex="4" on='tap:AMP.setState({
                      img_prev_next:{next_img:(img_prev_next.next_img >= <?php echo count($img_array['images']) - 1; ?> ? 0 : (img_prev_next.next_img)+1 )}, 
                      product: {selectedImage: img_prev_next.next_img }
                  })' ><span></span>
    </div> 
<?php  } ?>
</div><!-- /.gallery-big-image -->
<!-- .small-image -->
<?php
if( $allStaticData['gallery'][0] == true && count($img_array['images']) > 1) {  ?>
           <div class="gallery-multi-images">
          <amp-selector name="color" layout="container" [selected]="product.selectedImage" on="select:AMP.setState({
                      product: {
                        selectedImage: event.targetOption,
                      }
                    })">
              <ul class="p0 m1">
            <?php 
             $vriant_attr_bd = '.variant_attributes['.$variant_slug.']';
            if($variant_slug == '.sOpt'){
              $vriant_attr_bd = '';
            }
            foreach ($allStaticData['gallery'] as $key => $gallery) { 
              $swatch_thumb_src = $swatch_thumb_src_width = $swatch_thumb_src_height ='';
              if($key==0){
                  $swatch_thumb_src = 'data-openbracksrcclosebrack = "(product'.$vriant_attr_bd.'.swatch_image.big_tmb_src)? product'.$vriant_attr_bd.'.swatch_image.big_tmb_src : \''.esc_url($gallery[0]).'\'"'; 
                  $swatch_thumb_src_width = 'data-openbrackwidthclosebrack = "60"'; 
                  $swatch_thumb_src_height = 'data-openbrackheightclosebrack = "60"'; 

            }
              
                if($allStaticData['gallery']){ ?>   
                  <li class="small-image">
                     <amp-img src="<?php echo esc_url($gallery[0]); ?>"
                       <?php echo $swatch_thumb_src; 
                             echo $swatch_thumb_src_width;
                             echo  $swatch_thumb_src_height; ?>
                             selected="selected"
                              option="<?php echo $key; ?>" 
                              width="<?php echo esc_attr($gallery[1]); ?>"
                              height="<?php echo esc_attr($gallery[2]); ?>"
                              layout=responsive>
                      </amp-img>
                   </li>
            <?php } 
              }?>
          </ul>
        </amp-selector>
      </div><!-- /.gallery-small-images --> 
    <?php } ?>
<div style="clear: both;"> </div>
	</figure>
</div>
