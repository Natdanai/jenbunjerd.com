<?php
	session_start();
	$base = "../";
    include "../config.php";
	$SessionID = session_id();
	//print_r($_SESSION[$SessionID]);
	
	global $admin_user,$admin_id,$admin_theme;		

	$admin_user = $_SESSION[$SessionID]['admin_user'];
	$id = $_SESSION[$SessionID]['admin_id'];

	$admin_sql = sql_Select(1, $prefix."_admin", "admin_id ='$id' ", 0);
	$admin_query = $db->sql_query($admin_sql);
	$admin = $db->sql_fetchrow($admin_query);

	$admin_name = $admin['admin_name'];
	$admin_lastname =$admin['admin_lastname'];
	$admin_priority = $admin['admin_priority'];
	$admin_company = $admin['admin_company'];
	$admin_telephone = $admin['admin_fax'];
	$admin_email = $admin['admin_email'];
	$admin_hotels_id = $admin['admin_hotels_id'];

	if ( $admin_hotels_id != 0 )  {
		$Abb_Code =  getn("hotels_abbreviation","hotels","hotels_id = '$admin_hotels_id' ");
	}

	$admin_head = $admin['admin_head'];
	$admin_spacial = $admin['admin_spacial'];
	
	$admin_menu = $admin['admin_menu'];	
	$admin_assign =  $admin['admin_assign'];	
	$admin_theme = $admin['admin_theme'];  
	$keep_menu = explode("-",$admin_menu);  //print_r($keep_menu); echo "<br>";
	$keep_assign = explode("-",$admin_assign);  //print_r($keep_menu); 

	$permission_menu = getn("permission_configmenu","permission","permission_id = '$admin_priority' ");
	$keep_permission_menu = explode("-",$permission_menu);  //print_r($keep_permission_menu); 

	$method = get_var('method','request',0);
	$process = get_var('process','request',0);
	$action = get_var('action','request',0);
	$msg = get_var('msg','request',0);	

	if (!$admin_theme)  $theme_sql = sql_Select(1, $prefix."_theme", "theme_choose ='1'", 0); 
	else $theme_sql = sql_Select(1, $prefix."_theme", "theme_id = '$admin_theme'", 0);

	$theme_query = $db->sql_query($theme_sql);
	$theme_rec = $db->sql_numrows($theme_query);
	$theme = $db->sql_fetchrow($theme_query);

	$theme_dir = $theme['theme_color'];
	$theme_tab1 = $theme['theme_tab1'];
	$theme_tab2 = $theme['theme_tab2'];
	$theme_tab3 = $theme['theme_tab3'];		
?>

<HTML>
<HEAD>
<TITLE>backend</TITLE><!-- 
<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=window-874"> -->
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<link rel="shortcut icon" href="favicon.ico" mce_href="favicon.ico" >
<link href="../style/tbase.css" rel="stylesheet" type="text/css">
<link href="../js/menu/theme.css" rel="stylesheet" type="text/css">
<link  href="../backend/css/productspricelist.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="../backend/css/ui-lightness/jquery-ui-1.9.2.custom.css" />
<script src="../backend/js/jquery-1.8.2.js"></script>
<script src="../backend/js/ui/1.9/jquery-ui.js"></script>



<script src="../backend/js/jquery.numeric.js"></script>
<script src="../backend/js/productsprice-form.js"></script>
<script src="../backend/js/ajax.js"></script>
<!-- Update -->

<!-- End -->

<!--  AUTO LOAD -->
<script type="text/javascript">

var auto_refresh = setInterval(
function ()
{
var products_id = $("#products_id").val();
var products_jb_nb = $("#products_jb_no").val();
$('#responsecontainer').load('../backend/products/show-pricelist.php?q='+products_id+'&p='+products_jb_nb).fadeIn("slow");
$('#discountcontainer').load('../backend/products/show-discountlist.php?q='+products_id+'&p='+products_jb_nb).fadeIn("slow");
}, 1000); // refresh every 10000 milliseconds


</script>
<!-- END -->

<script>
    $(function() {
        $( "#tabs" ).tabs();
    });
    </script>

<script>
    $(function() {
        $( "#datepicker2" ).datepicker();
    });
</script>
    
<script type="text/javascript">  
$(function(){  
    $("#addRow").click(function(){  
        $("#myTbl").append($("#firstTr").clone());  
    });  
    $("#removeRow").click(function(){  
        if($("#myTbl tr").size()>1){  
            $("#myTbl tr:last").remove();  
        }else{  
            alert("ต้องมีรายการข้อมูลอย่างน้อย 1 รายการ");  
        }  
    });           
});  
</script>  
    
    
 
    
<STYLE>
#loading {
	width: 100%;
	height: 100%;
	background-color: #000000;
	position: absolute;
	left: 0%;
	top: 0%;
	margin-top: 0px;
	margin-left: 0px;
	text-align: center;
}
.Div_Content{
	border: 1px solid #C6A12F ;
	background:#FFFFFF; 
}
.Div_Config{
	margin-left: auto;
	margin-right: auto;
	margin-top: 0em;
	padding: 3px;
	border: 1px dotted #C6A12F;
	width: 95%;
	background: #F1F3F5;
}
.txthelp{
	margin-left: auto;
	margin-right: auto;
	margin-top: 0em;
	padding: 3px;
	border: 0px ;
	width: 100%;
	background: #F1F3F5;
	color:#FF6600;
}
</STYLE>
<script language="javascript" src="../js/win_func.js"></script>
<script language="javascript" src="../js/calendar.js"></script>

