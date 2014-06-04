<?php
require_once('../../../wp-load.php');
global $wpdb;
	
	
//if( isset($_POST['title']) && !empty($_POST['title']) && ($_POST['title'] != "") && ($_POST['modportfolioitem'] != "")){
		$iditemportfolio1 = $_POST['iditemportfolio'];
		$title1 = $_POST['title'];
			
			foreach ($_POST['idcategory'] as $names)
			{
				if(!$cat1){
					$cat1=$names;
				}else{
					$cat1=$cat1.",". $names;
				}
        		
			}
			$description1 = $_POST['description'];
			$work1 = $_POST['work'];
			$image_location1 = $_POST['image_location'];

			$table_name = $wpdb->prefix . "3DGridFX_portfolio";
			
			
			
            $wpdb->update($table_name, //Tabella
            array('title' => $title1,
            	'description' => $description1 ,
            	'work' => $work1,
            	'image' => $image_location1 ,
            	'idcategory' => $cat1
                 ), //Array dei contenuti
            array('iditemportfolio' => $iditemportfolio1) //Array delle condizioni WHERE
        );
			
			
			
			$msg="Success! New category added";
			echo $msg;
	//}