<?php
  
  $conn = "";

  function connect() {
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentserver_faculty_attendance";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // check connection
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }
    else {
      return $conn;
    }
  }

  function Close() {
    mysqli_close($conn);
  }


?>