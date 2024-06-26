<?php

  session_start();
  require "connection.php";
  $conn = connect();

  $id = $_SESSION["id"];
  $result = mysqli_query($conn, "SELECT * FROM facultyaccount_tbl WHERE `information_id` = '$id' "); 
  $rows = mysqli_fetch_assoc($result);

  $image = mysqli_query($conn, "SELECT * FROM `information_tbl` WHERE `id` = '$id'");
  $getimage = mysqli_fetch_assoc($image);
  
  //echo "<script> alert('$id') </script>";
  if ($_SESSION['logged_in'] == false) {
    header("Location: login.php");
  }

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/admin.css">
  
  <!-- <link href="https://unpkg.com/gridjs/dist/theme/mermaid.min.css" rel="stylesheet" /> -->
  <link href="https://cdn.jsdelivr.net/npm/gridjs@6.0.6/dist/theme/mermaid.min.css" rel="stylesheet">
  <!-- sweet alert -->
  <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
  <title>Dashboard</title>
</head>
<body>

  <!-- side nav -->
  <section class="shadow" id="sidenav">
    <div class="card mb-3">
      <a href="admin.php#dashboard"><img src="../img/logo/logo.png" class="card-img-top p-2" alt=""></a>
      <div class="card-footer">
        <h6 class="card-title mb-0 text-center">Cavite State University General Trias</h6>
      </div>
    </div>
    <h5 class="text-center text-capitalize mb-3">Welcome <?php echo $rows["username"]; ?></h5>
    <hr>
    <div class="nav flex-column nav-pills w-100" id="v-pills-tab" role="tablist" aria-orientation="vertical">
      <button class="nav-link active" href="#dashboard" data-bs-toggle="pill" data-bs-target="#dashboard" type="button">
        <span>
          <i class="bi bi-speedometer2"></i>
          Dashboard
        </span>
      </button>
      <a class="nav-link" href="#monitor" type="button" data-bs-toggle="collapse" data-bs-target="#sub-monitor" id="monitor-nav">
        <span>
          <i class="bi bi-tv"></i>
          Monitor
        </span> 
        <div class="d-flex justify-content-end">
          <i class="bi bi-chevron-down"></i>
        </div>
      </a>
      <!-- sub monitor -->
      <div class="collapse" id="sub-monitor">
        <div class="ms-3 border-start border-2">
          <button class="nav-link w-100 ms-1" href="#present" data-bs-toggle="pill" data-bs-target="#present" type="button">
            <span class="">
              <i class="bi bi-building-add"></i>
              Present
            </span>
          </button>
          <button class="nav-link w-100 ms-1" href="#absent" data-bs-toggle="pill" data-bs-target="#absent" type="button">
            <span class="">
              <i class="bi bi-building-fill-dash"></i>
              Absent
            </span>
          </button>
          <button class="nav-link w-100 ms-1" href="#ontime" data-bs-toggle="pill" data-bs-target="#ontime" type="button">
            <span class="">
              <i class="bi bi-building-check"></i>
              Ontime
            </span>
          </button>
          <button class="nav-link w-100 ms-1" href="#late" data-bs-toggle="pill" data-bs-target="#late" type="button">
            <span class="">
              <i class="bi bi-building-fill-x"></i>
              Late
            </span>
          </button>
          <button class="nav-link w-100 ms-1" href="#complete" data-bs-toggle="pill" data-bs-target="#complete" type="button">
            <span class="">
              <i class="bi bi-building"></i>
              Complete
            </span>
          </button>
          <button class="nav-link w-100 ms-1" href="#incomplete" data-bs-toggle="pill" data-bs-target="#incomplete" type="button">
            <span class="">
              <i class="bi bi-building-fill"></i>
              Incomplete
            </span>
          </button>
          
        </div>
      </div>
      <button class="nav-link" href="#schedule" data-bs-toggle="pill" data-bs-target="#schedule" type="button">
        <span>
          <i class="bi bi-calendar"></i>
          My Schedule
        </span>
      </button>
      <button class="nav-link" href="#attendance" data-bs-toggle="pill" data-bs-target="#attendance" type="button">
        <span>
          <i class="bi bi-people"></i>
          Attendance List
        </span>
      </button>
      <button class="nav-link" href="#report" data-bs-toggle="pill" data-bs-target="#report" type="button">
        <span>
          <i class="bi bi-save"></i>
          Attendance Report
        </span>
      </button>
      <button class="nav-link" href="#employee" data-bs-toggle="pill" data-bs-target="#employee" type="button">
        <span>
          <i class="bi bi-person-lines-fill"></i>
          Profile
        </span>
      </button>
    </div>
  </section>

  <!-- side nav content -->
  <div class="content" id="content">
    <nav class="navbar shadow">
      <div class="container-fluid"> 
        <button type="button" id="toggle-nav">
          <i class="bi bi-list m-0"></i>
        </button>
        <form class="d-flex" role="search">
          <div class="btn-group dropstart">
            <button class="btn btn-sm dropdown-toggle p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              <img src="../profilepic/<?php echo $getimage["image"]; ?>" class="img-fluid">
            </button>
            <ul class="dropdown-menu dropdown-menu-end p-2 shadow"> 
              <!-- <li><a class="dropdown-item" href="admin.php?#attendance">
                <i class="bi bi-people me-1"></i> 
                Attendance
              </a> </li>
              <li><a class="dropdown-item" href="admin.php?#employee">
                <i class="bi bi-person-lines-fill me-1"></i> 
                Employee
              </a></li>
              <li><a class="dropdown-item" href="admin.php?#schedule">
                <i class="bi bi-calendar me-1"></i>  
                Schedule 
              </a></li> -->
              <li><a class="dropdown-item me-1 bg-danger text-white rounded" href="logout.php">
                <i class="bi bi-box-arrow-right"></i> 
                Logout
              </a></li>
            </ul>
          </div>
        </form>
      </div>
    </nav>
    <div class="tab-content">
      <!-- <div class="details pt-3 d-flex justify-content-end">
        <div>
          <div class="d-flex" id="displayTime"></div>
          <div class="d-flex" id="getday"></div>
        </div>
        <button type="button" class="btn shadow-sm" data-bs-toggle="modal" data-bs-target="#qrcode" id="scan-qrcode">
          <i class="bi bi-qr-code-scan fs-5 me-2"></i>
          SCAN
        </button>
      </div>
      <hr> -->
      
      <!-- content -->
      <!-- dashboard -->
      <div class="tab-pane fade show active" id="dashboard">
        <div class="row row-cols-lg-3 pt-3">
          <div class="col-lg">
            <div class="card mb-3 shadow-sm">
              <div class="row g-0">
                <div class="col-md-4">
                  <i class="bi bi-building-add"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">
                      Present
                    </h5>
                    <h5 class="card-text">
                      
                    <?php   
                        $total = "SELECT * FROM attendance_tbl WHERE `status` != 'ABSENT' AND `information_id` = $id";
                        $total_run = mysqli_query($conn, $total);
                        
                        if($total_present = mysqli_num_rows($total_run)){
                            echo $total_present;
                        }
                        else{
                            echo 0;
                        }
                    ?>
                    </h5>
                    <div class="d-flex justify-content-end">
                      <a href="admin.php?#present" class="btn btn-sm">View more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg">
            <div class="card mb-3 shadow-sm">
              <div class="row g-0">
                <div class="col-md-4">
                  <i class="bi bi-building-check"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Ontime</h5>
                    <h5 class="card-text">
                      
                    </h5>
                    <div class="d-flex justify-content-end">
                      <a href="admin.php?#ontime" class="btn btn-sm ">View more</a>
                    </div>
                  </div>
                </div>
              </div>
              </div>
            </div>
          <div class="col-lg">
            <div class="card mb-3 shadow-sm">
              <div class="row g-0">
                <div class="col-md-4">
                  <i class="bi bi-building"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">Complete Attendance</h5>
                    <h5 class="card-text">
                    </h5>
                    <div class="d-flex justify-content-end">
                      <a href="admin.php?#complete" class="btn btn-sm ">View more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg">
            <div class="card mb-3 shadow-sm">
              <div class="row g-0">
                <div class="col-md-4">
                  <i class= "bi bi-building-fill-dash"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">
                      Absent
                    </h5>
                    <h5 class="card-text">
                      
                    </h5>
                    <div class="d-flex justify-content-end">
                      <a href="admin.php?#absent" class="btn btn-sm">View more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg">
            <div class="card mb-3 shadow-sm">
              <div class="row g-0">
                <div class="col-md-4">
                  <i class="bi bi-building-fill-x"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">
                      Late
                    </h5>
                    <h5 class="card-text">
                      
                    </h5>
                    <div class="d-flex justify-content-end">
                      <a href="admin.php?#late" class="btn btn-sm">View more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--div class="col-lg">
            <div class="card mb-3 shadow-sm">
              <div class="row g-0">
                <div class="col-md-4">
                  <i class="bi bi-building"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">
                      Ontime
                    </h5>
                    <h5 class="card-text">
                     
                    </h5>
                    <div class="d-flex justify-content-end">
                      <a href="admin.php?#ontime" class="btn btn-sm">View more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div-->
          <div class="col-lg">
            <div class="card mb-3 shadow-sm">
              <div class="row g-0">
                <div class="col-md-4">
                  <i class="bi bi-building-fill"></i>
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">
                      Incomplete Attendance
                    </h5>
                    <h5 class="card-text">
                    </h5>
                    <div class="d-flex justify-content-end">
                      <a href="admin.php?#incomplete" class="btn btn-sm">View more</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- monitor -->
      <div class="tab-pane fade" id="monitor"> </div>
      <div class="tab-pane fade pt-3 " id="attendance">
        <div class="d-flex justify-content-between">
          <h3>Attendance List</h3>
        </div>
        <div id="attendance-list-table" class="row"></div>
      </div>
      <div class="tab-pane fade pt-3" id="report">
        <div class="d-flex justify-content-between mb-3">
          <h3>Create Attendance Report</h3>
        </div>
        <div class="container d-flex shadow-sm p-4 rounded" id="create-report">
          <form action="json/filter.php" method="GET" class="">
            <!-- <label for="id_or_name">Name or Employee ID</label> -->
            <!-- <input type="text" disabled class="form-control mb-3" name="id_or_name" id="id_or_name" autocomplete="off" value="<?php echo $rows["firstname"].$rows["lastname"]; ?>"> -->
            <label for="from">From</label>
            <input type="date" class="form-control mb-3" name="from" id="from" required>
            <label for="to">To</label>
            <input type="date" class="form-control mb-3" name="to" id="to" required>
            <input type="submit" value="Create" class="btn btn-success w-100" name="filter">
          </form>
        </div>
    
      </div>
      <div class="tab-pane fade pt-3" id="schedule">
        <div class="">
          <h3>Today Schedule</h3>
          <div id="sched" class="d-flex justify-content-center"></div>
        </div>
      </div>
      <div class="tab-pane fade pt-3" id="employee">
        <div class="d-flex justify-content-between">
          <h3>My Profile</h3>
        </div class="profile">
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item active" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Profile</button>
            </li>
            <!--<li class="nav-item" role="
            ation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Contact</button>
            </li>-->
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="">
              <div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                My Information:
                <div class="mb-3">
                  <form action="./update-info.php" class="" runat="server" method="post" enctype="multipart/form-data"> 
                    <label>Current username:</label>
                    <input type="text" class="form-control" value="<?php echo $rows["username"]; ?>" readonly><br>
                    <label for="exampleFormControlInput1" class="form-label">Profile Picture</label>
                    <input type="file" name="image" accept="image/png, image/jpeg" style="width: 100%" class="form-control" onchange="loadFile(event)">
                    <br>
                    <img style="width:500px;" id="output"/>
                    <br><br>
                    <input type="submit" class="btn btn-primary" value="Update" name="update-btn">
                  </form>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">...</div>
            <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">...</div>
          </div>
        <div id="wrapper" class="d-flex justify-content-center"></div>
      </div>
      <!-- sub monitor tab -->
      <div class="tab-pane fade pt-3" id="present">
        <h5>Present</h5>
        <div id="present-table" class="row"></div>
      </div>
      <div class="tab-pane fade pt-3" id="absent">
        <h5>Absent</h5>
        <div id="absent-table" class="row"></div>
      </div>
      <div class="tab-pane fade pt-3" id="ontime">
        <h5>Ontime</h5>
        <div id="ontime-table"></div>
      </div>
      <div class="tab-pane fade pt-3" id="late">
        <h5>Lates</h5>
        <div id="late-table"></div> 
      </div>
      <div class="tab-pane fade pt-3" id="complete">
        <h5>Complete</h5>
        <div id="complete-table"></div> 
      </div>
      <div class="tab-pane fade pt-3" id="incomplete">
        <h5>Incomplete</h5>
        <div id="incomplete-table"></div> 
      </div>
    </div>
  </div>

  <!-- qrocode modal -->
  <!-- <div class="modal fade" id="qrcode" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel"><i class="bi bi-qr-code-scan me-2"></i>Scan Qr Code</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"  id="close"></button>
        </div>
        <div class="modal-body">
          <div class="container p-3">
            <div class="row">
              <div class="col">
                <video id="preview"></video>
              </div>
              <div class="col">
                <form action="" method="POST">
                  <input type="text" class="form-control" id="value" name="qrcode-value">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->


  <!-- add employee modal -->
  <!-- <div class="modal fade" id="add-emp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <form action="add-employee.php" method="POST">
          <div class="modal-header">
            <h2 class="modal-title fs-5" id="staticBackdropLabel">
              <i class="bi bi-person-fill-add"></i>
              Add Employee
            </h2>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"  id="close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col"> 
                <div>
                  <h4 class="mb-3 text-center">CvSU Gentri employee</h4>
                </div>
                <div class="row">
                  <div class="col">
                    <input type="text" class="form-control mb-3 form-control-sm" name="firstname" placeholder="First Name" autocomplete="off" required>
                  </div>
                  <div class="col">
                    <input type="text" class="form-control mb-3 form-control-sm" name="lastname" placeholder="Last Name" autocomplete="off" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">
                    <input type="email" class="form-control mb-3 form-control-sm" name="email" placeholder="Email" autocomplete="off" required>
                  </div>
                  <div class="col-4">
                    <select class="form-select mb-3 form-select-sm" name="gender" placeholder="gender" autocomplete="off" required>
                      <option>Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <select class="form-select mb-3 form-select-sm" name="department" required>
                      <option>Select Department</option>
                      <option value="BSIT">Information Technology Department</option>
                      <option value="BSBM">Business Management Department</option>
                      <option value="BSOA">Office Administration Department</option>
                      <option value="BSHM">Hotel Management Department</option>
                      <option value="BSTM">Tourism Management Department</option>
                      <option value="BSE">Secondary Education - Major in English Department</option>
                      <option value="BSP">Psychology Department</option>
                      <option value="others">Others</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-sm btn-primary" name="add-employee">Add</button>
          </div>
        </form>
      </div>
    </div>
  </div> -->
  
<script>
	  var loadFile = function(event) {
	    var reader = new FileReader();
	    reader.onload = function(){
	      var output = document.getElementById('output');
	      output.src = reader.result;
	    };
	    reader.readAsDataURL(event.target.files[0]);
	  };
</script>
<script src="../js/admin.js" defer></script>
<!-- jquery -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gridjs/6.0.6/gridjs.production.min.js" integrity="sha512-wpiJjuL800CTEBA0QFs+RFw0tFtpXnQGea1p9S16WcYNXC1F3U0l1L7FQrDC3ihkYRtOj4Td7lKR3mYKxrwMMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script> -->

<!-- <script src="https://cdn.jsdelivr.net/npm/gridjs@6.0.6/dist/gridjs.production.min.js"></script> -->

<script src="../js/bs-history/bs-history.js"></script>
<script src="../js/fetch/employee.js"></script>
<script>
</script>
</body>
</html>