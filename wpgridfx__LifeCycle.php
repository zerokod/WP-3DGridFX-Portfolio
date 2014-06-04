<?php
/*
    "Wp 3DgridFX portfolio plugin" Copyright (C) 2014 Zerokod Interactive Media Productions
*/

$jal_db_version = "1.0";
include_once('wpstreamp__InstallIndicator.php');

class wpstreamp__LifeCycle extends wpstreamp__InstallIndicator {

    public function install() {

        
        $this->initOptions();
        
        
        $this->installDatabaseTables();

        
        $this->saveInstalledVersion();

        
        $this->markAsInstalled();
    }

    public function uninstall() {
        //$this->otherUninstall();
    	if ('true' === $this->getOption('DropOnUninstall', 'false')) {
        $this->unInstallDatabaseTables();
        $this->deleteSavedOptions();
    	}
        $this->markAsUnInstalled();
    }

   
    public function upgrade() {
    }

    
    public function activate() {
    	$this->install();
    }

    
    public function deactivate() {
    	$this->uninstall();
    }

   
    protected function initOptions() {
        $options = $this->getOptionMetaData();
        if (!empty($options)) {
            foreach ($options as $key => $arr) {
                if (is_array($arr) && count($arr > 1)) {
                    $this->addOption($key, $arr[1]);
                }
            }
        }
          
        $this->updateSavedOption();
    }

    
    
public function getOptionMetaData() {
        
        return array(
            //'_version' => array('Installed Version'), // Leave this one commented-out. Uncomment to test upgrades.
            'Layout' => array(__('Layout width', 'wp-3DgridFX-portfolio'), 'boxed width', 'full width'),
            'BoxedWidth' => array(__('Enter Boxed width size', 'wp-3DgridFX-portfolio')),
            'ItemsNumberXRow' => array(__('Enter in Items number each row', 'wp-3DgridFX-portfolio')),
        'CanSeeSubmitData' => array(__('Can See Submission data', 'wp-3DgridFX-portfolio'),
                                        'Administrator', 'Editor', 'Author', 'Contributor', 'Subscriber', 'Anyone'),
            'ThumbHeight' => array(__('choose image thumbnail height in percentage  in relation to width', 'wp-3DgridFX-portfolio'),
                                         '50', '60', '70', '80', '90','100', '120', '130', '140', '150','160', '170', '180', '190','200'),
			'RolloverColor' => array(__('Enter rollover color esadecimal', 'wp-3DgridFX-portfolio')),
            'RolloverTextColor' => array(__('Enter rollover Text color esadecimal', 'wp-3DgridFX-portfolio')),
        'BigImagewWidth' => array(__('Enter big image width', 'wp-3DgridFX-portfolio')),
        'BigImageHeight' => array(__('Enter big image height', 'wp-3DgridFX-portfolio')),
        '_version' => array('Installed Version'), // Leave this one commented-out. Uncomment to test upgrades.
        'DropOnUninstall' => array(__('Drop this plugin\'s Database table and options on uninstall', 'TEXT_DOMAIN'), 'false', 'true'),
             'RolloverEffect' => array(__('Choose the rollover Effect for portfolio Items', 'wp-3DgridFX-portfolio'),
                                        'fadin', 'vertical sliding', 'flip','flipY', 'horizontal sliding', 'expand', 'flash'),
            'Topdetailpanel' => array(__('Enter top coordinate in px for item detail panel', 'wp-3DgridFX-portfolio'))
        );
    }
    

    
public function updateSavedOption() {
         $this->updateOption('Layout','boxed width');
         $this->updateOption('BoxedWidth','1170');
         $this->updateOption('ItemsNumberXRow','5');
         $this->updateOption('ThumbHeight','50');
         $this->updateOption('RolloverColor','#FF00FF');
         $this->updateOption('RolloverTextColor','#FFFFFF');
         $this->updateOption('BigImagewWidth','500');
         $this->updateOption('BigImageHeight','500');
         $this->updateOption('RolloverEffect','flip');
         $this->updateOption('Topdetailpanel','0');
    }
    

    public function updateOption($optionName, $value) {
        $prefixedOptionName = $this->prefix($optionName); // how it is stored in DB
        return update_option($prefixedOptionName, $value);
    }
    protected function deleteSavedOptions() {
        $optionMetaData = $this->getOptionMetaData();
        if (is_array($optionMetaData)) {
            foreach ($optionMetaData as $aOptionKey => $aOptionMeta) {
                $prefixedOptionName = $this->prefix($aOptionKey); // how it is stored in DB
                delete_option($prefixedOptionName);
            }
        }
    }
    

