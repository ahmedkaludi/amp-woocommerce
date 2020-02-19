<?php
/**
 * Description tab
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;

$heading = esc_html( apply_filters( 'woocommerce_product_description_heading', __( 'Description', 'amp-woocommerce' ) ) );

?>

<?php if ( $heading ) : ?>
  <h2><?php echo esc_html($heading); ?></h2>
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

            $id_array = explode(',',  $gal_img_ids);
            $markup = '<div class = "amp_wp_gal">';
            foreach ($id_array as $id_key => $id_value) {

              $url =  wp_get_attachment_url( $id_value );
              $markup .='<amp-img class="w-wp-gallery" width="150" height="150" src="'.esc_url($url).'"></amp-img>';
            }
            $markup .= '</div>';
            return $markup;
            
        }

        return $tab_content;
    },
    $string );
    if(preg_match($regex, $string)){
  
     $output =  preg_replace('/\[gallery ids=(.*?)\]/', $markup , $output);
     echo $output; // XSS Ok.
    }else{

      echo $content; // XSS Ok.
    }
do_action('ampwcpro_after_the_description');

?>
