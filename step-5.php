<?
session_start();
$promo_id=$_SESSION['promotion'];

include "config.php";
$members_id=$_SESSION['members_id'];
//$_SESSION['o_id'] = 2;
$o_id=$_SESSION['o_id'];
$confirmdata = get_Var('confirmdata','request',0);
$order_name = get_Var('order_name','request',0);
$orderid = get_Var('orderid','request',0);
//echo $members_id."sdfadsf";
			//$_SESSION['o_id'] = "19";
$RESERVED1 = get_var('RESERVED1','request',0);  //  transaction no of bank
$AUTHCODE = get_var('AUTHCODE','request',0);  //  transaction no of bank
$RETURNINV = get_var('RETURNINV','request',0);  //  transaction no of bank
$HostResp = get_var('HostResp','request',0);  //  transaction no of bank
//$RESERVED1 = "34253245324";
//print_r($_REQUEST); exit;
//print_r($_SESSION); exit;
//exit;
if ($confirmdata!=""){

			$strupdate = "";			
			if ($HostResp){				
					if ($HostResp == '00' ){
							if ($AUTHCODE)  { 
								$strupdate = ",order_bank_trans = '$AUTHCODE',order_payment_status=1 ";
							}
					}
					else{
						echo "<meta http-equiv='refresh' content=\"0; URL=step-4.php?error_message=1\"> ";
					}
			}
			
			$update  = sql_Update($prefix."_order","order_confirm=1,order_status='Wait',order_sessionid ='$confirmdata',members_id = '".$members_id."' $strupdate","order_id = '".$_SESSION['o_id']."' ");
		
			$query = $db->sql_query($update);//echo $update; exit();
			$order_payment = getn("order_payment","order","order_id = '".$_SESSION['o_id']."' ");
			$order_total = getn("order_total","order","order_id = '".$_SESSION['o_id']."' ");
			echo $order_total;
			$members_credit_term = getn("members_credit_term","members","members_id = '".$members_id."' ");
			if($order_payment=='CreditTerm')
			{
				$credit_sub = $members_credit_term-$order_total;
				$up_mem = "members_credit_term='0', ";  // sum from order table
			}
			//echo "floor($order_total/$setting_bahtperpoint)";
			$reward = floor($order_total/$setting_bahtperpoint);
			
		
			$sql_mem = sql_Update($prefix."_members","$up_mem members_reward_point='0' ","members_id = '".$members_id."' "); //exit;
			$query_mem = $db->sql_query($sql_mem);

			// Clear Order Session

			echo '<div id="loading" style="filter:alpha(opacity=30)"><table width="100%" height="100%"><tr><td valign="middle" align="center"><font face="MS Sans Serif" size="4" color="#333333"><B>Loading . . . . </B><br><br> <img src="imgs/loading.gif"></font></td></tr></table></div>';
			
		    if ($query_mem) {
				
            //echo "orderid=$o_id"; exit;
			$_orderid = $_SESSION['o_id'];
			$_SESSION['o_id'] = "";
			echo "<meta http-equiv='refresh' content=\"0; URL=step-6.php?orderid=".$_orderid."\"> ";
			exit;
			}
}
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
          <td width="92"><img src="images/5order-confirmation-1_03.jpg" onclick="document.location='step-1.php';" onMouseOver="this.style.cursor='hand';"></td>
          <td width="85"><img src="images/1your-basket_04.jpg"  onclick="document.location='step-2.php';" onMouseOver="this.style.cursor='hand';"></td>
          <td width="85"><img src="images/1your-basket_05.jpg"  onclick="document.location='step-3.php';" onMouseOver="this.style.cursor='hand';"></td>
          <td width="86"><img src="images/1your-basket_06.jpg" onclick="document.location='step-4.php';" onMouseOver="this.style.cursor='hand';"></td>
          <td width="114"><img src="images/5order-confirmation-1_07.jpg" onclick="document.location='step-5.php';" onMouseOver="this.style.cursor='hand';"></td>
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
					 include("promotion.php");
					$order_sql = sql_Select(1, $prefix."_order", "order_id = '$o_id'", 0);
					//echo  $order_sql ;
					$order_query = $db->sql_query($order_sql);
					$result = $db->sql_fetchrow($order_query);
					
				
				//	$members_id = stripslashes($result['members_id']);
					$order_bill_title=stripslashes($result['order_bill_title']);
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
					$order_promotion=stripslashes($result['promotion']); //promotion
				//	$members_id=$result['members_id'];
					$mem_sql = sql_Select(1, $prefix."_members", "members_id = '".$_SESSION['members_id']."' " , 0);

			//echo  $mem_sql ;

					$mem_query = $db->sql_query($mem_sql);

					$result_mem = $db->sql_fetchrow($mem_query);		
					$members_title=stripslashes($result_mem['members_title']);
					$members_title_val = getn("title_name","title","title_id='$members_title'");
					$members_fname=stripslashes($result_mem['members_fname']);
					$members_lname=stripslashes($result_mem['members_lname']);
					$members_code =stripslashes($result_mem['members_code']);
						$members_phone_number=stripslashes($result_mem['members_phone_number']);
					$members_jobtitile=stripslashes($result_mem['members_jobtitile']);
					$members_department=stripslashes($result_mem['members_department']);
					$members_company=stripslashes($result_mem['members_company']);
					$member_info = $members_title_val ."".$members_fname ." &nbsp; ".$members_lname ."&nbsp;"."(&nbsp; ".$members_code."&nbsp; )"." &nbsp; ตำแหน่ง".$members_jobtitile ." &nbsp; แผนก".$members_department ." &nbsp;<BR>บริษัท ".$members_company ."<BR>เบอร์โทรศัพท์ ".$members_phone_number;
				
					
					$shipping_district = getn("dirstict_name","district","district_code = $order_shipping_district_code");
					$shipping_amphur = getn("amphur_name","amphur","amphur_code = $order_shipping_amphur_code");
					$shipping_province = getn("province_name","province","province_code = $order_shipping_province_code");
					$shipping_address = " $order_shipping_title_val  $order_shipping_fname  $order_shipping_lname  <BR>$order_bill_company <BR>$order_shipping_address &nbsp;$shipping_district &nbsp;$shipping_amphur &nbsp;$shipping_province &nbsp;$order_shipping_postcode <BR>เบอร์โทรศัพท์ $order_shipping_phone";
					
					$bill_district = getn("dirstict_name","district","district_code = $order_bill_district_code");
					$bill_amphur = getn("amphur_name","amphur","amphur_code = $order_bill_amphur_code");
					$bill_province = getn("province_name","province","province_code = $order_bill_province_code");
					$bill_address = " $order_bill_title_val  $order_bill_fname  $order_bill_lname  <BR>$order_bill_company <BR>$order_bill_address &nbsp;$bill_district &nbsp;$bill_amphur &nbsp;$bill_province &nbsp;$order_bill_postcode <BR>เบอร์โทรศัพท์ $order_bill_phone";

					$pre_order_name =date('y'). date('m');
					
					$order_name = getn("order_name", "order","order_id = '".$o_id."' ") ;
					if ($order_name == ""){				
						//$order_max = substr(getn("max(order_name)", "order",1), 4); 
						$order_max = substr(getn("max(order_name)", "order","order_name like '".$pre_order_name."%' "), 4); 
						$order_namerun = $order_max + 1;		//			 exit;
						$order_name = date('y'). date('m').sprintf('%05d',$order_namerun);
						$update  = sql_Update($prefix."_order","order_name='$order_name'","order_id = '".$o_id."' ");
						$order_query = $db->sql_query($update);
					}
					
					$totalrec = $db->sql_numrows($list_query);

					$grantotal =0;  // จำนวนของสินค้าทั้งหมด
					$totaldis = 0;
					?>
						  <table cellspacing='0' cellpadding='1' border='0'  width='100%' bgcolor="#D3A219">
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
							  <tr align="center" height="12" bgcolor="#D3A219"> 
								<td width='230' colspan="4"></td>
							  </tr>
							  <tr align="center" height="2" bgcolor="#FFFFFF"> 
								<td width='230' colspan="4"></td>
							  </tr>
						</table>
						
						  <table cellspacing='1' cellpadding='0' border='0'  width='100%' bgcolor="#D3A219">
							  <tr align="center" height="35"> 
								<td width='45%'><b><span class="fnormal">สินค้า<?=stripslashes($resultr['total'])?></span></b></td>
								<td width='20%'><b><span class="fnormal">ราคา/หน่วย</span></b></td>
								<td width='15%'><b><span class="fnormal">จำนวน</span></b></td>
								<td width=''><b><span class="fnormal">รวมเงิน</span></b></td>
							  </tr>
							    <form action="" method="post" name='FrmConfirm'>			
								<input type='Hidden' name='order_name' value='<?=$order_name?>'>	
								<input type='Hidden' name='confirmdata' value='<?=session_id()?>'>	
								
						  <?

							/*$cart_sql = sql_Select(1, $prefix."_order_b", "order_id = '$o_id'", 0);
							//echo  $cart_sql ;
							$cart_query = $db->sql_query($cart_sql);										
							$total_item = $db->sql_numrows($cart_query);*/
							
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

									if($_SESSION['promotion']==$products_id){ $total=($amount*$products_sale)-$order_promotion;}
									else {$total=($amount*$products_sale);}
									$grantotal=$grantotal+$total;
									$totaldis = $totaldis + ($discountprice)*$amount;
									$total_percent_baht = $total_percent_baht + ($discount_percent_baht)*$amount;
									
									$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$products_id'", 0);
									//echo  $detail_sql ;
									$detail_query = $db->sql_query($detail_sql);
									$result = $db->sql_fetchrow($detail_query);
									$products_name=stripslashes($result['products_name']);
									$productsjbno=$result['products_jb_no'];
									$products_description=$result['products_description'];
									$products_description = str_replace("\n","<br>",$products_description);		
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

									
							
							if($_SESSION['promotion']==$products_id){
									$msg_discount="<td align='right'><font size='1' face='MS Sans Serif, Tahoma, sans-serif'><strike><font color='red'>"
													.number_format($total+$order_promotion, 2, '.', ',')."</strike></font>&nbsp;&nbsp; บาท&nbsp;&nbsp;<BR>".number_format($total, 2, '.', ',')."&nbsp;&nbsp; บาท&nbsp;&nbsp;</font></td>";
									}
									else {$msg_discount="<td align='right'><font size='1' face='MS Sans Serif, Tahoma, sans-serif'>"
													.number_format($total, 2, '.', ',')."&nbsp;&nbsp; บาท&nbsp;&nbsp;";}
													
									$pic = "http://www.jenbunjerd.com/backend/$products_path/$products_mainpic";

									$msg_ .= "<tr bgcolor=#FFFFFF height='87' > 
												  <td style='padding:5px' valign='top' ><table border='0' cellpadding='0' cellspacing='0'><tr ><td rowspan='2'><img src='$pic' width='87' height='71'></td></tr><tr><td><font size='1' face='MS Sans Serif, Tahoma, sans-serif'>&nbsp; ".$products_name."<br />&nbsp;&nbsp;รหัสสินค้า $products_jb_no</font></td></tr></table>
													</td>
												  <td align='right'><font size='1' face='MS Sans Serif, Tahoma, sans-serif'>".	
												  number_format($products_sale, 2, '.', ',') ."&nbsp;&nbsp;บาท&nbsp;&nbsp;</font></td>
												  <td align='center'><font size='1' face='MS Sans Serif, Tahoma, sans-serif'>$amount</font></td>";
												  $msg_ .= $msg_discount;
													/*if ($_SESSION['promotion']==$products_jb_no)
													{ echo "<BR>".$_SESSION['promotion'].number_format($order_promotion, 2, '.', ',');}*/
													$msg_ .=  "</tr>";
											} //end of while
											echo $msg_;
											$transoprt =getn("order_transportation","order","order_id = '".$_SESSION['o_id']."'");
											$vat_ = 	($grantotal +$transoprt) * ($setting_tax/100);
											$g_total = $grantotal +$transoprt+$vat_;
											$g_total_send=$g_total *100;
									?>
 
									<tr>
									<td colspan="6" bgcolor="#FFFFFF">
									 <table width="100%"  border="0" class="tblcart">
									<tr> 
									  <td align="right" width="80%"><span class="f12small"><b>รวมเงิน (ไม่รวมVAT) 
										: </b></span></td><td align="right"><span class="f12small"><?echo number_format($grantotal, 2, '.', ',');?> </span></td><td align="right"><span class="f12small">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<?
										
											$order_payment =getn("order_payment","order","order_id = '".$_SESSION['o_id']."'"); 
											$str_ =  "style='display:none'"; 
											
											if ($order_payment == "Cash") {  
												   $str_ =  ""; 
													//$grantotal = $grantotal - $totaldis - $total_percent_baht;
													//promotion
													$grantotal = ($transoprt+$grantotal- $total_percent_baht);  //after minus discount percent
													$vat_ = 	$grantotal* ($setting_tax/100);
											 }
											 else{
													$grantotal = $grantotal + $transoprt-$order_promotion;  //after minus discount percent
													$vat_ = 	$grantotal* ($setting_tax/100);
											 }
													$update_cash  =  sql_Update($prefix."_order","order_total ='$grantotal' , order_tax='$vat_' ","order_id = '".$_SESSION['o_id']."'");	
													$save_query = $db->sql_query($update_cash);
													$g_total = ($grantotal+$vat_);
													// for send to bank
													
													if ($order_payment == "CreditCard") $g_total_send=floor($g_total *100);  
													else $g_total_send=0;

													//echo "$g_total,$g_total_send,".number_format($g_total,2,'.',',');
									?>
									<tr> 
									  <td align="right" width="80%"><span class="f12small"><b>ส่วนลดโปรโมชั่น 
										: </b>,</span></td><td align="right"><span class="f12small"><? echo number_format($order_promotion, 2, '.', ',');?> </span></td><td align="right"><span class="f12small">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr <?=$str_;?> > 
									  <td align="right"><span class="f12small"><b>ส่วนลด 1% (ชำระเงินสด)
										: </b></span></td><td align="right"><span class="f12small"><?=number_format(($total_percent_baht-($order_promotion*0.01))*-1, 2, '.', ',');?></span></td>
										<td align="right"><span class="f12small"><font color='red'>บาท&nbsp;&nbsp;</font></span></td>
									</tr>
									<tr> 
									  <td align="right"><span class="f12small"><b>ค่าขนส่ง
										: </b></span></td><td align="right"><span class="f12small"><?=number_format($transoprt, 2, '.', ',');?></span></td><td align="right"><span class="f12small">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td align="right" width="80%"><span class="f12small"><b>รวมเงิน (ไม่รวมVAT) 
										: </b>,</span></td><td align="right"><span class="f12small"><?echo number_format($grantotal, 2, '.', ',');?> </span></td><td align="right"><span class="f12small">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td align="right"><span class="f12small"><b>ภาษีมูลค่าเพิ่ม(VAT)
										: </b></span></td><td align="right"><span class="f12small"><?echo number_format($vat_, 2, '.', ',');?></span> </td><td align="right"><span class="f12small">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td align="right"><span class="f12small"><b>รวมเงินทั้งหมด: 
										</b></span> </td><td align="right"><span class="f12small"><?echo number_format($g_total, 2, '.', ',');?></span> </td><td align="right"><span class="f12small">บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td  align="left" colspan="3"><BR><BR>
										  <table border="0" cellpadding="5" cellspacing="0" class="tblcart">
											<tr height="25">
											  <td></td>
											  <td valign="top"><span class="f12small"><strong>ชื่อ-นามสกุลผู้ติดต่อ</strong></span></td>
											  <td><span class="f12small"><strong><?=$member_info?></strong></span></td>
											</tr>
											<tr height="25">
											  <td></td>
											  <td valign="top"><span class="f12small"><strong>สถานที่ออกใบกำกับภาษี</strong></span></td>
											  <td><span class="f12small"><strong><?=$bill_address?></strong></span></td>
											  <td></td>
											</tr>
											<tr height="25">
											  <td></td>
											  <td valign="top"><span class="f12small"><strong>สถานที่จัดส่ง</strong></span></td>
											  <td><span class="f12small"><strong><?=$shipping_address?></strong></span></td>
											  <td></td>
											</tr>
											<tr height="25">
											  <td></td>
											  <td><span class="f12small"><strong>วิธีการชำระเงิน</strong></span></td>
											  <td><span class="f12small"><strong>
											  <? 
											  $sql_pay = sql_Select(1,$prefix."_order","order_id = '".$_SESSION['o_id']."'",0);
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
											</strong></span></td>
											  <td></td>
											</tr>
											<? if($bank_detail != ""){?>
											<tr height="25">
											  <td></td>
											  <td>&nbsp;</td>
											  
											  <td colspan="2"><span class="f12small"><strong><?=$order_payment_at_bank?><BR><?=$bank_detail?></strong></span></td>
											</tr>
											<?
											
											 }  ?>
											<tr height="25">
											  <td></td>
											  <td><span class="f12small"><strong>เลขที่ใบสั่งซื้อ</strong></span></td>
											  <td><span class="f12small"><strong><?=$order_name?></strong></span></td>
											  <td></td>
											</tr>
											<tr>
											  <td></td>
											  <td colspan="2"><img src="images/btn_confirm.gif" width="187" height="25" onclick="<?=$link_to?>" onMouseOver="this.style.cursor='hand';"></td>
											</tr>
											<input type="hidden" name="msg_txt" value="<?=$msg_txt?>" />
 </form>
										  </table>
										</td>
									</tr>
									<tr> 
									  <td  align="right">
										</td>
									</tr>
									<form name="sendform" method="post" 
