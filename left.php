<?
//$o_id = $_SESSION['o_id']; //Anon Add Code 16-01-2013 
$cate_global = "";
$cate_global2 = "";
function Recall($id){
		include "global.php";
		global $cate_global;
		$parent = getn("categories_parent","categories"," categories_id = $id and categories_status=1");		
		if ($parent) Recall($parent);
		$cate_global .= ",".$parent;
		return $cate_global;
}

function Recall2($id){
		include "global.php";
		global $cate_global2;
		$parent = getn("categories_parent","categories"," categories_id = $id and categories_status=1");		
		if ($parent) Recall2($parent);
		$cate_global2 .= ",".$parent;
		return $cate_global2;
}
?>
<table width="244" border="0" cellspacing="1" cellpadding="1" bgcolor="#C6A12F">
          <tr>
            <td  valign="top" bgcolor="#FFFFFF">
			<table width="238"  border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td valign="top">
					<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1">
					  
					  <tr>
						<td><br />
						  <select name="select" size="1" onChange="if(this.options[this.selectedIndex].value.length !=0) location=this.options[this.selectedIndex].value" style="color:#666666;width:238px">
							<option value="products.php">Change Category ... </option>
						<?
							$list_sql = sql_Select(1, $prefix."_categories", " categories_level = 0 $con_cate and categories_delete = 0 and categories_status=1", 0);
							$list_query = $db->sql_query($list_sql);
							$totalrec = $db->sql_numrows($list_query);
							  if ($totalrec>0)
							  {
								while (  $categories= $db->sql_fetchrow($list_query))
								{
											//print_r($categories);
											$categoriesid=$categories['categories_id'];
											$categoriesnameth=$categories['categories_name_th'];
											$categories_name_en=$categories['categories_name_en'];
											$title_name =  $categories['categories_name_th']."(".$categories['categories_name_en'].")";
											$categoriestype=$categories['categories_type'];
											$categoriesparent=$categories['categories_parent'];
											$categorieslevel=$categories['categories_level'];
											
											if ( $categoriesid == $thiscategories_id){

											?>
												<option value="<?="products.php?cateparent=$categoriesparent&level=1&thiscategories_id=$categoriesid&title_name=$title_name";?>" selected><?=$categoriesnameth?></option>
											  <? 
											}else{
												?>
												<option value="<?="products.php?cateparent=$categoriesparent&level=1&thiscategories_id=$categoriesid&title_name=$title_name";?>"><?=$categoriesnameth?></option>
											<?

												}
								} // end while
							  }// end if 
						?>
						  </select>						</td>
					  </tr>
					  <tr>
						<td><img src="images/tab_catalogue.jpg" width="235" height="48" /></td>
					  </tr>
					  <tr>
           			 <td><img src="images/tell_.png" width="248" height="30" alt="เบอร์โทรฝ่ายขาย"/></td>
         			 </tr>
					  <tr>
						<td height="150" valign="top">
						<table width="95%" border="0" align="center" cellpadding="1" cellspacing="1">
						<?
							  
							 //	 echo getn("categories_name_th","categories","categories_id = ".$thiscategories_id);
							  $str = Recall2($thiscategories_id);  // at left.php
							  $str = substr($str,1).",".$thiscategories_id;
							  $bg = array("#CCCC00","#CCCC33","#CCCC66","#CCCC99","","","","");
							  $arr_ = explode(",",$str);
							  for($i=0;$i < count($arr_);$i++){
								   $blandleft = 10*$i+1;
									if ($arr_[$i] != 0){
									
									$detail_sql = sql_Select(1, $prefix."_categories", " categories_id = ".$arr_[$i], "categories_id asc");
									//echo  $detail_sql ;
									$detail_query = $db->sql_query($detail_sql);
									$categories = $db->sql_fetchrow($detail_query);

									$categories_id=$categories['categories_id'];
									$categories_name_th=$categories['categories_name_th'];
									$categories_name_en=$categories['categories_name_en'];
									$title_name =  $categories['categories_name_th']."(".$categories['categories_name_en'].")";
									$categories_description_th = str_replace("\n","<br>",$categories['categories_description_th']);
									$categories_description_en = str_replace("\n","<br>",$categories['categories_description_en']);
									$categories_mainpic=$categories['categories_mainpic'];
									$categories_status=$categories['categories_status'];
									$strstyle="";
									if($i==1){$strstyle="font-weight:bold;";}

									echo "<tr bgcolor='".""."' height='30'><td colspan='2' style='padding:0px 0px 0px ".$blandleft."px;'><span style='font-size:".$ft=18-($i+1)."px; ".$strstyle."'><a href='products.php?cateparent=$categoriesparent&level=$i&thiscategories_id=$categories_id&title_name=$title_name'><span class='fmenu'>$categories_name_th</span></a></td></tr> ";
									}
							  }
							if (!isset($level))  $level = 0;
							$nextlv = $level + 1;
							$con_cate = "";$con_cate2 = "";
							if ($thiscategories_id)  {
								$con_cate = " and  categories_parent = $thiscategories_id and categories_status=1";
								$con_cate2 = " where categories_id = $thiscategories_id and categories_status=1";
							}
							else
								$con_cate2 = " where categories_id = 0 ";
							$list_sql = sql_Select(1, $prefix."_categories", " categories_level = $level $con_cate and categories_delete = 0 and categories_status=1", "categories_id asc");
							//$list_sql .= " order by categories_id asc";
							$list_query = $db->sql_query($list_sql);
							$totalrec = $db->sql_numrows($list_query);
							  if ($totalrec>0)
							  {
								while (  $categories= $db->sql_fetchrow($list_query))
								{
											//print_r($categories);
											$categoriesid=$categories['categories_id'];
											$categoriesnameth=$categories['categories_name_th'];
											$categories_name_en=$categories['categories_name_en'];
											$title_name =  $categories['categories_name_th']."(".$categories['categories_name_en'].")";
											$categoriestype=$categories['categories_type'];
											$categoriesparent=$categories['categories_parent'];
											$categorieslevel=$categories['categories_level'];

						?>
						  <tr>
							<td width="25" valign="middle"><div align="center"></div></td>
							<td onmouseover="this.className = 'hlt';" onmouseout="this.className = ''"; width="207" height="25" style="padding-left:5px;"><a href="<?="products.php?cateparent=$categoriesparent&level=$nextlv&thiscategories_id=$categoriesid&title_name=$title_name";?>"><span class="fmenu"><?=$categoriesnameth;?></span></a></td>
						  </tr>
						  <? 
											
								}
							  }// end if 
						?>
						</table>
						
						</td>
					  </tr>
					</table>
                </td>
              </tr>
            </table></td>
          </tr>
