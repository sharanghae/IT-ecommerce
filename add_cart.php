<?php # Script 19.9 - add_cart.php
$page_title = 'Add to Cart';
include ('includes/header.html');

if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range'=> 1))) 
	{
	$pid = $_GET['pid'];

	if (isset($_SESSION['cart'][$pid])) 
	{
	$_SESSION['cart'][$pid]['quantity']++;
	echo "<script>alert('Another copy of the print has been added to your shopping cart')</script>
	<script>window.open('browse_prints.php','_self')</script>";

	} 
	else 
	{ // New product to the cart.
	require_once('config.php');
	$q = "SELECT price FROM prints WHERE print_id=$pid";
	$r = mysqli_query ($conn, $q);
		if (mysqli_num_rows($r) == 1) {
		list($price) = mysqli_fetch_array ($r, MYSQLI_NUM);

		$_SESSION['cart'][$pid] = array('quantity' => 1, 'price' => $price);
		echo "<script>alert ('Print has been added to your cart! ^_^')</script>;

		<script>window.open('browse_prints.php','_self')</script>";
		} else 
		{ // Not a valid print ID.
		echo '<div align="center">This page has been accessed in error!</div>';
		}
	mysqli_close($conn);
	} // End of isset($_SESSION ['cart'][$pid] conditional.
} 
else 
{ // No print ID.
echo '<div align="center">This page has been accessed in error!</div>';
}
// include ('includes/footer.html');
?>

