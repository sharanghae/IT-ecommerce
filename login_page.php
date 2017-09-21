<?php # Script 12.1 -

$page_title = 'Login';

// include ('includes/header.html');

?>
<title>LOGIN</title>

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.js">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.js">
	<link rel="stylesheet" type="text/css" href="assets/css/screen.css">
	<link rel="stylesheet" type="text/css" href="assets/css/custom.css">

<!-- <h1>Login</h1> -->	
<div class="container">

      <div class="col-md-4 col-md-offset-4">
<form action="login.php"  method="post">

<div class="jumbotron">
<div class="form-group input-group">

	<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span><input class = "form-control" type= "text" name="user" placeholder="username" />
</div>

<div class="form-group input-group">
	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
	<input class = "form-control" type="password" name="pass" placeholder="password" />
</div>
<input class = "btn btn-def btn-block btn btn-info" type="submit" name= "submit" value="Login"/>
<!-- <a href= "login.php" class = "btn btn-def btn-block btn btn-info">Login</a> -->
<a href= "view_prints.php" class = "btn btn-def btn-block btn btn-info">View Prints</a>

<?php
if (isset($errors) && !empty($errors)) {
echo '<h1 style="font-size:15px;">Error!</h1>
<p class="error" style="font-size:12px; color:red;">The following error(s) occurred:<br />';
foreach ($errors as $msg) {
echo " - $msg<br />\n";
}
echo '</p><p style="font-size:12px; color:red;">Please try  again.</p>';
}?>
</form>

<br/><p style="font-size:12px;">Dont have an account yet?<a href="register.php"> Register here.</p></a>
</div>
</div>
<style>
	body
		{
			background-image: url(img/try.jpg);
		}
	</style>
<?php 
// include ('includes/footer.html'); ?>

