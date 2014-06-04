<?php
require_once('../../../wp-load.php');
global $wpdb;
	
	
		$table_name = $wpdb->prefix . "3DGridFX_categories";
		$wpdb->delete( $table_name, array( 'idcategory' => $_POST['idcategory'] ) );
		echo "item deleted";