action="https://rt05.kasikornbank.com/pgpayment/payment.aspx">
									<!-- <form name="sendform" method="post" 
action="pass_kbak.php?confirmdata=<?=session_id()?>&order_name=<?=$order_name?>">      -->
<input type="hidden" id=MERCHANT2 name=MERCHANT2 value="451005030393001"> 
<input type="hidden" id=TERM2 name=TERM2 value="70347418"> 
<input type="hidden" id=AMOUNT2 name=AMOUNT2 value="<?=$g_total_send?>"> 
<input type="hidden" id=URL2 name=URL2 
value="http://www.jenbunjerd.com/step-5.php?confirmdata=<?=session_id()?>&order_name=<?=$order_name?>"> 
<input type="hidden" id=RESPURL name=RESPURL value=""> 
<input type="hidden" id=IPCUST2 name=IPCUST2 value="61.91.126.22">   
<input type="hidden" id=DETAIL2 name=DETAIL2 value="Jenbunjerd Product"> 
<input type="hidden" id=INVMERCHANT name=INVMERCHANT value="<?=$order_name?>"> 
<input type="hidden" id=FILLSPACE name=FILLSPACE value="Y">  
</form> 
								  </table>

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
<? //echo "<BR>test ".$order_total_sql.$order_total_sql2.$limits.$flag;  print_r($resultr);?>
<div><?php include "footer.php"; ?></div>
</html>
