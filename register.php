	<?php

// session_start();
// if (!isset($_SESSION['user_id'])) {
// require ('login_functions.inc.php');
// redirect_user();
// }
require ("config.php");
$page_title = 'Add customer';
include ("includes/header.html");
		
	if((isset($_POST['submit']) && (isset($_POST['submit'])) == 'Add'))
	{
		$email = illegal($_POST['email']);
		$user_name = illegal($_POST['user_name']);
		$pass = illegal($_POST['pass']);
		$first_name = illegal($_POST['first_name']);
		$last_name = illegal($_POST['last_name']);
		
		if (isset($first_name) && isset($last_name) && isset($email) && isset($pass) && isset($user_name) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($pass) && !empty($user_name))
		{
				$checkunique = "select * from customers where user_name = '$user_name'";
				$result = mysqli_query($conn,$checkunique);
				if (mysqli_num_rows($result)==0)
				{
				$insertque = "insert into customers(email, user_name, pass, first_name, last_name) values('$email', '$user_name', sha1('$pass'), '$first_name', '$last_name')";
				$resultque = mysqli_query($conn, $insertque) or die(mysqli_error($conn));
				echo "<script>alert ('Customer Added! ^_^')</script>";
				echo "<script>window.open('view_users.php','_self')</script>";
				}
				else
				{
				echo "<script>alert ('try something new! ^_^')</script>";
				}
		}
		else 
		{
		echo "<script>alert ('Fill it up! ^_^')</script>";
		}

	
	}


	// mysql_query("START TRANSACTION");
	// $insertque = "insert into customers (email, first_name, last_name, pass) values('$email', '$first_name', '$last_name', '$pass')";

	// if ($insertque)
	// {
	// 	mysql_query($insertque);
	// 	mysql_query("COMMIT");
		
	// 	echo "<script>window.open('login.php','_self')</script>";
	// }
	// else
	// {
	// mysql_query("ROLLBACK");
function illegal($string) {
   $string = str_replace(' ', '-', $string); 
   return preg_replace('/[^A-Za-z0-9\@]/', '', $string);
}

?>

<h1>Add customer!</h1>
<form action="register.php" method="post">
	<p>First Name: <input type="text" name="first_name" placeholder="name here" size="15" maxlength="20"></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40"></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60"> </p>
	<p>Username: <input type="text" name="user_name" size="10" maxlength="20"></p>
	<p>Password: <input type="password" name="pass" size="10" maxlength="20"></p>
	</p>
	<p><input type="submit" name="submit" value="Add" /></p>
</form>