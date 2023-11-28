<?php

  session_start();
  require "connection.php";
  $conn = connect();

  if (isset($_POST["sign-up"])) {

    // $firstname = $_POST["firstname"];
    // $lastname = $_POST["lastname"];
    //$position = $_POST["position"];
    $facultyid = $_POST["faculty-id"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $checkfacultyid = mysqli_query($conn, "SELECT `id`, `faculty_id` FROM `information_tbl` WHERE `faculty_id` = '$facultyid' ");
    $rows = mysqli_num_rows($checkfacultyid);
    //echo $rows;
    $getid = mysqli_fetch_assoc($checkfacultyid);
    $id = $getid["id"];

    if ($rows == 0) {
      echo
        "<script> 
          alert('Invalid Faculty ID');
          location.href = 'signup.php';
        </script>";
    }
    else {
      
      $sql = "INSERT INTO `facultyaccount_tbl`(`username`, `password`, `information_id`) 
              VALUES ('$username', '$hashed_password', '$id')";
      
      if (mysqli_query($conn, $sql)) {
        echo
        "<script> 
          alert('Account Created... Login Now');
            location.href = 'login.php';
        </script>";
      }
      else {
        echo "<script> alert('Account Not Created, Try Again'); </script>";
      }
    }
    // else {

    //   $sql = "INSERT INTO `facultyaccount_tbl`(`firstname`, `lastname`, `username`, `password`) 
    //           VALUES ('$firstname', '$lastname', '$username', '$hashed_password')";
      
    //   if (mysqli_query($conn, $sql)) {
    //     echo
    //       "<script> 
    //         window.onload = () => {
    //           Swal.fire({
    //             icon: 'success',
    //             title: 'Account Created',
    //             text: 'You can now Login!',
    //             timer: '3000',
    //             showConfirmButton: false,
    //             allowOutsideClick: false,
    //             timerProgressBar: true
    //           }).then((result) => {
    //             if (result.dismiss === Swal.DismissReason.timer) {
    //               location.href = 'login.php';
    //             }
    //           });
    //         }; 
    //       </script>";
    //   }
    //   else {
    //     echo "<script> alert('Account Not Created, Try Again'); </script>";
    //   }
    // }
    Close();
  }
  if ($_SESSION['logged_in'] == true) {
    header("Location: /");
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- css -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/form.css">
  <title>Signup</title>
</head>
<body>



  <div class="container">
    <div class="row shadow-sm rounded">
      <div class="col-sm form-img d-flex justify-content-center align-items-center">
        <img src="../img/logo/logo.png" alt="" class="img-fluid">
      </div>
      <div class="col-sm">
        <form action="" method="POST" class="p-2">
          <h3 class="mb-3 text-center">SIGNUP</h3>
          <!-- <input type="text" class="form-control mb-3" name="firstname" placeholder="Firstname" autocomplete="off" required>
          <input type="text" class="form-control mb-3" name="lastname" placeholder="Lastname" autocomplete="off" required> -->
          <input type="number" class="form-control mb-3" name="faculty-id" placeholder="Faculty ID" autocomplete="off" required>
          <input type="text" class="form-control mb-3" name="username" placeholder="Username" autocomplete="off" required>
          <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
          <div class="d-flex justify-content-center ">
            <button type="submit" class="btn btn-success w-100" name="sign-up" id="sign-up">Sign up</button>
          </div>
          <div class="text-center pt-3">
            <a href="login.php" class="btn btn-sm">Login Account? </a>
          </div>
        </form>
      </div>
    </div>
  </div>


<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>