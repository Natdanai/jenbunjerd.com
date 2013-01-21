<?
//$categories_id = 1; // get  discount 1% for products in this categories;
$Array_NoDiscount = array(1);

function checkincatediscount($productsid){
		global $db;
		global $prefix;
		global $Array_NoDiscount;
		
		include "config.php";
		//echo "533";
		$p_cateid = getn("categories_id","products","products_id = '$productsid' ");
		//echo "cateid = $p_cateid <br>";
		$_level = getn("categories_level","categories","categories_id = '$p_cateid' ");
		//echo "_level = $_level <br>";
		$str= $p_cateid;
		while($_level > 0){
			//echo "$_level : select * from jenbunjerd_categories where categories_id = '$p_cateid' <br> ";
			$RS = $db->sql_query("select * from jenbunjerd_categories where categories_id = '$p_cateid'");
			$result = $db->sql_fetchrow($detail_query);	
			$cate_id = $result['categories_id'];
			$name_eng = $result['categories_name_en'];
			$_level = $result['categories_level'];			
			$p_cateid = $result['categories_parent'];
			$str = $str." > ($p_cateid) ";
			$_level--;
		}
		//echo "$str";
		if (in_array($p_cateid,$Array_NoDiscount)) return 0;
		else return 1;
}
/*
echo checkincatediscount(3422)."<br>";
echo checkincatediscount(3967)."<br>";
echo checkincatediscount(2422)."<br>";
echo checkincatediscount(3428)."<br>";
echo checkincatediscount(245)."<br>";
echo checkincatediscount(3452)."<br>";
*/


