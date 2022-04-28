<?php
function outputCSV($data) {
    $output = fopen("php://output", "w");
    foreach ($data as $row) {
        fputcsv($output, $row); // here you can change delimiter/enclosure
    }
    fclose($output);
}
function prints($i){
	print " * $i  ";
	if($i>1){
		
		prints($i/2);
		prints($i/2);
		prints($i/2);
		prints($i/2);
	}
}
//prints(3);
//exit;
//print_r(get_stage_scale(2544,$db));
//exit;
header("Content-Type: text/csv");
header("Content-Disposition: attachment; filename=transformation-status.csv");
// Disable caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies



require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = IOFactory::load("Partner Product Feed - 04-27-2022.xlsx");
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$spreadsheet1 = IOFactory::load("export_catalog_product_20220427_181131.xlsx");
$sheetData1 = $spreadsheet1->getActiveSheet()->toArray(null, true, true, true);
$a=array();
$b=array();
$c=array();
$mrsp=array();
$names = array();
$qty = array();
$instock = array();
foreach($sheetData as $row){
	$a[]=trim($row['A']);
	$names[$row['A']] = trim($row['B']);
	$row['G'] = str_replace(",","", trim($row['G']));
	$row['F'] = str_replace(",","", trim($row['F']));
	$c[$row['A']]= str_replace("$","", trim($row['G']));// min adv price
	$mrsp[$row['A']]= str_replace("$","", trim($row['F']));
	$qty[$row['A']]= str_replace("","", trim($row['J']));
	if($row['J'] > 0){
		$instock[$row['A']] = 0;
	} else{
		$instock[$row['A']] = 1;
	}
}
foreach($sheetData1 as $row){
	
	$b[$row['A']]= $row['A'];
	//str_replace("$","", trim($row['G']));
	
	//
	
}
//echo"<pre>";
//print_r($sheetData);
//echo"</pre>";
//exit();
outputCSV(array(
													   array(
														   'sku',
														   'store_view_code',
														   'attribute_set_code',
														   'product_type',
														   'categories',
														   'product_websites',
														   'name',
														   'description',
														   'short_description',
														   'weight',
														   'product_online',
														   'tax_class_name',
														   'visibility',
														   'price',
														   'special_price',
														   'special_price_from_date',
														   'special_price_to_date',
														   'url_key',
														   'meta_title',
														   'meta_keywords',
														   'meta_description',
														   'base_image',
														   'base_image_label',
														   'small_image',
														   'small_image_label',
														   'thumbnail_image',
														   'thumbnail_image_label',
														   'swatch_image',
														   'swatch_image_label',
														   'created_at',
														   'updated_at',
														   'new_from_date',
														   'new_to_date',
														   'display_product_options_in',
														   'map_price',
														   'msrp_price',
														   'map_enabled',
														   'gift_message_available',
														   'custom_design',
														   'custom_design_from',
														   'custom_design_to',
														   'custom_layout_update',
														   'page_layout',
														   'product_options_container',
														   'msrp_display_actual_price_type',
														   'country_of_manufacture',
														   'additional_attributes',
														   'qty',
														   'out_of_stock_qty',
														   'use_config_min_qty',
														   'is_qty_decimal',
														   'allow_backorders',
														   'use_config_backorders',
														   'min_cart_qty',
														   'use_config_min_sale_qty',
														   'max_cart_qty',
														   'use_config_max_sale_qty',
														   'is_in_stock',
														   'notify_on_stock_below',
														   'use_config_notify_stock_qty',
														   'manage_stock',
														   'use_config_manage_stock',
														   'use_config_qty_increments',
														   'qty_increments',
														   'use_config_enable_qty_inc',
														   'enable_qty_increments',
														   'is_decimal_divided',
														   'website_id',
														   'deferred_stock_update',
														   'use_config_deferred_stock_update',
														   'related_skus',
														   'crosssell_skus',
														   'upsell_skus',
														   'hide_from_product_page',
														   'custom_options',
														   
														   'bundle_price_type',
														   'bundle_sku_type',
														   'bundle_price_view',
														   
														   'bundle_weight_type',
														   'bundle_values',
														   'bundle_shipment_type',
														   'associated_skus',
														   
														   'downloadable_links',
														   'downloadable_samples',
														   'configurable_variations',
														   'configurable_variation_labels',
														   
						)));
foreach($a as $sku){
	
		//$old_emp_code = trim($row['A']);
		//$status = trim($row['G']);
		//$ecr_page = trim($row['P']);
		
		
				if(!array_key_exists($sku,$b)){
				$url=str_replace(" ","-", trim($names[$sku]));
				$url=str_replace("'","", $url);	
				$url=str_replace("&","", $url);
				$url=str_replace("/","", $url)."-".$sku;			
				outputCSV(array(
													   array(
														   trim($sku), // sku
														   '',//store_view_code
														   'Default',
														   'simple',
														   'Default Category/CIGARS,Default Category/CIGARS/CIGARS,Default Category/CIGARS/CIGARS/List of Cigars',
														   'base',
														   $names[$sku],// name
														   '<p></p>',
														   '',
														   '2', // weight
														   '1',
														   'State Mandated Fee',
														   'Catalog, Search',
														   $c[$sku],//price
														   '',
														   '',
														   '',
														   $url,// url_key
														   $names[$sku],// name
														   $names[$sku], // meta_keywords
														   $names[$sku], // name,
														   '',
														   '',
														   '',
														   '',
														   '',
														   '', // 
														   '',
														   '',
														   date("Y-m-d h:i:s A"),
														   date("Y-m-d h:i:s A"),
														   
														   '',
														   '',
														   'Block after Info Column',
														   '',
														   $mrsp[$sku], // msrp_price
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '', // product_options_container
														   'Use config',
														   '',
														   '',// additional_attributes
														   $qty[$sku], // qty
														   $instock[$sku],
														   '1',
														   '0',
														   '0',
														   '1',
														   '1',
														   '0',
														   '0', // max_cart_qty
														   '1',
														   '0',
														   '1', // use_config_notify_stock_qty
														   '',
														   '0',
														   '1',
														   '1', // use_config_qty_increments
														   '0',
														   '1',
														   '0', // enable_qty_increments
														   '0',
														   '0', // website_id
														   '',
														   '',
														   '',
														   '',
														   '',
														   '', // upsell_position
														   '',
														   '', // additional_image_labels
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '',
														   '', // configurable_variation_labels
														   

						)));
				}else{
					/*
					outputCSV(array(
													   array(
														   trim($sku), // sku
														   0,//store_view_code
														   0,
														   0
														   

						)));
					*/
				}
			
			
}
exit;