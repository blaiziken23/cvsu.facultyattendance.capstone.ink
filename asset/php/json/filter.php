<?php

  session_start();
  require "../connection.php";
  $conn = connect();
  
  if ($_SESSION['logged_in'] == false) {
    header("Location: ./php/login.php");
  }
  
  if (isset($_GET["filter"])) {
    
    $id = $_SESSION["id"];

    $from = $_GET["from"];
    $to = $_GET["to"];

    // $filter = "SELECT 
    //             employee_information.firstname AS fname, 
    //             employee_information.lastname AS lname,
    //             employee_attendance.date AS dates, 
    //             employee_information.employee_id AS empid, 
    //             employee_attendance.time_in AS timein,
    //             employee_attendance.time_out AS timeout,
    //             employee_attendance.total_hour AS tot_hour,
    //             employee_attendance.status AS status
    //           FROM 
    //             employee_attendance
    //           INNER JOIN 
    //             employee_information
    //           ON 
    //             employee_information.information_id = employee_attendance.information_id
    //           WHERE 
    //             employee_attendance.date 
    //               BETWEEN '$from' AND '$to' 
    //             AND (employee_information.firstname LIKE '%$id_or_name%' 
    //             OR employee_information.lastname LIKE '%$id_or_name%'
    //             OR employee_information.employee_id = '$id_or_name')";


    
    $filter = "SELECT `id`, `date`, `time_in`, `time_out`, `status`, `total_hour` FROM `attendance_tbl` WHERE `information_id` = '$id' AND `date` BETWEEN '$from' AND '$to' ORDER BY `id` DESC";
    $result = mysqli_query($conn, $filter);
  
    echo '<table class="table" id="sample">
          <tr>
            <th rowspan="2" class="align-middle text-center">Day</th>
            <th colspan="2" class="align-middle text-center">AM</th>
            <th colspan="2" class="align-middle text-center">PM</th>
          </tr>
          <tr>
              <th>Arrival</th>
              <th>Departure</th>
              <th>Arrival</th>
              <th>Departure</th>
          </tr>';

  while ($row = mysqli_fetch_assoc($result)) {
      echo '<tr>';
      echo '<td>' . $row['date'] . '</td>';

      if (strtotime($row['time_in']) < strtotime('12:00:00')) {
          echo '<td>' . date("h:i", strtotime($row['time_in']))  . '</td>';
          echo '<td>' . date("h:i", strtotime($row['time_out'])) . '</td>';
          echo '<td></td>';
          echo '<td></td>';
      } 
      else {
          echo '<td></td>';
          echo '<td></td>';
          echo '<td>' . date("h:i", strtotime($row['time_in'])) . '</td>';
          echo '<td>' . date("h:i", strtotime($row['time_out'])) . '</td>';
      }

      echo '</tr>';
  }

  // Tapusin ang HTML table
  echo '</table>';
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
  <title>Reports</title>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  <link rel="stylesheet" href="../../css/style.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>

</head>
<body>

  <div class="container shadow-sm p-3">
   <nav class="navbar py-3 mb-3">
      <div class="container-fluid">
        <h3 class="mb-0">Attendance Reports</h3>
        <a href="../admin.php#report" class="btn btn-danger"><i class="bi bi-x-lg"></i></a>
        <!-- <a href="admin.php#employee" class="btn-close" aria-label="Close"></a> -->
      </div> 
    </nav>
    <?php 
      echo "<div class='mb-2 text-capitalize'>
              <h6>Search Results:</h6>
              <span class='fw-bold'>Name / Employee ID:</span> $id <br> 
              <span class='fw-bold'>From:</span> $from <br> 
              <span class='fw-bold'>To:</span> $to
            </div>";
    ?>
    <table class="stripe hover cell-border" id="table_id">
      <thead>
        <tr>
          <th>Date</th>
          <th>Time in</th>
          <th>Time out</th>
          <th>Total Hour</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $result = mysqli_query($conn, $filter);
          while($filter_row = mysqli_fetch_array($result)) {
            $date = $filter_row["date"];
            $time_in = $filter_row["time_in"];
            $time_out = $filter_row["time_out"];
            $total_hour = $filter_row["total_hour"];
            $status = $filter_row["status"];
        ?>
        <tr>
          
          <td> <?php echo $date ?> </td>
          <td> <?php echo $time_in ?> </td>
          <td> <?php echo $time_out ?> </td>
          <td> <?php echo $total_hour ?> </td>
          <td> <?php echo $status ?> </td>

        </tr>
        <?php } ?>
      </tbody>
    </table>





    
    <div class="d-flex justify-content-end py-3">
      <button type="button" class="btn btn-success" id="export"><i class="bi bi-save pe-2"></i>Export</button>
    </div>
  </div>
  

<!-- <script type="module" src="../../js/export.js"></script> -->
<script src="jspdf.js"></script>
<script src="jspdf-autotable.js"></script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script>
  console.log("hello1");
  window.jsPDF = window.jspdf.jsPDF;

  const doc = new jsPDF()
  console.log(doc.getFontList());

  $(document).ready( function () {
    $('#table_id').DataTable({
      
    });
  });

  function html_table_to_excel(type) {
    var file = XLSX.utils.table_to_book(document.getElementById('table_id'), {
      sheet: "sheet1"
    });
    XLSX.write(file, { 
      bookType: type, 
      bookSST: true, 
      type: 'base64' 
    });
    XLSX.writeFile(file, 'file.' + type);
  }

  document.getElementById('export').addEventListener('click', () =>  {
    //html_table_to_excel('xlsx');
    console.log("hello");

    doc.setFontSize(8)
    doc.setFont('', 'italic', 'normal');
    doc.text('Civil Service Form No. 48', 25, 20)
    doc.setFontSize(13)
    doc.setFont('', '', 800);
    doc.text('DAILY TIME RECORD', 40, 28)
    doc.setFontSize(12)
    doc.text('BERDIN JAYVIE', 30, 39)
    doc.setLineWidth(.3); 
    doc.line(25, 40, 125, 40);
    doc.setFontSize(8)
    doc.text('(Name)', 65, 43)
    doc.autoTable({ 
      html: '#sample', 
      columnStyles: { 
        0: { 
          halign: 'center',
          cellWidth: 20
        },
        1: { 
          halign: 'center',
          cellWidth: 20
        },
        2: {
          halign: 'center',
          cellWidth: 20
        },
        3: {
          halign: 'center',
          cellWidth: 20
        },
        4: {
          halign: 'center',
          cellWidth: 20
        }
      },
      theme: 'grid',
      margin: {
        top: 60,
        left: 25
      },
      styles: {
        fontSize: 8
      },
      tableWidth: 80
    });
    doc.save('table.pdf')
  });


  document.querySelectorAll("td span.status").forEach((status) => {
    // console.log(status)
    if (status.innerHTML == "absent") {
      status.classList.add("bg-danger", "text-white", "px-1", "rounded");
    }
    else if (status.innerHTML == "late") {
      status.classList.add("bg-warning", "text-white", "px-1", "rounded");
    }
    else {
      status.classList.add("bg-success", "text-white", "px-1", "rounded");
    }
  })

</script>
</body>
</html>

