<?php # Script 19.11 - checkout.php
$page_title = 'Order Confirmation';
include ('includes/header.html');
// session_start();
$cid = 1;
$total = 178.93;
require_once('config.php');
//mysqli_autocommit($conn, FALSE);
mysqli_query($conn,"start transaction");
$q = "INSERT INTO orders (customer_id, total) VALUES
($cid, $total)";
$r = mysqli_query($conn, $q);
if (mysqli_affected_rows($conn)==1) {
$oid = mysqli_insert_id($conn);
$q = "INSERT INTO order_contents(order_id, print_id, quantity, price) VALUES (?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $q);
mysqli_stmt_bind_param($stmt,'iiid', $oid, $pid, $qty, $price);
$affected = 0;
foreach ($_SESSION['cart'] as $pid => $item) 
	{
	$qty = $item['quantity'];
	$price = $item['price'];
	mysqli_stmt_execute($stmt);
	$affected += mysqli_stmt_affected_rows($stmt);
	}
mysqli_stmt_close($stmt);
	if ($affected == count($_SESSION['cart'])) 
	{
	mysqli_commit($conn);
	unset($_SESSION['cart']);
	echo "<script>alert('Thank you for your order. You will be notified when the items ship')</script>";
	echo "<script>window.open('home.php','_self')</script>";
	} 
	else 
	{
	mysqli_rollback($conn);
	echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
	}
} 
else 
{
mysqli_rollback($conn);
echo '<p>Your order could not be processed due to a system error. You will be contacted in order to have the problem fixed. We apologize for the inconvenience.</p>';
}
mysqli_close($conn);
// include ('includes/footer.html');
?>
