<?php
session_start();

$hostNamewithslash='http://'.$_SERVER['HTTP_HOST'].'/';
include('../db.php');
include('../seofunctions.php');


$return_arr = array();

$fetch = mysql_query("SELECT p.*, pb.*,  pbt.*
FROM wpp_prod_bus_det pb, wpp_products p, wpp_prod_tech_det pbt
WHERE pb.id = p.buss_det_id AND pbt.id = p.tech_det_id AND p.product_status != '7' AND p.is_active=1"); 

while ($row = mysql_fetch_array($fetch, MYSQL_ASSOC)) {

			if(trim($row['is_active'])==1){
			    $isactive="True";
			}else{
			    $isactive="False";
			}

			if(trim($row['is_featured'])==1){
			    $is_featured="True";
			}else{
			    $is_featured="False";
			}



			$prod_ID_query="";
			$prod_ID_query=mysql_query("Select * from wpp_products where wpp_item_id = '".$row['wpp_item_id']."'");
			$prod_ID="";
			$prod_ID=mysql_fetch_assoc($prod_ID_query);
			$pr_ID="";
			$pr_ID=$prod_ID['id'];


			$subcatname="";
			$catname="";
			$subcatname=mysql_query("SELECT * FROM wpp_category WHERE id=".$row['category_id']."");
			$catname=mysql_fetch_assoc($subcatname);
			
			$cat_name="";
			$pname="";
			$cat_name=mysql_query("SELECT * FROM wpp_category WHERE id=".$catname['parent_id']."");
			$pname=mysql_fetch_assoc($cat_name);



			$prod_image="";
			$prod_image=mysql_query("Select * from wpp_prod_doc where product_id = '".$pr_ID."' and type = 'internalimage'  and  is_prime= '1' ");
                        $prd_img="";
			$prd_img=mysql_fetch_assoc($prod_image);
			$imagefullurl="";

			if($prd_img['document']!=""){    
			    $imagefullurl=$hostNamewithslash.'prodImages/prod'.$pr_ID.'/resized/'.trim($prd_img['document']).'';
			}else{
			    $imagefullurl="";
			}

			$price="";
			$advertise_price="";
			$price = $row['advertisedprice'];
			//$price = number_format($price,0);
			if ($price > 0){ 
				  $advertise_price = $price;
			}else{ 
				  $advertise_price = "Call for pricing"; 
			}


			/*$Product_URL="";
			$Product_image_URL="";
			$Product_URL = $hostNamewithslash."product.php?prodId=".trim($row['wpp_item_id'])."";*/


			$Product_URL="";
			$Product_URL=$hostNamewithslash.getSeoFriendlyProductUrl(trim($row['wpp_item_id']),trim($row['name']));
			
			



			/*if($prd_img['document']!=""){    
			    $Product_image_URL= $hostNamewithslash.'prodImages/prod'.$pr_ID.'/resized/'.trim($prd_img['document']).'';
			}else{
			    $Product_image_URL="";
			}*/



			      /*$row_array['mud_weight'] = $row['mud_weight'];*/
			      $row_array['rpm'] = $row['rpm'];
			      //$row_array['battery'] = $row['battery'];
			      $row_array['voltage'] = $row['voltage'];
			      /*$row_array['mud_rate_min'] = $row['mud_rate_min'];*/
			      $row_array['engine_sn'] = $row['engine_sn'];
			      /*$row_array['enclosure'] = $row['enclosure'];
			      $row_array['governor'] = $row['governor'];			     
			      $row_array['mud_rate_max'] = $row['mud_rate_max'];
			      $row_array['leads'] = $row['leads'];*/
			      $row_array['advertisedprice'] = trim($advertise_price);
			      /*$row_array['cooling_method'] = $row['cooling_method'];
			      $row_array['trans_dropbox'] = $row['trans_dropbox'];
			      $row_array['mud_stoke'] = $row['mud_stoke'];
			      $row_array['isactive'] =trim($isactive);*/
			      $row_array['other_information'] = $row['other_information'];
			      //$row_array['description'] = $row['description'];
			      /*$row_array['mud_piston-plunger_diameter_max'] = $row['mud_piston-plunger_diameter_max'];
			      $row_array['generator_model'] = $row['generator_model'];
			      $row_array['length'] = $row['length'];*/
			      $row_array['ratinginkva'] = $row['ratinginkva'];
			      /*$row_array['condition'] = $row['condition'];
			      $row_array['trailer_mounted'] = $row['trailer_mounted'];
			      $row_array['mud_weight'] = $row['mud_weight'];
			      $row_array['trans_housing'] = $row['trans_housing'];*/
			      $row_array['hp'] = $row['hp'];
			      /*$row_array['trans_hp_rating'] = $row['trans_hp_rating'];
			      $row_array['mud_pressure_min'] = $row['mud_pressure_min'];
			      $row_array['is_featured'] =trim($is_featured);
			      $row_array['width'] = $row['width'];*/
			      $row_array['wpp_item_id'] = $row['wpp_item_id'];
			      $row_array['SF_PK_WPP_Item_ID'] = $row['SF_PK_WPP_Item_ID'];
			      /*$row_array['weight'] = $row['weight'];
			      $row_array['remarks'] = $row['remarks'];
			      $row_array['trans_flywheel'] = $row['trans_flywheel'];
			      $row_array['remark_duel_fuel_system'] = $row['remark_duel_fuel_system'];*/
			      $row_array['hz'] = $row['hz'];
			      /*$row_array['trans_condition'] = $row['trans_condition'];
			      $row_array['trailer_mounted'] = $row['trailer_mounted'];
			      $row_array['hours'] = $row['hours'];
			      $row_array['mud_hp'] = $row['mud_hp'];
			      $row_array['Torque_Converter_Model'] = $row['Torque_Converter_Model'];
			      $row_array['mud_piston_load'] = $row['mud_piston_load'];
			      $row_array['trans_torque_rating'] = $row['trans_torque_rating'];
			      $row_array['catp_arrangment'] = $row['catp_arrangment'];
			      $row_array['starter'] = $row['starter'];
			      $row_array['mud_pump_model'] = $row['mud_pump_model'];
			      $row_array['engine_manufacturer'] = $row['engine_manufacturer'];
			      $row_array['trans_dimensions'] = $row['trans_dimensions'];
			      $row_array['power_factor'] = $row['power_factor'];
			      $row_array['battery_charger'] = $row['battery_charger'];
			      $row_array['trans_gear_ratio'] = $row['trans_gear_ratio'];
			      $row_array['trans_torque_conv_sn'] = $row['trans_torque_conv_sn'];
			      $row_array['generator_manufacturer'] = $row['generator_manufacturer'];
			      $row_array['trans_part'] = $row['trans_part'];
			      $row_array['generator_sn'] = $row['generator_sn'];*/
			      $row_array['name'] = $row['name'];
			      /*$row_array['height'] = $row['height'];
			      $row_array['trans_sn'] = $row['trans_sn'];
			      $row_array['trans_torque_conv_model'] = $row['trans_torque_conv_model'];
			      $row_array['engine_model'] = $row['engine_model'];*/
			      $row_array['ratinginkw'] = $row['ratinginkw'];
			      /*$row_array['engine_rpm'] = $row['engine_rpm'];
			      $row_array['motor_output_continuous_hp'] = $row['motor_output_continuous_hp'];
			      $row_array['phase'] = $row['phase'];*/
			      $row_array['Sub_Category'] = trim($catname['name']);
			      /*$row_array['breaker'] = $row['breaker'];*/
			      $row_array['sold_price'] = $row['sold_price'];
			      $row_array['grosscost'] = $row['grosscost'];
			      $row_array['wholesaleprice'] = $row['wholesaleprice'];
			      $row_array['Category'] = trim($pname['name']);
			      /*$row_array['trans_manufacturer'] = $row['trans_manufacturer'];
			      $row_array['descriptor_kw'] = $row['descriptor_kw'];
			      $row_array['type'] = $row['type'];*/
			      $row_array['Product_URL'] = $Product_URL;	
			      $row_array['Product_image_URL'] = trim($imagefullurl);   

    array_push($return_arr,$row_array);
}


$json=str_replace('\\/', '/', json_encode($return_arr,JSON_NUMERIC_CHECK));
echo $json;
?>