<?php
/**
 * Single product short description
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/short-description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $post;

$short_description = apply_filters( 'woocommerce_short_description', $post->post_excerpt );

if ( ! $short_description ) {
	return;
}

?>
<div class="woocommerce-product-details__short-description">
	<?php

#gallery
$regex = '/\[gallery(.*?)ids="(.*?)"(.*?)\]/';
$string = $short_description ;
$string =  str_replace(array('&#8221;','&#8243;'),array('"','"'), $string);
$markup = '';
$output = preg_replace_callback($regex,
    function($m)use($string) {

        static $id = 0;
        $id++;
        $tab_content = '';
        if($m){
            $gal_img_ids = $m[2];
            $id_array = explode(',', $gal_img_ids);
           $markup = '<div class = "amp_wp_gal">';
            if ( is_array($id_array) ){
                foreach ($id_array as $id_key => $id_value) {
                  $url =  wp_get_attachment_url(  $id_value );
                  $markup .='<amp-img class="w-wp-gallery" width="150" height="150" src="'.esc_url($url).'"></amp-img>';
                }
              }
            $markup .= '</div>';

            return $markup;
            
        }

        return $tab_content;
    },
    $string);
    if(preg_match($regex, $string)){
      $output =  preg_replace('/\[gallery ids=(.*?)\]/', $markup , $output);
      echo $output; // XSS Ok.
    }else{
      echo $short_description;
    }// WPCS: XSS ok. ?>
</div>
