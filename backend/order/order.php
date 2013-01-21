<?php

		$sessionid = session_id();
		$deleted = "Cancel";
		$wait = "Waiting";
		$preparing = "Preparing";
		$completed ="Completed";

function datalist()
{

						global  $db;
						global $prefix;
						global $theme_tab1;
						global $theme_tab2;
						global $theme_tab3;
						global $wait,$deleted,$preparing,$completed;
						global $perpage,$setting_tax;					

						$opt = get_var('opt','request',0);
						$con_opt = "";
						
						if ( $opt == "Wait" ) $con_opt = " and order_status = 'Wait' ";
								else  if ( $opt == "Preparing" )   $con_opt = " and order_status = 'Preparing' ";
											else  if ( $opt == "Completed" )   $con_opt = " and order_status = 'Completed' ";
														else  if ( $opt == "Deleted" )   $con_opt = " and order_status = 'Deleted' ";						

?><head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<script language="JavaScript">
<!--
function Confirm(id){
		if(confirm("Do you want delete ?")){
			// ok
			document.location= "<?php  echo "index.php?method=order&process=deleted&opt=$opt&order_id=";?>" +id;
			}
		else{
			// cancel
			return;
		}	
	}
function Change_MaxPage(maxpage){
		document.location="<?php echo "index.php?method=order&process=list&opt=$opt&current=1&per_page="; ?>" + maxpage + '<?php echo "&sequence=$sequence"; ?>';
	}
	
	function Create(){
		document.location="<?php echo "index.php?method=order&process=formcreate&opt=$opt"; ?>";
	}

	function Searchorder(){
		document.location="<?php echo "index.php?method=order&process=formsearch&opt=$opt"; ?>";
	}

	function change_page(go_page){
		document.location= go_page;
	}	
	
	
	function Record_MouseClick(id){
		document.location="<?php echo "index.php?method=order&process=detail&opt=$opt&order_id=";?>" +id;
	}	

	-->
</script>
<?php							
									
									$order = get_var('order','request',0);
									$current = get_var('current','request',0);
									$per_page = get_var('per_page','request',0);
									$sequence = get_var('sequence','request',0);
									$msg = get_var('msg','request',0);									
									
									$list_sql = sql_Select(1, $prefix."_order", " members_id > 0 and order_status <> '' and order_delete = 0  $con_opt" , 0);
									//$list_sql .= "";
									//echo "<br>$list_sql";
									$list_query = $db->sql_query($list_sql);
									//echo "<br>$list_guery";
									$totalrec = $db->sql_numrows($list_query);
									//echo "<br>$totalrec<br>";	
									$num = $totalrec; 				//$per_page = $pagesize;

									if (!$per_page) $per_page=$perpage;
		  							if (!$current)   $current  = 1;

									if ($num <$per_page) 
									$amount = 1;
												else if ($num%$per_page == 0)
																	$amount = $num/$per_page;
 	       						 						else
																    $amount = ceil($num/$per_page);

		
								if ($current > 1)  $prv = $current -1;

								if ($current < $amount )  $next = $current+1;
		
								$startpage = $current*$per_page - $per_page;
							
								if (!$order) $order="order_id";
								if (!$sequence) $sequence="DESC";
								$list_sql .= " ORDER BY $order $sequence LIMIT $startpage,$per_page";								
								//echo $list_sql;
								$list_query = $db->sql_query($list_sql);
								

?>
<form action="index.php?method=order&process=deletedmany&opt=<?=$opt?>" method="post"  name="myForm"  onsubmit='if(confirm("Do you want delete ?")) return true; else return false;'>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" height="26" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="<?php echo $theme_tab3;?>">	
	<tr>
	<td align=right colspan=10 bgcolor=#FFFFFF height=25>
	<input type="button"  name="btCreate2" value="Search Order"onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Searchorder() ;">
	<SELECT NAME="opt" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value" style="BACKGROUND-COLOR: <?php echo $theme_tab3;?>; ">
	 <OPTION value="index.php?method=order&process=list">All Status</OPTION>
	 <OPTION value="index.php?method=order&process=list&opt=Deleted" <?php if ($opt=='Deleted') echo "selected";?>><?=$deleted?></OPTION>
	 <OPTION value="index.php?method=order&process=list&opt=Wait" <?php if ($opt=='Wait') echo "selected";?>><?=$wait?></OPTION>
	 <OPTION value="index.php?method=order&process=list&opt=Completed" <?php if ($opt=='Completed') echo "selected";?>><?=$completed?></OPTION>
	 </SELECT>
	</td>
	</tr>
        <tr> 
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;&nbsp;Found</strong> &nbsp;
            <?php echo $num; ?> &nbsp; <strong>Records</strong> &nbsp; <?php echo $amount; ?> &nbsp;<strong> Page</strong></font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">|</font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>Page</strong>:&nbsp;</font></td>
          <td> <font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <select name="selpageno"  onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value">
              <?php
											for($ii=0;$ii<$amount;$ii++) { //วนใส่แสดง หน้าปัจจุบัน
									   			if(($ii+1) == $current){ 
													$selected = " selected"; 
												}
												else{ 
													$selected=""; 
												}
										?>
              <option value="<?php echo "index.php?method=order&process=list&opt=$opt&current=".($ii+1)."&per_page=$per_page&sequence=$sequence";?>"  <?php echo $selected; ?> > 
              <?php echo ($ii+1).'&nbsp;&nbsp;'; ?> </option>
              <?php
											}
										?>
            </select>
            &nbsp; 
            <?php if($current > 1 && $current != "" && $amount != 0){ ?>
            <a style="cursor: hand" onClick="location='<?php echo "index.php?method=order&process=list&opt=$opt&current=".($current-1)."&per_page=$per_page&sequence=$sequence"; ?>'"> 
            <img src="../imgs/prev_out.gif" alt="Previous page" name="prev_page" width="16" height="16" border="0" align="absmiddle"></a> 
            <?php }else{ ?>
            <img src="../imgs/prev_dis.gif" alt="Previous page" name="prev_dis" width="16" height="16" border="0" align="absmiddle">	
            <?php } ?>
            <?php if($current != $amount && $amount != 0){ ?>
            <a style="cursor: hand" onClick="location='<?php echo "index.php?method=order&process=list&opt=$opt&current=".($current+1)."&per_page=$per_page&sequence=$sequence"; ?>'"> 
            <img src="../imgs/next_out.gif" alt="Next page" name="next_page" width="16" height="16" border="0" align="absmiddle"></a> 
            <?php }else{ ?>
            <img src="../imgs/next_dis.gif" alt="Next page" name="next_dis" width="16" height="16" border="0" align="absmiddle">	
            <?php } ?>
            </font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">|</font></td>
          <td> <font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
            <input name="maxpage" type="text" class="inputTag" id="maxpage" 
										onChange="location='<?php echo "index.php?method=order&process=list&opt=$opt&current=1&per_page="; ?>'+maxpage.value+'<?php echo "&sequence=$sequence";?>' " value="<?php echo $per_page; ?>" size="2" maxlength="2">
            &nbsp; 
            <input type="button" class="buttonTag" name="btMaxPage" value="Ok" onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Change_MaxPage(myForm.maxpage.value)">
            &nbsp; </font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Records 
            per page</strong></font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">|</font></td>
          <td> <div align="right"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>Sort 
              :</strong>&nbsp; 
              <select name="sequence" id="sequence" class="inputTag" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value">
                <option value="<?php echo "index.php?method=order&process=list&opt=$opt&current=$current&per_page=$per_page&sequence=DESC"; ?>" <?php if($sequence == "DESC"){ echo "selected"; } ?>>Descending</option>
				<option value="<?php echo "index.php?method=order&process=list&opt=$opt&current=$current&per_page=$per_page&sequence=ASC"; ?>" <?php if($sequence == "ASC"){ echo "selected"; } ?>>Ascending</option>
              </select>
              </font></div></td>
        </tr>
      </table></td>
 
  <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class='bg_tbl'>
        <tr bgcolor="<?php echo $theme_tab1;?>" class='head_font'> 
          <td width="5%" height="22"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><input name="allchk" type="checkbox" value="call" title="เลือกทั้งหมด" onclick="CheckAll(document.myForm, document.myForm.allchk)"></font></strong></div></td>
		  <td width="5%" height="22"><div align="center"><B>Status</B></div></td>
		  <td width="5%" height="22"><div align="center"><B>Confirm</B></div></td>
		  <td width="5%" height="22"><div align="center"><B>Paid</B></div></td>
          <td width="12%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
			No.</font></strong></div></td>
		  <td width="15%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> Date</font></strong></div></td>
		   <td width="27%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> Name</font></strong></div></td>
		   <td width="10%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> Total</font></strong></div></td>
          <td width=""><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">Action</font></strong></div></td>
        </tr>
        <?php
							  
  if ($num>0)
  {
	$bg = $theme_tab2;
	while (  $order = $db->sql_fetchrow($list_query))
					{
										$order_id=$order['order_id'];
										$order_date=$order['order_date'];
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
										$order_confirm=$order['order_confirm'];
										$order_payment_status=$order['order_payment_status'];
										$order_payment=$order['order_payment'];
										$members_id=$order['members_id'];
										$grantotal = $order_total;

										$vat_ = 	$grantotal*($setting_tax/100);
										if($order_payment == "Cash" ) { 
											$discount_promo  = number_format(getn("sum(discount_percent_baht*amount)","order_b","order_id='$order_id'"),2,'.',',');$g_total = $order_total - $discount_promo +$order_tax ;
										}
										else{
											$discount_promo  = 0;
										}
										$g_total = $order_total +$order_tax ;
										
										$order_bill_title=stripslashes($order['order_bill_title']);
										$order_bill_title_val = getn("title_name","title","title_id='$order_bill_title'");
										$order_bill_fname=stripslashes($order['order_bill_fname']);
										$order_bill_lname=stripslashes($order['order_bill_lname']);
										$order_bill_phone=stripslashes($order['order_bill_phone']);
										$order_bill_company=stripslashes($order['order_bill_company']);
										$order_bill_addresstype=stripslashes($order['order_bill_addresstype']);
										$order_bill_address=stripslashes($order['order_bill_address']);
										$order_bill_district_code=stripslashes($order['order_bill_district_code']);
										$order_bill_amphur_code=stripslashes($order['order_bill_amphur_code']);
										$order_bill_province_code=stripslashes($order['order_bill_province_code']);
										$order_bill_postcode=stripslashes($order['order_bill_postcode']);
										$order_bill_country=stripslashes($order['order_bill_country']);
										$order_shipping_title=stripslashes($order['order_shipping_title']);
										$order_shipping_title_val = getn("title_name","title","title_id='$order_shipping_title'");
										$order_shipping_fname=stripslashes($order['order_shipping_fname']);
										$order_shipping_lname=stripslashes($order['order_shipping_lname']);
										$order_shipping_phone=stripslashes($order['order_shipping_phone']);
										$order_shipping_company=stripslashes($order['order_shipping_company']);
										$order_shipping_addresstype=stripslashes($order['order_shipping_addresstype']);
										$order_shipping_address=stripslashes($order['order_shipping_address']);
										$order_shipping_district_code=stripslashes($order['order_shipping_district_code']);
										$order_shipping_amphur_code=stripslashes($order['order_shipping_amphur_code']);
										$order_shipping_province_code=stripslashes($order['order_shipping_province_code']);
										$order_shipping_postcode=stripslashes($order['order_shipping_postcode']);
										$order_shipping_country=stripslashes($order['order_shipping_country']);

										if ( $bg == $theme_tab3 ) $bg = "#FFFFFF";
										else
												$bg = $theme_tab3;

										if ( $order_status == "Deleted" ) $stus = "<img src='../imgs/cancel.gif'>";
										else  if ( $order_status == "Wait" )  $stus = "<img src='../imgs/wait.gif'>";
											else  if ( $order_status == "Preparing" )  $stus = "<img src='../imgs/preparing.gif'>";
													else  if ( $order_status == "Completed" )   $stus = "<img src='../imgs/completed.gif'>";
										
										if ($order_confirm == 1 ) $confirm = "<img src='../imgs/icon/confirm.png'>";
										else $confirm = "<img src='../imgs/icon/unconfirm.png'>";

										if ($order_payment_status == 1 ) $paid = "<img src='../imgs/icon/paid.png'>";
										else $paid = "<img src='../imgs/icon/unpaid.png'>";


										
										



											?>
        <tr bgcolor="<?php echo $bg;?>" onMouseOver="onRowOver(this,'<?php echo $theme_tab2;?>');" onMouseOut="onRowOut(this);" title ="<?php echo $msg;?>"> 
          <td height="23"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> 
		  <input  type="checkbox" name="chkID[]" value="<?php echo $order_id; ?>">            
           </font></strong></div></td>		  
		   <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><?=$stus?></div></td>
		   <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><?=$confirm?></div></td>
		   <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><?=$paid?></div></td>
          <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?=$order_name;?></font></div></td>  
		  <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo Date_TH($order_date)." ".$order_time;?></font></div></td>
		  <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $order_bill_title_val." ".$order_bill_fname." &nbsp;&nbsp; ". $order_bill_lname;?></font></div></td>
		   <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?=number_format($g_total,2,'.',',')?>&nbsp;&nbsp;Bath</font></div></td>
		  
		   <td><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?method=order&process=detail&opt=<?=$opt?>&order_id=<?php echo $order_id;?>"><img src="<?php echo "../imgs/detail.gif";?>" border="0" alt="รายละเอียด"></a>
              : <a href="javascript:Confirm(<?php echo $order_id; ?>)"><img src="<?php echo "../imgs/del.gif";?>" border="0" alt="ลบ"></a></font></div></td>		  
        </tr>
        <?php
		}//end while
		?>
		<tr class='head_font' height="5"><td  colspan="15"></td></tr>    
        <tr class='tr_btn'>
          <td colspan="6" height="25"><div align="left">
                <input name="deleteall" type="submit" value="Delete order" onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'">
                <input type="button"  name="btCreate2" value="Search order"onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Searchorder() ;">
                </div></td>
        </tr>
        <?php
		}
		else
		{
		?>
        <tr> 
          <td colspan="6" height="25" align="center"><strong>Data Not Found</strong></td>
        </tr>						
        <tr class='head_font' height="5"><td  colspan="15"></td></tr> 
        <tr class='tr_btn'>
          <td height="27" colspan="6"><div align="left">
		  <input type="button"  name="btCreate2" value="Search order" onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Searchorder() ;">
            </div></td>
        </tr>
        
        <?php
		}
		?>
      </table>
	  </td>
  </tr>
   <tr> 
          <td colspan="6" height="25" bgcolor="<?php echo $theme_tab3;?>">&nbsp;
		  <img src="../imgs/cancel.gif">&nbsp;<?=$deleted?>&nbsp;&nbsp;
		 <img src="../imgs/wait.gif">&nbsp;<?=$wait?> &nbsp; 
		 <img src="../imgs/preparing.gif">&nbsp;<?=$preparing?> &nbsp; 
		  <img src="../imgs/completed.gif">&nbsp;<?=$completed?>  </td>
  </tr>
</table>
  </form>
<?php
}

