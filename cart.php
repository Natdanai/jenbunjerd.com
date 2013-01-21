<?
session_start();
set_time_limit(0);
$base = "";
require_once($base."config.php");
require_once($base."functionitem.php");

if($_SESSION['promotion'] == $_REQUEST[promotion] || $_REQUEST[promotion]==""){}
else{$_SESSION['promotion'] = $_REQUEST[promotion];}

$todo = get_var('todo','request',0);

$prodid = get_var('products_id','request',0);
$namount = get_var('namount','request',0);
$amo2 =  get_var('amo2','request',0);
$ob_id =  get_var('ob_id','request',0);

$c_id =$_SESSION['members_id'];
$fname= $_SESSION['fname'];  
$lname = $_SESSION['lname'];
$o_id = $_SESSION['o_id'];

//print_r($_SESSION);
//print_r($_REQUEST);

switch ($todo)
{		
		case  "additem"			:		if ($namount > 0 ) additem($prodid,$namount);  else echo "<script>history.go(-1);</script>";break;
		case  "updateitem"		:		if ($amo2 > 0) updateitem($ob_id,$amo2); else deleted($ob_id);  break;		
		case  "deleted"				:		deleted($ob_id); break;   // $ob_id  is autorun id  of  tbl  smchem_order_p
		case  "orderdeleted"  :		orderdeleted(); break;
}


/*
if ($pop){ // popup
header("location:popup_viewitem.php");
}
else {
	header("location:viewitem.php");
}*/

//header("location:viewitem.php");
//echo "<script>alert('popup_viewitem');</script>";
echo "<script>document.location = 'step-1.php';</script>";

?>