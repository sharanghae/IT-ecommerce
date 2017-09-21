<!DOCTYPE html PUBLIC "-//W3C//
	DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/
xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/
1999/xhtml" xml:lang="en"
lang="en">
<head>
	<meta http-equiv="content-type"
	content="text/html;
	charset=utf-8" />
	<title>Add a Print</title>
</head>
<body>
<?php # Script 19.2 - add_print.php
require ('config.php');
include ('includes/header.html');
// print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] =='POST') {
	$errors = array();
	if (!empty($_POST['print_name'])) 
	{
		$pn = trim($_POST['print_name']);
	} 
	else 
	{
		$errors[] = 'Please enter the print\'s name!';
	}
	if (is_uploaded_file ($_FILES['image']['tmp_name'])) 
	{
		$temp = '../ecommerce/uploads/' .md5($_FILES['image']['name']);
		
		if (move_uploaded_file($_FILES['image']['tmp_name'], $temp)) 
		{
		// echo '<p>The file has been uploaded!</p>';
		$i = $_FILES['image']['name'];
		} 
		else 
		{
		$errors[] = 'The file could not be moved.';
		$temp = $_FILES['image']['tmp_name'];
		}
	} 
	else 
	{
	$errors[] = 'No file was uploaded.';
	$temp = NULL;
}

$s = (!empty($_POST['size'])) ? trim($_POST['size']) : NULL;
	if (is_numeric($_POST['price']) && ($_POST['price'] > 0)) 
	{
	$p = (float) $_POST['price'];
	} 
	else 
	{
	$errors[] = 'Please enter the print\'s price!';
	}

$d = (!empty($_POST['description'])) ? trim($_POST['description']) : NULL;

	if ( isset($_POST['artist']) && filter_var($_POST['artist'], FILTER_VALIDATE_INT, array('min_range' => 1)) ) 
	{
	$a = $_POST['artist'];
	} 
	else 
	{ // No artist selected.
	$errors[ ] = 'Please select the print\'s artist!';
	}

	if (empty($errors)) 
	{
	$q = 'INSERT INTO prints (artist_id, print_name, price,size, description, image_name) VALUES (?, ?, ?, ?, ?,?)';
	$stmt = mysqli_prepare($conn, $q);
	mysqli_stmt_bind_param($stmt,'isdsss', $a, $pn, $p, $s, $d, $i);
	mysqli_stmt_execute($stmt);
		
		if (mysqli_stmt_affected_rows($stmt) == 1) 
		{
		echo '<script>alert("Print has been added!")</script>';
		echo "<script>window.open('browse_prints.php','_self')</script>";
		$id = mysqli_stmt_insert_id($stmt);
		rename ($temp, "../ecommerce/uploads/$id");
		$_POST = array();
		} 
		else 
		{
		echo '<p style="font-weight:bold; color: #C00">Yoursubmission could not be processed due to a system error.</p>';
		}
		mysqli_stmt_close($stmt);
	} // End of $errors IF.
	

if (isset($temp) && file_exists($temp) && is_file($temp)) 
	{
	unlink ($temp);
	}
}

if (!empty($errors) && is_array($errors)) 
{
	echo '<h1>Error!</h1>
	<p style="font-weight:bold; color: #C00">The following error(s) occurred:<br />';
	foreach ($errors as $msg) 
	{
	echo " - $msg<br />\n";
	}
	echo 'Please reselect the print image and try again.</p>';
}
?>

<h1>Add a Print</h1>
<form enctype="multipart/form-data" action="add_print.php" method="post">
	<input type="hidden" name="MAX_FILE_SIZE" value="524288" />
	<fieldset>
		<legend>Fill out the form to add a print to the catalog:</legend>
		<p><b>Print Name:</b> 
		<input type="text" name="print_name" size="30" maxlength="60" value="<?php if (isset($_POST['print_name'])) echohtmlspecialchars($_POST['print_name']); ?>" required/></p>
		
		<p><b>Image:</b> <input type="file" name="image" required="" /></p>
		<p><b>Artist:</b>
		<select name="artist" required><option>Select One</option>
		<?php
		$q = "SELECT artist_id, CONCAT_WS(' ', first_name, middle_name,last_name) FROM artists ORDER BY last_name,first_name ASC";
		$r = mysqli_query ($conn, $q);
			
			if (mysqli_num_rows($r) > 0) 
			{
			while ($row = mysqli_fetch_array ($r, MYSQLI_NUM)) 
				{
					echo "<option value=\"$row[0]\"";
// Check for stickyness:
					if (isset($_POST['existing']) && ($_POST['existing'] == $row[0]) ) 
						echo 'selected="selected"';
						echo ">$row[1]</option>\n";
					}
					} 
			else 
			{
				echo '<option>Please add a new artist first.</option>';
			}
mysqli_close($conn); // Close the database connection.
?>

</select></p>
<p><b>Price:</b> 
<input type="text" name="price" size="10" maxlength="10" value="<?php if (isset($_POST['price'])) echo $_POST['price']; ?>" required/> <small>Do not include the dollar sign or commas.</small></p>
	
<p><b>Size:</b> <input type="text" name="size" size="30" maxlength="60" value="<?php if (isset($_POST['size'])) echohtmlspecialchars($_POST['size']); ?>" /> (optional)</p>

<p><b>Description:</b> 
<textarea name="description" cols="40" rows="5">
<?php if (isset($_POST['description'])) echo $_POST['description'];?>
</textarea> (optional)</p>
</fieldset>
	<div align="center"><input type="submit" name="submit" value="Submit" /></div>
	</form>
</body>
</html>