function detail()
{

			global  $db;
			global $prefix;
			global $theme_tab1;
			global $theme_tab2;
			global $theme_tab3;
			global $wait,$deleted,$preparing,$completed,$p_product ,$setting_tax,$sessionid   ;

			$sql = sql_Select(1,$prefix."_setting", "setting_id =1", 0);
			$query = $db->sql_query($sql);
			$setting = $db->sql_fetchrow($query);
			$perpage = $setting[setting_per_rec];

			$order_id = get_var('order_id','request',0);
		
			$opt = get_var('opt','request',0);
			
			$order_sql = sql_Select(1, $prefix."_order", "order_id = '$order_id'", 0);
			//echo  $order_sql ;
			$order_query = $db->sql_query($order_sql);
			$order = $db->sql_fetchrow($order_query);
			
			$order_id=$order['order_id'];
			$order_date=$order['order_date'];
			$order_time=$order['order_time'];
			$order_method=$order['order_method'];
			$order_name=$order['order_name'];
			$order_address=$order['order_address'];
			$order_receiver=$order['order_receiver'];
			$order_receiver_add=$order['order_receiver_add'];
			$order_tax=$order['order_tax'];
			$order_note=$order['order_note'];
			$order_status=$order['order_status'];
			$members_id=$order['members_id'];

					$order_bill_title=stripslashes($order['order_bill_title']);
					$order_bill_title_val = getn("title_name","title","title_id='$order_bill_title'");
					$order_bill_fname=stripslashes($order['order_bill_fname']);
					$order_bill_lname=stripslashes($order['order_bill_lname']);
					$order_bill_phone=stripslashes($order['order_bill_phone']);
					$order_bill_company=stripslashes($order['order_bill_company']);
					$order_bill_addresstype=stripslashes($order['order_bill_addresstype']);
					$order_bill_address=stripslashes($order['order_bill_address']);
					$order_bill_district_code=stripslashes($order['order_bill_district_code']);
					$order_bill_amphur_code=stripslashes($order['order_bill_amphur_code']);
					$order_bill_province_code=stripslashes($order['order_bill_province_code']);
					$order_bill_postcode=stripslashes($order['order_bill_postcode']);
					$order_bill_country=stripslashes($order['order_bill_country']);
					$order_shipping_title=stripslashes($order['order_shipping_title']);
					$order_shipping_title_val = getn("title_name","title","title_id='$order_shipping_title'");
					$order_shipping_fname=stripslashes($order['order_shipping_fname']);
					$order_shipping_lname=stripslashes($order['order_shipping_lname']);
					$order_shipping_phone=stripslashes($order['order_shipping_phone']);
					$order_shipping_company=stripslashes($order['order_shipping_company']);
					$order_shipping_addresstype=stripslashes($order['order_shipping_addresstype']);
					$order_shipping_address=stripslashes($order['order_shipping_address']);
					$order_shipping_district_code=stripslashes($result['order_shipping_district_code']);
					$order_shipping_amphur_code=stripslashes($order['order_shipping_amphur_code']);
					$order_shipping_province_code=stripslashes($order['order_shipping_province_code']);
					$order_shipping_postcode=stripslashes($order['order_shipping_postcode']);
					$order_shipping_country=stripslashes($order['order_shipping_country']);
		  $order_payment = stripslashes($order['order_payment']);
		  $order_payment_at_bank = stripslashes($order['order_payment_at_bank']);
		  $order_payment_status=$order['order_payment_status'];
		  $order_transportation = stripslashes($order['order_transportation']);
		  $order_bank_trans = stripslashes($order['order_bank_trans']);
		  $order_confirm=$order['order_confirm'];
		  $promotion=$order['promotion'];

					
		$shipping_district = getn("dirstict_name","district","district_code = $order_shipping_district_code");
		$shipping_amphur = getn("amphur_name","amphur","amphur_code = $order_shipping_amphur_code");
		$shipping_province = getn("province_name","province","province_code = $order_shipping_province_code");
		$shipping_address = " $order_shipping_title_val  $order_shipping_fname  $order_shipping_lname  $order_bill_company $order_shipping_address &nbsp;$shipping_district &nbsp;$shipping_amphur &nbsp;$shipping_province &nbsp;$order_shipping_postcode ";

		$bill_district = getn("dirstict_name","district","district_code = $order_bill_district_code");
		$bill_amphur = getn("amphur_name","amphur","amphur_code = $order_bill_amphur_code");
		$bill_province = getn("province_name","province","province_code = $order_bill_province_code");
		$bill_address = " $order_bill_title_val  $order_bill_fname  $order_bill_lname  $order_bill_company $order_bill_address &nbsp;$bill_district &nbsp;$bill_amphur &nbsp;$bill_province &nbsp;$order_bill_postcode ";

		
		 $bank_detail = getn("bank_detail","bank","bank_name = '$order_payment_at_bank' and bank_status='1'");
		  switch ($order_payment)
		  {   
			case "Cash" : $order_payment_txt="โอนเงินเข้าบัญชีธนาคาร <br>$order_payment_at_bank<BR>$bank_detail";  
		
			break; 
			case "CreditTerm" : $order_payment_txt="ขอใช้ระบบสินเชื่อ";   
		
			break;
			case "CreditCard" : $order_payment_txt="ชำระเงินผ่านบัตรเครดิต";  
				
			break;
		
		  }

			$arr_add1 = explode("•", $order_address);
			$address1 = $arr_add1[0];
			$phone1 = $arr_add1[1];
			$email1 = $arr_add1[2];		

			$detail_sql = sql_Select(1, $prefix."_members", "members_id = '$members_id'", 0);
			//echo  $detail_sql ;
			$detail_query = $db->sql_query($detail_sql);
			$members = $db->sql_fetchrow($detail_query);
																	
			$members_id=$members['members_id'];
			$members_fname=$members['members_fname'];
			$members_lname=$members['members_lname'];
			$members_title=$members['members_title'];
			$members_address=$members['members_address'];
			$members_province=$members['members_province'];
			$members_postal=$members['members_postal'];
			$members_off_phone=$members['members_off_phone'];
			$members_mob_phone=$members['members_mob_phone'];
			$members_fax=$members['members_fax'];
			$members_email=$members['members_email'];
			$members_user=$members['members_user'];
			$members_pass=$members['members_pass'];
			$members_active=$members['members_active'];
?>

<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="<?php echo $theme_tab3;?>">
   <tr> 
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" bgcolor="<?php echo $theme_tab3;?>" bordercolor="<?php echo $theme_tab2;?>">
        	 <tr class="head_line"> 
				<td  align="left" colspan="2" height="27"><strong>&nbsp;&nbsp;Ordering</strong></td>                           
			  </tr>
			  <tr><td>&nbsp;</td><td align="right"><a href="javascript:reportpo(<?=$order_id?>)"><img src="../images/printButton.png" width="16" height="16"  onmouseover="this.style.cursor='hand';" ></a>
              </td></tr>
			  <tr>
				<td colspan = 2>					
					<TABLE width='95%' border='0' cellspacing='5' cellpadding='5' align='center' bgcolor='#E1E1E1' bordercolor=''>
					<TR>
						<TD><!-- หัวข้อ -->
								<TABLE width='99%' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='' bordercolor=''>
								<TR>
									<TD width="70%"> <b>Status  &nbsp;:&nbsp;&nbsp;</b>
									<SELECT NAME="opt" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value" style="BACKGROUND-COLOR: <?php echo $theme_tab3;?>; ">
									 <OPTION value="index.php?method=order&process=changestatus&order_id=<?=$order_id?>&opt=Deleted" <?php if ($order_status=='Deleted') echo "selected";?>><?=$deleted?></OPTION>
									 <OPTION value="index.php?method=order&process=changestatus&order_id=<?=$order_id?>&opt=Wait" <?php if ($order_status=='Wait') echo "selected";?>><?=$wait?></OPTION>
									 <OPTION value="index.php?method=order&process=changestatus&order_id=<?=$order_id?>&opt=Preparing" <?php if ($order_status=='Preparing') echo "selected";?>><?=$preparing?></OPTION>
									 <OPTION value="index.php?method=order&process=changestatus&order_id=<?=$order_id?>&opt=Completed" <?php if ($order_status=='Completed') echo "selected";?>><?=$completed?></OPTION>
									 </SELECT>
									&nbsp;&nbsp;&nbsp;&nbsp;
									 <b>Confirm &nbsp;:&nbsp;&nbsp;</b>
									<SELECT NAME="opt3" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value" style="BACKGROUND-COLOR: <?=$theme_tab3;?>; ">
									 <OPTION value="index.php?method=order&process=changestatusConfirm&order_id=<?=$order_id?>&opt3=1" <?php if ($order_confirm=='1') echo "selected";?>>Yes</OPTION>
									 <OPTION value="index.php?method=order&process=changestatusConfirm&order_id=<?=$order_id?>&opt3=0" <?php if ($order_confirm=='0') echo "selected";?>>No</OPTION>
									 </SELECT>
									&nbsp;&nbsp;&nbsp;&nbsp;
									 <b>Payment &nbsp;:&nbsp;&nbsp;</b>
									<SELECT NAME="opt2" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value" style="BACKGROUND-COLOR: <?php echo $theme_tab3;?>; ">
									 <OPTION value="index.php?method=order&process=changestatuspayment&order_id=<?=$order_id?>&opt2=1" <?php if ($order_payment_status=='1') echo "selected";?>>Yes</OPTION>
									 <OPTION value="index.php?method=order&process=changestatuspayment&order_id=<?=$order_id?>&opt2=0" <?php if ($order_payment_status=='0') echo "selected";?>>No</OPTION>
									 </SELECT>
									</TD>
									<TD width='30%'> <B>Order Number &nbsp;&nbsp;&nbsp;</B><?=$order_name?><!-- <?=sprintf('%010d',$order_id)?> --></TD>
								</TR>
									<TD width="70%">
									</TD>
									<TD width='30%'> <B>Order Transaction &nbsp;&nbsp;&nbsp;</B><?=$order_bank_trans?></TD>
								</TR>
								<TR><TD colspan='2'>&nbsp;</TD></TR>
								<TR>											
										<TD colspan='2'><B><FONT COLOR='#3366CC'>Billing Information</FONT></B></TD>
								</TR>
								<TR><TD colspan='2'>&nbsp;</TD></TR>
								<TR>
									<TD colspan='2'>
									<TABLE width='100%' bgcolor='#FFFFFF'>
									<TR>
									<TD width='70%'> <B>Name   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?="$order_bill_title_val $order_bill_fname $order_bill_lname"?></TD>
									<TD width='30%'> <B>Date</B>&nbsp;&nbsp;&nbsp;<?=Date_TH($order_date);?>
									&nbsp;&nbsp;<B>Time</B>&nbsp;&nbsp;<?=$order_time?></TD>
									</TR>										
									<TR>
										<TD colspan='2'> <B>Address  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?=$bill_address?></TD>								
									</TR>
									<TR>
										<TD> <B>Telephone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?=$order_bill_phone?></TD>
										<TD> <B> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?=$email1?></TD>
									</TR>
									</TABLE>
									</TD>
									</TR>
								<TR><TD colspan='2'>&nbsp;</TD></TR>
								<TR>											
										<TD colspan='2'><B><FONT COLOR='#3366CC'>Shipping Information</FONT></B></TD>
								</TR>
								<TR><TD colspan='2'>&nbsp;</TD></TR>
								<TR>
									<TD colspan='2'>
									<TABLE width='100%' bgcolor='#FFFFFF'>
									<TR>
									<TD width='70%'> <B>Name   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?="$order_shipping_title_val $order_shipping_fname $order_shipping_lname"?></TD>
									<TD width='30%'> <B>Date</B>&nbsp;&nbsp;&nbsp;<?=Date_TH($order_date);?>
									&nbsp;&nbsp;<B>Time</B>&nbsp;&nbsp;<?=$order_time?></TD>
									</TR>										
									<TR>
										<TD colspan='2'> <B>Address  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?=$shipping_address?></TD>								
									</TR>
									<TR>
										<TD> <B>Telephone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?=$order_shipping_phone?></TD>
										<TD> <B> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</B><?=$email1?></TD>
									</TR>
									</TABLE>
									</TD>
									</TR>
									<TR>											
										<TD colspan='2'>&nbsp;</TD>
									</TR>
								<TR>											
										<TD colspan='2'><B><FONT COLOR='#3366CC'>Payment Information</FONT></B></TD>
								</TR>
								<TR><TD colspan='2'>&nbsp;</TD></TR>
								<TR>
									<TD colspan='2'>
									<TABLE width='100%' bgcolor='#FFFFFF' border='0' cellspacing='0' cellpadding='5' >
									<TR>
									<TD width="120" valign="top"><B>Payment description <B></td>
									<td><?=$order_payment_txt?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR></TD>		
									</TR>
									</TABLE>
									</TD>
									</TR>
								<TR><TD colspan='2'>&nbsp;</TD></TR>
								<TR>
								</TABLE>
						</TD>
					</TR>

					<TR>
						<TD><!-- เนื้อหา -->
						<TABLE width='99%' border='0' cellspacing='0' cellpadding='0' align='center' bgcolor='#FFFFFF' bordercolor=''>
								<TR height='78'>
									<TD>
									<TABLE width='100%' border='0' cellspacing='1' cellpadding='0' align='center' bgcolor='' bordercolor=''>
									<TR height='25' bgcolor='#FFFF99'>
										<td width='7%'><CENTER><font size='-2' face='MS Sans Serif, Tahoma, sans-serif' class='detail'><b>No</b></font></CENTER></td>
										<td width='%'><CENTER><font size='-2' face='MS Sans Serif, Tahoma, sans-serif' class='detail'><b>Detail</b></font></CENTER></td>
										<td width='20%'><CENTER><font  size='-2' face='MS Sans Serif, Tahoma, sans-serif' class='detail'><b>Price</b></font></CENTER></td>
										<td width='15%'><CENTER><font  size='-2' face='MS Sans Serif, Tahoma, sans-serif' class='detail'><b>Amonut</b></font></CENTER></td>
										<td width='20%'><CENTER><font  size='-2' face='MS Sans Serif, Tahoma, sans-serif' class='detail'><b>Total</b></font></CENTER></td>
									</TR>
									<?php 
											$cart_sql = sql_Select(1, $prefix."_order_b", "order_id = '$order_id'", 0);
											//echo  $cart_sql ;
											$cart_query = $db->sql_query($cart_sql);										
											$total_item = $db->sql_numrows($cart_query);
											$i=0;
											while ( $cart = $db->sql_fetchrow($cart_query))
												{
													$i++;
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
                                                //$detail_sql = sql_Select(1, $prefix."_order_b", "order_id = '$order_id'", 0);
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
												$products_create=$result['products_create'];
												$products_modify=$result['products_modify'];
												$products_promote=$result['products_promote'];
												$products_icon=$result['products_icon'];													

															if ( $bg == "#E4E4E4" ) $bg = "#FFFFFF";
																		else
																				$bg = "#E4E4E4";
									
								?>
								<TR height='22' bgcolor='<?=$bg?>'>
										<TD><CENTER><?=$i?></CENTER></TD>
										<TD style="padding: 5px 5px 5x 5px"> <?=$products_jb_no." : ".$products_name?></TD>
										<TD><!-- <CENTER><?=number_format($products_price,2,'.',',')?></CENTER></TD> -->
                                        <CENTER><?=number_format($price,2,'.',',')?></CENTER></TD>
										<TD><CENTER><?=$amount?></CENTER></TD>
										<TD><table width='100%'><tr><td align='right'><?=number_format($total,2,'.',',')?></td><td width='20'></td></tr></table></TD>
									</TR>								
								<?php				
												} // end while

											$transoprt = $order_transportation;
											$vat_ = $grantotal*($setting_tax/100);
											//echo "$grantotal+$vat_+$transoprt";
											$g_total = $grantotal+$vat_+$transoprt;
											$g_total_send=$g_total *100;
									
								?>
								<TR height='22' bgcolor='#D2D7E6'>
									<TD align='right' colspan='4'>รวมเงิน (ไม่รวมVAT) &nbsp;&nbsp;</TD>
									<TD><table width='100%'><tr><td align='right'><?=number_format($grantotal,2,'.',',')?></td><td width='20'></td></tr></table></TD>
								</TR>
								
									<?
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
													$g_total = ($grantotal+$vat_)-$promotion;
													if ($order_payment == "CreditCard") $g_total_send=$g_total *100;
													else $g_total_send=0;
									?>
								<TR height='22' bgcolor='#D2D7E6' <?=$str_?>>
									<TD align='right' colspan='4'>ส่วนลด 1% (ชำระเงินสด)  &nbsp;&nbsp;</TD>
									<TD><table width='100%'><tr><td align='right'><font color='red'><?=number_format($total_percent_baht*-1,2,'.',',')?></font></td><td width='20'></td></tr></table></TD>
								</TR>
								<TR height='22' bgcolor='#D2D7E6'>
									<TD align='right' colspan='4'>ค่าขนส่ง  &nbsp;&nbsp;</TD>
									<TD><table width='100%'><tr><td align='right'><?=number_format($transoprt,2,'.',',')?></td><td width='20'></td></tr></table></TD>
								</TR>
								<TR height='22' bgcolor='#D2D7E6' style="display:none">
									<TD align='right' colspan='4'>ส่วนลด  &nbsp;&nbsp;</TD>
									<TD><table width='100%'><tr><td align='right'><font color='red'><?=number_format($totaldis*-1,2,'.',',')?></font></td><td width='20'></td></tr></table></TD>
								</TR>
								<TR height='22' bgcolor='#D2D7E6' <?=$str_?>>
									<TD align='right' colspan='4'>รวมเงิน (ไม่รวมVAT) &nbsp;&nbsp;</TD>
									<TD><table width='100%'><tr><td align='right'><?=number_format($grantotal,2,'.',',')?></td><td width='20'></td></tr></table></TD>
								</TR>
								<TR height='22' bgcolor='#D2D7E6'>
									<TD align='right' colspan='4'>vat <?=$setting_tax?>%  &nbsp;&nbsp;</TD>
									<TD><table width='100%'><tr><td align='right'><?=number_format($vat_,2,'.',',')?></td><td width='20'></td></tr></table></TD>
								</TR>
								<TR height='22' bgcolor='#D2D7E6'>
									<TD align='right' colspan='4'>รวมทั้งหมด &nbsp;&nbsp;</TD>
									<TD><table width='100%'><tr><td align='right'><?=number_format($g_total,2,'.',',')?></td><td width='20'></td></tr></table></TD>
								</TR>
								</TABLE>
								</TD>
							</TR>							
							</TABLE>
						</TD>
					</TR>							
					<TR>
						<TD><!-- หมายเหตุ -->
						<SCRIPT LANGUAGE="JavaScript">
						<!--
								function adjust(orderid){
							
								theURL = "order/editcomment.php?byname=<?=$_SESSION[$sessionid]['admin_user']?>&order_id="+orderid;	win=open(theURL,"","toolbar=0,directories=0,status=1,scrollbars=0,menubar=0,resizable=0,width=500,height=150,top=300,left=300");
						}
								function reportpo(order_id){
									theURL="order/po.php?order_id="+order_id; win=open(theURL,"","toolbar=0,directories=0,status=1,scrollbars=0,menubar=0,resizable=0 width=1000,height=700");
									
									}
						//-->
						</SCRIPT>
                       
						<TABLE width='99%' border='0' cellspacing='5' cellpadding='5' align='center' bgcolor='' bordercolor=''>
							<TR>
								<TD valign='top' width='55'><B>Note :</B></TD>
								<TD valign='top' width='90%' align='left'><?=str_replace("\n","<br>",$order_note);?></TD>
							</TR>
							<TR>
								<TD valign='top' colspan='2'><B>Note :</B> <a href="javascript:adjust(<?=$order_id?>)"><img src="../imgs/modify.gif"width='62' height='22' border='0'></a></TD>
							</TR>							
							</TABLE>
						</TD>
					</TR>							
					</TABLE>
				</td>
			  </tr>
			  <tr> 
              <td height="25" colspan="2"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;&nbsp;Link 
                Action &gt; <a href="index.php?method=order&process=list&opt=<?=$opt?>&order_id=<?php echo $order_id;?>">Order List </strong></font></td>
            </tr>
			<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
      </table></td>
  </tr>
  </table><BR>
<?php
}

