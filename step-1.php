<? session_start();
$o_id = $_SESSION['o_id']; 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/clsFont.css" type="text/css" media="screen" />
<? include "set_title.php"; ?>
<title><? echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language="javascript" src="js/win_func.js"></script>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function CheckAmo(thisObj,lastvalue){
			if (thisObj.value == '0' || thisObj.value == '')
			{
				alert('Amount equal Zero..!!');
				thisObj.value = lastvalue;
				return false;
			}
	}
//-->
</SCRIPT>
</head>
<body>
<div><? include "header.php"; ?></div>
<div class='Div_Content'>
	<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr valign="top">
		<td width="244">
		<table width="244" height="100%" border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td width="244" valign="top"><? include "left.php"; ?></td>
		  </tr>
		</table>
		</td>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><? include("banner.php");?></td>
		  </tr>
		</table>
		<!-- Start -->
     <table id="Table_01" width="730" border="0" cellpadding="0" cellspacing="0" align="left">
        <tr>
          <td colspan="8" background="images/1your-basket_01.jpg">&nbsp;</td>
          <td width="1"><img src="images/spacer.gif" width="1" height="23" alt=""></td>
        </tr>
        <tr>
          <td width="21"><img src="images/1your-basket_02.jpg"></td>
          <td width="92"><img src="images/1your-basket_03.jpg"></td>
          <td width="85"><img src="images/1your-basket_04.jpg"></td>
          <td width="85"><img src="images/1your-basket_05.jpg"></td>
          <td width="86"><img src="images/1your-basket_06.jpg"></td>
          <td width="114"><img src="images/1your-basket_07.jpg"></td>
          <td width="97"><img src="images/1your-basket_08.jpg"></td>
          <td width=""><img src="images/1your-basket_09.jpg"></td>
        </tr>
		<tr>
			<td width="21"></td>
			<td colspan="7">
				<table cellspacing='1' cellpadding='0' border='0'  width='98%' bgcolor="#CCCCCC">
				<tr>
				<td bgcolor="#FFFFFF">
				<BR>
			<TABLE cellspacing='0' cellpadding='0' border='0' bgcolor='#FFFFFF' width='680' align="center" >
					<TR>
						<TD valign='top' >				<!-- View Item -->		
	
					 <?
					$order_sql = sql_Select(1, $prefix."_order", "order_id = '$o_id'", 0);
					//echo  $order_sql ;
					$order_query = $db->sql_query($order_sql);
					$order = $db->sql_fetchrow($order_query);
					
					$totalrec = $db->sql_numrows($list_query);							

					$grantotal =0;  // จำนวนของสินค้าทั้งหมด
					$totaldis = 0;
					?>
						  <table cellspacing='0' cellpadding='2' border='0'  width='100%' bgcolor="#D3A219">
							  <tr align="center" height="12" bgcolor="#D3A219"> 
								<td width='230' colspan="4"></td>
							  </tr>
							  <tr align="center" height="2" bgcolor="#FFFFFF"> 
								<td width='230' colspan="4"></td>
							  </tr>
						</table>
						  <table cellspacing='1' cellpadding='0' border='0'  width='100%' bgcolor="#D3A219">
							  <tr align="center" height="35"> 
							  <td width="30"></td>
								<td width='400'><b><span class="fnormal">สินค้า</span></b></td>
								<td width='100'><b><span class="fnormal">ราคา/หน่วย</span></b></td>
								<td width='100'><b><span class="fnormal">จำนวน</span></b></td>
								<td width='100'><b><span class="fnormal">รวมเงิน</span></b></td>
							  </tr>
						  <?

							$cart_sql = sql_Select(1, $prefix."_order_b", "order_id = '$o_id'", 0);
							//echo  $cart_sql ;
							$cart_query = $db->sql_query($cart_sql);										
							$total_item = $db->sql_numrows($cart_query);
							
							if ($total_item > 0 ){
							while ( $cart = $db->sql_fetchrow($cart_query))
								{
									$orderb_id=$cart['orderb_id'];
									$order_id=$cart['order_id'];
									$products_id=$cart['products_id'];
									//$price=$cart['price'];
                                    $price = cartPrice($products_id);
									$amount=$cart['amount'];
									//$discountprice=$cart['discountprice'];
                                    $discountprice = getDiscountPrice($products_id);
									$discount_percent_baht=$cart['discount_percent_baht'];
									$discount_percent=$cart['discount_percent'];

									$products_sale = $price;

									$total=$amount*$products_sale;
									$grantotal=$grantotal+$total;
									$totaldis = $totaldis + ($discountprice)*$amount;
									$total_percent_baht = $total_percent_baht + ($discount_percent_baht)*$amount;
									
									$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$products_id'", 0);
									//echo  $detail_sql ;
									$detail_query = $db->sql_query($detail_sql);
									$result = $db->sql_fetchrow($detail_query);			

									$products_id=$result['products_id'];
									$products_name=stripslashes($result['products_name']);
									$products_model=stripslashes($result['products_model']);
									$products_jb_no=stripslashes($result['products_jb_no']);
									$products_price=stripslashes($result['products_price']);
									$products_discountprice=stripslashes($result['products_discountprice']);
									$products_description=$result['products_description'];
									$products_description = str_replace("\n","<br>",$products_description);		
									$products_mainpic=$result['products_mainpic'];
									$products_status=$result['products_status'];
									$categories_id=$result['categories_id'];
									$parent_cat = getn("categories_parent","categories ","categories_id='$categories_id'");

									if (file_exists("$productspath/$products_mainpic")){
									$widthsize=getimagesize("$productspath/$products_mainpic"); 
									$old_w=$widthsize[0]; 
									$old_h=$widthsize[1]; 		

									//echo "$widthsize[0],$widthsize[1]";
									
									if( $widthsize[1] >= 100 )  {
											// $p_ ย่อลงเท่าไหร่
											$p_ = (100/$widthsize[1]);
											$w = $widthsize[0]*$p_;
											$h = 100;

											if ( $w > 100){
											// $p_ ย่อลงเท่าไหร
											$p_ = (100/$widthsize[0]);
											$w = $widthsize[0]*$p_;
											$h = 100;
											}
										}
										else{
											// $p_ ขยายขึ้น
											$p_ = (100/$widthsize[1]);
											$w = $widthsize[0]*$p_;
											$h = 100;
										}
									/*$w = 575;
									$h = 300;*/
									$pic = "$productspath/$products_mainpic";
							 }
							 if ($products_mainpic == "" ) $pic = "$productspath/nopic.jpg";

							?>				
							<form action="cart.php" method="post" name='FrmViewCart'>
												<tr bgcolor='#FFFFFF' height="87" onMouseOver="onRowOver(this, '#EBCA3D')" onMouseOut="onRowOut(this)"  title="<?=$msg?>" > 
												<td width="30"><? //=$_SESSION[promotion]?><? if ($products_id==$_SESSION[promotion])  { ?><input name="promotion" type="radio" value="<?=$products_id?>"  CHECKED/>
												<? } else  { ?><input name="promotion" type="radio" value="<?=$products_id?>" onclick="this.form.submit();" /><? } ?><? //=$_SESSION[promotion] ?></td>
												  <td style="padding:5px" valign="top" onclick="document.location='products_detail.php?prod_id=<?=$products_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>';" >
												  <input type='Hidden' name='todo' value='updateitem'>
												<input type='Hidden' name='ob_id' value='<?=$orderb_id?>'>
												<table border="0" cellpadding="0" cellspacing="0" class="tblcart">
												<tr >
												<td rowspan="2" valign="middle" align="center"><img src="<?="$pic";?>" width="87" height="71"></td>
												</tr>
												<td><span class="fsmall">&nbsp;&nbsp;<?=$products_name?><br />&nbsp;&nbsp;รหัสสินค้า <?=$products_jb_no?></span></td>											<td></td>
												</tr></table>
													</td>
												  <td align='right' onclick="document.location='products_detail.php?prod_id=<?=$products_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>';"><span class="fsmall">	
												  <?=number_format($price, 2, '.', ',');?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</span></td>
												  <td align='right'><span class="fsmall"> 
													<input type='text' name='amo2' size='5' maxlength=3 OnBlur='CheckAmo(this,"<?=$amount?>")' value='<?=$amount;?>' style="width:30px;">
													<input type='submit' value='Edit' class=sbttn  onMouseOver="this.style.cursor='hand'; this.style.color='#FF9900'" onMouseOut="this.style.color='#000000'"><BR>
													<div align="center"><a href='cart.php?todo=deleted&ob_id=<?=$orderb_id?>'>remove</a></div>
													</span></td>
												  <td align='right'><span class="fsmall"> 
													<?=number_format($total, 2, '.', ',');?>&nbsp;&nbsp;บาท&nbsp;&nbsp;
													</span></td>
												</tr>
												</form>
									<?php
											} //end of while
									?>

									<tr>
									<td colspan="6" bgcolor="#FFFFFF">
									 <table width="100%" frame="void" border="0" class="tblcart">
									<tr> 
									  <td align="right" width="65%"><span class="fsmall"><b>รวมเงิน (ไม่รวมVAT)</b></span>
										: </b></td><td align="right"><span class="fsmall"><?echo number_format($grantotal, 2, '.', ',');?></span></td>
										<td align="right" width="35"><span class="fsmall">บาท&nbsp;&nbsp;</span></td></td>
									</tr>
									<tr> 
									  <td align="right"><span class="fsmall"><b>ค่าขนส่ง 
										: </b></span></td><td align="right"><span class="fsmall">ค่าขนส่งจะปรากฎในข้อมูลการจัดส่ง</span></td><td align="right"><span class="fsmall">บาท&nbsp;&nbsp;</span></td>									</tr>
									<tr> 
									  <td align="right"><span class="fsmall"><b>ภาษีมูลค่าเพิ่ม(VAT)</b></span>
										: </b></td><td align="right"><span class="fsmall"> <?echo number_format(($grantotal *0.07), 2, '.', ',');?></span></td><td align="right"><span class="fsmall">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr style="display:none"> 
									  <td align="right"><span class="fsmall"><b>ส่วนลด
										: </b></span></td><td align="right"><span class="fsmall"><?echo number_format($totaldis, 2, '.', ',');?></span> </td><td align="right"><span class="fsmall">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td align="right"><span class="fsmall"><b>รวมเงินทั้งหมด : 
										</b></span> </td><td align="right"><span class="fsmall"><?echo number_format(($grantotal *0.07)+$grantotal, 2, '.', ',');?></span> </td><td align="right"><span class="fsmall">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td align="center" colspan="2"><span class="fsmall">
									  <br />
