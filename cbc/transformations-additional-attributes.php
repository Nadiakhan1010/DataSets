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



require '../vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = IOFactory::load("Partner Product Feed -03-25-2022.xlsx");
$sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

$spreadsheet1 = IOFactory::load("export_catalog_product_20220323_093911.xlsx");
$sheetData1 = $spreadsheet1->getActiveSheet()->toArray(null, true, true, true);
$a=array();
$b=array();
$c=array();
$mrsp=array();
$names = array();
$qty = array();
$size = array();
$color = array();
$qty_in_box = array();
foreach($sheetData1 as $row){
	$b[$row['A']]= $row;
	
}
//print_r($b);
//exit;
foreach($sheetData as $row){
	$a[]=trim($row['A']);
	$names[$row['A']] = trim($row['B']);
	$row['G'] = str_replace(",","", trim($row['G']));
	$row['F'] = str_replace(",","", trim($row['F']));
	$c[$row['A']]= str_replace("$","", trim($row['G']));// min adv price
	$mrsp[$row['A']]= str_replace("$","", trim($row['F']));
	$qty[$row['A']]= str_replace("","", trim($row['J']));
	$size[$row['A']]= str_replace("","", trim($row['C']));
	$color[$row['A']]= str_replace("","", trim($row['E']));
	$qty_in_box[$row['A']]= str_replace("","", trim($row['D']));
}
//echo"<pre>";
//print_r($sheetData);
//echo"</pre>";
//exit();

foreach($b as $sku=>$row){
	if(!empty($row['A'])){
		//$old_emp_code = trim($row['A']);
		//$status = trim($row['G']);
		//$ecr_page = trim($row['P']);
		//print_r($b);
		//exit;
		if(in_array(trim($row['A']),$a)){
				
				// both data set have product
				if(empty($row['AU'])){
					// it has no additional attributes attached
					$attibute_string = "";
					if(!empty($size[$row['A']])){
						$attibute_string = "products_size=".$size[$row['A']];
					}
					if(!empty($qty_in_box[$row['A']])){
						if(!empty($attibute_string)){
							$attibute_string .= ",qty_in_box=".$qty_in_box[$row['A']];
						}else{
							$attibute_string = "qty_in_box=".$qty_in_box[$row['A']];
						}
					}
					outputCSV(array(
								array(
													   trim($sku), // sku
														   
														   $row['B'],
														   $row['C'],
														   $row['D'],
														   $row['E'],
														   $row['F'],
														   $row['G'],// name
														   $row['H'],
														   $row['I'],
														   $row['J'],
														   '2',//$row['K'], // disable products product_online
														   $row['L'],
														   $row['M'],
														   
														   $row['N'],//price
														   $row['O'],
														   $row['P'],
														   $row['Q'],
														   $row['R'],// url_key
														   $row['S'],// name
														   $row['T'], // meta_keywords
														   $row['U'], // name,
														   $row['V'],
														   $row['W'],
														   $row['X'],
														   $row['Y'],
														   $row['Z'],
														   $row['AA'], // 
														   $row['AB'],
														   $row['AC'],
														   $row['AD'],
														   $row['AE'],
														   $row['AF'],
														   $row['AG'],
														   
														   $row['AH'],
														   $row['AI'],
														   $row['AJ'], // msrp_price
														   $row['AK'],
														   $row['AL'],
														   $row['AM'],
														   $row['AN'],
														   $row['AO'],
														   $row['AP'],
														   $row['AQ'],
														   $row['AR'],
														   $row['AS'],
														   $row['AT'],
														   $attibute_string,
														   $row['AV'], // qty
														   $row['AW'], // mark it out of stock
														   $row['AX'],
														   $row['AY'],
														   $row['AZ'],
														   $row['BA'],
														   $row['BB'],
														   $row['BC'],
														   $row['BD'], // max_cart_qty
														   $row['BE'],
														   $row['BF'],
														   $row['BG'], // use_config_notify_stock_qty
														   $row['BH'],
														   $row['BI'],
														   $row['BJ'],
														   $row['BK'], // use_config_qty_increments
														   $row['BL'],
														   $row['BM'],
														   $row['BN'], // enable_qty_increments
														   $row['BO'],
														   $row['BP'], // website_id
														   $row['BQ'],
														   $row['BR'],
														   $row['BS'],
														   $row['BT'],
														   $row['BU'],
														   $row['BV'], // upsell_position
														   $row['BW'],
														   $row['BX'], // additional_image_labels
														   $row['BY'],
														   $row['BZ'],
														   $row['CA'],
														   $row['CB'],
														   $row['CC'],
														   $row['CD'],
														   $row['CE'],
														   $row['CF'],
														   $row['CG'],
														   $row['CH'],
														   $row['CI'],
														   $row['CJ'],
														   $row['CK'],
													   

								)));
				}
		}
			
				   

		
	}
}
exit;