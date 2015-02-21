<?php
/**
 * Main admin panel script
 */

// get the content from options or use default
$cbw_content = get_option('cbw_below_content');

$editor_id = 'cbw_below_content';
$a_editor_settings = Array(
    'wpautop' => false,
    'extended_valid_elements' => 'style'
);

if (empty($cbw_content)) $cbw_content = CBW_DEFAULT_CODE;
?>

<script type="text/javascript">
 jQuery(document).ready(function(){

     



 });
</script>
<style type="text/css">
 #subscription-image{
     width:140px;
 }
 .button-primary{height:40px !important;}
 table#controls-footer td, table#controls-footer tr{ padding:0;margin:0; }
 .form-table td p{ margin-top:0 !important;  }
 p.submit{
     padding-top:0 !important;
 }
 div#cbw_content-preview{
     padding:10px;
     display:block;
     width:96%;
 }
 .cbw-green{
     background-color: #ffffff !important;
     display: block;
     border: 1px #1dcd31 solid;
     
 }
 .cbw-grey{
     background-color: #ffffff !important;
     display: block;
     border: 1px #ca231b solid;
 }
 div#cbw_suscriptions{
     text-align:center;
     height:360px;
 }
.activate-highlight {
  background: none repeat scroll 0 0 #fff;
  margin-right: 10px;
  padding: 30px;
}
 .activate-option {
  /*background: none repeat scroll 0 0 #e3e3e3;*/
  border-radius: 3px;
  margin-bottom: 30px;
  overflow: hidden;
  padding: 20px;
}
#s_email{
     position:relative;
     margin-top:23px;
     margin-bottom:12px;
     background-color:#ddd;
 }
 #enable_opt2{
     position:relative;
     display:block;
     margin-top:4px;
 }
 #subheader {
	 font-family: Tahoma, Georgia;
	 font-size: 22px;
	 
 }
 #links {
	 text-decoration: none;
	 
 }
 #links:hover {
	 text-decoration: underline;
	 
 }
 
 

</style>
<div class="wrap">
    <h2>Panneau d'administration E-SOFT inc.</h2>
    <hr /><br />

    <form method="post" action="options.php">
        <?php settings_fields( 'cbw-settings-group' ); ?>
        <?php do_settings_sections( 'cbw-settings-group' ); ?>
        <input type="hidden" id="cbw_below_powered" name="cbw_below_powered" value="<?php echo $cbw_powered;  ?>" />
       <h1> Listes des shortcuts du Pack</h1>
       <ul><li> [es-year]</li>
        <li>[es-month]</li>
        <li>[es-day]</li>
        <li>[es-creationweb]</li>
        <li>[es-gemcoin-price]</li>
	</ul>

        <!--<table class="form-table" border="0" style="min-width:500px;">
            <tr>
                <td style="padding-top:0;margin-top:0;">
                   <?php
                    if (function_exists("wp_editor")){
                        wp_editor( $cbw_content, $editor_id, $a_editor_settings );
                    }else{
                        echo '<textarea name="cbw_below_content">'.$cbw_content.'</textarea>';
                    }
                    ?>
                </td>
            </tr>
            <tr>--> Pour utilisation future
                <td><?php submit_button(); ?></td>
            </tr>
        </table>
   
    </form>
    
</div>
