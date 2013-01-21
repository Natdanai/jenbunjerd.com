<?php
//header('Content-type: text/plain; charset=TIS-620');

function Result_Msg($ResultMessge,$url,$time){					
	echo"		<div align='center'> 
					<table width='90%' height='200' bgcolor='#000000' border='0' align='center' cellpadding='0' cellspacing='1'>
						<tr> 
						  <td>
						    <table width='100%' height='200' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' >
								<tr>
								<td>
								  <table width='98%' height='200' border='0' align='center' cellpadding='0' cellspacing='0' bgcolor='#FFFFFF' >
									<tr>
									<td height='2'>
									</td>
									</tr>
									<tr> 
									  <td height='30' valign='middle' background='images/bg_td.jpg'>
										  &nbsp;&nbsp;&nbsp;<font color='#FFFFFF' size='2'><strong>• Result Process</strong></font>
										</td>
									</tr>
									<tr> 
									  <td><div align='center'></div>
										<div align='center'>
										  <font color='#FF0000' size='2'> <strong>$ResultMessge </strong></font></div>
										<div align='center'></div></td>
									</tr>
								  </table>
								</td>
							</tr>
						</table>
						</td>
						</tr>
					  </table>
					</div>";
				  echo "<meta http-equiv='refresh' content='$time; URL=$url'> ";
}
function valid_email($add)
{
	$com = "^.+@.+\..+$";
	if ( ereg($com,$add))
		return true;
	else 
		return false;
}

function check_admin()
{	
				global $db;
				global $prefix;
				global $admin_user,$SessionID;

				$username = $_SESSION[$SessionID]['usernameadmin'];
				$password= $_SESSION[$SessionID]['passwordadmin'];
	   
				$ip_user = $_SERVER["REMOTE_ADDR"];

	   					
				$sql = sql_Select(1, $prefix."_admin", "admin_username='$username' and admin_password = '$password' and admin_status=1", 0);
				//echo $sql;
						
				$query = $db->sql_query($sql);
				$row = $db->sql_fetchrow($query);
											
				$ip_login= $row['admin_ip'];
				//$session_ =$row[admin_session];
				$active = $row['admin_status'];				
				
				if ( ($ip_login==$ip_user) and ($_SESSION[$SessionID]['admin_user']) and ($active == 1) )
			      {           
											//echo "(1)";
											return true;
				  }
				else
				 {		
											//echo "(2)";
											return false;
				  }
	
}

function Date_to_Time($strtime)
{
		//  Ex     2007-10-21
		$strtime_d = substr($strtime,8,2); 
		$strtime_m = substr($strtime,5,2); 
		$strtime_y = substr($strtime,0,4); 
		$strtime_day = strtotime("$strtime_m/$strtime_d/$strtime_y");
		return $strtime_day;
}

function DateThai_to_Time($strtime)
{
		//  Ex     21/10/2550
		$strtime_d = substr($strtime,0,2); 
		$strtime_m = substr($strtime,3,2); 
		$strtime_y = substr($strtime,6,4); 
		$strtime_y = $strtime_y-543;  		//echo "$strtime_d/$strtime_m/$strtime_y<br>";
		$strtime_day = strtotime("$strtime_m/$strtime_d/$strtime_y");
		return $strtime_day;
}

function DateEng_to_Time($strtime)
{
		//  Ex     21/10/2007
		$strtime_d = substr($strtime,0,2); 
		$strtime_m = substr($strtime,3,2); 
		$strtime_y = substr($strtime,6,4); 
		//echo "$strtime_d/$strtime_m/$strtime_y<br>";
		$strtime_day = strtotime("$strtime_m/$strtime_d/$strtime_y");
		return $strtime_day;
}

function Time_to_DateThai($timedate)
{
		//  Ex     21/10/2550
		$yThai = date('Y',$timedate)+543; 
		$d1 = date("d/m/$yThai",$timedate);
		return $d1;
}

function Time_to_DateEng($timedate)
{
		//  Ex     21/10/2007
		$d1 = date("d/m/y",$timedate);
		return $d1;
}

function CheckExpireDate($DateA,$ValueExpired){		
		$now = Date('Y-m-d');
		$isnow = Date_to_Time($now);
		$itemdate = Date_to_Time($DateA);
		
		$itemtime = (($itemdate  - $isnow)/86400) ; 

		if ( $ValueExpired >= $itemtime)   return true;
		else return false;

}

function RangeDate($startdate,$enddate){
		$day1 = Date_to_Time($startdate);
		$day2 = Date_to_Time($enddate);
		$n_day = (($day2  - $day1)/86400) ; // cut checkout 

		$i = 0; $cal_date = $day1;
		$str_date = "";
		while ($i < $n_day) {  // count 0

			$ddd = date("Y-m-d",$cal_date);
			$str_date .= ", '$ddd' ";

			$cal_date = $cal_date + 86400;
			$i++;
		}
		$str_date = substr($str_date,1);

		return $str_date;
}

