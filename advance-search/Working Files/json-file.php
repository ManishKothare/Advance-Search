<?php
session_start();

$hostNamewithslash='http://'.$_SERVER['HTTP_HOST'].'/';

/* Database Connection */
/** The name of the database */
define('DB_NAME', 'g7n5g4i3_mae2016');

/** MySQL database username */
define('DB_USER', 'g7n5g4i3_mae2016');

/** MySQL database password */
define('DB_PASSWORD', 'MAE@lum.net_$$');

/** MySQL hostname */
define('DB_HOST', 'localhost');

$mysqlConnection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if (!$mysqlConnection)
{
    printf("Connection failed.");
    exit();  
}
/* Database Connection End */

/* Below are the SEO functions to generate Product URL */
  function getSeoFriendlySFProductUrl($Itemid,$pname){
	$seo_friendly_prod_url = gen_seo_friendly_titles($pname);
	$seo_pro_url = $seo_friendly_prod_url."-p-".$Itemid.".html";
	return $seo_pro_url;
  }	
  function gen_seo_friendly_titles($title) {
 	$replace_what = array('  ', ' - ', ' ',    ', ', ',','/','(',')');
 	$replace_with = array(' ', '-', '-', ',', '-','','','');
 	$title = strtolower($title);
 	$title = str_replace($replace_what, $replace_with, $title);
  return $title;
  } 
  /* SEO functions End */

$return_arr = array();


$fetch = mysqli_query($mysqlConnection,"Select * from product_details where website_flag='Yes'"); 

while ($row = mysqli_fetch_array($fetch, MYSQL_ASSOC)) {
         
         $row_array['parent_cat_id'] = $row['parent_cat_id'];
	 $row_array['kw'] = $row['kw'];
         $row_array['hp'] = $row['hp'];
         $row_array['rpm'] = $row['rpm'];
         $row_array['Category'] = $row['category'];
         $row_array['Sub_Category'] = $row['sub_category'];
         $row_array['mae_item_id'] = $row['item_id'];
         $prd_name = $row['condition'] ." ". $row['brand'] ." ". $row['model'] ." ". $row['sub_category'];
         $row_array['ProdName'] = $prd_name;
         $seo_friendly_url = getSeoFriendlySFProductUrl($row['item_id'],$prd_name); 
         $row_array['Product_URL'] = $hostNamewithslash.$seo_friendly_url;
         $row_array['voltage'] = $row['voltage'];
         $row_array['price'] = $row['price'];
         $prd_image = 'http://mae2.lum.net/Images/listing-coming-soon.jpg';
         $row_array['Product_image_URL'] = $prd_image;
			        

    array_push($return_arr,$row_array);
}

$json=str_replace('\\/', '/', json_encode($return_arr,JSON_NUMERIC_CHECK));
echo $json;
?>