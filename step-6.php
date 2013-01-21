<? session_start();
	   include "config.php";
	   require("clsMailer.php");
	   $orderid = $_GET['orderid'];
	   $mem_email = getn('members_email',"members","members_id = '".$_SESSION['members_id']."' ");
	    $order_sql = sql_Select(1, $prefix."_order", "order_id = '$orderid'", 0);
		//echo  $order_sql ;
		$order_query = $db->sql_query($order_sql);
		$result = $db->sql_fetchrow($order_query);


		//	$members_id = stripslashes($result['members_id']);
		$order_bill_title=stripslashes($result['order_bill_title']);
		$order_bill_title_val = getn("title_name","title","title_id='$order_bill_title'");
		$order_bill_fname=stripslashes($result['order_bill_fname']);
		$order_bill_lname=stripslashes($result['order_bill_lname']);
		$order_bill_phone=stripslashes($result['order_bill_phone']);
		$order_bill_department=stripslashes($result['order_bill_department']);
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
		$order_shipping_department=stripslashes($result['order_shipping_department']);
		$order_shipping_company=stripslashes($result['order_shipping_company']);
		$order_shipping_addresstype=stripslashes($result['order_shipping_addresstype']);
		$order_shipping_address=stripslashes($result['order_shipping_address']);
		$order_shipping_district_code=stripslashes($result['order_shipping_district_code']);
		$order_shipping_amphur_code=stripslashes($result['order_shipping_amphur_code']);
		$order_shipping_province_code=stripslashes($result['order_shipping_province_code']);
		$order_shipping_postcode=stripslashes($result['order_shipping_postcode']);
		$order_shipping_country=stripslashes($result['order_shipping_country']);
		$order_name = stripslashes($result['order_name']);
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
		//	$order_namerun = getn("count()")+1;

					  $sql_pay = sql_Select(1,$prefix."_order","order_id = '".$orderid."'",0);
					  $query_pay = $db->sql_query($sql_pay );
					  $rs_pay = $db->sql_fetchrow($query_pay );
					  $order_payment = $rs_pay['order_payment'];
					  $order_payment_at_bank = $rs_pay['order_payment_at_bank'];
					 $bank_detail = getn("bank_detail","bank","bank_name = '$order_payment_at_bank' and bank_status='1'");
					  switch ($order_payment)
					  {   
						case "Cash" : $order_payment_txt="โอนเงินเข้าบัญชีธนาคาร <BR>";  
					
						break; 
						case "CreditTerm" : $order_payment_txt="ขอใช้ระบบสินเชื่อ";   
					
						break;
						case "CreditCard" : $order_payment_txt="ชำระเงินผ่านบัตรเครดิต";  
							
						break;
					
					  }
										
									
											  
					$msg_ = " <table cellspacing='1' cellpadding='0' border='0'  width='100%' bgcolor='#D3A219'>
							  <tr align='center' height='35'> 
								<td width='45%'><b><font color='#FFFFF'>สินค้า</font></b></td>
								<td width='20%'><b><font color='#FFFFF'>ราคา/หน่วย</font></b></td>
								<td width='15%'><b><font color='#FFFFF'>จำนวน</font></b></td>
								<td width='20%'><b><font color='#FFFFF'>รวมเงิน</font></b></td>
							  </tr>";
							 $cart_sql = sql_Select(1, $prefix."_order_b", "order_id = '$orderid'", 0);
							//echo  $cart_sql ;
							$cart_query = $db->sql_query($cart_sql);										
							$total_item = $db->sql_numrows($cart_query);
							
							if ($total_item > 0 ){
							while ( $cart = $db->sql_fetchrow($cart_query))
								{
									$orderb_id=$cart['orderb_id'];
									$order_id=$cart['order_id'];
									$products_id=$cart['products_id'];
									$price=$cart['price'];
									$amount=$cart['amount'];
									$discountprice=$cart['discountprice'];
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
									$products_id=$result['products_id'];
									$products_name=stripslashes($result['products_name']);
									$products_model=stripslashes($result['products_model']);
									$products_jb_no=stripslashes($result['products_jb_no']);
									$products_description=$result['products_description'];
									$products_description = str_replace("\n","<br>",$products_description);		
									$products_mainpic=$result['products_mainpic'];
									$products_status=$result['products_status'];
									$categories_id=$result['categories_id'];

									 if ( $products_mainpic )	{
									$widthsize=getimagesize("backend/$products_path/$products_mainpic"); 
									$old_w=$widthsize[0]; 
									$old_h=$widthsize[1]; 		
									}
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
							 if ($products_mainpic == "" ) $pic = "backend/$products_path/nopic.jpg";


							$transoprt =getn("order_transportation","order","order_id = '$orderid'");
							//echo $grantotal;
							//$grantotal = $grantotal +$transoprt;
							$vat_ = 	($grantotal +$transoprt) * ($setting_tax/100);
							$g_total = $grantotal +$transoprt+$vat_;
							$g_total_send=$g_total *100;  // for send to bank
																			
									
								//	$totaldis = $totaldis + ($price - $products_discountprice)*$amout;
							$msg_ .= "
									<tr bgcolor='#ffffff'><td colspan='4' >
												 <table width='100%'  border='0'  class='tblcart'>
									<tr> 
									  <td align='right' width='80%'><span class='f12small'><b>รวมเงิน (ไม่รวมVAT) </span>
										: </b></td><td align='right'><span class='f12small'>".number_format($grantotal+$order_promotion, 2, '.', ',')." </span></td><td align='right'><span class='f12small'>บาท&nbsp;&nbsp;</span></td>
									</tr>";
									$order_payment =getn("order_payment","order","order_id = '$orderid' "); 
									$str_ =  "style='display:none'"; 
											if ($order_payment == "Cash") {  
												   $str_ =  ""; 
													//$grantotal = $grantotal - $totaldis - $total_percent_baht;
													//promotion
													$grantotal = ($transoprt+$grantotal- $total_percent_baht);  //after minus discount percent
													$vat_ = 	$grantotal* ($setting_tax/100);
													$update_cash  =  sql_Update($prefix."_order","order_total ='$grantotal' , order_tax='$vat_' ","order_id '".$_SESSION['o_id']."'");	
													$save_query = $db->sql_query($update_cash);
											 }
											 else{
													$grantotal = ($grantotal + $transoprt);  //after minus discount percent
													$vat_ = 	$grantotal* ($setting_tax/100);
											 }
													$g_total = $grantotal+$vat_;
													if ($order_payment == "CreditCard") $g_total_send=$g_total *100;
													else $g_total_send=0;
									 /*
									 
									<tr> 
									  <td align='right'><font size='1' face='MS Sans Serif, Tahoma, sans-serif'><b>ส่วนลด
										: </b> </font></td><td align='right'><font color='red' size='1' face='MS Sans Serif, Tahoma, sans-serif'>". number_format($totaldis*-1, 2, '.', ',')." </font></td><td align='right'><font color='red' size='1' face='MS Sans Serif, Tahoma, sans-serif'>บาท&nbsp;&nbsp;</font></td>
									</tr>
									*/
									
									$msg_ .= "</tr>
									<tr> 
									  <td align='right' width='80%'><span class='f12small'><b>ส่วนลดโปรโมชั่น 
										: </b>,</span></td><td align='right'><span class='f12small'>".number_format($order_promotion, 2, '.', ',')."</span></td><td align='right'><span class='f12small'>บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr $str_> 
									  <td align='right' width='80%'><span class='f12small'><b>ส่วนลด 1% (ชำระเงินสด) </span>
										: </b></td><td align='right'><font color='red'><span class='f12small'>".number_format(($total_percent_baht), 2, '.', ',')." </span></td><td align='right'><font color='red'><span class='f12small'>บาท&nbsp;&nbsp;</span></td>
									<tr> 
									  <td align='right'><span class='f12small'><b>ค่าขนส่ง</span>
										: </b></td><td align='right'><span class='f12small'>".number_format($transoprt, 2, '.', ',')."</span></td><td align='right'><span class='f12small'>บาท&nbsp;&nbsp;</span></td>
									</tr>
										<tr> 
									  <td align='right' width='80%'><span class='f12small'><b>รวมเงิน (ไม่รวมVAT) </span>
										: </b></td><td align='right'><span class='f12small'>".number_format($grantotal, 2, '.', ',')." </span></td><td align='right'><span class='f12small'>บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td align='right'><span class='f12small'><b>ภาษีมูลค่าเพิ่ม(VAT)
										: </b></td><td align='right'><span class='f12small'>".number_format($vat_, 2, '.', ',')." </span></td><td align='right'><span class='f12small'>บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td align='right'><span class='f12small'><b>รวมเงินทั้งหมด : 
										</b> </td><td align='right'><span class='f12small'> ".number_format($g_total, 2, '.', ',')." </span></td><td align='right'><span class='f12small'>บาท&nbsp;&nbsp;</span></td>
									</tr>
									<tr> 
									  <td  align='left' colspan='3'><BR><BR>
										  <table class='tblcart' class='f12small'>
											<tr height='25'>
											  <td></td>
											  <td valign='top'><strong>ชื่อ-นามสกุลผู้ติดต่อ</strong></td>
											  <td><strong>$member_info</strong></td>
											</tr>
											<tr height='25'>
											  <td></td>
											  <td valign='top'><strong>สถานที่ออกใบกำกับภาษี</strong></font></td>
											  <td><strong>$bill_address</strong></td>
											  <td></td>
											</tr>
											<tr height='25'>
											  <td></td>
											  <td valign='top'><strong>สถานที่จัดส่ง</strong></td>
											  <td><strong>$shipping_address</strong></td>
											  <td></td>
											</tr>
											<tr height='25'>
											  <td></td>
											  <td><strong>วิธีการชำระเงิน</strong></font></td>
											    <td><strong>$order_payment_txt <br>$order_payment_at_bank</font></strong></td>
											  <td></td>
											</tr><tr height='25'>
											  <td></td>
											  <td>&nbsp;</td>
											  
											  <td colspan='2'>$bank_detail</td>
											</tr>
											<tr height='25'>
											  <td></td>
											  <td><strong>เลขที่ใบสั่งซื้อ</strong></td>
											  <td><strong>$order_name</strong></td>
											  <td></td>
											</tr></table>
												</td></tr></table>";
												
					//	echo $order_payment_txt;
					
											} 
											$msg_ .= "</table>";
			
			$to_member=getn("members_email","members","members_id = '".$members_id."' ");
			$toadminJB="cataloguesales@jenbunjerd.com";
			$subject="Order " . $order_name . " :: JENBUNJERD CO LTD"; 
			//$subject="Order Detail :: JB Materials Handling Group"; 
			$header="From:$to <info@jenbunjerd.com>\nContent-Type:text/html;charset=utf-8\n";
			
			//$to_sup[0]	= "webprogram@jenbunjerd.com" ;
			$to_sup[1]	= "cats-tm@jenbunjerd.com";
			$to_sup[0] =  "cats-dm@jenbunjerd.com";
			$cc[0] =  $to_member ;
			$bcc[0] =  "it1@jenbunjerd.com";
			$bcc[1] =  "fn1@jenbunjerd.com";
			$bcc[2] =  "fn2@jenbunjerd.com";
			$bcc[3] =  "fn3@jenbunjerd.com";
			//$bcc[4] =  "mc@jenbunjerd.com";

			sendmail($to_sup,$subject,$msg_,$cc,$bcc);   //To member

			//$cc[0] =  "cats-dm@jenbunjerd.com";
			//$cc[1] =  "cats-tm@jenbunjerd.com";
			//$bcc[0] =  "it1@jenbunjerd.com";
			//sendmail($to_member,$subject,$msg_,$cc,$bcc);   //To member

			//mail($to_member,$subject,$msg_,$header);   //To member
			//mail($toadminJB,$subject,$msg_,$header);    //Admin JB

/*
//$o_id = $_SESSION['o_id']; 
//echo "transportation=".$transportation;
	if ($transportation){ // update shipping
		$transportation = $_REQUEST['transportation'];
		$update  =  sql_Update($prefix."_order","order_transportation = '$transportation' ,order_total ='$order_total'","order_id = '$orderid'  ");		
		//echo $update; exit;
		$save_query = $db->sql_query($update);
		
		if ($save_query) echo "<meta http-equiv=\"refresh\" content=\"0;URL=step-4.php\">";
		else{
			echo "<script>alert('Please try Again .. !!');</script>";
			if ($save_query) echo "<meta http-equiv=\"refresh\" content=\"0;URL=step-3.php\">";
		}
	}
	*/
						
					$order_sql = sql_Select(1, $prefix."_order", "order_id = '$orderid'", 0);
					//echo  $order_sql ;
					$order_query = $db->sql_query($order_sql);
					$result = $db->sql_fetchrow($order_query);
					$order_bill_title=stripslashes($result['order_bill_title']);
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
					$order_shipping_title_val = getn("title_name","title","title_id ='$order_shipping_title' ");
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
					
					$shipping_district = getn("dirstict_name","district","district_code = $order_bill_district_code");
					$shipping_amphur = getn("amphur_name","amphur","amphur_code = $order_shipping_amphur_code");
					$shipping_province = getn("province_name","province","province_code = $order_shipping_province_code");
		$shipping_address = " $order_shipping_title_val  $order_shipping_fname  $order_shipping_lname  $order_bill_company $order_shipping_address &nbsp;$shipping_district &nbsp;$shipping_amphur &nbsp;$shipping_province &nbsp;$order_shipping_postcode เบอร์โทรศัพท์ $order_shipping_phone";
			$bill_address = " $order_bill_adderss &nbsp;$bill_district &nbsp;$bill_amphur &nbsp;$bill_province &nbsp;$order_bill_post";
					  	$sum_total= getn("sum(price*amount)","order_b","order_id='$o_id' ");
						$order_shipping_post = getn("order_shipping_post","order","order_id='$o_id' ");
						
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" href="css/clsFont.css" type="text/css" media="screen" />
<? include "set_title.php"; ?>
<title><? echo $title; ?></title>

<meta http-equiv="Content-Type" content="text/html; charset=tis-620">

<script language="javascript" src="js/win_func.js"></script>
<script language="JavaScript">
			<!--
			function checkvalues4()
			{	
					 document.getElementById("frm_member").submit();	
			}
			-->
	  </script>
<style type="text/css">
<!--
.style17 {font-family: "MS Sans Serif", sans-serif, serif; font-weight: bold; font-size: 9px; color: #000000; }
-->
</style>
</head>

<body>

<div><? include "header.php"; ?></div>

<div class='Div_Content'>

	<table width="990" border="0" align="center" cellpadding="0" cellspacing="0">
	 	  <form name="frm_member" id="frm_member" method="POST" > 
             

	  <tr valign="top">

		<td width="244">

		<table width="244" height="100%" border="0" cellpadding="1" cellspacing="0">

		  <tr>

			<td width="244" valign="top"><? include "left.php"; ?></td>

		  </tr>

		</table>		</td>

		<td>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">

		  <tr>

			<td>&nbsp;</td>

		  </tr>

		</table>

				  <? include("banner.php");?>
				  <br />
		  <table width="729" border="0" cellspacing="0" cellpadding="0">
              <tr>
			
                <td width="21" valign="top">&nbsp;</td>
                <td valign="top" bgcolor="#E4A301"><img src="images/2address-book-registered-2_03.jpg" width="92" height="38" alt="" onclick="document.location='step-1.php';" onmouseover="this.style.cursor='hand';" /><img src="images/3shipping-options_04.jpg" width="85" height="38" alt=""   onclick="document.location='step-2-2.php';" onMouseOver="this.style.cursor='hand';"/><img src="images/6-order-completed_05.jpg" width="85" height="38" alt="" /><img src="images/2address-book-registered-2_06.jpg" width="86" height="38" alt="" /><img src="images/2address-book-registered-2_07.jpg" width="114" height="38" alt="" /><img src="images/6-order-completed_08.jpg"" width="97" height="38" alt="" /> </td>
              </tr>
              <tr>
                <td valign="top">&nbsp;</td>
                <td valign="top">&nbsp;</td>
              </tr>
          </table>
			<table width="729" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top"><img src="images/2_header_box.gif" width="729" height="22" /></td>
              </tr>
              <tr>
                <td valign="top" background="images/2_bg_box.gif"><table width="680" border="0" align="center" cellpadding="1" cellspacing="1">
                    <tr>
                      <td><table width="98%">
                          <tr>
                            <td width="60"><div align="right" background="images/6-order-completed_12.jpg"></div></td>
                            <td width="128"><span class="forage"> <strong>การสั่งซื้อเสร็จสมบูรณ์</strong></span></td>
							<td  align='right'><img src="images/printButton.png" width="16" height="16"  onmouseover="this.style.cursor='hand';" onclick="window.open('reportPO.php?id=<?=$orderid; ?>&o_id=<?=$_SESSION['o_id']; ?>','mywindow','scrollbars=1,width=1000,height=700')"></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><table width="95%" border="0">
  <tr>
    <td align="right" colspan="4"><div align="left"><span class="f12small"><strong>&nbsp;ขอบคุณที่เลือกใช้บริการเรา !!</strong></span></div></td>
  </tr>
  <tr>
    <td width="8%"  align="right"></td>
    <td width="12%"><img src="images/6-order-completed_18.jpg" /></td>
    <td width="63%" rowspan="2" ><span class="f12small"><strong>เจ้าหน้าที่ Catalogue Sales จะตอบรับคำสั่งซื้อให้ทราบโดยเร็วที่สุด</strong></span><span class="f12small"><strong>หากท่านไม่ได้รับการตอบกลับภายใน 8 ชั่วโมงทำการ &nbsp;</strong></span>&nbsp;<span class="f12small"><strong>กรุณาแจ้ง Catalogue Sales โทร 02-984-0909 (20 คู่สาย)</strong></span></td>
    <td width="17%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
    <td >&nbsp;</td>
  </tr>
  <tr >
  <td colspan="4">
  
  </td>
  </tr>
</table>
</td>
                    </tr>
                    
                    <tr>
                      <td><?=$msg_?></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td valign="top"><img src="images/2_bottom_box.gif" width="729" height="37" /></td>
              </tr>
            </table>
			<br />
		<br /></td>
	  </tr>
</form>
</table>





			<!-- End -->  



		   </td>

		<td>&nbsp;</td>

	  </tr>

	</table>



</div>

<div><?php include "footer.php"; ?></div>

</html>

