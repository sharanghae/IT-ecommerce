<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<?php
require_once "config.php";
include('includes/header.html');
?>
<?php
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		$QueGetPrint = "SELECT * FROM `prints` WHERE `print_id` = '".$id."' LIMIT 1";
		$ResGetPrint = mysqli_query($conn,$QueGetPrint) or die (mysqli_error($conn));
	    while($RowGetPrint = mysqli_fetch_array($ResGetPrint)){
			$PrintName = $RowGetPrint['print_name'];
			$Price = $RowGetPrint['price'];
			$Size = $RowGetPrint['size'];
			$Desc = $RowGetPrint['description'];
			$image = @getimagesize ("../ecommerce/uploads/$pid");
		}
	}
	
	if (isset($_POST['btnSaveComment'])){
		$Comment = $_POST['txtComment'];
		$QueAddComment = "INSERT INTO comments (`print_id`,`comments_body`) VALUES (?,?)";
		$StmtAddComment = mysqli_prepare($conn,$QueAddComment);
		mysqli_stmt_bind_param($StmtAddComment,'is',$id,$Comment);
		
		if (mysqli_stmt_affected_rows($StmtAddComment) > 1) {
			echo '<p style="font-weight:
			 bold; color: #C00">Your Comment has been added.</p>';
		} else {
			echo '<p style="font-weight:
			 bold; color: #C00">Your
			 submission could not be
			 processed due to a system
			 error.</p>';
		}
		mysqli_stmt_close($StmtAddComment);
	}
?>
<form method="post">

<div id="services">

   <ol class="breadcrumb">
      <li class="breadcrumb-item active">Comments and Reviews <span class="fa fa-fw fa-comments"></span></li>
   </ol>	
   <h3><a href="browse_prints.php" class="">Back</a></h3>
<!-- <input type="submit" class="btn btn-success" name= "submit" value="Back"/> -->
 <div align="center">
     <img width="150" height ="150" src="show_image.php?image=$pid&name=<?php echo " '" . urlencode($row['image_name']) . "' $image[3] "?> alt=\"{$row['print_name']}\"  />
     <br/>
</div>
</br>

<div class="col-lg-8"> 
    <pre style="background-color:#AED6F1; font-size:12px;">
      <br/>
      <label><strong>Print Name : </strong></label><i><?php echo $PrintName; ?></i>
      <label><strong>Price : </strong></label><i><?php echo $Price; ?></i>
      <label><strong>Size : </strong></label><i><?php echo $Size; ?></i>
      <label><strong>Description : </strong></label><i><?php echo $Desc; ?></i>
    </pre>
</div>
    <div align="center">
        <textarea name="txtComment" placeholder="Leave your comment here..." style="width:100%; height:10%;"></textarea>
    </div>
    <div align="right">
        <input type="submit" name="btnSaveComment" value="Add Comment" align="right"/>
    </div>
    <div align="left">
    	<pre>
        
        	<?php
				$QueGetComments = "SELECT `comment_body`,`comment_date` FROM comments WHERE `print_id` = $id";
				$ResGetComments = mysqli_query($conn,$QueGetComments) or die (mysqli_error($conn));
				$Display='';
				while($RowGetComments = mysqli_fetch_array($ResGetComments)){	
					$Display.="<pre style=\"height:5%; background-color:#ECF0F1;\">".
							   "* ".$RowGetComments['comments_feed']."\t\t".$RowGetComments['CommDate']."".
							  "</pre>";
				}
				echo $Display;
			?>
            </table>
        </pre>
    </div>
    </div>
</form>