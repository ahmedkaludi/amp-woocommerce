<?php // 2. Add Custom Style for WooCommerce Page

function amp_woo_main_css(){
    if(function_exists('amp_woo_active_theme_data') && amp_woo_active_theme_data('theme_name') == 'Flatsome' && function_exists('is_woocommerce') && is_woocommerce()){
         add_action('amp_post_template_css', 'amp_woo_flatsome_default_css_v3',11);
         add_action('amp_post_template_css', 'amp_woo_flatsome_theme_custom_css',11);
       }else{

        add_action('amp_post_template_css','amp_woo_custom_styles',999);
        add_action('amp_post_template_css', 'amp_woo_default_woocommerce_css',11);

          if( function_exists('amp_woo_active_theme_data') && amp_woo_active_theme_data('theme_name') == 'The7' ){   
              add_action('amp_post_template_css','amp_woo_The7',999);      
              }   
              if( function_exists('amp_woo_active_theme_data') && amp_woo_active_theme_data('theme_name') == 'Rehub theme'  ||  function_exists ('rehub_framework_register_scripts') ) {  
                  add_action('amp_post_template_css','amp_woo_Rehub_theme',11);  
              }
              if( function_exists('amp_woo_active_theme_data') && amp_woo_active_theme_data('theme_name') == 'XStore' ) {                  
                  add_action('amp_post_template_css','amp_woo_XStore_theme',11);  
              }
      }
}


// Woocommerce Default CSS
function amp_woo_custom_styles() {
  global $redux_builder_amp;
?>

/** Custom CSS for 3.2 Design **/
.fa-user:before {content: "\f007";display:none;}.fa.fa-user a:after {content: "\f007";color: #000;}.adminampwc.fa.fa-user {top: 20px;position: relative;}
.data_field_name{
   margin-bottom: 20px;
   width: 70%;
   display: inline-flex;
}
.added_serv_wrapper{
  border-top: 1px solid #ab9595d4;
  padding-top: 10px;
  border-bottom: 1px solid #ab9595d4;
  padding-bottom: 10px;
}
.wc-pao-addon-container{
  margin-top:20px;
}
span#total_wcbk_amount{
    background: #eee;
    display: inline-flex;
    padding:1em;
}
#total_wcbk_amount_hide {
    background: #eee;
    display: inline-flex;
    padding:1em;
}
#wc-bookings-booking-form .hide{
  display:none;
}
div#added_serv_wrapper {
    border-top: 2px solid #eee;
    padding-top: 20px;
    border-bottom: 2px solid #eee;
}
.wc-pao-addon-wrap .woocommerce-Price-amount{
    width:auto;
}
.woocommerce .cart_totals .woocommerce-Price-amount{
 width: auto;
}
span.data_field_name {
    margin-bottom: 20px;
    width: 70%;
    display: inline-flex;
}.input-text-c_o_amp {
    -webkit-text-security: disc;
}
@media(max-width:320px){
amp-date-picker#static-picker {
    margin-left: -20px;
}
}
amp-script{
  opacity:1;
}
.var_show_price{
 margin-left: 10px;
}

