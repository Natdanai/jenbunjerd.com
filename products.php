<? 
session_start();
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/clsFont.css" type="text/css" media="screen" />
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language="javascript" src="js/win_func.js"></script>
<style>
td.jb_cate{
	FONT-FAMILY: Tahoma, MS Sans Serief, Arial; FONT-SIZE: 8pt;
	text-align:center;		
	font-weight:bold;
	padding: 0px 5px 0px 10px;
}
</style>
<link rel="stylesheet" href="css/clsFont.css" type="text/css" media="screen" />
    <script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
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

        <table width="739" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="81" valign="top" background="images/product/bk_tab_submenu.gif"><table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr >
                  <td height="30"><font color="#C6A12F" class="fsmall"></font></td>
                </tr>
                <tr>
                  <td class='top-link'><font class="fsmall"><strong>
				  <?
				 //	 echo getn("categories_name_th","categories","categories_id = ".$thiscategories_id);
				  $str = ReCall($thiscategories_id);
				  $str = substr($str,1).",".$thiscategories_id;
				  
				  $arr_ = explode(",",$str);
				  for($i=0;$i < count($arr_);$i++){
						if ($arr_[$i] != 0){
						$detail_sql = sql_Select(1, $prefix."_categories", " categories_id = ".$arr_[$i]." and categories_status ='1'", 0);
						//echo  $detail_sql ;
						$detail_query = $db->sql_query($detail_sql);
						$categories = $db->sql_fetchrow($detail_query);

						$categories_id=$categories['categories_id'];
						$categories_name_th=$categories['categories_name_th'];
						$categories_name_en=$categories['categories_name_en'];
						$title_name =  str_replace('&quot;','&nbsp;',$categories['categories_name_th'])."(".$categories['categories_name_en'].")";
						$categories_description_th = str_replace('&quot;','&nbsp;',(str_replace('\n','<br>',$categories['categories_description_th'])));
						$categories_description_en = str_replace("\n","<br>",$categories['categories_description_en']);
						$categories_mainpic=$categories['categories_mainpic'];
						$categories_status=$categories['categories_status'];
						$categories_popads[$i] = $categories['categories_popads'];

						echo "<a  href='products.php?cateparent=$categoriesparent&level=$i&thiscategories_id=$categories_id&title_name=$title_name'>$categories_name_th </a> ";

						if ( ( count($arr_) -1)  != $i ) echo "&nbsp;<font color='#62C149'>&nbsp;&gt;</font> ";

						}
				  }
				  ?> </strong></font></td>
                </tr>
            </table></td>
          </tr>
        </table>
		<?			$categoriespath = "backend/$categories_path";
						if (!isset($level))  $level = 0;
						$nextlv = $level + 1;
						$con_cate = "";$con_cate2 = "";
						if ($thiscategories_id)  {
							$con_cate = " and  categories_parent = $thiscategories_id ";
							$con_cate2 = " where categories_id = $categories_id ";
						}
						else
							$con_cate2 = " where categories_id = 0 ";
						$list_sql = sql_Select(1, $prefix."_categories", " categories_level = $level $con_cate and categories_delete = 0 and categories_status = 1 ", 0);
						$list_query = $db->sql_query($list_sql);									//echo "<br>$list_guery";
						$num = $db->sql_numrows($list_query);								//echo "<br>$totalrec<br>";
						$fperpage = 12;
						if (!$per_page) $per_page=$fperpage;
						if (!$c_page)   $c_page  = 1;
						if ($num <$per_page) 	$amount = 1;
						else if ($num%$per_page == 0)		$amount = $num/$per_page;
								else		$amount = ceil($num/$per_page);

							//	echo "amount=$amount,num=$num";						


						if ($c_page > 1)  $prv = $c_page -1;
						if ($c_page < $amount )  $next = $c_page+1;
						$startpage = $c_page*$per_page - $per_page;

						$list_sql .= " ORDER BY categories_id ASC LIMIT $startpage, $per_page";   
						//echo "<BR>$list_sql<br>";
						$list_query = $db->sql_query($list_sql);									//echo "<br>$list_guery";
						$haverow = $db->sql_numrows($list_query);								//echo "<br>$totalrec<br>";
						if ($haverow > 0 ){
		?>
      <table width="729" border="0" align="center" cellpadding="0" cellspacing="0">
		<?
						
						$x=0;$a=1;
						while (  $categories= $db->sql_fetchrow($list_query))
							{  
											$categories_id=$categories['categories_id'];
											$categories_name_th=$categories['categories_name_th'];
											$categories_name_en=$categories['categories_name_en'];
											$headtopic = $title_name =  str_replace('&quot;','&nbsp;',$categories['categories_name_th'])."(".$categories['categories_name_en'].")";
											$categories_type=$categories['categories_type'];
											$categories_parent=$categories['categories_parent'];
											$categories_level=$categories['categories_level'];
											$categories_mainpic=$categories['categories_mainpic'];											
											$categories_description_th=$categories['categories_description_th'];
											$categories_popads =$categories['categories_popads'];

											if ( $a == 1) echo " <tr valign=\"top\"> ";

											 if (file_exists("$categoriespath/$categories_mainpic")){
												$widthsize=getimagesize("$categoriespath/$categories_mainpic"); 
												$old_w=$widthsize[0]; 
												$old_h=$widthsize[1]; 		
												$pic = "$categoriespath/$categories_mainpic";

												//echo $widthsize[0].",".$widthsize[1];
												
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
										 }
										 if (!file_exists("$categoriespath/$categories_mainpic")||$categories_mainpic == "" ) $pic = "$categoriespath/nopic.jpg";

					if ($level == 1 ) {
					
					$str_link ="products.php?cateparent=$categories_parent&level=$nextlv&thiscategories_id=$categories_id&title_name=$title_name";
						?>                   
                      <td>
					  <div align="center">			
					  <table width="243" border="0" cellspacing="0" cellpadding="0">
							<tr>
							  <td height="33" background="images/bk_top_sub_catagory.gif">
							  <table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
								  <tr>
									<td ><span class="fsmall"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$categories_name_th?></strong></span></td>
								  </tr>
							  </table></td>
							</tr>
							<tr>
							  <td height="192" valign="top" >
							  <table width="243" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><img src="images/bk_sub_catagory_top.gif" width="243" height="10" /></td>
  </tr>
  <tr>
    <td height="149" valign="top" background="images/bk_sub_catagory_middle.gif" style="background-repeat:repeat-y;"><table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
								  <tr>
									<td>&nbsp;</td>
									<td>&nbsp;</td>
								  </tr>
								  <tr>
									<td width="105" valign="top"><div align="right" ><a href="javascript:;" onClick="MM_openBrWindow('function/popup/show_picture.php?pic=<?="../../".$pic."&ww=$old_w&hh=$old_h"?>','','width=<?=$old_w;?>,height=<?=$old_h;?>')" title="<?=$title_name; ?>"><img src="<?=$pic;?>" width="100" height="100" border="0" alt="<?=$title_name?>"></a></div></td>
									<td valign="top" align="center">
									<table width="120" border="0" cellspacing="0" cellpadding="0">
									    <?  /*$arr = explode("\n",$categories_description_th);
												foreach ($arr as $value){
													if ($value!="")
													{*/
						$list_sql2 = sql_Select(1, $prefix."_categories", " categories_level = 2 and categories_parent = $categories_id and categories_delete = 0  AND categories_status=1 ", 0);
						$list_sql2 .= " ORDER BY categories_id ASC LIMIT 0, 7";
						$list_query2 = $db->sql_query($list_sql2);
						$categories_count = mysql_num_rows($list_query2);
						if($categories_count){
						while ( $categories2= $db->sql_fetchrow($list_query2))
							{
											$categories_id=$categories2['categories_id'];
											$categories_name_th=$categories2['categories_name_th'];
											$categories_name_en=$categories2['categories_name_en'];
											$title_name =  str_replace('&quot;','&nbsp;',$categories2['categories_name_th'])."(".$categories2['categories_name_en'].")";
											$categories_parent=$categories2['categories_parent'];
											$categories_level=$categories2['categories_level'];
						?>
										<tr>
										  <td width="15" valign="top"></td>
										  <td align="left" ><a href="<?="products.php?cateparent=$categories_parent&level=3&thiscategories_id=$categories_id&title_name=$title_name";?>"><span class="fgray"><?=$categories_name_th?></strong></span></a></td>
										</tr>
													<? 
								}
												}
											else
												{
												?>
												<?  $arr = explode("\n",$categories_description_th);
												foreach ($arr as $value){
													if ($value!="")
													{
													?>
										<tr>
										  <td width="15" valign="top"></td>
										  <td align="left" ><span class="fgray"><?=$value?></span></td>
										</tr>
													<?
													}
												}
												}
												?>
									</table></td>
								  </tr>
								  <tr>
									<td>&nbsp;</td>
									<td valign="top"><div align="right"><span class="fgray"><a href="<?=$str_link; ?>"><span class="forage">ดูทั้งหมด</span></a></span>&nbsp;</font></div></td>
								  </tr>
							  </table></td>
  </tr>
  <tr>
    <td valign="top"><img src="images/bk_sub_catagory_bottom.gif" width="243" height="33" /></td>
  </tr>
</table></td>
							</tr>
						</table></div>
					  </td>
						<?
					}
					else{
												 
					?>
						<td width="243">
						<table width="243" height="234" border="0" cellpadding="0" cellspacing="0" background="images/product/bk_catagory_product.gif">
						  <tr> 
							<td valign="middle">
							<table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
								<tr> 
								  <td><div align="center">
								  <div align="center"><a href="javascript:;" onClick="MM_openBrWindow('function/popup/show_picture.php?pic=<?="../../".$pic."&ww=$old_w&hh=$old_h"?>','','width=<?=$old_w;?>,height=<?=$old_h;?>')"title="<?=$title_name; ?>"><img src="<?=$pic?>" height="85" width="100" border="0" alt="<?=$categories_name_th?>"alt="<?=$title_name?>"></a></div>
								</div></td>
											</tr>
											<tr> 
											  <td><div align="center"><span class="fgray"><br />
						<?=$categories_name_th?>
						</span></div></td>
											</tr>

											<tr> 
											  <td><div align="center">
						<a title="<?=$categories_name_th?>" href="<?="products.php?cateparent=$categories_parent&level=$nextlv&thiscategories_id=$categories_id&title_name=$title_name";?>">
						<img src="images/product/b_more_detail.gif" width="181" height="35" alt="<?=$categories_name_th?>"></a></div></td>
								  </tr>
										 </table></td>
									  </tr>
							   </table>
						</td>
					  <?
					}
					   if ( $a == 3) {
							echo "</TR>";
							$a=1;
						}
						else{
						   $a++;
						}
				  } // end while
				  ?>
				  <tr>
				     <td colspan="3">
						  <TABLE  width="95%" border="0" cellpadding="2" cellspacing="2" align="center">
						<TR>
						<TD><span class="fsmall"><div align="right">ทั้งหมด <?=$haverow?> record</div><BR>
						<CENTER>
						<?php
						if($c_page > 1 && $c_page != "" && $amount != 0){ ?>
								<a style="cursor: hand" onClick="location='<?php echo "?cateparent=$cateparent&level=$level&thiscategories_id=$thiscategories_id&title_name=$title_name&c_page=".($c_page-1); ?>'"> 
								<img src="imgs/prevorange.gif" alt="Previous page" name="prev_page" width="16" height="16" border="0" align="absmiddle"></a></span>
								
								<?php }else{ ?>
								<img src="imgs/prev_dis.gif" alt="Previous page" name="prev_dis" width="16" height="16" border="0" align="absmiddle">
						 <?php } ?>
						 						 <span class="f12small">
						 &nbsp;Page :</span> 
						 <?php
						if ( $amount > 0 ) 	
								{
										for($p=1;$p<=$amount;$p++)  {
												if ($c_page == $p)   echo "<FONT color='#CC0000' class='cpage'> <B>$p</B> </FONT>";
												else  echo " <a href='?cateparent=$cateparent&level=$level&thiscategories_id=$thiscategories_id&title_name=$title_name&c_page=$p'>$p</a>";
										}
								}
						?></span>&nbsp;&nbsp;
						<span class="f12small"><?php if($c_page != $amount && $amount != 0){ ?>
								<a style="cursor: hand" onClick="location='<?php echo "?cateparent=$cateparent&level=$level&thiscategories_id=$thiscategories_id&title_name=$title_name&c_page=".($c_page+1); ?>'"> 
								<img src="imgs/nextorange.gif" alt="Next page" name="next_page" width="16" height="16" border="0" align="absmiddle"></a> 
								<?php }else{ ?>
								<img src="imgs/next_dis.gif" alt="Next page" name="next_dis" width="16" height="16" border="0" align="absmiddle">	
						<?php } ?></span>
						</CENTER></FONT><BR>
						</TD>
						</TR>
						</TABLE>

					 </td>
			      </tr>


				  <?
				} // if $haverow
				else{  //show products in categories
					
						$detail_sql = sql_Select(1, $prefix."_categories", " categories_id = '$thiscategories_id' and categories_status = 1", 0);
						//echo  $detail_sql ;
						$detail_query = $db->sql_query($detail_sql);
						$categories = $db->sql_fetchrow($detail_query);

						$categories_id=$categories['categories_id'];
						$categories_name_th=$categories['categories_name_th'];
						$categories_name_en=$categories['categories_name_en'];
						$categories_description_th = $categories['categories_description_th'];
						$categories_description_en = $categories['categories_description_en'];
						$title_name =  str_replace('&quot;','&nbsp;',$categories['categories_name_th'])."(".$categories['categories_name_en'].")";
						$categories_mainpic=$categories['categories_mainpic'];
						$categories_status=$categories['categories_status'];
						//$categories_popads =$categories['categories_popads'];
						
						 if (file_exists("$categoriespath/$categories_mainpic")){
							$widthsize=getimagesize("$categoriespath/$categories_mainpic"); 
							$old_w=$widthsize[0]; 
							$old_h=$widthsize[1]; 		
							$pic = "$categoriespath/$categories_mainpic";

							//echo "$widthsize[0],$widthsize[1]";
							
							if( $widthsize[1] >= 230 )  {
										// $p_ ย่อลงเท่าไหร่
										$p_ = (230/$widthsize[1]);
										$w = $widthsize[0]*$p_;
										$h = 230;

										if ( $w > 245){
										// $p_ ย่อลงเท่าไหร
										$p_ = (245/$widthsize[0]);
										$w = $widthsize[0]*$p_;
										$h = 230;
										}
									}
									else{
										// $p_ ขยายขึ้น
										$p_ = (230/$widthsize[1]);
										$w = $widthsize[0]*$p_;
										$h = 230;
									}
					 }
					 if (!file_exists("$categoriespath/$categories_mainpic")||$categories_mainpic == "") {
						 $pic = "$categoriespath/nopic.jpg";
						 $w = 245;
						 $h = 230;
					 }
				?>				
			  <table width="729" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr valign="top">
				  <td width="295" height="284" background="images/product/bk_main_pic.gif"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
					  <tr>
						<td>&nbsp;</td>
					  </tr>
					  <tr>
						<td><div align="center"><a href="javascript:;" onClick="MM_openBrWindow('function/popup/show_picture.php?pic=<?="../../".$pic."&ww=$old_w&hh=$old_h"?>','','width=<?=$old_w;?>,height=<?=$old_h;?>')" title="<?=$title_name; ?>"><img src="<?=$pic?>" width="<?=$w?>" height="<?=$h?>" border="0" alt="<?=$categories_name_th?>" alt="<?=$title_name?>"></a></div></td>
					  </tr>
				  </table></td>
				  <td width="441" height="284" background="images/product/bk_main_detail.gif"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
					  <tr>
						<td valign="top">&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
					  <?  $arr = explode("\n",$categories_description_th);
							foreach ($arr as $value){
								if ($value!=""){
								?>
					  <tr>
						<td width="15" valign="top">- </td>
						<td height="20"><span class="fgray"><?=$value?></span></td>
					  </tr>
					  <?
								}
							}
					   ?>
				  </table></td>
				</tr>
				<tr>
			  <td><center>
						<?
					  for($i=0;$i <= count($categories_popads);$i++){
				      if(file_exists($categoriespath."/".$categories_popads[$i])&&$categories_popads[$i]!=""){
					   ?>					  
					  <a href="<?=$categoriespath."/".$categories_popads[$i]; ?>" rel="lightbox[detail]" title="รายละเอียด <?=$categories_name_th."-".$categories_name_en; ?>"><span class="fsmall">คลิกเพื่อดูรายละเอียด<noscript><?=$i ?></noscript></span></a><br /><? } ?>
					  <? } ?></center>
			</td>
			<td>
			</td>
			</tr>
			  </table>
			  <?
			//หาจำนวน product ทั้งหมด
			$productspath = "backend/$products_path";
			$list_sql = sql_Select(1, $prefix."_products", "  categories_id = '$thiscategories_id'  and  products_delete='0' and products_status ='1' " , 0);					//echo "$list_sql<br>";
			$list_query = $db->sql_query($list_sql);									//echo "<br>$list_guery";
			$numrecord = $db->sql_numrows($list_query);								//echo "<br>$totalrec<br>";
			
			if (!$per_page) $per_page=$fperpage;
			if (!$c_page)   $c_page  = 1;
			if ($numrecord <$per_page) 	$amount = 1;
			else if ($numrecord%$per_page == 0)		$amount = $numrecord/$per_page;
					else		$amount = ceil($numrecord/$per_page);

			//	echo "amount=$amount,numrecord=$numrecord";

			if ($c_page > 1)  $prv = $c_page -1;
			if ($c_page < $amount )  $next = $c_page+1;
			$startpage = $c_page*$per_page - $per_page;

			$list_sql .= " ORDER BY products_model ,products_jb_no ASC LIMIT $startpage, $per_page";   //echo "<BR>$list_sql<br>";
			$list_query = $db->sql_query($list_sql);									//echo "<br>$list_guery";
			$haverow = $db->sql_numrows($list_query);								//echo "<br>$totalrec<br>";
			
			while (  $result= $db->sql_fetchrow($list_query))
				{
			$products_id=$result['products_id'];
			$products_name="";
			if (stripslashes($result['products_name_en'])) $products_name= stripslashes($result['products_name_en'])."<BR>";
			$products_name.=stripslashes($result["products_name"]);
			$products_model=stripslashes($result['products_model']);
			$products_jb_no=stripslashes($result['products_jb_no']);
			$products_type=stripslashes($result['products_type']);
			$products_thinkness=stripslashes($result['products_thinkness']);
			$products_volume=stripslashes($result['products_volume']);
			$products_capacity_static=stripslashes($result['products_capacity_static']);
			$products_capacity_dynamic=stripslashes($result['products_capacity_dynamic']);
			$products_capacity_racking=stripslashes($result['products_capacity_racking']);
			$products_standard_lift=stripslashes($result['products_standard_lift']);
			$products_dimension=stripslashes($result['products_dimension']);
			$products_platform=stripslashes($result['products_platform']);
			$products_platform_h1=stripslashes($result['products_platform_h1']);
			$products_height=stripslashes($result['products_height']);
			$products_footplate=stripslashes($result['products_footplate']);
			$products_wheeldia=stripslashes($result['products_wheeldia']);
			$products_threadstemwheel=stripslashes($result['products_threadstemwheel']);
			$products_numberofpartspanels=stripslashes($result['products_numberofpartspanels']);
			$products_horizontal=stripslashes($result['products_horizontal']);
			$products_vertical=stripslashes($result['products_vertical']);
			$products_airpressure=stripslashes($result['products_airpressure']);
			$products_deliverypressure=stripslashes($result['products_deliverypressure']);
			$products_setcontent=stripslashes($result['products_setcontent']);
			$products_colour=stripslashes($result['products_colour']);
			$products_range=stripslashes($result['products_range']);
			$products_female=stripslashes($result['products_female']);
			$products_male=stripslashes($result['products_male']);
			$products_numberofsection=stripslashes($result['products_numberofsection']);
			$products_cuttingwire=stripslashes($result['products_cuttingwire']);
			$products_slotted=stripslashes($result['products_slotted']);
			$products_phillips=stripslashes($result['products_phillips']);
			$products_small_drawers=stripslashes($result['products_small_drawers']);
			$products_rollers=stripslashes($result['products_rollers']);
			$products_material=stripslashes($result['products_material']);
			$products_qtypack=stripslashes($result['products_qtypack']);
			$products_price = getPrice($products_id);
            $products_discountprice = getDiscountPrice($products_id);
			//$products_price=stripslashes($result['products_price']);
			//$products_discountprice=stripslashes($result['products_discountprice']);
			$products_description=$result['products_description'];
			$products_description = str_replace("\n","<br>",$products_description);		
			$products_mainpic=$result['products_mainpic'];
			$products_status=$result['products_status'];
			$categories_id=$result['categories_id'];
			$products_create=$result['products_create'];
			$products_modify=$result['products_modify'];
			$products_promote=$result['products_promote'];
			$products_icon=$result['products_icon'];
			$products_logo=$result['products_logo'];

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
						 }
						 if ($products_mainpic == "" ) $pic = "../../$productspath/nopic.jpg";

		?>

			  <table width="729" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				  <td width="137">&nbsp;</td>
				  <td width="332">&nbsp;</td>
				  <td width="260">&nbsp;</td>
				</tr>

				<tr>
				  <td width="137" height="160" valign="top">
				  <table width="137" height="131" border="0" align="center" cellpadding="0" cellspacing="0">
					  <tr>
						<td background="images/product/bk_thumbnail_product.gif"><table width="90" border="0" align="center" cellpadding="0" cellspacing="0">
							<tr>
							  <td><div align="center"><a href="javascript:;" onClick="MM_openBrWindow('function/popup/show_picture.php?pic=<?="../../$productspath/$products_mainpic&ww=$old_w&hh=$old_h"?>','','width=<?=$old_w;?>,height=<?=$old_h;?>')"title="<?=$products_name; ?>"><img src="<?="$productspath/$products_mainpic";?>" width="100" height="100" alt="<?=$products_name?>"></a></div></td>
							</tr>
						</table></td>
					  </tr>
				  </table><center><?
					  for($i=0;$i <= count($categories_popads);$i++){
				      if(file_exists($categoriespath."/".$categories_popads[$i])&&$categories_popads[$i]!=""){
					   ?>					  
					  <a href="<?=$categoriespath."/".$categories_popads[$i]; ?>" rel="lightbox[detail]" title="รายละเอียด <?=$categories_name_th."-".$categories_name_en; ?>"><span class="fsmall">คลิกเพื่อดูรายละเอียด<noscript><?=$i ?></noscript></span></a><br /><? } ?>
					  <? } ?></center></td>
				  <td valign="top">
				  <table width="90%" border="0" align="center" cellpadding="1" cellspacing="1">
				  	
					  <tr>
						<td width="30%"><strong><span class="fgray">Description</span></strong></td>
						<td width="70%"><span class="fgray"><?=$products_name?></span></td>
					  </tr>
					  <tr>
						<td width="30%"><strong><span class="fgray">Model</span></strong></td>
						<td width="70%"><span class="fgray"><?=$products_model?></span></td>
					  </tr>
					  <tr>
						<td><strong><span class="fgray">JB 
						  No. </span></strong></td>
						<td><span class="fgray"><?=$products_jb_no?></span></td>
					  </tr>
					  <tr>
					  <td colspan="2"><br /><? if (file_exists("$productspath/$products_logo")&&($products_logo)){ echo "<img src='$productspath/$products_logo' width='50' height='35' alt='$products_name'>"; }?></td>
					  </tr>
					  <tr>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					  </tr>
				  </table></td>
				  <td width="260" valign="top"><table width="257" height="165" border="0" align="center" cellpadding="2" cellspacing="2">
					  <tr>
						<td height="54"><div align="center"><strong><span class="fgray">Price:</span></strong> <span class="fgray"><? if(($products_discountprice< $products_price) and ($products_discountprice>0)){?><strike><?=number_format($products_price,0);?>.-</strike><? }else{?><strong><?=number_format($products_price,0);?>.-</strong><? }?></span><br>
						    <? if(($products_discountprice< $products_price) and ($products_discountprice>0)){?> 
						  <font color="#FF0000" class="fsmall"><strong>Promotion Price: <?=number_format($products_discountprice,0);?>.-</strong></font><? }?></div></td>
					  </tr>
					  			<tr valign="middle">
                      <td width="49%" ><span class="fgray"><strong>Quantity 
                        :</strong>
                        <input id="amount" name="amount" type="text" value="1" size="1" onkeypress="CheckNumberOnly()" disabled="disabled">
    </span></td>
                      <td width="8%" >
					  <img src="images/ico_basket.gif" width="40" height="38" onclick="add_item(<?=$products_id?>,document.getElementById('amount').value)" onMouseOver="this.style.cursor='hand';">	</td>
					  <td width="43%">&nbsp;	 </td>
  </tr>

					  <tr>
						<td><div align="center"><img src="images/icon_buy.gif" width="146" height="35" onclick="document.location='products_detail.php?prod_id=<?=$products_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>&title_name=<?=str_replace('"',' ',$products_name); ?>';" onMouseOver="this.style.cursor='hand';"></div></td>
					  </tr>
					  <tr>
						<td height="49">
						<div align="right">
						<?
							$iconservicepath = "backend/$iconservice_path";
							$iconservice_allow = explode("-",$products_icon); //echo count($keep_allow);

							$iconservice_sql = sql_Select(1, $prefix."_iconservice",1, "iconservice_name");
							//echo $iconservice_sql;
						
							$iconservice_query = $db->sql_query($iconservice_sql);
							$iconservice_rec = $db->sql_numrows($iconservice_query);
							
							if ($iconservice_rec > 0) { // gen tbl
										while ($iconservice = $db->sql_fetchrow($iconservice_query))
										{												
												$iconservice_id = $iconservice['iconservice_id'];
												$iconservice_name = $iconservice['iconservice_name'];
												$iconservice_pic1 = $iconservice['iconservice_pic1'];
												$iconservice_status = $iconservice['iconservice_status'];
												if (in_array($iconservice_id,$iconservice_allow)){
												echo "<img src='$iconservicepath/$iconservice_pic1' width='35' height='35' border='0' alt='$iconservice_name'>&nbsp;";
												}
										}
							}
						?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div></td>
					  </tr>
				  </table></td>
				</tr>
				<tr>
				  <td height="15" colspan="3"><div align="center"><img src="images/tab_line.gif" width="720" height="8"></div></td>
				</tr>
				<tr>
				  <td colspan="3">&nbsp;</td>
				</tr>
			  </table>

				<?
				} //end while
				?>
			
						  <TABLE  width="95%" border="0" cellpadding="2" cellspacing="2" align="center">
						<TR>
						<TD><div align="right"><span class="fsmall">ทั้งหมด <?=$numrecord?> record</div><BR>
						<CENTER>
						<?php
						if($c_page > 1 && $c_page != "" && $amount != 0){ ?>
								<a style="cursor: hand" onClick="location='<?php echo "?cateparent=$cateparent&level=$level&thiscategories_id=$thiscategories_id&title_name=$title_name&c_page=".($c_page-1); ?>'"> 
								<img src="imgs/prevorange.gif" alt="Previous page" name="prev_page" width="16" height="16" border="0" align="absmiddle"></a>
								<?php }else{ ?>
								<img src="imgs/prev_dis.gif" alt="Previous page" name="prev_dis" width="16" height="16" border="0" align="absmiddle">
						 <?php } ?>
						 </span>
						 &nbsp;Page : 
						 <?php
						if ( $amount > 0 ) 	
								{
										for($p=1;$p<=$amount;$p++)  {
												if ($c_page == $p)   echo "<FONT color='#CC0000' class='cpage'> <B>$p</B> </FONT>";
												else  echo " <a href='?cateparent=$cateparent&level=$level&thiscategories_id=$thiscategories_id&title_name=$title_name&c_page=$p'>$p</a>";
										}
								}
						?>&nbsp;&nbsp;
						<?php if($c_page != $amount && $amount != 0){ ?>
								<a style="cursor: hand" onClick="location='<?php echo "?cateparent=$cateparent&level=$level&thiscategories_id=$thiscategories_id&title_name=$title_name&c_page=".($c_page+1); ?>'"> 
								<img src="imgs/nextorange.gif" alt="Next page" name="next_page" width="16" height="16" border="0" align="absmiddle"></a> 
								<?php }else{ ?>
								<img src="imgs/next_dis.gif" alt="Next page" name="next_dis" width="16" height="16" border="0" align="absmiddle">	
						<?php } ?>
						</CENTER></FONT><BR>
						</TD>
						</TR>
						</TABLE>
			  <h2>&nbsp;</h2>
			</td>
		  </tr>
			<?
				}
			?>
			
			</tr>
            <td width="243"></td>
            <td width="243"></td>
            <td width="243"></td>
			</tr>

				</td>
                </tr>
              </table>
			  
               </td>
            <td>&nbsp;</td>
          </tr>
        </table>
      <br />
    </td>
  </tr>
</table>

</div>
<div><?php include "footer.php"; ?></div>
</html>