function deleted()
{
					global  $db;
					global $prefix;

					$order_id =  get_var('order_id','request',0);
					$opt =  get_var('opt','request',0);
					
					//$delete_sql = sql_delete($prefix."_order", "order_id = '$order_id'");
					$delete_sql  = sql_Update($prefix."_order","order_delete='1',order_delete_datetime=Now() ","order_id = '$order_id'  ");
					//echo  $delete_sql;
					$delete_query = $db->sql_query($delete_sql);
					//$delete_sql = sql_delete($prefix."_order_b", "order_id = '$order_id'");
					$delete_sql  = sql_Update($prefix."_order_b","delete_status='1',deletedatetime=Now() ","order_id = '$order_id'  ");
					//echo  $delete_sql;
					$delete_query = $db->sql_query($delete_sql);
					
					if(!$delete_query){
								// error
								$msg = "<font color=red>ERROR !!</font> Can Not Delete  order.";
					}
					else
					{
								// success								
								$msg = "<font color=blue>SUCCESS !!</font> Delete  order on Success.";											
					}

					$loc = "index.php?method=order&process=list&opt=$opt&msg=$msg";
					echo "<script language='JavaScript'>document.location = '$loc';</script>";
}

function deletemany()
{
					global  $db;
					global $prefix;
					
					$chkID = get_var('chkID','request',0);
					$opt = get_var('opt','request',0);

					$i = 0; 
					while ($i < count($chkID))   
					{    
								$order_id = $chkID[$i]; 	
																
								//$delete_sql = sql_delete($prefix."_order", "order_id = '$order_id'");
								$delete_sql  = sql_Update($prefix."_order","order_delete='1',order_delete_datetime=Now() ","order_id = '$order_id'  ");
								//echo $delete_sql;
								$delete_query = $db->sql_query($delete_sql);	
								//$delete_sql = sql_delete($prefix."_order_b", "order_id = '$order_id'");
								//$updatestatus  = sql_Update($prefix."_order","order_status='$opt' ","order_id = '$order_id'  ");
								$delete_sql  = sql_Update($prefix."_order_b","delete_status='1',deletedatetime=Now() ","order_id = '$order_id'  ");
								//echo  $delete_sql;
								$delete_query = $db->sql_query($delete_sql);						
															
								if($delete_query)  $i++;
						} // end while
						
						if(count($chkID)==$i){
						// sucess
						$msg = "<font color=blue>SUCCESS !!</font> $i  Delete  order  on Success.";
						$loc = "index.php?method=order&process=list&opt=$opt&msg=$msg";							
						}
						else{
							// error
						$msg = "<font color=red>ERROR !!</font> Can Not Delete  order.";
						$loc = "index.php?method=order&process=list&opt=$opt&msg=$msg";
								
						}// end while
						echo "<script language='JavaScript'>document.location = '$loc';	</script>";
}


