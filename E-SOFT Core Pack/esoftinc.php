<?php
/**
 * Plugin Name: E-SOFT Pack
 * Description: Wordpress Pack pour E-SOFT inc.
 * Version: 0.5
 * Author:  E-SOFT inc.
 * Author URI: http://www.e-soft.ca
 * License: (C) E-SOFT inc.
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
 * Shortcode function
 */
function cbw_shortcode_year(){
    // $cbw_content = get_option('cbw_below_content'); // unused, here you can grab the html of the for element in the dashboard page
    return date("Y");
}

function cbw_shortcode_month(){
    // $cbw_content = get_option('cbw_below_content'); // unused, here you can grab the html of the for element in the dashboard page
    return date("M");
}

function cbw_shortcode_day(){
    // $cbw_content = get_option('cbw_below_content'); // unused, here you can grab the html of the for element in the dashboard page
    return date("D");
}

function cbw_shortcode_creationweb(){
    // $cbw_content = get_option('cbw_below_content'); // unused, here you can grab the html of the for element in the dashboard page
    return "Une cr&eacute;ation Web <a href=\"http://www.e-soft.ca\"><img alt=\"E-SOFT inc. Conception de site Web\" src=\"http://www.e-soft.ca/images/e-soft-logo.Blanc55x21.png\"></a>";
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
                $a_ret = explode("=", $element->children(0)->plaintext);
                if (isset($a_ret[1]) && !empty($a_ret[1])){
                    $ret = trim($a_ret[1]);
                }else{
                    $ret = $element->children(0)->plaintext;
                }
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


add_shortcode( 'es-year', 'cbw_shortcode_year' );
add_shortcode( 'es-month', 'cbw_shortcode_month' );
add_shortcode( 'es-day', 'cbw_shortcode_day' );
add_shortcode( 'es-creationweb', 'cbw_shortcode_creationweb' );
add_shortcode( 'es-gemcoin-price', 'cbw_shortcode_gemcoin_price' )

?>
