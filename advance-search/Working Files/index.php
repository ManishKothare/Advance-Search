<?php include('header.php'); ?>
<?php      

  // Bootstrap file for setting the ABSPATH constant loading the wp-config.php file.
  require("../wp-load.php");  

  $id = $_GET['id'];  // Category ID  
  $sortby = $_GET['sortby']; // Sort Vlaue 
   
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
  
  if(!empty($id)){
    // Get SEO data from category table
    $catqry = $wpdb->get_results("Select * from category_details where id='".$id."'  ORDER BY id ASC");
    foreach($catqry as $catrow){
      $parent_id = $catrow->parent_id; // Parent ID
      $page_title = $catrow->plural_page_title;
      $content = $catrow->content;
      $seo_page_title = $catrow->seo_page_title;
      $seo_meta = $catrow->seo_meta;
      $seo_keywords = $catrow->seo_keywords;
      $seo_description = $catrow->seo_description;
    }
  }
?>
<!-- Meta Tags -->
<title><?php echo $seo_page_title;?></title>
<meta name="description" content="<?php echo $seo_description; ?>" />
<meta name="keywords" content="<?php echo $seo_keywords; ?>" />
<!-- End Meta Tags -->

  <!-- Angular Js -->
      <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular.min.js" type="text/javascript"></script>
      <script src="controllers.js" type="text/javascript"></script>
  <!-- Angular Js -->

</head>
<body class="fusion-body no-tablet-sticky-header no-mobile-sticky-header no-mobile-slidingbar mobile-logo-pos-left layout-wide-mode menu-text-align-left fusion-woo-product-design-classic mobile-menu-design-modern fusion-image-hovers fusion-show-pagination-text" ng-controller="MAEListCtrl">
<div id="wrapper" class="">
	<div id="home" style="position:relative;top:1px;"></div>
</div>
<!-- MENU -->
<div id="home" style="position:relative;top:1px;"></div>
		<?php if ( Avada()->settings->get( 'slidingbar_widgets' ) && ! is_page_template( 'blank.php' ) && ! $boxed_side_header_right ) : ?>
			<?php get_template_part( 'slidingbar' ); ?>
		<?php endif; ?>
		<?php if ( false !== strpos( Avada()->settings->get( 'footer_special_effects' ), 'footer_sticky' ) ) : ?>
			<div class="above-footer-wrapper">
		<?php endif; ?>

		<?php avada_header_template( 'Below' ); ?>
		<?php if ( 'Left' == Avada()->settings->get( 'header_position' ) || 'Right' == Avada()->settings->get( 'header_position' ) ) : ?>
			<?php avada_side_header(); ?>
		<?php endif; ?>	
<!-- End MENU  -->	

<!-- Title and Breadcrumbs -->
<div id="sliders-container"></div>
<div class="fusion-page-title-bar fusion-page-title-bar-breadcrumbs fusion-page-title-bar-left">
	<div class="fusion-page-title-row">
		<div class="fusion-page-title-wrapper">
			<div class="fusion-page-title-captions">
				<h1 class="entry-title" data-fontsize="18" data-lineheight="26"><?php echo $page_title;?></h1>				
			</div>
			<div class="fusion-page-title-secondary">
			<div class="fusion-breadcrumbs"><span itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="http://mae2.lum.net/"><span itemprop="title">Home</span></a></span><span class="fusion-breadcrumb-sep">/</span><span class="breadcrumb-leaf"><?php echo $page_title;?></span></div></div>						    
		</div>
	</div>
</div>		
<!-- End Title and Breadcrumbs -->

<div id="main" class="clearfix " style="">
	<div class="fusion-row" style="">	
<!-- Right side content starts from here -->
<div id="content" style="float: right;">
<div id="post" class="post page type-page status-publish hentry">

<!-- Page content description -->
<div class="post-content">
  <?php echo $content;?>
  <p></p>
</div>
<!-- Page content description End -->

<div class="post-content">
<div class="woocommerce columns-3">
<ul class="products clearfix products-3">

<li class="post-6078 product type-product status-publish has-post-thumbnail product_cat-clothes product_cat-t-shirts product_tag-outdoors product_tag-sport first instock featured shipping-taxable purchasable product-type-simple"  style="height: 350px;" ng-repeat="product in products | filter:query:false | filter:{Category:Category} | filter:{Sub_Category:Sub_Category} | filter:{hz:hz} | filter:{voltage:voltage} | filter:{rpm:rpm} | filter:{mae_item_id:mae_item_id} | filter:horsepowerFilter | filter:kvaFilter | filter:kwFilter | filter:rpmFilter"> <a href="{{product.Product_URL}}" class="product-images"> <span><img style="height: 189px;" src="{{product.Product_image_URL}}" alt=""><span class="cart-loading"><i class="fusion-icon-spinner"></i></span></span> </a><div class="product-details"><div class="product-details-container"><h3 class="product-title" data-fontsize="17" data-lineheight="23"><a href="{{product.Product_URL}}">{{product.ProdName}}</a></h3><div class="clearfix"><span class="price">${{product.price}}</span><span class="rating">{{product.hp}} hp</span></div></div></div><div class="product-buttons"><div class="product-buttons-container clearfix"><a href="{{product.Product_URL}}" class="show_details_button">Details</a></div></div></li>

