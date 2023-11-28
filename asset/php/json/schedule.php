<?php
  session_start();
  require "../connection.php";
  $conn = connect();

  //$day = date("l");
  $id = $_SESSION["id"];
  
  $getsched = "SELECT * FROM `schedule_tbl` WHERE `information_id` = '$id' ORDER BY FIELD(day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";

  $sql = mysqli_query($conn, $getsched) or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));

?>