<?php
//including the database connection file

$page_title = 'View the Current Prints';

// include("includes/header.html");
include_once("config.php");

$result = "SELECT p.print_id, ar.first_name, ar.last_name,  p.print_name, p.price, p.size, p.description, p.image_name FROM prints AS p INNER JOIN artists AS ar ON p.artist_id = ar.artist_id"; 

$r = @mysqli_query($conn,$result);
?>
 
<html>
<head>  
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <script src="assets/jquery/jquery-3.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="assets/css/custom.css">
  <script src="assets/fonts/Sofia-Regular.otf"></script>  
    <title>Homepage</title>
</head>
 
<body>
    <div class = "container" style = "padding-left:60px;">
<div class = "">
    <table class ="table table-condensed table-hover" align="center" width="100%">
    <a href="login_page.php" class="btn btn-danger">LOGIN</a><br/>
</div>
       
        <tr>
        <br/>
            <td><b>Artist Name</b></td>
            <td><b>Print Name</b></td>
            <td><b>Price</b></td>
            <td><b>Description</b></td>
            <td><b>Image Size</b></td>
            <td><b>Image Name</b></td>
           
        </tr>
        <?php 

        while($res = mysqli_fetch_object($r))
        {         
            echo '<tr>
            <td>'  .$res->first_name . ' '.$res->last_name.'</td>
            <td>'.$res->print_name.'</td>
            <td>'.$res->price.'</td>
            <td>'.$res->description.'</td>
            <td>'.$res->size.'</td>
            <td>'.$res->image_name.'</td>
            ';
        }

        ?>
    </table>
    </div></div>
    <?php
    include("includes/footer.html");
    ?>
</body>
</html>