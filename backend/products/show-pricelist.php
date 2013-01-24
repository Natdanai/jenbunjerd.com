<?php
include ("../config.php");
$con = mysql_connect($dbhost,$dbuname,$dbpass);
if(!$con){
    die('No Connected Database');
}
mysql_select_db($dbname, $con);

/* $con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  } */

//mysql_select_db("jb20-12-2012", $con);

//$products_id=3884;
$products_id = $_GET['q'];
$pro_jb_no = $_GET['p'];
//echo("<p>Anon Dechpala aaa 1234</p>".$products_id);
//echo("GET = ".$pros_id);
//echo($products_id);
echo $pro_jb_nb;
$strSQL = ("SELECT * FROM jenbunjerd_productpricelist WHERE products_id =$products_id");
//echo($strSQL);

$jb_no2 = getProducts_jb_no($products_id);
echo $jb_no;
$result =mysql_query($strSQL);
if(!$result){
    echo("Query No").mysql_error();
}
?>
<!--<h3>Price List</h3> -->
<table id="product-pricelist">
<tr>
<th scope="col">Products id</th>
<th scope="col">Products JB No.</th>
<th scope="col">Price.</th>
<th scope="col">Start Date</th>
<th scope="col">End Date</th>

</tr>

<? while($data = mysql_fetch_array($result)){ ?>
<tr>
<th scope="row" class="Spec"><?php echo "{$data['products_id']}"; ?></th>
<td><?php echo $jb_no2;?></td>
<td><?php echo number_format("{$data['products_price']}",2);?></td>
<td><?php echo "{$data['date_start']}";?></td>
<td><?php echo "{$data['date_end']}";?></td>
<td><a href="#" id="<?echo "{$data['pricelist_id']}";?>" class="edit_button">Edit</a></td>
<td class="del"><a href="#" id="<?echo "{$data['pricelist_id']}";?>" class="delete_button"><img src="../backend/images/trash.png" width="16" height="16" alt="Delete" /> </a></td>
</tr>
 <?}
?>
<!-- -->
<script type="text/javascript">
$(function() {
$(".delete_button").click(function() {
var id = $(this).attr("id");
var dataString = 'id='+ id ;
var parent = $(this).parent();
	
$.ajax({
   type: "POST",
   url: "../backend/products/del_priceproduct.php",
   data: dataString,
   cache: false,

   success: function()
   {
    if(id % 2)
	{
    parent.fadeOut('slow', function() {$(this).remove();});
	}
	else
	{
	parent.slideUp('slow', function() {$(this).remove();});
	}
  }
   
 });

return false;
	});
});


</script>

<!-- -->
</table>

<?
function getProducts_jb_no($products_id){
    
    $strSQL = ("SELECT products_jb_no FROM jenbunjerd_products WHERE products_id =".$products_id);
    $result =mysql_query($strSQL);
    while($data2 = mysql_fetch_array($result)){
        $jb_no = $data2['products_jb_no'];
    }
    return $jb_no;
}

