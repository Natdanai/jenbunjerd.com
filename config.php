<?php
	error_reporting(0);
	/*
	database name : hausbang_hausbangkok
	user hausbang_hausban with the password bangk0k.
	*/
	set_time_limit(0);
	require_once("genpassword.php");
	
	$dbhost 			= "localhost";
	$dbuname 		= "root";
	//$dbpass 			= "mysqljb";
	$dbpass 			= "";
    $dbname             = "jb-17-01-2013";
	//$dbname 			= "jb";
	//$dbname				= "jb20-12-2012";
	//$dbname 			= "hausbang_hausbangkok-";
	$dbtype 			= "MySQL";
	$prefix				= "jenbunjerd";
	//$base				= "";
	
	$sBasePath = "../js_v2/";	
	$banner_path= "data-file/banner";
	$products_path= "data-file/products";
	$categories_path= "data-file/categories";
	$news_path= "data-file/news";
	$iconservice_path= "data-file/iconservice";	
	$reward_path= "data-file/reward";	
	$postfix_lang = Array("_th","_en");
	$lang = Array("(Thai)","(Eng)");
	$application_path= "backend/data-file/application";

    require_once($base."database/db.php");
	require_once($base."function/appfile.php");
	require_once($base."function/func_sql.php");
	require_once($base."function/date_th.php");
	require_once($base."function/general.php");
	require_once($base."function/libmail.php");
	require_once($base."function/functions.php");
	require_once($base."function/allotment_func.php");
	require_once($base."function/products.php");
//	require_once($base."function/nocache.inc.php");

	$sql = sql_Select(1, $prefix."_setting", "setting_id =1", 0);
			
	$query = $db->sql_query($sql);
	$setting = $db->sql_fetchrow($query);
	
	$ww = $setting['setting_width'];
	$hh =$setting['setting_height'];
	$shh = $setting['setting_sheight'];
	$sww  = $setting['setting_swidth'];	
	$perpage = $setting['setting_per_rec'];	
	$fperpage = $setting['setting_per_rec_f'];
	$setting_expired = $setting['setting_alertexpired'];	
	$setting_tax = $setting['setting_tax'];
	$setting_bahtperpoint = $setting['setting_bahtperpoint'];	
	$setting_discount = $setting['setting_discount'];	
	//$per_page = 5;	
	
	$arr_path = explode("/",$PHP_SELF);
	if (!$thispage) $thispage = $arr_path[count($arr_path)-1];	


?>