 <link rel="stylesheet" href="colorpicker/css/colorpicker.css" type="text/css" />

	<script type="text/javascript" src="colorpicker/js/jquery.js"></script>
	<script type="text/javascript" src="colorpicker/js/colorpicker.js"></script>
    	<script type="text/javascript" src="encode.js"></script>
    <script type="text/javascript" src="colorpicker/js/eye.js"></script>
    <script type="text/javascript" src="colorpicker/js/layout.js?ver=1.0.2"></script>
    <script language="javascript" src="JS.js"></script>
<link href="product_detail.css" rel="stylesheet" type="text/css">
<?php
include("../js_v2/fckeditor.php") ;
$fcke_width = 700;
$fcke_height = 400;
$arr_product_fieldname = Array("Key","JB No","Model","Type","Thinkness(mm)","Volume (lit.)","Load Capacity (kg)","Static Load","Dynamic Load","Racking Load","Standard Lift  (m)","Dimension WxDxH (mm)","Platform   (mm)","Distance Between Platforms H1 (mm)",
"Height  (mm) (note) ie. Bag","Footplate (mm)","Wheel Dia.(mm)","Thread Stem Wheel (mm)","Number of Parts Panels", "Horizontal","Vertical","AirPressure(kg / cm2)", "Delivery Pressure(kg / cm2)", "Colour","Set Content","Range (km)","Female(in.)" , "Male(in.)","Number of Sections", "Cutting Wire (mm)","SLOTTED (mm)","PHILLIPS(mm)","Number of Small Drawers","Number of Rollers", "Material","Qty./Pack","Price","Web Price","Additional description","Picture","Icon Service","Status","Categories","Create Date","Modify Date","Promote on Web","Products Detail (Thai)","Thumb Picture","Product Name","ข้อมูลสำหรับคำนวณค่าขนส่ง"	,"กว้าง(mm)","ยาว(mm)","สูง(mm)","ระยะขอบสูงขณะซ้อน(mm)","น้ำหนักสินค้า(kg)","จำนวนบรรจุกล่อง(ชิ้น)","รูปแบบการจัดเรียง","Products Detail (Eng)","หมายเหตุ");
$arr_status=Array('','Online','Thai','Eng','Offline');
$promotion_type=Array('คุณยังไม่ไดกำหนดค่ะ','Promotion Price','Spacial Price');
//$arr_remark=Array('','หมายเหตุ');


$cate_global = "";
$cate_global2 = "";
function Recall($id){
		include "includes/global.php";
		global $cate_global;
		$parent = getn("categories_parent","categories"," categories_id = $id ");		
		if ($parent) Recall($parent);
		$cate_global .= ",".$parent;
		return $cate_global;
}

function Recall2($id){
		include "includes/global.php";
		global $cate_global2;
		$parent = getn("categories_parent","categories"," categories_id = $id ");		
		if ($parent) Recall2($parent);
		$cate_global2 .= ",".$parent;
		return $cate_global2;
}

$thiscategories_d = $categories_id;
//echo getn("categories_name_th","categories","categories_id = ".$thiscategories_id);
$str = ReCall($thiscategories_id);  // at left.menu
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
	$categories_description_en = str_replace("\n","<br>",$categories['categories_description_en']);
	$categories_mainpic=$categories['categories_mainpic'];
	$categories_status=$categories['categories_status'];

	echo "<span class='top-link'><a href='products.php?cateparent=$categoriesparent&level=$i&thiscategories_id=$categories_id'>$categories_name_th</a></span> &gt; ";

	} // end if
}  // end for

