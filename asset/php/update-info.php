<?php

  session_start();
  require "connection.php";
  $conn = connect();

	$id = $_SESSION["id"];


	if(isset($_POST["update-btn"])) {

		$image = $_FILES["image"]["name"];
		$tempname = $_FILES["image"]["tmp_name"];
		$tempname = mysqli_real_escape_string($conn, $tempname);
		$folder = "../profilepic/" . $image;

		$sql = "UPDATE `information_tbl` SET `image` = '$image', `image_blob` = '$tempname' WHERE `id` = '$id'";
		
		if(mysqli_query($conn, $sql)) {
			echo "<script> Image Saved </script>";
			if (move_uploaded_file($tempname, $folder)) {

        			echo "<script>location.href = 'admin.php#employee'</script>";
			} 
			else {
					echo "<h3>  Failed to upload image!</h3>";
			}
		}
		else {
			echo "<script> Error </script>";
		}


	}





?>