function additem($itemid,$amo)
{
		global $db;	
		global $prefix;		
		global $tax; //จากตาราง settting 
		global $o_id,$c_id;
		global $idsession;
		global $setting_discount;

		$c_id = $_SESSION['members_id'];
		//echo $amo;exit;
		
		if (!$o_id){//ยังไม่มีเลขที่ใบสั่งซื้อ

			if ($c_id){
				$sql = sql_Select(1,$prefix."_members", "members_id = '$c_id' ", 0);
				//echo $sql;	exit;
				$query = $db->sql_query($sql);
				$result = $db->sql_fetchrow($query);				
				
				$members_id=stripslashes($result['members_id']);
				$members_title=stripslashes($result['members_title']);
				$members_fname=stripslashes($result['members_fname']);
				$members_lname=stripslashes($result['members_lname']);
				$members_email=stripslashes($result['members_email']);
				$members_pass=stripslashes($result['members_pass']);
				$members_phone_number=stripslashes($result['members_phone_number']);
				$members_jobtitile=stripslashes($result['members_jobtitile']);
				$members_department=stripslashes($result['members_department']);
				$members_statuscontact=stripslashes($result['members_statuscontact']);
				$members_active=stripslashes($result['members_active']);
				$members_bill_title=stripslashes($result['members_bill_title']);
				$members_bill_fname=stripslashes($result['members_bill_fname']);
				$members_bill_lname=stripslashes($result['members_bill_lname']);
				$members_bill_phone=stripslashes($result['members_bill_phone']);
				$members_bill_company=stripslashes($result['members_bill_company']);
				$members_bill_address1=stripslashes($result['members_bill_address1']);
				$members_bill_district_code=stripslashes($result['members_bill_district_code']);
				$members_bill_amphur_code=stripslashes($result['members_bill_amphur_code']);
				$members_bill_province_code=stripslashes($result['members_bill_province_code']);
				$members_bill_postcode=stripslashes($result['members_bill_postcode']);
				$members_bill_country=stripslashes($result['members_bill_country']);
				$members_shipping_title=stripslashes($result['members_shipping_title']);
				$members_shipping_fname=stripslashes($result['members_shipping_fname']);
				$members_shipping_lname=stripslashes($result['members_shipping_lname']);
				$members_shipping_phone=stripslashes($result['members_shipping_phone']);
				$members_shipping_company=stripslashes($result['members_shipping_company']);
				$members_shipping_address1=stripslashes($result['members_shipping_address1']);
				$members_shipping_district_code=stripslashes($result['members_shipping_district_code']);
				$members_shipping_amphur_code=stripslashes($result['members_shipping_amphur_code']);
				$members_shipping_province_code=stripslashes($result['members_shipping_province_code']);
				$members_shipping_postcode=stripslashes($result['members_shipping_postcode']);
				$members_shipping_country=stripslashes($result['members_shipping_country']);
				
			}
			else{		// ไม่ได้ login
				$order_name = "";
				$order_address = "";
				$order_receiver ="";
				$order_receiver_add = "";
				$members_bill_title = 0;
				$members_shipping_title = 0;
				$c_id = 0;
				
			}
			
			$day = date("Y-m-d");$time = date("H:i:s");
			$order_sql = sql_insert($prefix."_order"," order_date,order_time,order_tax,order_total,order_note,order_status,members_id,order_sessionid,order_bill_title,order_bill_fname,order_bill_lname,order_bill_phone,order_bill_company,order_bill_address,order_bill_district_code,order_bill_amphur_code,order_bill_province_code,order_bill_postcode,order_bill_country,order_shipping_title,order_shipping_fname,order_shipping_lname,order_shipping_phone,order_shipping_company,order_shipping_address,order_shipping_district_code,order_shipping_amphur_code,order_shipping_province_code,order_shipping_postcode,order_shipping_country "," '$day','$time','0','0','','','$c_id','$idsession','$members_bill_title','$members_bill_fname','$members_bill_lname','$members_bill_phone','$members_bill_company','$members_bill_address1','$members_bill_district_code','$members_bill_amphur_code','$members_bill_province_code','$members_bill_postcode','$members_bill_country','$members_shipping_title','$members_shipping_fname','$members_shipping_lname','$members_shipping_phone','$members_shipping_company','$members_shipping_address1','$members_shipping_district_code','$members_shipping_amphur_code','$members_shipping_province_code','$members_shipping_postcode','$members_shipping_country' ");
			//echo $order_sql;	 exit;
			//echo "<script>alert('$order_sql');</script>";
			
			$save_query = $db->sql_query($order_sql);
			$this_id = $db->sql_nextid();
			$_SESSION['o_id'] = $this_id; //กำนหดค่าให้ session เก็บไว้
			
			if ($_SESSION['o_id'] > 0){
				// เพิ่ม item
				$ch_p_id = getn("products_id","order_b","order_id = '".$_SESSION['o_id']."' and products_id = '$itemid' " );  //หาสินค้านี้ใน order นั้น
				
				if ($ch_p_id <> $itemid ){  //สินค้านี้ไม่มีในใบสั่งซื้อ
					//$discount_price = getn("products_discountprice","products","products_id = $itemid");  // Include table
                    $discount_price = getDiscountPrice($itemid);
					//$p_price = getn("products_price","products","products_id = $itemid");
                    $p_price = getPrice($itemid);
					if ($discount_price == 0 || $discount_price == "") $now_price = $p_price ;
					else $now_price = $discount_price ;

					if (checkincatediscount($itemid) ){
						// get discount %
						$discount_percent_baht = $now_price * ($setting_discount/100);
					}
					else $discount_percent_baht =0;
					
					$dif_price = $p_price - $now_price;
					$sql_additem = sql_insert($prefix."_order_b","order_id,products_id,price,amount,discountprice,discount_percent_baht,discount_percent,createdatetime","'".$_SESSION['o_id']."','$itemid','$now_price',$amo,$dif_price,'$discount_percent_baht','$setting_discount',Now()"); echo //$sql_additem; exit;
					$save_query = $db->sql_query($sql_additem);
					/*echo "<script>alert('A.1');</script>";*/
				}
				else{ //สินค้ามีแล้ว	
					$ob_id = getn("orderb_id","order_b","order_id = '".$_SESSION['o_id']."' and products_id = '$itemid' " );  //หาสินค้านี้ใน order นั้น			
					$update  =  sql_Update($prefix."_order_b","amount=amount+$amo ","orderb_id = '$ob_id'  ");   //echo $update;
					$save_query = $db->sql_query($update);
					/*echo "<script>alert('A.2');</script>";*/
				}
			}
			//exit;
			/*echo "<script>alert('A');</script>";*/
		}
		else{
			if ($_SESSION['o_id'] > 0){
				// เพิ่ม item
			//echo "Tee";
				$ch_p_id = getn("products_id","order_b","order_id = '".$_SESSION['o_id']."' and products_id = '$itemid' " );  //หาสินค้านี้ใน order นั้น
				
				if ($ch_p_id <> $itemid ){  //สินค้านี้ไม่มีในใบสั่งซื้อ
					//$discount_price = getn("products_discountprice","products","products_id = $itemid");
                    $discount_price = getDiscountPrice($itemid); //Anon Update 15-01-2013
					//$p_price = getn("products_price","products","products_id = $itemid");					 
					$p_price = getPrice($itemid); //Anon Update 15-01-2013
                    if ($discount_price == 0 || $discount_price == "") $now_price = $p_price ;
					else $now_price = $discount_price ;

					if (checkincatediscount($itemid) ){
						// get discount %
						$discount_percent_baht = $now_price * ($setting_discount/100);
					}
					else $discount_percent_baht =0;
					$dif_price = $p_price - $now_price;
					$sql_additem = sql_insert($prefix."_order_b","order_id,products_id,price,amount,discountprice,discount_percent_baht,discount_percent,createdatetime","'".$_SESSION['o_id']."','$itemid','$now_price',$amo,$dif_price,'$discount_percent_baht','$setting_discount',Now()");   
					//echo $sql_additem;  exit;
					$save_query = $db->sql_query($sql_additem);
				}
				else{ //สินค้ามีแล้ว	
					$ob_id = getn("orderb_id","order_b","order_id = '".$_SESSION['o_id']."' and products_id = '$itemid' " );  //หาสินค้านี้ใน order นั้น			
					$update  =  sql_Update($prefix."_order_b","amount=amount+$amo ","orderb_id = '$ob_id'  ");  // echo $update;
					$save_query = $db->sql_query($update);
				}
				
			}
			
			/*echo "<script>alert('B');</script>";*/
		}

		//exit;
		
}

