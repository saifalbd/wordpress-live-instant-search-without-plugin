<?php


function saifallive_footer_scripts()
{
   
 wp_register_script('lodash.min',get_template_directory_uri().'/SaifalLive/js/lodash@4.13.1/lodash.min.js', array(), '4.13.1',false); 
        wp_enqueue_script('lodash.min');


  wp_register_script('vue.min',get_template_directory_uri().'/SaifalLive/js/vue.min.js', array(), '2.5.13',true); 
        wp_enqueue_script('vue.min'); 

   
      wp_register_script('wpapi.min',get_template_directory_uri().'/SaifalLive/js/wpapi.min.js', array(), '3.3.1',true); 
        wp_enqueue_script('wpapi.min'); 

          
  

}


add_action("wp_enqueue_scripts", "saifallive_footer_scripts");

