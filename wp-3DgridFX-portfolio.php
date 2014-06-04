<?php
/*
   Plugin Name: WP-3DGridFX-Portfolio
   Plugin URI: zerokod.com
   Version: 0.1
   Author: Zerokod Interactive Media Productions
   Description: Wordpress Portfolio with 3D Grid Effect
   Text Domain: wp-3DgridFX-portfolio
   License: All rights reserved
  */


include_once('wpstreamp__OptionsManager.php');


$wpstreamp__minimalRequiredPhpVersion = '5.0';
$jal_db_version = "1.0";




function wpstreamp__noticePhpVersionWrong() {
    global $wpstreamp__minimalRequiredPhpVersion;
    echo '<div class="updated fade">' .
      __('Error: plugin "wp-3DgridFX-portfolio" requires a newer version of PHP to be running.',  'wp-3DgridFX-portfolio').
            '<br/>' . __('Minimal version of PHP required: ', 'wp-3DgridFX-portfolio') . '<strong>' . $wpstreamp__minimalRequiredPhpVersion . '</strong>' .
            '<br/>' . __('Your server\'s PHP version: ', 'wp-3DgridFX-portfolio') . '<strong>' . phpversion() . '</strong>' .
         '</div>';
}


function wpstreamp__PhpVersionCheck() {
    global $wpstreamp__minimalRequiredPhpVersion;
    if (version_compare(phpversion(), $wpstreamp__minimalRequiredPhpVersion) < 0) {
        add_action('admin_notices', 'wpstreamp__noticePhpVersionWrong');
        return false;
    }
    return true;
}



function wpstreamp__i18n_init() {
    $pluginDir = dirname(plugin_basename(__FILE__));
    load_plugin_textdomain('wp-3DgridFX-portfolio', false, $pluginDir . '/languages/');
}


wpstreamp__i18n_init();



if (wpstreamp__PhpVersionCheck()) {
    // Only load and run the init function if we know PHP version can parse it
    include_once('wp-3DgridFX-portfolio_init.php');
    wpstreamp__init(__FILE__);
}



    function deactivate() {
    	//uninstall();
    }
    
    function uninstall() {
        //$this->otherUninstall();
        unInstallDatabaseTables_categories();
        unInstallDatabaseTables_portfolio();
        deleteSavedOptions();
        //$this->deleteSavedOptions();
        //$this->markAsUnInstalled();
    }
  

     
      
   