// ตอน update จะส่งค่า orderb_id (autorun ของ order_broducts)
function updateitem($ob_id,$amo2)
{
			global $db;	
			global $prefix;		
			$update  = sql_Update($prefix."_order_b","amount=$amo2 ","orderb_id = '$ob_id' "); //echo $update;
			$save_query = $db->sql_query($update); // exit;
}

//ยกเลิกสินค้านี้
function deleted($ob_id)
{
		global $db;	
		global $prefix;		
		$delete_sql = sql_delete($prefix."_order_b", "orderb_id = '$ob_id' ");		//echo  $delete_sql;
		$delete_query = $db->sql_query($delete_sql);	//exit;
		session_unregister("promotion");
}

//ยกเลิกใบสั่งสินค้านี้
function orderdeleted()
{
		global $db;	
		global $prefix,$o_id;		

		//$o_id = $_SESSION['o_id'];
		
		$update  = sql_Update($prefix."_order","order_status='Deleted' ","order_id = '$o_id' "); //echo $update;
		$save_query = $db->sql_query($update);		
		
		/*$delete_sql = sql_delete($prefix."_order_b", "order_id = '$o_id' ");		//echo  $delete_sql;
		$delete_query = $db->sql_query($delete_sql);
	
		$delete_sql = sql_delete($prefix."_order", "order_id = '$o_id' ");		//echo  $delete_sql;
		$delete_query = $db->sql_query($delete_sql);*/
		//$_SESSION['o_id'] = null;
		session_unregister("o_id");
		session_unregister("promotion");
}

?>