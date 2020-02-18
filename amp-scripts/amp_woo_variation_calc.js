var select = document.getElementsByTagName("select");

if(select){

  for(var i=0; i<select.length;i++ ){
    select[i].addEventListener( 'change', function(e) {
      amp_woo_variation_calculation(e);
    });
  }
}

var form =  document.getElementById("amp_variations");


function amp_woo_variation_calculation(e){
      var attribute_data  = '';
      var all_attribute_set = '';
      for (var is_key in select) {
       attribute_data += select[is_key].name+"="+select[is_key].value+"&";
      }
      if(attribute_data.indexOf("Choose an option") < 0 && attribute_data.indexOf("=&") < 0){
        all_attribute_set = true;
      }else{
        all_attribute_set = false;
      }

      if(all_attribute_set == false){
      document.getElementById("var_display_price").classList.add("hide");  
      var default_img = '';
      AMP.setState({product:{swatch_image:{bigswatch_url:default_img,big_tmb_src:default_img}}});
      return;
      }
      document.getElementById("var_display_price").classList.remove("hide");
     var product_id = form.getAttribute('data-product_id');

	    var formData = attribute_data+'product_id='+product_id;
      amp_woo_ajax_request_sending(formData);
 
}


function amp_woo_ajax_request_sending(formData){

     var xhttp = new XMLHttpRequest();
      var url = form.getAttribute('data-site-url');
      var admin_ajax = url+"/?wc-ajax=get_variation"; 
      xhttp.open("POST", admin_ajax, true);
      xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');

      xhttp.send(formData);

     xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:  price_html

         var output = JSON.parse(xhttp.responseText);
          var price = '';
          if(output == false){
           price = "Sorry this combination is not available";
           document.getElementById("error_msg").classList.remove("hide"); 
           document.getElementById("error_msg").innerHTML = price;
           document.getElementById("var_display_price").classList.add("hide"); 
           return;
           }
           document.getElementById("error_msg").classList.add("hide"); 
             price = output.display_price;
             var  image_url = output.image.url;
             var thumb_url_src = output.image.gallery_thumbnail_src;
             var image_height = (494/output.image.full_src_w)*(output.image.full_src_h);
             AMP.setState({product:{swatch_image:{bigswatch_url:image_url,big_tmb_src:thumb_url_src,height:image_height}}});
         document.getElementById("var_price").innerHTML = price;
        }
       };

}