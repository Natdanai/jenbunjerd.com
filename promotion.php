<?
	$order_total_sql="SELECT SUM(
(
ob.price * ob.amount
)
) AS netpay
FROM jenbunjerd_order_b ob, jenbunjerd_products p
WHERE ob.products_id = p.products_id
AND ob.order_id = '$o_id'
AND p.products_jb_no NOT
IN (
SELECT jb_no
FROM `product_promotion`
)
GROUP BY ob.order_id";

					$total_query = $db->sql_query($order_total_sql);
					$resultr = $db->sql_fetchrow($total_query);


$order_total_sql2="SELECT SUM(
(
ob.price * (ob.amount-1)
)
) AS netpay
FROM jenbunjerd_order_b ob, jenbunjerd_products p
WHERE ob.products_id = p.products_id
AND ob.order_id = '$o_id'
AND p.products_jb_no 
IN (
SELECT jb_no
FROM `product_promotion`
)
GROUP BY ob.order_id";
					$total_query = $db->sql_query($order_total_sql2);
					$resultr2 = $db->sql_fetchrow($total_query);

$cart_sql = sql_Select(1, $prefix."_order_b", "order_id = '$o_id'", 0);
							//echo  $cart_sql ;
							$cart_query = $db->sql_query($cart_sql);										
							$total_item = $db->sql_numrows($cart_query);

$limits=stripslashes($resultr['netpay'])+stripslashes($resultr2['netpay']);					
							
if ($limits>=1500) {
$flag="baba";
$order_promotion_sql=" UPDATE jenbunjerd_order SET promotion = ( SELECT *
FROM (

SELECT p.products_price-pp.discountprice
FROM jenbunjerd_products p, jenbunjerd_order_b ob, product_promotion pp, jenbunjerd_order o
WHERE ob.order_id = '$o_id'
AND ob.products_id = p.products_id
AND ob.order_id = o.order_id
AND p.products_jb_no
IN (

SELECT jb_no
FROM `product_promotion`
)
AND p.products_jb_no = pp.jb_no
AND ob.products_id = '".$_SESSION[promotion]."' ) AS promotion
)
WHERE order_id ='$o_id'";

$order_promo = $db->sql_query($order_promotion_sql);
}
?>