<script language="Javascript1.2">
<!-- // load htmlarea
	_editor_url = "../js/htmleditor/";
	var win_ie_ver = parseFloat(navigator.appVersion.split("MSIE")[1]);
	if (navigator.userAgent.indexOf('Mac')        >= 0) { win_ie_ver = 0; }
	if (navigator.userAgent.indexOf('Windows CE') >= 0) { win_ie_ver = 0; }
	if (navigator.userAgent.indexOf('Opera')      >= 0) { win_ie_ver = 0; }
	if (win_ie_ver >= 5.5) {
  		document.write('<scr' + 'ipt src="' +_editor_url+ 'editor.js"');
  		document.write(' language="Javascript1.2"></scr' + 'ipt>');  
	} 
	else { 
		document.write('<scr'+'ipt>function editor_generate() { return false; }</scr'+'ipt>'); 
	}	
	-->
</script>

<script language="JavaScript">
<!--

document.write('<div id="loading" style="filter:alpha(opacity=30)"><table width="100%" height="100%"><tr><td valign="middle" align="center"><font face="MS Sans Serif" size="2" color="#FFFFFF">Loading . . . . <br> <img src="../imgs/loading.gif"></font></td></tr></table></div>');
window.onload=function(){
	document.getElementById("loading").style.display="none";
}


function MM_openBrWindow(theURL,winName,features) { 	
	win=open(theURL,"","toolbar=0,directories=0,status=1,scrollbars=0,menubar=0,resizable=0,"+features+"?>,top=30,left=40")
	}	
-->
</script>	
<script language="JavaScript" src="../js/overlib_mini.js"></script>
<SCRIPT language='JavaScript' src="../js/menu/JSCookMenu_mini.js" type='text/javascript'></SCRIPT>	
<SCRIPT language='JavaScript' src="../js/menu/theme.js" type='text/javascript'></SCRIPT>

