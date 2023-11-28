<?php

  session_start();
  require "../connection.php";
  $conn = connect();
  $id = $_SESSION["id"];

  $late = "SELECT `fullname`, `date`, `time_in`, `time_out`, `total_hour`, `status` AS Status,
              CASE WHEN `if_late` > 0 THEN 'LATE'
              ELSE 'ONTIME'
              END AS Status
              FROM `attendance_tbl` WHERE `information_id` = $id AND `if_late` > 0 ORDER BY `date` DESC";

  $sql = mysqli_query($conn, $late) or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));

?>