.woocommerce-Price-amount{
  color: #333;
  margin: 7px 0;
  display: inline-block;
  width: 100%;
}
.product-type-booking .price{
  display:none;
}
.woocommerce-product-details__short-description {
    clear: both;
}
#booking_wrapper div > p{
  font-size: 12px;
  color: #000;
  margin-bottom: 5px;
}
#booking_wrapper input{
  padding:10px;
  border:1px solid #ccc;
}
#booking_wrapper input#src-input{
  width:100%;
}
.ppl-tps{
  width:100%;
  display:inline-block;
  margin-top:10px;
}
amp-img.w-wp-gallery {
    margin: 5px;
}
.ppl-tps ul{
  border-top-width: 1px;
  box-shadow: 0 2px 13px 0 rgba(0,0,0,.24), 0 3px 3px -2px rgba(0,0,0,.12);
  padding: 10px 20px;
  margin-top: 6px;
  margin-bottom: 20px;
}
.ppl-tps ul li{
  list-style-type: none;
  padding:10px 0px;
  color:#000;
  font-size: 14px;
}
.st-d, .ppl-txt{
  font-size: 12px;
  color: #000;
  margin-bottom: 6px;
  display: inline-block;
  width: 100%;
}
.ppl-tps li.text{
  display: inline-flex;
  flex-wrap: wrap;
  width: 100%;
  align-items: center;
  justify-content: space-between;
}
.woo-add-sub span{
  padding: 12px 8px;
  line-height: 0;
  display: inline-block;
}
.woo-add-sub .subb, .woo-add-sub .addi{
  border:1px solid #008489;
  cursor: pointer;
}
.yith-wcbk-form-section-service{
  margin-bottom:20px;
}
.yith-wcbk-form-section-service div{
  margin-bottom:6px;
}
.yith-wcbk-form-section-service span{
  font-size:13px;
}
.wcct_countdown_timer .wcct_round_wrap{
  background:#444444;
  border-radius:100px;
  width:60px;
  height:60px;
  line-height:1.3;
  color:#fff;
  display:inline-block;
  align-items: center;
  text-align:center;
  margin-right: 6px;
}
.wcct_round_dyn{
  font-size:20px;
  top:10px;
}
.wcct_round_sta{
  font-size:12px;
  top: 7px;
}
.wcct_round_dyn, .wcct_round_sta{
  display:inline-block;
  width:100%;
  position: relative;
}
.wcct_des{
  font-size:12px;
  line-height:1.2;
  color:#222;
  margin-top:15px;
}
#main_data, #lb-picker{
  position:relative;
}
#dateclose{
  position: absolute;
  bottom: 15px;
  left: 15px;
  z-index: 99;
  font-size: 14px;
  color: #000;
  cursor: pointer;
}
.dt-pkr{
  display:inline-flex;
  width:100%;
  flex-wrap:wrap;
}
#booking_wrapper .dt-pkr input{
  width:50%;
}
.woo-add-sub .numb{
  width:30px;
  text-align:center;
}
#src-picker .amp-date-picker-calendar-container{
  position:relative;
}
.product_meta{
  clear:both;
}
.product-type-variable .product_title{margin-bottom:20px;}
.product-type-variable .summary span.woocommerce-Price-amount.amount,li.product-type-variable span.woocommerce-Price-amount.amount{display:inline;}
.price del .amount {text-decoration: line-through;}
<?php
  if( isset($redux_builder_amp['amp-rtl-select-option']) &&  true == esc_attr($redux_builder_amp['amp-rtl-select-option']) ){ ?>
    .login-att, .form-coupen { float: right;}
<?php } ?>

      @media(max-width: 768px){
      .woocommerce table.shop_table_responsive thead,.woocommerce-page table.shop_table_responsive thead{display:none}.woocommerce table.shop_table_responsive tbody tr:first-child td:first-child,.woocommerce-page table.shop_table_responsive tbody tr:first-child td:first-child{border-top:0}.woocommerce table.shop_table_responsive tbody th,.woocommerce-page table.shop_table_responsive tbody th{display:none}.woocommerce table.shop_table_responsive tr,.woocommerce-page table.shop_table_responsive tr{display:block}.woocommerce table.shop_table_responsive tr td,.woocommerce-page table.shop_table_responsive tr td{display:block;text-align:right!important}.woocommerce table.shop_table_responsive tr td.order-actions,.woocommerce-page table.shop_table_responsive tr td.order-actions{text-align:left!important}.woocommerce table.shop_table_responsive tr td::before,.woocommerce-page table.shop_table_responsive tr td::before{content:attr(data-title) ": ";font-weight:700;float:left}.woocommerce table.shop_table_responsive tr td.actions::before,.woocommerce table.shop_table_responsive tr td.product-remove::before,.woocommerce-page table.shop_table_responsive tr td.actions::before,.woocommerce-page table.shop_table_responsive tr td.product-remove::before{display:none}.woocommerce table.shop_table_responsive tr:nth-child(2n) td,.woocommerce-page table.shop_table_responsive tr:nth-child(2n) td{background-color:rgba(0,0,0,.025)}.woocommerce table.my_account_orders tr td.order-actions,.woocommerce-page table.my_account_orders tr td.order-actions{text-align:left}.woocommerce table.my_account_orders tr td.order-actions::before,.woocommerce-page table.my_account_orders tr td.order-actions::before{display:none}.woocommerce table.my_account_orders tr td.order-actions .button,.woocommerce-page table.my_account_orders tr td.order-actions .button{float:none;margin:.125em .25em .125em 0}.woocommerce .col2-set .col-1,.woocommerce .col2-set .col-2,.woocommerce-page .col2-set .col-1,.woocommerce-page .col2-set .col-2{float:none;width:100%}.woocommerce ul.products[class*=columns-] li.product:nth-child(2n),.woocommerce-page ul.products[class*=columns-] li.product:nth-child(2n){float:right;clear:none!important}.woocommerce #content div.product div.images,.woocommerce #content div.product div.summary,.woocommerce div.product div.images,.woocommerce div.product div.summary,.woocommerce-page #content div.product div.images,.woocommerce-page #content div.product div.summary,.woocommerce-page div.product div.images,.woocommerce-page div.product div.summary{float:none;width:100%}.woocommerce #content table.cart .product-thumbnail,.woocommerce table.cart .product-thumbnail,.woocommerce-page #content table.cart .product-thumbnail,.woocommerce-page table.cart .product-thumbnail{display:none}.woocommerce #content table.cart td.actions,.woocommerce table.cart td.actions,.woocommerce-page #content table.cart td.actions,.woocommerce-page table.cart td.actions{text-align:left}.woocommerce #content table.cart td.actions .coupon,.woocommerce table.cart td.actions .coupon,.woocommerce-page #content table.cart td.actions .coupon,.woocommerce-page table.cart td.actions .coupon{float:none;padding-bottom:.5em}.woocommerce #content table.cart td.actions .coupon::after,.woocommerce #content table.cart td.actions .coupon::before,.woocommerce table.cart td.actions .coupon::after,.woocommerce table.cart td.actions .coupon::before,.woocommerce-page #content table.cart td.actions .coupon::after,.woocommerce-page #content table.cart td.actions .coupon::before,.woocommerce-page table.cart td.actions .coupon::after,.woocommerce-page table.cart td.actions .coupon::before{content:' ';display:table}.woocommerce #content table.cart td.actions .coupon::after,.woocommerce table.cart td.actions .coupon::after,.woocommerce-page #content table.cart td.actions .coupon::after,.woocommerce-page table.cart td.actions .coupon::after{clear:both}.woocommerce #content table.cart td.actions .coupon .button,.woocommerce #content table.cart td.actions .coupon .input-text,.woocommerce #content table.cart td.actions .coupon input,.woocommerce table.cart td.actions .coupon .button,.woocommerce table.cart td.actions .coupon .input-text,.woocommerce table.cart td.actions .coupon input,.woocommerce-page #content table.cart td.actions .coupon .button,.woocommerce-page #content table.cart td.actions .coupon .input-text,.woocommerce-page #content table.cart td.actions .coupon input,.woocommerce-page table.cart td.actions .coupon .button,.woocommerce-page table.cart td.actions .coupon .input-text,.woocommerce-page table.cart td.actions .coupon input{width:48%;box-sizing:border-box}.woocommerce #content table.cart td.actions .coupon .button.alt,.woocommerce #content table.cart td.actions .coupon .input-text+.button,.woocommerce table.cart td.actions .coupon .button.alt,.woocommerce table.cart td.actions .coupon .input-text+.button,.woocommerce-page #content table.cart td.actions .coupon .button.alt,.woocommerce-page #content table.cart td.actions .coupon .input-text+.button,.woocommerce-page table.cart td.actions .coupon .button.alt,.woocommerce-page table.cart td.actions .coupon .input-text+.button{float:right}.woocommerce #content table.cart td.actions .button,.woocommerce table.cart td.actions .button,.woocommerce-page #content table.cart td.actions .button,.woocommerce-page table.cart td.actions .button{display:block;width:100%}.woocommerce .cart-collaterals .cart_totals,.woocommerce .cart-collaterals .cross-sells,.woocommerce .cart-collaterals .shipping_calculator,.woocommerce-page .cart-collaterals .cart_totals,.woocommerce-page .cart-collaterals .cross-sells,.woocommerce-page .cart-collaterals .shipping_calculator{width:100%;float:none;text-align:left}.woocommerce-page.woocommerce-checkout form.login .form-row,.woocommerce.woocommerce-checkout form.login .form-row{width:100%;float:none}.woocommerce #payment .terms,.woocommerce-page #payment .terms{text-align:left;padding:0}.woocommerce #payment #place_order,.woocommerce-page #payment #place_order{float:none;width:100%;box-sizing:border-box;margin-bottom:1em}.woocommerce .lost_reset_password .form-row-first,.woocommerce .lost_reset_password .form-row-last,.woocommerce-page .lost_reset_password .form-row-first,.woocommerce-page .lost_reset_password .form-row-last{width:100%;float:none;margin-right:0}.woocommerce-account .woocommerce-MyAccount-content,.woocommerce-account .woocommerce-MyAccount-navigation{float:none;width:100%}.single-product .twentythirteen .panel{padding-left:20px!important;padding-right:20px!important}

      }

      /** Custom CSS **/
      /** Max-width issue - #3727 **/
      .product .star-rating span {
          width: inherit;
      }

     .hide{display:none;}
     .show{ display: block;} 

      /** Tab CSS **/  
      amp-selector[role=tablist].tabs-with-selector {
        display: inline-flex;
        font-size: 15px;
        line-height: 1.3;
        background: #e6e6e6;
        width: 100%;
      }
      .wc-tabs-wrapper{
        margin-top: 50px;
        display: inline-block;
        width: 100%;
        border-top: 1px solid #eee;
      }
      amp-selector[role=tablist].tabs-with-selector [role=tab] {
        width: 100%;
        padding: 10px;
        text-align: center;
        box-sizing:border-box;
      }
      amp-selector[role=tablist].tabs-with-selector [role=tab]:last-child {
        margin-right: 0px;
      }
      amp-selector.tabpanels [role=tabpanel] {
        display: none;
        padding: var(--space-4);
      }
      amp-selector.tabpanels [role=tabpanel][selected] {
        outline: none;
        display: block;
      }
      .has-post-thumbnail{
        position : relative;
      }
      amp-selector.tabs-with-selector [option][selected]{
        position: relative;
        outline: none;
        background: #ddd;
      }
      amp-selector.tabs-with-selector [option][selected]:before {
        content: "";
        display: inline-block;
        border-top: 3px solid #444;
        position: absolute;
        top: -3px;
        left: 0;
        right: 0;
      }
      amp-selector#myTabPanels{
        margin-top: 30px;
      }
      .woocommerce-Tabs-panel h2{
        font-size: 20px;
        font-weight: 400;
        margin-bottom: 30px;
        color: #333;
      }
      .woocommerce-Reviews ol, .woocommerce-Reviews ul{
        padding:0;
        margin:0;
      }
      .woocommerce table.shop_attributes td p{
        font-style: normal;
      }
      .woocommerce #reviews #comments ol.commentlist li .meta{
        color:#333;
      }
      .description{
        font-size: 14px;
        color: #333;
      }
      .meta .woocommerce-review__author{

      }

      /** Gallery Selector image **/
      .woocommerce div.product div.images amp-img.hide{
        display:none;
      }
      .gallery-multi-images .small-image amp-img{
          opacity:0.5;
      }
      .gallery-multi-images .small-image amp-img:hover{
        opacity:1;
      }
      .gallery-multi-images amp-selector [option][selected]{
        opacity:1;
        outline:none;
      }
      .gallery-multi-images ul {
        list-style-type: none;
        display: grid;
        padding: 0;
        width: 100%;
        flex-wrap: wrap;
        margin-top: 20px;
        grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
        grid-gap: 20px 50px;
      }
      .img_prev {
          left: 10px;
      }
      .gallery-big-image, .gallery-big-image amp-img{
        position:relative;
      }
      <!-- .gallery-big-image amp-img{
        max-width:100%;
        max-height:100%;
      } -->
      .img_prev,.img_next{
        background: rgba(0,0,0,.5);
        font-size: 17px;
        font-weight: normal;
        line-height: 1;
        line-height: 30px;
        color: rgba(255,255,255,.7);
        height: 30px;
        cursor: pointer;
        text-align: center;
        font-family: helvatica,sans-serif;
        width: 30px;
        top: 43%;
        position: absolute;
        z-index: 1;
        box-sizing: border-box;
        border-radius: 50%;
      }
      .img_prev span:before{
        content: "";
        display: inline-block;
        position: relative;
        top: -1px;
        color: #fff;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        padding: 3px;
        transform: rotate(135deg);
        left: 1px;
      }
      .img_next span:after{
        content: "";
        display: inline-block;
        position: relative;
        top: -1px;
        color: #fff;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        padding: 3px;
        transform: rotate(-45deg);
        left: -2px;
      }
      .img_next {
          right: 10px;
      }
      .small-image amp-img{
        max-width:150px;
        max-height:150px;
        border-radius: 4px;
      }
      /** Star Rating **/
      @font-face{font-family:star;src:url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/star.eot';?>");src:url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/star.eot?#iefix';?>") format('embedded-opentype'),url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/star.woff';?>") format('woff'),url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/star.ttf';?>") format('truetype'),url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/star.svg#star';?>") format('svg');font-weight:400;font-style:normal}@font-face{font-family:WooCommerce;src:url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/WooCommerce.eot';?>");src:url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/WooCommerce.eot?#iefix';?>") format('embedded-opentype'),url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/WooCommerce.woff';?>") format('woff'),url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/WooCommerce.ttf';?>") format('truetype'),url("<?php echo AMP_WOO_PLUGIN_URI.'/assets/fonts/WooCommerce.svg#WooCommerce';?>") format('svg');font-weight:400;font-style:normal}

          .ratingtest {
            --star-size: 2;  /* use CSS variables to calculate dependent dimensions later */
            padding: 0;  /* to prevent flicker when mousing over padding */
            border: none;  /* to prevent flicker when mousing over border */
            unicode-bidi: bidi-override; direction: rtl;  /* for CSS-only style change on hover */
            text-align: left;  /* revert the RTL direction */
            user-select: none;  /* disable mouse/touch selection */
            font-size: 3em;  /* fallback - IE doesn't support CSS variables */
            font-size: calc(var(--star-size) * 1em);  /* because `var(--star-size)em` would be too good to be true */
            cursor: pointer;
            /* disable touch feedback on cursor: pointer - http://stackoverflow.com/q/25704650/1269037 */
            -webkit-tap-highlight-color: rgba(0,0,0,0);
            -webkit-tap-highlight-color: transparent;
            margin-bottom: 1em;
          }
          /* the stars */
          .ratingtest > label {
            display: inline-block;
            position: relative;
            width: 1.1em;  /* magic number to overlap the radio buttons on top of the stars */
            width: calc(var(--star-size) / 3 * 1.1em);
            color: #d6d6d6;
          }
          .ratingtest > *:hover,
          .ratingtest > *:hover ~ label,
          .ratingtest:not(:hover) > input:checked ~ label {
            color: transparent;  /* reveal the contour/white star from the HTML markup */
            cursor: inherit;  /* avoid a cursor transition from arrow/pointer to text selection */
          }
          .ratingtest > *:hover:before,
          .ratingtest > *:hover ~ label:before,
          .ratingtest:not(:hover) > input:checked ~ label:before {
            content: "★";
            position: absolute;
            left: 0;
            color: black;
          }
          .ratingtest > input {
            position: relative;
            transform: scale(3);  /* make the radio buttons big; they don't inherit font-size */
            transform: scale(var(--star-size));
            /* the magic numbers below correlate with the font-size */
            top: -0.5em;  /* margin-top doesn't work */
            top: calc(var(--star-size) / 6 * -1em);
            margin-left: -2.5em;  /* overlap the radio buttons exactly under the stars */
            margin-left: calc(var(--star-size) / 6 * -5em);
            z-index: 2;  /* bring the button above the stars so it captures touches/clicks */
            opacity: 0;  /* comment to see where the radio buttons are */
            font-size: initial; /* reset to default */
          }

      /** Product page **/

      .woocommerce .v3_wc_content_wrap{
        max-width:1100px;
        margin:20px auto 0 auto;
        padding:0px 20px;
      }
      .v3_wc_content_wrap .amp-wp-content {
          max-width: 100%;
          margin: 0 auto;
      }
      .woocommerce p,.woocommerce li, #myTabPanels h1,h2,h3,h4,h5,h6{
          line-height: 1.5;
          padding-bottom: 15px;
      }
      .woocommerce .p-m-fl{
        border:none;
      }
      .product_title{
        font-size: 32px;
        line-height: 1.4;
        font-weight: 300;
        margin-bottom: 10px;
        color:#000;
      }
      .woocommerce .star-rating{
        color: #a46497;
      }
      .woocommerce-product-rating .woocommerce-review-link{
        color: #444;
        padding-left: 5px;
        font-weight: normal;
        font-size: 14px;
      }
      .woocommerce-product-rating .woocommerce-review-link:hover, .product_meta a:hover{
        text-decoration:none;
      }
      .woocommerce-product-rating{
        margin-bottom:0px;
      }
      .woocommerce div.product p.price{
        margin: -20px 0px 0px 0px;
        color: #333;
      }
      .woocommerce div.product p.price ins, .woocommerce div.product span.price ins{
        font-weight:600;
      }
      .woocommerce div.product form.cart {
          margin-bottom: 0px; 
      }
      .woocommerce .shipping li{
      list-style-type : none;
       }
      .product_meta{
        margin-top:25px;
        padding-top:20px;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
      }
      .product_meta span.posted_in, .product_meta span.tagged_as{
        display:block;
        font-size: 13px;
        margin-bottom: 10px;
        color:#6d6d6d;
      }
      .product_meta a{
          font-size: 13px;
          font-weight: 500;
          color: #333;
          text-decoration: underline;
      }
      .product_meta .sku{
        font-weight: 500;
        color:#333;
      }
      .product_meta a:hover{
        color: #333;
      }
      .edit-link{
        font-size: 14px;
        margin-top: 10px;
        display: inline-block;
      }
      .woocommerce .quantity .qty {
          width: 5em;
          text-align: center;
          padding: 10px;
          background-color: #f2f2f2;
          border: 0;
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.125);
           font-weight: 500;
          color: #333;
          font-size: 16px;
          font-family: inherit;
      }
      .woocommerce button.button.alt{
          background-color: #333;
          color: #fff;
          font-size: 14px;
          padding: 15px 24px;
      }
      .woocommerce button.button.alt:hover{
        background-color:#111;
      }
      .related.products{
          margin-top: 50px;
          display: inline-block;
          width: 100%;
      }
      .related.products > h2{
        text-align: center;
        margin-bottom: 30px;
        font-size: 24px;
        font-weight: 300;
        color: #333;
      }
      .woocommerce ul.products li.product .woocommerce-loop-product__title{
        padding:0px;
      }
      .products div.acss1035a{
        float:none;
      }
      .products li{
        text-align: center;
        font-size: 15px;
        line-height: 1.5;
        font-weight: 400;
      }
      .woocommerce ul.products li.product a amp-img{
        border-radius: 3px;
      }
      .woocommerce input.button{
        font-size:13px;
        font-weight:500;
        padding:14px 20px;
        border-radius:4px;
        color:#111;
      }
      .woocommerce tr td .cart-field input.button{
        font-size: 13px;
        font-weight: 500;
        padding: 14px 20px;
        border-radius: 4px;
        color: #333;
        font-family: inherit;
      }
      .woocommerce ul.products li.product .price{
        color: #333;
        margin: 2px 0px 2px 0px;
      }
      .woocommerce #reviews #comments ol.commentlist li .comment-text{
        margin: 0 0 0 70px;
        border-radius: 4px;
        padding: 0px 10px 10px 20px;
        border:none;
      }
      .woocommerce-review__dash, .comment-reply-title{
        display:none;
      }
      .woocommerce-review__published-date{
          display: block;
          margin-top: 5px;
          color: #a2a0a0;
          font-size: 12px;
      }
      .woocommerce #review_form #respond input#submit{
        font-size: 13px;
        padding: 14px 20px;
        margin: 0px;
        background: #e6e6e6;
        border-radius: 4px;
        color: #333;
        font-weight: 500;
        font-family: inherit;
        border:none;
      }
      .woocommerce #review_form #respond input#submit:hover{
        background-color: #d5d5d5;
      }
      .storefront-product-pagination{
        display:none;
      }
      .ratingtest > *:hover:before, .ratingtest > *:hover ~ label:before, .ratingtest:not(:hover) > input:checked ~ label:before{
        color: #a46497;
        left: -3px;
      }
      .woocommerce #review_form #respond textarea {
        margin-top: 10px;
        background: #f2f2f2;
        border: none;
        border: 1px solid #ccc;
        height: 200px;
        padding:10px;
        font-family: inherit;
      }
      .woocommerce #review_form #respond p {
          margin: 0 0 15px;
          display: inline-block;
          width: 100%;
      }
      #commentform{
        font-size:14px;
        margin-top:30px;
        color: #111;
      }
      .ratingtest{
        margin-bottom: 10px;
        font-size: 26px;
        line-height: 1;
      }
      .comment-form-comment .required{
        color:#e2401c;
      }
      #carouselWithPreviewSelector{
        display: inline-flex;
        justify-content: center;
        width: 100%;
      }

      /** Shop page **/

      .woocommerce-products-header h1{
          font-size: 36px;
          text-align: center;
          margin-bottom: 30px;
          font-weight: 400;
      }
      .sort-pagi-wrap{
        display: inline-flex;
        align-items: center;
        width: 100%;
        margin-bottom:40px;
      }
      .sorting-wrap{
          display: inline-flex;
          width: 100%;
          align-items: center;
      }
      .sorting-wrap .woocommerce-result-count{
        margin: 0px 0px 0px 13px;
        font-size: 13px;
        color: #6d6d6d;
        order: 1;
      }
      .woocommerce nav.woocommerce-pagination {
          width:100%;
          text-align:right;
      }
      .woocommerce nav.woocommerce-pagination ul{
        border:none;
      }
      .woocommerce nav.woocommerce-pagination ul li span, .woocommerce nav.woocommerce-pagination ul li a{
        padding: 8px 14px;
        background-color: rgba(0,0,0,.025);
      }
      .woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current{
        color:#111;
      }
      .woocommerce .product span.onsale{
        font-size: 12px;
        font-weight: normal;
        height: 45px;
        width: 45px;
        line-height: 40px;
        box-sizing: border-box;
      }
      .woocommerce nav.woocommerce-pagination ul li{
        border:none;
        margin-right: 3px;
        font-size: 14px;
        line-height: 1;
        text-align:center;
      }
      .woocommerce nav.woocommerce-pagination ul li a{
        color: #333;
      }
      .product_sorting{
        display: inline-flex;
        width: 100%;
      }
      .woocommerce .woocommerce-ordering select{
        padding: 1px;
        color: #777;
        border-color: #ccc;
        margin-right:5px;
      }
      .product_sorting .ampstart-btn{
        color: #777;
        background: #e6e6e6;
        border: 1px solid #ddd;
        padding: 2px 6px;
      }
      .woocommerce-loop-product__title{
        font-size: 14px;
        color: #000;
        font-weight: 500;
      }
      .term-description{
          font-size: 16px;
          line-height: 1.6;
          text-align: center;
          margin: 10px 0px 50px;
          display: inline-block;
          width: 100%;
          color: #222;
          opacity: 0.8;
      }
      .woocommerce ul.products li.product .price ins {
        font-weight: 500;
      }

      /** variable product page **/

      .selected-color{
          margin-bottom: 20px;
          font-size: 15px;
          line-height: 1.5;
      }
      .selected-color .selected-options{
        margin-top:3px;
      }
      .product_meta span.sku_wrapper{
          font-size: 13px;
          margin-bottom: 10px;
          display: inline-block;
          color:#6d6d6d;
      }
      .woocommerce-info, .woocommerce-noreviews, p.no-comments {
          background: #3d9cd2;
          padding: 20px;
          color: #fff;
          margin-bottom: 20px;
      }
      .woocommerce table.shop_attributes th {
        text-align: left;
        font-weight: 600;
      }
      .woocommerce ul.products li.product .star-rating{
        margin: 8px auto 0px auto;
        display: inline-block;
      }
      .woocommerce div.product span.price{
        margin: 12px 0px 0px 0px;
      }
      .selected-color .selected-options select,.ginput_container_select select{
        padding: 4px;
        border: 1px solid #ccc;
        color: #333;
      }
      .selected-color .selected-options select option{
        padding:4px;
      }
      .woocommerce-variation-add-to-cart.variations_button{
        display: inline-flex;
        align-items: center;
        margin-top: 30px;
        width:100%;
      }
      .addtional-field{
        text-align: center;
        padding: 14px 10px;
        background-color: #f2f2f2;
        color: #43454b;
        border: 0;
        box-shadow: inset 0 1px 1px rgba(0,0,0,.125);
        margin-right: 10px;
        float:left;
      }
      .addtional-field .subb{
        padding: 0px 7px;
        background: #eaeaea;
        border-radius: 110px;
        color: #333;
        line-height: 0;
        border: 1px solid #ccc;
      }
      .addtional-field .numb{
        padding: 0px 6px;
        font-weight: 500;
        color: #333;
      }
      .addtional-field .addi{
        padding: 0px 7px;
        background: #eaeaea;
        border-radius: 150px;
        height: 8px;
        color: #333;
        line-height: 0;
        border: 1px solid #ccc;
      }
      .add-tocart-field .total-price{
        margin: 10px 0px 0px 0px;
        display: inline-block;
      }
      #add_to_cart_error{
        width: 100%;
        margin-top: 20px;
        font-size: 15px;
        background: #e6e6e6;
        padding: 10px;
        box-sizing: border-box;
      }
      .woocommerce-error{
        margin:10px 0px 0px 0px;
      }
      .ampforwp-form-status.amp_gravity_error{
        margin: 10px 0px 0px 0px;
        display: inline-block;
        width: 100%;
      }
      .amp-form-status-success-new .amp_wc_cart_success.woocommerce-message{
        margin: 25px 0px 0px 0px;
        font-size: 15px;
        line-height: 1.5;
        display: inline-block;
      }
      .woocommerce-message{
          border-top-color: #0f834d;
      }
      .woocommerce-message::before{
        color:#0f834d;
      }
      .amp-form-status-success-new .amp_wc_cart_success_cart_cat a.view_cart_button{
        background-color: #333333;
        border-color: #333333;
        color: #ffffff;
        font-size: 15px;
        font-weight: 500;
        padding: 9px 22px;
        margin-left: 5px;
        display: inline-block;
      }
      .amp-form-status-success-new .amp_wc_cart_success_cart_cat a.view_cart_button:hover{
        color:#fff;
      }
      #order .order-cf{
        display: inline-flex;
        align-items: center;
        width: 100%;
        justify-content: center;
      }
      .woocommerce ul.products li.product .button{
        margin: 0px;
        background: #e6e6e6;
        border-radius: 4px;
        color: #333;
        font-weight: 500;
        font-family: inherit;
      }
      .woocommerce ul.products li.product .button:hover{
        background:#d5d5d5;
      }
      .woocommerce .woocommerce-ordering {
          margin: 0;
      }
      .woocommerce div.product .out-of-stock{
        margin-bottom: 20px;
      }
      .woocommerce #review_form #respond p.comment-form-author, .woocommerce #review_form #respond p.comment-form-email {
          width: 47%;
          float: left;
          margin-right: 5.8823529412%;
      }
      .woocommerce #review_form #respond p.comment-form-email{
        margin-right:0;
      }
      .woocommerce #review_form #respond p.comment-form-author input, .woocommerce #review_form #respond p.comment-form-email input{
        width:100%;
        box-sizing: border-box;
      }
      .woocommerce #review_form #respond input{
          margin-top: 5px;
          background: #f2f2f2;
          border: none;
          border-top: 1px solid #ccc;
          padding: 10px;
      }
      .woocommerce .products a.button.alt{
        font-size: 13px;
      } 
      .woocommerce a.button.alt {
        background-color: #333333;
        color: #ffffff;
        font-size: 15px;
        font-weight: 500;
        padding: 15px 20px;
        margin-top: 10px;
        display: inline-block;
        box-sizing: border-box;
      }
      .amp-cart-submit {
        background-color: #333;
        color: #fff;
        font-size: 15.5px;
        font-weight: 500;
        padding: 15px 20px;
        margin-top: 10px;
        display: inline-block;
        box-sizing: border-box;
        width: 100%;
        text-align: center;
        padding: 17px;
        cursor: pointer;
        border: 1px solid;
        font-family: "Poppins",sans-serif;
      }
      .woocommerce a.button.alt:hover {
        background:#333;
      }
      .woocommerce-grouped-product-list.group_table{
        width:100%;
        display:inline-block;
        margin-bottom:20px;
        font-size:14px;
        color: #6d6d6d;
      }
      table.woocommerce-grouped-product-list.group_table td, table.woocommerce-grouped-product-list.group_table th {
          text-align: left;
          vertical-align: top;
      }
      .woocommerce div.product form.cart .group_table td:first-child{
        text-align:left;
      }
      .woocommerce div.product form.cart .group_table td{
        vertical-align: middle;
      }
      .woocommerce div.product form.cart table td{
        padding: 1em 1.41575em;
      }
      .woocommerce-grouped-product-list-item__price ins span{
        font-weight:600;
        color:#222;
      }
      .woocommerce div.product form.cart .single_add_to_cart_button{
        float:none;
        display:inline-block;
        font-family: inherit;
        font-weight: 500;
      }
      .woocommerce .woocommerce-breadcrumb{
        font-size:13px;
        line-height:1.5;
        margin: 0px 0px 30px 0px;
      }
      .woocommerce .woocommerce-breadcrumb a{
        color: #727272;
        margin-right: 3px;
        text-decoration:none;
      }
      .woocommerce .woocommerce-breadcrumb a:after{
        content: " ";
        display: inline-block;
        position: relative;
        top: -1px;
        color: #b5b5b5;
        border: solid #b5b5b5;
        border-width: 0 2px 2px 0;
        padding: 2px;
        transform: rotate(-45deg);
        margin: 0px 5px 0px 5px;
      }
      .woocommerce .woocommerce-breadcrumb a:first-child:before{
        content: "";
        display: inline-block;
        position: relative;
        top: 1px;
        background-image: url(<?php echo AMP_WOO_PLUGIN_URI.'/assets/home.png';?>);
        background-size: 12px;
        width: 17px;
        height: 12px;
        background-repeat: no-repeat;
      }

      /** Cart Page CSS **/

      .woocommerce .amp-post-title, .woocommerce .amp-wp-title {
          font-size: 36px;
          line-height:1.2;
          text-align: center;
          margin:0px 0px 30px;
          font-weight: 400;
          color: #333;
          padding:0;
      }
      .woocommerce .cart thead tr{
          background-color: #f8f8f8;
      }
      .woocommerce .cart tbody tr{
        background:#fdfdfd;
      }
      .woocommerce table.cart th, .woocommerce table.cart td {
          padding: 1.618em;
      }
      .woocommerce table.cart th{
        color: #6d6d6d;
        font-weight: 600;
        font-size: 15px;
      }
      .woocommerce .cart_item .product-thumbnail amp-img{
        max-width:60px;
        border-radiuse:2px;
      }
      .woocommerce tbody tr:nth-child(odd) td{
        background-color: #fdfdfd;
      }
      .woocommerce tbody tr:nth-child(even) td{
        background-color: #fbfbfb;
      }
      .pg td {;
          border: none;
      }
      .woocommerce table.shop_table .cart_item td {
          border-top: none;
      }
      .woocommerce .cart_item td{
        font-size:14px;
        font-weight: 400;
      }
      .woocommerce .cart_item td.product-remove a{
        background: #868686;
        color: #fff;
        font-size: 18px;
        font-weight: 300;
        line-height: 19px;
        text-decoration:none;
      }
      .woocommerce .cart_item td.product-remove a:hover {
          background: #F44336;
      }
      .woocommerce .cart tbody tr td{
        color:#333;
        font-size: 14px;
        line-height: 1.5;
      }
      .woocommerce-page table.cart td.actions .input-text {
        width: 130px;
        padding: 10px 13px;
        border: none;
        border-top: 1px solid #ddd;
        background: #f2f2f2;
        font-weight: 500;
        color: #333;
      }
      .woocommerce-page .shop_table input{
          font-family: inherit;
      }
      .woocommerce-page table.cart td.actions input.button{
          margin: 0px;
          background: #e6e6e6;
          border-radius: 4px;
          color: #333;
          font-weight: 500;
          font-family: inherit;
      }    
      .woocommerce-page table.cart td.actions input.button:hover, .woocommerce-page table.cart td.actions button.button:hover{
        background: #d5d5d5;
      }
      .woocommerce-page table.cart td.actions button.button{
          padding: 14px 20px;
          font-family: inherit;
          font-weight: 500;
          background: #e6e6e6;
          border-radius: 4px;
          color:#333;
      }
      .cart_totals {
        margin-top:20px;
        font-size: 15px;
        font-weight: 400;
      }
      .cart_totals h2{
        color: #333;
        font-size: 22px;
        font-weight: 300;
        margin-bottom: 10px;
      }
      .woocommerce .cart-collaterals table.shop_table.shop_table_responsive{
        border:none;
        background: #f8f8f8;
      } 
      .woocommerce table.shop_table tbody .cart-subtotal th, .woocommerce table.shop_table tbody .order-total th{
        font-size: 14px;
        color: #6d6d6d;
        font-weight: 600;
      }
      .entry-summary .price .woocommerce-Price-amount{
        font-size: 18px;
      }
      .price .woocommerce-Price-amount{
        font-size: 14px;
      }
      .order-total .woocommerce-Price-amount{
        font-weight: 600;
        color: #333;
        font-size:15px;
        display:inline;
      }
      .Subtotal{
        font-size:14px;
      }
      .woocommerce table.shop_table.shop_table_responsive th{
        padding:15px 20px;
      }
      .woocommerce .wc-proceed-to-checkout a.button.alt{
        width:100%;
        text-align: center;
        padding: 22px;
      }
      .woocommerce table.shop_table_responsive tr:nth-child(2n) td, .woocommerce-page table.shop_table_responsive tr:nth-child(2n) td{
        background:#fbfbfb
      }
      .woocommerce-cart-form__cart-item.cart_item .product-name a{
        text-decoration:underline;
        color: #000;
      }
      .woocommerce-cart-form__cart-item.cart_item .product-name a:hover{
        text-decoration:none;
      }
      .content-wrapper .cntr{
        padding:0px;
      }
      .cart-empty.woocommerce-info:before{
        display:none
      }


      /** Checkout page CSS **/
      .woocommerce-form-coupon-toggle, .woocommerce-form-login-toggle{
          background: #3d9cd2;
          padding: 14px 20px;
          border-radius: 2px;
          color: #fff;
          clear: both;
          border-left: 0.6180469716em solid rgba(0, 0, 0, 0.15);
          margin-bottom: 30px;
          font-size: 15px;
          line-height: 1.4;
          display: inline-block;
          width: 100%;
          box-sizing: border-box;
      }
      .woocommerce-form-coupon-toggle span.amp-wp-inline-30a611f, .woocommerce-form-login-toggle span.amp-wp-inline-30a611f{
        font-size: inherit;
        margin-right:0;
      }
      .woocommerce-form-coupon-toggle button, .woocommerce-form-login-toggle button{
        background: transparent;
        color: #fff;
        border: none;
        font-size: 15px;
        text-decoration: underline;
        cursor: pointer;
      }
      .woocommerce-form-coupon-toggle button:hover, .woocommerce-form-login-toggle button:hover{
        text-decoration:none;
        opacity: 0.7; 
      }
      .woocommerce-checkout{
        width:100%;
        display:inline-block;
      }
      .woocommerce .col2-set .col-2, .woocommerce-page .col2-set .col-2, .woocommerce .col2-set .col-1, .woocommerce-page .col2-set .col-1  {
        float: none;
        width: 100% 
      }
      .woocommerce .col2-set, .woocommerce-page .col2-set {
          width: 52.9411764706%;
          float: left;
          margin-right: 5.8823529412%;
      }
      #order_review_heading, #order_review {
          width: 41.1764705882%;
          float: right;
          margin-right: 0;
          clear: right;
      }
      .woocommerce-billing-fields h3, .woocommerce-additional-fields h3, #order_review_heading{
        font-size: 22px;
        font-weight: 400;
        color: #333;
        margin-bottom: 20px;
      }
      .woocommerce form p.form-row label{
          line-height: 1;
          font-size: 14px;
          color: #333;
          margin-bottom: 7px;
      }
      .woocommerce form .woocommerce-input-wrapper input{
        margin-top: 5px;
        background: #f2f2f2;
        border: none;
        border-top: 1px solid #ccc;
        padding: 14px 10px;
        font-size: 15px;
      }
      .woocommerce form p.form-row{
        margin-bottom:20px;
      }
      #billing_country, #billing_state{
        padding: 5px;
        border: 1px solid #aaa;
        border-radius: 4px;
      }
      .woocommerce-additional-fields{
        margin-top:30px;
      }
      #order_comments{
        padding: 0.6180469716em;
        background-color: #f2f2f2;
        color: #43454b;
        border: 0;
        -webkit-appearance: none;
        box-sizing: border-box;
        font-weight: normal;
        border-top:1px solid #ccc;
        height: 69px;
      }
      .woocommerce table.shop_table.woocommerce-checkout-review-order-table tr th{
        background-color: #f8f8f8;
        padding: 20px;
        font-size: 14px;
        font-weight: 600;
        color: #6d6d6d;
      }
      .woocommerce table.shop_table.woocommerce-checkout-review-order-table tr td{
        padding:20px;
      }
      .woocommerce-checkout #payment{
        display:inline-block;
        width:100%;
      }
      tfoot .cart-subtotal{
        font-size: 14px;
      }
      .woocommerce table.shop_table tfoot td{
        font-weight: 500;
        background:#f8f8f8;
      }
      .woocommerce table.shop_table.woocommerce-checkout-review-order-table .product-quantity{
        font-weight: 600;
        color: #444;
      }
      .woocommerce-checkout #payment{
        background:transparent;
        font-size: 15px;
        line-height: 1.4;
      }
      .woocommerce-checkout #payment ul.payment_methods li{
        background:#f5f5f5;
        padding: 15px 30px 15px 30px;
        cursor: pointer;
      }
      .woocommerce-checkout #payment ul.payment_methods li:hover{
        background:#f0f0f0;
      } 
      .woocommerce-checkout #payment div.payment_box::before{
        display:none;
      }
      .woocommerce-checkout #payment ul.payment_methods li.payment_method_bacs label{
        padding:10px 0px 10px 0px;
        display:inline-block;
      }
      .woocommerce-checkout #payment div.payment_box{
        background:#fafafa;
        padding:20px;
        margin:0px;
        line-height: 1.6;
      }
      .woocommerce-checkout #payment ul.payment_methods .wc_payment_method.payment_method_paypal{
        display: flex;
        align-items: center;
      }
      .woocommerce-checkout #payment ul.payment_methods .payment_method_paypal label{
        display: inline-flex;
        align-items: center;
        width: 100%;
      }
      .woocommerce-checkout #payment ul.payment_methods .payment_method_paypal label amp-img{
        max-width:75px;
        order: 1;
        margin:0 auto;
      }
      .woocommerce-checkout #payment .payment_method_paypal a.about_paypal{
        font-size:15px;
        text-decoration:underline;
        margin-left:5px;
        line-height:1;
      }
      .woocommerce-checkout #payment .payment_method_paypal a.about_paypal:hover{
        text-decoration:none;;
      }
      .woocommerce-privacy-policy-text{
        font-size: 15px;
        line-height: 1.6;
      }
      .woocommerce #payment #place_order, .woocommerce-page #payment #place_order{
        background-color: #333;
        width: 100%;
        text-align: center;
        padding: 20px;
        font-family: inherit;
        font-size: 20px;
      }
      .woocommerce-checkout #payment ul.payment_methods{
        padding:0px;
      }
      .woocommerce form.checkout_coupon{
        border: none;
        padding: 0;
        margin: 10px 0px 40px;
      }
      .woocommerce form.login{
        border: none;
        padding: 0;
        margin: 10px 0px 0px;
      }
      form.woocommerce-form-login input {
        background: #f2f2f2;
        border: none;
        border-top: 1px solid #ccc;
        padding: 14px 10px;
        font-size: 15px;
        width: 100%;
        color: #111;
        height: 100%;
      }
      .lg_msg{
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 25px;
        display: inline-block;
      }
      .ccl_log_but {
        float: right;
        top: -128px;
        position: relative;
        background: #f2f2f2;
        border: none;
        font-size: 14px;
        line-height: 1.2;
        color: #333;
        font-weight: 400;
        padding: 14px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-family: inherit;
      }
      .ccl_log_but:hover {
          background-color: #dfdcde;
      }
      .woocommerce .woocommerce-form-login .woocommerce-form-login__submit{
        background: #f2f2f2;
        border: none;
        border-top: 1px solid #ccc;
        padding: 14px 30px;
        font-size: 15px;
        color: #111;
        height: 100%;
        float: none;
        margin: 5px 0 0 0;
        display: block;
      }
      .coupon{
        font-size:15px;
        color:#333;
      }
      .coupon .cpn_text{
        display:block;
        margin-bottom:20px;
      }
      #coupon_code{
        background: #f2f2f2;
        border: none;
        border-top: 1px solid #ccc;
        padding: 11px 10px;
        font-size: 15px;
        margin-right:20px;
      }
      .ccl_but{
        float: right;
        top: -83px;
        position: relative;
        background: #f2f2f2;
        border: none;
        font-size: 14px;
        line-height: 1.2;
        color: #333;
        font-weight: 400;
        padding: 12px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-family: inherit;
      }
      .ccl_but:hover{
        background-color: #dfdcde;
      }
      .woocommerce-notices-wrapper{
        font-size: 15px;
        line-height: 1.2;
        color: #333;
      }
      .loading{
      font-size: 15px;
      display:inline-block;
      margin-top:10px;
      padding:20px;
      border: 1px solid #c7c7c7;
      border-radius: 25px;
      }

      /** Order Received page CSS **/

      .woocommerce-order p{
        font-size:15px;
      }
      .woocommerce-order-overview{
        display: inline-block;
        background: #f3f3f3;
        width: 100%;
        padding: 10px 0px;
      }
      .woocommerce ul.order_details li {
        float: none;
        margin-right: 0;
        text-transform: uppercase;
        font-size: 11px;
        line-height: 1;
        color:#333;
        border-right: none;
        padding-right: 0;
        margin-left: 0;
        padding-left: 0;
        list-style-type: none;
        border-bottom: 1px solid #e3e3e3;
        padding: 20px;
      }
      .woocommerce ul.order_details li strong{
        font-size: 15px;
        color: #6d6d6d;
        margin-top: 5px;
        font-weight: 600;
      }
      .woocommerce-order-details h2, .woocommerce-customer-details h2{
        font-size: 24px;
        font-weight: 400;
        margin-bottom: 30px;
        line-height: 1.2;
      }
      .woocommerce-customer-details address{
          font-size: 16px;
          line-height: 1.7;
          color: #333;
          box-sizing:border-box;
      }
      .woocommerce table.shop_table tr th {
        background-color: #f8f8f8;
        padding: 20px;
        font-size: 14px;
        font-weight: 600;
        color: #6d6d6d;
      }
      .woocommerce table.shop_table td{
        font-size:14px;
        padding: 20px;
      }
      .woocommerce table.shop_table td a{
        color:#000;
        text-decoration:underline;
      }
      .woocommerce table.shop_table td strong{
        color:#444;
        font-weight: 600;
      }
      .woocommerce table.shop_table td a:hover{
        text-decoration:none;
      }

      /** Register and Login page CSS **/

      .col2-set#customer_login .col-1{
          width: 41.1764705882%;
          float: left;
          margin-right: 5.8823529412%;
      }
      .col2-set#customer_login .col-2{
          width: 52.9411764706%;
          float: right;
          margin-right: 0;
      }
      .col2-set#customer_login{
          width: 100%;
          float: left;
          margin:40px 0px 0px 0px;
      }
      #customer_login h2{
          font-size: 24px;
          font-weight: 400;
          color: #444;
          margin-bottom: 20px;
      }
      #customer_login form{
        border: none;
        padding: 0;
        margin: 0;
        display: inline-block;
        width: 100%;
      }
      .woocommerce form .form-row .required{
        visibility:visible;
      }
      #customer_login form input, .woocommerce-ResetPassword input{
        background: #f2f2f2;
        border: none;
        border-top: 1px solid #ccc;
        padding: 14px 10px;
        font-size: 15px;
        width: 100%;
        color:#111;
        height:100%;
        box-sizing: border-box;
      }
      .woocommerce form .form-row label.woocommerce-form__label-for-checkbox.inline{
        width: 100%;
        display: block;
        order: -1;
        position: relative;
        left: -3px;
      }
      #customer_login .woocommerce-form__input-checkbox{
        width:10px;
        height:10px;
      }
      #customer_login form input.woocommerce-Button, .woocommerce-ResetPassword button.woocommerce-Button{
        width:auto;
        padding: 14px 30px;
        margin-bottom: 8px;
        font-weight: 600;
      }
      #customer_login form input.woocommerce-form__input.woocommerce-form__input-checkbox:hover, #customer_login form input.woocommerce-Button:hover, .woocommerce-ResetPassword button.woocommerce-Button:hover{
        background:#d5d5d5;
      }
      .lost_password a{
        font-size: 14px;
        text-decoration: underline;
      }
      .lost_password a:hover{
        text-decoration:none;
      }
      .woocommerce-ResetPassword{
        font-size:15px;
        line-height:1.5;
      }

      /* Account Page */
      <?php if( function_exists('is_account_page') && is_account_page() ){ ?>
      @media screen and (min-width:968px){
      .woocommerce-column.woocommerce-column--2.woocommerce-column--shipping-address.col-2 {
          float: right;
          position: relative;
          right: 35%;
          bottom: 226px;
          display: inline-block;
        }
        input.woocommerce-Button.button {
          bottom: 9px;
          position: relative;
          width: 7%;
          right: 5px;
        }
        .woocommerce-privacy-policy-text {
            margin: 3% 0px 0px 0px;
        }
      }
      input[type=color], input[type=date], input[type=datetime-local], input[type=email], input[type=month], input[type=number], input[type=password], input[type=search], input[type=tel], input[type=text], input[type=time], input[type=url], input[type=week], textarea,select {
       height: 36px;width: 90%;padding: 6px 12px;font-size: 14px;line-height: 1.42857143;color: #555;background-color: #fff;background-image: none;border: 1px solid #ccc;border-radius: 0;}
        button,button[type=submit]{background-color:#333;color: #fff;
          font-size: 12px;font-weight: bold;padding: 11px 13px 10px 13px;text-transform: uppercase;border: 0;border-radius: 2px;line-height: 1;cursor: pointer;
        }
          .woocommerce form .form-row-first, .woocommerce form .form-row-last, .woocommerce-page form .form-row-first, .woocommerce-page form .form-row-last {float:left;width: 47%;overflow: visible;}
          .woocommerce form .form-row-first, .woocommerce-page form .form-row-first {float: left;}label.acc-name {float: left;}
           .woocommerce form .form-row .required { color: red;font-weight: 700;text-decoration: none;}span.dp-name {
          display: block;
      }
      .login-title{font-size: 26px;font-weight: lighter;color: #484c51;margin-bottom: 15px;}
      .woocommerce-form-login label{font-size: 14px;color: #333;line-height: 1.4;letter-spacing: 0.5px;}
      .woocommerce-form-login input{padding: 15px 10px;background-color: #f2f2f2;color: #43454b;outline: 0;border: 0;box-sizing: border-box;font-weight: 400;margin:0;}

      .woocommerce-Button{background-color: <?php if(isset($redux_builder_amp['swift-color-scheme']['color'])){echo amp_woo_sanitize_color($redux_builder_amp['swift-color-scheme']['color']); ?>;<?php } ?>border: none;color: #ffffff;padding: 13px 19px;font-weight: 600;
          font-size: 15px;line-height: 1.2; margin-right: 10px;cursor: pointer;}
      .woocommerce-form-login .woocommerce-form__input-checkbox{margin-right:7px;width:auto;height:auto;}
      .woocommerce-LostPassword a{font-size: 14px;line-height: 1.4;color: <?php  if(isset($redux_builder_amp['swift-color-scheme']['color'])){echo amp_woo_sanitize_color($redux_builder_amp['swift-color-scheme']['color']); ?>;<?php } ?>}
      .woocommerce-MyAccount-navigation ul li a {padding: 15px 0px;display: block;
          border-bottom: 1px solid #eee;font-size: 14px;line-height: 1.5;}
      .woocommerce-MyAccount-navigation ul{border-top:1px solid #eee;}
      .woocommerce{ margin-top: 30px;display: inline-block;width: 100%;}
      .woocommerce-MyAccount-navigation {width: 17.6470588235%;float: left;margin-right: 5.8823529412%;}
      .woocommerce-MyAccount-content { width: 76.4705882353%;float: right;margin-right: 0;}
      .woocommerce-MyAccount-content p{font-size: 14px;margin-bottom: 17px;color: #6d6d6d;}
      @media(max-width:767px){
        .woocommerce-MyAccount-navigation, .woocommerce-MyAccount-content  { width:100%; float:none;}
      }
      <?php }?>

      /** Design 3 CSS **/
      .swatch_images{
        width:32px;
        height:32px;
        display:inline-block;
        cursor: pointer;
        border: solid 2px white ;
        outline: solid 1px #9C9999;

      }
      .swatch_text{
          text-align: center;
          width: auto;
          padding: 0 10px;
          line-height: 30px;
          color: black;
          border: solid 0px white !important;
          outline: solid 0px #9C9999 !important;
          background: #eee;
          font-size: 14px;
          font-weight: 500 !important;
          border-radius: 20%;
      }
      .swatch_color{
          font-size: 20px;
          font-weight: 500;
          width: 32px;
          height: 32px;
          border: solid 2px white ;
          outline: solid 1px #9C9999;
          display: inline-block;
      }

      input:checked + .swa_check {
          outline: solid 2px black;
      }

      /** Design 3 CSS **/
      .v3_wc_content_wrap header{
        padding:0px;
      }
      .woocommerce-MyAccount-navigation ul{
        padding:0px;
        list-style:none;
      }


      /** Design 2 CSS **/
      <?php 
      global $redux_builder_amp;   
      if( isset($redux_builder_amp['amp-design-selector']) && 2 == esc_attr($redux_builder_amp['amp-design-selector']) ){?>
      .v3_wc_content_wrap main {
          padding: 0;
      }

      <?php  if( (function_exists('is_cart') && is_cart() ) ||  (function_exists('is_checkout') && is_checkout()) || (function_exists('is_account_page') && is_account_page()) ){ ?>
      .design_2_wrapper main{
        max-width: 1100px;
        margin: 20px auto 0 auto;
        padding: 0px 20px;
      }
      .woocommerce main .v3_wc_content_wrap{
        max-width:100%;
        margin:0 auto;
        padding:0;
      }
      @media(max-width:1100px){
        .design_2_wrapper main{
          max-width:100%;
        }

      }

      <?php } } ?>


      /** Responsive **/
 
      @media(max-width:1100px){
      <?php if(isset($redux_builder_amp['amp-design-selector']) && esc_attr($redux_builder_amp['amp-design-selector']) == 4){?>
        .woocommerce .v3_wc_content_wrap{
          max-width:100%;
        }
        <?php if(function_exists('is_cart') && is_cart()){?>
        .content-wrapper{padding:20px;}
       <?php } }else{?>
        .woocommerce .v3_wc_content_wrap{
          max-width:90%;
        }
        table.cart tbody{width:100%;}
        table.cart tr{padding-left:0px;}
      <?php } ?>
      }

      @media(max-width:768px){
        .woocommerce table.cart .product-thumbnail{
          display:block;
        }
        .woocommerce .cart_item .product-thumbnail amp-img{
          margin:0 auto;
        }
        .pg table {
          display: table;
        }
        .woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before {
          font-weight:600;
          content: attr(data-title) " ";
        }
        table.shop_table_responsive tr td::before, table.shop_table_responsive tr td::after {
          content: '';
          display: table;
        }
        table.shop_table_responsive tr td::after {
          clear: both;
        }
        .woocommerce .wc-proceed-to-checkout a.button.alt{
          padding:15px;
        }
        .cart_totals h2 {
          font-size: 25px;
          margin-bottom: 20px;
        }
        .woocommerce-page table.cart td.actions .coupon input, .woocommerce-page table.cart td.actions .coupon .button, .woocommerce-page table.cart td.actions .coupon .input-text{
          width:100%;
          margin-bottom: 6px;
        }
        .woocommerce table.cart td.actions .coupon{
          margin-bottom:10px
        }
        .sorting-wrap, .sort-pagi-wrap {
          flex-direction: column;
          align-items: baseline;
        }
        .sort-pagi-wrap{
          flex-direction: column;
        }
        .sorting-wrap .woocommerce-result-count {
          margin: 15px 0px 0px 0px;
          width:100%;
        }
        .woocommerce nav.woocommerce-pagination {
          text-align: center;
          display: inline-block;
          border-top: 1px solid rgba(0, 0, 0, 0.05);
          margin: 20px 0px 0px 0px;
          padding: 12px 0px 10px;
          border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        .woocommerce table.cart th, .woocommerce table.cart td {
          padding: 10px;
        }
        .wc-tabs-wrapper, .related.products {
          margin-top: 20px;
        }
      }


      @media(max-width:767px){
        .related.products > h2 {
          text-align: left;
          margin-bottom: 20px;
          font-size: 20px;
        }
        .product_title {
          font-size: 30px;
        }
        .woocommerce .woocommerce-ordering, .woocommerce-page .woocommerce-ordering {
          float: none;
        }
        .term-description{
          text-align: left;
        }
        .woocommerce-products-header h1 {
          font-size: 30px;
          text-align: left;
        }
        .woocommerce #review_form #respond p.comment-form-author, .woocommerce #review_form #respond p.comment-form-email {
          width: 100%;
          float: one;
          margin-right: 0;
        }
        amp-selector[role=tablist].tabs-with-selector {
          display: inline-block;
        }
        amp-selector[role=tablist].tabs-with-selector [role=tab]{
          padding: 10px 10px 20px 10px;
          text-align: left;
          margin: 0px;
          border-bottom: 1px solid #eee;
        }
        .woocommerce .col2-set, .woocommerce-page .col2-set{
          float:none;
          width:100%;
          margin:0;
          display: inline-block;
        }
        #order_review_heading, #order_review{
          float:none;
          width:100%;
        }
        #coupon_code{
          margin:0px 0px 20px 0px;
          width:100%;
        }
        .col2-set#customer_login .col-1, .col2-set#customer_login .col-2{
          width: 100%;
          float: none;
          margin-right: 0;
        }
        .col2-set#customer_login{
          margin-top:0px;
        }
        .woocommerce form .form-row-first, .woocommerce form .form-row-last{
          float:none;
          width:100%;
        }
        .woocommerce ul.products[class*=columns-] li.product,.woocommerce-page ul.products[class*=columns-] li.product{
          width:100%;
          float:none;
          clear:both;
          margin-bottom:40px;
          display:inline-block;
        }
        .woocommerce ul.products li.product a amp-img{
          margin:0 auto 10px auto;
          max-width:100%;
        }
        .woocommerce ul.products li.product, .woocommerce-page ul.products li.product{
          margin:0;
        }
        #order .order-cf {
          display: inline-block;
        }
        .amp-form-status-success-new .amp_wc_cart_success_cart_cat a.view_cart_button{
          margin:10px 0px 0px 0px;
        }
        .woocommerce-checkout #payment ul.payment_methods .payment_method_paypal label {
          display: inline-block;
        }
        .woocommerce-checkout #payment ul.payment_methods .payment_method_paypal label amp-img{
          display:inline-block;
        }
        .woocommerce-checkout #payment .payment_method_paypal a.about_paypal{
          margin:10px 0px 0px;
        }
      }

      @media(max-width:500px){
        .gallery-multi-images ul {
          grid-gap: 30px;
        }
        .cart.grouped_form table.group_table{
          width: 100%;
          overflow-y: scroll;
          white-space: nowrap;
        }
        .woocommerce-checkout #payment ul.payment_methods .wc_payment_method.payment_method_paypal{
            align-items: flex-start;
        }
        .wc_payment_method.payment_method_paypal input{
          position:relative;
          top:10px;
        }
        

      }
        @media(max-width:380px){
          .woocommerce-checkout #payment .payment_method_paypal .about_paypal {
            float: left;
            margin-top: 5px;
          }

        }

