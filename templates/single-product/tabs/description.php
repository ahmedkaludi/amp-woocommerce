<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'woocommerce' ) ) );

?>

<?php if ( $heading ) : ?>
  <h2><?php echo $heading; ?></h2>
<?php endif; ?>

<?php ob_start();
		the_content();
		$content = ob_get_contents();
		ob_get_clean();


		#gallery
$regex = '/\[gallery(.*?)ids="(.*?)"(.*?)\]/';
$string = $content ;
$string =  str_replace(array('&#8221;','&#8243;'),array('"','"'), $string);

$output = preg_replace_callback($regex,
    function($m)use($string) {

        static $id = 0;
        $id++;
        $tab_content = '';
        if($m){
            $gal_img_ids = $m[2];

           // $id =  str_replace(array('&#8221;','&#8243;'),array('',''), $gal_img_ids);
            $id_array = explode(',',  $gal_img_ids);
            $markup = '<div class = "amp_wp_gal">';
            foreach ($id_array as $id_key => $id_value) {

              $url =  wp_get_attachment_url( $attachment_id = $id_value );
              $markup .='<amp-img class="w-wp-gallery" width="150" height="150" src="'.$url.'"></amp-img>';
            }
            $markup .= '</div>';
            return $markup;
            
        }

        return $tab_content;
    },
    $string );
    if(preg_match($regex, $string)){
  
     $output =  preg_replace('/\[gallery ids=(.*?)\]/', $markup , $output);
     echo $output;
    }else{

      echo $content;
    }
do_action('ampwcpro_after_the_description');

?>