function formsearch()
{
						global $theme_tab1;
						global $theme_tab2;
						global $theme_tab3;		
						global $wait,$checked,$preparing,$completed;
?>
	  <form name="form1" method="post" action="index.php?method=order&process=listsearch">
          <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="Type_A">
  	<tr>
    <td><table width="100%" height="96" border="0" cellpadding="0" cellspacing="0" align="center" class="Type_A" >
            <tr class="head_noline"> 
              <td height="25" colspan="2"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;&nbsp;Search 
                Order</strong></font></td>
            </tr>
            <tr> 
              <td width="125" height="26"><div align="right"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">Search 
                  : &nbsp;</font></div></td>
              <td width="525"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
                <select name="selectfield">
                  <option value="order_name">Order Number</option>
                  <option value="order_bill_fname">Bill Fast Name</option>
                  <option value="order_bill_lname">Bill Last Name</option>
                  <option value="order_bill_company">Bill Company Name</option>
                  <option value="order_shipping_fname">Shipping Fast Name</option>
                  <option value="order_shipping_lname">Shipping Last Name</option>
                </select>
                <input name="search_" type="text"  size="30" maxlength="30">
                </font></td>
            </tr> 
			 <tr>
				<td align=right  height="30">Start-End date &nbsp;: &nbsp;</td>
				<td>&nbsp;&nbsp;
			  <INPUT size="12" id="startday"  name="startday" value="<?=$startdate?>"> <IMG  onclick="popUpCalendar(this,document.getElementById('startday'), 'yyyy-mm-dd', fnSetDate);" height="20 " width='20' src="../imgs/icon_time.gif" width="25">&nbsp;&nbsp;To 
			  <INPUT size="12" id="endday" name="endday" value="<?=$enddate?>"> <IMG  onclick="popUpCalendar(this,document.getElementById('endday'), 'yyyy-mm-dd', fnSetDate);" height="20" width='20' src="../imgs/icon_time.gif" width="25">             </td>
			</tr>		
			<tr> 
              <td height="18"><div align="right"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;</font></div></td>
              <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
                <input type="submit" name="Submit" value=" ok " onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'">
                &nbsp; 
                <input name="reset" type="reset" id="reset" value="Reset" onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'">
                </font></td>
            </tr>
            <tr> 
              <td height="25" colspan="2"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;&nbsp;Link 
                Action &gt; <a href="index.php?method=order&process=list">List</a></strong></font></td>
            </tr>
          </table></td>
  </tr>
</table>

</form>

<?php
}


