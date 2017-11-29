<?php 
/*
Plugin Name: Upload Resume
Description: It used to store and review the user information
Version: 1.1.1
Author: mbbhatti
*/

function wpb_adding_scripts() {
	echo '<script type="text/javascript" src="'.plugins_url('tinymce/js/tinymce/tinymce.min.js', __FILE__).'"></script>';    
}
add_action('wp_head', 'wpb_adding_scripts');


$plugin_url=trailingslashit( WP_PLUGIN_URL.'/'.dirname( plugin_basename(__FILE__)) );

register_activation_hook(__FILE__,'user_resume_create');
function user_resume_create () {
        
    global $wpdb;
	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

    $table_user_info = $wpdb->prefix . "user_info";	
	array_push($wpdb->tables,$table_user_info); 		
     
    if($wpdb->get_var("SHOW TABLES LIKE '$table_user_info'") != $table_user_info) { 
		
		$sql = "CREATE TABLE $table_user_info (
			      id int(11) NOT NULL AUTO_INCREMENT,			      
			      user_id  int(11),
			      name varchar(255),
			      email varchar(255),
			      resume varchar(255),
			      comments text,
			      UNIQUE KEY id (id)
			    );";        
 		
		dbDelta($sql);			
		
		if(get_option("db_table")){
        	update_option( "db_table_".$table_user_info, $table_user_info ); 
		}else{
		 	add_option("db_table_".$table_user_info, $table_user_info); 
		}
	}    
}

register_deactivation_hook( __FILE__, 'user_resume_deactivate' );
function user_resume_deactivate(){
	
	global $wpdb;
	
	$table_name = $wpdb->prefix . "user_info";
	$wpdb->query("Drop table ".$table_name);
	array_pop($wpdb->tables);
	delete_option( "db_table_".$table_name );
}

include("upload_template.php");
?>