/** Widget CSS **/
#content{
  width: 100%;
  display: flex;
  flex-wrap: wrap;
}
#content .wcsdbr-lft.wcsdbr {
    flex-basis: calc(65%);
    margin-right: 30px;
}
#content .sdbr-right.wcsdbr {
    flex-basis: calc(30%);
    margin-top:50px;
}
#content .wcsdbr{
  flex: 1 0 100%;
}
.amp-sidebar .woocommerce-Price-amount{
  display: contents;
  font-size: 14px;
  margin: 0;
}
.amp-sidebar ul.product_list_widget li{
  padding:18px 0px;
  border-bottom: 1px solid rgba(0,0,0,.05);
}
.amp-sidebar ul li li {
    border: 0;
    padding-left: 0px
}
.amp-sidebar ul.product_list_widget li a{
  margin-bottom: 5px;
  text-decoration: underline;
  color: #727272;
  font-size: 14px;
  line-height: 1.5;
  font-weight: 500;
}
.amp-sidebar ul.product_list_widget li a:hover{
  text-decoration: none;
  color: #111;
}
.amp-sidebar  ul.product-categories li .children{
  padding-left:20px;
  margin-top:10px;
}
.amp-sidebar  ul.product-categories li a:before{
  content:"";
  background-image: url(data:image/svg+xml;base64,
    PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTggNTgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU4IDU4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxwYXRoIHN0eWxlPSJmaWxsOiNDQ0NDQ0MiIGQ9Ik01NS45ODEsNTQuNUgyLjAxOUMwLjkwNCw1NC41LDAsNTMuNTk2LDAsNTIuNDgxVjIwLjVoNTh2MzEuOTgxQzU4LDUzLjU5Niw1Ny4wOTYsNTQuNSw1NS45ODEsNTQuNXogICIgZGF0YS1vcmlnaW5hbD0iI0VGQ0U0QSIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iI0VGQ0U0QSI+PC9wYXRoPjxwYXRoIHN0eWxlPSJmaWxsOiNDQ0NDQ0MiIGQ9Ik0yNi4wMTksMTEuNVY1LjUxOUMyNi4wMTksNC40MDQsMjUuMTE1LDMuNSwyNCwzLjVIMi4wMTlDMC45MDQsMy41LDAsNC40MDQsMCw1LjUxOVYxMC41djEwaDU4ICB2LTYuOTgxYzAtMS4xMTUtMC45MDQtMi4wMTktMi4wMTktMi4wMTlIMjYuMDE5eiIgZGF0YS1vcmlnaW5hbD0iI0VCQkExNiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFQkJBMTYiPjwvcGF0aD48L2c+IDwvc3ZnPg==);
  display: inline-block;
  width: 12px;
  height: 12px;
  background-size: 12px;
  background-repeat: no-repeat;
  position: relative;
  top: 3px;
  margin-right: 8px;
}
.amp-sidebar ul.product-categories li a, .amp-sidebar ul.product-categories li span.count{
  font-size: 14px;
  line-height: 1.3;
  color: #727272;
  font-weight: 500;
  text-decoration: underline;
}
.amp-sidebar ul.product-categories li a:hover{
  text-decoration: none;
}
.amp-sidebar ul.product-categories li span.count{
  float:right;
  font-size: 12px;
  text-decoration: none;
}
.amp-sidebar ul li a:hover{
  box-shadow: none;
}
.amp-sidebar ul li.wc-layered-nav-rating a{
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  margin-bottom: 15px;
  color: #727272;
  font-weight: 600;
  font-size: 13px;
}
.amp-sidebar ul li.wc-layered-nav-rating a .s-r{
  order: 0;
  display: flex;
  margin-right: 5px;
  font-size: 15px;
}
.product_list_widget li .s-r{
  margin-bottom:7px;
}
.product_list_widget .reviewer{
  font-size: 13px;
  color: #727272;
}
.price_slider_amount{
  display:inline-block;
  width:100%
}
.price_slider_amount input{
  width: 49%;
  border: 1px solid #ccc;
  padding: 6px 8px;
  display:inline-block;
}
.price_slider_amount button.button{
  margin-top: 14px;
  width: 100%;
}
.price_slider_amount .price_label{
  display:none;
}
.amp-sidebar .chosen a:before{
  content: "✖";
  display: inline-block;
  color: #e2401c;
  margin-right: 8px;
  line-height: 0;
  position: relative;
  font-weight: bold;
  top: 1px;
  font-size: 14px;
}
.amp-sidebar .chosen{
  margin-bottom:10px;
}
.amp-sidebar .chosen a{
  font-size: 13px;
  line-height: 1.3;
  color: #727272;
  font-weight: 500;
  text-decoration: underline;
}
.amp-sidebar .chosen a .woocommerce-Price-amount {
  font-size: 12px;
}
.amp-sidebar .chosen a:hover{
  text-decoration: none;
}
.amp-sidebar .dropdown_product_cat{
  border: 1px solid #ccc;
  padding: 5px 20px 5px 10px;
  width: 100%;
  color: #999;
}
.amp-sidebar .dropdown_product_cat option{
  color:#444;
  font-size:14px;
  line-height:1.4;
}


