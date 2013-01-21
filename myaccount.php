<?
session_start();
include "config.php";
$textsearch = $_REQUEST['textsearch'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/clsFont.css" type="text/css" media="screen" />
<? include "set_title.php"; ?>
<title><? echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language="javascript" src="js/win_func.js"></script>
</head>
<body>
<div><? include "header.php"; ?></div>
<div class='Div_Content'>
	<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
	  <tr valign="top">
		<td width="244">
		<table width="244" height="100%" border="0" cellpadding="1" cellspacing="0">
		  <tr>
			<td width="244" valign="top"><? include "left.php"; ?></td>
		  </tr>
		</table>
		</td>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><? include("banner.php");?><br />
		    <br /></td>
		  </tr>
		</table>
			<!-- Start -->
<table width="732" border="0">
          <tr>
            <td width="32" height="28">&nbsp;</td>
            <td width="672"><img src="images/tab_Customer-account.jpg" width="515" height="26"></td>
            <td width="14">&nbsp;</td>
          </tr>
          <tr>
            <td height="24">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="24">&nbsp;</td>
            <td><img src="images/tab_accout_information.gif" width="126" height="18" onclick="javascript:document.location='profilemember.php';" onmouseover="this.style.cursor='hand';"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td height="24">&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><img src="images/tab_Shipping-Information3.gif" width="121" height="13"  onclick="javascript:document.location='profilemember.php';" onmouseover="this.style.cursor='hand';"></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><img src="images/tab_order_information.gif" width="105" height="10" onclick="javascript:document.location='myaccount.php';" onmouseover="this.style.cursor='hand';"></td>
            <td>&nbsp;</td>
          </tr>
		  <?
					if ($_REQUEST['orderid']){
						$thisorder = $_REQUEST['orderid'];
						
					$order_sql = sql_Select(1, $prefix."_order", "order_id = '$thisorder'", 0);
				//	echo  $order_sql ;
					$order_query = $db->sql_query($order_sql);
					$result = $db->sql_fetchrow($order_query);
					
				
				//	$members_id = stripslashes($result['members_id']);
					$order_bill_title=stripslashes($result['order_bill_title']);
					$order_name=stripslashes($result['order_name']);
					$order_bill_title_val = getn("title_name","title","title_id='$order_bill_title'");
					$order_bill_fname=stripslashes($result['order_bill_fname']);
					$order_bill_lname=stripslashes($result['order_bill_lname']);
					$order_bill_phone=stripslashes($result['order_bill_phone']);
					$order_bill_company=stripslashes($result['order_bill_company']);
					$order_bill_addresstype=stripslashes($result['order_bill_addresstype']);
					$order_bill_address=stripslashes($result['order_bill_address']);
					$order_bill_district_code=stripslashes($result['order_bill_district_code']);
					$order_bill_amphur_code=stripslashes($result['order_bill_amphur_code']);
					$order_bill_province_code=stripslashes($result['order_bill_province_code']);
					$order_bill_postcode=stripslashes($result['order_bill_postcode']);
					$order_bill_country=stripslashes($result['order_bill_country']);
					$order_shipping_title=stripslashes($result['order_shipping_title']);
					$order_shipping_title_val = getn("title_name","title","title_id='$order_shipping_title'");
					$order_shipping_fname=stripslashes($result['order_shipping_fname']);
					$order_shipping_lname=stripslashes($result['order_shipping_lname']);
					$order_shipping_phone=stripslashes($result['order_shipping_phone']);
					$order_shipping_company=stripslashes($result['order_shipping_company']);
					$order_shipping_addresstype=stripslashes($result['order_shipping_addresstype']);
					$order_shipping_address=stripslashes($result['order_shipping_address']);
					$order_shipping_district_code=stripslashes($result['order_shipping_district_code']);
					$order_shipping_amphur_code=stripslashes($result['order_shipping_amphur_code']);
					$order_shipping_province_code=stripslashes($result['order_shipping_province_code']);
					$order_shipping_postcode=stripslashes($result['order_shipping_postcode']);
					$order_shipping_country=stripslashes($result['order_shipping_country']);
				//	$members_id=$result['members_id'];
					$mem_sql = sql_Select(1, $prefix."_members", "members_id = '".$_SESSION['members_id']."' " , 0);

			//echo  $mem_sql ;

					$mem_query = $db->sql_query($mem_sql);

					$result_mem = $db->sql_fetchrow($mem_query);		
					$members_title=stripslashes($result_mem['members_title']);
					$members_title_val = getn("title_name","title","title_id='$members_title'");
					$members_fname=stripslashes($result_mem['members_fname']);
					$members_lname=stripslashes($result_mem['members_lname']);
						$members_phone_number=stripslashes($result_mem['members_phone_number']);
					$members_jobtitile=stripslashes($result_mem['members_jobtitile']);
					$members_department=stripslashes($result_mem['members_department']);
					$members_company=stripslashes($result_mem['members_company']);
					$member_info = $members_title_val ."".$members_fname ." &nbsp; ".$members_lname ." &nbsp; ตำแหน่ง ".$members_jobtitile ." &nbsp; แผนก ".$members_department ." &nbsp; บริษัท ".$members_company ."   &nbsp;เบอร์โทรศัพท์ ".$members_phone_number;
				
					
					$shipping_district = getn("dirstict_name","district","district_code = $order_shipping_district_code");
					$shipping_amphur = getn("amphur_name","amphur","amphur_code = $order_shipping_amphur_code");
					$shipping_province = getn("province_name","province","province_code = $order_shipping_province_code");
					$shipping_address = " $order_shipping_title_val  $order_shipping_fname  $order_shipping_lname  $order_bill_company $order_shipping_address &nbsp;$shipping_district &nbsp;$shipping_amphur &nbsp;$shipping_province &nbsp;$order_shipping_postcode เบอร์โทรศัพท์ $order_shipping_phone";
					
					$bill_district = getn("dirstict_name","district","district_code = $order_bill_district_code");
					$bill_amphur = getn("amphur_name","amphur","amphur_code = $order_bill_amphur_code");
					$bill_province = getn("province_name","province","province_code = $order_bill_province_code");
					$bill_address = " $order_bill_title_val  $order_bill_fname  $order_bill_lname  $order_bill_company $order_bill_address &nbsp;$bill_district &nbsp;$bill_amphur &nbsp;$bill_province &nbsp;$order_bill_postcode เบอร์โทรศัพท์ $order_bill_phone";
				//	$pre_order_name =date('y'). date('m');
				//$order_namerun = getn("count(*)", "order","order_name like '$pre_order_name%' ")+1;
				//	$order_name = date('y'). date('m').sprintf('%05d',$order_namerun);
					
					$totalrec = $db->sql_numrows($list_query);

					$grantotal =0;  // จำนวนของสินค้าทั้งหมด
					$totaldis = 0; 
			?>
						<!-- start view Order -->
			  <tr>
				<td colspan="3"><BR>
					<table cellspacing='1' cellpadding='0' border='0'  width='90%' bgcolor="#D3A219" align="center">
						<tr>
						  <td bgcolor="#FFFFFF">
						    <table cellspacing='0' cellpadding='5' border='0'  width='100%'  align="center">
								<tr>
								  <td></td>
								  <td ><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>ชื่อ-นามสกุลผู้ติดต่อ</strong></font></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong><?=$member_info?></strong></font></td>
								</tr>
								<tr height="25">
								  <td></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>สถานที่ออกใบกำกับภาษี</strong></font></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong><?=$bill_address?></strong></font></td>
								  <td></td>
								</tr>
								<tr height="25">
								  <td></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>สถานที่จัดส่ง</strong></font></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong><?=$shipping_address?></strong></font></td>
								  <td></td>
								</tr>
								<tr height="25">
								  <td></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>วิธีการชำระเงิน</strong></font></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>
								  <? 
								  $sql_pay = sql_Select(1,$prefix."_order","order_id = '".$thisorder."'",0);
								  $query_pay = $db->sql_query($sql_pay );
								  $rs_pay = $db->sql_fetchrow($query_pay );
								  $order_payment = $rs_pay['order_payment'];
								  $order_payment_at_bank = $rs_pay['order_payment_at_bank'];
								 $bank_detail = getn("bank_detail","bank","bank_name = '$order_payment_at_bank' and bank_status='1'");
								  switch ($order_payment)
								  {   
									case "Cash" : $order_payment_txt="โอนเงินเข้าบัญชีธนาคาร ";  
										$link_to =" document.FrmConfirm.submit();";  
									break; 
									case "CreditTerm" : $order_payment_txt="ขอใช้ระบบสินเชื่อ";   
									$link_to =" document.FrmConfirm.submit();";
									break;
									case "CreditCard" : $order_payment_txt="ชำระเงินผ่านบัตรเครดิต";  
										$link_to =" window.document.forms['sendform'].submit();";
									break;
								
								  }
							echo $order_payment_txt;
						
								  ?>
								</font></strong></td>
								  <td></td>
								</tr>
								<? if($bank_detail != ""){?>
								<tr height="25">
								  <td></td>
								  <td>&nbsp;</td>
								  
								  <td colspan="2"><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong><?=$order_payment_at_bank?><BR><?=$bank_detail?></strong></font></td>
								</tr>
								<?
								
								 }  ?>
								<tr height="25">
								  <td></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>เลขที่ใบสั่งซื้อ</strong></font></td>
								  <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong><?=$order_name?></strong></font></td>
								  <td></td>
								</tr>
								<tr>
								  <td></td>
								  <td colspan="2"></td>
								</tr>
								<input type="hidden" name="msg_txt" value="<?=$msg_txt?>" />
							  </table>
						</td>
					</tr>
				</table><BR>		
			<TABLE cellspacing='0' cellpadding='0' border='0' bgcolor='#FFFFFF' width='680' align="center" >
					<TR>
						<TD valign='top' >				<!-- View Item -->		
	
					 
						  <table cellspacing='0' cellpadding='2' border='0'  width='100%' bgcolor="#D3A219">
							  <tr align="center" height="2" bgcolor="#FFFFFF"> 
								<td width='230'  colspan="4" style="display:none">
								<table width="227" border='0'  style="background: url(images/5order-confirmation-1_12.jpg) left top no-repeat; ">
								<tr>
								  <td width="85" height="18" >&nbsp;</td>
								  <td width="160"><font color="#D7A21E" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;Order Confirmation </strong></font></td>
								</tr>
							  </table>
								
								</td>
							  </tr>
							  <tr align="center" height="2" bgcolor="#FFFFFF"> 
								<td width='230' colspan="4"></td>
							  </tr>
							  <tr align="center" height="2" bgcolor="#FFFFFF"> 
								<td width='230' colspan="4"></td>
							  </tr>
						</table>
						
						  <table cellspacing='1' cellpadding='0' border='0'  width='100%' bgcolor="#D3A219">
							  <tr align="center" height="35"> 
								<td width='45%'><b><font color="#FFFFF">สินค้า</font></b></td>
								<td width='20%'><b><font color="#FFFFF">ราคา/หน่วย</font></b></td>
								<td width='15%'><b><font color="#FFFFF">จำนวน</font></b></td>
								<td width=''><b><font color="#FFFFF">รวมเงิน</font></b></td>
							  </tr>
							    <form action="" method="post" name='FrmConfirm'>			
								<input type='Hidden' name='order_name' value='<?=$order_name?>'>	
								<input type='Hidden' name='confirmdata' value='<?=session_id()?>'>	
								
						  <?

							$cart_sql = sql_Select(1, $prefix."_order_b", "order_id = '$thisorder'", 0);
							//echo  $cart_sql ;
							$cart_query = $db->sql_query($cart_sql);										
							$total_item = $db->sql_numrows($cart_query);
							
							if ($total_item > 0 ){
							while ( $cart = $db->sql_fetchrow($cart_query))
								{
									//print_r($cart);
									$orderb_id=$cart['orderb_id'];
									$order_id=$cart['order_id'];
									$products_id=$cart['products_id'];
									$price=$cart['price'];
									$amount=$cart['amount'];
									$discountprice=$cart['discountprice'];
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
									$products_name=stripslashes($result['products_name']);
									$products_jb_no=stripslashes($result['products_jb_no']);
									$products_mainpic=$result['products_mainpic'];
									$products_status=$result['products_status'];
									$categories_id=$result['categories_id'];

									 if ( $products_mainpic )	{
									$widthsize=getimagesize("backend/$products_path/$products_mainpic"); 
									$old_w=$widthsize[0]; 
									$old_h=$widthsize[1]; 		

									//echo "$widthsize[0],$widthsize[1]";
									
									if( $widthsize[1] >= 100 )  {
												// $p_ ย่อลงเท่าไหร่
												$p_ = (100/$widthsize[1]);
												$w = $widthsize[0]*$p_;
												$h = 100;

												if ( $w > 120){
												// $p_ ย่อลงเท่าไหร
												$p_ = (120/$widthsize[0]);
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
									$pic = "backend/$products_path/$products_mainpic";
							 }
							 if ($products_mainpic == "" ) $pic = "backend/$products_path/nopic.jpg";
//echo "$total_percent_baht + ($discount_percent_baht)*$amount";
							//print_r($cart);
							?>
																											
												<tr bgcolor=#FFFFFF height="87" onMouseOver="onRowOver(this, '#EBCA3D')" onMouseOut="onRowOut(this)"  title="<?=$msg?>" > 
												  <td style="padding:5px" valign="top" onclick="document.location='products_detail.php?prod_id=<?=$products_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>';"><table border="0" cellpadding="0" cellspacing="0"><tr ><td rowspan="2"><img src="<?="$pic";?>" width="87" height="71"></td></tr><tr><td><font size="1" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;<?=$products_name?><br />&nbsp;&nbsp;รหัสสินค้า <?=$products_jb_no?></font></td></tr></table>
													</td>
												  <td align='right'onclick="document.location='products_detail.php?prod_id=<?=$products_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>';"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 	
												  <?=number_format($products_sale, 2, '.', ',');?>&nbsp;&nbsp;บาท&nbsp;&nbsp;</font></td>
												  <td align='center'><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> <?=$amount;?></td>
												  <td align='right'><font size="1" face="MS Sans Serif, Tahoma, sans-serif"> 
													<?=number_format($total, 2, '.', ',');?>&nbsp;&nbsp; บาท&nbsp;&nbsp;</font></td>
												</tr>
											
									<?php
											} //end of while
											
											$transoprt =getn("order_transportation","order","order_id = '".$thisorder."'");
											//echo $grantotal;
											$vat_ = 	$grantotal*0.07;
											$g_total = $grantotal+$vat_+$transoprt;
											$g_total_send=$g_total *100;
									?>
 
									<tr>
									<td colspan="6" bgcolor="#FFFFFF">
									 <table width="100%"  border="0">
									<tr> 
									  <td align="right" width="80%"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><b>รวมเงิน (ไม่รวมVAT) 
										: </b></font></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?echo number_format($grantotal, 2, '.', ',');?></font> </td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">บาท&nbsp;&nbsp;</font></td>
									</tr>
									<?
										
											$order_payment =getn("order_payment","order","order_id = '".$thisorder."'"); 
											$str_ =  "style='display:none'"; 
											
											if ($order_payment == "Cash") {  
												   $str_ =  ""; 
													//$grantotal = $grantotal - $totaldis - $total_percent_baht;
													$grantotal = $grantotal- $total_percent_baht  + $transoprt  ;  //after minus discount percent
													$vat_ = 	$grantotal* ($setting_tax/100);
													$update_cash  =  sql_Update($prefix."_order","order_total ='$grantotal' , order_tax='$vat_' ","order_id '".$_SESSION['o_id']."'");	
													$save_query = $db->sql_query($update_cash);
											 }
											 else{
													$grantotal = $grantotal + $transoprt  ;  //after minus discount percent
													$vat_ = 	$grantotal* ($setting_tax/100);
											 }
													$g_total = $grantotal+$vat_;
													if ($order_payment == "CreditCard") $g_total_send=$g_total *100;
													else $g_total_send=0;
									?>
									<tr <?=$str_;?> > 
									  <td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><b>ส่วนลด 1% (ชำระเงินสด)
										: </b></font></td><td align="right"><font color='red' size="1" face="MS Sans Serif, Tahoma, sans-serif"><?=number_format($total_percent_baht*-1, 2, '.', ',');?></td><td align="right"><font size="1" color='red' face="MS Sans Serif, Tahoma, sans-serif">บาท&nbsp;&nbsp;</font></td>
									</tr>
									<tr> 
									  <td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><b>ค่าขนส่ง
										: </b></font></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?=number_format($transoprt, 2, '.', ',');?></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">บาท&nbsp;&nbsp;</font></td>
									</tr>
									<tr> 
									  <td align="right" width="80%"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><b>รวมเงิน (ไม่รวมVAT) 
										: </b></font></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?echo number_format($grantotal, 2, '.', ',');?></font> </td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">บาท&nbsp;&nbsp;</font></td>
									</tr>
									<tr> 
									  <td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><b>ภาษีมูลค่าเพิ่ม(VAT)
										: </b></font></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?echo number_format($vat_, 2, '.', ',');?> </font></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">บาท&nbsp;&nbsp;</font></td>
									</tr>
									<tr> 
									  <td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><b>รวมเงินทั้งหมด: 
										: </b> </font></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif"><?echo number_format($g_total, 2, '.', ',');?> </font></td><td align="right"><font size="1" face="MS Sans Serif, Tahoma, sans-serif">บาท&nbsp;&nbsp;</font></td>
									</tr>
									<tr> 
									  <td  align="left" colspan="3">
										</td>
									</tr>
									<tr> 
									  <td  align="right">
										</td>
									</tr>	  </table>

								  <?php
										} //if ($total_item > 0 ){
										else
										{
								  ?>
								  <tr>
									<td colspan="6">
									<table class='texttable1' cellSpacing='0' cellPadding='3' width='100%' border='0'  bgcolor="#FFFFFF">
									<tr valign='top'>
									<td align='center'>								
										<img src='imgs/cartempty.gif' width='56' > 
									  <font size="2">ตะกร้าสินค้าคุณยังว่างอยู่ครับ</font><BR><BR>
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


						 <!-- end view Order -->
			<?
					}
					else{



		?>
          <tr style="display:">
            <td height="28">&nbsp;</td>
            <td><form name="form2" method="post" action=""><table width="674" border="0">
                <tr>
                  <td width="206">
                      <label>
                      <input type="text" name="textsearch" id="textsearch" value="<?=$textsearch?>">
                      </label>
                  </td>
                  <td width="456">
                      <label>
                      <input type="submit" name="button" id="button" value="Keyword or Item No.">
                      </label>
                  </td>
                </tr>
            </table></form></td>
            <td>&nbsp;</td>
          </tr>
          <tr style="">
            <td>&nbsp;</td>
            <td><table width="673" border="0">
			<?
									$list_sql = sql_Select(1, $prefix."_order", "members_id ='".$_SESSION['members_id']."' and order_name <> '' and order_name like '%$textsearch%' " , 0);
									$list_sql .= "  $con_opt";
									//echo "<br>$list_sql";
									$list_query = $db->sql_query($list_sql);
									//echo "<br>$list_guery";
									$totalrec = $db->sql_numrows($list_query);
									//echo "<br>$totalrec<br>";	
									$num = $totalrec; 				//$per_page = $pagesize;		

									if (!$per_page) $per_page=$perpage;
		  							if (!$c_page)   $c_page  = 1;

									if ($num <$per_page) 
									$amount = 1;
												else if ($num%$per_page == 0)
																	$amount = $num/$per_page;
 	       						 						else
																    $amount = ceil($num/$per_page);

		
								if ($c_page > 1)  $prv = $c_page -1;

								if ($c_page < $amount )  $next = $c_page+1;
		
								$startpage = $c_page*$per_page - $per_page;
							
								if (!$order) $order="order_id";
								if (!$sequence) $sequence="DESC";
								$list_sql .= " $con_opt ORDER BY $order $sequence LIMIT $startpage,$per_page";								
								//echo $list_sql;
								$list_query = $db->sql_query($list_sql);
								  
								  if ($num>0)
								  {
									$bg = $theme_tab2;
									while (  $order = $db->sql_fetchrow($list_query))
													{
															$order_id=$order['order_id'];
															$order_date=$order['order_date'];
															$order_name=$order['order_name'];
															$order_time=$order['order_time'];
															$order_method=$order['order_method'];
															$order_name=$order['order_name'];
															$order_address=$order['order_address'];
															$order_receiver=$order['order_receiver'];
															$order_receiver_add=$order['order_receiver_add'];
															$order_total=$order['order_total'];
															$order_transportation=$order['order_transportation'];
															$order_tax=$order['order_tax'];
															$order_note=$order['order_note'];
															$order_status=$order['order_status'];
															$order_payment=$order['order_payment'];
															$members_id=$order['members_id'];


															if($order_payment == "Cash" ) { 
																$discount_promo  = number_format(getn("sum(discount_percent_baht*amount)","order_b","order_id='$order_id'"),2,'.',',');$g_total = $order_total - $discount_promo +$order_tax ;
															}
															else{
																$discount_promo  = 0;
															}
															$g_total = $order_total +$order_tax ;
															
															if ( $order_status == "Deleted" ) { $stus = "<img src='../imgs/cancel.gif'>"; $order_status = "Cancel" ;}
															else  if ( $order_status == "Wait" )  {   $stus = "<img src='../imgs/wait.gif'>"; $order_status = "Waiting" ;}
																else  if ( $order_status == "Preparing" )  {   $stus = "<img src='../imgs/preparing.gif'>"; $order_status = "Preparing" ;}
																		else  if ( $order_status == "Completed" )   $stus = "<img src='../imgs/completed.gif'>";
				?>

                <tr onclick="javascript:document.location='?orderid=<?=$order_id?>';" onmouseover="this.style.cursor='hand';">
                  <td width="93"><img src="images/tab_view.gif" width="32" height="33" >&nbsp;<span class="fmenu">View</span></td>
                  <td width="234"><span class="fmenu">Order Date :<?=Date_TH($order_date)." ".$order_time;?></span></td>
                  <td width="332"><span class="fmenu">Order Status : <?=$order_status?></span></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                  <td><span class="fmenu">Total : <?=number_format($g_total,2,'.',',')?>&nbsp;&nbsp;Baht</span></td>
                  <td><span class="fmenu">Order Number : <?=$order_name?></span></td>
                </tr>
				<?
													}
								  }
				?>


            </table></td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td><TABLE  width="95%" border="0" cellpadding="2" cellspacing="2" align="center">
						<TR>
						<TD><span class="fmenu"><div align="right">ทั้งหมด <?=$totalrec?> record</div></span><BR>
						<CENTER>
						<?php
						if($c_page > 1 && $c_page != "" && $amount != 0){ ?>
								<a style="cursor: hand" onClick="location='<?php echo "?keyword=$keyword&c_page=".($c_page-1); ?>'"> 
								<img src="imgs/prevorange.gif" alt="Previous page" name="prev_page" width="16" height="16" border="0" align="absmiddle"></a>
								<?php }else{ ?>
								<img src="imgs/prev_dis.gif" alt="Previous page" name="prev_dis" width="16" height="16" border="0" align="absmiddle">
						 <?php } ?>
						 <span class="fmenu">&nbsp;Page : </span>
						 <?php
						if ( $amount > 0 ) 	
								{
										for($p=1;$p<=$amount;$p++)  {
												if ($c_page == $p)   echo "<FONT color='#CC0000' class='fredmenu'> <B>$p</B> </FONT>";
												else  echo " <a href='?keyword=$keyword&c_page=$p'>$p</a>";
										}
								}
						?>&nbsp;&nbsp;
						<?php if($c_page != $amount && $amount != 0){ ?>
								<a style="cursor: hand" onClick="location='<?php echo "?keyword=$keyword&c_page=".($c_page+1); ?>'"> 
								<img src="imgs/nextorange.gif" alt="Next page" name="next_page" width="16" height="16" border="0" align="absmiddle"></a> 
								<?php }else{ ?>
								<img src="imgs/next_dis.gif" alt="Next page" name="next_dis" width="16" height="16" border="0" align="absmiddle">	
						<?php } ?>
						</CENTER><BR>
						</TD>
						</TR>
						</TABLE></td>
            <td>&nbsp;</td>
          </tr>
		  <?  
				} //end list order
		   ?>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
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