function search()
{
						global  $db;
						global $prefix;
						global $theme_tab1;
						global $theme_tab2;
						global $theme_tab3;
						global $wait,$deleted,$completed,$preparing;
						global $perpage;					

						$selectfield = get_var('selectfield','request',0);
						$search_ = get_var('search_','request',0);

						//print_r($_REQUEST);

						$opt = get_var('opt','request',0);
						$con_opt = "";
						
						if ( $opt == "Wait" ) $con_opt = " and order_status = 'Wait' ";
								else  if ( $opt == "Preparing" )   $con_opt = " and order_status = 'Preparing' ";
								else  if ( $opt == "Completed" )   $con_opt = " and order_status = 'Completed' ";
											else  if ( $opt == "Deleted" )   $con_opt = " and order_status = 'Deleted' ";				
						
						$sql = sql_Select(1, $prefix."_setting", "setting_id =1", 0);
						
						$query = $db->sql_query($sql);
						$setting = $db->sql_fetchrow($query);
						$perpage = $setting[setting_per_rec];

						$startday = get_var('startday','request',0);
						$endday = get_var('endday','request',0);

						if(($startday) && ($endday)) {
							$condate = " and (order_date between '$startday' and '$endday' )";
							$txt_date = " Date  '$startday' and '$endday' ";
						}

						$s_link =  "&selectfield=$selectfield&search_=$search_&status=$opt&startday=$startday&endday=$endday";			
?>

<script language="JavaScript">
<!--
function Confirm(id){
		if(confirm("Do you want delete ?")){
			// ok
			document.location= "<?php  echo "index.php?method=order&process=deleted&opt=<?=$opt?>&g_id=";?>" +id;
			}
		else{
			// cancel
			return;
		}	
	}

	function Change_MaxPage(maxpage){
		document.location="<?php echo "index.php?method=order&process=listsearch&selectfield$s_link&opt=$opt&current=$current&per_page="; ?>" + maxpage + '<?php echo "&sequence=$sequence"; ?>';
	}	
	
	function Create(){
		document.location="<?php echo "index.php?method=order&process=formcreate&opt=<?=$opt?>"; ?>";
	}
	
	function Searchnews(){
		document.location="<?php echo "index.php?method=order&process=formsearch&opt=<?=$opt?>"; ?>";
	}
	
	function change_page(go_page){
		document.location= go_page;
	}	
	
	function Record_MouseClick(id){
		document.location="<?php echo "index.php?method=childs&process=list&opt=<?=$opt?>&order_id=";?>" +id;
	}		

-->
</script>
<?php							
									
									if (!$order) $order="order_id";
									if (!$sequence) $sequence="DESC";
									$list_sql = sql_Select(1, $prefix."_order", " members_id > 0 and order_status <> ''  and order_delete = 0 and $selectfield  like '%$search_%' $condate ", 0);
									$list_sql .= " $con_opt ORDER BY $order $sequence ";
									//echo $list_sql."<br>";
	
									$list_query = $db->sql_query($list_sql);
									$totalrec = $db->sql_numrows($list_query);
										//echo "<br>$totalrec<br>";

									$num = $totalrec; 
									if (!$per_page) $per_page=$perpage;
		  							if (!$current)   $current  = 1;

									if ($num <$per_page) 
									$amount = 1;
												else if ($num%$per_page == 0)
																	$amount = $num/$per_page;
 	       						 						else
																    $amount = ceil($num/$per_page);

		
								if ($current > 1)  $prv = $current -1;

								if ($current < $amount )  $next = $current+1;
		
								$startpage = $current*$per_page - $per_page;

								//$list_sql = sql_Select(1, $prefix."_order", " members_id > 0 and order_status <> '' and order_delete = 0 and $selectfield  like '%$search_%' $condate  $con_opt ", "$order");
								$list_sql .= " LIMIT $startpage,$per_page ";
								
								//echo $list_sql."<br>";
								$list_query = $db->sql_query($list_sql);
?>
	 <form action="index.php?method=order&process=deletedmany&opt=<?=$opt?>" method="post"  name="myForm"  onsubmit='if(confirm("Do you want delete ?")) return true; else return false;'>
<table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
  <tr>
    <td><table width="100%" height="26" border="0" cellpadding="0" cellspacing="0" align="center" bgcolor="<?php echo $theme_tab2;?>">
	<tr bgcolor="#FFFFFF"> 
                                        <td height="20" colspan="8" valign="middle" ><div align="left"> 
                                            <font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;&nbsp;<font  color="#0000FF">รายการที่ได้จากการค้นหา 
                                            order  ที่ <?php echo $selectfield; ?> 
                                            มีคำว่า ' 
                                            <?php  echo $search_;?>
                                            '
											&nbsp;<?=$txt_date?></font></font></div></td>
	<td align=right bgcolor=#FFFFFF height=25>
	<input type="button"  name="btCreate2" value="Search order"onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Searchorder() ;">
	<SELECT NAME="opt" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value" style="BACKGROUND-COLOR: <?php echo $theme_tab3;?>; ">
	 <OPTION value="index.php?method=order&process=list">ทุกสถานะ</OPTION>
	 <OPTION value="index.php?method=order&process=list&opt=Deleted<?=$s_link?>" <?php if ($opt=='Deleted') echo "selected";?>><?=$deleted?></OPTION>
	 <OPTION value="index.php?method=order&process=list&opt=Wait<?=$s_link?>" <?php if ($opt=='Wait') echo "selected";?>><?=$wait?></OPTION>
	 <OPTION value="index.php?method=order&process=list&opt=Preparing<?=$s_link?>" <?php if ($opt=='Preparing') echo "selected";?>><?=$preparing?></OPTION>
	 <OPTION value="index.php?method=order&process=list&opt=Completed<?=$s_link?>" <?php if ($opt=='Completed') echo "selected";?>><?=$completed?></OPTION>
	 </SELECT>
	</td>
	</tr>
        <tr bgcolor="#CCCCCC"> 
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;&nbsp;Found</strong> &nbsp;
            <?php echo $num; ?> &nbsp; <strong>Records</strong> &nbsp; <?php echo $amount; ?> &nbsp;<strong> Page</strong></font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">|</font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>Page</strong>:&nbsp;</font></td>
          <td> <font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> 
            <select name="selpageno"  onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value">
              <?php
											for($ii=0;$ii<$amount;$ii++) { //วนใส่แสดง หน้าปัจจุบัน
									   			if(($ii+1) == $current){ 
													$selected = " selected"; 
												}
												else{ 
													$selected=""; 
												}
										?>
              <option value="<?php echo "index.php?method=order&process=listsearch$s_link&opt=$opt&current=".($ii+1)."&per_page=$per_page&sequence=$sequence";?>"  <?php echo $selected; ?> > 
              <?php echo ($ii+1).'&nbsp;&nbsp;'; ?> </option>
              <?php
											}
										?>
            </select>
            &nbsp; 
            <?php if($current > 1 && $current != "" && $amount != 0){ ?>
            <a style="cursor: hand" onClick="location='<?php echo "index.php?method=order&process=listsearch$s_link&opt=$opt&current=".($current-1)."&per_page=$per_page&sequence=$sequence"; ?>'"> 
            <img src="../imgs/prev_out.gif" alt="Previous page" name="prev_page" width="16" height="16" border="0" align="absmiddle"></a> 
            <?php }else{ ?>
            <img src="../imgs/prev_dis.gif" alt="Previous page" name="prev_dis" width="16" height="16" border="0" align="absmiddle">	
            <?php } ?>
            <?php if($current != $amount && $amount != 0){ ?>
            <a style="cursor: hand" onClick="location='<?php echo "index.php?method=order&process=listsearch$s_link&opt=$opt&current=".($current+1)."&per_page=$per_page&sequence=$sequence"; ?>'"> 
            <img src="../imgs/next_out.gif" alt="Next page" name="next_page" width="16" height="16" border="0" align="absmiddle"></a> 
            <?php }else{ ?>
            <img src="../imgs/next_dis.gif" alt="Next page" name="next_dis" width="16" height="16" border="0" align="absmiddle">	
            <?php } ?>
            </font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">|</font></td>
          <td> <font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp; 
            <input name="maxpage" type="text" class="inputTag" id="maxpage" 
										onChange="location='<?php echo "index.php?method=order&process=listsearch$s_link&opt=$opt&current=1&per_page="; ?>'+maxpage.value+'<?php echo "&sequence=$sequence";?>' " value="<?php echo $per_page; ?>" size="2" maxlength="2">
            &nbsp; 
            <input type="button" class="buttonTag" name="btMaxPage" value="Ok" onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Change_MaxPage(myForm.maxpage.value)">
            &nbsp; </font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>Records 
            per page</strong></font></td>
          <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">|</font></td>
          <td> <div align="right"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<strong>Sort 
              :</strong>&nbsp; 
              <select name="sequence" id="sequence" class="inputTag" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value">                
				<option value="<?php echo "index.php?method=order&process=listsearch$s_link&opt=$opt&current=$current&per_page=$per_page&sequence=DESC"; ?>" <?php if($sequence == "DESC"){ echo "selected"; } ?>>Descending</option>
				<option value="<?php echo "index.php?method=order&process=listsearch$s_link&opt=$opt&current=$current&per_page=$per_page&sequence=ASC"; ?>" <?php if($sequence == "ASC"){ echo "selected"; } ?>>Ascending</option>
                </select>
              </font></div></td>
        </tr>
      </table></td>
  </tr>
   <tr>
    <td><table width="100%" border="0" cellspacing="1" cellpadding="0" align="center" class='bg_tbl'> <tr bgcolor="<?php echo $theme_tab1;?>" class='head_font'> 
          <td width="5%" height="22"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><input name="allchk" type="checkbox" value="call" title="เลือกทั้งหมด" onclick="CheckAll(document.myForm, document.myForm.allchk)"></font></strong></div></td>
		  <td width="5%" height="22"><div align="center"><B>Status</B></div></td>
          <td width="15%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
			No.</font></strong></div></td>
		  <td width="15%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> Date</font></strong></div></td>
		   <td width="27%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> Name</font></strong></div></td>
		   <td width="10%"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> Total</font></strong></div></td>
          <td width=""><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">Action</font></strong></div></td>
        </tr>
        <?php
							  
		  if ($num>0)
		  {
			$bg = $theme_tab2;
			while (  $order = $db->sql_fetchrow($list_query))
							{
										$order_id=$order['order_id'];
										$order_date=$order['order_date'];
										$order_time=$order['order_time'];
										$order_method=$order['order_method'];
										$order_name=$order['order_name'];
										$order_address=$order['order_address'];
										$order_receiver=$order['order_receiver'];
										$order_receiver_add=$order['order_receiver_add'];
										$order_total=$order['order_total'];
										$order_note=$order['order_note'];
										$order_status=$order['order_status'];
										$members_id=$order['members_id'];										

										$detail_sql = sql_Select(1, $prefix."_members", "members_id = '$members_id'", 0);
										//echo  $detail_sql ;
										$detail_query = $db->sql_query($detail_sql);
										$members = $db->sql_fetchrow($detail_query);
																								
										$members_id=$members['members_id'];
										$members_fname=$members['members_fname'];
										$members_lname=$members['members_lname'];
										$members_title=$members['members_title'];
										$members_address=$members['members_address'];
										$members_province=$members['members_province'];
										$members_postal=$members['members_postal'];
										$members_off_phone=$members['members_off_phone'];
										$members_mob_phone=$members['members_mob_phone'];
										$members_fax=$members['members_fax'];
										$members_email=$members['members_email'];
										$members_user=$members['members_user'];
										$members_pass=$members['members_pass'];
										$members_active=$members['members_active'];

										
										if ( $bg == $theme_tab3 ) $bg = "#FFFFFF";
										else
												$bg = $theme_tab3;
										
										$msg = "================ Member Data ==============\n";
										$msg .= " ชื่อ-นามสกุล : ".$members_fname." -". $members_lname."\n";
										$msg .= " ที่อยู่ : ".$members_address." ".getn("province_name","province"," province_id = ".$members['members_province'])."  ".$members['members_postal']."\n";		
										$msg .= " มือถือ : ".$members_mob_phone."\n";	
										$msg .= " โทรศัพท์ : ".$members_off_phone."\n";
										$msg .= " โทรสาร : ".$members_fax."\n";	
										$msg .=  " E-Mail : ".$members_email."\n";
										$msg .=  "=======================================\n";
										$msg .= "================ Order Data ===============\n";
										$msg .= " เลขที่ใบสั่งซื้อ : ".sprintf('%010d',$order_id)."\n";
										$msg .= " วันที่สั่งซื้อสินค้า : ".Date_TH($order_date)." ".$order_time." \n";		
										$msg .=  " ราคารวม : ".$order_total." บาท \n";
										$msg .=  " รายละเอียดการชำระเงิน : ".$order_method." \n";
										$msg .=  "=======================================";

										if ( $order_status == "Deleted" ) $stus = "<img src='../imgs/cancel.gif'>";
										else  if ( $order_status == "Wait" )  $stus = "<img src='../imgs/wait.gif'>";
										else  if ( $order_status == "Preparing" )  $stus = "<img src='../imgs/preparing.gif'>";
													else  if ( $order_status == "Completed" )   $stus = "<img src='../imgs/completed.gif'>";
																		?>
        <tr bgcolor="<?php echo $bg;?>" onMouseOver="onRowOver(this,'<?php echo $theme_tab2;?>');" onMouseOut="onRowOut(this);" title ="<?php echo $msg;?>"> 
          <td height="23"><div align="center"><strong><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"> 
		  <input  type="checkbox" name="chkID[]" value="<?php echo $order_id; ?>">            
           </font></strong></div></td>		  
		   <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><?=$stus?></div></td>
          <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?=$order_name;?></font></div></td>  
		  <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo Date_TH($order_date)." ".$order_time;?></font></div></td>
		  <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?php echo $members_fname." &nbsp;&nbsp;". $members_lname;?></font></div></td>
		   <td onClick="Record_MouseClick('<?php echo $order_id; ?>')" ><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">&nbsp;<?=number_format($order_total,0,'.',',')?>&nbsp;&nbsp;Bath</font></div></td>
		  
		   <td><div align="center"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><a href="index.php?method=order&process=detail&opt=<?=$opt?>&order_id=<?php echo $order_id;?>"><img src="<?php echo "../imgs/detail.gif";?>" border="0" alt="รายละเอียด"></a>
              : <a href="javascript:Confirm(<?php echo $order_id; ?>)"><img src="<?php echo "../imgs/del.gif";?>" border="0" alt="ลบ"></a></font></div></td>		  
        </tr>
        <?php
		}//end while
		?>
		<tr class='head_font' height="5"><td  colspan="15"></td></tr>    
        <tr class='tr_btn'>
          <td colspan="6" height="25"><div align="left"><font face="MS Sans Serif, Tahoma, sans-serif"></font><font face="MS Sans Serif, Tahoma, sans-serif"></font><font face="MS Sans Serif, Tahoma, sans-serif"></font><font face="MS Sans Serif, Tahoma, sans-serif">
                <input name="deleteall" type="submit" value="Delete order" onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'">
                <input type="button"  name="btCreate2" value="Search order"onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Searchnews() ;">
                </font></div></td>
        </tr>
        <?php
		}
		else
		{
		?>
        <tr> 
          <td colspan="6" height="25"><div align="center">
            <div align="center"><font color="#000000" size="-1" face="MS Sans Serif, Tahoma, sans-serif"><strong>Data 
              Not Found</strong></font></div></td>
        </tr>
		<tr class='head_font' height="5"><td  colspan="15"></td></tr>    
        <tr class='tr_btn'>
          <td height="27" colspan="6"><div align="left"><font face="MS Sans Serif, Tahoma, sans-serif"></font><font face="MS Sans Serif, Tahoma, sans-serif"></font><font face="MS Sans Serif, Tahoma, sans-serif"></font><font face="MS Sans Serif, Tahoma, sans-serif">
                <input type="button"  name="btCreate2" value="Search order" onMouseOver="this.style.cursor='hand'; this.style.color='<?php echo $theme_tab1;?>'" onMouseOut="this.style.color='#000000'" onClick="Searchnews() ;">
                </font></div></td>
        </tr>
        
        <?php
		}
		?>
      </table>
	  </td>
  </tr>
  <tr> 
          <td colspan="6" height="25" bgcolor="<?php echo $theme_tab3;?>">&nbsp;
		  <img src="../imgs/cancel.gif">&nbsp;<?=$deleted?>&nbsp;&nbsp;
		 <img src="../imgs/wait.gif">&nbsp;<?=$wait?> &nbsp; 
		 <img src="../imgs/preparing.gif">&nbsp;<?=$preparing?> &nbsp; 
		  <img src="../imgs/completed.gif">&nbsp;<?=$completed?>  </td>
  </tr>
</table>
  </form>
<?php
}