@media(max-width:767px){
  #content .wcsdbr-lft.wcsdbr {
    flex-basis: calc(100%);
    margin-right: 0px;
  }
  #content .sdbr-right.wcsdbr {
    flex-basis: calc(100%);
    margin-top: 30px;
  }


}

/** Product Bundle CSS **/
.product-type-bundle{
  width:100%;
  display:inline-block;
  clear:both;
}
.product-type-bundle .bundled_product_images .woocommerce-product-gallery__image a amp-img{
  max-width:74px;
  min-height:74px;
}
.product-type-bundle .bundled_product .bundled_product_images{
    max-width:100px;
}
.product-type-bundle .bundled_product{
  padding-bottom:30px;
  margin-bottom:30px;
  border-bottom:1px solid #eee;
}
.product-type-bundle .product_title .bundled_product_title_inner{
  font-size: 18px;
}
bundled_item_qty_col{
  text-align:center;
}
.product-type-bundle .bundled_product_permalink:after{
  content: "";
  background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTguMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgdmlld0JveD0iMCAwIDI4My45MjIgMjgzLjkyMiIgc3R5bGU9ImVuYWJsZS1iYWNrZ3JvdW5kOm5ldyAwIDAgMjgzLjkyMiAyODMuOTIyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCI+CjxnPgoJPHBhdGggZD0iTTI2Ni40MjIsMGgtOTcuNjI1Yy05LjY1LDAtMTcuNSw3Ljg1MS0xNy41LDE3LjVjMCw5LjY0OSw3Ljg1LDE3LjUsMTcuNSwxNy41aDU1LjM3N2wtOTIuMzc1LDkyLjM3NCAgIGMtMy4zMDcsMy4zMDUtNS4xMjcsNy42OTktNS4xMjcsMTIuMzc1YzAsNC42NzYsMS44MTksOS4wNjksNS4xMjUsMTIuMzcxYzMuMzA2LDMuMzA5LDcuNjk5LDUuMTMsMTIuMzc1LDUuMTMgICBjNC42NzQsMCw5LjA2OS0xLjgyLDEyLjM3Ni01LjEyN2w5Mi4zNzQtOTIuMzc1djU1LjM3N2MwLDkuNjQ5LDcuODUxLDE3LjUsMTcuNSwxNy41YzkuNjQ5LDAsMTcuNS03Ljg1MSwxNy41LTE3LjVWMTcuNSAgIEMyODMuOTIyLDcuODUxLDI3Ni4wNzEsMCwyNjYuNDIyLDB6IiBmaWxsPSIjMDAwMDAwIi8+Cgk8cGF0aCBkPSJNMjAxLjEzNywyNTMuOTIySDMwVjgyLjc4NWgxMjguNzExbDMwLTMwSDE1Yy04LjI4NCwwLTE1LDYuNzE2LTE1LDE1djIwMS4xMzdjMCw4LjI4NCw2LjcxNiwxNSwxNSwxNWgyMDEuMTM3ICAgYzguMjg0LDAsMTUtNi43MTYsMTUtMTVWOTUuMjExbC0zMCwzMFYyNTMuOTIyeiIgZmlsbD0iIzAwMDAwMCIvPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=);
  background-size:16px;
  width:16px;
  height:16px;
  line-height:16px;
  background-repeat:no-repeat;
  display: inline-block;
}
.product-type-bundle .price del span{
  text-decoration: line-through;
}
.product-type-bundle .bundled_product span.price{
  display:flex;
  align-items:center;
  margin:0px 0px 0px 10px;
}
.product-type-bundle .bundled_product span.price del{
  margin-right: 10px;
}
.product-type-bundle .bundled_product .price span.amount{
  margin:0px 5px 0px 0px;
}
.product-type-bundle .bundled_product .price span.amount:nth-child(2){
  margin-left:5px;
}
.product-type-bundle .bundled_product .price .woocommerce-Price-amount {
    font-size: 14px;
}
.product-type-bundle .bundled_product_optional_checkbox{
  display: flex;
  align-items: center;
  font-size: 14px;
}
.product-type-bundle .bundled_product_optional_checkbox input{
  margin-right:5px;
}
.product-type-bundle .cart.bundled_item_cart_content table.variations .attribute_options td{
  padding:5px;
  font-size:14px;
  line-height: 0;
}
.product-type-bundle .attribute_options .label{
  font-size: 16px;
  font-weight: 500;
}
.product-type-bundle .cart.bundled_item_cart_content table.variations .value select{
  min-height: 28px;
  font-size: 14px;
}