<?php 
$total=3000;
if($grantotal <='3000'){
$total=$total-$grantotal;
?>
<span class="fsmall">**“ขณะนี้ท่านซื้อไปแล้ว <font color="red">&nbsp;<? echo number_format($grantotal);?></font>&nbsp;</span>  บาท ขาดอีก <font color="red"> <? echo number_format($total);?></font>บาท จะ มีสิทธิ์ลุ้นเที่ยวฟรี**

<?
}else if($grantotal >='3000'){
$total=$grantotal;

echo '**ราคาสินค้ารวม&nbsp;&nbsp; <font color="red">'.number_format($total).'</font>&nbsp;&nbsp;บาท ';
echo' ท่านมีสิทธิ์ลุ้นเที่ยวฟรีตลอดปีกับ บริษัทเจนบรรเจิด ** ';

}
 
?>

</p>
</span>
ซื้อสินค้าครบ 3,000  บาท วันนี้ ลุ้นเที่ยวฟรีตลอดปีกับ  jenbunjerd 
										 </td><td></td>
									</tr>
									<tr> 
									  <td  align="right">
										</td></td><td></td>
									</tr>
								  </table>
								  
								 <table width="100%" frame="void" border="0">
								 <tr>
								<td>
								<img src="images/btn_continue.gif" width="187" height="25" onclick="document.location='products.php?cateparent=<?=$parent_cat?>&level=3&thiscategories_id=<?=$categories_id?>';" onMouseOver="this.style.cursor='hand';">
								<input type='button' value='     ยกเลิกใบสั่งซื้อนี้    ' onclick="window.location='cart.php?todo=orderdeleted'"  onMouseOver="this.style.cursor='hand'; this.style.color='#FF9900'" onMouseOut="this.style.color='#000000'" style="display:none">
								</td>								
								<td align="right"><!-- <input type='button' value='     Check out     ' class=sbttn onclick="window.location='checkout.php'"> -->
								<img src="images/btn_checkout.gif" width="187" height="25" onclick="document.location='step-2.php';" onMouseOver="this.style.cursor='hand';">
								</td>
								</tr>
								</table>
								  <?php
										} //if ($total_item > 0 ){
										else
										{
								  ?>
								  </td>
								  </tr>
								  <tr>
									<td colspan="6">
									<table class='texttable1' cellSpacing='0' cellPadding='3' width='100%' border='0'  bgcolor="#FFFFFF">
									<tr valign='top'>
									<td align='center' valign="middle" height="50">								
									  <font size="2">ตะกร้าสินค้าคุณยังว่างอยู่ครับ</font>
									</td>
								  </tr>
								  </table>
									</td>
								</tr>
								<?php	
										}
								?>
								</td>
								</tr>
							</table>

					</TD>
					</TR>
					</TABLE>
					<BR>
				</td>
				</tr>
				</table>

		</td>
		</tr>
	</table>


		<!-- End -->
		   </td>
		<td>&nbsp;</td>
	  </tr>
	</table>

</div>
<div><?php include "footer.php"; ?></div>
</html>