<link href="../style/calendar.css" rel="stylesheet" type="text/css">
<script language="javascript" src="../js/calendar_tha.js"></script>
<?php //print_r($_SESSION);?>
<BODY BGCOLOR="#FFFFFF" LEFTMARGIN="0" TOPMARGIN="0" MARGINWIDTH="0" MARGINHEIGHT="0"  >
<!-- ImageReady Slices (tee_tour_buy.psd) -->
<TABLE WIDTH="990" BORDER="0" CELLPADDING="0" CELLSPACING="1" align="center" class="border_tbl">
  <TR class="bg_banner" HEIGHT="75"> <!-- Head banner -->
    <TD bgcolor="#FFFFFF"><IMG SRC="jb_logo_sm.gif" WIDTH="516" HEIGHT="97" ALT=""></TD>
  </TR>
  <TR bgcolor="#C6A12F">
    <TD>&nbsp;</TD>
  </TR>
  <TR class="Main_index"> 
    <TD id='Subinfo'><!-- Main Menu -->
	<table border="0" cellspacing="0" cellpadding="0" align="left" HEIGHT='24' >	
	<tr><td>
	<?php
			if(check_admin()) {
	?>
	<TABLE class=menubar cellSpacing=0 cellPadding=0 width="100%" border=0>
  <TBODY>
  <TR>
    <TD>
      <DIV id='myMenuID'></DIV>
      
		<?php
				echo "<SCRIPT language='JavaScript' type='text/javascript'>\n";
				echo "var myMenu = \n[\n";
				if ($admin_spacial == 1 ) $menu_sql = sql_Select(1,$prefix."_mainmenu",1, 0);
				else $menu_sql = sql_Select(1,$prefix."_mainmenu"," main_spacial = $admin_spacial ", 0);

				$menu_sql = sql_Select(1,$prefix."_mainmenu",1, 0);

				//echo $menu_sql;
				$menu_query = $db->sql_query($menu_sql);
				$menu_rec = $db->sql_numrows($menu_query);
				$m_count =1;
				while ($menu = $db->sql_fetchrow($menu_query))
					{
							$main_id = $menu['main_id'];
							$name = $menu['main_name'];
							$link = $menu['main_link'];
							$nick = $menu['main_nickname'];

							if ((in_array($nick,$keep_menu)) && (in_array($nick,$keep_permission_menu)) ) // check menu
							//if (true)
								{  
						
							echo "[null,'  $name  ','$link',null,'$name'\n";
							
							//echo "_cmSplit,\n";
							if ($admin_spacial == 1) 
								$submenu_sql = sql_Select(1, $prefix."_submenu","sub_mainid = $main_id and sub_lv = 2 ", 0);
							else
								$submenu_sql = sql_Select(1, $prefix."_submenu","sub_mainid = $main_id and sub_lv = 2 and sub_spacial = $admin_spacial", 0);

							//echo $submenu_sql;
							$submenu_query = $db->sql_query($submenu_sql);
							$submenu_rec = $db->sql_numrows($submenu_query);
							$s_count = 1;
							while ($submenu = $db->sql_fetchrow($submenu_query))
							{
										$sub_id = $submenu['sub_id'];
										$subname = $submenu['sub_name'];
										$sublink = $submenu['sub_link'];
										$subimgs = $submenu['sub_images'];
										echo ",['<img src=\"$subimgs\">','   &nbsp;$subname&nbsp;   ','$sublink',null,'$subname'\n";

										$sub2menu_sql = sql_Select(1, $prefix."_submenu","sub_mainid = $sub_id and sub_lv = 3 ", 0);
										//echo $sub2menu_sql;
										$sub2menu_query = $db->sql_query($sub2menu_sql);
										$sub2menu_rec = $db->sql_numrows($sub2menu_query);
										$sub2_count = 1;
										while ($submenu = $db->sql_fetchrow($sub2menu_query))
										{
													$sub_id2 = $submenu['sub_id'];
													$subname2 = $submenu['sub_name'];
													$sublink2 = $submenu['sub_link'];
													$subimgs2 = $submenu['sub_images'];
													
													echo ",['<img src=\"$subimgs2\" />','   &nbsp;$subname2&nbsp;   ','$sublink2',null,'$subname2']\n";

													$sub2_count++;
										}
										if ($sub2menu_rec <> $sub2_count)  echo "],\n";
										else echo "]\n";

										$s_count++;
							}//end while submenu
							if ($menu_rec <> $m_count)  echo "],\n";
							else echo "]\n";
							$m_count++;
								} // end if
					} //end while MainMenu

				echo "[null,'  Logout  ','index.php?method=logout',null,'Logout']";

				echo "];\n";
				echo "cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');\n";
				echo "</SCRIPT>";
		?>	
		</TD>
	  </TR>
	</TABLE>	
	<?php } 	?>
	</td></tr>
	</table>
	</TD>
  </TR>
   <!-- <TR>
		<TD>
		<TABLE class=menubar cellSpacing=0 cellPadding=3 width="100%" border=0 bgcolor='#f1f3f5'>
	  <TBODY>
	  <TR>
		<TD class=menudottedline width="40%" align='right'>
			<TABLE id=toolbar cellSpacing=0 cellPadding=0 border=0>
					<TBODY>
					<TR vAlign=center align=middle>
					  <TD><A class=toolbar href="javascript:submitbutton('save');"><IMG 
						alt=Save 
						src="../imgs/icon/save_f2.png" 
						align=middle border=0 name=save> <BR>Save</A> </TD>
					  <TD>&nbsp;</TD>
					  <TD><A class=toolbar href="javascript:submitbutton('cancel');"><IMG 
						alt=Close 
						src="../imgs/icon/cancel_f2.png" 
						align=middle border=0 name=cancel> <BR>Close</A> </TD>
					  <TD>&nbsp;</TD>
					  <TD><A class=toolbar 
						onclick="window.open('http://help.joomla.org/index2.php?option=com_content&amp;task=findkey&amp;pop=1&amp;keyref=screen.contactmanager.edit', 'mambo_help_win', 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no');" 
						href="http://tee/joomla/administrator/index2.php?option=com_contact&amp;task=editA&amp;hidemainmenu=1&amp;id=1#"><IMG 
						alt=Help 
						src="../imgs/icon/help_f2.png" 
						align=middle border=0 name=help> <BR>Help</A> 
			  </TD></TR></TBODY></TABLE>
			  
			  </TD></TR></TBODY></TABLE>
		</TD></TR> -->


  <TR class="Main_index"> 
    <TD id='divInfo'  valign='Top'><!-- content -->
	    <BR>
		<table width="98%" border="0" cellspacing="0" cellpadding="0" align="center" valign='Top'>
			  <tr height='22'><td class='Font_Message'> [ 
            <?php				
				//⊴§¢ꍤȒ釹̑ō
					if(!check_admin()) 
					{
					if (!$msg)  $msg = " Please input username and password. " ;					
					if ($process	== "unwelcome")  $msg = " ·钹䋨ċҊ储¶١µꍧ !!  Try Again. ";
					}
					else					
					{										
						switch ($method)
						{
								case "configu" :	 if (!$msg)  $msg = " Success !!  Login Completed. ";
										switch ($process)
										{			
													case "welcome" :    				$msg = " Success !!  Login Completed. ";
																													break;				
													case "changepassword" :   	$msg = " Change my password. ";
																													break;
													case "formtheme" :    	   			$msg = " Modify Theme ";
																													break;
													case "theme" :    	   					//$msg = " Modify Theme ";
																													break;
													case "formsetting" :    	   			$msg = " Modify Setting ";
																													break;
													case "setting" :    	   					//$msg = " Modify Theme ";
																													break;
										}
										break;	 
										
									case "permissmenu" :     if (!$msg)  $msg = "  Permission List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Permission ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create  Menu ";
																										break;																		
															case "create" :    	$msg = " Create  Permission ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify  Permission ";
																											break;
															case "modify" :    	$msg = " Modify  Permission ";
																											break;
															case "deleted" :    	//$msg = " Delete Permission ";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Permission ";
																										break;
															case "formsearch" :     $msg = " Search Permission List  ";							
																										break ;
															case "listsearch" :    $msg = " Search Permission List  ";
																										break;
															default:
												}
										break;
										
									case "admin" :     if (!$msg)  $msg = "  Admin List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Admin ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create  Admin ";
																										break;																		
															case "create" :    	$msg = " Create  Admin ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify  Admin ";
																											break;
															case "modify" :    	$msg = " Modify  Admin ";
																											break;
															case "deleted" :    	//$msg = " Delete Admin ";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Admin ";
																										break;
															case "formsearch" :     $msg = " Search  Admin List  ";							
																										break ;
															case "listsearch" :    $msg = " Search  Admin  List  ";
																										break;
															case "formmodifypassword" :    $msg = " Cahnge Password ";
																											break;
															case "modifypassword" :    	$msg = " Cahnge Password ";
																											break;
															default:
												}
										break;
										
									case "news" :     if (!$msg)  $msg = " News & Events  List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail  ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create News & Events ";
																										break;																		
															case "create" :    	$msg = " Create News & Events ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify News & Events";
																											break;
															case "modify" :    	$msg = " Modify News & Events ";
																											break;
															case "deleted" :    	//$msg = " Delete News & Events";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  News & Events";
																										break;
															case "formsearch" :     $msg = " Search  News & Events";							
																										break ;
															case "listsearch" :    $msg = " Search News & Events";
																										break;
															default:
												}
										break;	
									case "members" :     if (!$msg)  $msg = "  Members  List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail Members ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create Members ";
																										break;																		
															case "create" :    	$msg = " Create Members ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify Members ";
																											break;
															case "modify" :    	$msg = " Modify Members  ";
																											break;
															case "deleted" :    	//$msg = " Delete Members";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Members ";
																										break;
															case "formsearch" :     $msg = " Search  Members";							
																										break ;
															case "listsearch" :    $msg = " Search  Members";
																										break;
															default:
												}
										break;	
									case "arcode" :     if (!$msg)  $msg = " AR-CODE  List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail  ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create AR-CODE ";
																										break;																		
															case "create" :    	$msg = " Create AR-CODE ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify AR-CODE";
																											break;
															case "modify" :    	$msg = " Modify AR-CODE ";
																											break;
															case "deleted" :    	//$msg = " Delete AR-CODE";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  AR-CODE";
																										break;
															case "formsearch" :     $msg = " Search  AR-CODE";							
																										break ;
															case "listsearch" :    $msg = " Search AR-CODE";
																										break;
															default:
												}
										break;	
										case "members_request" :     if (!$msg)  $msg = "  Members  List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail Members ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create Members ";
																										break;																		
															case "create" :    	$msg = " Create Members ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify Members ";
																											break;
															case "modify" :    	$msg = " Modify Members  ";
																											break;
															case "deleted" :    	//$msg = " Delete Members";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Members ";
																										break;
															case "formsearch" :     $msg = " Search  Members";							
																										break ;
															case "listsearch" :    $msg = " Search  Members";
																										break;
															default:
												}
										break;	
									case "products" :     
												switch ($process)
												{			
															case "list" :			 if (!$msg) $msg = "  Categories List ";
																										break;
															case "detail" :    		$msg = " Detail Categories";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create Categories";
																										break;																		
															case "create" :    	$msg = " Create Categories";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify Categories";
																											break;
															case "modify" :    	$msg = " Modify Categories ";
																											break;
															case "deleted" :    	//$msg = " Delete Categories";
																										break;
															case "deletedmany" :    	//$msg = " Collections  Categories";
																										break;
															case "formsearch" :     $msg = " Search  Categories";							
																										break ;
															case "listsearch" :    $msg = " Search  Categories";
																										break;
															case "blist" :     
																										break;							
															case "bdetail" :    		$msg = " Detail Products";
																										break;
															case "bformcreate" :      if (!$msg)   $msg = " Form Create Products";
																										break;																		
															case "bcreate" :    	$msg = " Create Products";
																										break;
															case "bformmodify" :    	 if (!$msg)   $msg = " Modify Products";
																											break;
															case "bmodify" :    	$msg = " Modify Products ";
																											break;
															case "bdeleted" :    	//$msg = " Delete Products";
																										break;
															case "bdeletedmany" :    	//$msg = " Deletemany  Products";
																										break;
															case "bformsearch" :     $msg = " Search  Products";							
																										break ;
															case "blistsearch" :    $msg = " Search  Products";
																										break;
															case "showlist" :    $msg = " Hilight  Products";
																										break;
															default:
												}
										break;
									case "iconservice" :     if (!$msg)  $msg = "  Icon Service List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail Icon Service";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create Icon Service";
																										break;																		
															case "create" :    	$msg = " Create Icon Service";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify Icon Service";
																											break;
															case "modify" :    	$msg = " Modify Icon Service ";
																											break;
															case "deleted" :    	//$msg = " Delete Icon Service";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Icon Service";
																										break;
															case "formsearch" :     $msg = " Search  Icon Service";							
																										break ;
															case "listsearch" :    $msg = " Search  Icon Service";
																										break;
															default:
												}
										break;	
									case "customers_talk" :     if (!$msg)  $msg = "  Customer Talk List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = "   Customer Talk ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create   Customer Talk ";
																										break;																		
															case "create" :    	$msg = " Create    Customer Talk ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify    Customer Talk";
																											break;
															case "modify" :    	$msg = " Modify    Customer Talk ";
																											break;
															case "deleted" :    	//$msg = " Delete   Customer Talk ";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany    Customer Talk ";
																										break;
															case "formsearch" :     $msg = " Search   Customer Talk List  ";							
																										break ;
															case "listsearch" :    $msg = " Search   Customer Talk List  ";
																										break;
															default:
												}
										break;
										
									case "banner" :     if (!$msg)  $msg = "  Banner List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Banner ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create  Banner ";
																										break;																		
															case "create" :    	$msg = " Create  Banner ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify  Banner";
																											break;
															case "modify" :    	$msg = " Modify  Banner ";
																											break;
															case "deleted" :    	//$msg = " Delete Banner ";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Banner ";
																										break;
															case "formsearch" :     $msg = " Search Banner List  ";							
																										break ;
															case "listsearch" :    $msg = " Search Banner List  ";
																										break;
															default:
												}
										break;
									case "order" :     if (!$msg)  $msg = "  Order List ";
													switch ($process)
													{			
																case "list" :     
																											break;							
																case "detail" :    		 if (!$msg)  $msg = " Ē¡Ӄˑ觫ةΊԹ¤ꐠ";
																											break;		
																case "deleted" :    	//$msg = " Delete Serial ";
																											break;
																case "deletedmany" :    	//$msg = " Deletemany  Serial ";
																											break;
																case "formsearch" :     $msg = " Search  Order List  ";							
																											break ;
																case "listsearch" :    $msg = " Search  Order  List  ";
																											break;
																case "changestatus" :    
																											break;
																default:
													}
											break;	
									case "orderreward" :     if (!$msg)  $msg = "  Order Reward List ";
													switch ($process)
													{			
																case "list" :     
																											break;							
																case "detail" :    		 if (!$msg)  $msg = "Order Reward Detail";
																											break;		
																case "deleted" :    	//$msg = " Delete Serial ";
																											break;
																case "deletedmany" :    	//$msg = " Deletemany  Serial ";
																											break;
																case "formsearch" :     $msg = " Search  Order Reward  List  ";							
																											break ;
																case "listsearch" :    $msg = " Search  Order Reward   List  ";
																											break;
																case "changestatus" :    
																											break;
																default:
													}
											break;	

									case "mailing" :     if (!$msg)  $msg = " Mailing List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail  ";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create Mailing";
																										break;																		
															case "create" :    	$msg = " Create Mailing ";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify Mailing";
																											break;
															case "modify" :    	$msg = " Modify Mailing ";
																											break;
															case "deleted" :    	//$msg = " Delete Mailing";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Mailing";
																										break;
															case "formsearch" :     $msg = " Search  Mailing";							
																										break ;
															case "listsearch" :    $msg = " Search Mailing";
																										break;
															case "c_list" :     
																										break;							
															case "c_detail" :    		$msg = " Group Detail  ";
																										break;
															case "c_formcreate" :      if (!$msg)   $msg = " Form Create Group Mailing";
																										break;																		
															case "c_create" :    	$msg = " Create Group Mailing ";
																										break;
															case "c_formmodify" :    	 if (!$msg)   $msg = " Modify Group Mailing";
																											break;
															case "c_modify" :    	$msg = " Modify Group Mailing ";
																											break;
															case "c_deleted" :    	//$msg = " Delete Group Mailing";
																										break;
															case "c_deletedmany" :    	//$msg = " Deletemany Group  Mailing";
																										break;
															case "c_formsearch" :     $msg = " Search Group  Mailing";							
																										break ;
															case "c_listsearch" :    $msg = " Search Group Mailing";
																										break;
															case "m_list" :     
																										break;							
															case "m_detail" :    		$msg = " Detail  ";
																										break;
															case "m_formcreate" :      if (!$msg)   $msg = " Form Create Mailing";
																										break;																		
															case "m_create" :    	$msg = " Create Mailing ";
																										break;
															case "m_formmodify" :    	 if (!$msg)   $msg = " Modify Mailing";
																											break;
															case "m_modify" :    	$msg = " Modify Mailing ";
																											break;
															case "m_deleted" :    	//$msg = " Delete Mailing";
																										break;
															case "m_deletedmany" :    	//$msg = " Deletemany  Mailing";
																										break;
															case "m_formsearch" :     $msg = " Search  Mailing";							
																										break ;
															case "m_listsearch" :    $msg = " Search Mailing";
																										break;
															default:
												}
											break;		
								case "jobs" :     if (!$msg)  $msg = "  Job Description  List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail  Job Description";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create  Job Description ";
																										break;																		
															case "create" :    	$msg = " Create  Job Description";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify  Job Description";
																											break;
															case "modify" :    	$msg = " Modify  Job Description  ";
																											break;
															case "deleted" :    	//$msg = " Delete  Job Description";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany   Job Description ";
																										break;
															case "formsearch" :     $msg = " Search   Job Description";							
																										break ;
															case "listsearch" :    $msg = " Search   Job Description";
																										break;
															default:
												}
										break;		
									case "reward" :     
												switch ($process)
												{			
															case "list" :			 if (!$msg) $msg = "  Categories Reward List ";
																										break;
															case "detail" :    		$msg = " Detail Categories Reward";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create Categories Reward";
																										break;																		
															case "create" :    	$msg = " Create Categories Reward";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify Categories Reward";
																											break;
															case "modify" :    	$msg = " Modify Categories Reward ";
																											break;
															case "deleted" :    	//$msg = " Delete Categories Reward";
																										break;
															case "deletedmany" :    	//$msg = " Collections  Categories Reward";
																										break;
															case "formsearch" :     $msg = " Search  Categories Reward";							
																										break ;
															case "listsearch" :    $msg = " Search  Categories Reward";
																										break;
															case "sub_list" :		 if (!$msg) $msg = " Reward List ";
																										break;							
															case "sub_detail" :    		$msg = " Detail Reward";
																										break;
															case "sub_formcreate" :      if (!$msg)   $msg = " Form Create Reward";
																										break;																		
															case "sub_create" :    	$msg = " Create Reward";
																										break;
															case "sub_formmodify" :    	 if (!$msg)   $msg = " Modify Reward";
																											break;
															case "sub_modify" :    	$msg = " Modify Reward ";
																											break;
															case "sub_deleted" :    	//$msg = " Delete Reward";
																										break;
															case "sub_deletedmany" :    	//$msg = " Deletemany  Reward";
																										break;
															case "sub_formsearch" :     $msg = " Search  Reward";							
																										break ;
															case "sub_listsearch" :    $msg = " Search  Reward";
																										break;
															case "showlist" :    $msg = " Hilight  Reward";
																										break;
															default:
												}
										break;	
									case "zonearea" :     if (!$msg)  $msg = "  Area List ";
												switch ($process)
												{			
															case "list" :     
																										break;							
															case "detail" :    		$msg = " Detail Area";
																										break;
															case "formcreate" :      if (!$msg)   $msg = " Form Create Area";
																										break;																		
															case "create" :    	$msg = " Create Area";
																										break;
															case "formmodify" :    	 if (!$msg)   $msg = " Modify Area";
																											break;
															case "modify" :    	$msg = " Modify Area ";
																											break;
															case "deleted" :    	//$msg = " Delete Area";
																										break;
															case "deletedmany" :    	//$msg = " Deletemany  Area";
																										break;
															case "formsearch" :     $msg = " Search  Area";							
																										break ;
															case "listsearch" :    $msg = " Search  Area";
																										break;
															default:
												}
										break;	
								default : $msg = " Success !!  Login Completed. ";
						}
					} // else 
					echo $msg ;  // ⊴§¢ꍤȒ釹̑ō
	?>
		  ] 		  
		  <?php
		  	if (file_exists( "help/".$method."_".$process.".txt")) {
					 $strfile = "help/".$method."_".$process.".txt";
					 echo "<span onclick='void(THelp());' Onmouseover='this.style.cursor=\"hand\";'>[Help]</span>";
					 ?>
		  <SCRIPT LANGUAGE="JavaScript">
		  <!--
		  
		  function  THelp(){					win=open("help/help.php?filename=<?=$strfile?>","help","toolbar=0,directories=0,status=1,scrollbars=1,menubar=0,resizable=0,width=500,height=500,top=70,left=100")
			}
		  //-->
		  </SCRIPT>
			<?php
			}
			else 
					 $strfile = "help/blank.txt";
		 ?>
		  </td>
		  </tr>
		  <tr>
		  <td valign='top' class='Div_Content'>		  
			 <?php 

					if(!check_admin())
						{
									include("login/login.php");
						}
						else
						{			
							switch ($method)
							{
										case "logout" :   include("logout/logout.php");  $process="Completed";
																		break;
										case "configu" :
														switch ($process)
														{			
																	case "changepassword" :    include("home/changepass.php");
																															formupdatepass();					
																															break;
																	case "updatepassword" :    include("home/changepass.php");
																														   update_ChangePassword();			break;
																	case "formtheme" :    	   		    include("theme/changetheme.php");
																															formtheme();
																															break;
																	case "theme" :    	   				    include("theme/changetheme.php");
																															themechange();
																															break;
																	case "formsetting" :    	   			include("home/setting.php");
																															formsetting();
																															break;
																	case "setting" :    	   					include("home/setting.php");
																															updatesetting();
																															break;
																	default : include("home/home.php");
														}
														break;	
												
												case "permissmenu" :     include("permissmenu/permissmenu.php"); 
														switch ($process) 
														{			
																	case "list" :				datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :		swapdisplay();
																												break;
																	default:
														}
														break;
												case "admin" :     include("admin/admin.php"); 
														switch ($process) 
														{			
																	case "list" :				datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :		swapdisplay();
																												break;
																	case "formmodifypassword" :    	formmodifypassword();
																													break;
																	case "modifypassword" :    			modifypassword();
																												break;
																	default:
														}
														break;
												case "members" :     include("members/members.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;
																	default:
														}
														break;		

												case "customers_talk" :     include("customers_talk/customers_talk.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;																
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;
																	default:
														}
														break;		

												case "members_request" :     include("members/members_request.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;
																	default:
														}
														break;		
												case "products" :    include("products/products.php"); include("products/categories.php"); 
														switch ($process) 
														{			
																	case "clist" :						cdatalist(); 
																												break;			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;

																	case "blist" :						bdatalist(); 
																												break;							
																	case "bdetail" :    				bdetail();
																												break;
																	case "bformcreate" :		bformcreate();
																												break;																		
																	case "bcreate" :    			badd(); 
																												break;
																	case "bformmodify" :    	bformmodify();
																													break;
																	case "bmodify" :    			bmodify();
																												break;
																	case "bdeleted" :				bdeleted();
																												break;
																	case "bdeletedmany" :		bdeletemany(); 
																												break;
																	case "bformsearch" :       bformsearch();						
																												break ;
																	case "blistsearch" :			bsearch();	
																												break;
																	case "bactive" :				    bswapdisplay();
																												break;
																	case "showlist" :				    showlist();
																												break;
																	default:
														}
														break;
											case "reward" :    include("reward/rcate.php"); include("reward/reward.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;

																	case "sub_list" :						sub_datalist(); 
																												break;							
																	case "sub_detail" :    				sub_detail();
																												break;
																	case "sub_formcreate" :			sub_formcreate();
																												break;																		
																	case "sub_create" :    				sub_add(); 
																												break;
																	case "sub_formmodify" :    		sub_formmodify();
																													break;
																	case "sub_modify" :    				sub_modify();
																												break;
																	case "sub_deleted" :				sub_deleted();
																												break;
																	case "sub_deletedmany" :		sub_deletemany(); 
																												break;
																	case "sub_formsearch" :       sub_formsearch();						
																												break ;
																	case "sub_listsearch" :			sub_search();	
																												break;
																	case "sub_active" :				    sub_swapdisplay();
																												break;
																	case "showlist" :				    showlist();
																												break;
																	default:
														}
														break;		
												case "iconservice" :     include("iconservice/iconservice.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;
																	default:
														}
														break;
												case "arcode" :     include("arcode/arcode.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;
																	default:
														}
														break;
											case "news" :     include("news/news.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;
																	default:
														}
														break;	
												case "order" :     include("order/order.php"); 
														switch ($process) 
														{			
																	case "list" :				datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "changestatus" :		changestatus();
																												break;
																	case "changestatuspayment" :		changestatuspayment();
																												break;
																	case "changestatusConfirm" :		changestatusConfirm();
																												break;
																	default:
														}
														break;
												case "orderreward" :     include("orderreward/orderreward.php"); 
														switch ($process) 
														{			
																	case "list" :				datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "changestatus" :		changestatus();
																												break;
																	case "changestatuspayment" :		changestatuspayment();
																												break;
																	case "changestatusConfirm" :		changestatusConfirm();
																												break;
																	default:
														}
														break;
												case "mailing" :     include("mailing/mailing.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;
																	case "c_list" :					c_datalist(); 
																												break;							
																	case "c_detail" :    			c_detail();
																												break;
																	case "c_formcreate" :		c_formcreate();
																												break;				
																	case "c_create" :    			c_add(); 
																												break;
																	case "c_formmodify" :    	c_formmodify();
																													break;
																	case "c_modify" :    			c_modify();
																												break;
																	case "c_deleted" :			c_deleted();
																												break;
																	case "c_deletedmany" :  c_deletemany(); 
																												break;
																	case "c_formsearch" :     c_formsearch();						
																												break ;
																	case "c_listsearch" :		    c_search();	
																												break;
																	case "c_active" :				c_swapdisplay();
																												break;
																	case "m_list" :					m_datalist(); 
																												break;							
																	case "m_detail" :    			m_detail();
																												break;
																	case "m_formcreate" :		m_formcreate();
																												break;				
																	case "m_create" :    			m_add(); 
																												break;
																	case "m_formmodify" :    	m_formmodify();
																													break;
																	case "m_modify" :    			m_modify();
																												break;
																	case "m_deleted" :			m_deleted();
																												break;
																	case "m_deletedmany" :  m_deletemany(); 
																												break;
																	case "m_formsearch" :     m_formsearch();						
																												break ;
																	case "m_listsearch" :		    m_search();	
																												break;
																	case "m_active" :				m_swapdisplay();
																												break;
																	default:
														}
														break;
													case "jobs" :     include("jobdescription/jobdescription.php");  include("jobdescription/applications.php"); 
														switch ($process) 
														{			
																	case "list" :						datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :				swapdisplay();
																												break;

																												
																	case "blist" :						bdatalist(); 
																												break;							
																	case "bdetail" :    				bdetail();
																												break;
																	/*case "bformcreate" :		bformcreate();
																												break;																		
																	case "bcreate" :    			badd(); 
																												break;*/
																	case "bformmodify" :    	bformmodify();
																													break;
																	case "bmodify" :    			bmodify();
																												break;
																	case "bdeleted" :				bdeleted();
																												break;
																	case "bdeletedmany" :		bdeletemany(); 
																												break;
																	case "bformsearch" :       bformsearch();						
																												break ;
																	case "blistsearch" :			bsearch();	
																												break;
																	case "bactive" :				    bswapdisplay();
																												break;
																	case "showlist" :				    showlist();
																												break;
																	default:
														}
														break;
												case "banner" :     include("banner/banner.php"); 
														switch ($process) 
														{			
																	case "list" :				datalist(); 
																												break;							
																	case "detail" :    			if (in_array($process,$keep_assign)) detail();
																												else	include("error_assign.php"); 
																												break;
																	case "formcreate" :		formcreate();
																												break;																		
																	case "create" :    			if (in_array($process,$keep_assign))  add(); 
																												else	include("error_assign.php"); 
																												break;
																	case "formmodify" :    	formmodify();
																													break;
																	case "modify" :    			if (in_array($process,$keep_assign))  modify();
																												else	include("error_assign.php");
																												break;
																	case "deleted" :			if (in_array($process,$keep_assign)) deleted();
																												else include("error_assign.php"); 
																												break;
																	case "deletedmany" :  if (in_array("deleted",$keep_assign))  deletemany(); 
																												else include("error_assign.php"); 
																												break;
																	case "formsearch" :      formsearch();						
																												break ;
																	case "listsearch" :		search();	
																												break;
																	case "active" :		swapdisplay();
																												break;
																	default:
														}
														break;
									 default :  include("home/home.php");	
							   }// end switch
								//include "savelogfile.php";
								//SaveLogfile($method,$process,$arr_tbl);
						}// end else
					 ?>				
					</td>
				  </tr>
		</table>
		<BR>
	
	</TD>
  </TR>
  <TR class='Footer_index'> 
    <TD valign ='top' align='right'>
	<TABLE width='100%'>
	<TR>
		<TD valign ='top' align='left'>
		<!-- ¢ꎁڅ¼ک Login -->
		<TABLE cellSpacing=0 cellPadding=0 border=0>
		<TR>
			<TD id='UnlockCheck'>&nbsp;</TD>
		</TR>
		<TR>
			<TD>&nbsp;&nbsp;Login By : <?=$admin_user?> ( IP : <?=$_SERVER["REMOTE_ADDR"];?> )</TD>
		</TR>
		<TR>
			<TD> &nbsp;&nbsp;Email : <?=$admin_email?></TD>
		</TR>
		<TR>
			<TD id='Clock'></TD>
		</TR>
		</TABLE>		 
	<script>
	<!--
	function show(){
	var Digital=new Date()
	var day=Digital.getDay()
	var month=Digital.getMinutes()
	var year=Digital.getMonth()
	var hours=Digital.getHours()
	var minutes=Digital.getMinutes()
	var seconds=Digital.getSeconds()
	
	if (hours==0)
	hours=12
	if (minutes<=9)
	minutes="0"+minutes
	if (seconds<=9)
	seconds="0"+seconds
	document.getElementById("Clock").innerHTML="&nbsp;&nbsp;Time : <?=date('M, d  Y ');?> "+hours+":"+minutes+":"
	+seconds+" "
	setTimeout("show()",1000)
	}
	show()
	//-->
	</script>
		 <BR>
		</TD>
		<TD valign ='top' align='right'>
		<BR>
		<B>
		<a href="">Design by Designlifesaver</a>&nbsp;&nbsp;<BR>
		E-mail: needhelps@designlifesaver.com&nbsp;&nbsp;</B></TD>
	</TR>
	</TABLE>
	<!-- footer -->
	


	</TD>
  </TR>