function changestatus()
{			
							global $db;	
							global $prefix;
							global  $sessionid;

							$order_id =get_var('order_id','request',0);
							$opt = get_var('opt','request',0);
							
							$updatestatus  = sql_Update($prefix."_order","order_status='$opt' ","order_id = '$order_id'  ");
							//echo $updatedisplay;	
							$save_query = $db->sql_query($updatestatus);

							$comment= "ปรับสถานะเป็น Status :  $opt ";

							$oldnote = getn("order_note","order"," order_id = '$order_id' ");
							$newnote = $oldnote."\n\n".$comment."["."By ".$_SESSION[$sessionid]['admin_user']." : ". date("y-m-d H:i:s")."]";
							$sql = "Update ".$prefix."_order set order_note = '$newnote' where order_id = '$order_id'" ;
							$Adjust_Query = $db->sql_query($sql);
					
							if($save_query)
							{	
										$msg = "<font color=blue>SUCCESS !!</font> Update Order Status on success.";
										//echo $msg;									
										$loc = "index.php?method=order&process=detail&order_id=$order_id&msg=$msg";										
							}
							else
							{
									$msg = "<font color=red>ERROR !!</font> can not Update Order Status .";
									//echo $msg;									
									$loc = "index.php?method=order&process=detail&order_id=$order_id&msg=$msg";	
							}
							echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
}

