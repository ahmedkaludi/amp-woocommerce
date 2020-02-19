<?php 
add_filter('ampforwp_the_content_last_filter','amp_woo_comment_html'); 

function amp_woo_comment_html($comments_html){

  $submit_url =  admin_url('admin-ajax.php?action=amp_woo_comment_handle'); 
  $actionXhrUrl = preg_replace('#^https?:#', '', $submit_url);

        $comments_html = preg_replace('/<form action="(.*?)"(.*?)>/','<form action-xhr="'.esc_url($actionXhrUrl).'"$2>', $comments_html);
        if(preg_match('/<form(.*?)id="commentform"(.*?)<\/form>/s', $comments_html)){
        $comments_html = preg_replace('/<form(.*?)id="commentform"(.*?)<\/form>/s','
          <form$1id="commentform"$2
            <div submit-success>
    				 <template type="amp-mustache">
      				 <div class="checkout_form_success" style="color:green;">
               {{response}}
               </div>
    				</template>
  			   </div>					 
  			  <div submit-error>
    				<template type="amp-mustache">
    				 <div class="checkout_form_error" style="color:red;">
             {{response}}
             </div>
    				</template>
			    </div>
       </form>',$comments_html);
        }
      if(preg_match('/<script>(.*?)<\/script>/s', $comments_html)){
        $comments_html = preg_replace('/<script>(.*?)<\/script>/s', '', $comments_html);
      }
      if(preg_match('/<script\stype="text\/javascript">(.*?)<\/script>/s', $comments_html)){
        $comments_html = preg_replace('/<script\stype="text\/javascript">(.*?)<\/script>/s', '', $comments_html);
      }

      return $comments_html; 
}


add_filter('woocommerce_product_review_comment_form_args','amp_woo_rating_markup',10,1);

function amp_woo_rating_markup($comment_form){

  if ( (function_exists( 'ampforwp_is_amp_endpoint' ) && ampforwp_is_amp_endpoint()) 
  	|| (function_exists( 'is_amp_endpoint' ) && is_amp_endpoint()) ) {
    $rating_test = 'Your rating';
$comment_form['comment_field'] = preg_replace('/<div class="comment-form-rating">(.*?)<\/div>/si', '<div class="comment-form-rating"><label for="rating">'.esc_html__($rating_test,'amp-woocommerce').'</label>         <fieldset class="ratingtest">
            <input name="rating" type="radio" id="rating5" value="5" on="change:rating.submit" required />
            <label for="rating5" title="1 stars" >☆</label>

            <input name="rating" type="radio" id="rating4" value="4" on="change:rating.submit" />
            <label for="rating4" title="2 stars" >☆</label>

            <input name="rating" type="radio" id="rating3" value="3" on="change:rating.submit" />
            <label for="rating3" title="3 stars" >☆</label>

            <input name="rating" type="radio" id="rating2" value="2" on="change:rating.submit" />
            <label for="rating2" title="4 stars" >☆</label>

            <input name="rating" type="radio" id="rating1" value="1" on="change:rating.submit" />
            <label for="rating1" title="5 stars" >☆</label>
          </fieldset></div>',$comment_form['comment_field']);
}
return $comment_form;

}

add_action("wp_ajax_amp_woo_comment_handle", "amp_woo_comment_handle");
add_action("wp_ajax_nopriv_amp_woo_comment_handle", "amp_woo_comment_handle");

function amp_woo_comment_handle(){
  global $redux_builder_amp;
  header("access-control-allow-credentials:true");
  header("access-control-allow-headers:Content-Type, Content-Length, Accept-Encoding, X-CSRF-Token");
  header("Access-Control-Allow-Origin:".esc_url($_SERVER['HTTP_ORIGIN']));
  $siteUrl = parse_url(  get_site_url() );
  $source_origin = $siteUrl['scheme'] . '://' . $siteUrl['host'];
  header("AMP-Access-Control-Allow-Source-Origin:".esc_url($source_origin));
  header("access-control-expose-headers:AMP-Access-Control-Allow-Source-Origin");
  header("Content-Type:application/json;charset=utf-8");
  $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
  $text_data = 'Thank you for submitting comment, we will review it and will get back to you.';
  if ( is_wp_error( $comment ) ) {
    $error_data = intval( $comment->get_error_data() );
    if ( ! empty( $error_data ) ) {
      $comment_html = $comment->get_error_message();
      $comment_html = str_replace("&#8217;","'",$comment_html);
      $comment_html = str_replace(array('<strong>','</strong>'),array('',''),$comment_html);
      $comment_status = array('response' => esc_html($comment_html) );
      header('HTTP/1.1 500 FORBIDDEN');
      echo wp_json_encode($comment_status);
      die;
    } else {
      wp_die( 'Unknown error' );
    }
  }

  $user = wp_get_current_user();
  do_action('set_comment_cookies', $comment, $user);
 
  $comment_depth = 1;
  $comment_parent = $comment->comment_parent;
  while( $comment_parent ){
    $comment_depth++;
    $parent_comment = get_comment( $comment_parent );
    $comment_parent = $parent_comment->comment_parent;
  }
  $comment_html = $text_data;
  $comment_status = array('response' => esc_html($comment_html) );
  
  echo wp_json_encode($comment_status);
  die;
}