</TABLE>
<!-- End ImageReady Slices -->
<SCRIPT LANGUAGE="JavaScript">
<!--
//document.bgColor = "<?=$theme_tab3?>";
document.bgColor = "#FFFFFF";
//-->
</SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
	<!--

	// ᄕ¡ 㫩 Cookie ·֨˃꒧免
	var AbbCode = GetCookie('<?=$Abb_Code?>');
	
	// µć¨ˍº¤铇铁ӠCookie ¨Ĕ§匁
	if(AbbCode==null)  AbbCode="<?=$Abb_Code?>";
					
	// ⊴§¼šӃ·ӧҹ   
	//alert("AbbCode : "+AbbCode+ " \n");
	//alert("AbbCode : "+AbbCode+ " \n"+document.cookie.length);

	// ˃꒧ Cookie   
	function SetCookie (name, value) {     
		var argv = SetCookie.arguments;     
		var argc = SetCookie.arguments.length;     
		var expires = (argc > 2) ? argv[2] : null;  //alert(expires);   
		var path = (argc > 3) ? argv[3] : null;     
		var domain = (argc > 4) ? argv[4] : null;     
		var secure = (argc > 5) ? argv[5] : false;     
		 document.cookie = name + "=" + escape (value) +    
				((expires == null) ? "" : ("; expires=" + expires.toGMTString())) +    
				((path == null) ? "" : ("; path=" + path)) +     
				((domain == null) ? "" : ("; domain=" + domain)) +       
				((secure == true) ? "; secure" : "");   					

		//var test = GetCookie(name);
		//alert(document.cookie);
	}   

	  
	function getCookieVal (offset) {     
		var endstr = document.cookie.indexOf (";", offset);     
		if (endstr == -1) endstr = document.cookie.length;     
		return unescape(document.cookie.substring(offset, endstr));   
	}   
	  
	// ᄕ¡㫩§ҹ Cookie   
	function GetCookie (name) {     
		var arg = name + "=";     
		var alen = arg.length;     
		var clen = document.cookie.length;     
		var i = 0;     
		while (i < clen) {       
			var j = i + alen;       
			if (document.cookie.substring(i, j) == arg)         
			return getCookieVal (j);       
			i = document.cookie.indexOf(" ", i) + 1;       
			if (i == 0) break;      
		}     
		return null;   
	}   

	function DeleteCookie (name) {     
		var exp = new Date();     
			exp.setTime (exp.getTime() - 1);     
		var cval = GetCookie (name);     
			document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();   
	}   
			
	function Func_Cookie(Obj){
				//alert(Obj.checked);
				if (Obj.checked == true){
				var exp = new Date();    
				exp.setTime(exp.getTime() + (365*24*60*60*1000));   
				  
				// ˃꒧ Cookie   							
				SetCookie('AbbCode','<?=$Abb_Code?>', exp);
			}
			else{
				// ź Cookie   	
				DeleteCookie('AbbCode');   
			}
	}
	//-->
	</SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
	<!--
		function createXMLHttpRequest() {
    if (window.ActiveXObject) {
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    } 
    else if (window.XMLHttpRequest) {
        xmlHttp = new XMLHttpRequest();
    }
}
    
function Func_UnlockAllotment(data) {
	createXMLHttpRequest();
    xmlHttp.onreadystatechange = UnlockhandleStateChange;
	xmlHttp.open("GET", "booking/unlockallot.php?temp="+Math.random(), true);
    xmlHttp.send(null);
}

    
function UnlockhandleStateChange() {
    if(xmlHttp.readyState == 4) {
        if(xmlHttp.status == 200) {				
				document.getElementById("UnlockCheck").innerHTML = xmlHttp.responseText;
        }
    }
}

//setInterval("Func_UnlockAllotment()",600000);
	//-->
	</SCRIPT>
	</BODY>
</HTML>