</table>
		<div style="height:5px"></div>
		<table width="246" border="0" cellspacing="1" cellpadding="1" bgcolor="#DDDDDD">
				  <tr>
					<td  valign="top" bgcolor="#FFFFFF">
		
			  
					 <?
					 $str_hide ="";
					 if (!$_SESSION['members_id'])   $str_hide = "style='display:none' ";
					 
					$order_sql = sql_Select(1, $prefix."_order", "order_id = '$o_id'", 0);
					//echo  $order_sql ;
					$order_query = $db->sql_query($order_sql);
					$order = $db->sql_fetchrow($order_query);
					
					$totalrec = $db->sql_numrows($list_query);							

					$grantotal =0;  // ???????????????????
					$totaldis = 0;
					?>
					<style> 
								  div#shopping_cart{
									FONT-FAMILY: Tahoma, MS Sans Serief, Arial; FONT-SIZE: 8pt;padding:7px;}
								   table#shopping_cart_items{
									FONT-FAMILY: Tahoma, MS Sans Serief, Arial; FONT-SIZE: 8pt;padding:7px;}
								  div#shopping_cart_totalprice{
									FONT-FAMILY: Tahoma, MS Sans Serief, Arial; FONT-SIZE: 8pt;padding:7px;}
								  div#head_shopping_cart{
									FONT-FAMILY: Tahoma, MS Sans Serief, Arial; FONT-SIZE: 8pt;padding:7px;color:#FFFFFF;
									 border: 1px solid #DDD;background-color:#C6A12F}
								  .data_member{
									FONT-FAMILY: Tahoma, MS Sans Serief, Arial; FONT-SIZE: 8pt;padding:7px;}
					</style>				
					<?
					
					    $startday = mktime(0, 0, 0, date("m"), 1,   date("Y"));						
						$endday=strtotime("+1month -1day",$startday);
						$startday = date('Y-m-d 00:00:00',$startday);    		
						$endday=date('Y-m-d 23:59:59',$endday);

					$arcode = getn("members_jb_arcode","members"," members_id='".$_SESSION['members_id']."'");
					$creditterm = getn("jb_credit_term_baht","arcode","jb_arcode='$arcode' ");

					$credituse = getn("sum(order_total + order_tax)","order","order_arcode = '$arcode' and order_payment = 'CreditTerm' and ( order_status = 'Wait' or order_status ='Preparing' ) and order_payment_status = 0 and order_delete = 0 and order_date between '$startday' and '$endday'; ");
					//echo "select sum(order_total + order_tax) from jenbunjerd_order where  order_arcode = '$arcode' and order_payment = 'CreditTerm' and ( order_status = 'Wait' or order_status ='Preparing' ) and order_date between '$startday' and '$endday'";
					//echo "$creditterm - $credituse";
					$result_credit = $creditterm - $credituse;
					
					$date = date("d");
					if ( $date < 6 ) {    // 5 this month to 5 next month
					    $startday = mktime(0, 0, 0, date("m")-1, 1,   date("Y"));						
						$endday=strtotime("+1month -1day",$startday);
						$startday = date('Y-m-d 00:00:00',$startday);    		
						$endday=date('Y-m-d 23:59:59',$endday);
						//$get_total = getn("sum(order_total - order_transportation)","order","order_payment_status = 1 and order_delete = 0 and order_date between '$startday' and '$endday'");
						$get_total = getn("sum(order_total - order_transportation)","order"," members_id='".$_SESSION['members_id']."'  and order_payment_status = 1 and order_delete = 0 ");
					}
					else{  
					    $startday = mktime(0, 0, 0, date("m"), 1,   date("Y"));						
						$endday=strtotime("+1month -1day",$startday);
						$startday = date('Y-m-d 00:00:00',$startday);    		
						$endday=date('Y-m-d 23:59:59',$endday);
						//$get_total = getn("sum(order_total - order_transportation)","order"," members_id='".$_SESSION['members_id']."' and order_payment_status = 1 and order_delete = 0 and order_date between '$startday' and '$endday'");  // real
						$get_total = getn("sum(order_total - order_transportation)","order"," members_id='".$_SESSION['members_id']."' and order_payment_status = 1 and order_delete = 0 ");  
					}
					//echo "order_date between '$startday' and '$endday' ";
					//echo " select sum(order_total - order_transportation) from jenbunjerd_order where members_id='".$_SESSION['members_id']."' and order_payment_status = 1 and order_delete = 0 and order_date between '$startday' and '$endday'";

					$point_now = floor($get_total/$setting_bahtperpoint);
					$use_point = getn("sum(order_reward_total)","order_reward"," members_id='".$_SESSION['members_id']."' and order_reward_delete = 0 ");
					$point_left = $point_now - $use_point;
					//echo "($point_now - $use_point)";


				?>
				<div id="shopping_cart">
					<div id="head_shopping_cart" <?=$str_hide?>></div>
					<div class="data_member" <?=$str_hide?>><strong>Balance Credits :  <?=number_format($result_credit, 2, '.', ',');?> บาท </strong></div>
					
					<div class="data_member" <?=$str_hide?>><strong>Reward Points : <?=number_format($point_left)?> แต้ม</strong></div>
					<div id="head_shopping_cart"><span class="fwhite"><strong>Shopping cart </strong></span>                     <img src="images/icon_shopping_cart.gif" /></div>
						<table id="shopping_cart_items" align="center" border="0" width="100%" cellspacing="1" cellpadding="1">
						    <tr>
								
								<th width="33%"><span class="f11small"><strong>รหัสสินค้า</strong></span></th>
								<th width="20%"><span class="f11small"><strong>จำนวน</strong></span></th>
								<th colspan="2"  align="right"><span class="f11small"><strong>ราคา/หน่วย&nbsp;&nbsp;</strong></span></th>
							</tr>
							<?
								$cart_sql = sql_Select(1, $prefix."_order_b", "order_id = '$o_id'", 0);
                                
								//echo  $cart_sql ;
								$cart_query = $db->sql_query($cart_sql);										
								$total_item = $db->sql_numrows($cart_query);
								
								if ($total_item > 0 ){
										while ( $cart = $db->sql_fetchrow($cart_query))
											{
												$orderb_id=$cart['orderb_id'];
												$order_id=$cart['order_id'];
												$products_id=$cart['products_id'];
                                                $price = getPrice($products_id);
												//$price=$cart['price'];
                                                echo "<p>price =</p>".$price;
                                                $discountprice = getDiscountPrice($products_id);
												//$discountprice=$cart['discountprice'];
                                                echo "<p>Discount =</p>".$discountprice;
												$amount=$cart['amount'];				
												
												$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$products_id'", 0);
												//echo  $detail_sql ;
												$detail_query = $db->sql_query($detail_sql);
												$result_left = $db->sql_fetchrow($detail_query);			

												$products_id=$result_left['products_id'];
												$products_model=stripslashes($result_left['products_model']);
												$products_jb_no=stripslashes($result_left['products_jb_no']);
												$products_price = getPrice($products_id);
                                                $products_discountprice = getDiscountPrice($products_id);
                                                //$products_price=stripslashes($result_left['products_price']);
												//$products_discountprice=stripslashes($result_left['products_discountprice']);
												$products_status=$result_left['products_status'];

												 if ($products_mainpic == "" ) $pic = "$productspath/nopic.jpg";
												 if(($products_discountprice< $products_price) and ($products_discountprice>0)){
													$tmp_price = $products_discountprice;
												 }else{
													$tmp_price =$products_price;
												 }

												$total=$amount*$tmp_price;
												$grantotal=$grantotal+$total;
												$totaldis = $totaldis + $price - $products_discountprice;

							?>
							<!-- Here, you can output existing basket items from your database 
							One row for each item. The id of the TR tag should be shopping_cart_items_product + productId,
							example: shopping_cart_items_product1 for the id 1 -->		
							<tr>
								
								<td><span class="f11small"><?=$products_jb_no?></span></td>
								<td align="center"><span class="f11small"><?=$amount?></span></td>
								<td colspan="2" align="right"><span class="f11small"><?=number_format($tmp_price, 0, '.', ',');?> บาท</span> <a href='cart.php?todo=deleted&ob_id=<?=$orderb_id?>'><img src="<?="imgs/del.gif";?>" border="0" alt="??"></a></td>
							</tr>
							<?
										}// end while
								}// end if 
								else{ ?>
									<tr height="15">
										<td></td>
										<td></td>
										<td ></td>
										<td ></td>
									</tr>									
								<?
								}
							?>
						</table>
						
						<div id="shopping_cart_totalprice"><span class="f11small"><strong>ยอดรวม :</strong></span> <span class="f11small"><strong><font color="#FF0000"><?=number_format($grantotal)?> บาท</font></strong></span></div>
					</div>
					
						<div id="shopping_cart_totalprice" align="right"><strong><a href="step-1.php"><span class="fgray"><strong>ชำระเงิน</strong></span></a></div>
					</div>
					<br />
					<div align="center">
