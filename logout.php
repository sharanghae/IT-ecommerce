
<?php # Script 12.6 - logout.php
session_start();
if (!isset($_SESSION['user_id'])) {
require ('login_functions.php');
redirect_user();
} else {
//setcookie ('user_id', '', time()-3600, '/', '', 0, 0);
//setcookie ('user_id');
//setcookie ('first_name', '', time()-3600, '/', '', 0, 0);
$_SESSION = array();
session_destroy();
setcookie ('PHPSESSID', '', time()-3600, '/', '', 0, 0);
}

$page_title = 'Logged Out!';
include ('includes/header.html');
echo "<h1>Logged Out!</h1>
<p>You are now logged out!</p>";
include ('includes/footer.html');
?>