@media(max-width:767px){
  .product-type-bundle .bundled_product_images .woocommerce-product-gallery__image a amp-img {
      max-width: 100%;
      min-height: 100%;
  }
  .cart.bundled_item_cart_content{
    margin-top: 30px;
  }
}

/* Swatch product CSS */
.swatch_radio{
  display: flex;
}
.swatch_radio .swatch_input{
  margin-bottom: 8px;
}
.swatch_label{
  margin-left: 7px;
}
.wvs-archive-variation-wrapper {
    display: none;
}

/* */
.gform_variation_wrapper .gform_fields{
    list-style-type: none;
}
.gform_variation_wrapper li.gfield {
    margin-bottom: 20px;
    margin-top: 10px;
}
.gform_variation_wrapper .ginput_container_select select{
    margin: 8px 0px;
}


<?php 
if(function_exists('is_woocommerce') && !is_woocommerce()){?>
.woocommerce  .cntr .products li.product a amp-img{
  margin : 0px;
}
.woocommerce .cntr .products li.product .w-lpt {
    padding: .5em 0;
}
 <?php } ?>

@media (max-width: 500px){
.ampwoocommerce .cart.grouped_form table.group_table {
    white-space: normal;
}
}
<?php if(function_exists('amp_woo_active_theme_data') && amp_woo_active_theme_data('theme_name') == 'Astra'){?>
   @media (max-width: 767px){
      .ampwoocommerce .products[class*=columns-] li.product, .w-pg .products[class*=columns-] li.product {
          width: 49%;
          float:left;
      }   
    }
  <?php } ?>
        <?php 
  }


