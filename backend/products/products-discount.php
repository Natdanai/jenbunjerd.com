<?php
/**
 * @author Anon D
 * @copyright 2013
 * @category Discount Products
 * @version V1. 14/01/2013
 */
include ("../config.php");

$con = mysql_connect($dbhost,$dbuname,$dbpass);
if(!$con){
    die('No Connected Server'.mysql_error());
}
mysql_select_db($dbname,$con);
/*include ("config.php");


$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("jb20-12-2012", $con); */

if ((isset($_POST['products_id'])) && (strlen(trim($_POST['products_id'])) > 0)) {
	$products_id = stripslashes(strip_tags($_POST['products_id']));
} else {$products_id = 'No Products_ID entered';}
if ((isset($_POST['products_discountprice'])) && (strlen(trim($_POST['products_discountprice'])) > 0)) {
	$products_discountprice = stripslashes(strip_tags($_POST['products_discountprice']));
} else {$products_discountprice = 'No Products_price entered';}
if ((isset($_POST['date_start'])) && (strlen(trim($_POST['date_start'])) > 0)) {
	$date_start = stripslashes(strip_tags($_POST['date_start']));
} else {$date_start = 'No date_start entered';}
if((isset($_POST['date_end'])) && (strlen(trim($_POST['date_end'])) > 0 )){
  $date_end = stripslashes(strip_tags($_POST['date_end'])); 
} else {$date_end ='0';}

//$strSQL = "INSERT INTO jenbunjerd_productdiscount (`discountlist_id`, `products_id`, `quantity`,'products_discountprice', `date_start`, `date_end`) VALUES (NULL, '$products_id','1', '$products_discountprice', DATE('$date_start'), DATE('$date_end'))";

$strSQL = "INSERT INTO jenbunjerd_productdiscount (`discountlist_id`, `products_id`, `quantity`, `products_discountprice`, `date_start`, `date_end`) VALUES (NULL, '$products_id', '1', '$products_discountprice', DATE('$date_start'), DATE('$date_end'))";
//$result = mysql_query($strSQL);
$result = mysql_query($strSQL);
if($result){
echo "Successful";
echo "<BR>";
echo "";
}

else {
echo "ERROR";
}


/*if (!mysql_query($strSQL,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added"; */

mysql_close($con);
?>
