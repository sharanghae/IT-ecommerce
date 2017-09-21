<?php # Script 12.3 - login.php
session_start();
if ($_SERVER['REQUEST_METHOD'] =='POST') {
require ('login_functions.php');
require ('config.php');
list ($check, $data) = check_login ($conn, $_POST['user'], $_POST['pass']);

if ($check) { // OK!
session_start();
$_SESSION['user_id'] = $data['user_id'];
$_SESSION['first_name'] = $data['first_name'];
redirect_user('loggedin.php');
} else {
$errors = $data;
}
mysqli_close($conn);
}
include ('login_page.php');
?>