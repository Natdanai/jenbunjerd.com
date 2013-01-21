<? 
session_start();
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" href="css/clsFont.css" type="text/css" media="screen" />
<? include "set_title.php"; ?>
<title><? echo $title; ?> <? echo $_REQUEST[title_name]; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620">
<script language="javascript" src="js/win_func.js"></script>
<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
	
	<script src="js/prototype.js" type="text/javascript"></script>
	<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
	<script src="js/lightbox.js" type="text/javascript"></script>
    
    <!--Slide image-->
    <script type="text/javascript">
	function change(path){
		var large=document.getElementById('large');
		large.src=path;
		large.width=350;
	}
	</script>
    <!--End Slide image-->
</head>
<style>
.td_tdesc {	
	FONT-FAMILY: MS Sans Serif, Tahoma, sans-serif; FONT-SIZE: 8pt;
	color:#000000; 
	font-weight: bold;
 	text-align: left;
	width: 80px;
}
.td_tdesc2 {	
	FONT-FAMILY: MS Sans Serif, Tahoma, sans-serif; FONT-SIZE: 8pt;
	color:#FFFFFF; 
 	text-align: left;
	width: 120px;
}
</style>
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
    </table>	</td>
    <td>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td valign="top"><? include("banner.php");?></td>
      </tr>
    </table>

              <table width="739" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td height="81" valign="top" background="images/product/bk_tab_submenu.gif"><table width="95%" border="0" align="center" cellpadding="2" cellspacing="2">
                <tr >
                  <td height="30"><font color="#C6A12F" size="1" face="MS Sans Serif, Tahoma, sans-serif"></font></td>
                </tr>
                <tr>
                  <td><font color="#000000" size="2" face="MS Sans Serif, Tahoma, sans-serif"><strong>
                    <?
					$categoriespath = "backend/$categories_path";
			    echo getn("categories_name_th","categories","categories_id = ".$thiscategories_id);
				  $str = ReCall($thiscategories_id);  // at left.php
				  $str = substr($str,1).",".$thiscategories_id;
				  
				  $arr_ = explode(",",$str);
				  for($i=0;$i < count($arr_);$i++){
						if ($arr_[$i] != 0){
						$detail_sql = sql_Select(1, $prefix."_categories", " categories_id = ".$arr_[$i], 0);
						//echo  $detail_sql ;
						$detail_query = $db->sql_query($detail_sql);
						$categories = $db->sql_fetchrow($detail_query);

						$categories_id=$categories['categories_id'];
						$categories_name_th=$categories['categories_name_th'];
						$categories_name_en=$categories['categories_name_en'];
						$categories_description_th = str_replace("\n","<br>",$categories['categories_description_th']);
						$categories_description_en = str_replace("\n","<br> ",$categories['categories_description_en']);
						$categories_mainpic=$categories['categories_mainpic'];
						$categories_popads[$i]=$categories['categories_popads'];
						$categories_status=$categories['categories_status'];
						echo "<span class='top-link'><a href='products.php?cateparent=$categoriesparent&level=$i&thiscategories_id=$categories_id'>$categories_name_th</a></span> &gt; ";
						}
						}
				  echo "<span class='top-link'>".str_replace("<BR>"," ",$_REQUEST[title_name])."</span>";
				  ?>
                  </strong></font></td>
                </tr>
            </table></td>
        </tr>
      </table>
	  <?

			$productspath = "backend/$products_path";