<?php 
$total=3000;
if($grantotal <='3000'){
$total=$total-$grantotal;
?>
<span class="f12small">**ขณะนี้ท่านซื้อไปแล้ว <font color="red">&nbsp;<? echo number_format($grantotal);?></font>&nbsp; บาท ขาดอีก &nbsp;&nbsp;&nbsp;<font color="red"> <? echo number_format($total);?></font>บาท  &nbsp;จะมีสิทธิ์ลุ้นเที่ยวฟรี**
<?
}else if($grantotal >='3000'){
$total=$grantotal;
echo '**ราคาสินค้ารวม&nbsp;&nbsp; <font color="red">'.number_format($total).'</font>&nbsp;&nbsp;บาท ';
echo' ท่านมีสิทธิ์ลุ้นเที่ยวฟรีตลอดปีกับ บริษัทเจนบรรเจิด ** ';}
?>
</p>

ซื้อสินค้าครบ 3,000  บาท วันนี้ ลุ้นเที่ยวฟรีตลอดปีกับ  jenbunjerd <a href='http://www.jenbunjerd.com/allnews.php?newsid=49' target="_blank" >รายละเอียด</a></span>
</div>
					</td>
				</tr>
</table>
		<div style="height:5px"></div>
	
	<table width="100%" border="0" cellspacing="1" cellpadding="1">
	  <tr>
		<td valign="top"><img src="images/b_great_deal.gif" width="244" height="60" /></td>
	  </tr>
	  <? 
			$productspath = "backend/$products_path";
			//$sql = "select * from jenbunjerd_products where products_promote = 1 and products_delete = 0 ORDER BY RAND() limit 2";
			$sql = "select products_id,products_name,products_name_en,products_price,products_discountprice,products_mainpic ,categories_id from jenbunjerd_products where products_promote = 1 and products_delete = 0 and products_status = 1 and products_promote = 1 ORDER BY RAND()  limit 0,2";
			$p_query = $db->sql_query($sql);
			$p_totalrec = $db->sql_numrows($p_query);
			  if ($p_totalrec>0)
			  {
				while (  $result_left= $db->sql_fetchrow($p_query))
				{
							$products_id=$result_left['products_id'];
							$products_name = "";
							if ($result_left['products_name_en']){
							$products_name= $result_left['products_name_en']."<BR>";
							}
							$products_name.=stripslashes($result_left["products_name"]);
							$products_price=$result_left['products_price'];
							$products_discountprice=$result_left['products_discountprice'];
							$price_sale_left = 	$products_price;
							if($products_discountprice >0 and $products_discountprice< $products_price)
							$price_sale_left = $products_discountprice;
							$products_mainpic=$result_left['products_mainpic'];
							$categories_id_link = $result_left['categories_id'];
							$parent_cat_link = getn("categories_parent","categories ","categories_id='$categories_id_link'");
							
							

							//echo "$productspath/$products_mainpic";
							 if ( file_exists("$productspath/$products_mainpic") )	{
								$widthsize=getimagesize("$productspath/$products_mainpic"); 
								$old_w=$widthsize[0]; 
								$old_h=$widthsize[1]; 		

								//echo "$widthsize[0],$widthsize[1]";
								
								if( $widthsize[1] >= 100 )  {
											// $p_ ????????????
											$p_ = (100/$widthsize[1]);
											$w = $widthsize[0]*$p_;
											$h = 100;

											if ( $w > 120){
											// $p_ ???????????
											$p_ = (120/$widthsize[0]);
											$w = $widthsize[0]*$p_;
											$h = 100;
											}
										}
										else{
											// $p_ ????????
											$p_ = (100/$widthsize[1]);
											$w = $widthsize[0]*$p_;
											$h = 100;
										}
								/*$w = 575;
								$h = 300;*/
						 }
						 if ($products_mainpic == "" ) $pic = "$productspath/nopic.jpg";


	  ?>
	  <tr>
		<td valign="top"><div align="center"><a href="javascript:;" onClick="MM_openBrWindow('function/popup/show_picture.php?pic=<?="../../$productspath/$products_mainpic&ww=$old_w&hh=$old_h"?>','','width=<?=$old_w;?>,height=<?=$old_h;?>')" title="<?=$products_name; ?>"><img src="<?="$productspath/$products_mainpic";?>" width="<?=$w?>" height="<?=$h?>" alt="<?=$products_name; ?>"></a></div> </td>
	  </tr>
	  <tr>
		<td valign="top">
		<table width="90%" border="0" align="center" cellpadding="2" cellspacing="2">
			<tr>
			  <td><div align="center"><span class="f11gray"><?=$products_name?></span><br />
									<span class="f11gray"><strong>ราคา : <?=number_format($price_sale_left, 0, '.', ',');?>.-</strong></span><br />
			  </div></td>
			</tr>
		</table></td>
	  </tr>
	  <tr>
		<td height="45" valign="middle"><div align="center"><img src="images/icon_buy.gif" width="146" height="35" onclick="document.location='products_detail.php?prod_id=<?=$products_id?>&cateparent=<?=$parent_cat_link?>&thiscategories_id=<?=$categories_id_link?>&title_name=<?=str_replace('"',' ',$products_name); ?>';" onMouseOver="this.style.cursor='hand';"></div></td>
	  </tr>
	  <?
				}
			  }
	  ?>
	  <tr>
		<td valign="top">&nbsp;</td>
	  </tr>
	  <tr>
		<td valign="top">&nbsp;</td>
	  </tr>
  </table>
