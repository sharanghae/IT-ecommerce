<?php
include_once('includes/header.html');
echo '<center><a href="view_cart.php" ><img src="img/viewcart.png" width="150" height="80"/></center></a>';

require_once('config.php');
// print_r($_GET); //Debugging purpose only 
$q = "SELECT artists.artist_id,CONCAT_WS(' ', first_name, middle_name, last_name) AS artist, print_name, size, price, description, print_id FROM artists, prints WHERE artists.artist_id = prints.artist_id ORDER BY artists.last_name ASC, prints.print_name ASC";
if (isset($_GET['aid']) && filter_var($_GET['aid'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) {
$q = "SELECT artists.artist_id,CONCAT_WS(' ', first_name, middle_name, last_name) AS artist, print_name, price, description, print_id FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.artist_id={$_GET['aid']} ORDER BY prints.print_name";
}
echo '<div class="container"><table class = "table table-bordered" border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<a href ="add_print.php"><img src="img/add.png" width="50" height="50" alt="Add new customer" border ="10" data-toggle="tooltip" title="Add"></a>
<tr> <td align="center" width="20%"> <b>Artist</b></td>
<td align="center" width="20%"> <b>Print Name</b></td>
<td align="center" width="30%"> <b>Description</b></td>
<td align="center" width="20%"> <b>Price</b></td>
<td align="center" width="20%"> <b>Edit</b></td>
<td align="center" width="20%"> <b>Delete</b></td>
<td align="center" width="20%"> <b>Comment</b></td>

</tr>';
$r = mysqli_query ($conn, $q);
while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
echo "<tr><td align=\"center\"><a href=\"browse_prints.php?aid={$row['artist_id']}\">{$row['artist']}</a></td>
<td align=\"center\"><a href=\"view_print.php?pid={$row['print_id']}\">{$row['print_name']}</td>
<td align=\"center\">{$row['description']}</td><td align=\"center\">{$row['price']}</td>
<td align=\"center\"><a href= \"edit_print1.php?id={$row['print_id']}\"><img src=\"img/edit.png\" width=\"35\" height=\"35\" alt=\"Edit\" data-toggle=\"tooltip\" title=\"Edit\"></a></td>

<td align=\"center\"><a href=\"delete_print.php?id={$row['print_id']}\"><img src=\"img/delete.png\" width=\"35\" height=\"35\" alt=\"Delete\" data-toggle=\"tooltip\" title=\"Delete\"></a></td>

<td align=\"center\"><a href=\"comment.php?id={$row['print_id']}\">Comment</a></td></tr>";
}
echo '</table></div>';
mysqli_close($conn);
// include ('includes/footer.html');
?>



	