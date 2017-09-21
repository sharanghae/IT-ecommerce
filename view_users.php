<?php # Script 9.4 - view_users.php
// session_start();
// if (!isset($_SESSION['user_id'])) {
// require ('login_functions.in.php');
// redirect_user();
// // } else {
// // $_SESSION = array();

// // setcookie ('PHPSESSID', '', time() + (86400 * 30), '/', '', 0, 0);
// // session_destroy();
// }


$page_title = 'View the Current Users';
include ('includes/header.html');
// echo '<h1>Registered Users</h1>';
require ('config.php');
$q = "SELECT last_name,  first_name , email, user_id, DATE_FORMAT (registration_date, '%M %d, %Y') as dr FROM customers ORDER BY registration_date ASC";
$r = @mysqli_query ($conn, $q);


if ($r) 
	{ echo '<div class = "container" style = "padding-left:80px;">
<div class = "row">
	<table class ="table table-condensed table-hover" align="center" width="75%">
	<a href ="register.php"><img src="img/add.png" width="50" height="50" alt="Add new customer" border ="10" data-toggle="tooltip" title="Add"></a>
		
</div>
	
<tr>
<td align="left"><b>Last Name </b></td>
<td align="left"><b>First Name </b></td>
<td align="left"><b>Date Registered</b></td>
<td align="left"><b>Email Address</b></td>
<td align="left"><b>Edit</b></td>
<td align="left"><b>Delete</b></td>
</tr>
';

while ($row = mysqli_fetch_object($r)) {
echo '<tr>

<td align="left">'  .$row->last_name . '</td>
<td align="left">' . $row->first_name . '</td>
<td align="left">' . $row->dr .'</td>
<td align="left">' . $row->email .'</td>
<td align="left"><a href= "edit_user.php?id=' . $row->user_id . '"><img src="img/edit.png" width="35" height="35" alt="Edit" data-toggle="tooltip" title="Edit"></a></td>

<td align="left"><a href="delete_user.php?id=' . $row->user_id . '"><img src="img/delete.png" width="35" height="35" alt="Delete" data-toggle="tooltip" title="Delete"></a></td>
</tr>';
}
echo '</table></div></div></div>';

} else {
echo '<p class="error">The
current users could not be
 retrieved. We apologize for
 any inconvenience.</p>';
echo '<p>' . mysqli_error($conn)
. '<br /><br />Query: ' . $q .
'</p>';
}
mysqli_close($conn);
include ('includes/footer.html');
?>

