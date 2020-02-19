<?php global $redux_builder_amp;
ob_start();
?><div class="wcsdbr-lft wcsdbr"><?php 
do_action( 'woocommerce_before_main_content' );


 while ( have_posts() ) : the_post(); 

wc_get_template_part( 'content', 'single-product' ); 

endwhile; 

do_action( 'woocommerce_after_main_content' );

?></div> 
   <?php

$single_product_html = ob_get_contents();
ob_get_clean();
$sanitizer_content = '';
if(class_exists('AMPFORWP_Content')){
$sanitizer_obj = new AMPFORWP_Content( $single_product_html,
						array(), 
						apply_filters( 'amp_content_sanitizers', 
							array( 'AMP_Img_Sanitizer' => array(), 
								'AMP_Blacklist_Sanitizer' => array(),
								'AMP_Style_Sanitizer' => array(), 
								'AMP_Video_Sanitizer' => array(),
		 						'AMP_Audio_Sanitizer' => array(),
		 						'AMP_Iframe_Sanitizer' => array(
									 'add_placeholder' => true,
								 ),
							) 
						) 
					);
$sanitizer_script = $sanitizer_obj->get_amp_scripts();
$GLOBALS['sanitized_wc_styles'] = $sanitizer_obj->get_amp_styles();
$sanitizer_content = $sanitizer_obj->get_amp_content();

add_action("amp_post_template_css" , 'amp_woo_single_product_inline_css');
}
function amp_woo_single_product_inline_css(){
	  foreach ($GLOBALS['sanitized_wc_styles'] as $key => $value) {
	  	$inline_css = $key.'{'.$value[0].'}';
	  echo amp_woo_css_sanitizer($inline_css); //XSS OK.
	  }
}

$pluginsData = array();
$design_selected = '';
$pluginsData = get_transient( 'ampforwp_themeframework_active_plugins' );
if(isset($redux_builder_amp['amp-design-selector'])){
 $design_selected=$redux_builder_amp['amp-design-selector'];
}
if( isset($redux_builder_amp['amp-design-selector']) && 4 == $redux_builder_amp['amp-design-selector'] ) { 
	$this->load_parts( array( 'header' ) );
	do_action( 'ampforwp_after_header', $this );
}
elseif( isset($pluginsData[$design_selected]['value']) && isset($redux_builder_amp['amp-design-selector']) && $pluginsData[$design_selected]['value'] === $redux_builder_amp['amp-design-selector']){
if(function_exists('amp_header')){
	amp_header();
}
}
else { ?>
	<!doctype html>
	<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
	<head>
		<meta charset="utf-8">
		<?php do_action( 'amp_post_template_head', $this ); ?>
		<style amp-custom>
			<?php include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
				  if ( ! is_plugin_active( 'amp-newspaper-theme/ampforwp-custom-theme.php' ) ) {  
							  $this->load_parts( array( 'style' ) ); 
					}
		  	?>
			<?php do_action( 'amp_post_template_css', $this ); ?>
			<?php do_action( 'amp_css', $this ); ?>
			<?php do_action( 'amp_post_wc_specific_template_css', $this ); ?>
		</style>
	</head>

	<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?> woocommerce  woocommerce-page ">
		<?php do_action('ampforwp_body_beginning', $this); ?>
		<?php $this->load_parts( array( 'header-bar' ) ); ?>
		<?php do_action( 'ampforwp_after_header', $this ); ?>
<?php } ?>
<?php $allStaticData = amp_woo_product_json_generator('array'); 
global $post, $woocommerce, $wp, $redux_builder_amp; ?>
<amp-state id="product">
  <script type="application/json"><?php echo amp_woo_product_json_generator();
   ?>
  </script>
</amp-state>
<amp-state id="wc_product_cart">
  <script type="application/json"><?php echo wp_json_encode(array("cartvalue"=>1));
   ?>
  </script>
</amp-state>
<div class="ampwoocommerce sdf">
<div id="content" class="v3_wc_content_wrap">
	<?php
	 echo  $sanitizer_content; // XSS OK
	?>
</div>
</div>
	<?php do_action( 'amp_post_template_above_footer', $this ); ?>
	<?php $this->load_parts( array( 'footer' ) ); ?>
	<?php do_action( 'ampwcpro_post_template_footer', $this ); ?>

</body>
</html>
