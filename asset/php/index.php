<?php

  if ($_SESSION['logged_in'] == false) {
    header("Location: login.php");
  }

?>