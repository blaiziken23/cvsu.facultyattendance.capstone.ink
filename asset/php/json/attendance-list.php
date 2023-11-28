<?php

  session_start();
  require "../connection.php";
  $conn = connect();
  $id = $_SESSION["id"];

  $attendance_list = "SELECT `date`, `time_in`, `time_out`, `total_hour` FROM `attendance_tbl` WHERE  `information_id` = $id ORDER BY `id` DESC";

  $sql = mysqli_query($conn, $attendance_list) or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));

?>