function amp_woo_default_woocommerce_css(){
    $srcs = array();

    $srcs[] = plugins_url( 'assets/css/woocommerce-layout.css',WC_PLUGIN_FILE );
    $srcs[] = plugins_url( 'assets/css/woocommerce.css',WC_PLUGIN_FILE );
    $srcs[] = plugins_url( 'packages/woocommerce-blocks/build/style.css', WC_PLUGIN_FILE );
    $srcs[] = plugins_url( 'assets/css/photoswipe/photoswipe.css', WC_PLUGIN_FILE );
    $srcs[] = plugins_url( 'assets/css/photoswipe/default-skin/default-skin.css', WC_PLUGIN_FILE );

    foreach ($srcs as $key => $urlValue) {
        $cssData = amp_woo_remote_content($urlValue);
        $cssData = preg_replace("/\/\*(.*?)\*\//si", "", $cssData);
        $cssData = str_replace('img', 'amp-img', $cssData);
              echo amp_woo_css_sanitizer($cssData); // XSS ok.
      }

}

function amp_woo_css_sanitizer($css){
    $css = preg_replace( '/\s*!important/', '', $css, -1, $important_count );
    $css = preg_replace( '/overflow(-[xy])?\s*:\s*(auto|scroll)\s*;?\s*/', '', $css, -1, $overlow_count );
            $css = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css);
        $css = str_replace(array (chr(10), ' {', '{ ', ' }', '} ', '( ', ' )', ' :', ': ', ' ;', '; ', ' ,', ', ', ';}', '::-' ), array('', '{', '{', '}', '}', '(', ')', ':', ':', ';', ';', ',', ', ', '}', ' ::-'), $css);
    return $css;
  }
// Flatsome Theme CSS 
function amp_woo_flatsome_theme_custom_css(){ ?>

    html {background-color: white;}.header input[type='checkbox'], input[type='radio']{display:none;}.box-image amp-img {margin:0px;}.woocommerce-products-header{
      text-align:center;}

    /** Custom CSS **/
    .shop-container{
      display:inline-block;
      width:100%;
      clear:both;
    }
    .shop-container .box{
     width: 80%;
    }
    .woocommerce .shop-container .woocommerce-breadcrumb{
      margin:18px 0px 0px;
      float: left;
      padding-left: 20px;
    }
    .shop-container .woocommerce-products-header h1.page-title{display:none;}
    .sort-pagi-wrap{
      float:right;
      padding-right: 20px;
    }
    .product_sorting{
      display:flex;
      align-items: center;
    } 
    .shop-container .products, .shop-container .row.row-small {
      clear: both;
    }
    .shop-container input#sortingbutton {
      margin: 0px 0px 0px 5px;
      box-sizing: border-box;
      display: block;
      line-height: 0;
      padding: 10px 15px;
      max-height: 0;
    }
    .orderby{
      background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTYuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iQ2FwYV8xIiB4PSIwcHgiIHk9IjBweCIgd2lkdGg9IjI0cHgiIGhlaWdodD0iMjRweCIgdmlld0JveD0iMCAwIDYxMiA2MTIiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDYxMiA2MTI7IiB4bWw6c3BhY2U9InByZXNlcnZlIj4KPGc+Cgk8ZyBpZD0iX3gzMV8wXzM0XyI+CgkJPGc+CgkJCTxwYXRoIGQ9Ik02MDQuNTAxLDEzNC43ODJjLTkuOTk5LTEwLjA1LTI2LjIyMi0xMC4wNS0zNi4yMjEsMEwzMDYuMDE0LDQyMi41NThMNDMuNzIxLDEzNC43ODIgICAgIGMtOS45OTktMTAuMDUtMjYuMjIzLTEwLjA1LTM2LjIyMiwwcy05Ljk5OSwyNi4zNSwwLDM2LjM5OWwyNzkuMTAzLDMwNi4yNDFjNS4zMzEsNS4zNTcsMTIuNDIyLDcuNjUyLDE5LjM4Niw3LjI5NiAgICAgYzYuOTg4LDAuMzU2LDE0LjA1NS0xLjkzOSwxOS4zODYtNy4yOTZsMjc5LjEyOC0zMDYuMjY4QzYxNC41LDE2MS4xMDYsNjE0LjUsMTQ0LjgzMiw2MDQuNTAxLDEzNC43ODJ6IiBmaWxsPSIjMDAwMDAwIi8+CgkJPC9nPgoJPC9nPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+CjxnPgo8L2c+Cjwvc3ZnPgo=);
      background-repeat: no-repeat;
      background-size: 12px;  
  }

    @media(max-width:425px){
    .woocommerce .shop-container .woocommerce-breadcrumb{
        float: none;
      }
    .sort-pagi-wrap{
      float:none;
      padding: 0px 0px 0px 20px;
      margin-top:20px;
    }
  }

  /* PAGINATION */
    .page-numbers{
     display:inline-flex;
    }

    .woocommerce-pagination .current, .woocommerce-pagination .page-numbers span:hover,.woocommerce-pagination .page-numbers a:hover{
      border-color: #446084;
      background-color: #446084;
      color: #FFF;
     }
    .woocommerce-pagination .page-numbers span , .woocommerce-pagination .page-numbers a{
        font-size: 1.1em;
        display: block;
        height: 2.25em;
        line-height: 2em;
        text-align: center;
        width: auto;
        min-width: 2.25em;
        padding: 0 7px;
        font-weight: bolder;
        border-radius: 99px;
        border: 2px solid currentColor;
        transition: all .3s;
        vertical-align: top;
        display:inline-block;
    }


    /** Max-width issue - #3727 **/
    .product .star-rating span {
        width: inherit;
    }
    .product_title{display:inline-block;}
    /** Tab CSS **/  
    amp-selector[role=tablist].tabs-with-selector {
      display: inline-flex;
      font-size: 15px;
      line-height: 1.3;
      background: #e6e6e6;
      width: 100%;
    }
    .wc-tabs-wrapper{
      margin-top: 50px;
      display: inline-block;
      width: 100%;
      border-top: 1px solid #eee;
    }
    amp-selector[role=tablist].tabs-with-selector [role=tab] {
      width: 100%;
      padding: 10px;
      text-align: center;
      box-sizing:border-box;
    }
    amp-selector[role=tablist].tabs-with-selector [role=tab]:last-child {
      margin-right: 0px;
    }
    amp-selector.tabpanels [role=tabpanel] {
      display: none;
      padding: var(--space-4);
    }
    amp-selector.tabpanels [role=tabpanel][selected] {
      outline: none;
      display: block;
    }
    .has-post-thumbnail{
      position : relative;
    }
    amp-selector.tabs-with-selector [option][selected]{
      position: relative;
      outline: none;
      background: #ddd;
    }
    amp-selector.tabs-with-selector [option][selected]:before {
      content: "";
      display: inline-block;
      border-top: 3px solid #444;
      position: absolute;
      top: -3px;
      left: 0;
      right: 0;
    }
    amp-selector#myTabPanels{
      margin-top: 30px;
    }
    .woocommerce-Tabs-panel h2{
      font-size: 20px;
      font-weight: 400;
      margin-bottom: 30px;
      color: #333;
    }
    .woocommerce-Reviews ol, .woocommerce-Reviews ul{
      padding:0;
      margin:0;
    }
    .woocommerce table.shop_attributes td p{
      font-style: normal;
    }
    .woocommerce #reviews #comments ol.commentlist li .meta{
      color:#333;
    }
    .description{
      font-size: 14px;
      color: #333;
    }
    .meta .woocommerce-review__author{

    }

    /** Gallery Selector image **/
    .woocommerce div.product div.images amp-img.hide{
      display:none;
    }
    .gallery-multi-images .small-image amp-img{
        opacity:0.5;
    }
    .gallery-multi-images .small-image amp-img:hover{
      opacity:1;
    }
    .gallery-multi-images amp-selector [option][selected]{
      opacity:1;
      outline:none;
    }
    .gallery-multi-images ul {
      list-style-type: none;
      display: grid;
      padding: 0;
      width: 100%;
      flex-wrap: wrap;
      margin-top: 20px;
      grid-template-columns: 1fr 1fr 1fr 1fr 1fr;
      grid-gap: 20px 50px;
    }
    .img_prev {
        left: 10px;
    }
    .gallery-big-image, .gallery-big-image amp-img{
      position:relative;
    }
    <!-- .gallery-big-image amp-img{
      max-width:100%;
      max-height:100%;
    } -->
    .img_prev,.img_next{
      background: rgba(0,0,0,.5);
      font-size: 17px;
      font-weight: normal;
      line-height: 1;
      line-height: 30px;
      color: rgba(255,255,255,.7);
      height: 30px;
      cursor: pointer;
      text-align: center;
      font-family: helvatica,sans-serif;
      width: 30px;
      top: 43%;
      position: absolute;
      z-index: 1;
      box-sizing: border-box;
      border-radius: 50%;
    }
    .img_prev span:before{
      content: "";
      display: inline-block;
      position: relative;
      top: -1px;
      color: #fff;
      border: solid #fff;
      border-width: 0 2px 2px 0;
      padding: 3px;
      transform: rotate(135deg);
      left: 1px;
    }
    .img_next span:after{
      content: "";
      display: inline-block;
      position: relative;
      top: -1px;
      color: #fff;
      border: solid #fff;
      border-width: 0 2px 2px 0;
      padding: 3px;
      transform: rotate(-45deg);
      left: -2px;
    }
    .img_next {
        right: 10px;
    }
    .small-image amp-img{
      max-width:150px;
      max-height:150px;
      border-radius: 4px;
    }

    span.numb {
        text-align: center;
        vertical-align: top;
        border: 1px solid #ddd;
        padding: 0.4em 1em;
        vertical-align: middle;
        background-color: #fff;
        color: #333;
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
        margin-left: -16px;
    }

        .ratingtest {
          --star-size: 2;
          padding: 0;
          border: none;
          unicode-bidi: bidi-override; direction: rtl;
          text-align: left;
          user-select: none;
          font-size: 3em;  
          font-size: calc(var(--star-size) * 1em);
          cursor: pointer;
          -webkit-tap-highlight-color: rgba(0,0,0,0);
          -webkit-tap-highlight-color: transparent;
          margin-bottom: 1em;
        }
        /* the stars */
        .ratingtest > label {
          display: inline-block;
          position: relative;
          width: 1.1em;
          width: calc(var(--star-size) / 3 * 1.1em);
          color: #d6d6d6;
        }
        .ratingtest > *:hover,
        .ratingtest > *:hover ~ label,
        .ratingtest:not(:hover) > input:checked ~ label {
          color: transparent;
          cursor: inherit;
        }
        .ratingtest > *:hover:before,
        .ratingtest > *:hover ~ label:before,
        .ratingtest:not(:hover) > input:checked ~ label:before {
          content: "★";
          position: absolute;
          left: 0;
          color: #d26e4b;
        }
        .ratingtest > input {
          position: relative;
          transform: scale(3);  /* make the radio buttons big; they don't inherit font-size */
          transform: scale(var(--star-size));
          /* the magic numbers below correlate with the font-size */
          top: -0.5em;  /* margin-top doesn't work */
          top: calc(var(--star-size) / 6 * -1em);
          margin-left: -2.5em;  /* overlap the radio buttons exactly under the stars */
          margin-left: calc(var(--star-size) / 6 * -5em);
          z-index: 2;  /* bring the button above the stars so it captures touches/clicks */
          opacity: 0;  /* comment to see where the radio buttons are */
          font-size: initial; /* reset to default */
        }
    .woocommerce .woocommerce-breadcrumb{
      font-size:13px;
      line-height:1.5;
      margin: 0px 0px 30px 0px;
    }
    .woocommerce .woocommerce-breadcrumb a{
      color: #727272;
      margin-right: 3px;
      text-decoration:none;
    }
    .woocommerce .woocommerce-breadcrumb a:after{
      content: " ";
      display: inline-block;
      position: relative;
      top: -1px;
      color: #b5b5b5;
      border: solid #b5b5b5;
      border-width: 0 2px 2px 0;
      padding: 2px;
      transform: rotate(-45deg);
      margin: 0px 5px 0px 5px;
    }
    .woocommerce .woocommerce-breadcrumb a:first-child:before{
      content: "";
      display: inline-block;
      position: relative;
      top: 1px;
      background-image: url(<?php echo AMP_WOO_PLUGIN_URI.'/assets/home.png';?>);
      background-size: 12px;
      width: 17px;
      height: 12px;
      background-repeat: no-repeat;
    }

    .addtional-field{
       display: inline-flex;
        margin-right: 1em;
        white-space: nowrap;
        vertical-align: top;
    }
    .addtional-field .subb,.addtional-field .addi{
         padding-left: .5em;
        padding-right: .5em;
        overflow: hidden;
        position: relative;
        background-color: #f9f9f9;
        text-shadow: 1px 1px 1px #fff;
        color: #666;
        border: 1px solid #ddd;
        text-transform: none;
        font-weight: normal;
        cursor: pointer;
        text-align: center;
        vertical-align: middle;
        border-radius: 0;
        margin-right: 1em;
        text-shadow: none;
        line-height: 2.4em;
    }

    .hide{
    display:none;
  }
    #content .wgm-info{
    diplay:inline-block;
    }
      
      @font-face{font-family:'fl-icons';font-display:block;src:url("<?php echo AMP_WOO_PLUGIN_URI.'assets/fl-icons/fl-icons.eot';?>");src:url("<?php echo AMP_WOO_PLUGIN_URI.'assets/fl-icons/fl-icons.eot#iefix';?>") format("embedded-opentype"),url("<?php echo AMP_WOO_PLUGIN_URI.'assets/fl-icons/fl-icons.woff2';?>") format("woff2"),url("<?php echo AMP_WOO_PLUGIN_URI.'assets/fl-icons/fl-icons.ttf';?>") format("truetype"),url("<?php echo AMP_WOO_PLUGIN_URI.'assets/fl-icons/fl-icons.woff';?>") format("woff"),url("<?php echo AMP_WOO_PLUGIN_URI.'assets/fl-icons/fl-icons.svg#fl-icons';?>") format("svg")}


