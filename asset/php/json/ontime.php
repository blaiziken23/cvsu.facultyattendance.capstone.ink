<?php

  session_start();
  require "../connection.php";
  $conn = connect();
  $id = $_SESSION["id"];

  $ontime = "SELECT `fullname`, `date`, `time_in`, `time_out`, `total_hour`, `status`,
              CASE WHEN `if_late` = 0 THEN 'ONTIME'
              ELSE 'LATE'
              END AS Status
              FROM `attendance_tbl` WHERE `information_id` = $id AND `if_late` = 0 AND `status` != 'ABSENT' ORDER BY `date` DESC";

  $sql = mysqli_query($conn, $ontime) or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));

?>