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

    $filter = "SELECT `id`, `fullname`, `date`, `time_in`, `time_out`, `status`, `total_hour` FROM `attendance_tbl` WHERE `information_id` = '$id' AND `date` BETWEEN '$from' AND '$to' ORDER BY `date`";
    $result = mysqli_query($conn, $filter);
    $row = mysqli_fetch_assoc($result);
    $name = $row["fullname"];
    echo '<table class="table" id="sample">
          <tr>
            <th rowspan="2" class="align-middle text-center">Day</th>
            <th colspan="2" class="align-middle text-center">AM</th>
            <th colspan="2" class="align-middle text-center">PM</th>
            <th colspan="2" class="align-middle text-center">Undertime</th>
          </tr>
          <tr>
              <th>Arrival</th>
              <th>Departure</th>
              <th>Arrival</th>
              <th>Departure</th>
              <th>Hours</th>
              <th>Minutes</th>
          </tr>';

  while ($row = mysqli_fetch_assoc($result)) {
    echo '<tr>';
    echo '<td>' . $row['date'] . '</td>';
    
    echo $row['total_hour'] . " " ;

    if (strtotime($row['time_in']) < strtotime('12:00:00')) {
      echo '<td>' .  date("h:i A", strtotime($row['time_in']))  . '</td>';
    }
    if (strtotime($row['time_in']) < strtotime('12:00:00') && strtotime($row['time_out']) > strtotime('12:00:00') || $row['time_out'] == "12:00:00") {
      echo '<td></td>';
      echo '<td></td>';
      echo '<td>' .  date("h:i A", strtotime($row['time_out']))  . '</td>';
    }
    if (strtotime($row['time_in']) < strtotime('12:00:00') && strtotime($row['time_out']) < strtotime('12:00:00')) {
      echo '<td>' .  date("h:i A", strtotime($row['time_out']))  . '</td>';
    }

    if (strtotime($row['time_in']) > strtotime('12:00:00')) {
      echo '<td></td>';
      echo '<td></td>';
      echo '<td>' .  date("h:i A", strtotime($row['time_in']))  . '</td>';
    }
    if (strtotime($row['time_in']) > strtotime('12:00:00') && strtotime($row['time_out']) > strtotime('12:00:00')) {
      echo '<td>' .  date("h:i A", strtotime($row['time_out']))  . '</td>';
    }

    

    echo '</tr>';
  }
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
    doc.setFont('Helvetica', 'italic', '');
    doc.text('Civil Service Form No. 48', 25, 20)
    doc.setFontSize(13)
    doc.setFont('Helvetica', '', 'Bold');
    doc.text('DAILY TIME RECORD', 150/2, 28, {
      align: 'center'
    })
    doc.setFontSize(12)
    doc.text('<?php echo $name; ?>', 150/2, 39, {align: 'center'})
    doc.line(25, 40, 125, 40);
    doc.setFontSize(8)
    doc.setFont('Helvetica', '', 'normal');
    doc.text('(Name)', 150/2, 43, {align: 'center'})
    doc.setFont('Helvetica', 'italic', 'normal');
    doc.text('For the month of', 25, 50)
    doc.line(50, 52, 125, 52);
    doc.text("Official hours for arrival", 25, 59)
    doc.text("and departure", 30, 62)
    doc.text("Regular days", 70, 57)
    doc.line(90, 59, 125, 59);
    doc.text("Saturdays", 74, 63)
    doc.line(90, 65, 125, 65);

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
        },
        5: {
          halign: 'center',
          cellWidth: 20
        },
        6: {
          halign: 'center',
          cellWidth: 20
        }
      },
      theme: 'grid',
      margin: {
        top: 70,
        left: 25
      },
      styles: {
        fontSize: 8
      },
      alternateRowStyles: {
        //valign: 'center'
      }
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

