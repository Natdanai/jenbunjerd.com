<html>
<head>
<title>ThaiCreate.Com PHP & MySQL Tutorial</title>
</head>
<body>
<?php
//include ("config.php");
	//$objConnect = mysql_connect("localhost","root","mysqljb");
    //$objConnect = mysql_connect($dbhost,$dbuname,$dbpass);
    $objConnect = mysql_connect("root","root","");
	if($objConnect)
	{
		$objDB = mysql_select_db("jb-17-01-2013");
		//$objDB = mysql_select_db("jb");
		 //======Get data from Excel======================//        
		$dom    =    DOMDocument::load( $_FILES['file']['tmp_name'] ); 
		$rows    =    $dom->getElementsByTagName( 'Row' ); 
		$row    =    0; 
		 
		foreach ($rows as $temp) 
		{ 
			$col = 0; 
			if($row==0) 
			{ 
				$row++; continue; 
			} 
			$cells    = $temp->getElementsByTagName('Cell'); 
			
			foreach( $cells as $cell )  
			{ 
				 if($col==0) $data1 = $cell->nodeValue; 
				 if($col==1) $data2 = $cell->nodeValue;
				 if($col==2) $data3 = $cell->nodeValue;
				 if($col==3) $data4 = $cell->nodeValue;
                 if($col==4) $data5 = $cell->nodeValue;
                 //if($col==5) $data6 = $cell->nodeValue;
                // if($col==6) $data7 = $cell->nodeValue;
                // if($col==7) $data8 = $cell->nodeValue;
				 $col++; 
			} 
			//======End Get data from Excel======================//   
           $strSQL = "INSERT INTO `jenbunjerd_productpricelist` (`pricelist_id`, `products_id`, `products_price`, `date_start`, `date_end`) VALUES (NULL, '$data1', '$data3', DATE('$data4'), DATE('$data5'))";     

			//==================Insert To DB ====================================//
		//	$strSQL = "UPDATE jenbunjerd_products SET ";
		//	$strSQL .="products_price = '$data2'";
            //$strSQL .=",products_discountprice = '$data3'";	
            //$strSQL .=",promotion_start_date = '$data4'";
            //$strSQL .=",promotion_end_date = '$data5'";
            //$strSQL .=",products_status = '$data6'";
            //$strSQL .=",products_promote = '$data7'";
            //$strSQL .=",products_promotion = '$data8'";
			//$strSQL .=" ,products_discountprice = '$data4' ";				
			//$strSQL .="WHERE products_id = '$data1' ";
			//$strSQL .="WHERE products_jb_no = '$data1' ";
			$objQuery = mysql_query($strSQL) or die(mysql_error()); 
			//==================End Insert To DB ====================================//
			echo $strSQL."<BR>";
			 $row++;  
		} 

		if($objQuery)
		{
			echo "Save Done.";			
		}
		else
		{
			echo "Error Save [".$strSQL."]";
		}
	}
	else
	{
		echo "Database Connect Failed.";
	}

	mysql_close($objConnect);
?>
</body>
</html>