function get_Month($var, $mode){
		$thaimonth = array(01 => '??????', '??????????', '??????', '??????', '???????', '???????', '???????', '??????', '???????', '??????' , '?????????', '???????');

		$ret = "";
		if($mode == 'eng'){
			// english
			$ret = date("F", mktime(0, 0, 0, $var, 1, 0));
		}
		else if($mode == 'thai'){
			// thai
			$ret = $thaimonth[intval($var)];
		}
		return $ret;
	}
function checkname($fieldname,$tablename)
{
			global $db;
			global $prefix;	

			echo $check_sql=sql_Select($fieldname,$prefix."_".$tablename," $fieldname = '$checkname' ",0);
			$checkname_query=$db->sql_query($check_sql);
			$row = $db->sql_fetchrow($checkname_query);	
			$checkname_num=$db->sql_numrows($checkname_query);

			return $checkname_num;
}
function getn($field,$tbl,$where)
{
			global $db;
			global $prefix;

			$sql = sql_Select($field, $prefix."_".$tbl,$where,"");
			//echo $sql;
						
			$query = $db->sql_query($sql);
			$row = $db->sql_fetchrow($query);
			$totalrec = $db->sql_numrows($query);
			if 	( $totalrec > 0 )							
				$name= $row[0];
			else
				$name = false;
			return $name;							
}

function getarr($field,$tbl,$where)
{
			global $db;
			global $prefix;

			$sql = sql_Select($field, $prefix."_".$tbl,$where,0);
			//echo $sql;
						
			$query = $db->sql_query($sql);
			$totalrec = $db->sql_numrows($query);
			//print_r()
			if 	( $totalrec > 0 ){
				while ($row = $db->sql_fetchrow($query))
					$arr_data[] = $row[0];
			}
			else{
				$arr_data = false;
			}

			return $arr_data;							
}

