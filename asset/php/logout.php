<?php

  session_start();
  unset($_SESSION["id"]);
  unset($_SESSION["logged_in"]);
  session_destroy();
  //header("Location: https://www.cvsu.facultyattendance.capstone.ink");
  header("Location: ./login.php");

?>