</ul></div></div>
</div></div>
<!-- Right side content End here -->

<!-- Left sidebar content starts from here -->
<div id="sidebar" class="sidebar fusion-widget-area fusion-content-widget-area side-nav-left" style="float: left;">
<ul id="toggler" class="side-nav">
                                    <li>
                                       <span style="float: right;margin-top: 7px;"></span>
                                       <h3 class="widget-title header-main" style="margin-left: -15px;border-bottom: 0px;">Advanced Search</h3>
                                       <div style="border-top: 1px solid #CCC;margin-left: -15px;margin-bottom:5px;">
                                          <form method='post' style="margin-left:-7px;margin-top: 7px;margin-bottom:0px;"  id='gform_1'  >
                                             <div class='gform_heading'>
                                                <span class='gform_description'></span>
                                             </div>
                                             <div class='gform_body'>
                                                <ul id='gform_fields_1' class='gform_fields top_label description_below'>
                                                   <li id='field_1_15_category' class='gfield' >
                                                      <div class='ginput_container'>
                                                         <select name='category' id='category'  class='medium gfield_select' tabindex='14' ng-model="Category">
                                                            <option value='' >-- Category --</option>
                                                            <option value="Generator Set">Generator Set</option>
                                                            <option value="Engine"> Engine</option>
                                                            <option value="Parts and Accessories">Parts and Accessories</option>
                                                         </select>
                                                      </div>
                                                   </li>
                                                   <li id='field_1_15_fuel_type' class='gfield' >
                                                      <div class='ginput_container'>
                                                         <select name='type' id='type'  class='medium gfield_select' tabindex='14' ng-model="Sub_Category">
                                                            <option value='' >-- Sub Category --</option>
                                                            <option value="Diesel Generator">Diesel Generator</option>
                                                            <option value="Natural Gas Generator">Natural Gas Generator</option>
                                                            <option value="Generator Ends">Generator Ends</option>
                                                            <option value="Gas Engine">Gas Engine</option>
                                                            <option value="Diesel Engine">Diesel Engine</option>
                                                            <option value="Radiator">Radiator</option>
                                                            <option value="Transmission">Transmission</option>                                                            
                                                         </select>
                                                      </div>
                                                   </li>
                                                                                                  
                                                   <li id='field_1_15_low_kw' class='gfield' >
                                                      <strong>Enter kW</strong>
                                                      <div class='ginput_container'>
                                                         <input type="text" name='lowkw' id='lowkw'  class='medium'  ng-model="minkw" placeholder="Low kW" />                                                            
                                                      </div>
                                                   </li>
                                                   <li id='field_1_15_highkw' class='gfield' >
                                                      <div class='ginput_container'>
                                                         <input type="text" name='highkw' id='highkw'  class='medium'  ng-model="maxkw" placeholder="High kW" />                                                            
                                                      </div>
                                                   </li>
                                                   
                                                   <li id='field_1_15_lowhp' class='gfield' >
                                                      <strong>Enter Hp</strong>
                                                      <div class='ginput_container'>
                                                         <input type="text" name='lowhp' id='lowhp'  class='medium'  ng-model="minHorsepower" placeholder="Low hp" />                                                            
                                                      </div>
                                                   </li>
                                                   <li id='field_1_15_highhp' class='gfield' >
                                                      <div class='ginput_container'>
                                                         <input type="text" name='highhp' id='highhp'  class='medium'  ng-model="maxHorsepower" placeholder="High hp" />                                                            
                                                      </div>
                                                   </li>  

                                                   <li id='field_1_25_keyword' class='gfield' >
                                                      <strong>Enter Keyword</strong>
                                                      <div class='ginput_container'><input ng-model="query" id='product_keyword' type='text'   class='medium'  tabindex='24' ></div>
                                                   </li>
                                                   <li id='field_1_25_item' class='gfield' >
                                                      <strong>Enter WPP Item ID</strong>
                                                      <div class='ginput_container'><input name='product_item' id='product_item' type='text'   class='medium'  tabindex='24'   ng-model="mae_item_id" /></div>
                                                   </li>
                                                </ul>
                                                <div style="clear:both"></div>
                                             </div>
                                          </form>
                                       </div>
                                       <div style="clear:both"></div>
                                    </li>
                                 </ul>
</div>
<!-- Left sidebar content End here -->

  </div>  <!-- fusion-row -->
</div>  <!-- #main -->
<?php include('footer.php'); ?>
