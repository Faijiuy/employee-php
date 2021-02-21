<?php
require_once("config.php");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>


<head>
  <title>Employees Sample App</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: 620px
    }

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: rgba(255, 99, 71, 0.5);
      height: 130%;
      font-size: medium;
    }

    nav {
      font-size: medium;
      background: #fc5369;
    }

    table {
      width: 90%;
    }

    thead {
      background-color: rgba(255, 99, 71, 0.5);
    }

    td {
      text-align: center;
      font-size: medium;
    }

    h1 {
      background-color: rgba(255, 99, 71, 0.5);
      width: 80%;
    }

    #leftAlign {
      font-size: medium;
      text-align: left;
    }

    .btn-primary {
      font-size: medium;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {

      .sidenav {
        height: auto;
        padding: 15px;
        font-size: medium;
      }

      .row.content {
        height: auto;
      }
    }
  </style>
</head>

<body>

  <div class="container-fluid">
    <nav class="navbar navbar-inverse">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="/emp.php">Employee Sample App</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="/emp.php">View All Employees</a></li>
          <li><a href="/emp_new.php">Insert New Employee</a></li>
          <li><a href="/emp_mgnt.php">Update/Delete Employees</a></li>
        </ul>
      </div>
    </nav>
    <div class="row content">
      <div class="col-sm-2 sidenav">
        <h3>Employee Sample App</h3>
        <ul class="nav nav-pills nav-stacked">
          <li><a href="/emp.php">View All Employees(emp.php)</a></li>
          <li><a href="/emp_new.php">Insert New Employee(emp_new.php)</a></li>
          <li><a href="/emp_mgnt.php">Update/Delete Employees(emp_mgnt.php)</a></li>
        </ul><br>
      </div>

      <div class="col-sm-10">
        <h1>Employees</h1>
        <?php


        $sql = "SELECT * FROM employees LIMIT 10";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $counter = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            echo "    id: " . $row["emp_no"] . " - Name: " . $row["first_name"] . " " . $row["last_name"] . "<br>";
            $counter++;
          }
          echo "$counter results";
        } else {
          echo "0 results";
        }
        ?>
        <hr />
        <h1>Departments</h1>
        <?php

        // Departments
        $sql = "SELECT * FROM departments LIMIT 10";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          $counter = 0;
          while ($row = mysqli_fetch_assoc($result)) {
            echo "    id: " . $row["dept_no"] . " - Name: " . $row["dept_name"] . "<br>";
            $counter++;
          }
          echo "$counter results";
        } else {
          echo "0 results";
        }


        mysqli_close($conn);

        // TODO Show list of departments
        ?>
      </div>
    </div>
  </div>

  <footer class="container-fluid" id="leftAlign">
    <p>Apisara Choppradit ID:5710497</p>
  </footer>

</body>