function changestatusPayment()
{			
							global $db;	
							global $prefix;
							global  $sessionid;

							$order_id =get_var('order_id','request',0);
							$opt2 = get_var('opt2','request',0);
							
							$updatestatus  = sql_Update($prefix."_order","order_payment_status='$opt2' ","order_id = '$order_id'  ");
							//echo $updatedisplay;	
							$save_query = $db->sql_query($updatestatus);
							if ($opt2 == 1)	$comment= "ปรับสถานะเป็น Payment : Yes ";
							else $comment= "ปรับสถานะเป็น Payment : No ";
							$oldnote = getn("order_note","order"," order_id = '$order_id' ");
							$newnote = $oldnote."\n\n".$comment."["."By ".$_SESSION[$sessionid]['admin_user']." : ". date("y-m-d H:i:s")."]";
							$sql = "Update ".$prefix."_order set order_note = '$newnote' where order_id = '$order_id'" ;
							$Adjust_Query = $db->sql_query($sql);
					
							if($save_query)
							{	
										$msg = "<font color=blue>SUCCESS !!</font> Update Payment Status on success.";
										//echo $msg;									
										$loc = "index.php?method=order&process=detail&order_id=$order_id&msg=$msg";										
							}
							else
							{
									$msg = "<font color=red>ERROR !!</font> can not Update Payment Status .";
									//echo $msg;									
									$loc = "index.php?method=order&process=detail&order_id=$order_id&msg=$msg";	
							}
							echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
}

