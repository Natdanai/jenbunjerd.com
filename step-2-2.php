<?

	session_start();

	include "config.php";

	extract($_POST);

//	print_r($_REQUEST);
//$_SESSION['members_id']  =9;
	if ($_SESSION['members_id'] >'0') { $statusfrm = "Modify" ;}

	else { $statusfrm = "Registration";}

//echo  $statusfrm;

	if ($statusfrm == "Modify") {  // regis

			//echo $_SESSION['members_id']."sdfadsf";

			if ($_SESSION['members_id'] ) {

					$had_catalog = getn("members_id","email_catalog", "members_id='".$_SESSION['members_id']."' ");
					if($had_catalog>'0'){
					if($catalog=='1' or  $catalog=='0')
					{
					$sql_catalog = sql_Update($prefix."_email_catalog"," catalog_status= '$catalog'  " , "members_id= '".$_SESSION['members_id']."'");
					$query_catalog =$db->sql_query($sql_catalog);
					}
					}else{
						$insert_mcat = sql_Insert($prefix."_email_catalog","members_id,catalog_status,catalog_enterdate" ,"'".$_SESSION['members_id']."', '$catalog' ,NOW() ");
						$update_query=$db->sql_query($insert_mcat );
					}
	

					//print_r($result);

					
					$detail_sql = sql_Select(1, $prefix."_members", "members_id = '".$_SESSION['members_id']."'", 0);
					//echo  $detail_sql ;
					$detail_query = $db->sql_query($detail_sql);
					$result = $db->sql_fetchrow($detail_query);

					$members_id=stripslashes($result['members_id']);
					$members_title=stripslashes($result['members_title']);
					$members_fname=stripslashes($result['members_fname']);
					$members_lname=stripslashes($result['members_lname']);
					$members_email=stripslashes($result['members_email']);
					$members_pass=stripslashes($result['members_pass']);
					$members_phone_number=stripslashes($result['members_phone_number']);
					$members_jobtitile=stripslashes($result['members_jobtitile']);
					$members_department=stripslashes($result['members_department']);
					$members_company=stripslashes($result['members_company']);
					$members_business_main=stripslashes($result['members_business_main']);
					$members_business_sub=stripslashes($result['members_business_sub']);
					$members_statuscontact=stripslashes($result['members_statuscontact']);
					$members_address_catalogue=stripslashes($result['members_address_catalogue']);
					$members_active=stripslashes($result['members_active']);
					$members_bill_title=stripslashes($result['members_bill_title']);
					$members_bill_fname=stripslashes($result['members_bill_fname']);
					$members_bill_lname=stripslashes($result['members_bill_lname']);
					$members_bill_phone=stripslashes($result['members_bill_phone']);
					$members_bill_department=stripslashes($result['members_bill_department']);   
					$members_bill_company=stripslashes($result['members_bill_company']);
					$members_bill_address1=stripslashes($result['members_bill_address1']);
					$members_bill_district=stripslashes($result['members_bill_district_code']);
					$members_bill_amphur=stripslashes($result['members_bill_amphur_code']);
					$members_bill_province=stripslashes($result['members_bill_province_code']);
					$members_bill_postcode=stripslashes($result['members_bill_postcode']);
					$members_bill_country=stripslashes($result['members_bill_country']);
					$members_shipping_title=stripslashes($result['members_shipping_title']);
					$members_shipping_fname=stripslashes($result['members_shipping_fname']);
					$members_shipping_lname=stripslashes($result['members_shipping_lname']);
					$members_shipping_phone=stripslashes($result['members_shipping_phone']);
					$members_shipping_department=stripslashes($result['members_shipping_department']); 
					$members_shipping_company=stripslashes($result['members_shipping_company']);
					$members_shipping_address1=stripslashes($result['members_shipping_address1']);
					$members_shipping_district=stripslashes($result['members_shipping_district_code']);
					$members_shipping_amphur=stripslashes($result['members_shipping_amphur_code']);
					$members_shipping_province=stripslashes($result['members_shipping_province_code']);
					$members_shipping_postcode=stripslashes($result['members_shipping_postcode']);
					$members_shipping_country=stripslashes($result['members_shipping_country']);		

					$order_bill_company = getn("order_bill_company","order", "order_id='".$_SESSION['o_id']."'");
					if ($_SESSION['o_id'] && $order_bill_company !="" ){   // load from table order
								//echo "load-Order";
								$detail_sql = sql_Select(1, $prefix."_order", "order_id = '".$_SESSION['o_id']."'", 0);
								//echo  $detail_sql ;
								$detail_query = $db->sql_query($detail_sql);
								$result = $db->sql_fetchrow($detail_query);

								
								$members_bill_title=stripslashes($result['order_bill_title']);
								$members_bill_fname=stripslashes($result['order_bill_fname']);
								$members_bill_lname=stripslashes($result['order_bill_lname']);
								$members_bill_phone=stripslashes($result['order_bill_phone']);
								$members_bill_department=stripslashes($result['order_bill_department']);   
								$members_bill_company=stripslashes($result['order_bill_company']);
								$members_bill_address1=stripslashes($result['order_bill_address']);
								$members_bill_district=stripslashes($result['order_bill_district_code']);
								$members_bill_amphur=stripslashes($result['order_bill_amphur_code']);
								$members_bill_province=stripslashes($result['order_bill_province_code']);
								$members_bill_postcode=stripslashes($result['order_bill_postcode']);
								$members_bill_country=stripslashes($result['order_bill_country']);
								$members_shipping_title=stripslashes($result['order_shipping_title']);
								$members_shipping_fname=stripslashes($result['order_shipping_fname']);
								$members_shipping_lname=stripslashes($result['order_shipping_lname']);
								$members_shipping_phone=stripslashes($result['order_shipping_phone']);
								$members_shipping_department=stripslashes($result['order_shipping_department']); 
								$members_shipping_company=stripslashes($result['order_shipping_company']);
								$members_shipping_address1=stripslashes($result['order_shipping_address']);
								$members_shipping_district=stripslashes($result['order_shipping_district_code']);
								$members_shipping_amphur=stripslashes($result['order_shipping_amphur_code']);
								$members_shipping_province=stripslashes($result['order_shipping_province_code']);
								$members_shipping_postcode=stripslashes($result['order_shipping_postcode']);
								$members_shipping_country=stripslashes($result['order_shipping_country']);


					} // end if 
					//else echo "from profile";

								$members_catalog =getn("catalog_status","email_catalog","members_id='$members_id' ");
								//  echo"members_catalog =$members_catalog";
			}
} // enc if ($statusfrm == "Modify") {  // regis


			//insert date to Order Table



			//echo "keep data to order table" ;   //exit;

			if ($frm_action == "Modify" ) {
			$o_id = $_SESSION['o_id'];
			$b_title=addslashes($b_title);
			$b_fname=addslashes($b_fname);
			$b_lname=addslashes($b_lname);
			$b_phone=addslashes($b_phone);
			$b_company=addslashes($b_company);
			$b_department=addslashes($b_department);
			$b_address=addslashes(trim($b_address));
			$b_district=addslashes($b_district);
			$b_amphur=addslashes($b_amphur);
			$b_province=addslashes($b_province);
			$b_postcode=addslashes($b_postcode);
			$b_country=addslashes($b_country);
			$s_title=addslashes($s_title);
			$s_fname=addslashes($s_fname);
			$s_lname=addslashes($s_lname);
			$s_phone=addslashes($s_phone);
			$s_company=addslashes($s_company);
			$s_department=addslashes($s_department);
			$s_address=addslashes(trim($s_address));
			$s_district=addslashes($s_district);
			$s_amphur=addslashes($s_amphur);
			$s_province=addslashes($s_province);
			$s_post=addslashes($s_postcode);
			$s_country=addslashes($s_country);			

				//  Update data to order for modify

				$sql_order = sql_Update($prefix."_order","members_id=".$_SESSION['members_id'].",order_date =NOW(),order_time=NOW(),order_bill_title='$b_title',order_bill_fname='$b_fname',  order_bill_lname='$b_lname' , order_bill_phone='$b_phone' , order_bill_department ='$b_department' ,  order_bill_company ='$b_company' ,  order_bill_address='$b_address',  order_bill_district_code='$b_district' , order_bill_amphur_code ='$b_amphur' ,order_bill_province_code='$b_province' , order_bill_postcode= '$b_postcode'   ,order_bill_country='$b_country'  ,order_shipping_title='$s_title'  ,order_shipping_fname  ='$s_fname',order_shipping_lname='$s_lname' , order_shipping_phone='$s_phone' ,order_shipping_department= '$s_department',order_shipping_company='$s_company'  ,order_shipping_address  ='$s_address',order_shipping_district_code ='$s_district' , order_shipping_amphur_code='$s_amphur'   ,order_shipping_province_code='$s_province' , order_shipping_postcode ='$s_postcode' ","order_id='$o_id'");

			//echo"sql_order= $sql_order"; exit();

			$query_order=$db->sql_query($sql_order);		
			
			echo '<div id="loading" style="filter:alpha(opacity=30)"><table width="100%" height="100%"><tr><td valign="middle" align="center"><font face="MS Sans Serif" size="4" color="#333333"><B>Loading . . . . </B><br><br> <img src="imgs/loading.gif"></font></td></tr></table></div>';

			if($query_order){ 
				echo "<meta http-equiv=\"refresh\" content=\"0;URL=step-3.php\">";}

			}
			elseif($frm_action == "Registration" ){
			$b_title=addslashes($b_title);
			$b_fname=addslashes($b_fname);
			$b_lname=addslashes($b_lname);
			$b_phone=addslashes($b_phone);
			$b_department=addslashes($b_department);
			$b_company=addslashes($b_company);
			$b_address=addslashes(trim($b_address));
			$b_district=addslashes($b_district);
			$b_amphur=addslashes($b_amphur);
			$b_province=addslashes($b_province);
			$b_postcode=addslashes($b_postcode);
			$b_country=addslashes($b_country);
			$s_title=addslashes($s_title);
			$s_fname=addslashes($s_fname);
			$s_lname=addslashes($s_lname);
			$s_phone=addslashes($s_phone);
			$s_department=addslashes($s_department);
			$s_company=addslashes($s_company);
			$s_address=addslashes(trim($s_address));
			$s_district=addslashes($s_district);
			$s_amphur=addslashes($s_amphur);
			$s_province=addslashes($s_province);
			$s_postcode=addslashes($s_postcode);
			$s_country=addslashes($s_country);

			//echo "(".$_POST['securitycode']." == ".$_SESSION["security_code"].")";
			if ($_POST['securitycode'] == $_SESSION["security_code"]){
				
					$sql = sql_Select(1,$prefix."_members", "members_email ='$step2_email' ", 0);
					//echo $sql;
					$query = $db->sql_query($sql);
					$mem = $db->sql_fetchrow($query);
					$totalrec = $db->sql_numrows($query);
					$txt_secure = "F:".$_POST['securitycode'].",S:".$_SESSION["security_code"]." [".date("Y-m-d H:i:s")."] (s)";
						
					if ( $totalrec == 0 ){
							$ip = $_SERVER["REMOTE_ADDR"];
							$pre_mem_name =date('y'). date('m');
							$memrun = getn("count(*)", "order","members_code like '$pre_mem_name%' ")+1;
							$members_code = date('y'). date('m').sprintf('%05d',$memrun);
							$members_sql = sql_insert($prefix."_members","members_code ,members_title,members_fname,members_lname,members_email,members_pass,members_phone_number,members_jobtitile,members_department,members_company,  members_business_main , members_business_sub,members_statuscontact ,members_address_catalogue,members_active,members_bill_title,members_bill_fname,members_bill_lname,members_bill_phone,members_bill_department,members_bill_company,members_bill_address1,members_bill_district_code,members_bill_amphur_code,members_bill_province_code,members_bill_postcode,members_bill_country,members_shipping_title,members_shipping_fname,members_shipping_lname,members_shipping_phone,members_shipping_department,members_shipping_company,members_shipping_address1,members_shipping_district_code,members_shipping_amphur_code,members_shipping_province_code,members_shipping_postcode,members_shipping_country,members_ip,members_securetxtcode,`members_registerdate`,`member_update`"," '$members_code','$title','$fname','$lname','$step2_email','$step2_pass','$phone','$jobtittle','$department','$company','$business_main','$business_sub','$contactstatus','$address_catalogue','1','$b_title','$b_fname','$b_lname','$b_phone','$b_department','$b_company','$b_address','$b_district','$b_amphur','$b_province','$b_postcode','$b_country','$s_title','$s_fname','$s_lname','$s_phone','$s_department','$s_company','$s_address','$s_district','$s_amphur','$s_province','$s_postcode','$s_country','$ip','$txt_secure','".date("Y-m-d H:i:s")."','00-00-0000' ");
						
						$save_query = $db->sql_query($members_sql);
						$save_id = $db->sql_nextid();
						$members_code = date('y'). date('m').sprintf('%05d',$save_id);
						$members_sql = sql_Update($prefix."_members","members_code = '$members_code' ","members_id = '$save_id'  ");
						$save_query = $db->sql_query($members_sql);

						if ($save_query){
							$username = $step2_email;
							$pass_w = $step2_pass;

							if ($username && $pass_w)
							{							
								// check usernaeme
								$sql = sql_Select(1,$prefix."_members", "members_email ='$step2_email' and members_pass = '$step2_pass' and members_active=1", 0);
								//echo $sql;	exit;
								$query = $db->sql_query($sql);
								$members = $db->sql_fetchrow($query);
								$totalrec = $db->sql_numrows($query);
								
								if ( $totalrec > 0 )
								{														
									$members_id = $members['members_id'];
									session_register("SESSION"); 
									$_SESSION['members_id']=$members_id;  // Check in Function Login
									if($catalog =='1'){
										$sql_catalog = sql_Insert($prefix."_email_catalog","members_id , catalog_status, catalog_enterdate"," '$members_id' , '1',NOW() ");
										$query = $db->sql_query($sql_catalog );
									}
									/*echo "<script>alert('Login Completed. ');</script>";*/
									$loc = "step-2-2.php";
									echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
								}
								else
								{					
									echo "<script>alert('Enter the correct user or password.');</script>";
									$loc = "step-2-2.php";	
									echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
								}

							}
						}
						
					}
					else{
						$msg = "&nbsp;&nbsp;<font color=red>Username is not available....!! </font><br>";
						//print_r($_POST);

					}
			} // if check code
			else{
						$msg2 = "&nbsp;&nbsp;<font color=red>Security Code is not Correct....!! </font><br>";
			}
			
							$members_title=addslashes($title);
							$members_fname=addslashes($fname);
							$members_lname=addslashes($lname);
							$members_email=addslashes($step2_email);
							$members_phone_number=addslashes($phone);
							$members_jobtitile=addslashes($jobtittle);
							$members_department=addslashes($department);
							$members_company=addslashes($company);
							$members_business_main=addslashes($business_main);
							$members_business_sub=addslashes($business_sub);
							$members_catalogue=addslashes($catalogue);
							$members_address_catalogue=addslashes($address_catalogue);
							
							$members_bill_title=addslashes($b_title);
							$members_bill_fname=addslashes($b_fname);
							$members_bill_lname=addslashes($b_lname);
							$members_bill_phone=addslashes($b_phone);
							$members_bill_department=addslashes($b_department);
							$members_bill_company=addslashes($b_company);
							$members_bill_address1=addslashes(trim($b_address));
							$members_bill_district=addslashes($b_district);
							$members_bill_amphur=addslashes($b_amphur);
							$members_bill_province=addslashes($b_province);
							$members_bill_postcode=addslashes($b_postcode);
							$members_bill_country=addslashes($b_country);
							$members_shipping_title=addslashes($s_title);
							$members_shipping_fname=addslashes($s_fname);
							$members_shipping_lname=addslashes($s_lname);
							$members_shipping_phone=addslashes($s_phone);
							$members_shipping_department=addslashes($s_department);
							$members_shipping_company=addslashes($s_company);
							$members_shipping_address1=addslashes(trim($s_address));
							$members_shipping_district=addslashes($s_district);
							$members_shipping_amphur=addslashes($s_amphur);
							$members_shipping_province=addslashes($s_province);
							$members_shipping_postcode=addslashes($s_postcode);
							$members_shipping_country=addslashes($s_country);		
						 //echo "<meta http-equiv='refresh' content='0; URL=?msg=$msg'> ";

	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/clsFont.css" type="text/css" media="screen" />
<title>Jenbunjerd Co Ltd : บริษัท เจนบรรเจิด จำกัด <? echo $_REQUEST[title_name]; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language="javascript" src="js/win_func.js"></script>
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
	  <form name="frm_member" method="POST">
                <input type="hidden" name="frm_action" id="frm_action" value="<?=$statusfrm;?>" />
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

			<!-- Start -->			<script language="JavaScript">
			<!--
			function checkvalues3()
			{	  				

					 if (document.getElementById("fname").value=="")
					{
								alert(" Please Insert Your First Name ");
								document.getElementById("fname").focus();
								return false;
					 }	

					 if (document.getElementById("lname").value=="")
					{
								alert(" Please Insert Your Last Name ");
								document.getElementById("lname").focus();
								return false;
					 }

					 if (document.getElementById("step2_email").value=="")
					{
								alert(" Please Insert Your Email ");
								document.getElementById("step2_email").focus();
								return false;
					 }

					if(emailCheck(document.getElementById("step2_email").value) == false){
						document.getElementById("step2_email").focus();
						return false;
					}
					
					 <?

						  if(!$_SESSION['members_id'] ) {
						 ?>

					if( document.getElementById("step2_pass").value == ""){
						alert("Please Insert Your Password ");
						document.getElementById('step2_pass').focus();
						return false;

					}
					 step2_pass_num = document.getElementById("step2_pass").value.length;
					 //alert(document.getElementById("step2_pass").value.length);
					if(step2_pass_num < 5){
						alert("กรุณากรอกรหัสผ่าน อย่างน้อย 5 ตัวอักษร");						
						document.getElementById("step2_pass").focus();
						return false;
					}

					if(document.getElementById("c_pass").value == ""){
						alert("Please Insert Your Confirm Password");
						document.getElementById("c_pass").focus();
						return false;
					}

					 if(document.getElementById("step2_pass").value != document.getElementById("c_pass").value){
						alert("Password is not equal Confirm Password");
						document.getElementById("step2_pass").value = "";
						document.getElementById("c_pass").value = "";
						document.getElementById("step2_pass").focus();
						return false;
					 }	 
						  <?
						 }
						 ?>

					 if (document.getElementById("phone").value=="")
					{
								alert(" Please Insert Your Phone ");
								document.getElementById("phone").focus();
								return false;
					 }
					 
					 phonetxt = document.getElementById("phone").value;
					 if (phonetxt.charAt(0) != '0')
					 {
						 alert('หมายเลขโทรศัพท์ตัวแรกไม่เท่ากับ 0');
						 document.getElementById("phone").focus();
						 return false;
					 }

					 phone_length = document.getElementById("phone").value.length;
					 //alert(phone_length);
					if( phone_length < 7){
						alert("ความยาวหมายเลขโทรศัพท์ของท่านไม่ถูกต้อง");
						document.getElementById("phone").focus();
						return false;
					}
					
					 if (document.getElementById("business_main").value=="")
					{
								alert(" Please Insert Your business type");
								document.getElementById("business_main").focus();
								return false;
					 }
					 if (document.getElementById("business_sub") != null)
					 {
							 if (document.getElementById("business_sub").value=="")
							{
										alert(" Please Insert Your sub business type");
										document.getElementById("business_sub").focus();
										return false;
							 }

					 }
					 <?

						  if(!$_SESSION['members_id'] ) {
						 ?>
					 if (document.getElementById("securitycode").value=="")
					{
								alert(" Please Insert Your Security Code");
								document.getElementById("securitycode").focus();
								return false;
					 }
					 <?}?>

					 window.document.forms['frm_member'].submit();
			}

			function emailCheck(emailStr){

					var emailPat=/^(.+)@(.+)$/
					var specialChars="\\(\\)<>@,;:\\\\\\\"\\.\\[\\]";
					var validChars="\[^\\s" + specialChars + "\]";
					var quotedUser="(\"[^\"]*\")";
					var ipDomainPat=/^\[(\d{1,3})\.(\d{1,3})\.(\d{1,3})\.(\d{1,3})\]$/
					var atom=validChars + '+';
					var word="(" + atom + "|" + quotedUser + ")";
					var userPat=new RegExp("^" + word + "(\\." + word + ")*$");
					var domainPat=new RegExp("^" + atom + "(\\." + atom +")*$");
					var matchArray=emailStr.match(emailPat);
					if(matchArray==null){
						alert("Email address seems incorrect (check @ and .'s)");
						return false;
					}

					var user=matchArray[1];
					var domain=matchArray[2];
					if(user.match(userPat)==null){
						alert("The username doesn't seem to be valid.");
						return false;
					}

					var IPArray=domain.match(ipDomainPat);
					if(IPArray!=null){

						// this is an IP address
						for(var i=1;i<=4;i++){
							if(IPArray[i]>255){
								alert("Destination IP address is invalid!");
								return false;
							}
						}
						return true;
					}

					var domainArray=domain.match(domainPat);
					if(domainArray==null){
						alert("The domain name doesn't seem to be valid.");
						return false;
					}

					var atomPat=new RegExp(atom,"g");
					var domArr=domain.match(atomPat);
					var len=domArr.length;
					if(domArr[domArr.length-1].length<2 || 	domArr[domArr.length-1].length>3){
						alert("The address must end in a three-letter domain, or two letter country.");
						return false;
					}

					if(len<2){

						var errStr="This address is missing a hostname!";

						alert(errStr);

						return false;

					}

					return true;

				}

				function copyvalue(){
							document.getElementById('s_fname').value = document.getElementById('b_fname').value;

							document.getElementById('s_lname').value = document.getElementById('b_lname').value;

							document.getElementById('s_phone').value = document.getElementById('b_phone').value;
							document.getElementById('s_department').value = document.getElementById('b_department').value;
							document.getElementById('s_company').value = document.getElementById('b_company').value;
							document.getElementById('s_address').value = document.getElementById('b_address').value;
//alert( "b_district  = "+document.getElementById('b_district').value);
							document.forms['frm_member'].s_title.value = document.forms['frm_member'].b_title.value;				
						//	setTimeout("",(1 * 1000));
							document.getElementById('s_province').value = document.getElementById('b_province').value
					//		alert( "s_province  = "+document.getElementById('s_province').value);						
							setTimeout("SChangeAmphur(document.getElementById('b_amphur').value ); ",1000);				
					//	alert( "s_amphur  = "+document.getElementById('s_amphur').value);
						
				setTimeout("SChangeDistrict(document.getElementById('b_district').value); ",3000);
				document.getElementById("s_postcode").value =document.getElementById("b_postcode").value ;
				}

			-->

			</script>
			<? include("banner.php");?>		  <br />
		  <table width="729" border="0" cellspacing="0" cellpadding="0">
              <tr>
			
                <td width="21" valign="top">&nbsp;</td>
                <td valign="top" bgcolor="#E4A301"><img src="images/2address-book-registered-2_03.jpg" width="92" height="38" alt="" onclick="document.location='step-1.php';" onmouseover="this.style.cursor='hand';" /><img src="images/2address-book-registered-2_04.jpg" width="85" height="38" alt="" /><img src="images/2address-book-registered-2_05.jpg" width="85" height="38" alt="" /><img src="images/2address-book-registered-2_06.jpg" width="86" height="38" alt="" /><img src="images/2address-book-registered-2_07.jpg" width="114" height="38" alt="" /><img src="images/2address-book-registered-2_08.jpg" width="97" height="38" alt="" /></td>
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
                      <td><table width="191">
                          <tr>
                            <td width="51"><div align="right"><img src="images/2_number2.gif" width="20" height="20" /></div></td>
                            <td width="128"><span class="forage"><strong>&nbsp;สถานที่ติดต่อ </strong></span></font></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><span class="f12small"><strong>
                        <? if ($msg) echo $msg;?>
                        &nbsp;&nbsp;</strong></span></td>
                    </tr>
                    <tr>
                      <td><table width="550" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td valign="top" bgcolor="#E6E6E6"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                <tr>
                                  <td width="3%">&nbsp;</td>
                                  <td width="97%"><img src="images/2_button_account.gif" width="182" height="28" /></td>
                                </tr>
                              </table>
                                <br />
                                <table width="520" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td valign="top" bgcolor="#000000"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                        <tr>
                                          <td valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td><font color="#000000" size="1" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;</strong></font></td>
                                              </tr>
                                              <tr>
                                                <td height="15"><img src="images/2_line.gif" width="490" height="5" /></td>
                                              </tr>
                                              <tr>
                                                <td><table width="95%" border="0" cellpadding="2" cellspacing="2">
                                                    <tr>
                                                      <td width="30%" valign="middle"><span class="f12small"><strong>คำนำหน้าชื่อ:</strong></span></td>
                                                      <td width="70%" valign="top"><?=DropdownTitle("title", $members_title, true, "class=\"selectstyle\" style='width:150px' ")?></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>* ชื่อ:</strong></span></td>
                                                      <td valign="top"><input type="text" name="fname" id="fname" value="<?=$members_fname?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>*   นามสกุล:</strong></span></td>
                                                      <td valign="top"><input type="text" name="lname" id="lname" value="<?=$members_lname?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>*   E-mail:</strong></span></td>
                                                      <td valign="top"><input type="text" name="step2_email" id="step2_email" value="<?=$members_email?>"  size="40"/><? if ($msg) echo "<br><font color='red' size='1' face='MS Sans Serif, Tahoma, sans-serif'><strong>$msg</strong></font>";?></td></td>
                                                    </tr>
                                                    <tr <? if($_SESSION['members_id'] >0){?>style="display:none" <? }?>>
                                                      <td valign="middle"><span class="f12small"><strong>*   รหัสผ่าน:</strong></span></td>
                                                      <td valign="top"><input type="password" name="step2_pass" id="step2_pass" />
                                                          <span class="f12small"><strong>5 characters long</strong></span></td>
                                                    </tr>
                                                    <tr <? if($_SESSION['members_id'] >0){?>style="display:none" <? }?>>
                                                      <td valign="middle"><span class="f12small"><strong>*  พิมพ์รหัสผ่าน อีกครั้ง:</strong></span></td>
                                                      <td valign="top"><input type="password" name="c_pass" id="c_pass" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>* เบอร์โทรศัพท์:</strong></span></td>
                                                      <td valign="top"><input type="text" name="phone" id="phone" value="<?=$members_phone_number?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ตำแหน่งงาน:</strong></span></td>
                                                      <td valign="top"><input type="text" name="jobtittle" id="jobtittle" value="<?=$members_jobtitile?>"  size="40"/></td>
                                                    </tr>
													   <tr>
                                                      <td valign="middle"><span class="f12small"><strong>แผนก:</strong></span></td>
                                                      <td valign="top"><input type="text" name="department" id="department" value="<?=$members_department?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ชื่อบริษัท:</strong></span></td>
                                                      <td valign="top"><input type="text" name="company" id="company" value="<?=$members_company?>"  size="40"/></td>
                                                    </tr>
                                                    
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>*  ประเภทธุรกิจ:</strong></span> </td>
                                                      <td valign="top"><?=DropdownBusinessMain("business_main",$members_business_main,true,"onchange=ChangeBusinessSub(0)");?></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>*  ประเภทธุรกิจย่อย:</strong></span> </td>
                                                      <td valign="top"><div id = "Div_business_sub"><? if($members_business_sub=='') echo "-"; else echo DropdownBusinessSub("business_sub",$members_business_sub,true,false,$members_business_main);?></div></td>
                                                    </tr>
													<tr>
                                                      <td valign="middle"><span class="f12small"><strong>*  ส่งข่าวสาร:</strong></span></td>
                                                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
													  <script language="javascript">
						function enews_onclick()
						{
							if(document.frm_member.chkcatalog.checked == true) {document.frm_member.catalog.value='1';}else{document.frm_member.catalog.value='0';}
						}
						</script>
						<? if (!isset($members_statuscontact))  $members_statuscontact  = 1;?>
                                                          <tr>
                                                            <td width="25"><input name="contactstatus" type="radio" id="contactstatus" value="1" <? if($members_statuscontact =='1') echo "checked='checked'  ";?> /></td>
                                                            <td width="35"><span class="f12small"><strong>ได้</strong></span></td>
                                                            <td width="25"><input type="radio" name="contactstatus" id="contactstatus4" value="0"  <? if($members_statuscontact =='0') echo "checked='checked'  ";?>  /></td>
                                                            <td width="45"><span class="f12small"><strong>ไม่ได้</strong></span></td>
                                                            <td width="25"><input type="checkbox" name="chkcatalog" id="chkcatalog"   <? if($members_catalog >'0') echo "checked='checked'  ";?>   <? if($members_catalog >'1') echo "disabled='disabled'  ";?>  onclick="enews_onclick();"  />
                                                                <input type="hidden" name="catalog"  id="catalog" /></td>
                                                            <td><span class="f12small"><strong>รับCatalogทางไปรษณีย์</strong></span></td>
                                                          </tr>
                                                      </table></td>
                                                    </tr>
													 <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ที่อยู่สำหรับส่ง Catalogue</strong></span></td>
                                                      <td valign="top"><textarea name="address_catalogue" style="width:200px; height:70px;" id="address_catalogue"><?=$members_address_catalogue?></textarea></td>
                                                    </tr>
                                                    <? if(!$_SESSION['members_id']) { ?>
													 <tr>
                                                      <td valign="middle"><span class="f12small"><strong>&nbsp;&nbsp;* Security Code</strong></span></td>
                                                      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
														<tr align="left" valign="middle">
														  <td width="25%">
														  <TABLE>
														  <TR>
															<TD><img src='securitycode/gdimage.php?width=110&height=33&characters=7' border='1' alt='SECURITYCODE' title='SECURITYCODE' valign='middle'></TD>
														  </TR>
														  </TABLE></td>
														  <td width="2%">&nbsp;</td>
														  <td width="73%"><input name="securitycode" type="text"  id="securitycode" value=""  style="width:85px;height:22px"><? if ($msg2) echo "<br><font color='red' size='1' face='MS Sans Serif, Tahoma, sans-serif'><strong>$msg2</strong></font>";?></td>
														</tr>
													  </table></td>
                                                    </tr>
													<? } ?>
												
                                                </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                </table>
                              <br />
                                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                    <td width="3%">&nbsp;</td>
                                    <td width="97%"><img src="images/2_button_billing.gif" width="182" height="28" /></td>
                                  </tr>
                                </table>
                              <br />
                                <table width="520" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td valign="top" bgcolor="#000000"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                        <tr>
                                          <td valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td height="15"><img src="images/2_line.gif" width="490" height="5" /></td>
                                              </tr>
                                              <tr>
                                                <td><table width="95%" border="0" cellpadding="2" cellspacing="2">
                                                    <tr>
                                                      <td width="30%" valign="middle"><span class="f12small"><strong>คำนำหน้าชื่อ:</strong></span></td>
                                                      <td width="70%" valign="top"><?=DropdownTitle("b_title", $members_bill_title, true, "class=\"selectstyle\" style='width:150px' ")?></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ชื่อ:</strong></span></td>
                                                      <td valign="top"><input type="text" name="b_fname" id="b_fname" value="<?=$members_bill_fname?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>นามสกุล:</strong></span></td>
                                                      <td valign="top"><input type="text" name="b_lname" id="b_lname" value="<?=$members_bill_lname?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>เบอร์โทรศัพท์:</strong></span></td>
                                                      <td valign="top"><input type="text" name="b_phone" id="b_phone" value="<?=$members_bill_phone?>"  size="40"/></td>
                                                    </tr>
													 <tr>
                                                      <td valign="middle"><span class="f12small"><strong>แผนก:</strong></span></td>
                                                      <td valign="top"><input type="text" name="b_department" id="b_department" value="<?=$members_bill_department?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ชื่อบริษัท:</strong></span></td>
                                                      <td valign="top"><input type="text" name="b_company" id="b_company"  value="<?=$members_bill_company?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ที่อยู่ </strong></span></td>
                                                      <td valign="top"><textarea name="b_address" id="b_address" style="width:200px; height:70px;"><?=$members_bill_address1?></textarea></td>
                                                    </tr>
                                               
                                                    <tr style="display:none">
                                                      <td valign="middle"><span class="f12small"><strong>ประเทศ:</strong></span></td> 
                                                      <td valign="top"><div id = "div_b_country">
                                                        <? if (!isset($members_bill_country)) $members_bill_country = "00172"; ?>
                                                        <?=DropdownCountry("b_country",$members_bill_country,false,"onchange=ChangeProvince('$members_bill_province')")?>
                                                      </div></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>จังหวัด:</strong></span></td>
                                                      <td valign="top"><div id = "Div_b_province">  <? if (!isset($members_bill_province)) $members_bill_province = "00001"; ?><?=DropdownProvince("b_province",$members_bill_province,false,"onchange=ChangeAmphur('$members_bill_amphur')")?></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>อำเภอ</strong></span></td>
                                                      <td valign="top"><div id = "Div_b_amphur"><?=DropdownAmphur("b_amphur",$members_bill_amphur,false,"onchange=ChangeDistrict('$members_bill_district')",$members_bill_province)?></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ตำบล:</strong></span></td>
                                                      <td valign="top"><div id = "Div_b_district">
                  <?=DropdownDistrict("b_district",$members_bill_district,false,false,$members_bill_amphur)?>
                </div></td>
                                                    </tr>
													
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>รหัสไปรษณีย์:</strong></spant></td>
                                                      <td valign="top"><input type="text" name="b_postcode" id="b_postcode"value="<?=$members_bill_postcode?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle">&nbsp;</td>
                                                      <td valign="top">&nbsp;</td>
                                                    </tr>
													
                                                </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                </table>
                              <br />
                                <table width="100%" border="0" cellspacing="1" cellpadding="1">
                                  <tr>
                                    <td width="3%">&nbsp;</td>
                                    <td width="97%"><img src="images/2_button_shipping_info.gif" width="182" height="28" /></td>
                                  </tr>
                                </table>
                              <br />
                                <table width="520" border="0" align="center" cellpadding="0" cellspacing="0">
                                  <tr>
                                    <td valign="top" bgcolor="#000000"><table width="100%" border="0" cellspacing="1" cellpadding="1">
                                        <tr>
                                          <td valign="top" bgcolor="#FFFFFF"><table width="95%" border="0" align="center" cellpadding="0" cellspacing="0">
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td><input type="button" name="button2" id="button2" value="คลิกเพื่อคัดลอกข้อมูลที่อยู่ใบเสร็จ" onclick="copyvalue()" /></td>
                                              </tr>
                                              <tr>
                                                <td height="15"><img src="images/2_line.gif" width="490" height="5" /></td>
                                              </tr>
                                              <tr>
                                                <td><table width="95%" border="0" cellpadding="2" cellspacing="2">
                                                    <tr>
                                                      <td width="30%" valign="middle"><span class="f12small"><strong>คำนำหน้าชื่อ:</strong></span></td>
                                                      <td width="70%" valign="top"><?=DropdownTitle("s_title", $members_shipping_title, true, "class=\"selectstyle\" style='width:150px' ")?></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ชื่อ:</strong></span></td>
                                                      <td valign="top"><input type="text" name="s_fname" id="s_fname" value="<?=$members_shipping_fname?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>นามสกุล:</strong></span></td>
                                                      <td valign="top"><input type="text" name="s_lname" id="s_lname" value="<?=$members_shipping_lname?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>เบอร์โทรศัพท์</strong></span></td>
                                                      <td valign="top"><input type="text" name="s_phone" id="s_phone" value="<?=$members_shipping_phone?>"  size="40"/></td>
                                                    </tr>
													 <tr>
                                                      <td valign="middle"><span class="f12small"><strong>แผนก:</strong></span></td>
                                                      <td valign="top"><input type="text" name="s_department" id="s_department" value="<?=$members_shipping_department?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ชื่อบริษัท:</strong></span></td>
                                                      <td valign="top"><input type="text" name="s_company" id="s_company" value="<?=$members_shipping_company?>"  size="40"/></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ที่อยู่ </strong></span></td>
                                                      <td valign="top"><textarea name="s_address" id="s_address" style="width:200px; height:70px;"><?=$members_shipping_address1?></textarea>
													  </td>
                                                    </tr>                                                
                                                    <tr style="display:none">
                                                      <td valign="middle"><span class="f12small"><strong>ประเทศ:</strong></span></td>
                                                      <td valign="top"><div id = "div_s_country">
                  <? if (!isset($members_shipping_country)) $members_shipping_country = "00172"; ?>
                                                      <?=DropdownCountry("s_country",$members_shipping_province,false,"onchange=ChangeProvince('$members_shipping_province')")?>
                                                      </div></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>จังหวัด:</strong></span></td>
                                                      <td valign="top"><div id = "Div_s_province"> 
													    <? if (!isset($members_shipping_province)) $members_shipping_province = "00001"; ?>
                  <?=DropdownProvince("s_province",$members_shipping_province,false,"onchange=SChangeAmphur('$members_shipping_amphur')")?></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>อำเภอ</strong></span></td>
                                                      <td valign="top"><div id = "Div_s_amphur"> <? if (!isset($members_shipping_amphur)) $members_shipping_amphur = "00001"; ?><?=DropdownAmphur("s_amphur",$members_shipping_amphur,false,"onchange=SChangeDistrict('$members_shipping_district')",$members_shipping_province)?></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>ตำบล:</strong></span></td>
                                                      <td valign="top"><div id = "Div_s_district">
                  <?=DropdownDistrict("s_district",$members_shipping_district,false,false,$members_shipping_amphur)?>
                </div></td>
                                                    </tr>
													  <script >/*
			  ChangeProvince("<?=$members_bill_province?>");
			  ChangeAmphur("<?=$members_bill_amphur?>");
			  ChangeDistrict("<?=$members_bill_district?>");
			  SChangeProvince("<?=$members_shipping_province?>");
			  SChangeAmphur("<?=$members_shipping_amphur?>");
			  SChangeDistrict("<?=$members_shipping_district?>");*/
			  </script>
                                                    <tr>
                                                      <td valign="middle"><span class="f12small"><strong>รหัสไปรษณีย์:</strong></span></td>
                                                      <td valign="top"><input type="text" name="s_postcode" id="s_postcode" value="<?=$members_shipping_postcode?>" /></td>
                                                    </tr>
                                                    <tr>
                                                      <td valign="middle">&nbsp;</td>
                                                      <td valign="top">&nbsp;</td>
                                                    </tr>
                                                </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                    </table></td>
                                  </tr>
                                </table>
                              <br />
                                <br /></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><table width="90%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="68%">&nbsp;</td>
                            <td width="32%" height="40"><img src="images/btn_checkout.gif" width="187" height="25" onclick="checkvalues3()" onmouseover="this.style.cursor='hand';" /></td>
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

