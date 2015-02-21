<?php
/**
 * Plugin Name: EsoftInc
 * Description: Add custom HTML content using shortcode
 * Version: 0.2
 * Author: nicolas_
 * Author URI: http://www.nic0las.com
 * License: GPLv2 or later
 */


$path = dirname(__FILE__);
$url = plugins_url().'/esoftinc'; 
define("CBW_DEFAULT_CODE", ''); // default content for the shortcode, in case the current dashboard form is used (currently unused)


/**
 * Main admin function called when selecting the code-below option in admin menu
 */
function cbw_admin_function(){
    include('admin/esoftinc-admin.php');
}


/**
 * Plugin settings registration, for registering specific form values to use in the dashboard
 */
function cbw_register_settings(){
    register_setting( 'cbw-settings-group', 'cbw_below_content' );
}


/**
 * Add to menu & register settings
 */
function cbw_register_custom_menu(){
    // add item to the menu
    add_menu_page( 'EsoftInc', 'E-SOFT inc.', 'administrator', 'esoftinc', 'cbw_admin_function');
    // include jquery
    wp_enqueue_script('jquery');
    // register settings
    add_action( 'admin_init', 'cbw_register_settings' );
}

/**
 * Shortcode function to display the current server year
 */
function cbw_shortcode(){
    // $cbw_content = get_option('cbw_below_content'); // unused, here you can grab the html of the for element in the dashboard page
    return date("Y");
}
/**
 * Shortcode function to scrape and get the gemcoin price from gemcoin.ch homepage
 */

function cbw_shortcode_gemcoin_price(){
    require_once("libs/class.tac.php");
    require_once("libs/simple_html_dom.php");
    
    $base_url = "http://gemcoin.ch/";
    $base_content = ""; // main content var, when need to parse this later
    $ret = "Error finding data. The source site might have changed.";
    
    $TEC = new TEC();
    $TEC->uri_set($base_url);
    $base_content = $TEC->source_get();

    if (!empty($base_content)){
        
        $html = str_get_html($base_content);
        $html_price = $html->find('#text-2', 0);
        // Find all images
        foreach($html->find('#text-2') as $element){
            if (isset($element->children(0)->plaintext)){
                $ret = $element->children(0)->plaintext;
            }
        }

    }
    
    
    return $ret;
}


/**
 * Finally add actions and filters
 */

if (is_admin()){
    add_action( 'admin_menu', 'cbw_register_custom_menu' );
}


add_shortcode( 'es-year', 'cbw_shortcode' );
add_shortcode( 'es-gemcoin-price', 'cbw_shortcode_gemcoin_price' );

?>
