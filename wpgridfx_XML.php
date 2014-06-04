<?php
require_once('../../../wp-load.php');
global $wpdb;
	
	
$table_name = $wpdb->prefix . "3DGridFX_portfolio";
$row = $wpdb->get_results( "SELECT * FROM $table_name");		

echo "<?xml version='1.0' encoding='UTF-8'?>";
echo "<portfolio>";
$i=0;
if($row ){
                               
                               		foreach ( $row as $row ){
                                		$i++;
                                		echo "<item>";
                                		echo "<idcategory>";
   								 		echo $row->idcategory;
   								 		echo "</idcategory>";
   								 		echo "<title>";
   								 		echo $row->title;
   								 		echo "</title>";
										echo "<description>";
   								 		echo $row->description;
   								 		echo "</description>";
   								 		echo "<work>";
   								 		echo $row->work;
   								 		echo "</work>";
   								 		echo "<urlpath>";
   								 		echo $row->image;
   								 		echo "</urlpath>";
   								 		echo "<client>";
   								 		echo $row->client;
   								 		echo "</client>";
   								 		echo "</item>";
   								 		
                                	}
                                
								
                                }
                                
echo "</portfolio>";