/** Widget CSS **/
#content{
  max-width: 1080px;
  margin:0 auto;
  display: flex;
  flex-wrap: wrap;
}
#content .wcsdbr-lft.wcsdbr {
    flex-basis: calc(70%);
}
#content .sdbr-right.wcsdbr {
    flex-basis: calc(25%);
    margin-top:50px;
    margin-left:30px;
}
#content .wcsdbr{
  flex: 1 0 100%;
}
.amp-sidebar h4{
  font-size:18px;
  letter-spacing: 0;
  border-bottom: 1px solid rgba(0, 0, 0, 0.05);
  padding: 0 0 15px;
  margin-bottom: 15px;
  font-weight: 500;
  color: #727272;
}
.amp-sidebar .woocommerce-Price-amount{
  display: contents;
  font-size: 14px;
  margin: 0;
}
.amp-sidebar{
  margin-bottom:50px;
}
.amp-sidebar ul.product_list_widget li{
  padding:18px 0px;
  border-top: none;
}
.amp-sidebar ul.product_list_widget li a{
  margin-bottom: 5px;
  text-decoration: underline;
  color: #727272;
  font-size: 14px;
  line-height: 1.5;
  font-weight: 500;
}
.amp-sidebar ul.product_list_widget li a:hover{
  text-decoration: none;
  color: #111;
}
.amp-sidebar ul li{
  list-style-type:none;
}
.amp-sidebar  ul.product-categories li .children{
  padding-left:20px;
  margin-top:10px;
}
.amp-sidebar  ul.product-categories li{
  margin-bottom:10px;
}
.amp-sidebar  ul.product-categories li a:before{
  content:"";
  background-image: url(data:image/svg+xml;base64,
    PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHg9IjBweCIgeT0iMHB4IiB2aWV3Qm94PSIwIDAgNTggNTgiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDU4IDU4OyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSIgd2lkdGg9IjUxMiIgaGVpZ2h0PSI1MTIiIGNsYXNzPSIiPjxnPjxwYXRoIHN0eWxlPSJmaWxsOiNDQ0NDQ0MiIGQ9Ik01NS45ODEsNTQuNUgyLjAxOUMwLjkwNCw1NC41LDAsNTMuNTk2LDAsNTIuNDgxVjIwLjVoNTh2MzEuOTgxQzU4LDUzLjU5Niw1Ny4wOTYsNTQuNSw1NS45ODEsNTQuNXogICIgZGF0YS1vcmlnaW5hbD0iI0VGQ0U0QSIgY2xhc3M9ImFjdGl2ZS1wYXRoIiBkYXRhLW9sZF9jb2xvcj0iI0VGQ0U0QSI+PC9wYXRoPjxwYXRoIHN0eWxlPSJmaWxsOiNDQ0NDQ0MiIGQ9Ik0yNi4wMTksMTEuNVY1LjUxOUMyNi4wMTksNC40MDQsMjUuMTE1LDMuNSwyNCwzLjVIMi4wMTlDMC45MDQsMy41LDAsNC40MDQsMCw1LjUxOVYxMC41djEwaDU4ICB2LTYuOTgxYzAtMS4xMTUtMC45MDQtMi4wMTktMi4wMTktMi4wMTlIMjYuMDE5eiIgZGF0YS1vcmlnaW5hbD0iI0VCQkExNiIgY2xhc3M9IiIgZGF0YS1vbGRfY29sb3I9IiNFQkJBMTYiPjwvcGF0aD48L2c+IDwvc3ZnPg==);
  display: inline-block;
  width: 12px;
  height: 12px;
  background-size: 12px;
  background-repeat: no-repeat;
  position: relative;
  top: 3px;
  margin-right: 8px;
}
.amp-sidebar ul.product-categories li a, .amp-sidebar ul.product-categories li span.count{
  font-size: 14px;
  line-height: 1.3;
  color: #727272;
  font-weight: 500;
  text-decoration: underline;
}
.amp-sidebar ul.product-categories li a:hover{
  text-decoration: none;
}
.amp-sidebar ul.product-categories li span.count{
  float:right;
  font-size: 12px;
  text-decoration: none;
}
.amp-sidebar ul li.wc-layered-nav-rating a{
  display: flex;
  flex-wrap: wrap;
  width: 100%;
  margin-bottom: 15px;
  color: #727272;
  font-weight: 600;
  font-size: 13px;
}
.amp-sidebar ul li.wc-layered-nav-rating a .s-r{
  order: 0;
  display: flex;
  margin-right: 5px;
  font-size: 15px;
}
.product_list_widget li .s-r{
  margin-bottom:7px;
}
.product_list_widget .reviewer{
  font-size: 13px;
  color: #727272;
}
.price_slider_amount{
  display:inline-block;
  width:100%
}
.amp-sidebar .price_slider_amount input{
  width: 49%;
  border: 1px solid #ccc;
  padding: 4px 10px;
  display: inline-block;
  margin: 0;
  height: auto;
}
.price_slider_amount button.button{
  margin-top: 14px;
  width: 100%;
  background:#666;
}
.price_slider_amount .price_label{
  display:none;
}
.amp-sidebar .chosen a:before{
  content: "✖";
  display: inline-block;
  color: #e2401c;
  margin-right: 8px;
  line-height: 0;
  position: relative;
  font-weight: bold;
  top: 1px;
  font-size: 14px;
}
.amp-sidebar .chosen{
  margin-bottom:10px;
}
.amp-sidebar .chosen a{
  font-size: 13px;
  line-height: 1.3;
  color: #727272;
  font-weight: 500;
  text-decoration: underline;
}
.amp-sidebar .chosen a .woocommerce-Price-amount {
  font-size: 12px;
}
.amp-sidebar .chosen a:hover{
  text-decoration: none;
}
.amp-sidebar .dropdown_product_cat{
  border: 1px solid #ccc;
  padding: 5px 20px 5px 10px;
  width: 100%;
  color: #999;
}
.amp-sidebar .dropdown_product_cat option{
  color:#444;
  font-size:14px;
  line-height:1.4;
}

/** Flatsom Compatible CSS **/
.amp-sidebar ul.product_list_widget li{
  padding-left:75px;
}
.amp-sidebar ul.product-categories li .children{
  margin: 0;
}
.amp-single .large-2{display:none;}
.amp-single .shop-container .container, .amp-single .shop-container .container-width, .amp-single .shop-container .row{
  max-width:100%;
}




@media(max-width:1080px){
  #content{
    max-width: 100%;
    display:inline-block;
  }
}


@media(max-width:849px){
  #content .wcsdbr-lft.wcsdbr {
    flex-basis: calc(100%);
  }
  #content .sdbr-right.wcsdbr {
    flex-basis: calc(100%);
    margin-top: 30px;
    margin-left : 0px;
  }


}

/* Swatch product CSS */
.swatch_radio{
  display: flex;
}
.swatch_radio .swatch_input{
  margin-bottom: 8px;
}
.swatch_label{
  display: inline-flex;
  margin-left: 7px;
}
.wvs-archive-variation-wrapper {
    display: none;
}
.swatch_images{
        width:32px;
        height:32px;
        display:inline-block;
        cursor: pointer;
        border: solid 2px white ;
        outline: solid 1px #9C9999;

      }
      .swatch_text{
          text-align: center;
          width: auto;
          padding: 0 10px;
          line-height: 30px;
          color: black;
          border: solid 0px white !important;
          outline: solid 0px #9C9999 !important;
          background: #eee;
          font-size: 14px;
          font-weight: 500 !important;
          border-radius: 20%;
      }
      .swatch_color{
          font-size: 20px;
          font-weight: 500;
          width: 32px;
          height: 32px;
          border: solid 2px white ;
          outline: solid 1px #9C9999;
          display: inline-block;
      }

      input:checked + .swa_check {
          outline: solid 2px black;
      }

 <?php } 