$arr_product_fieldname = Array("Key","JB No","Model","Type","Thinkness(mm)","Volume (lit.)","Load Capacity (kg)","Static","Dynamic","Racking","Standard Lift  (m)","Dimension WxDxH (mm)","Platform   (mm)","Distance Between Platforms H1 (mm)",
"Height  (mm) (note) ie. Bag","Footplate (mm)","Wheel Dia.(mm)","Thread Stem Wheel (mm)","Number of Parts Panels", "Horizontal","Vertical","AirPressure(kg / cm2)", "Delivery Pressure(kg / cm2)", "Colour","Set Content","Range (km)","Female(in.)" , "Male(in.)","Number of Sections", "Cutting Wire (mm)","SLOTTED (mm)","PHILLIPS(mm)","Number of Small Drawers","Number of Rollers", "Material","Qty./Pack","Price","Discount Price","Additional description","Picture","Icon Service","Status","Categories","Create Date","Modify Date","Promote on Web");

				$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$prod_id ' ", 0);
			$detail_query = $db->sql_query($detail_sql);
			$result = $db->sql_fetchrow($detail_query);			

			$products_id=$result['products_id'];
			$products_name=$result["products_name_en"]."<br>".$result['products_name'];
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
			$products_detail = $result['products_detail'];
			$products_description = str_replace('<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />',"",$products_description);
			$products_mainpic0=$result['products_mainpic'];
			$products_mainpic1=$result['products_mainpic1'];
			$products_mainpic2=$result['products_mainpic2'];
			$products_mainpic3=$result['products_mainpic3'];
			$products_mainpic4=$result['products_mainpic4'];
			$products_status=$result['products_status'];
			$categories_id=$result['categories_id'];
			$products_create=$result['products_create'];
			$products_modify=$result['products_modify'];
			$products_promote=$result['products_promote'];
			$products_icon=$result['products_icon'];
			$products_keyword=$result['products_keyword'];

			$products_drawning=$result['products_picDrawing'];
			
			if($products_status==4){
				 
			}else if($products_status!=4){ ?>
      <table width="729" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr valign="top">
          <td width="352" height="344" align="center"><table width="352" height="420" border="0" cellpadding="0" cellspacing="0" style="margin-top:15px;">
              <tr>
                <td height="393" align="center" valign="top" >					
            
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td><img src="<?="$productspath/$products_mainpic0";?>"  alt="<?=$_REQUEST[title_name]; ?>" id="large" width="350" /></td>
  </tr>
  <tr>
    <td style="height:80px;"><table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>  
    <? if($products_mainpic0!=""){?>
    <td><img src="<?="$productspath/$products_mainpic0";?>" width="80" style="cursor:pointer;" onclick="change('<?="$productspath/$products_mainpic0";?>')" alt="<?=$_REQUEST[title_name]; ?>"/></td>
    <? }?>
    <? if($products_mainpic1!=""){?>
    <td><img src="<?="$productspath/$products_mainpic1";?>" width="80" style="cursor:pointer;" onclick="change('<?="$productspath/$products_mainpic1";?>')" alt="<?=$_REQUEST[title_name]; ?>"/></td>
    <? }?>
    <? if($products_mainpic2!=""){?>
    <td><img src="<?="$productspath/$products_mainpic2";?>" width="80" style="cursor:pointer;" onclick="change('<?="$productspath/$products_mainpic2";?>')" alt="<?=$_REQUEST[title_name]; ?>"/></td>
    <? }?>
    <? if($products_mainpic3!=""){?>
    <td><img src="<?="$productspath/$products_mainpic3";?>" width="80" style="cursor:pointer;" onclick="change('<?="$productspath/$products_mainpic3";?>')" alt="<?=$_REQUEST[title_name]; ?>"/></td>
    <? }?>
  </tr>
</table></td>
  </tr>
</table>
</td>
              </tr>
			  <tr>
			
			  <td> 
			    <?php 
			 
			    $cross_sql = sql_Select(1, $prefix."_crossselling", "jb_no = '$products_jb_no ' ", 0);	
				$cross_query = $db->sql_query($cross_sql);
				
				$cross_result = $db->sql_fetchrow($cross_query);			
				$cross_active=$cross_result['cross_active'];
				if($cross_active='1'){
			  ?>
			  
			  <table><tr>
			  <?php $cross1=stripslashes($cross_result['cross1']);
			   if($cross1!=""){
				   $productspath = "backend/$products_path";
				   $select=sql_Select(1, $prefix."_products", "products_jb_no = '$cross1' ", 0);
				  
				   
				   $query_r = $db->sql_query($select);
				  
					$fetch = $db->sql_fetchrow($query_r);
					 //print_r($fetch);	
					$c_id=$fetch['products_id'];
					$c_name=$fetch['products_name'];
					$c_model=stripslashes($fetch['products_model']);
					 $c_jb_no=stripslashes($fetch['products_jb_no']);
					$pic1=$fetch['products_mainpic'];
				   ?>
				   <? //="products_detail.php?cateparent=$categories_parent&level=$nextlv&thiscategories_id=$categories_id&title_name=$title_name";?>  
				   		   <h2><div class="f14gray">สินค้าใชัร่วม</div></h2>
			  <td>	
			 	
			   <img src="<?="$productspath/$pic1";?>" alt="<?=$c_name?>" width="80"  onclick="document.location='products_detail.php?prod_id=<?=$c_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>&title_name=<?=str_replace('"',' ',$products_name); ?>';" onMouseOver="this.style.cursor='hand';">
			</td>
			  <?php }?>
			  
			   <?php $cross2=stripslashes($cross_result['cross2']);
			   if(  $cross2!=""){
			      $productspath = "backend/$products_path";
				   $select2=sql_Select(1, $prefix."_products", "products_jb_no = '$cross2' ", 0);
				  
				   
				   $query_r2 = $db->sql_query($select2);
				  
					$fetch2 = $db->sql_fetchrow($query_r2);
					 //print_r($fetch);	
					$c_id2=$fetch2['products_id'];
					$c_name2=$fetch2['products_name'];
					$c_model2=stripslashes($fetch2['products_model']);
					 $c_jb_no2=stripslashes($fetch['products_jb_no']);
					$pic2=$fetch2['products_mainpic'];
			   ?>
			  <td>
			  		   <img src="<?="$productspath/$pic2";?>" alt="<?=$c_name?>" width="80"  onclick="document.location='products_detail.php?prod_id=<?=$c_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>&title_name=<?=str_replace('"',' ',$products_name); ?>';" onMouseOver="this.style.cursor='hand';">
			 	</td><?php }?>
			 <?php  $cross3=stripslashes($cross_result['cross3']);
			   if(  $cross3!=""){
			      $productspath = "backend/$products_path";
				   $select=sql_Select(1, $prefix."_products", "products_jb_no = '$cross3' ", 0);
				  
				   
				   $query_r = $db->sql_query($select);
				  
					$fetch = $db->sql_fetchrow($query_r);
				
					$c_id=$fetch['products_id'];
					$c_name=$fetch['products_name'];
					$c_model=stripslashes($fetch['products_model']);
					 $c_jb_no=stripslashes($fetch['products_jb_no']);
					$pic3=$fetch['products_mainpic'];
			   ?><td>
						   <img src="<?="$productspath/$pic3";?>" alt="<?=$c_name?>" width="80"  onclick="document.location='products_detail.php?prod_id=<?=$c_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>&title_name=<?=str_replace('"',' ',$products_name); ?>';" onMouseOver="this.style.cursor='hand';"></td><?php }?>
			  
			<?php  $cross4=stripslashes($cross_result['cross4']);
			   if(  $cross4!=""){
			      $productspath = "backend/$products_path";
				   $select=sql_Select(1, $prefix."_products", "products_jb_no = '$cross4' ", 0);
				  
				   
				   $query_r = $db->sql_query($select);
				  
					$fetch = $db->sql_fetchrow($query_r);
					
					$c_id=$fetch['products_id'];
					$c_name=$fetch['products_name'];
					$c_model=stripslashes($fetch['products_model']);
					 $c_jb_no=stripslashes($fetch['products_jb_no']);
					$pic4=$fetch['products_mainpic'];
			   ?><td>
			 			   <img src="<?="$productspath/$pic4";?>" alt="<?=$c_name?>" width="80"  onclick="document.location='products_detail.php?prod_id=<?=$c_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>&title_name=<?=str_replace('"',' ',$products_name); ?>';" onMouseOver="this.style.cursor='hand';"></td><?php }?>
			<?php  $cross5=stripslashes($cross_result['cross5']);
			   if(  $cross5!=""){
			      $productspath = "backend/$products_path";
				   $select=sql_Select(1, $prefix."_products", "products_jb_no = '$cross5' ", 0);
				  
				   
				   $query_r = $db->sql_query($select);
				  
					$fetch = $db->sql_fetchrow($query_r);
					
					$c_id=$fetch['products_id'];
					$c_name=$fetch['products_name'];
					$c_model=stripslashes($fetch['products_model']);
					 $c_jb_no=stripslashes($fetch['products_jb_no']);
					$pic5=$fetch['products_mainpic'];?>
			 <td> 
			  		   <img src="<?="$productspath/$pic5";?>" alt="<?=$c_name?>" width="80"  onclick="document.location='products_detail.php?prod_id=<?=$c_id?>&cateparent=<?=$categories_id?>&thiscategories_id=<?=$categories_id?>&title_name=<?=str_replace('"',' ',$products_name); ?>';" onMouseOver="this.style.cursor='hand';"></td><?php }?></tr></table>
			  <?php }else if($cross_active='0')?>
			  </td>
			  </tr>
			  <tr><td>
			<?php 
			  $products_keyword; 
			  $nameArray = split(",|and",$products_keyword);

				foreach($nameArray as $key)
  			   echo "<a href='products.php?cateparent=$categoriesparent&level=$i&thiscategories_id=$categories_id'>"."$key"."</a>";

?>
		
			  
			  </td></tr>
          </table></td>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td><img src="images/product/bk_top_yellow.gif" width="383" height="22"></td>
              </tr>
              <tr>
                <td background="images/product/bk_mid_yellow.gif"><table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
                    <tr>
                      <td colspan="3"><span class="fnormal"><strong><?=$products_name; ?></strong></span></td>
                    </tr>
					 <? if ($products_price == 0) { ?>
					 <? } else { ?>
                  <!--  <tr>
                      <td colspan="3"><span class="fnormal"><strong>READ 
                        TO BUY ?</strong></span></td>
                    </tr>-->
                    <tr>
                      <td colspan="3"><span class="fsmall"><strong>
                        Price </strong>: <?  if(($products_discountprice< $products_price) and ($products_discountprice>0)){?><strike><?=number_format($products_price)?></strike><? }else { ?> <strong><?=number_format($products_price)?></strong> <? }?>บาท<br>
                                      <?  if(($products_discountprice< $products_price) and ($products_discountprice>0)){?>   <span class="fsmall">Promotion Price :  <?=number_format($products_discountprice)?></span></strong></span> <? }?></td>
                    </tr>
                    <tr valign="middle">
                      <td width="26%"><span class="fsmall"><strong>Quantity 
                        :</strong></font></td>
                      <td width="20%"><font size="2" face="Arial, Helvetica, sans-serif">
                        <input id="amount" name="amount" type="text" value="1" size="5" onkeypress="CheckNumberOnly()">
                      </font></td>
                      <td width="54%">
				
					 
					  <img src="images/product/icon_add_basket.gif" width="179" height="38" onclick="add_item(<?=$products_id?>,document.getElementById('amount').value)" onMouseOver="this.style.cursor='hand';">			
					 	  </td>
                    </tr>
					<? } ?>
                </table></td>
              </tr>
              <tr>
                <td height="57" background="images/product/bk_mid_yellow.gif"  >
				<table width="382" border="0">
                  <tr <? if($products_icon=='' ) echo " style='display:none;' ";?>  >	
				  	<td width="50%"></td>
                    <td><div align="right" style="margin-right:20px">
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
						?></div>  </td>
                  </tr>
                </table></td>
              </tr>
              <tr valign="top">
                <td background="images/product/bk_mid_yellow.gif"  v><table width="90%" border="0" align="center" cellpadding="2" cellspacing="2" >
                 
					<tr>
                      <td valign="top">&nbsp;</td>
                      <td  valign="top"><span class="fsmall"><?=$products_detail?></span></td>
                    </tr>

					  <?  
							$arr = explode("\n",$products_detail);
							foreach ($arr as $value){
								if ($value!=""){
								?> <tr style="display:none">
                      <td width="15" valign="top"><img src="images/product/dot_yellow.gif" width="13" height="13"></td>
                      <td height="20"><font color="#000000" size="2" face="MS Sans Serif, Tahoma, sans-serif"><?=$value?></font></td>
					  </tr>
					  <?
								}
							}
					   ?>
                  </table>
                    <br>
                    <table width="85%" border="0" align="center" cellpadding="2" cellspacing="2">
                      <tr>
                        <td height="26" ><span class="fsmall"><strong>Model</strong></td>
                        <td ><span class="fsmall"><?=$products_model?></span></td>
                      </tr>
                      <tr>
                        <td height="26" ><span class="fsmall"><strong>JB No.</strong></span> </td>
                        <td><span class="fsmall"><?=$products_jb_no?></span></td>
                      </tr>
                      <tr <? if ($products_dimension == "") echo "style='display:none' "; ?>>
                        <td height="26" ><span class="fsmall"><strong>Dimension W x D x H (mm)</strong></span></td>
                        <td><span class="fsmall"><?=$products_dimension?></td>
                      </tr>
                      <tr <? if ($products_type == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[3]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_type?></span></td>
					 </tr>
                      <tr <? if ($products_thinkness == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[4]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_thinkness?></span></td>
					 </tr>
                      <tr <? if ($products_volume == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><?=$arr_product_fieldname[5]?></td>
						 <td><span class="fsmall"><?=$products_volume?></span></td>
					 </tr>
						  <tr <? if (!$products_capacity_static  || !$products_capacity_dynamic || !$products_capacity_racking ) echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><?="$products_capacity_static,$products_capacity_dynamic,$products_capacity_racking";?><?=$arr_product_fieldname[6]?></td>
						 <td><table>
						  <tr <? if ($products_capacity_static == "") echo "style='display:none' "; ?>><td><span class="fsmall"><?=$arr_product_fieldname[7]?></span></td><td><span class="fsmall"><?=$products_capacity_static?></span></td></tr>
						  <tr <? if ($products_capacity_dynamic == "") echo "style='display:none' "; ?>><td><span class="fsmall"><?=$arr_product_fieldname[8]?></span></td><td><span class="fsmall"><?=$products_capacity_dynamic?></span></td></tr>
						 <tr <? if ($products_capacity_racking == "") echo "style='display:none' "; ?>><td><span class="fsmall"><?=$arr_product_fieldname[9]?></span></td><td><span class="fsmall"><?=$products_capacity_racking?></span></td></tr></table>						 </td>
					 </tr>
                      <tr <? if ($products_standard_lift == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[10]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_standard_lift?></span></td>
					 </tr>
                  
                      <tr <? if ($products_platform == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[12]?></strong></span></td>
						 <td class><span class="fsmall"><?=$products_platform?></span></td>
					 </tr>
                      <tr <? if ($products_platform_h1 == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[13]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_platform_h1?></span></td>
					 </tr>
                      <tr <? if ($products_height == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[14]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_height?></span></td>
					 </tr>
                      <tr <? if ($products_footplate == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><?=$arr_product_fieldname[15]?></td>
						 <td class='td_tdesc2'><?=$products_footplate?></td>
					 </tr>
                      <tr <? if ($products_wheeldia == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[16]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_wheeldia?></span></td>
					 </tr>
                      <tr <? if ($products_threadstemwheel == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[17]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_threadstemwheel?></span></td>
					 </tr>
                      <tr <? if ($products_numberofpartspanels == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[18]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_numberofpartspanels?></span></td>
					 </tr>
                      <tr <? if ($products_horizontal == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[19]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_horizontal?></span></td>
					 </tr>
                      <tr <? if ($products_vertical == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[20]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_vertical?></span></td>
					 </tr>
                      <tr <? if ($products_airpressure == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[21]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_airpressure?></span></td>
					 </tr>
                      <tr <? if ($products_deliverypressure == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[22]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_deliverypressure?></span></td>
					 </tr>
                      <tr <? if ($products_setcontent == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[23]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_setcontent?></span></td>
					 </tr>
                      <tr <? if ($products_colour == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[24]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_colour?></span></td>
					 </tr>
                      <tr <? if ($products_range == "") echo "style='display:none' "; ?>>
					   <td height="26"> <span class="fsmall"><strong><?=$arr_product_fieldname[25]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_range?></span></td>
					 </tr>
                      <tr <? if ($products_female == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[26]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_female?></span></td>
					 </tr>
                      <tr <? if ($products_male == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[27]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_male?></span></td>
					 </tr>
                      <tr <? if ($products_numberofsection == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[28]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_numberofsection?></span></td>
					 </tr>
                      <tr <? if ($products_cuttingwire == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[29]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_cuttingwire?></span></td>
					 </tr>
                      <tr <? if ($products_slotted == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[30]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_slotted?></span></td>
					 </tr>
                      <tr <? if ($products_phillips == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[31]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_phillips?></span></td>
					 </tr>
                      <tr <? if ($products_small_drawers == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[32]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_small_drawers?></span></td>
					 </tr>
                      <tr <? if ($products_rollers == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[33]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_rollers?></span></td>
					 </tr>
                      <tr <? if ($products_material == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[34]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_material?></span></td>
					 </tr>
                      <tr <? if ($products_qtypack == "") echo "style='display:none' "; ?>>
					   <td height="26"><span class="fsmall"><strong><?=$arr_product_fieldname[35]?></strong></span></td>
						 <td><span class="fsmall"><?=$products_qtypack?></span></td>
					 </tr>
                    <!--  <tr <? //if ($products_price == "") echo "style='display:none' "; ?>>
                        <td><strong><span class="fsmall">Price/Unit 
                          (Baht)</span></strong></td>
                        <td><span class="fsmall"><strong><? //=number_format($products_price)?></strong></span></td>
                      </tr>-->
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                  </table></td>
              </tr>
              <tr>
                <td><img src="images/product/bk_bottom_yellow.gif" width="383" height="23"></td>
              </tr>
          </table>		  </td>
        </tr>
      </table>
      <table cellspacing='1' cellpadding='0' border='0'  width='730' bgcolor="#CCCCCC">
				<tr>
					<td bgcolor="#FFFFFF">
		      <table id="Table_01" width="730" border="0" cellpadding="20" cellspacing="0" align="left">
		        <tr>
		          <td ><span class="forage"><strong>&nbsp;<U>Products Description</U> </strong></span><br><br><?=trim($products_description);?></td>
		        </tr>
		        </table>		      </td>
		    </tr>
	    </table>

		  </td>
  </tr>
  <tr valign="top">
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
 <?php  }?>	

		   </td>
		<td>&nbsp;</td>
	  </tr>
	</table>

</div>
<div><?php include "footer.php"; ?></div>
</html>
