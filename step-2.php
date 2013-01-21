<?php
session_start();
//$o_id = $_SESSION['o_id']; 

if ($_SESSION['members_id'] )  {
  echo "<meta http-equiv=\"refresh\" content=\"0;URL=step-2-2.php\">";
exit;  
}
	foreach($_GET as $k=>$v){
		$$k=trim($v);
	}

	foreach($_POST as $k=>$v){
		$$k=trim($v);
	}
include "config.php";
$step2_email = get_var('step2_email','request',0);			
$step2_pass_w = get_var('step2_pass_w','request',0);	
$cv = get_var('cv','request',0);	

	if ($step2_email && $step2_pass_w)
	{							
				// check usernaeme
				$sql = sql_Select(1,$prefix."_members", "members_email ='$step2_email' and members_pass = '$step2_pass_w' and members_active = 1", 0);
				//echo $sql;	exit;
				$query = $db->sql_query($sql);
				$members = $db->sql_fetchrow($query);
				$totalrec = $db->sql_numrows($query);
				
				if ( $totalrec > 0 )
				{														
									$members_id = $members['members_id'];
									session_register("SESSION"); 
									$_SESSION['members_id']=$members_id;  // Check in Function Login
									
									echo "<script>alert('คุณได้ทำการล็อกอินเรียบร้อยแล้ว');</script>";
									$loc = "step-2-2.php?$msg";
									echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
				}
				else
				{					
							echo "<script>alert('Enter the correct user or password.');</script>";
							$loc = "step-2.php?$msg=Enter the correct user or password.";
							echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
				}
						//echo "<br>".$msg;
						/*echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";*/
						//print "<input type='button' name='btgo' value='Go!' onClick='window.navigate(\"$loc\")'>";							
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
			<script language="JavaScript">
				<!--
				function checkvaluesstep2()
				{
						
						if(document.getElementById("form1").elements["step2_email"].value == ""){
							alert("Please enter your email");
							document.getElementById("form1").elements["step2_email"].focus();
							return false;
						}
						
						if(emailCheck(document.getElementById("form1").elements["step2_email"].value) == false){
							document.getElementById("form1").elements["step2_email"].focus();
							return false;
						}

						if(document.getElementById("form1").elements["step2_pass_w"].value == ""){
							alert("Please type your password. ");
							document.getElementById("form1").elements["step2_pass_w"].focus();
							return false;
						}		
							 
						//document.form1.submit();
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
		if(domArr[domArr.length-1].length<2 || 
			domArr[domArr.length-1].length>3){
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
				-->
			</script>
		<form name="form1" id="form1" method="post" enctype="multipart/form-data" onsubmit="return checkvaluesstep2();">
      <table id="Table_01" width="730" height="794" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td colspan="10" background="images/2address-book-registered_01.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" rowspan="3" background="images/2address-book-registered_02.jpg">&nbsp;</td>
          <td height="37" background="images/2address-book-registered_03.jpg" onclick="document.location='step-1.php';" onMouseOver="this.style.cursor='hand';">&nbsp;</td>
          <td background="images/2address-book-registered_04.jpg">&nbsp;</td>
          <td colspan="2" background="images/2address-book-registered_05.jpg">&nbsp;</td>
          <td background="images/2address-book-registered_06.jpg">&nbsp;</td>
          <td background="images/2address-book-registered_07.jpg">&nbsp;</td>
          <td background="images/2address-book-registered_08.jpg">&nbsp;</td>
          <td background="images/2address-book-registered_09.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td height="25" colspan="8" background="images/2address-book-registered_10.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3"><img src="images/2address-book-registered_11.jpg" width="233" height="1" alt=""></td>
          <td colspan="5" rowspan="6" background="images/2address-book-registered_12.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2" rowspan="5" background="images/2address-book-registered_13.jpg">&nbsp;</td>
          <td height="36" colspan="3" background="images/2address-book-registered_14.jpg"><table width="227">
            <tr>
              <td width="55">&nbsp;</td>
              <td width="160"><span class="forage"><strong>&nbsp;Address Book </strong></span><? if ($msg) echo "<font color='red'>*** $msg </font>";?></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="21" colspan="3" background="images/2address-book-registered_15.jpg">
		  <span class="f12small"><strong>&nbsp;Registered Users</strong></span></td>
        </tr>
		
        <tr>
          <td height="47" colspan="3" background="images/2address-book-registered_16.jpg"><table width="200">
            <tr>
              <td><span class="f12small"><strong>Email Address:</strong></span></td>
            </tr>
            <tr>
              <td>
                <input type='text' size="30" name="step2_email" id="step2_email">
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="75" colspan="3" background="images/2address-book-registered_17.jpg"><table width="200">
            <tr>
              <td><span class="f12small"><strong>Password:</strong></span></td>
            </tr>
            <tr>
              <td><input type='password' size="30" name="step2_pass_w" id="step2_pass_w">
              </td>
            </tr>
            <tr>
              <td>
                <label>
                  <input name="submit" type="submit" id="submit" value="Sign in &amp; Checkout">
                  </label>
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="66" colspan="3" background="images/2address-book-registered_18.jpg"><table width="200">
            <tr>
              <td><span class="f12small"><strong>Forgotten your password?</strong></span></td>
            </tr>
            <tr>
              <td><span class="f12small"><strong>Not Registered Yet?</strong></span>
             </td>
            </tr>
            <tr>
              <td>
                <input type="button" name="button" id="button" value="Register &amp; Checkout" onclick="document.location='step-2-2.php';">
              </td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td rowspan="2" background="images/1your-basket_19.jpg">&nbsp;</td>
          <td colspan="4" rowspan="2" background="images/2address-book-registered_20.jpg">&nbsp;</td>
          <td height="197" colspan="5" background="images/2address-book-registered_21.jpg"><img src="images/2address-book-registered_21.jpg" width="476" height="197"></td>
        </tr>
        <tr>
          <td height="249" colspan="5" background="images/2address-book-registered_22.jpg">&nbsp;</td>
        </tr>
        <tr>
          <td><img src="images/spacer.gif" width="20" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="1" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="92" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="85" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="56" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="29" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="86" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="114" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="97" height="1" alt=""></td>
          <td><img src="images/spacer.gif" width="150" height="1" alt=""></td>
        </tr>
      </table></td>
  </tr>
</table>

              </form>
			<!-- End -->  

		   </td>
		<td>&nbsp;</td>
	  </tr>
	</table>

</div>
<div><?php include "footer.php"; ?></div>
</html>
