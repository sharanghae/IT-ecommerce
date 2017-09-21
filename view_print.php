<?php # Script 19.7 - view_print.php
$row = FALSE;
require_once('config.php');
// $_SESSION = array(); //clearstatcache()
//print_r($_GET);
	if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
	$pid = $_GET['pid'];
	$q = "SELECT CONCAT_WS(' ', first_name, last_name) AS artist, print_name, price, description, size, image_name FROM artists, prints WHERE artists.artist_id=prints.artist_id AND prints.print_id=$pid";
	$r = mysqli_query ($conn, $q);
		
		if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
		$page_title = $row['print_name'];

		include ('includes/header.html');
		echo '<div = class="container">
		<table class="table-bordered" width="90%" cellspacing="10"  cellpadding="10" align="center">
		<tr>
		<td><b>Print Name</b></td>
		<td><b>Artist Name</b></td>
		<td><b>Size</b></td>
		<td><b>Price</b></td>
		<td><b>Description</b></td>

		<td><b>Image</b></td>
		</tr>';
		// <div align=\"center\">
		echo "

		<tr><td>{$row['print_name']}</td> <td> {$row['artist']}</td>";
		echo '<td>';
		echo (is_null($row['size'])) ? '(No size information available)' : $row['size'] ;
		echo '</td>';
		echo "<td>\${$row['price']} </td>";
		echo '<td>' . ((is_null($row['description'])) ? '(No description available)' : $row['description']) . '</td>';
		// 
		// </div>
		
			if ($image = @getimagesize ("../ecommerce/uploads/$pid")) {
				//print_r($image);
			echo "<td><img width=\"150\" height =\"150\" src=\"show_image.php?image=$pid&name=" . urlencode($row['image_name']) . "\"$image[3] alt=\"{$row['print_name']}\"  /></td></tr></table>\n";
			} else {
			echo "<div align=\"center\">No image available.</div>\n";
			}
		echo "<a href='add_cart.php?pid=$pid'><center><img src='img/addcart.png' width='150' height='90'/></center></a></div>";
			
		} // End of the mysqli_num_rows( ) IF.
		mysqli_close($conn);
	}

if (!$row) {
$page_title = 'Error'; 
include ('includes/header.html');
echo '<div align="center">This page has been accessed in error!</div>';
}
//Complete the page:
// include ('includes/footer.html');
?>
<div class="container">
	<form action = "comment.php" class="form-horizontal" method="POST">
  		<center><textarea style="width:80%;" class="form-control" name="txtcomment" placeholder="write something" rows="3" id="comment"></textarea><br/>
		 <button name="btnComment" align="right"><i class="icon-share"></i>Leave a comment</button></center>
	</form>
</div>

