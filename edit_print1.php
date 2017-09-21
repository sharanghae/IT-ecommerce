<?php # Script 10.3 - edit_user.php
$page_title = 'Edit a User';

include ('includes/header.html');
echo '<h1>Edit a User</h1>';

if ( (isset($_GET['id'])) &&  (is_numeric($_GET['id'])) ) 
{
$id = $_GET['id'];
} 
	elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) 
	{
	$id = $_POST['id'];
	} 
	else 
	{
	echo '<p class="error">This page  has been accessed in error.</p>';
	include ('includes/footer.html');
	exit( );
	}

require_once ('config.php');
if ($_SERVER['REQUEST_METHOD'] =='POST') 
{
	$errors = array( );
	if (empty($_POST['print_name'])) 
	{
	$errors[] = 'You forgot to  enter your print name.';
	}
	else {
	$pn = mysqli_real_escape_string ($conn, clean(trim($_POST['print_name'])));
	}

	if (empty($_POST['artist'])) {
	$errors[] = 'You forgot to  enter your last name.';
	} 
	else 
	{
	$ar = mysqli_real_escape_string ($conn, clean(trim($_POST['artist'])));
	}
	
	if (empty($_POST['price'])) {
	$errors[ ] = 'You forgot to  enter the price.';
	} else {
	$pr = mysqli_real_escape_string($conn, illegal(trim($_POST['price'])));
	}

	if (empty($_POST['size'])) {
	$errors[ ] = 'You forgot to  enter the size.';
	} else {
	$s = mysqli_real_escape_string($conn, illegal(trim($_POST['price'])));
	}

	if (empty($_POST['description'])) {
	$errors[ ] = 'You forgot to  enter the price.';
	} else {
	$d = mysqli_real_escape_string($conn, illegal(trim($_POST['description'])));
	}


	if (empty($errors)) {
		$q = "UPDATE prints SET  print_name= '$pn', price='$pr', size ='$s', description='$d' WHERE print_id= $id LIMIT 1";
		$r = @mysqli_query ($conn, $q);
		
		// if (mysqli_affected_rows($conn) == 1) 
		// {
		echo '<script>alert("Print has been edited!")</script>';
		echo "<script>window.open('browse_prints.php','_self')</script>";}
		// } 
		// else 
		// {
		// echo '<p class="error">The user  could not be edited due to a  system error. We apologize for any inconvenience.</p>';
		// echo '<p>' . mysqli_error($conn) .'<br />Query: ' . $q . '</p>';
		// }
		} 
else 
{
echo '<p class="error">The following  error(s) occurred:<br />';
}

	$q = "SELECT artists.artist_id, CONCAT_WS(' ', first_name, middle_name, last_name) AS artist, print_name, size, price, description, print_id FROM artists, prints WHERE artists.artist_id = prints.artist_id AND prints.print_id=$id";
	$r = @mysqli_query ($conn, $q);
	// print_r($q);
	if (mysqli_num_rows($r) == 1) {
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	echo '<form action="" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	<fieldset>
		<legend>Fill out the form to edit a print to the catalog:</legend>
		<p><b>Print Name:</b> 
		<input type="text" name="print_name" size="30" maxlength="60" value="'.$row[2].'"/></p>
		
		<p><b>Image:</b> <input type="file" name="image" /></p>
		<p><b>Artist:</b>
		<select name="artist"><option>'.$row[1].'</option></select>
		<p><b>Price:</b> 
		<input type="text" name="price" size="30" maxlength="60" value="'.$row[4].'"/></p>
		<p><b>Size:</b> 
		<input type="text" name="size" size="30" maxlength="60" value="'.$row[3].'"/></p>
		<p><b>Description:</b> 
		<textarea name="description" cols="40" rows="5">'.$row[5].'</textarea> (optional)</p>

		<div align="center"><input type="submit" name="submit" value="Submit" /></div>
			</form>';
	}


	else 
	{
	echo '<p class="error">This page  has been accessed in error.</p>';
	}


mysqli_close($conn);
include ('includes/footer.html');

function illegal($string) {
   $string = str_replace(' ', '-', $string); 
   return preg_replace('/[^A-Za-z0-9\@.]/', '', $string);
}

function clean($string) {
   $string = str_replace(' ', '-', $string); 
   return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
}
?>


