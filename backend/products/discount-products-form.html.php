<?php

/**
 * @author Anon D
 * @copyright 2013
 * @category Discount Products
 * @version V1. 14/01/2013
 */


?>
<!-- <!DOCTYPE HTML>
<html>
<head>
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="Boomer" />
    <link rel="stylesheet" href="../css/productspricelist.css" />

	<title>Untitled 2</title>
</head>

<body> -->


<br />
<form id="discount-price" name="discount-price" method="post" action="">
<fieldset>
<label for="product_jb_no" id="products_jb_no">Products JB No.</label>
<input id="products_jb_no" name="products_jb_no" value="<?=$products_jb_no;?>" readonly=""  />

<!-- <label for="product_id" id="products_id_label">Producs_Id.</label> -->
<input id="products_id" name="products_id" value="<?=$products_id?>" hidden="" />

<label for="products_price" id="products_price_lable">Price.</label>
<input id="products_discountprice" name="products_discountprice" value="" class="numeric"  />

<label for="date_start" id="date_start_label">Date Start</label>
<input class="discount_date_start" name="date_start" value="" />

<label for="date_end" id="date_end_label">Date End</label>
<input class="discount_date_end" name="date_end" value="" />

<div >
<input type="submit" value="Submit" class="submit"/>
<span class="error" style="display:none"> "กรอกข้อมูลไม่ครบ นะจ๊ะ ดูดีๆ"</span>
<span class="success" style="display:none">"บันทึกข้อมูลเรียบร้อยค่ะ"</span>
</div>
</fieldset>
</form>

<script type="text/javascript">
	$(".numeric").numeric();
	$(".integer").numeric(false, function() { alert("Integers only"); this.value = ""; this.focus(); });
	$(".positive").numeric({ negative: false }, function() { alert("No negative values"); this.value = ""; this.focus(); });
	$(".positive-integer").numeric({ decimal: false, negative: false }, function() { alert("Positive integers only"); this.value = ""; this.focus(); });
	$("#remove").click(
		function(e)
		{
			e.preventDefault();
			$(".numeric,.integer,.positive").removeNumeric();
		}
	);
</script>

<!-- </body>
</html> -->