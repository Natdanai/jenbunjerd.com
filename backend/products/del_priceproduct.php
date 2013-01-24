<?php
/**
 * @author Anon
 * @version 2013
 * 
  

*/
include ("../config.php");

$con = mysql_connect($dbhost,$dbuname,$dbpass);
if(!$con){
    die('No Connected Server'.mysql_error());
}
mysql_select_db($dbname,$con);

/*include "../config.php";

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
mysql_select_db("jb20-12-2012", $con); */

$pricelist_id = $_POST['id'];

if(isset($_POST['id'])){
    
    //$pricelist_id = $_POST['id'];
    
    $strSQL = "DELETE FROM jenbunjerd_productpricelist WHERE pricelist_id = $pricelist_id LIMIT 1";
    $result = mysql_query($strSQL);
    
    if(!$result){
        echo("Do not delete data in database");
    }
    
    
}





//$con = mysql_connect("$dbhost,$dbuname,$dbpass");
//if (!$con)
  //{
  //die('Could not connect: ' . mysql_error());
  //}
//
//mysql_select_db("jb20-12-2012", $con);

 ?>