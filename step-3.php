<?
session_start();
include "config.php";
//echo $_SESSION['members_id']."sdfadsf";
$o_id = $_SESSION['o_id']; 
$order_total = $_POST['order_total'];  // hidden
//echo "order_total = ".$order_total;
	if ($order_total){ // update shipping
		$transportation = $_REQUEST['transportation']; //hidden
	//	$order_total = $_REQUEST['order_total'];
		//$order_tax = $order_total*($setting_tax/100);
		$order_total= getn("sum( ( price - discountprice ) *amount)","order_b","order_id='$o_id' ");
		$total_order =  $order_total + $transportation; // recalculate
		$order_tax =$total_order*($setting_tax/100);

		$perpoint = $setting_bahtperpoint;
		$thisorder_point = floor(($total_order-$transportation)/$perpoint);

		$update  =  sql_Update($prefix."_order","order_status='Wait',order_transportation = '$transportation' ,order_total ='$total_order' , order_tax='$order_tax',order_reward_perpoint='$setting_bahtperpoint',order_reward_point='$thisorder_point' ","order_id = '$o_id'  ");		
		//echo $update; exit;
		$save_query = $db->sql_query($update);
		
		if ($save_query) {
			echo '<div id="loading" style="filter:alpha(opacity=30)"><table width="100%" height="100%"><tr><td valign="middle" align="center"><font face="MS Sans Serif" size="4" color="#333333"><B>Loading . . . . </B><br><br> <img src="imgs/loading.gif"></font></td></tr></table></div>';
			echo "<meta http-equiv=\"refresh\" content=\"0;URL=step-4.php\">";
		}
		else{

			if ($save_query) echo "<meta http-equiv=\"refresh\" content=\"0;URL=step-3.php\">";
		}
		exit;
	}
						
					$order_sql = sql_Select(1, $prefix."_order", "order_id = '$o_id'", 0);
					//echo  $order_sql ;
					$order_query = $db->sql_query($order_sql);
					$result = $db->sql_fetchrow($order_query);
					$order_bill_title=stripslashes($result['order_bill_title']);
					$order_bill_fname=stripslashes($result['order_bill_fname']);
					$order_bill_lname=stripslashes($result['order_bill_lname']);
					$order_bill_phone=stripslashes($result['order_bill_phone']);
					$order_bill_company=stripslashes($result['order_bill_company']);
					$order_bill_addresstype=stripslashes($result['order_bill_addresstype']);
					$order_bill_address=stripslashes(trim($result['order_bill_address']));
					$order_bill_district_code=stripslashes($result['order_bill_district_code']);
					$order_bill_amphur_code=stripslashes($result['order_bill_amphur_code']);
					$order_bill_province_code=stripslashes($result['order_bill_province_code']);
					$order_bill_postcode=stripslashes($result['order_bill_postcode']);
					$order_bill_country=stripslashes($result['order_bill_country']);
					$order_shipping_title=stripslashes($result['order_shipping_title']);
					$order_shipping_title_val = getn("title_name","title","title_id ='$order_shipping_title' ");
					$order_shipping_fname=stripslashes($result['order_shipping_fname']);
					$order_shipping_lname=stripslashes($result['order_shipping_lname']);
					$shipping_name = $order_shipping_title_val.$order_shipping_fname." &nbsp; ".$order_shipping_lname;
					$order_shipping_phone=stripslashes($result['order_shipping_phone']);
					$order_shipping_department=stripslashes($result['order_shipping_department']);
					$order_shipping_company=stripslashes($result['order_shipping_company']);
					$order_shipping_addresstype=stripslashes($result['order_shipping_addresstype']);
					$order_shipping_address=stripslashes(trim($result['order_shipping_address']));
					$order_shipping_district_code=stripslashes($result['order_shipping_district_code']);
					$order_shipping_amphur_code=stripslashes($result['order_shipping_amphur_code']);
					$order_shipping_province_code=stripslashes($result['order_shipping_province_code']);
					$order_shipping_postcode=stripslashes($result['order_shipping_postcode']);
					$order_shipping_country=stripslashes($result['order_shipping_country']);
					
					$billing_district = getn("district_name","district","district_code = $order_bill_district_code"); 
					//echo "billing_district=$billing_district_"; //exit;
					$billing_amphur = getn("amphur_name","amphur","amphur_code = $order_bill_amphur_code");
					$billing_province = getn("province_name","province","province_code = $order_bill_province_code");
					$shipping_district = getn("district_name","district","district_code = $order_shipping_district_code");
					$shipping_amphur = getn("amphur_name","amphur","amphur_code = $order_shipping_amphur_code");
					$shipping_province = getn("province_name","province","province_code = $order_shipping_province_code");

					if ($order_bill_province_code == "00001"){
						$shipping_address = " $order_shipping_address แขวง$shipping_district เขต$shipping_amphur จังหวัด$shipping_province &nbsp;$order_shipping_postcode";									
					}
					else{
						$shipping_address = " $order_shipping_address ตำบล$shipping_district อำเภอ$shipping_amphur จังหวัด$shipping_province &nbsp;$order_shipping_postcode";
					}

					if ($order_shipping_province_code == "00001"){
						$bill_address = " $order_bill_address แขวง$billing_district เขต$billing_amphur จังหวัด$billing_province &nbsp;$order_bill_postcode";							
					}
					else{
						$bill_address = " $order_bill_address ตำบล$billing_district อำเภอ$billing_amphur จังหวัด$billing_province &nbsp;$order_bill_postcode";
					}
					  	$sum_total= getn("sum( ( price - discountprice ) *amount)","order_b","order_id='$o_id' ");
						//echo "sum_total=$sum_total";
						$order_shipping_amphur_code = getn("order_shipping_amphur_code","order","order_id='$o_id' ");
					$sql_tran = sql_Select(1,$prefix."_transport","transport_amphur_code='$order_shipping_amphur_code' ",0);
						$query_tran = $db->sql_query($sql_tran);
						while($rs_tran=$db->sql_fetchrow($query_tran))
						{
							$transport_checktran  = $rs_tran['transport_checktran'];
							$lowerprice = $rs_tran['transport_lowerprice'];
							$transport_lowerbath = $rs_tran['transport_lowerbath'];
							$trasport_kg   = $rs_tran['trasport_kg'];
					//	echo "<br>trasport_kg = $trasport_kg <br>";
						}
						
						$iscalculate = true;
						if($transport_checktran =='1')
						{		
							//if($sum_total > $lowerprice) {
							$transportation_val = 0; $total_tran_val =0;$iscalculate=false;
							//}
						}
						if($iscalculate == true)
						{
							$sql_pro=sql_Select(1,$prefix."_order_b","order_id='$o_id' ",0);
							$query_pro = $db->sql_query($sql_pro);
							while($rs_pro=$db->sql_fetchrow($query_pro))
							{
								$products_id  = $rs_pro['products_id'];
								$cal_amount  = $rs_pro['amount'];								
								$cal_sql = sql_Select(1,$prefix."_products","products_id='$products_id'",0);
								$cal_query = $db->sql_query($cal_sql);
								while($cal_rs=$db->sql_fetchrow($cal_query))
								{
									$products_cal_method= $cal_rs['products_cal_method'];
									$cal_w = $cal_rs['products_cal_w'];
									$cal_h = $cal_rs['products_cal_h'];
									$cal_t = $cal_rs['products_cal_t'];
									$cal_b = $cal_rs['products_cal_b'];
									$cal_p = $cal_rs['products_cal_p'];
									$cal_weight = $cal_rs['products_cal_weight'];
								} //while($cal_rs=$db->sql_fetchrow($cal_query))
							$total_weight1 = $cal_weight *$cal_amount;
								switch ($products_cal_method)
								{
								case 1: $total_weight2 =((($cal_w/10)*($cal_h/10)*($cal_t/10))/2500)*$cal_amount ;break;
								case 2 : $total_weight2 =(((($cal_w/10)*($cal_h/10)*($cal_t/10))  + (($cal_w/10)*($cal_h/10)*($cal_b/10))*($cal_amount-1)) / 2500);break;
								case 3:
								$amount2 = $cal_amount%3;
								$amount1 = ($cal_amount -$amount2)/3;
											
												$total_weight2 =(((($cal_w/10)*($cal_h/10)*($cal_t/10) * $amount1)+ (($cal_w/10)*($cal_h/10)*($cal_t/10)*$amount2)) / 2500);break;
								case 4:$total_weight2 =((($cal_w/10)*($cal_h/10)*($cal_t/10))/2500)*$cal_amount ;break;
								case 5:$amount2 = $cal_amount%$cal_p;
								$amount1 = ($cal_amount -$amount2)/$cal_p;
								if($amount2>0)$amount2=1;
											
												$total_weight2 =(((($cal_w/10)*($cal_h/10)*($cal_t/10) * $amount1)+ (($cal_w/10)*($cal_h/10)*($cal_t/10)*$amount2)) / 2500);break;
								} //switch ($products_cal_method)
							if($total_weight1 > $total_weight2)$total_weight2=$total_weight1;
							$total_trans = $trasport_kg*$total_weight2;
							$transportation_val = $total_trans;
						//	echo "$products_id transportation_val=".$transportation_val ."<br>";
								$total_tran_val = $total_tran_val+$transportation_val;
							}//while($rs_pro=$db->sql_fetchrow($query_pro))
						//	echo "<br>total_weight2 = $total_weight2 <br>";
						//	echo "<br>otal_weight1 = $total_weight1 <br>";
						//	echo "<br>transport_lowerbath = $transport_lowerbath <br>";
							
						//	echo "t<br>transportation_val = $transportation_val <br>";
							if($transport_lowerbath > $total_tran_val ){$total_tran_val =$transport_lowerbath;}
						//	echo "t<br>trasport_kg = $trasport_kg <br>";
						
						}// 	if($iscalculate == true)
					  
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
	 	  <form name="frm_member" id="frm_member" method="POST" action="">
		  <tr valign="top">
		<td width="244">
		<table width="244" height="100%" border="0" cellpadding="1" cellspacing="0">
		  <tr>
			<td width="244" valign="top"><? include "left.php"; ?></td>
		  </tr>
		</table></td>
		<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td>&nbsp;</td>
		  </tr>
		</table>
			<!-- Start -->
			<? include("banner.php");?>		  <br />
		  <table width="729" border="0" cellspacing="0" cellpadding="0">
              <tr>
			
                <td width="21" valign="top">&nbsp;</td>
                <td valign="top" bgcolor="#E4A301"><img src="images/2address-book-registered-2_03.jpg" width="92" height="38" alt="" onclick="document.location='step-1.php';" onmouseover="this.style.cursor='hand';" /><img src="images/3shipping-options_04.jpg" width="85" height="38" alt=""   onclick="document.location='step-2-2.php';" onMouseOver="this.style.cursor='hand';"/><img src="images/3shipping-options_05.jpg" width="85" height="38" alt="" /><img src="images/2address-book-registered-2_06.jpg" width="86" height="38" alt="" /><img src="images/2address-book-registered-2_07.jpg" width="114" height="38" alt="" /><img src="images/2address-book-registered-2_08.jpg" width="97" height="38" alt="" /></td>
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
                      <td><table width="337">
                          <tr>
                            <td width="21"><div align="right"><img src="images/3_number3.gif" width="20" height="20" /></div></td>
                            <td width="250"><span class="forage"><strong>ตรวจสอบสถานที่จัดส่งสินค้า</strong></span></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0">
  <tr height="22">
    <td width="30%" align="right" ><span class="f12small"><strong>ส่งสินค้าถึง : &nbsp;&nbsp;</strong></span></td>
    <td width="70%"><span class="f12small"><strong><?=$shipping_name?>
					  </strong></span></td>
  </tr>
  <tr height="22">
    <td width="30%" align="right" ><span class="f12small"><strong>แผนก : &nbsp;&nbsp;</strong></span></td>
    <td width="70%"><span class="f12small"><strong><?=$order_shipping_department?>
					  </strong></span></td>
  </tr>
  <tr height="22">
    <td  align="right"><span class="f12small"><strong>บริษัท : &nbsp;&nbsp;</strong></span></td>
    <td><span class="f12small"><strong> <?=$order_shipping_company?>&nbsp;</strong></span></td>
  </tr>
  <tr height="22">
    <td width="30%" align="right" ><span class="f12small"><strong>ที่อยู่บริษัท : &nbsp;&nbsp;</strong></span></td>
    <td width="70%"><span class="f12small"><strong><?=$bill_address?>
					  </strong></span></td>
  </tr>
  <tr height="22">
    <td width="30%" align="right" ><span class="f12small"><strong>สถานที่จัดส่งสินค้า : &nbsp;&nbsp;</strong></span></td>
    <td width="70%"><span class="f12small"><strong><?=$shipping_address?>
					  </strong></span></td>
  </tr>
  <tr height="22">
    <td width="30%" align="right" ><span class="f12small"><strong>เบอร์โทรสถานที่จัดส่งสินค้า : &nbsp;&nbsp;</strong></span></td>
    <td width="70%"><span class="f12small"><strong><?=$order_shipping_phone?>
					  </strong></span></td>
  </tr>
  <tr height="22">
    <td  align="right"><span class="f12small"><strong>ค่าขนส่งสินค้า : &nbsp;&nbsp;</strong></span></td>
</span>  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>  <input id="transportation" name="transportation" type="hidden" value="<?=$total_tran_val;?>" size="5" />
             <input id="order_total" name="order_total" type="hidden" value="<?=$sum_total?>" size="5"/>
				</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td ><img src="images/btn_checkout.gif" width="187" height="25" onclick="checkvalues4()" onmouseover="this.style.cursor='hand';" /></td>
  </tr>
</table>
</td>
                    </tr>
                    
                    <tr>
                      <td><table width="90%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="68%">&nbsp;</td>
                            <td width="32%" height="40">&nbsp;</td>
                          </tr>
                      </table></td>
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

