<?php # Script 19.10 - view_cart.php
$page_title = 'View Your Shopping Cart';
include ('includes/header.html');
// session_start();
// print_r($_POST);
// print_r($_SESSION);
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		foreach ($_POST['qty'] as $k =>$v) {
		$pid = (int) $k; //Pid
		$qty = (int) $v; //Quantity
			if ( $qty == 0 ) {
			unset ($_SESSION['cart'][$pid]);
			} 
			elseif ( $qty > 0 ) {
			$_SESSION['cart'][$pid]['quantity'] = $qty;
			}
		} // End of FOREACH.
	}

	
	if (!empty($_SESSION['cart'])) {
	require_once('config.php');
		$q = "SELECT print_id, CONCAT_WS(' ', first_name, middle_name, last_name) AS artist, print_name FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.print_id IN (";
			foreach ($_SESSION['cart'] as $pid => $value) {
			$q .= $pid . ','; //(1,3,4,5,6,) concat
			}
			$q = substr($q, 0, -1) . ') ORDER BY artists.last_name ASC'; 
			//(1,3,4,5,6) clearing last comma
			$r = mysqli_query ($conn, $q);

			echo '<form action="view_cart.php" method="post">
			<div class ="container"><table class="table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
			<tr>
			<td align="left" width="30%"> <b>Artist</b></td>
			<td align="left" width="30%"> <b>Print Name</b></td>
			<td align="right" width="10%"><b>Price</b></td>
			<td align="center" width="10%"><b>Qty</b></td>
			<td align="right" width="10%"><b>Total Price</b></td>
			</tr>
			';

		$total = 0;
		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
			$subtotal = $_SESSION['cart'][$row['print_id']]['quantity'] * $_SESSION['cart'][$row['print_id']]['price'];
			$total += $subtotal;

			echo "\t<tr>
			<td align=\"left\">{$row['artist']}</td>
			<td align=\"left\">{$row['print_name']}</td>
			<td align=\"right\">\${$_SESSION['cart'][$row['print_id']]['price']}</td>
			<td align=\"center\"><input type=\"text\" size=\"3\" name=\"qty[{$row['print_id']}]\" value=\"{$_SESSION['cart'][$row['print_id']]['quantity']}\" /></td>
			<td align=\"right\">$" . number_format ($subtotal, 2) . "</td>
			</tr>\n";
		} // End of the WHILE loop.

		mysqli_close($conn);
		echo '<tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="right">$' . number_format ($total, 2) . '</td>
		</tr>
		</table></div>
		<div align="center"><input class="btn btn-info" type="submit" name="submit" value="Update My Cart" /></div>
		</form><p align="center">Enter a quantity of 0 to remove an item.
		<br /><br /><a href="checkout.php"><img src="img/checkout.png" width="180" height="80"></a></p>';
	}
	else {
	echo "<script>alert('Your cart is currently empty')</script>
	<script>window.open('browse_prints.php','_self')</script>";

	}
	include ('includes/footer.html');
?>