function bformcreate()
{
			include "includes/global.php";
			global $arr_product_fieldname,$sBasePath,$fileaccept,$iconservice_path;
			global $fcke_width,$fcke_height;

			//if(!isset($categories_id)) $categories_id = getn("min(categories_id)","categories","categories_id > 0");

?>
<script language="JavaScript">
<!--
function checkvalues()
{
		 if (form1.jb_no.value=="")
		{
					alert(" Please Enter JB No .");
					form1.jb_no.focus();
					return false;
		 }	
		 form1.action="<?php  echo  "index.php?method=products&process=bcreate&level=$level&cate_id=$categories_id" ;?>";
		 form1.submit();
}




-->
</script>
<!-- Start form Create products -->
<form name="form1" method="post" enctype="multipart/form-data">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class="Type_A">
          <tr class="head_noline">
            <td height="25" colspan="2">&nbsp;&nbsp;<strong>Create Products</strong><font size="1" color="red"> &nbsp;&nbsp;[ **** Please use single quote(') replace double quote(") ]</font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Categories&nbsp; :&nbsp;&nbsp;</td>
            <td><? $strname = getn("categories_name_en","categories","categories_id = '$categories_id' ");
						  if ($strname) echo $strname; else echo "Not in Categories";
						  ?>
              <input name="categories_id" type="hidden"  size="100" value="<?=$categories_id?>">
              >>>
              <?=$categories_id?></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[48] ?>
              (Thai)&nbsp;&nbsp;: &nbsp;</td>
            <td><input name="products_name" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[48] ?>
              (Eng)
              &nbsp;&nbsp;: &nbsp;</td>
            <td><input name="products_name_en" type="text"  size="100" />
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[1] ?>
              &nbsp;&nbsp;: &nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="jb_no" type="text"  size="100">
              &nbsp;<font color='red'>*</font> </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[2] ?>
              &nbsp;
              : &nbsp;</td>
            <td><input name="model" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[3] ?>
              &nbsp;
              : &nbsp;</td>
            <td><input name="type" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[4] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="thinkness" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[5] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="volumn" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[6] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><table>
                <tr>
                  <td>
                <tr>
                  <td><?=$arr_product_fieldname[7] ?>
                    &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td><input name="staticcapacity" type="text"  size="100"></td>
                </tr>
                <tr>
                  <td><?=$arr_product_fieldname[8] ?>
                    &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td><input name="dynamiccapacity" type="text"  size="100"></td>
                </tr>
                <tr>
                  <td><?=$arr_product_fieldname[9] ?>
                    &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td><input name="rackingload" type="text"  size="100"></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[10] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="standardlift" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[11] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="dimension" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[12] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="platform" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[13] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="platformh1" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[14] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="height" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[15] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="footplate" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[16] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="wheeldia" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[17] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="threadstemwheel" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[18] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_partspanels" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[19] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="horizontal" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[20] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="vertical" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[21] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="airpressure" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[22] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="deliverypressure" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[23] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="colour" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[24] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="setcontent" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[25] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="range" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[26] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="female" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[27] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="male" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[28] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_sections" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[29] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="cuttingwire" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[30] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="slotted" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[31] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="phillips" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[32] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_smalldrawers" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[33] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_rollers" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[34] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="material" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[35] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="qtypack" type="text"  size="100">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc">กำหนดวันแสดงราคา &nbsp;
              : &nbsp;</td>
            <?php
							$d1 = date("Y-m-d");
					?>
            <td><input size='16'  id="datepicker"  name='startdate' value='<?=$d1?>' readonly="readonly" />
              <!-- <img  onclick="popUpCalendar(this,document.getElementById('startdate'), 'yyyy-mm-dd', fnSetDate);" src='../imgs/icon_carlenda.jpg' /> --> &nbsp;&nbsp;<font color='red'>(ปี-เดือน-วัน)*</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc">วันสิ้นสุดแสดงราคา &nbsp;
              : &nbsp;</td>
            <?php
							$d1 = date("Y-m-d");
					?>
            <td><input size='16'  id="datepicker2"  name='expdate' value='<?=$d1?>' readonly="readonly" />
              <!-- <img  onclick="popUpCalendar(this,document.getElementById('expdate'), 'yyyy-mm-dd', fnSetDate);" src='../imgs/icon_carlenda.jpg' /> --> &nbsp;&nbsp;<font color='red'>(ปี-เดือน-วัน)*</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[36] ?>
              &nbsp;
              : &nbsp;</td>
            <td><input name="price" type="text"  size="22">
            </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[37] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="discountprice" type="text"  size="22"> 
              &nbsp; <select name="products_promotion">
                <option value="0" selected="selected"> "--โปรดเลือกโปร--" </option>
                <option value="1"> Promotion Price </option>
                <option value="2"> Spacial Price </option>
              </select> <font color='red'>*</font></td>
                            
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[46] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><textarea name="p_detail_th" rows="5"  cols="100"></textarea>
              <br>
              <font color='red'>* พิมพ์ &lt;br&gt; แทนการกด enter เพื่อขึ้นบรรทัดใหม่</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[57] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><textarea name="p_detail_en" rows="5"  cols="100"></textarea>
              <br>
              <font color='red'>* พิมพ์ &lt;br&gt; แทนการกด enter เพื่อขึ้นบรรทัดใหม่</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[38] ?>
              &nbsp;
              : &nbsp;</td>
            <td><?php
					
					// Automatically calculates the editor base path based on the _samples directory.
					// This is usefull only for these samples. A real application should use something like this:
					// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
					//$sBasePath = $_SERVER['PHP_SELF'] ;echo $sBasePath;					
					//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "backend" ) ) ;

					$oFCKeditor = new FCKeditor('description') ;
					$oFCKeditor->BasePath	= $sBasePath ;
					$oFCKeditor->Height= $fcke_height ;
					$oFCKeditor->Width= $fcke_width ;
					$oFCKeditor->Value		= '' ;
					$oFCKeditor->Create() ;
		//echo  $sql;
		$query = $db->sql_query($sql);
		$products_id = 999999;
			$delete_sql = sql_delete($prefix."_columns", "pro_id = '$products_id'");
			$db->sql_query($delete_sql);
			
			$delete_sql = sql_delete($prefix."_detail", "pro_id = '$products_id'");
			$db->sql_query($delete_sql);
			 
			$delete_sql = sql_delete($prefix."_detail_status", "pro_id = '$products_id'");
			$db->sql_query($delete_sql);
			
			$delete_sql = sql_delete($prefix."_merge", "pro_id = '$products_id'");
			$db->sql_query($delete_sql);
			
			$delete_sql = sql_delete($prefix."_detail_status", "pro_id = '$products_id'");
			$db->sql_query($delete_sql);


		$sql = sql_Select("detail", $prefix."_detail_status_category", "cat_id = '$categories_id' and status = 'prop' ", 0);
			//$sss = $sql ;
				$query = $db->sql_query($sql);
				$per = $db->sql_fetchrow($query);
                $prop = $per["detail"]; 
				if(trim($prop)=="")$prop = 1;
				$i==1;
			while($i<=$prop){
			$sql = sql_Select("id,columns,properties$i",$prefix."_columns_category","cat_id = $categories_id",0);
			//$sss = $sql ;
			$query = $db->sql_query($sql);
			while($re = $db->sql_fetchrow($query)){
					
			$sum_col .=$re["columns"] . "," ;

			$sum_prop .= "'" . $re["properties$i"] . "'," ;
			}
	if(!trim($sum_col)==""){
	$sql = sql_insert($prefix."_detail","$sum_col pro_id","$sum_prop  $products_id");
			
	
	$db->sql_query($sql);$sum_prop="";$sum_col="";}
			$i++;}

			


			$sql = sql_Select("id,seq,columns,column_name,sub",$prefix."_columns_category","cat_id = $categories_id",0);
			$query = $db->sql_query($sql);
			if($db->sql_numrows($query)){
				while($re = $db->sql_fetchrow($query)){
					$cat_id = $re["id"];
					$seq = $re["seq"];
					$columns = $re["columns"];
					$column_name = $re["column_name"];
					$sub = $re["sub"];

					$sql = sql_insert($prefix."_columns","pro_id,seq,columns,column_name,sub","$products_id,$seq,'$columns','$column_name','$sub'");
		
		$db->sql_query($sql);

		$sql = sql_Select("path", $prefix."_col_img_category", "col_id = $cat_id",0);
		//echo $sql;
			$img_query = $db->sql_query($sql);
			if($db->sql_numrows($img_query)){
				while($re_img = $db->sql_fetchrow($img_query)){
			$sql = sql_Select("max(id) id", $prefix."_columns", "pro_id = $products_id",0);
			$max_query = $db->sql_query($sql);
			$re_max = $db->sql_fetchrow($max_query);
			$max = $re_max["id"];
			$path = $re_img["path"];
			$sql = sql_insert($prefix."_col_img","col_id,path","'$max','$path'");
			
			$db->sql_query($sql);
				}
			}
	
				}
			}
			
			
			$sql = sql_Select("detail,status",$prefix."_detail_status_category","cat_id = $categories_id ",0);
			$query = $db->sql_query($sql);
			while($re = $db->sql_fetchrow($query)){
			$detail = $re["detail"];
			$status = $re["status"];
			$sql = sql_insert($prefix."_detail_status","pro_id,status,detail","$products_id,'$status','$detail'");
			$db->sql_query($sql);
			}
			
				?>
              <BR>
              <font color='red'><?=$sss?>* New Line press Shift+Enter *</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[49] ?>
              &nbsp;
              : &nbsp;</td>
            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><input name="cal_w" type="text"  size="15"></td>
                  <td><input name="cal_h" type="text"  size="15"></td>
                  <td><input name="cal_t" type="text"  size="15"></td>
                  <td><input name="cal_b" type="text"  size="15"></td>
                  <td><input name="cal_weight" type="text"  size="15"></td>
                  <td><input name="cal_p" type="text"  size="15"></td>
                </tr>
                <tr>
                  <td><?=$arr_product_fieldname[50] ?></td>
                  <td><?=$arr_product_fieldname[51] ?></td>
                  <td><?=$arr_product_fieldname[52] ?></td>
                  <td><?=$arr_product_fieldname[53] ?></td>
                  <td><?=$arr_product_fieldname[54] ?></td>
                  <td><?=$arr_product_fieldname[55] ?></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[56] ?>
              : &nbsp;</td>
            <td><select name="cal_method">
                <option value="0">โปรดเลือก
                <?=$arr_product_fieldname[56]?>
                </option>
                <? $sql_method = sql_Select(1,$prefix."_method",1,0);
			  $query_method = $db->sql_query($sql_method);
			  while($rs_m=$db->sql_fetchrow($query_method))
			  {
			  	$method_id = $rs_m['method_id'];
				$method_name = $rs_m['method_name'];
			?>
                <option value="<?=$method_id?>" >
                <?=$method_name?>
                </option>
                <?	
			  }
			  ?>
              </select></td>
          </tr>
          <tr> 
                 <td height="26" class="td_desc">Table View
			: &nbsp;</td>
			  <td>
              <? $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'view' ", 0);
			//echo $sql ;
			$query = $db->sql_query($sql);
			$fview= $db->sql_fetchrow($query);
			$view = $fview["detail"];
			if(trim($view)==""){$view=="l";}
			?>
     <div id="view">              
     <input name="vertical" type="radio" value="" <? if(trim($view) == 'l') echo "checked='checked'";?>  onclick="Javascript:edit_view('<?=$admin?>',<?=$products_id?>,'l')"/> Landscape
     <input name="vertical" type="radio" value=""
     <? if(trim($view) == 'v'){echo "checked='checked'";}?> onclick="Javascript:edit_view('<?=$admin?>',<?=$products_id?>,'v')"/> Vertical

              </div>
              </td>
			</tr>
            <tr>
          <td height="26" class="td_desc">Color Table description: &nbsp;</td>
			  <td><div id="color">
              <?
              $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'color' ", 0);
			//echo $sql ;
				$query = $db->sql_query($sql);
				$fcolor = $db->sql_fetchrow($query);
                $color = $fcolor["detail"];
			  ?>
              <input type="text" maxlength="6" size="6" id="colorpickerField1" value="<?=$color?>"/><input type="button" style="margin-left:10px; background:url(colorpicker/download.png) 1px no-repeat; cursor:pointer; width:20px;" onclick="javascript:sadd_col('<?=$admin?>','color',<?=$products_id?>)"></div></td>
			</tr>
             <tr>
          <td height="26" class="td_desc">Color Font description: &nbsp;</td>
			  <td><div id="color_font">
              <?
              $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'font' ", 0);
			//echo $sql ;
				$query = $db->sql_query($sql);
				$fcolor = $db->sql_fetchrow($query);
                $font = $fcolor["detail"]; ?>
              <input type="text" maxlength="6" size="6" id="colorpickerField2" value="<?=$font?>"/><input type="button" style="margin-left:10px; background:url(colorpicker/download.png) 1px no-repeat; cursor:pointer; width:20px;" onclick="javascript:sadd_col('<?=$admin?>','font',<?=$products_id?>)"></div></td>
			</tr>
          <tr>
          <td height="26" class="td_desc">Rows Properties: &nbsp;</td>
			  <td><div id="prop">
              <?
              $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'prop' ", 0);
			//echo $sql ;
				$query = $db->sql_query($sql);
				$per = $db->sql_fetchrow($query);
                $prop = $per["detail"]; 
				if(trim($prop)=="")$prop = 1; ?>
              <select id="prop_value" >
              <option value="1" <? if($prop==1)echo "selected='selected'";?> >1</option>
              <option value="2"<? if($prop==2)echo "selected='selected'";?>>2</option>
              <option value="3"<? if($prop==3)echo "selected='selected'";?>>3</option>
              <option value="4"<? if($prop==4)echo "selected='selected'";?>>4</option>
              <option value="5"<? if($prop==5)echo "selected='selected'";?>>5</option>
              </select>
              <input type="button" style="margin-left:10px; background:url(colorpicker/download.png) 1px no-repeat; cursor:pointer; width:20px;" onclick="javascript:sadd_col('<?=$admin?>','prop',<?=$products_id?>)"></div></td>
			</tr>
                   <tr>
                 <td height="80" class="td_desc" valign="top">Additional description&nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td>
            
            <div id="addition">
<table cellpadding="0" cellspacing="0">
        <tr>
	<? $array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U');	
			$detail_sql = sql_Select("id,(select COUNT(id) from jenbunjerd_columns s where s.sub = c.columns and s.pro_id = c.pro_id) col", $prefix."_columns c", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql;
			$detail_query = $db->sql_query($detail_sql);
			$i=1;
			while ($categories= $db->sql_fetchrow($detail_query)){?>
            <td style="background-color:#999;" colspan="<?=$categories["col"]?>" align="center">
            <? 
			$sql = sql_Select("path", $prefix."_col_img", "col_id = ".$categories["id"], "path");
			$query_img = $db->sql_query($sql);
			$img = $db->sql_fetchrow($query_img);
			if($db->sql_numrows($query_img)){ ?>
            <img src="col_img/<?=$img["path"]?>">
            <? } ?>
            </td>
            <? $i++;} ?>
            <td style="min-width:0px;background-color:#999;"></td>
            </tr>
            <tr>
            <? 
			$detail_sql = sql_Select("id,column_name,columns,(select COUNT(id) from jenbunjerd_columns s where s.sub = c.columns and s.pro_id = c.pro_id) col", $prefix."_columns c", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql ;
			$detail_query = $db->sql_query($detail_sql);
$i=1;
while ($categories= $db->sql_fetchrow($detail_query)){?>
            <td class="h" colspan="<?=$categories["col"]?>" align="center">
            <div  class="h_col"><span id="col<?=$categories["id"]?>" ondblclick="edit_col('<?=$admin?>','editc',<?=$categories["id"]?>,'<?=htmlspecialchars($categories["column_name"])?>')">

			<?=$categories["column_name"]?>&nbsp;
            </span>
    <div class="control_h">
    <ul>
    <li><a href="javascript:insert_col('<?=$admin?>','insert',<?=$products_id?>,<?=$i?>)"><img src="add.png"> Add Column</a></li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))insert_col('<?=$admin?>','del','<?=$products_id?>','<?=$i?>',<?=$categories["id"]?>)"><img src="del.png"> Delete Column</a></li>
    <li><a href="javascript:open_pop_img('<?=$admin?>',<?=$categories["id"]?>,'<?=$products_id?>')"><img src="image.png">Add Image</a></li>
       <li><a href="javascript:open_pop('<?=$admin?>',<?=$categories["id"]?>)"><img src="sub.png"> Add Sub</a></li>
       <li><a href="javascript:open_pop_align('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="align.png">Align</a></li>
    </ul>
  </div>

    </div>
            </td>
            <? $i++;} ?>
            <td class="h" style="min-width:0px;">
             <input type="button" name="add_col" value="+" class="action" onclick="javascript:sadd_col('<?=$admin?>','add',<?=$products_id?>)"></td>
            </tr>
            <? 
			$sql = sql_Select("id", $prefix."_columns", " pro_id = $products_id and sub <> '' ", "id");
			$query_img = $db->sql_query($sql);
			$img = $db->sql_fetchrow($query_img);
			if($db->sql_numrows($query_img)){ ?>
            <tr>
            <? 
			$detail_sql = sql_Select("columns", $prefix."_columns", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql ;
			$detail_query = $db->sql_query($detail_sql);
while ($result = $db->sql_fetchrow($detail_query)){?>
		<?	$sql = sql_Select("id,column_name,sub", $prefix."_columns", "pro_id = '$products_id' and sub = '" . $result["columns"] . "' ", "seq");
			//echo  $detail_sql ;
			$sub_query = $db->sql_query($sql);
		if($db->sql_numrows($sub_query)){
			$i = 1;
			while ($re_sub = $db->sql_fetchrow($sub_query)){?>
            <td class="h" align="center">
            <div  class="h_sub"><span id="col<?=$re_sub["id"]?>" ondblclick="edit_col('<?=$admin?>','editc',<?=$re_sub["id"]?>,'<?=htmlspecialchars($re_sub["column_name"])?>')">
			<?=$re_sub["column_name"]?>&nbsp;
            </span>
    <div class="control_sub">
    <ul>
    <li><a href="javascript:if(confirm('Do you want to delete?'))insert_col('<?=$admin?>','dels','<?=$products_id?>','<?=$i?>',<?=$re_sub["id"]?>,'<?=$re_sub["sub"]?>')"><img src="del.png"> Delete Column</a></li>
    <li><a href="javascript:open_pop_align('<?=$admin?>',<?=$re_sub["id"]?>,<?=$products_id?>);"><img src="align.png">Align</a></li>
    </ul>
  </div>
    </div>
            </td>
            <? $i++;}
			}else{ ?>
			 <td class="h">&nbsp;
            </td>
		  <?
			} 
				} ?>
            <td class="h">&nbsp;</td>
            </tr>
            <? } ?>
            
             <? $detail_sql = sql_Select(1, $prefix."_detail", "pro_id = '$products_id'","id");
			//echo  $detail_sql ;
			$sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'prop'",0);
			$prop_query = $db->sql_query($sql);
			$prop= $db->sql_fetchrow($prop_query);
			$prop_val = $prop["detail"];
			if(trim($prop_val)=="")$prop_val=1;
			$j=1;
			$merge = 1;
			$detail_query = $db->sql_query($detail_sql);
			//$rows_last = $db->sql_numrows($detail_query);
	while ($categories= $db->sql_fetchrow($detail_query)){ ?>
     <tr  <? if($j<=$prop_val){
			if(!trim($color)==""){
				if(!trim($color)==""){
				$tcolor = "background-color:#$color;";}
				if(!trim($font)==""){
				$tfont = "color:#$font";}
				?>
                style="height:30px;<?=$tcolor?><?=$tfont?>"
                <?
			}else{
				 echo"class='hd2'";
				 if(!trim($font)==""){
				echo "style='color:#$font'";}
				}
			  }else{if($j%2){ echo "class='r1'";}else{echo "class='r2'";}}?>>
     <?
        $sql_sub = sql_Select("id,columns", $prefix."_columns", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql ;
			$query_sub = $db->sql_query($sql_sub);
			$i=1;
while ($sub= $db->sql_fetchrow($query_sub)){
		$sql = sql_Select("columns", $prefix."_columns", "pro_id = $products_id and sub = '" . $sub["columns"] . "' ", "seq");
			//echo $sql;
			$sub_query = $db->sql_query($sql);
		if($db->sql_numrows($sub_query)){
		while ($re_sub = $db->sql_fetchrow($sub_query)){

	$sql = sql_Select("amount,rows", $prefix."_merge", "pro_id = $products_id and columns = '" . $re_sub["columns"] . "' and rows <= $j and  (rows+amount) > $j", 0);
		//echo $sql;
		$merge_query = $db->sql_query($sql);
		if($db->sql_numrows($merge_query)){
		$re_merge = $db->sql_fetchrow($merge_query);
		$amount_merge = $re_merge["amount"];
		$rows_merge = $re_merge["rows"];
		
		if($rows_merge==$j){
		?>
       <td class="d" <? 
	   if($j>$prop_val){	  
			$sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $re_sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		//echo $sql;
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($re_sub["status"]=="c"){
		   echo "align='center'";
		}else if($re_sub["status"]=="l"){
			echo "align='left'";
		}else if($re_sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}?> <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";} }else{ echo "align='center'";}?> 
       rowspan="<?=$amount_merge?>" >
       <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$re_sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li><a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="merge.png">merge row</a></li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
        <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
    <li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div>
  </td>
  <? }else if(($amount_merge+$rows_merge)>$j){
     echo "";}
		}else{?>
   <td class="d" <? if($j>$prop_val){ $sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $re_sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		//echo $sql;
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($re_sub["status"]=="c"){
		   echo "align='center'";
		}else if($re_sub["status"]=="l"){
			echo "align='left'";
		}else if($re_sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}?>
   <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";}}else{ echo "align='center'";} ?>>
            <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$re_sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li><a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="merge.png">merge row</a></li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
    <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
	<li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div></td>
   <? } 
		}
			 }else{ 
		$sql = sql_Select("amount,rows", $prefix."_merge", "pro_id = $products_id and columns = '" . $sub["columns"] . "' and rows <= $j and  (rows+amount) > $j", 0);
		//echo $sql;
		$merge_query = $db->sql_query($sql);
		if($db->sql_numrows($merge_query)){
		$re_merge = $db->sql_fetchrow($merge_query);
		$amount_merge = $re_merge["amount"];
		$rows_merge = $re_merge["rows"];
		//echo $sql;
		if($rows_merge==$j){?>
		<td class="d" <? if($j>$prop_val){ $sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		//echo $sql;
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($sub["status"]=="c"){
		   echo "align='center'";
		}else if($sub["status"]=="l"){
			echo "align='left'";
		}else if($sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}?> 
        <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";}}else{ echo "align='center'";} ?>
        rowspan="<?=$amount_merge?>">
            <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li>
    <a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="merge.png"> merge row</a>
    </li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
        <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
	<li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div></td>
			<? }else if(($amount_merge+$rows_merge)>$j){
             echo "";
			}
		
			}else{?>
			 <td class="d" <? if($j>$prop_val){ $sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		//echo $sql;
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($sub["status"]=="c"){
		   echo "align='center'";
		}else if($sub["status"]=="l"){
			echo "align='left'";
		}else if($sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}?> 
             <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";}}else{ echo "align='center'";} ?>
             >
            <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li>
    <a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="merge.png"> merge row</a>
    </li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
    <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
	<li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div>
            </td>	
			<? }
			 } ?>
            <? $i++; }?>
            <td class="d" style="min-width:0px;">
            <input type="button" name="del_row" value="-" class="action" onclick="javascript:if(confirm('Do you want to delete?')){add_row('<?=$admin?>','del',<?=$products_id?>,<?=$categories["id"]?>);}">
            </td>
            </tr>
			<? $j++;} ?>
            <tr>
        <? $detail_sql = sql_Select(1, $prefix."_columns", "pro_id = '$products_id' and (sub is null or sub = '') ", 0);
		//echo  $detail_sql;
		$detail_query = $db->sql_query($detail_sql);
while ($categories= $db->sql_fetchrow($detail_query)){
		$sql = sql_Select("columns", $prefix."_columns", "sub = '" . $categories["columns"] . "' and pro_id = '$products_id'", "seq");
			//echo  $sql ;
			$sub_query = $db->sql_query($sql);
		if($db->sql_numrows($sub_query)){
			while ($re_sub = $db->sql_fetchrow($sub_query)){ ?>
            <td class="d">
   <input name="row[]" value="" onkeypress="javascript:if(event.keyCode == 13){add_row('<?=$admin?>','add',<?=$products_id?>);}">
            </td>
            <? } }else{ ?>
            <td class="d">
            <input name="row[]" value="" onkeypress="javascript:if(event.keyCode == 13){add_row('<?=$admin?>','add',<?=$products_id?>);}">
            </td>
             <? } }?>
            <td class="d" style="min-width:0px;">&nbsp;</td>
            </tr>
            </table>
             </div>
            </td>
        </tr>
        <tr>
                 <td height="80" class="td_desc" valign="top">HTML Codes Characters&nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td>
            <input id="symbol" value="">
            <table width="100%" class="symbol">
            <tr>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iexcl;</td>


            <td onclick="javascript:encodehtml(this.innerHTML)">&cent;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&pound;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&curren;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&yen;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&brvbar;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&sect;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&uml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&copy;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ordf;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&laquo;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&not;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&reg;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&macr;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&deg;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&plusmn;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&sup2;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&sup3;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&acute;</td>
           <td onclick="javascript:encodehtml(this.innerHTML)">&micro;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&para;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&middot;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&cedil;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ordm;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&raquo;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac14;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac12;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac12;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac34;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iquest;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Agrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Aacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Acirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Atilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Auml;</td>

            </tr>
            <tr>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Aring;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&AElig;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ccedil;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Egrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Eacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ecirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Euml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Igrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Iacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Icirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Iuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ETH;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ntilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ograve;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Oacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ocirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Otilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ouml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Oslash;</td>
           <td onclick="javascript:encodehtml(this.innerHTML)">&Ugrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Uacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ucirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Uuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Yacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&THORN;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&szlig;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&agrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&aacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&acirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&atilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&auml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&aring;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&aelig;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ccedil;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&egrave;</td>

            </tr>            <tr>
            <td onclick="javascript:encodehtml(this.innerHTML)">&eacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ecirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&euml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&igrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&icirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&eth;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ntilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ograve;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&oacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ocirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&otilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ouml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&divide;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&oslash;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ugrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&uacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ucirc;</td>
           <td onclick="javascript:encodehtml(this.innerHTML)">&uuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&yacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&thorn;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&yuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&lt;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&gt;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&le;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ge;</td>
            </tr>
            </table>
            </td>

            </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[39] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="spicture" type="file"  size="60">
              &nbsp;<font color='red'>* For Show List Products</font> <BR>
              สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?="Picture1"?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="spicture1" type="file"  size="60">
              &nbsp;<font color='red'>* For Show List Products</font> <BR>
              สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?="Picture2" ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="spicture2" type="file"  size="60">
              &nbsp;<font color='red'>* For Show List Products</font> <BR>
              สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?="Picture3" ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="spicture3" type="file"  size="60">
              &nbsp;<font color='red'>* For Show List Products</font> <BR>
              สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </font></td>
          </tr>
          <!------------------------------>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[47] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="tpicture" type="file"  size="60">
              &nbsp;<font color='red'>* For Show List Products</font> <BR>
              สัดส่วนของรูปภาพที่ดีที่สุด 100px x 100px (กว้าง x ยาว) </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?="Drawing Picture"?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="dpicture" type="file"  size="60" />
              &nbsp;<font color='red'>* For Show List Products</font> <br />
              สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว) </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?="Drawing2 Picture" ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="d2picture" type="file" id="d2picture"  size="60" />
              &nbsp;<font color='red'>* For Show List Products</font> <br />
              สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว) </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?="Logo Brand" ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <input name="logopicture" type="file" id="logopicture"  size="60" />
              &nbsp;<font color='red'>* For Show List Products</font> <br />
              สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว) </font></td>
          </tr>
          <tr style="display:none">
            <td width="125" height="26" valign="top"><div align="right" style="padding:7px"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">Picture&nbsp;:&nbsp;</font></div></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <?php for($cnt=1;$cnt<=2;$cnt++){ ?>
                <tr height="29">
                  <td><input  type="file" name="picture[<?php echo $cnt;?>]" size="60">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 100px x 100px (กว้าง x ยาว) 
                </tr>
                <?php        } // ??? For ?>
              </table></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[40] ?>
              : &nbsp;</td>
            <td><Div class='Div_Config'>
                <?php
							$iconservice_sql = sql_Select(1, $prefix."_iconservice",1, "iconservice_name");
							//echo $iconservice_sql ;
						
							$iconservice_query = $db->sql_query($iconservice_sql);
							$iconservice_rec = $db->sql_numrows($iconservice_query);
							
							if ($iconservice_rec > 0) { // gen tbl
										echo "<table cellspacing=\"3\" cellpadding=\"3\" border=\"0\" width=\"100%\">";
										$count = 3;$start=1;
										$wid = ceil(99/$count) ;
										while ($iconservice = $db->sql_fetchrow($iconservice_query))
										{												
												$iconservice_id = $iconservice['iconservice_id'];
												$iconservice_name = $iconservice['iconservice_name'];
												$iconservice_pic1 = $iconservice['iconservice_pic1'];
												$iconservice_status = $iconservice['iconservice_status'];

												$iconservice_name = trim($iconservice_name);
												if ( $start == 1) echo "<tr height=\"26\">";
												echo "<td width = \"$wid%\" valign='bottom'><input type=\"checkbox\" name=\"iconservice[]\"  value=\"$iconservice_id\">&nbsp;&nbsp;<img src='$iconservice_path/$iconservice_pic1' width='25' height='25' border='0'></td>";
												$start++;
												if ( $start > $count ) {
													$start =1;													
												}
										}

										if ($start > 1){
											if ($start != $count ){
												while( $start <= $count){
													echo "<td  width = \"$wid%\">&nbsp;</td>";
													$start++;
												}								
											}
										}
										echo "</tr></table>";
							}
							else
										echo " - ";							
				   ?>
              </Div></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Accessories : </td>
            <td><input name="chkacc" type="checkbox" id="chkacc" value="1" /></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Keyword : </td>
            <td><input name="keyword" type="text" id="keyword" size="50" /></td>
          </tr>
            <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[58]  ?>
              : &nbsp;</td>
            <td><input name="remark" type="text" id="remark" size="50" /></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[41] ?>
              : &nbsp;</td>
            <td><select name="active">
                <option value="1" selected="selected">Online</option>
                <option value="2">Thai</option>
                <option value="3">Eng</option>
                <option value="4">Offline</option>
              </select></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[45] ?>
              : &nbsp;</td>
            <td><select name="promote">
                <option value="1" selected="selected">Online</option>
                <option value="2">Thai</option>
                <option value="3">Eng</option>
                <option value="4">Offline</option>
              </select></td>
          </tr>
          <tr>
            <td height="18"align="right">&nbsp;</td>
            <td><input type="button"  value="    OK    " onMouseOver="onBtnOver(this,'<?=$theme_tab1?>')";  onMouseOut="onBtnOut(this)" onclick="javascript:checkvalues();">
              &nbsp;
              <input name="reset" type="reset" id="reset" value="  Reset  " onMouseOver="onBtnOver(this,'<?=$theme_tab1?>')";  onMouseOut="onBtnOut(this)">
            </td>
          </tr>
          <tr>
            <td height="25" colspan="2" class="td_linkactive"><strong>&nbsp;&nbsp;Link 
              Action &gt; <a href="index.php?method=products&process=blist&cate_id=<?=$cate_id?>&collection_id=<?=$collection_id?>">List Products </a></strong></td>
          </tr>
          <tr>
            <td height="10">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>

<?php

}

function badd()
{
			
				include "includes/global.php";

				global $products_path,$fileaccept;

				extract($_POST);


				$iconservice =get_var('iconservice','request',0);
				$chkacc =get_var('chkacc','request',0);
				$chkpromote =get_var('chkpromote','request',0);
				$products_name =addslashes(get_var('products_name','request',0));
				//$products_name_en =addslashes(get_var('products_name_en','request',0));
				$keyword= addslashes($keyword);
				$categories_id = $categories_id;
				$jb_no= addslashes($jb_no);
				$model= addslashes($model);
				$type= addslashes($type);
				$thinkness= addslashes($thinkness);
				$volumn= addslashes($volumn);
				//$loadcapacity= addslashes($loadcapacity);
				$staticcapacity= addslashes($staticcapacity);
				$dynamiccapacity= addslashes($dynamiccapacity);
				$rackingload= addslashes($rackingload);
				$standardlift= addslashes($standardlift);
				$dimension= addslashes($dimension);
				$platform= addslashes($platform);
				$platformh1= addslashes($platformh1);
				$height= addslashes($height);
				$footplate= addslashes($footplate);
				$wheeldia= addslashes($wheeldia);
				$threadstemwheel= addslashes($threadstemwheel);
				$n_partspanels= addslashes($n_partspanels);
				$horizontal= addslashes($horizontal);
				$vertical= addslashes($vertical);
				$airpressure= addslashes($airpressure);
				$deliverypressure= addslashes($deliverypressure);
				$colour= addslashes($colour);
				$setcontent= addslashes($setcontent);
				$range= addslashes($range);
				$female= addslashes($female);
				$male= addslashes($male);
				$n_sections= addslashes($n_sections);
				$cuttingwire= addslashes($cuttingwire);
				$slotted= addslashes($slotted);
				$phillips= addslashes($phillips);
				$n_smalldrawers= addslashes($n_smalldrawers);
				$n_rollers= addslashes($n_rollers);
				$material= addslashes($material);
				$qtypack= addslashes($qtypack);
				$price= addslashes($price);
				$discountprice= addslashes($discountprice);
                $products_promotion =($products_promotion);
				$products_remark=($remark);
				$description =get_var('description','request',0);
				$p_detail_th =get_var('p_detail_th','request',0);
				$p_detail_en =get_var('p_detail_en','request',0);
				if ($cal_method =="") $cal_method = 0;  
				if ($cal_w =="" ) $cal_w = 0;  
				if ($cal_h =="" ) $cal_h = 0;  
				if ($cal_t =="") $cal_t = 0;  
				if ($cal_b =="") $cal_b = 0;  
				if ($cal_p =="" ) $cal_p = 0;  
				if ($cal_weight =="" ) $cal_weight = 0;  

				//////////////////////////////////////////////////////////////////////
				$str_iconservice ="-";  //manage db
				foreach ( $iconservice as $j => $dat){
						$str_iconservice = $str_iconservice."$dat-";
				}
				//////////////////////////////////////////////////////////////////////
				
				//$pic_default =get_var('pic_default','request',0);	

				$check_sql=sql_Select(1,$prefix."_products","products_jb_no = '$jb_no' ",0);
				//echo $admin_sql;   
				$pname_query=$db->sql_query($check_sql);
				$row = $db->sql_fetchrow($pname_query);	
				$pname_num=$db->sql_numrows($pname_query);

				//echo $accessories_num;
				if ( $pname_num > 0 ){
						$msg = "<font color=red><B>ERROR !!</B> This Name was in Database </font>";
						$loc = "index.php?method=products&process=list&level=$level&categories_id=$categories_id&msg=$msg";
						//echo $loc;
						echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
						exit();
				}
		
				$products_sql = sql_insert($prefix."_products","products_name,products_name_en,products_model,products_jb_no,products_type,products_thinkness,products_volume,products_capacity_static,products_capacity_dynamic,products_capacity_racking,products_standard_lift,products_dimension,products_platform,products_platform_h1,products_height,products_footplate,products_wheeldia,products_threadstemwheel,products_numberofpartspanels,products_horizontal,products_vertical,products_airpressure,products_deliverypressure,products_colour,products_setcontent,products_range,products_female,products_male,products_numberofsection,products_cuttingwire,products_slotted,products_phillips,products_small_drawers,products_rollers,products_material,products_qtypack,products_price,products_discountprice,products_description,products_mainpic,products_status,categories_id,products_create,products_modify,products_promote,products_icon,products_detail,products_detail_en,products_thumbpic,products_cal_method, products_cal_w,products_cal_h , products_cal_t, products_cal_b,products_cal_p,products_cal_weight,products_delete,products_delete_date,products_accessories,products_keyword,products_mainpic1,products_mainpic2,products_mainpic3,promotion_start_date,promotion_end_date,products_promotion,products_remark",			"'$products_name','$products_name_en','$model','$jb_no','$type','$thinkness','$volumn','$staticcapacity','$dynamiccapacity','$rackingload','$standardlift','$dimension','$platform','$platformh1','$height','$footplate','$wheeldia','$threadstemwheel','$n_partspanels','$horizontal','$vertical','$airpressure','$deliverypressure','$colour','$setcontent','$range','$female','$male','$n_sections','$cuttingwire','$slotted','$phillips','$n_smalldrawers','$n_rollers','$material','$qtypack','$price','$discountprice','$description','','$active','$cate_id',NOW(),NOW(),'$promote','$str_iconservice','$p_detail_th','$p_detail_en','' ,'$cal_method',	'$cal_w','$cal_h','$cal_t','$cal_b',	'$cal_p',	'$cal_weight','0','0000000','$chkacc','$keyword','$products_mainpic1','$products_mainpic2','$products_mainpic3','$startdate','$expdate','$products_promotion','$products_remark'");
				//echo $products_sql."<br>";	 exit;
				$save_query = $db->sql_query($products_sql);
				$save_id = $db->sql_nextid();

				$dir = "data-file";
				 if (!file_exists($dir)){
					 mkdir($dir);
					 chmod("$dir", 0777);
				 }
				
				$dir1 = "data-file/products";
				if (!file_exists($dir1)){
					mkdir($dir1);
					chmod("$dir1", 0777);
				}
				
				$spicture_n =  get_File('spicture', 'name');
				$spicture_f =  get_File('spicture', 'tmp_name');				
				$spic_ext = get_extension($spicture_n);
				$smallpic  = "";

				if ($spic_ext) 
				{
							$smallpic = "production_".createRandom()."_".$save_id.".".$spic_ext;
															
							if ($spicture_f)
							{
									copy($spicture_f,"$products_path/$smallpic");
									//echo "<center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font> </center>";
									$str_smallpic = " products_mainpic = '$smallpic' ";
							}
							else{
									//echo " <center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_smallpic ",
										"products_id = '$save_id'  ");
				//echo $products_sql;	
				$save_query2 = $db->sql_query($products_sql);
		
				//=======================================
				$spicture_n1 =  get_File('spicture1', 'name');
				$spicture_f1 =  get_File('spicture1', 'tmp_name');				
				$spic_ext1 = get_extension($spicture_n1);
				$smallpic1  = "";

				if ($spic_ext1) 
				{
							$smallpic1 = "production_".createRandom()."_".$save_id.".".$spic_ext1;
															
							if ($spicture_f1)
							{
									copy($spicture_f1,"$products_path/$smallpic1");
									$str_smallpic1 = " products_mainpic1 = '$smallpic1' ";
							}
							else{
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_smallpic1 ",
										"products_id = '$save_id'  ");
	
				$save_query2 = $db->sql_query($products_sql);
				//========================================
				$spicture_n2 =  get_File('spicture2', 'name');
				$spicture_f2 =  get_File('spicture2', 'tmp_name');				
				$spic_ext2= get_extension($spicture_n2);
				$smallpic2  = "";

				if ($spic_ext2) 
				{
							$smallpic2 = "production_".createRandom()."_".$save_id.".".$spic_ext2;
															
							if ($spicture_f2)
							{
									copy($spicture_f2,"$products_path/$smallpic2");
									$str_smallpic2 = " products_mainpic2 = '$smallpic2' ";
							}
							else{
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_smallpic2 ",
										"products_id = '$save_id'  ");
	
				$save_query2 = $db->sql_query($products_sql);
				//====================================
				$spicture_n3 =  get_File('spicture3', 'name');
				$spicture_f3 =  get_File('spicture3', 'tmp_name');				
				$spic_ext3 = get_extension($spicture_n3);
				$smallpic3  = "";

				if ($spic_ext3) 
				{
							$smallpic3 = "production_".createRandom()."_".$save_id.".".$spic_ext3;
															
							if ($spicture_f3)
							{
									copy($spicture_f3,"$products_path/$smallpic3");
									$str_smallpic3 = " products_mainpic3 = '$smallpic3' ";
							}
							else{
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_smallpic3 ",
										"products_id = '$save_id'  ");
	
				$save_query2 = $db->sql_query($products_sql);
	   			//----------------------------------------
				$tpicture_n =  get_File('tpicture', 'name');
				$tpicture_f =  get_File('tpicture', 'tmp_name');				
				$tpic_ext = get_extension($tpicture_n);
				$tsmallpic  = "";

				if ($tpic_ext) 
				{
							$tsmallpic = "production_".createRandom()."_".$save_id."_thumb.".$tpic_ext;
															
							if ($tpicture_f)
							{
									copy($tpicture_f,"$products_path/$tsmallpic");
									echo "<center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font> </center>";
									$str_tsmallpic = " products_thumbpic = '$tsmallpic' ";
							}
							else{
									echo " <center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_tsmallpic ",
										"products_id = '$save_id'  ");
			//	echo $products_sql;	
				$save_query2 = $db->sql_query($products_sql);
				
				$dpicture_n =  get_File('dpicture', 'name');
				$dpicture_f =  get_File('dpicture', 'tmp_name');				
				$dpic_ext = get_extension($dpicture_n);
				$dsmallpic  = "";

				if ($dpic_ext) 
				{
							$dsmallpic = "production_".createRandom()."_".$save_id."_dimension.".$dpic_ext;
															
							if ($dpicture_f)
							{
									copy($dpicture_f,"$products_path/$dsmallpic");
									echo "<center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font> </center>";
									$str_dsmallpic = " products_picDrawing = '$dsmallpic' ";
							}
							else{
									echo " <center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_dsmallpic ",
										"products_id = '$save_id'  ");
			//	echo $products_sql;	
				$save_query2 = $db->sql_query($products_sql);
				
				//
				$d2picture_n =  get_File('d2picture', 'name');
				$d2picture_f =  get_File('d2picture', 'tmp_name');				
				$d2pic_ext = get_extension($d2picture_n);
				$d2smallpic  = "";

				if ($d2pic_ext) 
				{
							$d2smallpic = "production_".createRandom()."_".$save_id."_dimension2.".$d2pic_ext;
															
							if ($d2picture_f)
							{
									copy($d2picture_f,"$products_path/$d2smallpic");
									echo "<center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font> </center>";
									$str_d2smallpic = " products_picDrawing2 = '$d2smallpic' ";
							}
							else{
									echo " <center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_d2smallpic ",
										"products_id = '$save_id'  ");
			//	echo $products_sql;	
				$save_query2 = $db->sql_query($products_sql);
				
		
				$logopicture_n =  get_File('logopicture', 'name');
				$logopicture_f =  get_File('logopicture', 'tmp_name');				
				$logopic_ext = get_extension($logopicture_n);
				$logosmallpic  = "";

				if ($logopic_ext) 
				{
							$logosmallpic = "production_".createRandom()."_".$save_id."_logo.".$logopic_ext;
															
							if ($logopicture_f)
							{
									copy($logopicture_f,"$products_path/$logosmallpic");
									echo "<center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font> </center>";
									$str_logosmallpic = " products_logo = '$logosmallpic' ";
							}
							else{
									echo " <center><font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
							}
				}//end if ($spic_ext)
				$products_sql = sql_Update($prefix."_products", " $str_logosmallpic ",
										"products_id = '$save_id'  ");
			//	echo $products_sql;	
				$save_query2 = $db->sql_query($products_sql);
				
				if($save_query)
				{	
				$sql = sql_Update($prefix."_columns",
				"pro_id=$save_id","pro_id = 999999");
				//echo $sql;
				$db->sql_query($sql);
				
				$sql = sql_Update($prefix."_detail",
				"pro_id=$save_id","pro_id = 999999");
				//echo $sql;
				$db->sql_query($sql);
				
				$sql = sql_Update($prefix."_detail_status",
				"pro_id=$save_id","pro_id = 999999");
				//echo $sql;
				$db->sql_query($sql);
							$msg = "<font color=blue>SUCCESS !!</font> Insert Products on success.";
				}
				else
				{
						$msg = "<font color=red>ERROR !!</font> can not Insert  Products11 .";
						//$msg = "<br>".$db->mysql_error();
				}
			$loc = "index.php?method=products&process=list&level=$level&categories_id=$categories_id&msg=$msg";
			//echo "<br>".$loc;
			echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
}

function bdetail()
{
			include "includes/global.php";
			global $postfix_lang,$lang;
			global $products_path,$iconservice_path,$arr_product_fieldname;
			global $arr_status;
            global $promotion_type;
			global $arr_remark;
			$products_id = get_var('products_id','request',0);
			
			$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$products_id'", 0);
			//echo  $detail_sql ;
			$detail_query = $db->sql_query($detail_sql);
			$result = $db->sql_fetchrow($detail_query);			

			$products_id=$result['products_id'];
			$products_model=stripslashes($result['products_model']);
			$products_name=stripslashes($result['products_name']);
			$products_name_en=stripslashes($result['products_name_en']);
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
			$promotion_start_date=stripslashes($result['promotion_start_date']);
			$promotion_end_date=stripslashes($result['promotion_end_date']);
			$products_price=stripslashes($result['products_price']);
			$products_discountprice=stripslashes($result['products_discountprice']);
			$products_description=$result['products_description'];
            $products_promotion=$result['products_promotion'];
			//$products_description = str_replace("\n","<br>",$products_description);		
			$products_mainpic=$result['products_mainpic'];
			$products_mainpic1=$result['products_mainpic1'];
			$products_mainpic2=$result['products_mainpic2'];
			$products_mainpic3=$result['products_mainpic3'];
			/*---------------------------------------------------------------*/
			$products_mainpic=$result['products_mainpic'];
			$products_status=$result['products_status'];
			$categories_id=$result['categories_id'];
			$products_create=$result['products_create'];
			$products_modify=$result['products_modify'];
			$products_promote=$result['products_promote'];
			$products_icon=$result['products_icon'];
			$products_detail_th=$result['products_detail'];
			$products_detail_en=$result['products_detail_en'];
			$products_thumbpic=$result['products_thumbpic'];
			$products_cal_method=$result['products_cal_method'];
			$products_cal_w=$result['products_cal_w'];
			$products_cal_h=$result['products_cal_h'];
			$products_cal_t=$result['products_cal_t'];
			$products_cal_b=$result['products_cal_b'];
			$products_cal_p=$result['products_cal_p'];
			$products_cal_weight=$result['products_cal_weight'];
			$products_drawing=$result['products_picDrawing'];
			$products_drawing2=$result['products_picDrawing2'];
			$products_logo=$result['products_logo'];
			$products_accessories=$result['products_accessories'];
			$products_keyword=$result['products_keyword'];
			 $products_remark=$result['products_remark'];

?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="5" class="Type_A">
        <tr class="head_noline">
          <td height="25" colspan="2">&nbsp;&nbsp;<B>Detail Products</B> </td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[12] ?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=getn("categories_name_en","categories","categories_id = '$categories_id' ");?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[48]?>
            (Thai)&nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_name?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[48]?>
            (Eng)&nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_name_en?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[1]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_jb_no?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[2]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_model?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[3]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_type?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[4]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_thinkness?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[5]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_volume?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[6]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><table>
              <tr>
                <td><?=$arr_product_fieldname[7]?>
                  &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td><?=$products_capacity_static?></td>
              </tr>
              <tr>
                <td><?=$arr_product_fieldname[8]?>
                  &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td><?=$products_capacity_dynamic?></td>
              </tr>
              <tr>
                <td><?=$arr_product_fieldname[9]?>
                  &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                <td><?=$products_capacity_racking?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[10]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_standard_lift?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[11]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_dimension?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[12]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_platform?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[13]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_platform_h1?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[14]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_height?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[15]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_footplate?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[16]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_wheeldia?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[17]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_threadstemwheel?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[18]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_numberofpartspanels?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[19]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_horizontal?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[20]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_vertical?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[21]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_airpressure?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[22]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_deliverypressure?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[23]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_setcontent?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[24]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_colour?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[25]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_range?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[26]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_female?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[27]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_male?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[28]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_numberofsection?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[29]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_cuttingwire?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[30]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_slotted?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[31]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_phillips?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[32]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_small_drawers?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[33]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_rollers?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[34]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_material?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[35]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_qtypack?></td>
        </tr>
  <!--  <tr>
          <td height="26" class="td_desc">กำหนดวันแสดงราคา &nbsp;
            : &nbsp;</td>
          <td><?=$promotion_start_date?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">วันสิ้นสุดแสดงราคา &nbsp;
            : &nbsp;</td>
          <td><?=$promotion_end_date?></td>
        </tr> -->
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[36]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_price?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[37]?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_discountprice?> กำหนดราคานี้เป็น :<font color="red"> <?=$promotion_type[$products_promotion]?></font></td>
         <td></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[46] ?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_detail_th?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[57] ?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_detail_en?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[38] ?>
            &nbsp;&nbsp;:&nbsp;&nbsp;</td>
          <td><?=$products_description?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[49] ?>
            &nbsp;
            : &nbsp;</td>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td><?=$products_cal_w?></td>
                <td><?=$products_cal_h?></td>
                <td><?=$products_cal_t?></td>
                <td><?=$products_cal_b?></td>
                <td><?=$products_cal_weight?></td>
                <td><?=$products_cal_p?></td>
              </tr>
              <tr>
                <td><?=$arr_product_fieldname[50] ?></td>
                <td><?=$arr_product_fieldname[51] ?></td>
                <td><?=$arr_product_fieldname[52] ?></td>
                <td><?=$arr_product_fieldname[53] ?></td>
                <td><?=$arr_product_fieldname[54] ?></td>
                <td><?=$arr_product_fieldname[55] ?></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[56] ?>
            : &nbsp;</td>
          <td><select name="cal_method"  disabled="disabled">
              <option value="">โปรดเลือก
              <?=$arr_product_fieldname[56]?>
              </option>
              <? $sql_method = sql_Select(1,$prefix."_method",1,0);
			  $query_method = $db->sql_query($sql_method);
			  while($rs_m=$db->sql_fetchrow($query_method))
			  {
			  	$method_id = $rs_m['method_id'];
				$method_name = $rs_m['method_name'];
			?>
              <option value="<?=$method_id?>"  <? if($products_cal_method==$method_id){ echo "selected='selected'";};?> >
              <?=$method_name?>
              </option>
              <?	
			  }
			  ?>
            </select>
          </td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Main Picture&nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_mainpic")){
						$getsize=getimagesize($products_path."/".$products_mainpic); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_mainpic; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_mainpic";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Main Picture1&nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_mainpic1")){
						$getsize=getimagesize($products_path."/".$products_mainpic1); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_mainpic1; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_mainpic1";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <!--1-->
        <tr>
          <td height="26" class="td_desc">Main Picture2&nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_mainpic2")){
						$getsize=getimagesize($products_path."/".$products_mainpic2); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_mainpic2; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_mainpic2";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <!--2-->
        <tr>
          <td height="26" class="td_desc">Main Picture3&nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_mainpic3")){
						$getsize=getimagesize($products_path."/".$products_mainpic3); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_mainpic3; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_mainpic3";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">thumb Picture&nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_thumbpic")){
						$getsize=getimagesize($products_path."/".$products_thumbpic); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_thumbpic; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_thumbpic";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Drawing Picture&nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_drawing")){
						$getsize=getimagesize($products_path."/".$products_drawing); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_drawing; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_drawing";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Drawing2 Picture&nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_drawing2")){
						$getsize=getimagesize($products_path."/".$products_drawing2); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_drawing2; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_drawing2";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Logo Brand &nbsp;&nbsp;:&nbsp;&nbsp;
            </div></td>
          <td><TABLE>
              <TR>
                <?php
					if (file_exists("$products_path/$products_logo")){
						$getsize=getimagesize($products_path."/".$products_logo); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 		
						$ww=ceil($getsize[0]*0.6); 
						$hh=ceil($getsize[1]*0.6); 
			?>
                <TD><table width="100%" border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                    <tr>
                      <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?=$products_path."/".$products_icon; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"  title="?????????"><img src="<?="$products_path/$products_logo";?>" width="<?=$ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                    </tr>
                  </table></TD>
                <TD valign="bottom"></TD>
                <?php
			}// end if 
			else{
			?>
                <TD valign="middle" height="30"></TD>
                <TD valign="middle"></TD>
                <?php
			}// end else 
			?>
              </TR>
            </TABLE></td>
        </tr>
        <tr>
          <td height="26" class="td_desc"><?=$arr_product_fieldname[44]?>
            : &nbsp;</td>
          <td><div class='Div_Config'>
              <?php

							
							$iconservice_allow = explode("-",$products_icon); //echo count($keep_allow);

							$iconservice_sql = sql_Select(1, $prefix."_iconservice",1, "iconservice_name");
							//echo $iconservice_sql;
						
							$iconservice_query = $db->sql_query($iconservice_sql);
							$iconservice_rec = $db->sql_numrows($iconservice_query);
							
							if ($iconservice_rec > 0) { // gen tbl
										echo "<table cellspacing=\"3\" cellpadding=\"3\" border=\"0\" width=\"100%\">";
										$count = 4;$start=1;
										$wid = ceil(99/$count);
										while ($iconservice = $db->sql_fetchrow($iconservice_query))
										{												
												$iconservice_id = $iconservice['iconservice_id'];
												$iconservice_name = $iconservice['iconservice_name'];
												$iconservice_pic1 = $iconservice['iconservice_pic1'];
												$iconservice_status = $iconservice['iconservice_status'];

												if ( $start == 1) echo "<tr height=\"26\">";

												if (in_array($iconservice_id,$iconservice_allow)){
													echo "<td  width = \"$wid%\"><input type=\"checkbox\" name=\"iconservice[]\"  value=\"$iconservice_id\" checked>&nbsp;&nbsp;<img src='$iconservice_path/$iconservice_pic1' width='25' height='25' border='0'></td>";
												}else{
													echo "<td  width = \"$wid%\"><input type=\"checkbox\" name=\"iconservice[]\"  value=\"$iconservice_id\">&nbsp;&nbsp;<img src='$iconservice_path/$iconservice_pic1' width='25' height='25' border='0'></td>";
												}

												$start++;
												if ( $start > $count ) {
													$start =1;													
												}
										}

										if ($start > 1){
											if ($start != $count ){
												while( $start <= $count){
													echo "<td  width = \"$wid%\">&nbsp;</td>";
													$start++;
												}								
											}
										}
										echo "</tr></table>";
							}
							else
										echo " - ";							
				   ?>
            </div></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Accessorie : </td>
          <td><span class="td_desc">
            <? if ($products_accessories==1) echo"Active"; else echo"Not Active"?>
            </span></td>
        </tr>
         <tr>
          <td height="26" class="td_desc">หมายเหตุ : </td>
          <td><? echo $products_remark; ?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Keyword : </td>
          <td><? echo $products_keyword; ?></td>
        </tr>
        
        <tr>
          <td height="26" class="td_desc">Status : &nbsp;&nbsp;</td>
          <td><?=$arr_status[$products_status]?></td>
        </tr>
        <tr>
          <td height="26" class="td_desc">Promote on web : &nbsp;&nbsp;</td>
          <td><?=$arr_status[$products_promote]?></td>
        </tr>
        <tr>
          <td height="25" colspan="2" class="td_linkactive"><strong>&nbsp;&nbsp;Link 
            Action &gt; <a href="index.php?method=products&process=list">List Products</a> &gt; <a href="index.php?method=products&process=bformmodify&cate_id=<?=$cate_id?>&collection_id=<?=$collection_id?>&products_id=<?=$products_id?>">Modify</a></strong></td>
        </tr>
        <tr>
          <td width="125" height="10">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
<BR>
<?php

}

function bdeleted()
{

			include "includes/global.php";
			$paralink = "&level=$level&categories_id=$categories_id";

			$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$delproducts_id'", 0);
			//echo  $detail_sql ;
			$detail_query = $db->sql_query($detail_sql);
			$productsdel = $db->sql_fetchrow($detail_query);
			$products_mainpic = $productsdel['products_mainpic'];
			$products_mainpic1 = $productsdel['products_mainpic1'];
			$products_mainpic2 = $productsdel['products_mainpic2'];
			$products_mainpic3 = $productsdel['products_mainpic3'];
			$products_thumbpic = $productsdel['products_thumbpic'];
			$products_drawing = $productsdel['products_picDrawing'];
			$products_drawing2 = $productsdel['products_picDrawing2'];
			$products_logo = $productsdel['products_logo'];
			unlink ("$products_path/$products_mainpic");
			unlink ("$products_path/$products_mainpic1");
			unlink ("$products_path/$products_mainpic2");
			unlink ("$products_path/$products_mainpic3");
			unlink ("$products_path/$products_thumbpic");	
			unlink ("$products_path/$products_drawing");
			unlink ("$products_path/$products_drawing2");
			unlink ("$products_path/$products_logo");		
							
			//$delete_sql = sql_Update($prefix."_products","products_delete_date=Now(),products_delete='1' ","products_id = '$delproducts_id' ");
			//echo  "<br>$delete_sql<br>"; exit;
			$delete_sql = sql_delete($prefix."_products", "products_id = '$delproducts_id'");
			$delete_query = $db->sql_query($delete_sql);
			
			if(!$delete_query){
						// error
						$msg = "<font color=red>ERROR !!</font> Can Not Delete Products .";
			}
			else
			{
						// success		
						$msg = "<font color=blue>SUCCESS !!</font> Delete Products on Success.";
			}
			$loc = "index.php?method=products&process=list&$paralink&msg=$msg";
			echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
}

function bformmodify()
{

			include "includes/global.php";
			global $postfix_lang,$lang;
			global $products_path,$iconservice_path,$arr_product_fieldname;
			global $fcke_width,$fcke_height;

			$products_id = get_var('products_id','request',0);
			
			$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$products_id'", 0);
			//echo  $detail_sql ;
			$detail_query = $db->sql_query($detail_sql);
			$result = $db->sql_fetchrow($detail_query);			
			
			$products_id=$result['products_id'];
			$products_name=stripslashes($result['products_name']);
			$products_name_en=stripslashes($result['products_name_en']);
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
            $products_promotion=$result['products_promotion'];
			$products_description=$result['products_description'];
			
			$promotion_start_date=$result['promotion_start_date'];
			$promotion_end_date=$result['promotion_end_date'];
			//$products_description = str_replace("\n","<br>",$products_description);		
			$products_mainpic=$result['products_mainpic'];
			/* add products_mainpic1-products_mainpic3 */
			$products_mainpic1=$result['products_mainpic1'];
			$products_mainpic2=$result['products_mainpic2'];
			$products_mainpic3=$result['products_mainpic3'];
			/* end products_mainpic1-products_mainpic3 */			
			$products_status=$result['products_status'];
			$categories_id=$result['categories_id'];
			$products_create=$result['products_create'];
			$products_modify=$result['products_modify'];
			$products_promote=$result['products_promote'];
			$products_icon=$result['products_icon'];
			$products_detail_th=$result['products_detail'];
			$products_detail_en=$result['products_detail_en'];
			//$products_detail = str_replace("\n","<br>",$products_detail);	
			$products_cal_method=$result['products_cal_method'];
			$products_cal_w=$result['products_cal_w'];
			$products_cal_h=$result['products_cal_h'];
			$products_cal_t=$result['products_cal_t'];
			$products_cal_b=$result['products_cal_b'];
			$products_cal_p=$result['products_cal_p'];
			$products_cal_weight=$result['products_cal_weight'];
			$products_thumbpic=$result['products_thumbpic'];
			$products_drawing=$result['products_picDrawing'];
			$products_drawing2=$result['products_picDrawing2'];
			$products_logo=$result['products_logo'];
			$products_accessories=$result['products_accessories'];
			$products_keyword=$result['products_keyword'];
			$products_remark=$result['products_remark'];
?>
<script language="JavaScript">
<!--
function checkvalues()
{		 
		 form1.action="<?php  echo  "index.php?method=products&process=bmodify&cate_id=$cate_id&collection_id=$collection_id" ;?>";
		 form1.submit();
}


-->
</script>
<form name="form1" method="post" enctype="multipart/form-data">
 <!-- Start Tab -->
 <div id="tabs"></div>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <tr>
      <td><table width="100%" height="1672" border="0" cellpadding="5" cellspacing="0" align="center"  class="Type_A">
          <tr class="head_noline">
            <td height="25" colspan="2">&nbsp;&nbsp;<B>Modify Products</B> <font size="1" color="red"> &nbsp;&nbsp;[ **** Please use single quote(') replace double quote(") ]</font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[13] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <?=$products_create?>
              </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[14] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><font size="-2" face="MS Sans Serif, Tahoma, sans-serif">
              <?=$products_modify?>
              </font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Categories &nbsp;&nbsp;:&nbsp;&nbsp;
              </div></td>
            <td><?=getn("categories_name_en","categories","categories_id = '$categories_id' ");?>
              <input name="cate_id" type="hidden"  size="100" value="<?=$cate_id?>">
              <input name="products_id" type="hidden"  size="100" value="<?=$products_id?>">
            </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[48] ?>
              (Thai)&nbsp;&nbsp;: &nbsp;</td>
            <td><input name="products_name" type="text"  size="100" value="<?=$products_name?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[48] ?>
              (Eng)&nbsp;&nbsp;: &nbsp;</td>
            <td><input name="products_name_en" type="text"  size="100" value="<?=$products_name_en?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[1] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="jb_no" type="text"  size="100" value="<?=$products_jb_no?>">
              &nbsp;<font color='red'>*</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[2] ?>
              : &nbsp;</td>
            <td><input name="model" type="text"  size="100" value="<?=$products_model?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[3] ?>
              &nbsp;
              : &nbsp;</td>
            <td><input name="type" type="text"  size="100" value="<?=$products_type?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[4] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="thinkness" type="text"  size="100" value="<?=$products_thinkness?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[5] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="volumn" type="text"  size="100" value="<?=$products_volume?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[6] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><table>
                <tr>
                  <td>
                <tr>
                  <td><?=$arr_product_fieldname[7] ?>
                    &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td><input name="staticcapacity" type="text"  size="100" value="<?=$products_capacity_static?>"></td>
                </tr>
                <tr>
                  <td><?=$arr_product_fieldname[8] ?>
                    &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td><input name="dynamiccapacity" type="text"  size="100" value="<?=$products_capacity_dynamic?>"></td>
                </tr>
                <tr>
                  <td><?=$arr_product_fieldname[9] ?>
                    &nbsp;&nbsp;:&nbsp;&nbsp;</td>
                  <td><input name="rackingload" type="text"  size="100" value="<?=$products_capacity_racking?>"></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[10] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="standardlift" type="text"  size="100" value="<?=$products_standard_lift?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[11] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="dimension" type="text"  size="100" value="<?=$products_dimension?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[12] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="platform" type="text"  size="100" value="<?=$products_platform?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[13] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="platformh1" type="text"  size="100" value="<?=$products_platform_h1?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[14] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="height" type="text"  size="100" value="<?=$products_height?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[15] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="footplate" type="text"  size="100" value="<?=$products_footplate?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[16] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="wheeldia" type="text"  size="100" value="<?=$products_wheeldia?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[17] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="threadstemwheel" type="text"  size="100" value="<?=$products_threadstemwheel?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[18] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_partspanels" type="text"  size="100" value="<?=$products_numberofpartspanels?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[19] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="horizontal" type="text"  size="100" value="<?=$products_horizontal?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[20] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="vertical" type="text"  size="100" value="<?=$products_vertical?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[21] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="airpressure" type="text"  size="100" value="<?=$products_airpressure?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[22] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="deliverypressure" type="text"  size="100" value="<?=$products_deliverypressure?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[23] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="colour" type="text"  size="100" value="<?=$products_colour?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[24] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="setcontent" type="text"  size="100" value="<?=$products_setcontent?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[25] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="range" type="text"  size="100" value="<?=$products_range?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[26] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="female" type="text"  size="100" value="<?=$products_female?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[27] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="male" type="text"  size="100" value="<?=$products_male?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[28] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_sections" type="text"  size="100" value="<?=$products_numberofsection?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[29] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="cuttingwire" type="text"  size="100"  value="<?=$products_cuttingwire?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[30] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="slotted" type="text"  size="100" value="<?=$products_slotted?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[31] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="phillips" type="text"  size="100" value="<?=$products_phillips?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[32] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_smalldrawers" type="text"  size="100" value="<?=$products_small_drawers?>" >
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[33] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="n_rollers" type="text"  size="100" value="<?=$products_rollers?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[34] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="material" type="text"  size="100" value="<?=$products_material?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[35] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><input name="qtypack" type="text"  size="100" value="<?=$products_qtypack?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc">กำหนดวันแสดงราคา &nbsp;<font color=red>**</font>
              : &nbsp;</td>
            <td><input type="text" id="datepicker" name='promotion_start_date' value="<?=$promotion_start_date?>"/></p></td>
            
          </tr>
          <tr>
            <td height="26" class="td_desc">วันสิ้นสุดแสดงราคา &nbsp;<font color=red>**</font>
              : &nbsp;</td>
              <td><input type="text" id="datepicker2" name='promotion_end_date' value="<?=$promotion_end_date?>"/></p></td>
            
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[36] ?>
              &nbsp;<font color=red>**</font>
              : &nbsp;</td>
            <td><input name="price" type="text"  size="24" value="<?=$products_price?>">
              &nbsp; </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[37] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;<font color=red>**</font></td>
            <td><input name="discountprice" type="text"  size="24" value="<?=$products_discountprice?>">
              &nbsp; <select name="products_promotion">
                <option value="0" <?php if ($products_promotion ==0) echo 'selected="selected"';?>>Please Select</option>
                <option value="1" <?php if ($products_promotion ==1) echo 'selected="selected"';?>>Promotion Price</option>
                <option value="2" <?php if ($products_promotion ==2) echo 'selected="selected"';?>>Spacial Price</option>
                
              </select><font color=red>**</font></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[46] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><textarea name="p_detail_th" rows="5"  cols="100"><?=$products_detail_th?>
</textarea>
              &nbsp; <br>
              <font color='red'>* พิมพ์ &lt;br&gt; แทนการกด enter เพื่อขึ้นบรรทัดใหม่</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[57] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><textarea name="p_detail_en" rows="5"  cols="100"><?=$products_detail_en?>
</textarea>
              &nbsp; <br>
              <font color='red'>* พิมพ์ &lt;br&gt; แทนการกด enter เพื่อขึ้นบรรทัดใหม่</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[38] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><?php
					
					// Automatically calculates the editor base path based on the _samples directory.
					// This is usefull only for these samples. A real application should use something like this:
					// $oFCKeditor->BasePath = '/fckeditor/' ;	// '/fckeditor/' is the default value.
					//$sBasePath = $_SERVER['PHP_SELF'] ;echo $sBasePath;					
					//$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "backend" ) ) ;
					
					$sBasePath = "../js_v2/" ;   //echo "<br>".$sBasePath;					
					$oFCKeditor = new FCKeditor('description') ;
					$oFCKeditor->BasePath	= $sBasePath ;
					$oFCKeditor->Height= $fcke_height ;
					$oFCKeditor->Width= $fcke_width ;
					$oFCKeditor->Value		= "$products_description" ;
					$oFCKeditor->Create() ;
						
				?>
              <BR>
              <font color='red'>* New Line press Shift+Enter *</font> </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[49] ?>
              &nbsp;
              : &nbsp;</td>
            <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td><input name="cal_w" type="text"  size="15" value="<?=$products_cal_w?>"></td>
                  <td><input name="cal_h" type="text"  size="15"  value="<?=$products_cal_h?>"></td>
                  <td><input name="cal_t" type="text"  size="15"  value="<?=$products_cal_t?>"></td>
                  <td><input name="cal_b" type="text"  size="15"  value="<?=$products_cal_b?>"></td>
                  <td><input name="cal_weight" type="text"  size="15"  value="<?=$products_cal_weight?>"></td>
                  <td><input name="cal_p" type="text"  size="15" value="<?=$products_cal_p?>"></td>
                </tr>
                <tr>
                  <td><?=$arr_product_fieldname[50] ?></td>
                  <td><?=$arr_product_fieldname[51] ?></td>
                  <td><?=$arr_product_fieldname[52] ?></td>
                  <td><?=$arr_product_fieldname[53] ?></td>
                  <td><?=$arr_product_fieldname[54] ?></td>
                  <td><?=$arr_product_fieldname[55] ?></td>
                </tr>
              </table></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[56] ?>
              : &nbsp;</td>
            <td><select name="cal_method">
                <option value="">โปรดเลือก
                <?=$arr_product_fieldname[56]?>
                </option>
                <? $sql_method = sql_Select(1,$prefix."_method",1,0);
			  $query_method = $db->sql_query($sql_method);
			  while($rs_m=$db->sql_fetchrow($query_method))
			  {
			  	$method_id = $rs_m['method_id'];
				$method_name = $rs_m['method_name'];
			?>
                <option value="<?=$method_id?>"  <? if($products_cal_method==$method_id){ echo "selected='selected'";};?> >
                <?=$method_name?>
                </option>
                <?	
			  }
			  ?>
              </select>
            </td>
          </tr>
          <tr> 
                 <td height="26" class="td_desc">Table View
			: &nbsp;</td>
			  <td>
              <? 
		$sql = sql_Select("(select c.categories_id from  jenbunjerd_categories c where c.categories_id = p.categories_id) cat_id", $prefix."_products p", "p.products_id = $products_id",0);
			//echo  $sql;exit;
		$query = $db->sql_query($sql);
		$re = $db->sql_fetchrow($sub_query);
		$category_id = $re["cat_id"];
/*		$category_parent = $re["cat_id"];
		$lev =1;
		if(trim($category_parent)!=""){
		while($lev!=0){
			$sql = sql_Select("categories_id,categories_parent,categories_level", $prefix."_categories", " categories_id= '$category_parent'",0);
			echo  $sql;
		$query = $db->sql_query($sql);
		$re = $db->sql_fetchrow($sub_query);
		$category_parent = $re["categories_parent"];
		$category_id = $re["categories_id"];
		$lev = $re["categories_level"];
		
		}
		}*/
		//echo  $category_id."ss";exit;
		if(trim($category_id)!=""){
		$sql = sql_Select("id", $prefix."_columns", "pro_id = '$products_id'",0);
			//echo  $sql;
			$query = $db->sql_query($sql);
			if(!$db->sql_numrows($query)){
							
			$sql = sql_Select("id,seq,columns,column_name,sub,properties1",$prefix."_columns_category","cat_id = $category_id",0);
			$query = $db->sql_query($sql);
			if($db->sql_numrows($query)){
				while($re = $db->sql_fetchrow($query)){
					$cat_id = $re["id"];
					$seq = $re["seq"];
					$columns = $re["columns"];
					$column_name = $re["column_name"];
					$sub = $re["sub"];
					$properties = $re["properties1"];
					$sql = sql_insert($prefix."_columns","pro_id,seq,columns,column_name,sub","$products_id,$seq,'$columns','$column_name','$sub'");
		//echo $sql;
		$db->sql_query($sql);
		$sql = sql_Select("id", $prefix."_detail", "pro_id = $products_id",0);
			$chk_query = $db->sql_query($sql);
			if(!$db->sql_numrows($chk_query)){
				$sql = sql_insert($prefix."_detail","pro_id","$products_id");
				$db->sql_query($sql);
				}
				$sql = sql_Update($prefix."_detail","$columns='$properties'","pro_id = $products_id");
		//echo $sql;
				$db->sql_query($sql);
	
		$sql = sql_Select("path", $prefix."_col_img_category", "col_id = $cat_id",0);
		//echo $sql;
			$img_query = $db->sql_query($sql);
			if($db->sql_numrows($img_query)){
				while($re_img = $db->sql_fetchrow($img_query)){
			$sql = sql_Select("max(id) id", $prefix."_columns", "pro_id = $products_id",0);
			$max_query = $db->sql_query($sql);
			$re_max = $db->sql_fetchrow($max_query);
			$max = $re_max["id"];
			$path = $re_img["path"];
			$sql = sql_insert($prefix."_col_img","col_id,path","'$max','$path'");
			$db->sql_query($sql);
				}
			}
	
				}
			}
			}
			/*
			$sql = sql_Select("detail",$prefix."_detail_status_category","cat_id = $category_id and status='view'",0);
			$query = $db->sql_query($sql);
			if($db->sql_numrows($query)){
			$re = $db->sql_fetchrow($query);
			$detail = $re["detail"];
			
			$sql = sql_Select("detail",$prefix."_detail_status","pro_id = $products_id and status='view'",0);
			$query = $db->sql_query($sql);
			if($db->sql_numrows($query)){
			$sql = sql_Update($prefix."_detail_status","detail ='$detail' "," pro_id = $products_id and status = 'view' ");
		$db->sql_query($sql);
			}else{
			$sql = sql_insert($prefix."_detail_status","pro_id,status,detail","$products_id,'view','$detail'");
			$db->sql_query($sql);
			}
			}
			
			
			$sql = sql_Select("detail",$prefix."_detail_status_category","cat_id = $category_id and status='color'",0);
			$query = $db->sql_query($sql);
			if($db->sql_numrows($query)){
			$re = $db->sql_fetchrow($query);
			$detail = $re["detail"];
			
			$sql = sql_Select("detail",$prefix."_detail_status","pro_id = $products_id and status='color'",0);
			$query = $db->sql_query($sql);
			if($db->sql_numrows($query)){
			$sql = sql_Update($prefix."_detail_status","detail ='$detail' "," pro_id = $products_id and status = 'color' ");
		$db->sql_query($sql);
			}else{
			$sql = sql_insert($prefix."_detail_status","pro_id,status,detail","$products_id,'color','$detail'");
			$db->sql_query($sql);
			}
			}*/
			
		}
			  $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'view' ", 0);
			//echo $sql ;
			$query = $db->sql_query($sql);
			$fview= $db->sql_fetchrow($query);
			$view = $fview["detail"];
			if(trim($view)==""){$view=="l";}
			?>
     <div id="view">
     <input name="vertical" type="radio" value="" <? if(trim($view) == 'l') echo "checked='checked'";?>  onclick="Javascript:edit_view('<?=$admin?>',<?=$products_id?>,'l')"/> Landscape
     <input name="vertical" type="radio" value=""
     <? if(trim($view) == 'v'){echo "checked='checked'";}?> onclick="Javascript:edit_view('<?=$admin?>',<?=$products_id?>,'v')"/> Vertical

              </div>
              </td>
			</tr>
            <tr>
          <td height="26" class="td_desc">Color Table description: &nbsp;</td>
			  <td><div id="color">
              <?
              $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'color' ", 0);
			//echo $sql ;
				$query = $db->sql_query($sql);
				$fcolor = $db->sql_fetchrow($query);
                $color = $fcolor["detail"];
			  ?>
              <input type="text" maxlength="6" size="6" id="colorpickerField1" value="<?=$color?>"/><input type="button" style="margin-left:10px; background:url(colorpicker/download.png) 1px no-repeat; cursor:pointer; width:20px;" onclick="javascript:sadd_col('<?=$admin?>','color',<?=$products_id?>)"></div></td>
			</tr>
             <tr>
          <td height="26" class="td_desc">Color Font description: &nbsp;</td>
			  <td><div id="color_font">
              <?
              $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'font' ", 0);
			//echo $sql ;
				$query = $db->sql_query($sql);
				$fcolor = $db->sql_fetchrow($query);
                $font = $fcolor["detail"]; ?>
              <input type="text" maxlength="6" size="6" id="colorpickerField2" value="<?=$font?>"/><input type="button" style="margin-left:10px; background:url(colorpicker/download.png) 1px no-repeat; cursor:pointer; width:20px;" onclick="javascript:sadd_col('<?=$admin?>','font',<?=$products_id?>)"></div></td>
			</tr>
            <tr>
          <td height="26" class="td_desc">Rows Properties: &nbsp;</td>
			  <td><div id="prop">
              <?
              $sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'prop' ", 0);
			//echo $sql ;
				$query = $db->sql_query($sql);
				$per = $db->sql_fetchrow($query);
                $prop = $per["detail"];
				if(trim($prop)=="")$prop = 1; ?>
              <select id="prop_value">
              <option value="1" <? if($prop==1)echo "selected='selected'";?> >1</option>
              <option value="2"<? if($prop==2)echo "selected='selected'";?>>2</option>
              <option value="3"<? if($prop==3)echo "selected='selected'";?>>3</option>
              <option value="4"<? if($prop==4)echo "selected='selected'";?>>4</option>
              <option value="5"<? if($prop==5)echo "selected='selected'";?>>5</option>
              </select>
              <input type="button" style="margin-left:10px; background:url(colorpicker/download.png) 1px no-repeat; cursor:pointer; width:20px;" onclick="javascript:sadd_col('<?=$admin?>','prop',<?=$products_id?>)"></div></td>
			</tr>
            <tr>
          <td height="80" class="td_desc" valign="top">Additional description&nbsp;&nbsp;:&nbsp;&nbsp;</td>
   <td>
   <div id="addition">
	<table cellpadding="0" cellspacing="0">
        <tr>
	<? $array = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U');	
			$detail_sql = sql_Select("id,(select COUNT(id) from jenbunjerd_columns s where s.sub = c.columns and s.pro_id = c.pro_id) col", $prefix."_columns c", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql;
			$detail_query = $db->sql_query($detail_sql);
			$i=1;
			while ($categories= $db->sql_fetchrow($detail_query)){?>
            <td style="background-color:#999;" colspan="<?=$categories["col"]?>" align="center">
            <? 
			$sql = sql_Select("path", $prefix."_col_img", "col_id = ".$categories["id"], "path");
			$query_img = $db->sql_query($sql);
			$img = $db->sql_fetchrow($query_img);
			if($db->sql_numrows($query_img)){ ?>
            <img src="col_img/<?=$img["path"]?>">
            <? } ?>
            </td>
            <? $i++;} ?>
            <td style="min-width:0px;background-color:#999;"></td>
            </tr>
    <tr>
	<?	$detail_sql = sql_Select("id,column_name,columns,(select COUNT(id) from jenbunjerd_columns s where s.sub = c.columns and s.pro_id = c.pro_id) col", $prefix."_columns c", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql;
			$detail_query = $db->sql_query($detail_sql);
			$i=1;
			while ($categories= $db->sql_fetchrow($detail_query)){?>
            <td class="h" colspan="<?=$categories["col"]?>" align="center">
            <div  class="h_col"><span id="col<?=$categories["id"]?>" ondblclick="edit_col('<?=$admin?>','editc',<?=$categories["id"]?>,'<?=htmlspecialchars($categories["column_name"])?>')">
			<?=$categories["column_name"]?>&nbsp;
            </span>
    <div class="control_h">
    <ul>
    <li><a href="javascript:insert_col('<?=$admin?>','insert',<?=$products_id?>,<?=$i?>)"><img src="add.png"> Add Column</a></li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))insert_col('<?=$admin?>','del','<?=$products_id?>','<?=$i?>',<?=$categories["id"]?>)"><img src="del.png"> Delete Column</a></li>
    <li><a href="products/edit_img.php?admin=<?=$admin?>&col=<?=$categories["id"]?>" onclick="javascript:open_pop_img('<?=$admin?>',<?=$categories["id"]?>,'<?=$products_id?>'); return false"><img src="image.png">Add Image</a></li>
       <li><a href="products/edit_sub.php?admin=<?=$admin?>&col=<?=$categories["id"]?>" onclick="javascript:open_pop('<?=$admin?>',<?=$categories["id"]?>); return false"><img src="sub.png"> Add Sub</a></li>
       <li><a href="javascript:open_pop_align('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="align.png">Align</a></li>
    </ul>
  </div>

    </div>
            </td>
            <? $i++;} ?>
            <td class="h" style="min-width:0px;">
             <input type="button" name="add_col" value="+" class="action" onclick="javascript:sadd_col('<?=$admin?>','add',<?=$products_id?>)"></td>
            </tr>
            <? 
			$sql = sql_Select("id", $prefix."_columns", " pro_id = $products_id and sub <> '' ", "id");
			$query_img = $db->sql_query($sql);
			$img = $db->sql_fetchrow($query_img);
			if($db->sql_numrows($query_img)){ ?>
            <tr>
            <? 
			$detail_sql = sql_Select("columns", $prefix."_columns", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql ;
			$detail_query = $db->sql_query($detail_sql);
while ($result = $db->sql_fetchrow($detail_query)){?>
		<?	$sql = sql_Select("id,column_name,sub", $prefix."_columns", "pro_id = '$products_id' and sub = '" . $result["columns"] . "' ", "seq");
			//echo  $detail_sql ;
			$sub_query = $db->sql_query($sql);
		if($db->sql_numrows($sub_query)){
			$i = 1;
			while ($re_sub = $db->sql_fetchrow($sub_query)){?>
            <td class="h" align="center">
            <div  class="h_sub"><span id="col<?=$re_sub["id"]?>" ondblclick="edit_col('<?=$admin?>','editc',<?=$re_sub["id"]?>,'<?=htmlspecialchars($re_sub["column_name"])?>')">
			<?=$re_sub["column_name"]?>&nbsp;
            </span>
    <div class="control_sub">
    <ul>
    <li><a href="javascript:if(confirm('Do you want to delete?'))insert_col('<?=$admin?>','dels','<?=$products_id?>','<?=$i?>',<?=$re_sub["id"]?>,'<?=$re_sub["sub"]?>')"><img src="del.png"> Delete Column</a></li>
    <li><a href="javascript:open_pop_align('<?=$admin?>',<?=$re_sub["id"]?>,<?=$products_id?>);"><img src="align.png">Align</a></li>
    </ul>
  </div>
    </div>
            </td>
            <? $i++;}
			}else{ ?>
			 <td class="h" style="min-width:0px;">&nbsp;
            </td>
		  <?
			} 
				} ?>
            <td class="h" style="min-width:0px;">&nbsp;</td>
            </tr>
            <? } ?>
            
             <? $detail_sql = sql_Select(1, $prefix."_detail", "pro_id = '$products_id'","id");
			//echo  $detail_sql;
			$sql = sql_Select("detail", $prefix."_detail_status", "pro_id = '$products_id' and status = 'prop'",0);
			$prop_query = $db->sql_query($sql);
			$prop= $db->sql_fetchrow($prop_query);
			$prop_val = $prop["detail"];
			if(trim($prop_val)=="")$prop_val=1;
			$j=1;
			$merge = 1;
			$detail_query = $db->sql_query($detail_sql);
			//$rows_last = $db->sql_numrows($detail_query);
			
	while ($categories= $db->sql_fetchrow($detail_query)){ ?>
     <tr <? if($j<=$prop_val){
			if(!trim($color)==""){
				if(!trim($color)==""){
				$tcolor = "background-color:#$color;";}
				if(!trim($font)==""){
				$tfont = "color:#$font";}
				?>
                style="height:30px;<?=$tcolor?><?=$tfont?>"
        <? }else{echo"class='hd2'";
			if(!trim($font)==""){
				echo "style='color:#$font'";}
				}
		}else{if($j%2){ echo "class='r1'";}else{echo "class='r2'";}}?>>
     <? $sql_sub = sql_Select("id,columns,status", $prefix."_columns", "pro_id = '$products_id' and (sub is null or sub = '') ", "seq");
			//echo  $detail_sql ;
			$query_sub = $db->sql_query($sql_sub);
			$i=1;
while ($sub= $db->sql_fetchrow($query_sub)){
		$sql = sql_Select("id,columns,status", $prefix."_columns", "pro_id = $products_id and sub = '" . $sub["columns"] . "' ", "seq");
			//echo $sql;
			$sub_query = $db->sql_query($sql);
		if($db->sql_numrows($sub_query)){
		while ($re_sub = $db->sql_fetchrow($sub_query)){

	$sql = sql_Select("amount,rows", $prefix."_merge", "pro_id = $products_id and columns = '" . $re_sub["columns"] . "' and rows <= $j and  (rows+amount) > $j", 0);
		//echo $sql;
		$merge_query = $db->sql_query($sql);
		if($db->sql_numrows($merge_query)){
		$re_merge = $db->sql_fetchrow($merge_query);
		$amount_merge = $re_merge["amount"];
		$rows_merge = $re_merge["rows"];

		if($rows_merge==$j){?>
       <td class="d" <? 
	   if($j>$prop_val){
	   $sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $re_sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		//echo $sql;
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($re_sub["status"]=="c"){
		   echo "align='center'";
		}else if($re_sub["status"]=="l"){
			echo "align='left'";
		}else if($re_sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}
	   ?> 
	   <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";}}else{ echo "align='center'";} ?> 
       rowspan="<?=$amount_merge?>">
       <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$re_sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop_val or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li><a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="merge.png">merge row</a></li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
        <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
	<li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div>
            </td>
            <? }else if(($amount_merge+$rows_merge)>$j){
             echo "";
			}
			}else{?>
                   <td class="d" <?  
			if($j>$prop_val){	  
			$sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $re_sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($re_sub["status"]=="c"){
		   echo "align='center'";
		}else if($re_sub["status"]=="l"){
			echo "align='left'";
		}else if($re_sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}?>
                   <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";} }else{ echo "align='center'";}?> >
            <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$re_sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop_val or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li><a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="merge.png">merge row</a></li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$re_sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
        <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
	<li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$re_sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div>
            </td>
            <?
			 } 
		}
			 }else{ 
		$sql = sql_Select("amount,rows", $prefix."_merge", "pro_id = $products_id and columns = '" . $sub["columns"] . "' and rows <= $j and  (rows+amount) > $j", 0);
		//echo $sql;
		$merge_query = $db->sql_query($sql);
		if($db->sql_numrows($merge_query)){
		$re_merge = $db->sql_fetchrow($merge_query);
		$amount_merge = $re_merge["amount"];
		$rows_merge = $re_merge["rows"];
		//echo $sql;
		if($rows_merge==$j){?>
		<td class="d" <? 
			if($j>$prop_val){	  
			$sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		//echo $sql;
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($re_sub["status"]=="c"){
		   echo "align='center'";
		}else if($re_sub["status"]=="l"){
			echo "align='left'";
		}else if($re_sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}?>
        <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";}}else{ echo "align='center'";} ?> 
         rowspan="<?=$amount_merge?>">
            <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop_val or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li>
    <a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="merge.png"> merge row</a>
    </li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
        <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
	<li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div>
            </td>
			<? }else if(($amount_merge+$rows_merge)>$j){
             echo "";
			}
		
			}else{?>
			 <td class="d"  <? 
			if($j>$prop_val){	  
			$sql = sql_Select("status", $prefix."_align", "pro_id = $products_id and col = '" . $sub["columns"] . "' and rows_id =". $categories["id"] , 0);
		//echo $sql;
		$rowalign_query = $db->sql_query($sql);
		if($db->sql_numrows($rowalign_query)){
			$re_align = $db->sql_fetchrow($rowalign_query);
			if($re_align["status"]=="c"){
		   echo "align='center'";
		}else if($re_align["status"]=="l"){
			echo "align='left'";
		}else if($re_align["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}else{
	   if($sub["status"]=="c"){
		   echo "align='center'";
		}else if($sub["status"]=="l"){
			echo "align='left'";
		}else if($sub["status"]=="r"){
			echo "align='right'";}
		else{echo "align='center'";}
		}?>
             <? if($categories["status"]=="t"){echo "valign='top'";}else if($categories["status"]=="c"){echo "valign='center'";}else if($categories["status"]=="b"){echo "align='bottom'";} }else{ echo "align='center'";}?> >
            <div class='row' ondblclick="add_row('<?=$admin?>','edit',<?=$products_id?>,<?=$categories["id"]?>)">
			<?=$categories[$sub["columns"]]?>&nbsp;
    <? if(!($j<=$prop_val or $j==$rows_last)){?>
    <div class="control_row">
    <ul>
    <li>
    <a href="javascript:open_merge('<?=$admin?>','merge','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="merge.png"> merge row</a>
    </li>
    <li><a href="javascript:if(confirm('Do you want to delete?'))open_merge('<?=$admin?>','del','<?=$products_id?>','<?=$sub["columns"]?>',<?=$j?>)"><img src="del.png">delete merge</a></li>
        <li><a href="javascript:open_pop_align_row('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="align.png">Align</a></li>
    <li><a href="javascript:open_pop_valign('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>);"><img src="valign_center.png">Valign</a></li>
	<li><a href="javascript:open_pop_text('<?=$admin?>',<?=$categories["id"]?>,<?=$products_id?>,'<?=$sub["columns"]?>');"><img src="editor.png">Text Advance</a></li>
    </ul>
  </div>
  <? } ?>
  </div>
            </td>	
			<? }
			 } ?>
            <?  }?>
            <td class="d" style="min-width:0px;">
            <input type="button" name="del_row" value="-" class="action" onclick="javascript:if(confirm('Do you want to delete?')){add_row('<?=$admin?>','del',<?=$products_id?>,<?=$categories["id"]?>);}">
            </td>
            </tr>
			<? $j++;} ?>

            <tr>
        <? $detail_sql = sql_Select(1, $prefix."_columns", "pro_id = '$products_id' and (sub is null or sub = '') ", 0);
		//echo  $detail_sql;
		$detail_query = $db->sql_query($detail_sql);
while ($categories= $db->sql_fetchrow($detail_query)){
		$sql = sql_Select("columns", $prefix."_columns", "sub = '" . $categories["columns"] . "' and pro_id = '$products_id'", "seq");
			//echo  $sql ;
			$sub_query = $db->sql_query($sql);
		if($db->sql_numrows($sub_query)){
			while ($re_sub = $db->sql_fetchrow($sub_query)){ ?>
            <td class="d">
            <input name="row[]" value="" onkeypress="javascript:if(event.keyCode == 13){add_row('<?=$admin?>','add',<?=$products_id?>);}">
            </td>
            <? } }else{ ?>
            <td class="d">
            <input name="row[]" value="" onkeypress="javascript:if(event.keyCode == 13){add_row('<?=$admin?>','add',<?=$products_id?>);}">
            </td>
             <? } }?>
            <td class="d" style="min-width:0px;">&nbsp;</td>
            </tr>
            </table>
            <br>
            <br>
            <br>
            </div>
           </td>
        </tr>
         <tr>
                 <td height="80" class="td_desc" valign="top">HTML Codes Characters&nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td>
            <input id="symbol" value="">
            <table width="100%" class="symbol">
            <tr>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iexcl;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&cent;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&pound;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&curren;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&yen;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&brvbar;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&sect;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&uml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&copy;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ordf;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&laquo;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&not;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&reg;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&macr;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&deg;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&plusmn;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&sup2;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&sup3;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&acute;</td>
           <td onclick="javascript:encodehtml(this.innerHTML)">&micro;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&para;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&middot;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&cedil;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ordm;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&raquo;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac14;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac12;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac12;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&frac34;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iquest;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Agrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Aacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Acirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Atilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Auml;</td>

            </tr>
            <tr>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Aring;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&AElig;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ccedil;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Egrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Eacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ecirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Euml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Igrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Iacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Icirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Iuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ETH;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ntilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ograve;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Oacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ocirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Otilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ouml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Oslash;</td>
           <td onclick="javascript:encodehtml(this.innerHTML)">&Ugrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Uacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Ucirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Uuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&Yacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&THORN;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&szlig;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&agrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&aacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&acirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&atilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&auml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&aring;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&aelig;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ccedil;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&egrave;</td>

            </tr>            <tr>
            <td onclick="javascript:encodehtml(this.innerHTML)">&eacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ecirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&euml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&igrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&icirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&iuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&eth;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ntilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ograve;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&oacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ocirc;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&otilde;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ouml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&divide;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&oslash;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ugrave;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&uacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ucirc;</td>
           <td onclick="javascript:encodehtml(this.innerHTML)">&uuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&yacute;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&thorn;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&yuml;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&lt;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&gt;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&le;</td>
            <td onclick="javascript:encodehtml(this.innerHTML)">&ge;</td>
            </tr>
            </table>
            </td>

            </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[39]?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_mainpic")){
						$getsize=getimagesize($products_path."/".$products_mainpic); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }

			 // echo "$old_w,$old_w";

			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_mainpic; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')" title="????????"><img src="<?php echo "$products_path/$products_mainpic";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="spicture" type="file" size="70">
                      &nbsp;
                      <INPUT TYPE="checkbox" NAME="pic_default" value="<?=$products_mainpic?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><input name="spicture" type="file" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <!---------------------------------------------------------->
          <tr>
            <td height="26" class="td_desc"><?="picture1"?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_mainpic1")){
						$getsize=getimagesize($products_path."/".$products_mainpic1); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }
			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_mainpic1; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')" title="????????"><img src="<?php echo "$products_path/$products_mainpic1";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="spicture1" type="file" size="70">
                      &nbsp;
                      <INPUT TYPE="checkbox" NAME="pic_default1" value="<?=$products_mainpic1?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><input name="spicture1" type="file" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <!---------------------------------------------------------->
          <tr>
            <td height="26" class="td_desc"><?="Picture2"?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_mainpic2")){
						$getsize=getimagesize($products_path."/".$products_mainpic2); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }
			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_mainpic2; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')" title="????????"><img src="<?php echo "$products_path/$products_mainpic2";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="spicture2" type="file" size="70">
                      &nbsp;
                      <INPUT TYPE="checkbox" NAME="pic_default2" value="<?=$products_mainpic2?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><input name="spicture2" type="file" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <!---------------------------------------------------------->
          <tr>
            <td height="26" class="td_desc"><?="Picture3"?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_mainpic3")){
						$getsize=getimagesize($products_path."/".$products_mainpic3); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }
			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_mainpic3; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')" title="????????"><img src="<?php echo "$products_path/$products_mainpic3";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="spicture3" type="file" size="70">
                      &nbsp;
                      <INPUT TYPE="checkbox" NAME="pic_default3" value="<?=$products_mainpic3?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><input name="spicture3" type="file" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 300px x 300px (กว้าง x ยาว) </TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <!---------------------------------------------------------->
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[47]?>
              &nbsp;&nbsp;:&nbsp;&nbsp;</td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_thumbpic")){
						$getsize=getimagesize($products_path."/".$products_thumbpic); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }

			 // echo "$old_w,$old_w";

			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_thumbpic; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"title="????????"><img src="<?php echo "$products_path/$products_thumbpic";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="tpicture" type="file" size="70">
                      &nbsp;
                      <INPUT TYPE="checkbox" NAME="tpic_default" value="<?=$products_thumbpic?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 100px x 100px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><input name="tpicture" type="file" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 100px x 100px (กว้าง x ยาว) </TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Drawing</td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_drawing")){
						$getsize=getimagesize($products_path."/".$products_drawing); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }

			 // echo "$old_w,$old_w";

			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_drawing; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"title="????????"><img src="<?php echo "$products_path/$products_drawing";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="dpicture" type="file" size="70">
                      &nbsp;
                      <INPUT NAME="dpic_default" TYPE="checkbox" id="dpic_default" value="<?=$products_drawing?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><?=$products_drawing ?>
                    <input name="dpicture" type="file" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว)</TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Drawing2</td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_drawing2")){
						$getsize=getimagesize($products_path."/".$products_drawing2); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }

			 // echo "$old_w,$old_w";

			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_drawing2; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"title="????????"><img src="<?php echo "$products_path/$products_drawing2";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="d2picture" type="file" size="70">
                      &nbsp;
                      <INPUT NAME="d2pic_default" TYPE="checkbox" id="d2pic_default" value="<?=$products_drawing2?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><?=$products_drawing2 ?>
                    <input name="d2picture" type="file" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว)</TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Logo Brand </td>
            <td><TABLE>
                <TR>
                  <?php
				if (file_exists("$products_path/$products_logo")){
						$getsize=getimagesize($products_path."/".$products_logo); 
						$old_w=$getsize[0]; 
						$old_h=$getsize[1]; 	
						$ww = $old_w*0.6;
						$hh = $old_h*0.6;
			  }

			 // echo "$old_w,$old_w";

			  if ( ($ww > 0 ) && ($hh > 0 )){
			?>
                  <TD><table  border="0" cellspacing="1" cellpadding="0"  bgcolor="#000000">
                      <tr>
                        <td><a href="javascript:;" onclick="MM_openBrWindow('show_picture.php?pic=<?php echo $products_path."/".$products_logo; ?>','','width=<?=$old_w?>,height=<?=$old_h?>')"title="????????"><img src="<?php echo "$products_path/$products_logo";?>" width="<?php echo $ww;?>" height="<?php echo $hh;?>" border="0"></a></td>
                      </tr>
                    </table>
                    <p>
                      <input name="logopicture" type="file" size="70">
                      &nbsp;
                      <INPUT NAME="logopic_default" TYPE="checkbox" id="logopic_default" value="<?=$products_logo?>">
                      Remove Picture</p>
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว)</TD>
                  <?php
			}// end if 
			else{
			?>
                  <TD valign="middle" height="30">ยังไม่มีรูป</TD>
                  <TD valign="middle"><?=$products_logo ?>
                    <input name="logopicture" type="file" id="logopicture" size="70">
                    <BR>
                    สัดส่วนของรูปภาพที่ดีที่สุด 853px x 504px (กว้าง x ยาว)</TD>
                  <?php
			}// end else 
			?>
                </TR>
              </TABLE></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[40]?>
              : &nbsp;</td>
            <td><div class='Div_Config'>
                <?php

							
							$iconservice_allow = explode("-",$products_icon); //echo count($keep_allow);

							$iconservice_sql = sql_Select(1, $prefix."_iconservice",1, "iconservice_name");
							//echo $iconservice_sql;
						
							$iconservice_query = $db->sql_query($iconservice_sql);
							$iconservice_rec = $db->sql_numrows($iconservice_query);
							
							if ($iconservice_rec > 0) { // gen tbl
										echo "<table cellspacing=\"3\" cellpadding=\"3\" border=\"0\" width=\"100%\">";
										$count = 4;$start=1;
										$wid = ceil(99/$count);
										while ($iconservice = $db->sql_fetchrow($iconservice_query))
										{												
												$iconservice_id = $iconservice['iconservice_id'];
												$iconservice_name = $iconservice['iconservice_name'];
												$iconservice_pic1 = $iconservice['iconservice_pic1'];
												$iconservice_status = $iconservice['iconservice_status'];

												if ( $start == 1) echo "<tr height=\"26\">";

												if (in_array($iconservice_id,$iconservice_allow)){
													echo "<td  width = \"$wid%\"><input type=\"checkbox\" name=\"iconservice[]\"  value=\"$iconservice_id\" checked>&nbsp;&nbsp;<img src='$iconservice_path/$iconservice_pic1' width='25' height='25' border='0'></td>";
												}else{
													echo "<td  width = \"$wid%\"><input type=\"checkbox\" name=\"iconservice[]\"  value=\"$iconservice_id\">&nbsp;&nbsp;<img src='$iconservice_path/$iconservice_pic1' width='25' height='25' border='0'></td>";
												}

												$start++;
												if ( $start > $count ) {
													$start =1;													
												}
										}

										if ($start > 1){
											if ($start != $count ){
												while( $start <= $count){
													echo "<td  width = \"$wid%\">&nbsp;</td>";
													$start++;
												}								
											}
										}
										echo "</tr></table>";
							}
							else
										echo " - ";							
				   ?>
              </div></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Accessories :</td>
            <td><input name="chkacc" type="checkbox" id="chkacc" value="1" <? if ($products_accessories==1) echo"checked"?> /></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">หมายเหตุ : </td>
            <td><input name="remark" type="text" id="remark" value="<? echo $products_remark; ?>" size="40" />
            </td>
          </tr>
          <tr>
            <td height="26" class="td_desc">Keyword : </td>
            <td><input name="keyword" type="text" id="keyword" value="<? echo $products_keyword; ?>" size="40" />
            </td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[41] ?>
              &nbsp;&nbsp;:&nbsp;&nbsp;<font color=red>**</font> </td>
            <td><select name="active">
                <option value="1" <?php if ($products_status ==1) echo 'selected="selected"';?>>Online</option>
                <option value="2" <?php if ($products_status ==2) echo 'selected="selected"';?>>Thai</option>
                <option value="3" <?php if ($products_status ==3) echo 'selected="selected"';?>>Eng</option>
                <option value="4" <?php if ($products_status ==4) echo 'selected="selected"';?>>Offline</option>
              </select></td>
          </tr>
          <tr>
            <td height="26" class="td_desc"><?=$arr_product_fieldname[45] ?>
              : &nbsp; <font color=red>**</font></td>
            <td><select name="promote">
                <option value="1" <?php if ($products_promote ==1) echo 'selected="selected"';?>>Online</option>
                <option value="2" <?php if ($products_promote ==2) echo 'selected="selected"';?>>Thai</option>
                <option value="3" <?php if ($products_promote ==3) echo 'selected="selected"';?>>Eng</option>
                <option value="4" <?php if ($products_promote ==4) echo 'selected="selected"';?>>Offline</option>
              </select></td>
          </tr>
          <tr>
            <td height="26" class="td_desc">&nbsp;</td>
            <td><input type="button"  value="    OK    " onMouseOver="onBtnOver(this,'<?=$theme_tab1?>')";  onMouseOut="onBtnOut(this)" onclick="javascript:checkvalues();">
              &nbsp;
              <input name="reset" type="reset" id="reset" value="  Reset  " onMouseOver="onBtnOver(this,'<?=$theme_tab1?>')";  onMouseOut="onBtnOut(this)">
            </td>
          </tr>
          <tr>
            <td height="25" colspan="2"><font size="-2" face="MS Sans Serif, Tahoma, sans-serif"><strong>&nbsp;&nbsp;Link 
              Action &gt; <a href="index.php?method=products&process=list">List Products</a> <a href="index.php?method=products&process=bdetail&products_id=<?=$products_id?>">Detail Products</a></strong></font></td>
          </tr>
          <tr>
            <td height="10">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
  </table>
</form>
<?
}
function bmodify()
{

			include"includes/global.php";
			global $postfix_lang,$lang,$products_path;

			extract($_POST);

			$iconservice =get_var('iconservice','request',0);
			$categories_id = $categories_id;
			$products_name= addslashes(stripslashes($products_name));
			$products_name_en= addslashes(stripslashes($products_name_en));
			$jb_no= addslashes(stripslashes($jb_no));
			$model=  addslashes(stripslashes($model));
			$type=  addslashes(stripslashes($type));
			$thinkness=  addslashes(stripslashes($thinkness));
			$volumn=  addslashes(stripslashes($volumn));
			//$loadcapacity=  addslashes(stripslashes($loadcapacity));
			$staticcapacity=  addslashes(stripslashes($staticcapacity));
			$dynamiccapacity=  addslashes(stripslashes($dynamiccapacity));
			$rackingload=  addslashes(stripslashes($rackingload));
			$standardlift=  addslashes(stripslashes($standardlift));
			$dimension=  addslashes(stripslashes($dimension));
			$platform=  addslashes(stripslashes($platform));
			$platformh1=  addslashes(stripslashes($platformh1));
			$height=  addslashes(stripslashes($height));
			$footplate=  addslashes(stripslashes($footplate));
			$wheeldia=  addslashes(stripslashes($wheeldia));
			$threadstemwheel=  addslashes(stripslashes($threadstemwheel));
			$n_partspanels=  addslashes(stripslashes($n_partspanels));
			$horizontal=  addslashes(stripslashes($horizontal));
			$vertical=  addslashes(stripslashes($vertical));
			$airpressure=  addslashes(stripslashes($airpressure));
			$deliverypressure=  addslashes(stripslashes($deliverypressure));
			$colour=  addslashes(stripslashes($colour));
			$setcontent=  addslashes(stripslashes($setcontent));
			$range=  addslashes(stripslashes($range));
			$female=  addslashes(stripslashes($female));
			$male=  addslashes(stripslashes($male));
			$n_sections=  addslashes(stripslashes($n_sections));
			$cuttingwire=  addslashes(stripslashes($cuttingwire));
			$slotted=  addslashes(stripslashes($slotted));
			$phillips=  addslashes(stripslashes($phillips));
			$n_smalldrawers=  addslashes(stripslashes($n_smalldrawers));
			$n_rollers=  addslashes(stripslashes($n_rollers));
			$material=  addslashes(stripslashes($material));
			$qtypack=  addslashes(stripslashes($qtypack));
			$price=  addslashes(stripslashes($price));
			$discountprice=  addslashes(stripslashes($discountprice));
            $products_promotion=($products_promotion);
			$description=  addslashes(stripslashes($description));
			$p_detail_th=  addslashes(stripslashes($p_detail_th));
			$p_detail_en=  addslashes(stripslashes($p_detail_en));
			
			$promotion_start_date=($promotion_start_date);
			$promotion_end_date=($promotion_end_date);			
				
                if ($cal_method =="") $cal_method = 0;  
				if ($cal_w =="" ) $cal_w = 0;  
				if ($cal_h =="" ) $cal_h = 0;  
				if ($cal_t =="") $cal_t = 0;  
				if ($cal_b =="") $cal_b = 0;  
				if ($cal_p =="" ) $cal_p = 0;  
				if ($cal_weight =="" ) $cal_weight = 0;  
			
		
						
			/*
				$jb_no =stripslashes(get_var('jb_no','request',0));
				$model =stripslashes(get_var('model','request',0));
				$capacity =stripslashes(get_var('capacity','request',0));
				$length =stripslashes(get_var('length','request',0));
				$wide =stripslashes(get_var('wide','request',0));
				$height =stripslashes(get_var('height','request',0));
				$price =stripslashes(get_var('price','request',0));
				$description =stripslashes(get_var('description','request',0));
				$p_detail =stripslashes(get_var('p_detail','request',0);
			


				/////////////////////////////////////////////////////////////////////////////////////////////////
				$jb_no =addslashes($jb_no);
				$model =addslashes($model);
				$capacity =addslashes($capacity);
				$length =addslashes($length);
				$wide =addslashes($wide);
				$height =addslashes($height);
				$price =addslashes($price);
				$description =addslashes($description);
			*/
				//////////////////////////////////////////////////////////////////////
				$iconservice = get_var('iconservice','request',0);
				$str_iconservice ="-";  //manage db
				foreach ( $iconservice as $j => $dat){
						$str_iconservice = $str_iconservice."$dat-";							
				}
				//echo "($str_iconservice)";
				//////////////////////////////////////////////////////////////////////

				$products_mainpic=get_var('spicture','request',0);
				$products_mainpic1=get_var('spicture1','request',0);
				$products_mainpic2=get_var('spicture2','request',0);
				$products_mainpic3=get_var('spicture3','request',0);
				/////////////////////////////////////////////////////////////////////////////////////////////////
				$active =get_var('active','request',0);
				$keyword =get_var('keyword','request',0);
				$products_remark=get_var('remark','request',0);
				$chkacc =get_var('chkacc','request',0);
				$chkpromote =get_var('chkpromote','request',0);
						
				$pic_default = get_var('pic_default','request',0);
				$delpic = get_var('delpic','request',0);
				$pic_default1= get_var('pic_default1','request',0);
				$delpic1 = get_var('delpic1','request',0);
				$pic_default2 = get_var('pic_default2','request',0);
				$delpic2 = get_var('delpic2','request',0);
				$pic_default3 = get_var('pic_default3','request',0);
				$delpic3 = get_var('delpic3','request',0);
				
				$dpic_default = get_var('dpic_default','request',0);
				$d2pic_default = get_var('d2pic_default','request',0);
				$logopic_default = get_var('logopic_default','request',0);
							
				/////////////////////////////update_mainpic//////////////////////////////////////////
				$spicture_n =  get_File('spicture', 'name');
				$spicture_f =  get_File('spicture', 'tmp_name');
				$save_id =$products_id;

				
				if ($pic_default)
				{
					$pic_default = getn("products_mainpic","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$pic_default"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_mainpic = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				if ($pic_default1)
				{
					$pic_default1 = getn("products_mainpic1","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$pic_default1"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_mainpic1 = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				if ($pic_default2)
				{
					$pic_default2 = getn("products_mainpic2","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$pic_default2"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_mainpic2 = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				if ($pic_default3)
				{
					$pic_default3 = getn("products_mainpic3","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$pic_default3"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_mainpic3 = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ( $spicture_n ) 
				{									
						$oldfile = getn("products_mainpic","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext = get_extension($spicture_n);
						$sproductspic = "productions_".createRandom()."_".$save_id.".".$pic_ext;
						if ( copy($spicture_f,"$products_path/$sproductspic"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_mainpic = '$sproductspic' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				/*--------------------------------------------------*/
				$spicture_n1 =  get_File('spicture1', 'name');
				$spicture_f1 =  get_File('spicture1', 'tmp_name');
				$save_id =$products_id;
				if ($pic_default1)
				{
					$pic_default1 = getn("products_mainpic1","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$pic_default1"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_mainpic1 = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ( $spicture_n1 ) 
				{									
						$oldfile = getn("products_mainpic1","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext1 = get_extension($spicture_n1);
						$sproductspic1 = "productions_".createRandom()."_".$save_id.".".$pic_ext1;
						if ( copy($spicture_f1,"$products_path/$sproductspic1"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_mainpic1 = '$sproductspic1' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
					/*--------------------------------------------------*/
			 	$spicture_n2 =  get_File('spicture2', 'name');
				$spicture_f2 =  get_File('spicture2', 'tmp_name');
				$save_id =$products_id;
				if ($pic_default2)
				{
					$pic_default2 = getn("products_mainpic2","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$pic_default2"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_mainpic2 = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ( $spicture_n2 ) 
				{									
						$oldfile = getn("products_mainpic2","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext2 = get_extension($spicture_n2);
						$sproductspic2 = "productions_".createRandom()."_".$save_id.".".$pic_ext2;
						if ( copy($spicture_f2,"$products_path/$sproductspic2"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_mainpic2 = '$sproductspic2' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				/*--------------------------------------------------*/
				$spicture_n3 =  get_File('spicture3', 'name');
				$spicture_f3 =  get_File('spicture3', 'tmp_name');
				$save_id =$products_id;
				if ($pic_default3)
				{
					$pic_default3 = getn("products_mainpic3","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$pic_default3"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_mainpic3 = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ( $spicture_n3 ) 
				{									
						$oldfile = getn("products_mainpic3","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext3 = get_extension($spicture_n3);
						$sproductspic3 = "productions_".createRandom()."_".$save_id.".".$pic_ext3;
						if ( copy($spicture_f3,"$products_path/$sproductspic3"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_mainpic3 = '$sproductspic3' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				/////////////////////////////////////////////////////////////////////////////////////////////
				$tpicture_n =  get_File('tpicture', 'name');
				$tpicture_f =  get_File('tpicture', 'tmp_name');
				$save_id =$products_id;

				
				if ($tpic_default)
				{
					$del_pic = getn("products_thumbpic","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$del_pic"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_thumbpic = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ( $tpicture_n ) 
				{									
						$oldfile = getn("products_thumbpic","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext = get_extension($tpicture_n);
						$tproductspic = "productions_".createRandom()."_".$save_id."_thumb.".$pic_ext;
						if ( copy($tpicture_f,"$products_path/$tproductspic"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Thumb Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Thumb Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_thumbpic = '$tproductspic' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				
				$dpicture_n =  get_File('dpicture', 'name');
				$dpicture_f =  get_File('dpicture', 'tmp_name');
				$save_id =$products_id;

				
				if ($dpic_default)
				{
					$dpic_default = getn("products_picDrawing","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$dpic_default"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_picDrawing = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ($dpicture_n) 
				{									
						$oldfile = getn("products_picDrawing","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext = get_extension($dpicture_n);
						$dproductspic = "productions_".createRandom()."_".$save_id.".".$pic_ext;
						if ( copy($dpicture_f,"$products_path/$dproductspic"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_picDrawing = '$dproductspic' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				$d2picture_n =  get_File('d2picture', 'name');
				$d2picture_f =  get_File('d2picture', 'tmp_name');
				$save_id =$products_id;

				
				if ($d2pic_default)
				{
					$dpic_default = getn("products_picDrawing2","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$d2pic_default"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_picDrawing2 = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ($d2picture_n) 
				{									
						$oldfile = getn("products_picDrawing2","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext = get_extension($d2picture_n);
						$d2productspic = "productions_".createRandom()."_".$save_id.".".$pic_ext;
						if ( copy($d2picture_f,"$products_path/$d2productspic"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_picDrawing2 = '$d2productspic' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				$logopicture_n =  get_File('logopicture', 'name');
				$logopicture_f =  get_File('logopicture', 'tmp_name');
				$save_id =$products_id;

				
				if ($logopic_default)
				{
					$logopic_default = getn("products_logo","products"," products_id = '$products_id' ");								
					if (unlink("$products_path/$logopic_default"))  echo  "del picdefault "; 
					
					$upfile_sql = sql_Update($prefix."_products","products_logo = ''  ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}

				if ($logopicture_n) 
				{									
						$oldfile = getn("products_logo","products"," products_id = '$products_id' ");
							if ($oldfile != "") {
								if (unlink("$products_path/$oldfile"))  echo  "del"; 
						}
						$pic_ext = get_extension($logopicture_n);
						$logoproductspic = "productions_".createRandom()."_".$save_id.".".$pic_ext;
						if ( copy($logopicture_f,"$products_path/$logoproductspic"))
						{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Small Picture Completed</font></center>";
								//echo "<BR>copy(".$picture_f[$i].",$bservice_path/".$bservicepic[$p].")";													
						}
						else{
								//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Small Picture Completed</font></center>";
						}
						
					echo $upfile_sql = sql_Update($prefix."_products","products_logo = '$logoproductspic' ",	"products_id = '$products_id'  ");
					$file_query = $db->sql_query($upfile_sql);
				}
				/////////////////////////////////////////////////////////////////////////////////////////////
				$detail_sql = sql_Select(1, $prefix."_products", "products_id = '$products_id'", 0);
				//echo  $detail_sql ;
				$detail_query = $db->sql_query($detail_sql);
				$products = $db->sql_fetchrow($detail_query);							
				
				$del_pic[1] = getn("products_pic1","products"," products_id = '$products_id' ");
				$del_pic[2] = getn("products_pic2","products"," products_id = '$products_id' ");
			
				$picture_n =  get_File('picture', 'name');
				$picture_f =  get_File('picture', 'tmp_name');
				$chkpic = get_var('chkpic','request',0);

				$save_id =$products_id;
							
				for($i=1;$i<=2;$i++)
				{
						if ( $picture_n[$i] ) 
						{
								unlink ("$products_path/$del_pic[$i]");
								$pic_ext = get_extension($picture_n[$i]);
								$productspic[$i] = "products_".createRandom()."_".$save_id."_".$i.".".$pic_ext;
								if ( copy($picture_f[$i],"$products_path/$productspic[$i]"))
								{
										//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red> Copy Picture Completed</font></center>";											
								}
								else{
										//echo "<center>  <font size=-1 face=MS Sans Serif, Tahoma, sans-serif color=red>Not Copy Picture Completed</font></center>";
								}
								$condition = $condition."products_pic$i = '$productspic[$i]' ,";
						}
						if ($delpic[$i])
						{
							$condition = $condition."products_pic$i = '' ,";
							if (unlink("$products_path/$del_pic[$i]"))  echo  "del pic$i"; 
							else echo "Fail ";
						}									
				}
				
				$upProducts_sql = sql_Update($prefix."_products","products_name='$products_name',products_name_en='$products_name_en',products_jb_no='$jb_no', $condition products_model='$model',products_type='$type',products_thinkness='$thinkness',products_volume='$volumn',products_capacity_static='$staticcapacity',products_capacity_dynamic='$dynamiccapacity',products_capacity_racking='$rakingload',products_standard_lift='$standardlift',products_dimension='$dimension',products_platform='$platform',products_platform_h1='$platformh1',products_height='$height',products_footplate='$footplate',products_wheeldia='$wheeldia',products_threadstemwheel='$threadstemwheel',products_numberofpartspanels='$n_partspanels',products_horizontal='$horizontal',products_vertical='$vertical',products_airpressure='$airpressure',products_deliverypressure='$deliverypressure',products_setcontent='$setcontent',products_colour='$colour',products_range='$range',products_female='$female',products_male='$male',products_numberofsection='$n_sections',products_cuttingwire='$cuttingwire',products_slotted='$slotted',products_phillips='$phillips',products_small_drawers='$n_smalldrawers',products_rollers='$n_rollers',products_material='$material',products_qtypack='$qtypack',products_price='$price',products_discountprice='$discountprice',products_promotion='$products_promotion',products_description='$description',products_status='$active',products_modify=NOW(),products_promote='$promote',products_keyword='$keyword',products_icon='$str_iconservice',products_detail='$p_detail_th' ,products_detail_en='$p_detail_en' ,products_cal_method='$cal_method',			products_cal_w='$cal_w',			products_cal_h='$cal_h',			products_cal_t='$cal_t',			products_cal_b='$cal_b',			products_cal_p='$cal_p',			products_cal_weight='$cal_weight',products_accessories='$chkacc',promotion_start_date='$promotion_start_date',promotion_end_date='$promotion_end_date',products_remark='$products_remark'","products_id = '$products_id'");																						
				//$upProducts_sql = sql_Update($prefix."_products","products_name='$products_name',products_name_en='$products_name_en',products_jb_no='$jb_no', $condition products_model='$model',products_type='$type',products_thinkness='$thinkness',products_volume='$volumn',products_capacity_static='$staticcapacity',products_capacity_dynamic='$dynamiccapacity',products_capacity_racking='$rakingload',products_standard_lift='$standardlift',products_dimension='$dimension',products_platform='$platform',products_platform_h1='$platformh1',products_height='$height',products_footplate='$footplate',products_wheeldia='$wheeldia',products_threadstemwheel='$threadstemwheel',products_numberofpartspanels='$n_partspanels',products_horizontal='$horizontal',products_vertical='$vertical',products_airpressure='$airpressure',products_deliverypressure='$deliverypressure',products_setcontent='$setcontent',products_colour='$colour',products_range='$range',products_female='$female',products_male='$male',products_numberofsection='$n_sections',products_cuttingwire='$cuttingwire',products_slotted='$slotted',products_phillips='$phillips',products_small_drawers='$n_smalldrawers',products_rollers='$n_rollers',products_material='$material',products_qtypack='$qtypack',products_price='$price',products_discountprice='$discountprice',products_description='$description',products_status='$active',products_modify=NOW(),products_promote='$promote',products_keyword='$keyword',products_icon='$str_iconservice',products_detail='$p_detail_th' ,products_detail_en='$p_detail_en' ,products_cal_method='$cal_method',			products_cal_w='$cal_w',			products_cal_h='$cal_h',			products_cal_t='$cal_t',			products_cal_b='$cal_b',			products_cal_p='$cal_p',			products_cal_weight='$cal_weight',products_accessories='$chkacc',promotion_start_date='$startdate',promotion_end_date='$expdate'","products_id = '$products_id'");
				//echo $upProducts_sql;   exit();

				$save_query = $db->sql_query($upProducts_sql);

				if ($save_query)
				{
					$msg = "<font color=blue>SUCCESS !!</font> Update Products on success."."Start =".$promotion_start_date."End Date =".$promotion_end_date."products_promotion =".$products_promotion;
				}
				else
				{
						$msg = "<font color=red>ERROR !!</font> can not  Update Products .";
				}
		$loc = "index.php?method=products&process=bdetail&cate_id=$cate_id&collection_id=$collection_id&products_id=$products_id&msg=$msg";
		//echo "<br>".$loc;
		echo "<script language=\"JavaScript\">document.location = \"$loc\";	</script>";
}

function bswapdisplay()
{
			
							global $db;	
							global $prefix;
							global  $news_path;

							$products_id =get_var('products_id','request',0);
							$cate_id = get_var('cate_id','request',0);
							$display = get_var('display','request',0);

							$c_page = get_var('c_page','request',0);
							$per_page = get_var('per_page','request',0);
							$sequence = get_var('sequence','request',0);
							$selectfield = get_var('selectfield','request',0);
							$search_ = get_var('search_','request',0);

							$link_ = "&c_page=$c_page&per_page=$per_page&sequence=$sequence&selectfield=$selectfield&search_=$search_";
							
							$updatedisplay  = sql_Update($prefix."_products","products_status=$display ","products_id = '$products_id'  ");
							
							
							//echo $updatedisplay;	
							$save_query = $db->sql_query($updatedisplay);
					
							if($save_query)
							{	
										$msg = "<font color=blue>SUCCESS !!</font> Update Products on success.";
										//echo $msg;
										if ( ($selectfield) or  ($search_) )
										{
											$loc = "index.php?method=products&process=blistsearch&cate_id=$cate_id$link_&msg=$msg";	
										}
										else
										{
											$loc = "index.php?method=products&process=blist&cate_id=$cate_id$link_&msg=$msg";	
										}	
							}
							else
							{
									$msg = "<font color=red>ERROR !!</font> can not Update Products .";
									//echo $msg;
									if ( ($selectfield) or  ($search_) )
										{
											$loc = "index.php?method=products&process=blistsearch&cate_id=$cate_id$link_&msg=$msg";	
										}
										else
										{
											$loc = "index.php?method=products&process=blist&cate_id=$cate_id$link_&msg=$msg";	
										}	
							}

							echo "<script language=\"JavaScript\">document.location = \"$loc\";</script>";
} 