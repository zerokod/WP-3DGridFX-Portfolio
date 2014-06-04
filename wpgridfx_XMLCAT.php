<?php
require_once('../../../wp-load.php');
global $wpdb;
	
	
$table_name = $wpdb->prefix . "3DGridFX_categories";
$row = $wpdb->get_results( "SELECT * FROM $table_name");		

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<categories>";
$i=0;
if($row ){
                               
                               		foreach ( $row as $row ){
                                		$i++;
                                		echo "<item>";
                                		echo "<category>";
   								 		echo $row->category;
   								 		echo "</category>";
   								 		echo "</item>";
   								 		
                                	}
                                
								
                                }
                                
echo "</categories>";