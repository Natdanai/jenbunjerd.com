<? 
session_start();
include "config.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<head>
<link href="css/spacial-price.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script language="javascript" src="js/win_func.js"></script>

<script type="text/javascript">

$(document).ready(function(){
  var currentPosition = 0;
  var slideWidth = 650;
  var slides = $('.slide');
  var numberOfSlides = slides.length;

  // Remove scrollbar in JS
  $('#slidesContainer').css('overflow', 'hidden');

  // Wrap all .slides with #slideInner div
  slides
    .wrapAll('<div id="slideInner"></div>')
    // Float left to display horizontally, readjust .slides width
	.css({
      'float' : 'left',
      'width' : slideWidth
    });

  // Set #slideInner width equal to total width of all slides
  $('#slideInner').css('width', slideWidth * numberOfSlides);

  // Insert controls in the DOM
  $('#slideshow')
    .prepend('<span class="control" id="leftControl">Clicking moves left</span>')
    .append('<span class="control" id="rightControl">Clicking moves right</span>');

  // Hide left arrow control on first load
  manageControls(currentPosition);

  // Create event listeners for .controls clicks
  $('.control')
    .bind('click', function(){
    // Determine new position
	currentPosition = ($(this).attr('id')=='rightControl') ? currentPosition+1 : currentPosition-1;
    
	// Hide / show controls
    manageControls(currentPosition);
    // Move slideInner using margin-left
    $('#slideInner').animate({
      'marginLeft' : slideWidth*(-currentPosition)
    });
  });

  // manageControls: Hides and Shows controls depending on currentPosition
  function manageControls(position){
    // Hide left arrow if position is first slide
	if(position==0){ $('#leftControl').hide() } else{ $('#leftControl').show() }
	// Hide right arrow if position is last slide
    if(position==numberOfSlides-1){ $('#rightControl').hide() } else{ $('#rightControl').show() }
  }	
});
</script>
<!-- Search Promotion products -->

<!-- end search -->
</head>
<body>
<div><?php include "header.php"; ?></div>
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
      <!--<tr>
        <td><? include("banner.php");?></td>
      </tr>  -->
    </table>
           
		<?php include("spacial-price.php");?>
		
        
        <table width="734" border="0" cellspacing="0" cellpadding="0">
            <tr >
                  <td height="10"></td>
                </tr>
          <tr>
            <!--<td height="81" valign="top" background="images/product/bk_tab_submenu.gif"><table width="95%" border="0" align="center" cellpadding="2" cellspacing="2"> -->
            <td valign="top" background="images/promotion/spacial_08.png" width="734" height="35" />
                
                <tr >

                 <!--  <td height="30"><p align="right"><font color="#C6A12F" class="fsmall">Download promotin file: <a href="download/ProClearanceSals 2012_revised261055.xls"><img src="imgs/promotion-banner/excel2003-icon.png" width="32" height="32" /></a> , <a href="download/ProClearanceSals2012_revised261055.pdf"><img src="imgs/promotion-banner/pdf-icon.png" width="32" height="32" /> </a></font></p> </td>-->
                </tr>
                <tr>
                  <td class='top-link'><font class="fsmall"><strong>
     
                  </strong></font></td>
                </tr>
            </td>
          </tr>
        </table>
	
      <table width="729" border="0" align="center" cellpadding="0" cellspacing="0">
		                   
                      
						
						
					  
				  
   

				  <?
                  $strSearch = $_POST["mySearch"];
				 // if $haverow
			     	{  //show products in categories
					
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
			  
			  <?
			//หาจำนวน product ทั้งหมด
			$productspath = "backend/$products_path";
			//$list_sql = sql_Select(1, $prefix."_products", "  categories_id = '$thiscategories_id'  and  products_delete='0' and products_status ='1' " , 0);					//echo "$list_sql<br>";
			//$list_sql = ("SELECT * FROM ".$prefix."_products WHERE products_discountprice > 0 AND products_status = '1'AND products_promote = '1'");
            //QUERY14-11-2012 promotion $list_sql = ("SELECT * FROM ".$prefix."_products WHERE products_discountprice > 0 AND products_status = products_promote AND ((promotion_start_date = '0000-00-00' OR promotion_start_date < NOW()) AND (promotion_end_date = '0000-00-00' OR promotion_end_date > NOW()))");
            
                      
            //$list_sql = ("SELECT * FROM ".$prefix."_products WHERE products_discountprice > 0 AND products_status = products_promote AND ((promotion_start_date = '0000-00-00' OR promotion_start_date < NOW()) AND (promotion_end_date = '0000-00-00' OR promotion_end_date > NOW()))");
            //$list_sql = "SELECT *  FROM ".$prefix."_products WHERE `products_id` IN ( SELECT DISTINCT products_id FROM ".$prefix."_productdiscount)";
            //$list_sql .= " WHERE ( ( date_start='0000-00-00' OR date_start < NOW() ) AND ( date_end='000-00-00' OR date_end > NOW() ) )";
            $list_sql = "SELECT * FROM jenbunjerd_products WHERE `products_id` IN ( SELECT DISTINCT products_id FROM jenbunjerd_productdiscount WHERE ( ( date_start='0000-00-00' OR date_start < NOW() ) AND ( date_end='000-00-00' OR date_end > NOW() ) ) ORDER BY date_start DESC )";
            //echo($list_sql);
            //$list_query = "SELECT * FROM jenbunjerd_products WHERE (products_promotion = 1 AND products_discountprice > 0) AND products_status =1 AND products_promote = 1 AND ((promotion_start_date = '0000-00-00' OR promotion_start_date < NOW()) AND (promotion_end_date = '0000-00-00' OR promotion_end_date > NOW()))";
            $list_query = $db->sql_query($list_sql);
            if(!$list_query){
                echo "no Query";
            }									//echo "<br>$list_guery";
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

			//$list_sql .= " ORDER BY products_model ,products_jb_no ASC LIMIT $startpage, $per_page";   //echo "<BR>$list_sql<br>";
			$list_sql .= " ORDER BY products_jb_no ASC LIMIT $startpage, $per_page"; 
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
            $products_id;
            $products_price = getPrice($products_id);
            $products_discountprice = getDiscountPrice($products_id);
            //$products_price=stripslashes($result['products_price']);
			//$products_discountprice=stripslashes($result['products_discountprice']);
			$promotion_start_date=$result['promotion_start_date'];
			$promotion_end_date=$result['promotion_end_date'];
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
				  </table><center>					  
					  </center></td>
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
						  <font color="#FF0000" class="fsmall"><strong>Promotion: <?=number_format($products_discountprice,0);?>.-</strong></font>
						  <? }?>
						  </div></td>
					 
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
												else  echo " <a href='?c_page=$p'>$p</a>";
										}
								}
						?>&nbsp;&nbsp;
						<?php if($c_page != $amount && $amount != 0){ ?>
								<a style="cursor: hand" onClick="location='<?php echo "?c_page=".($c_page+1); ?>'"> 
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
