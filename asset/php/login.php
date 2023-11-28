<?php

  session_start();
  require "connection.php";
  $conn = connect();

  if (isset($_POST["login"])) {
    
    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM `facultyaccount_tbl` WHERE username = '$username' ");
    $row = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) > 0) {
      if (password_verify($password, $row['password'])) {
        $_SESSION["logged_in"] = true;
        $_SESSION["id"] = $row["information_id"];
        echo 
          "<script> 
            location.href = './admin.php';
          </script>";
      }
      else {
        echo 
          "<script> 
            alert('Wrong Username or Password');
          </script>";
      }
    }
    else { 
      echo 
          "<script> 
            alert('Username Not Found');
        </script>";
    }
  }
  error_reporting(E_ERROR | E_PARSE);
   if ($_SESSION['logged_in'] == true) {
     //header("Location: https://www.cvsu.facultyattendance.capstone.ink/asset/php/admin.php");
     header("Location: ./admin.php");

   }  

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <!-- css -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/form.css">
  <title>Log in</title>
</head>
<body>


  <div class="container">
    <div class="row shadow-sm rounded">
      <div class="col-sm-5 form-img d-flex align-items-center justify-content-center p-3">
        <img src="../img/logo/logo.png" class="img-fluid" alt=" ">
      </div>
      <div class="col-sm-7 p-0 d-flex align-items-center ">
        <form action="" method="post" class="">
          <h3 class="mb-3 text-center">LOGIN</h3>
          <input type="text" class="form-control mb-3" name="username" placeholder="Username" autocomplete="off" required id ="txt">
          <input type="password" class="form-control mb-3" name="password" placeholder="Password" required>
          
            <div id="errorMessage" class="d-none alert alert-danger alert-dismissible fade">
              <strong>Error!</strong> Wrong Password or Username!
            </div>

          <div class="d-flex justify-content-center ">
            <button type="submit" class="btn btn-success w-100" name="login" id="login">Log in</button>
          </div>
          <div class="text-center pt-3">
            <a href="signup.php" class="btn btn-sm">Create Account ? </a>
          </div>
        </form>
      </div>
    </div>
  </div>


<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>
</html>