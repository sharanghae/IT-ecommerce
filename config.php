<?php
$db_host = "localhost";
  $db_username = "root";
  $db_passwd = "";
  $conn= mysqli_connect($db_host, $db_username, $db_passwd) or die ("Could not connect!\n");


  // echo "Connection established.\n";
  $db_name = "ecommerce";
 

 mysqli_select_db($conn,$db_name) or die ("Could not select the database $dbname!\n". mysql_error());

  // echo "Database $db_name is selected.\n";
?>
