<?php

  session_start();
  require "../connection.php";
  $conn = connect();
  $id = $_SESSION["id"];

  $present = "SELECT `fullname`, `date`, `time_in`, `time_out`, `total_hour`, `status` AS Status,
              CASE WHEN `status` = 'ABSENT' THEN 'ABSENT'
              ELSE 'PRESENT'
              END AS Status
              FROM `attendance_tbl` WHERE `information_id` = $id AND NOT `status` = 'ABSENT' ORDER BY `date` DESC";

  $sql = mysqli_query($conn, $present) or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));

?>