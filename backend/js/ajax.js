$(function() {
        $("#form_price .submit").click(function() {
    
    var products_id = $("#products_id").val();
    var products_price = $("#products_price").val();
    var date_start = $(".date_start").val();
    var date_end = $(".date_end").val();
    var dataString = 'products_id='+ products_id + '&products_price=' + products_price + '&date_start=' + date_start + '&date_end=' + date_end;

    if(products_id=='' || products_price=='' || date_start=='' || date_end=='')
{
    $('.success').fadeOut(200).hide();
    $('.error').fadeOut(200).show();
    }
    else
    {
    $.ajax({
    type: "POST",
    url: "../backend/products/productsprice.php",
    data: dataString,
    success: function(){
    $('.success').fadeIn(200).show();
    $('#products_price').fadeIn(200).val("");
    $('.date_start').fadeIn(200).val("");
    $('.date_end').fadeIn(200).val("");
    $('.error').fadeOut(200).hide();
    }
    });
    }
    return false;
    });
    });
    
/* Discount -Form*/
$(function() {
        $("#discount-price .submit").click(function() {
    
    var products_id = $("#products_id").val();
    var products_discountprice = $("#products_discountprice").val();
    var date_start = $(".discount_date_start").val();
    var date_end = $(".discount_date_end").val();
    var dataString = 'products_id='+ products_id + '&products_discountprice=' + products_discountprice + '&date_start=' + date_start + '&date_end=' + date_end;

    if(products_id=='' || products_discountprice=='' || date_start=='' || date_end=='')
{
    $('.success').fadeOut(200).hide();
    $('.error').fadeOut(200).show();
    }
    else
    {
    $.ajax({
    type: "POST",
    url: "../backend/products/products-discount.php",
    data: dataString,
    success: function(){
    $('.success').fadeIn(200).show();
    $('#products_discountprice').fadeIn(200).val("");
    $('.discount_date_start').fadeIn(200).val("");
    $('.discount_date_end').fadeIn(200).val("");
    $('.error').fadeOut(200).hide();
    }
    });
    }
    return false;
    });
    });

/*End*/
    
//date
$(function(){
           $('.date_start').datepicker({dateFormat: 'yy-mm-dd'});
           $('.date_end').datepicker({dateFormat: 'yy-mm-dd'});
           $('.discount_date_start').datepicker({dateFormat: 'yy-mm-dd'});
           $('.discount_date_end').datepicker({dateFormat: 'yy-mm-dd'});
           
        });
        
//delete


$(document).ready(function()
{
$(".edit_tr").click(function()
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
var last=$("#last_input_"+ID).val();
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

