<?php # Script 12.2 - login_functions.inc.php

function redirect_user ($page) {
$url = 'http://' . $_SERVER ['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
$url = rtrim($url, '/\\');
$url .= '/' . $page;
header("Location: $url");
exit( ); // Quit the script.
}

function check_login($conn, $user = '', $pass = '') 
{
$errors = array( );
	if (empty($user)) 
	{
	$errors[ ] = 'You forgot to  enter your email address.';
	} 
	else 
	{
	$e = mysqli_real_escape_string ($conn, trim($user));
	}
		if (empty($pass)) 
		{
		$errors[ ] = 'You forgot to enter your password.';
		} 
		else 
		{
		$p = mysqli_real_escape_string($conn, trim($pass));
		}

		if (empty($errors)) {
		$q = "SELECT user_id, first_name FROM customers WHERE user_name='$e'  AND pass=SHA1('$p')";
		$r = @mysqli_query ($conn, $q);
		print_r($q);
			if (mysqli_num_rows($r) == 1) 
			{
				$row = mysqli_fetch_array ($r, MYSQLI_ASSOC);
				return array(true, $row);
			} 
			else
			{ // Not a match!
				
				$errors[ ] = 'The email address and password entered do not  match those on file.';	
				
			}
		} // End of empty($errors) IF.
return array(false, $errors);
}



