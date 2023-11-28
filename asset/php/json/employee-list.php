<?php

  require "../connection.php";
  $conn = connect();

  $sql = mysqli_query($conn, "SELECT * FROM `information_tbl` ORDER BY `id` DESC") or die(mysqli_error());
  exit(json_encode(mysqli_fetch_all($sql, MYSQLI_ASSOC)));


?>