function amp_woo_flatsome_default_css_v3(){
   $srcs = array();
   $theme_uri = get_stylesheet_directory_uri();
   $parent = wp_get_theme()->parent();
   if(isset($parent)){
    $srcs[] = $theme_uri.'/css/allScreens.css';
    $theme_uri = get_parent_theme_file_uri();
   }
   $srcs[] = $theme_uri.'/assets/css/flatsome.css';
   $srcs[] = $theme_uri.'/assets/css/flatsome-shop.css';

   foreach ($srcs as $key => $urlValue) {
      $cssData = amp_woo_remote_content($urlValue);
      $cssData = preg_replace("/\/\*(.*?)\*\//si", "", $cssData);
      $cssData = str_replace('img', 'amp-img', $cssData);
           echo amp_woo_css_sanitizer($cssData); // XSS ok.
    }
}





  function amp_woo_remote_content($src){
      if($src){
        $arg = array( "sslverify" => false, "timeout" => 60 ) ;
        $response = wp_remote_get( $src, $arg );
            if ( wp_remote_retrieve_response_code($response) == 200 && is_array( $response ) ) {
              $header = wp_remote_retrieve_headers($response); // array of http header lines
              $contentData =  wp_remote_retrieve_body($response); // use the content
              return $contentData;
            }else{
              global $wp_filesystem;
              require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-base.php';
              require_once ABSPATH . '/wp-admin/includes/class-wp-filesystem-direct.php';
           $wp_filesystem = new WP_Filesystem_Direct( array() );

          $contentData = $wp_filesystem->get_contents( $src );
          if(! $contentData ){
            $data = str_replace(get_site_url(), '', $src);//content_url()
            $data = getcwd().$data;
            if(file_exists($data)){
              $contentData = $wp_filesystem->get_contents($data);
            }
          }
          return $contentData;
        }

      }
        return '';
  }




function amp_woo_The7() {
  ?>
        .related-product > li .product-thumbnail {max-width: 100px;
    min-width: 100px;margin-right: 20px;}
.content .related-product {display: -webkit-flex;-ms-flex-flow: row wrap;
    flex-flow: row wrap;}.related-product > li {position: relative;
    display: flex;width: 33%;padding: 0 25px 25px 25px;}
 .related-product > li .product-title, .related-product > li .amount {
    font-size: 15px;line-height: 27px;color: #333;}
.related-product > li .product-title {display: inline-block;
    margin-bottom: 5px;text-decoration: none;font-weight: bold;}
@media (max-width:800px){.related-product > li {position: relative;
    display: flex;width: 100%;padding: 0 25px 25px 25px;}}
  a.button:not(.edd-submit), input[type="button"], input[type="reset"], input.button, input[name="save_address"], input[type="submit"]:not([name="update_cart"]), .woocommerce .cart-field input.button {color: #fff;background: linear-gradient(135deg,#1ebbf0 30%,#39dfaa 100%);}.post .rollover, .post .rollover-video:not(.ts-slide), .post img, img[class*=align], img[class*=wp-image-], img[class*=attachment-] {max-width: 100%;height: auto;}span.onsale {background: #1ebbf0;background: -webkit-linear-gradient(135deg, #1ebbf0 30%, #39dfaa 100%);background: linear-gradient(135deg, #1ebbf0 30%, #39dfaa 100%);}@media only screen and (min-width: 700px) {.woocommerce span.onsale{top: 0.5em;left:0.5em;}article.post.visible.description-off.product.type-product{margin-left: auto;margin-right: auto;width: 33%;left:4%;}amp-img.attachment-woocommerce_thumbnail {width: 388px;}.woo-buttons-on-img {width:65%;}.woo-buttons-on-img-hover-effect{width:65%;}figcaption.woocom-list-content{right: 18%;position:relative;}.v3_wc_content_wrap header {font-size: 36px;margin: 0px 0px 0px 30%;padding: 35px 0px 35px 0px;}}
@media only screen and (max-width: 699px) {.woocommerce span.onsale{top: 0.5em;left:0.5em;}article.post.visible.description-off.product.type-product{margin-left: auto;margin-right: auto;}}@media only screen and (max-width: 600px) { form#order{left: 32%;position: relative;}.v3_wc_content_wrap header{font-size: 34px;padding: 0px 0px 25px 0px;}}.switcher-wrap{display: contents;}.woo-buttons-on-img-hover-effect{position:relative;}.woo-buttons-on-img-hover-effect amp-img.show-on-hover{position: absolute;left: 0;top: 0;right: 0px;opacity: 0;}
  .woo-buttons-on-img-hover-effect a{width:100%;display:inline-block;}
  .woo-buttons-on-img-hover-effect:hover a amp-img.attachment-woocommerce_thumbnail{
      opacity: 0;}.woo-buttons-on-img-hover-effect:hover amp-img.show-on-hover{opacity:1;};
   <?php 
}

//Rehub Theme CSS
function amp_woo_Rehub_theme(){ ?>
.show-on-hover-img .img-centered-flex:hover amp-img {opacity: 0;}.show-on-hover-img .img-centered-flex:hover .rh-hov-img-trans amp-img {opacity: 1;}
.rh-hov-img-trans amp-img{position: absolute;left: 0;top: 0;right: 0px;
    opacity: 0;}.rh-hov-img-trans amp-img:hover {opacity:1;display:inline-block;}
.woocommerce .ampwoocommerce p,.woocommerce .ampwoocommerce li,.ampwoocommerce #myTabPanels h1,h2,h3,h4,h5,h6{line-height: 2em;}
  .col_wrap_fourth .col_item { width: 24.7%;
display: inline-block;margin: 0px 0px 13px 0px;}.eq_grid .col_item {border: 1px solid #cecece;padding: 15px;}.grid_onsale {padding: 3px 7px;font: bold 12px/15px Arial;
position: absolute;text-align: center;top: 3px;right: 3px;z-index: 1;margin:0;background: #1da69c;color: #fff;}.woocommerce amp-img, .w-pg amp-img {height: auto;}
.offer_grid h3 {height: 36px;font-size: 15px;line-height: 18px;margin: 0 0 12px;overflow: hidden;font-weight: 400;}.offer_grid h3 a {color: #111;}
a.font70.greycolor.displayblock {bottom: -18px;position: relative;right: 70%;}
.lineheight15 {line-height: 19px;right: 7px;position: relative;top: 3px;}
.re_actions_for_grid .btn_act_for_grid {background-color: #f4f3f3;width: 49.33%;height: 38px;float: left;line-height: 38px;color: #656d78;text-align: center;display: block;    padding: 0;border-right: 1px solid #fff;font-size: 14px;}
.ml5 { margin-left: 5px;display: none;}
a.re_track_btn.woo_loop_btn.btn_offer_block.product_type_cegg {width: 99%;font-weight: 100;}input.ampstart-btn.caps.user-valid.valid.button { background: #ef4136;text-transform: uppercase;color: white;font: 700 15px/15px 'Roboto',trebuchet ms;}
.heart_thumb_wrap .heartplus:before, .heart_thumb_wrap:hover .heartplus.alreadywish:not(.wishlisted):before {content: "\f004";font-weight: 300;}.rh_woo_star {display: none;}form#order {display:none;}.woo_gridloop_btn.mb15.text-center {display:none;}.re_actions_for_grid.two_col_btn_for_grid {display: none;}
.content-wrapper {padding-right: 15px;padding-left: 21px;}.breadcrumb ul li, .breadcrumbs span {display: inline-block;list-style-type: none;font-size: 10px;text-transform:uppercase;
    margin-right: 5px;margin: 0;}.woocommerce .p-m-fl {display: none;
}i-amphtml-sizer {padding: 10px;}.hamb-mnu{left:0%;}.content-wrapper {margin-top: 0px;}
@media only screen and (max-width: 600px) {.h-shop.h-ic { top: 2px; position: relative; }.h-srch.h-ic { left: 6px; position: relative; }
.col_wrap_fourth .col_item {width: 79.5%;margin: 0px 0px 13px 0px;left: 9%;}.lineheight15 {position: relative;bottom: 0px;}}
button.single_add_to_cart_button.button.alt.user-valid.valid {display: none;}form.cart {display: block;}.amp-archive-desc p {font-size: 16px;line-height: 2.0em}
li {margin: 0px 0px 0px 0px;}tbody.acss0c3e1 {font-size: medium;text-align: start;border-spacing: 4px;border: 5px black solid;}
th.acss3fb98 {float: left;top: 16px;position: relative;}
table {border-collapse: collapse;border-spacing: 0;border-collapse: separate;color: -internal-quirk-inherit;border: 1px solid #000;border-radius: 4px;line-height: 3em;}
.cntn-wrp a {margin: 10px 0px;color: #fff;}a.ebtn-link.ebtn.ele-size-sm {
    color: #fff;}a.btn-alter {display: none;}
.woocommerce .product p.price{margin: 0px 0px 0px 0px;}.woocommerce .product .wpr{margin-bottom: 0.418em;}
.header {margin-top: 0px;}
@media only screen and (min-width: 700px) {.fa.fa-user {float: right;font-size: 23px;position:relative;}.purc-button {background: #ef4137;padding: 11px 20px;float: right;bottom: 50px;
    position: relative;left: 6%;font: 700 14px/17px 'Roboto', trebuchet ms;text-transform: uppercase;border-radius: 5px;}.sale-price {color: #111;font-weight: 600;left: 64%;position: relative;bottom: 26px;}
.old-price {font-size: 70%;text-decoration: line-through;left: 66%;position: relative;
    bottom: 15px;opacity: 0.4;font-weight: 600;}}.woocommerce .product form.cart .single_add_to_cart_button{display:none;}
.purc-button a {color: #fff;}.inner-amp {padding: 20px 0px 10px 0px;}
@media only screen and (max-width: 650px) {.purc-button {background: #ef4137;padding: 11px 13px;float: right;bottom: 56px;position: relative;font: 700 14px/17px 'Roboto', trebuchet ms;text-transform: uppercase;border-radius: 5px;padding: 11px 20px;}
.sale-price {color: #111;font-weight: 600;}
.old-price {font-size: 70%;text-decoration: line-through;opacity: 0.4;font-weight: 600;}}
table.acssbfcc0 a {color: #337ab7;}

  .rate-bar-percent, .rate-bar-title {
      position: unset;
      top: 0px;
      font-size: 14px;
  }.ampwc_wpsm_pros ul li:before {
      content: '\f058';
      display: inline-block;
      font: normal normal normal 14px/1 FontAwesome;
      text-rendering: auto;
      color: #58c649;padding-right: 8px;
      font-weight: 900;
      font-size: 20px;
      left: 1px;
      position: relative;
  }
  .ampwc_wpsm_pros .title_pros {
    margin: 0 0 15px;
    font-size: 16px;
    font-style: italic;
    font-weight: 700;
    color: #58c649;
}
.ampwc_wpsm_cons .title_cons {
    color: #f24f4f;
    margin: 0 0 15px;
    font-size: 16px;
    font-style: italic;
    font-weight: 700;
}.ampwc_wpsm_cons ul {
    list-style: none;
}.rate-bar-percent-amp {
      float: right;
  }.rate-bar-title span {display: block;height: 18px;bottom: 28px;position: relative;}
  .rate-bar-bar {height: 13px;width: 100%;border-radius: 9px;top: 29px;position:relative;z-index: 999999;}.mt20 {
      margin-top: 68px;
  }
  .rate-bar-title {top:76px;position: relative;margin-bottom: 34px;
       background: #ddd;height: 14px;border-radius: 9px;}
  li.fas.fa-check {
      display: block;
      font: normal normal normal 14px/1 FontAwesome;
      font-size: inherit;
      text-rendering: auto;
      
  }.fa-minus:before {font: normal normal normal 14px/1 FontAwesome;display: inline-block;content: '\f056';color: #f24f4f;padding-right: 8px;font-weight: 900;}
  .wpsm-one-half.wpsm-column-first {
      float: left;
  }.wpsm-one-half.wpsm-column-last {
      float: right;
  }.wpsm_cons ul {
      list-style-type: none;
  }.rate_bar_wrap {background: #fff;margin-right: 35px;}h3{font: 700 21px/28px "Roboto",trebuchet ms;color: #111;margin: 10px 0 25px 0;}
  @media only screen and (min-width: 600px) {.col_wrap_three .col_item {width: 30.33%;margin: 0 1.5% 25px;float: left;}}.col_wrap_three .col_item:nth-child(3n+1) {clear: both;}.heart_thumb_wrap {display: none;}body {font-family:"Poppins",sans-serif;}
<?php 
}
function amp_woo_XStore_theme(){ ?>
.fixed-content {float: right;width: 45%;}
@media screen and (max-width:768px){
  .fixed-content {float: unset;}
  .element-TFML4 {float: left;}
}
.product-share {
    display: none;
}
.element-TFML4 {
    float: right;
}
.row .w-b {
    display: none;
}.swiper-slide.slide-item.product-slide {
    float: left;
    width: 33.33%;
    padding: 45px;
}
<?php }