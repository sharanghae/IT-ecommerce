<?php
	include("includes/header.html");
	require("config.php");

	$query = $_POST['txtquery'];
	$min_length = 3; // set min length of search letters

	if (!is_numeric($query) && !empty($query) && strlen($query) >= $min_length)
	{
		$query = htmlspecialchars($query);
		$query = mysql_real_escape_string($query);
		$results = "SELECT p.print_id, CONCAT_WS(' ', first_name, last_name) AS artist, p.print_name, p.price, p.size, p.description, p.image_name FROM prints AS p INNER JOIN artists AS ar ON p.artist_id = ar.artist_id AND description LIKE '%". $query ."%'";


		$r = mysqli_query($conn, $results);

		if (mysqli_num_rows($r) >= 1)
		{
			while ($res = mysqli_fetch_array($r))
			{
				$pid = $res['print_id'];
				echo "<div align=\"center\">
				<tr><td>{$res['print_name']} by {$res['artist']}</td>";
				echo (is_null($res['size'])) ? '(No size information available)' : $res['size'];
				echo "<br/>\${$res['price']}</div><br />";
				if ($image = @getimagesize ("../ecommerce/uploads/$pid")) 
				{
				//print_r($image);
				echo "<div align=\"center\"><img src=\"show_image.php?image=$pid&name=" . urlencode($res['image_name']) . "\"$image[3] alt=\"{$res['print_name']}\" /></div>\n";

				
				} 
				else 
				{
				echo "<div align=\"center\">No image available.</div>\n";
				}
			}
		echo '<p align="center">' . $res['description'] . '</p>';
		} // End of the mysqli_num_rows( ) IF.
		mysqli_close($conn);
	}
	else
	{
		echo "<script>alert('No result')</script>";
		echo "<script>window.open('home.php', '_self')</script>";
	}

	function clear()
	{
	$query = "";
	}

?>



	<a href="home.php" class="btn btn-info">BACK</a>