function getarrlist($field,$tbl,$where)
{
			global $db;
			global $prefix;

			$sql = sql_Select($field, $prefix."_".$tbl,$where,0);
			//echo $sql;
						
			$query = $db->sql_query($sql);
			$totalrec = $db->sql_numrows($query);
			//print_r()
			$list_data = "";
			if 	( $totalrec > 0 ){
				while ($row = $db->sql_fetchrow($query))
					$list_data .= ",".$row[0];
			}
			else{
				$arr_data = false;
			}
			if (strlen($list_data) > 0 ) $list_data = substr($list_data,1);
			return $list_data;
}
function DropdownTitle($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- กรุณาเลือกคำนำหน้าชื่อ  -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_title",1,"title_id");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['title_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['title_id'] . "\" selected>" . stripslashes($row['title_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['title_id'] . "\">" . stripslashes($row['title_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ ไม่มีข้อมูล ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}
function DropdownARCODE($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- โปรดเลือก AR - CODE  -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_arcode",1,"jb_company_name");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['jb_arcode'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['jb_arcode'] . "\" selected>" . stripslashes($row['jb_company_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['jb_arcode'] . "\">" . stripslashes($row['jb_company_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ ไม่มีข้อมูล ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}
function DropdownBusinessMain($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- โปรดเลือกประเภทธุรกิจ  -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_business_type_main",1,"business_main_id");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['business_main_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['business_main_id'] . "\" selected>" . stripslashes($row['business_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['business_main_id'] . "\">" . stripslashes($row['business_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ ไม่มีข้อมูล ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}
function DropdownBusinessSub($varname, $defaultvalue, $firstblank=false, $script=false,$business_main){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- โปรดเลือกประเภทธุรกิจย่อย  -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_business_type_sub","business_main_id='$business_main' ","business_sub_name");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['business_sub_code'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['business_sub_code'] . "\" selected>" . stripslashes($row['business_sub_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['business_sub_code'] . "\">" . stripslashes($row['business_sub_name']) . "</option>\n";
			}
		}
			$ret .= "  </select>\n";
	} 

	
	return $ret;
}
function DropdownComingBy($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- Please Your Coming By -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_comingby",1,"comingby_id");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['comingby_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['comingby_id'] . "\" selected>" . stripslashes($row['comingby_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['comingby_id'] . "\">" . stripslashes($row['comingby_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ No Data ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}
function DropdownDestination($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- Please Your Destination -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_destination",1,"destination_id");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['destination_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['destination_id'] . "\" selected>" . stripslashes($row['destination_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['destination_id'] . "\">" . stripslashes($row['destination_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ No Data ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}

function DropdownTransferType($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- Please Your Transfering Type -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_transfertype","transfertype_status = 1","transfertype_name");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['transfertype_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['transfertype_id'] . "\" selected>" . stripslashes($row['transfertype_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['transfertype_id'] . "\">" . stripslashes($row['transfertype_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ No Data ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}

function DropdownProvince($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- กรุณาเลือกจังหวัด  -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_province",1,"province_name");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['province_code'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['province_code'] . "\" selected>" . stripslashes($row['province_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['province_code'] . "\">" . stripslashes($row['province_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ ไม่มีข้อมูล ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}
function DropdownAmphur($varname, $defaultvalue, $firstblank=false, $script=false,$province){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- กรุณาเลือกเขตหรืออำเภอ  -</option>\n";
	}
	
	$sql = sql_Select(" * ", $prefix."_amphur","province_code ='$province'","amphur_name");	
	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['amphur_code'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['amphur_code'] . "\" selected>" . stripslashes($row['amphur_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['amphur_code'] . "\">" . stripslashes($row['amphur_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ ไม่มีข้อมูล ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}
function DropdownDistrict($varname, $defaultvalue, $firstblank=false, $script=false,$amphur){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- กรุณาเลือกตำบล  -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_district","amphur_code='$amphur'","district_name");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['district_code'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['district_code'] . "\" selected>" . stripslashes($row['district_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['district_code'] . "\">" . stripslashes($row['district_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ ไม่มีข้อมูล ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}

function DropdownProvinceEng($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- Please Select Province  -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_province",1,"province_name_e");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['province_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['province_id'] . "\" selected>" . stripslashes($row['province_name_e']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['province_id'] . "\">" . stripslashes($row['province_name_e']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ No Data ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}


function DropdownCountry($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- Please Your Country -</option>\n";
	}

	$sql = sql_Select(" * ", $prefix."_country",1,"country_id");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['country_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['country_code'] . "\" selected>" . stripslashes($row['country_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['country_code'] . "\">" . stripslashes($row['country_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ No Data ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}

function DropdownRegion($varname, $defaultvalue, $firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- ???????????-</option>\n";
	}

	$sql = sql_Select(" distinct(region_code) ", $prefix."_province",1,"region_code");	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['region_code'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['region_code'] . "\" selected>" . stripslashes($row['region_code']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['region_code'] . "\">" . stripslashes($row['region_code']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ No Data ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}

function DropdownProvince2($varname, $defaultvalue, $region_code,$firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\">- Please Select Province -</option>\n";
	}

	//echo "($region_code)";

	if ($region_code){
		$sql = sql_Select(" * ", $prefix."_province"," region_code = '$region_code' ","province_id");	//echo $sql;
	}
	else {
		$sql = sql_Select(" * ", $prefix."_province",1,"province_id");	//echo $sql;
	}

	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row['province_id'] == $defaultvalue) {
				$ret .= "<option value =\"" . $row['province_id'] . "\" selected>" . stripslashes($row['province_name']) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row['province_id'] . "\">" . stripslashes($row['province_name']) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ No Data ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}

function DropdownData($varname, $defaultvalue,$sql ,$firstblank=false, $script=false){

	global $db;
	global $prefix;	

	if ($script){
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" $script>\n";
	}
	else {
		$ret = "<select name=\"$varname\" id=\"$varname\" size=\"1\" >\n";
	}

	if ($firstblank) {
		$ret .= "<option value =\"\"> - Please Select Data - </option>\n";
	}
	//echo $sql;
	$query = $db->sql_query($sql);
	$totalrec = $db->sql_numrows($query);

	if ($totalrec > 0 ) {
		while($row = $db->sql_fetchrow($query)) {
			if ($row[0] == $defaultvalue) {
				$ret .= "<option value =\"" . $row[0] . "\" selected>" . stripslashes($row[1]) . "</option>\n";
			} else {
				$ret .= "<option value =\"" . $row[0] . "\">" . stripslashes($row[1]) . "</option>\n";
			}
		}
	} else {
		$ret .= "<option value =\"\">------ Empty ------</option>\n";
	}
	$ret .= "  </select>\n";
	
	return $ret;
}


function resize($img,$w,$h)
{

#???????? 

$temp = explode(".",$img);

switch($temp[1]) {
           case "GIF":
			   $src_img = imageCreateFromGif($img);
			   break;
           case "JPG":
			   $src_img = imageCreateFromJpeg($img);
			   break;
           case "PNG":
			   $src_img = imageCreateFromPng($img);
			   break;
			case "BMP":
				$src_img = imagecreatefromgd($img);
				break;
	}


//$src_img=imagecreatefromjpeg($img); 
$getsize=getimagesize($img); 
$old_w=$getsize[0]; 
$old_h=$getsize[1]; 



#???????????????????? 
if (($old_w<$w) and ($old_h<$h)) { 
	$new_h=$old_h; 
	$new_w=$old_w; 
} 
else { 
	if ($old_w>$old_h) { 
	$how=$old_w/$w; 
	$new_w=floor($old_w/$how); 
	$new_h=floor($old_h/$how); 
	} 
	else { 
	$how=$old_h/$h; 
	$new_w=floor($old_w/$how); 
	$new_h=floor($old_h/$how); 
	} 
} 

$dst_img=imagecreatetruecolor($new_w,$new_h); 
$aa = imagecopyresampled($dst_img,$src_img,0,0,0,0,$new_w,$new_h,$old_w,$old_h); 

imagejpeg($dst_img,'',90); 
imagedestroy($src_img); 
imagedestroy($dst_img); 

//$a = get_loaded_extensions();
//print_r($a);
}
?>