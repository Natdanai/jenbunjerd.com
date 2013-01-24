<?php
/**
 * @author Anon
 * @version 2013
 * @category Discount Products Price List
 * 
 * 
 */
include ("../config.php");
$con =mysql_connect($dbhost,$dbuname,$dbpass);
if(!$con){
    die('No connect Database'.mysql_error());
}
mysql_select_db($dbname,$con);

/*$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("jb20-12-2012", $con); */

//$products_id=3884;
$products_id = $_GET['q'];
$pro_jb_no = $_GET['p'];
//echo("<p>Anon Dechpala aaa 1234</p>".$products_id);
//echo("GET = ".$pros_id);
//echo($products_id);
echo $pro_jb_nb;
$strSQL = ("SELECT * FROM jenbunjerd_productdiscount WHERE products_id =$products_id");
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

<? while($data = mysql_fetch_array($result)){ $id=$data['discountlist_id']; ?>
<? echo "date_end_id_".$id;?>
<tr id="<?php echo $id;?>" class="edit_tr">
<th scope="row" class="Spec"><?php echo "{$data['products_id']}"; ?></th>
<td><?php echo $jb_no2;?></td>

<td class="edit_td"><?php echo number_format("{$data['products_discountprice']}",2);?></td>

<td class="edit_td">
<span id="<?echo "date_start_id_".$id;?>" class="text"><?php echo "{$data['date_start']}";?></span>
<!--  input class="editbox" type="text" id="<? echo "input_date_start_id_".$id; ?>" value="<?php echo "{$data['date_start']}";?>" /> -->
</td>
<td class="edit_td">
<span id="date_end_id_<?php echo $id;?>" class="text"> <?php echo "{$data['date_end']}";?></span>
<!-- <input type="text" id="input_date_end_id_<?php echo $id;?>" value="<?php echo $data['date_end'];?> " class="editbox" /> -->
</td>
<td><a href="#" id="<?echo "{$data['discountlist_id']}";?>" class="edit_button">Edit</a></td>
<td class="del"><a href="#" id="<?echo "{$data['discountlist_id']}";?>" class="delete_button"><img src="../backend/images/trash.png" width="16" height="16" alt="Delete" /> </a></td>
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
   url: "../backend/products/del_discountproducts.php",
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
<!-- <script type="text/javascript">
$(document).ready(function()
{
$(".edit_button").click(function()
{
var ID=$(this).attr('id');
$("#date_start_id_"+ID).hide();
$("#date_end_id_"+ID).hide();
$("#input_date_start_id_"+ID).show();
$("#input_date_end_id_"+ID).show();
}).change(function()
{
var ID=$(this).attr('id');
var first=$("#input_date_start_id_"+ID).val();
var last=$("#input_date_end_id_"+ID).val();
var dataString = 'id='+ ID +'&firstname='+first+'&lastname='+last;
$("#date_start_id_"+ID).html('<img src="load.gif" />'); // Loading image

if(first.length>0&& last.length>0)
{

$.ajax({
type: "POST",
url: "table_edit_ajax.php",
data: dataString,
cache: false,
success: function(html)
{
$("#date_start_id_"+ID).html(first);
$("#date_end_id_"+ID).html(last);
}
});
}
else
{
alert('Enter something.');
}

});

// Edit input box click action
$(".editbox").mouseup(function() 
{
return false
});

// Outside click action
$(document).mouseup(function()
{
$(".editbox").hide();
$(".text").show();
});

});
</script> -->
<!-- -->
</table>
<!-- Update -->

<!-- End -->

<?
function getProducts_jb_no($products_id){
    
    $strSQL = ("SELECT products_jb_no FROM jenbunjerd_products WHERE products_id =".$products_id);
    $result =mysql_query($strSQL);
    while($data2 = mysql_fetch_array($result)){
        $jb_no = $data2['products_jb_no'];
    }
    return $jb_no;
}


