<?php
/**
 * @author Anon D.
 * @copyright 20-12-2012
*/


function getPrice($products_id){
    if(!isset($products_id)){
        $price = 0;
    }
    
    /*
    $query ="SELECT DISTINCT products_price FROM jenbunjerd_productpricelist WHERE PRODUCTS_id =".$product_id." AND  ((date_start='0000-00-00' OR date_start<NOW())AND(date_end='0000-00-00' OR date_end > NOW())) ORDER BY pricelist_id ASC LIMIT 1";
    */
    //$query =("SELECT DISTINCT products_price FROM jenbunjerd_productpricelist WHERE PRODUCTS_id =".$products_id." AND  ((date_start='0000-00-00' OR date_start<NOW())AND( date_end='0000-00-00' OR date_end > NOW())) ORDER BY date_start DESC LIMIT 1");
    
    $query = "SELECT DISTINCT products_price FROM jenbunjerd_productpricelist WHERE products_id =".$products_id." AND ( ( date_start='0000-00-00' OR date_start < NOW() ) AND ( date_end='000-00-00' OR date_end > NOW() ) ) ORDER BY date_start DESC LIMIT 1";
    $result = mysql_query($query);
    if(!$result){
    echo "No Data";
}
    $data = mysql_fetch_row($result);
    return $price =$data[0];
    /*echo $data[0]; */
    
}

function getDiscountPrice($products_id){
    if(!isset($products_id)){
        $price = 0;
    }
    
    /*
    $query ="SELECT DISTINCT products_price FROM jenbunjerd_productpricelist WHERE PRODUCTS_id =".$product_id." AND  ((date_start='0000-00-00' OR date_start<NOW())AND(date_end='0000-00-00' OR date_end > NOW())) ORDER BY pricelist_id ASC LIMIT 1";
    */
    //$query =("SELECT DISTINCT products_price FROM jenbunjerd_productpricelist WHERE PRODUCTS_id =".$products_id." AND  ((date_start='0000-00-00' OR date_start<NOW())AND( date_end='0000-00-00' OR date_end > NOW())) ORDER BY date_start DESC LIMIT 1");
    
    $query = "SELECT DISTINCT products_discountprice FROM jenbunjerd_productdiscount WHERE products_id =".$products_id." AND ( ( date_start='0000-00-00' OR date_start < NOW() ) AND ( date_end='000-00-00' OR date_end > NOW() ) ) ORDER BY date_start DESC LIMIT 1";
    $result = mysql_query($query);
    if(!$result){
    echo "No Data";
    return $discount = 0;
}
    $data = mysql_fetch_row($result);
    return $price =$data[0];
    /*echo $data[0]; */
    
}
?>
<?php 
    function cartPrice($products_id){
    $discount = getDiscountPrice($products_id);
    $products_price = getPrice($products_id);
    if($discount==0){
        $price = $products_price;
    }else{
        $price = $discount;
    }
    return $price;
}?>