    public function prefix($name) {
        $optionNamePrefix = $this->getOptionNamePrefix();
        if (strpos($name, $optionNamePrefix) === 0) { // 0 but not false
            return $name; // already prefixed
        }
        return $optionNamePrefix . $name;
    }
    
 public function getOptionNamePrefix() {
        return get_class($this) . '_';
    }
    
    public function addActionsAndFilters() {
    }

  
    
    public function installDatabaseTables() {
               
    	
    	$this->installDatabaseTables_port();
    	$this->installDatabaseTables_cat();
    }

   
    
    public function unInstallDatabaseTables() {
                global $wpdb;
                
    
          		$this->unInstallDatabaseTables_categories();
          		$this->unInstallDatabaseTables_portfolio();
                
    }
    
function installDatabaseTables_cat() {
   global $wpdb;
   global $jal_db_version;

   $table_name = $wpdb->prefix . "3DGridFX_categories";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {

      $sql = "CREATE TABLE " . $table_name . " (
	  idcategory bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  category text NOT NULL,
	  PRIMARY KEY  (idcategory)
	);";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

      add_option("jal_db_version", $jal_db_version);

   }
}
function installDatabaseTables_port() {
   global $wpdb;
   global $jal_db_version;

   $table_name = $wpdb->prefix . "3DGridFX_portfolio";
   if($wpdb->get_var("show tables like '$table_name'") != $table_name) {

      $sql = "CREATE TABLE " . $table_name . " (
   
	  				iditemportfolio bigint(20) unsigned NOT NULL AUTO_INCREMENT,
	  				idcategory text NULL DEFAULT NULL,
	  				title text NULL DEFAULT NULL,
	  				description longtext NULL DEFAULT NULL,
	  				work text NULL DEFAULT NULL,
	  				image text NULL DEFAULT NULL,
	  				client text NULL DEFAULT NULL,
	  				PRIMARY KEY  (iditemportfolio)
	);";

      require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
      dbDelta($sql);

      add_option("jal_db_version", $jal_db_version);

   }
}

    
    
    
public function unInstallDatabaseTables_categories() {
                global $wpdb;
              		$table_name = $wpdb->prefix . "3DGridFX_categories";
    				$sql = "DROP TABLE ". $table_name;
    				$wpdb->query($sql);    
    }

public function unInstallDatabaseTables_portfolio() {
                global $wpdb;
              		$table_name = $wpdb->prefix . "3DGridFX_portfolio";
    				$sql = "DROP TABLE ". $table_name;
    				$wpdb->query($sql);    
    }  

   
    
    protected function otherInstall() {
    }

   
    protected function otherUninstall() {
    }

   
    public function addSettingsSubMenuPage() {
        //$this->addSettingsSubMenuPageToPluginsMenu();
        $this->addSettingsSubMenuPageToSettingsMenu();
    }


    protected function requireExtraPluginFiles() {
        require_once(ABSPATH . 'wp-includes/pluggable.php');
        require_once(ABSPATH . 'wp-admin/includes/plugin.php');
    }

    
    protected function getSettingsSlug() {
        return get_class($this) . 'Settings';
    }

    protected function addSettingsSubMenuPageToPluginsMenu() {
        $this->requireExtraPluginFiles();
        $displayName = $this->getPluginDisplayName();
        add_submenu_page('plugins.php',
                         $displayName,
                         $displayName,
                         'manage_options',
                         $this->getSettingsSlug(),
                         array(&$this, 'settingsPage'));
    }


    protected function addSettingsSubMenuPageToSettingsMenu() {
        $this->requireExtraPluginFiles();
        $displayName = $this->getPluginDisplayName();
        add_options_page($displayName,
                         $displayName,
                         'manage_options',
                         $this->getSettingsSlug(),
                         array(&$this, 'settingsPage'));
    }

   
    public function prefixTableName($name) {
        global $wpdb;
        return $wpdb->prefix .  strtolower($this->prefix($name));
    }


   
    public function getAjaxUrl($actionName) {
        return admin_url('admin-ajax.php') . '?action=' . $actionName;
    }
    

}
