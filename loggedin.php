<?php # Script 12.4 - loggedin.php
// session_start();
// if (!isset($_SESSION['user_id'])) {
// require ('login_functions.php');
// redirect_user();
// }
$page_title = 'Logged In!';
include ('includes/header.html');

echo "<h1>Logged In!</h1>
<p>You are now logged in, {$_SESSION['first_name']}!</p>
<p><a href=\"logout.php\">Logout </a></p>";
echo "<script>alert ('WELCOME! ^_^')</script>";

echo "<script>window.open('home.php','_self')</script>";


include ('includes/footer.html');
?>
