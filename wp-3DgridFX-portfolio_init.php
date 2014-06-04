<?php
/*
    "Wp 3DgridFX portfolio plugin" Copyright (C) 2014 Zerokod Interactive Media Productions

    
    
    
    
*/

function wpstreamp__init($file) {

    require_once('wpstreamp__Plugin.php');
    $aPlugin = new wpstreamp__Plugin();

   
    if (!$aPlugin->isInstalled()) {
        $aPlugin->install();
    }
    else {
        
        $aPlugin->upgrade();
    }

    
    $aPlugin->addActionsAndFilters();

    if (!$file) {
        $file = __FILE__;
    }
   
    register_activation_hook($file, array(&$aPlugin, 'activate'));


   
    register_deactivation_hook($file, array(&$aPlugin, 'deactivate'));
    
    
    
 
}