function changestatusConfirm()
{			
							global $db;	
							global $prefix;
							global  $sessionid;

							$order_id =get_var('order_id','request',0);
							$opt3 = get_var('opt3','request',0);
							
							$updatestatus  = sql_Update($prefix."_order","order_confirm='$opt3' ","order_id = '$order_id'  ");
							//echo $updatedisplay;	
							$save_query = $db->sql_query($updatestatus);
							if ($opt3 == 1)	$comment= "ปรับสถานะเป็น Confirm : Yes ";
							else $comment= "ปรับสถานะเป็น Confirm : No ";
							$oldnote = getn("order_note","order"," order_id = '$order_id' ");
							$newnote = $oldnote."\n\n".$comment."["."By ".$_SESSION[$sessionid]['admin_user']." : ". date("y-m-d H:i:s")."]";
							$sql = "Update ".$prefix."_order set order_note = '$newnote' where order_id = '$order_id'" ;
							$Adjust_Query = $db->sql_query($sql);
					
							if($save_query)
							{	
										$msg = "<font color=blue>SUCCESS !!</font> Update Confirm Status on success.";
										//echo $msg;									
										$loc = "index.php?method=order&process=detail&order_id=$order_id&msg=$msg";										
							}
							else
							{
									$msg = "<font color=red>ERROR !!</font> can not Update Confirm Status .";
									//echo $msg;									
									$loc = "index.php?method=order&process=detail&order_id=$order_id&msg=$msg";	
							}
							echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
}
?>