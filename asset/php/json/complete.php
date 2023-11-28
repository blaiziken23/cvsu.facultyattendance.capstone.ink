<?php

  session_start();
  require "../connection.php";
  $conn = connect();
  $id = $_SESSION["id"];

  $complete = "SELECT `fullname`, `date`, `time_in`, `time_out`, `total_hour`, `in_out` AS Status,
              CASE WHEN `in_out` = 1 THEN 'COMPLETE'
              ELSE 'INCOMPLETE'
              END AS Status
              FROM `attendance_tbl` WHERE `information_id` = $id AND `in_out` = 1 ORDER BY `date` DESC";

  $sql = mysqli_query($conn, $complete) or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));

?>