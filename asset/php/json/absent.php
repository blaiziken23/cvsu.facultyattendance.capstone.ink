<?php

session_start();
require "../connection.php";
$conn = connect();
$id = $_SESSION["id"];

  $absent = "SELECT `fullname`, `date`, `time_in`, `time_out`, `total_hour`, `status`
              FROM `attendance_tbl`WHERE `status` = 'ABSENT' AND `information_id` = $id ORDER BY `date` DESC";
              
  $sql = mysqli_query($conn, $absent) or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));
  
?>
