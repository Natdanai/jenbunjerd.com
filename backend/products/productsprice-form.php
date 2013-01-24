<?php
/**
 *@author Mr. Anon
 * @version 2013 Form Add products Price 
 * 
 * 
*/
$text['success']="บันทึกข้อมูลเรียบร้อยค่ะ";
$text['error']="กรอกข้อมูลไม่ครบนะจ๊ะ ดูดีดี";
?>

<form id="form_price" name="price" method="post" action="">
<fieldset>
<label for="product_jb_no" id="products_jb_no">Products JB No.</label>
<input id="products_jb_no" name="products_jb_no" value="<?=$products_jb_no;?>" readonly=""  />

<!-- <label for="product_id" id="products_id_label">Producs_Id.</label> -->
<input id="products_id" name="products_id" value="<?=$products_id?>" hidden="" />

<label for="products_price" id="products_price_lable">Price.</label>
<input id="products_price" name="products_price" value="" class="numeric"  />

<label for="date_start" id="date_start_label">Date Start</label>
<input class="date_start" name="date_start" value="" />

<label for="date_end" id="date_end_label">Date End</label>
<input class="date_end" name="date_end" value="" />

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