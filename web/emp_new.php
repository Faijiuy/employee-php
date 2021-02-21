<?php
require_once("config.php");

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['cmd']) && $_POST['cmd'] == 'add') {
    // Add new employee
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $emp_no = $_POST['emp_no'];
    $gender = $_POST['gender'];
    $birth_date = $_POST['birth_date'];
    $hire_date = $_POST['hire_date'];

    $sql = "INSERT INTO employees (emp_no,birth_date,first_name,last_name,gender,hire_date)
            VALUES ('$emp_no','$birth_date','$first_name','$last_name','$gender','$hire_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Success<br/>$sql<br/>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<head>
    <title>Employees Management</title>
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
            background-color: #f1f1f1;
            height: 130%;
            font-size: large;
        }

        nav {
            font-size: large;
        }

        table {
            width: 90%
        }

        thead {
            background-color: rgba(255, 99, 71, 0.5);
        }

        td {
            text-align: center;
            font-size: large;
        }

        #leftAlign {
            font-size: large;
            text-align: left;
        }

        .btn-primary {
            font-size: large;
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
                font-size: large;
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
            <div class="col-sm-3 sidenav">
                <h3>Employee Sample App</h3>
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="/emp.php">View All Employees(emp.php)</a></li>
                    <li><a href="/emp_new.php">Insert New Employee(emp_new.php)</a></li>
                    <li><a href="/emp_mgnt.php">Update/Delete Employees(emp_mgnt.php)</a></li>
                </ul><br>
            </div>

            <div class="col-sm-9">
                <h1>Insert New Employee</h1><br />
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                    <input type="hidden" name="cmd" value="add" />
                    <table>
                        <tr>
                            <th>Emp#</th>
                            <td><input type="text" class="form-control" name="emp_no"></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td><input type="text" class="form-control" name="first_name"></td>
                        </tr>
                        <tr>
                            <th>Last Name</th>
                            <td><input type="text" class="form-control" name="last_name"></td>
                        </tr>
                        <tr>
                            <th>Birth Date</th>
                            <td><input type="date" class="form-control" name="birth_date"></td>
                        </tr>
                        <tr>
                            <th>Hire Date</th>
                            <td><input type="date" class="form-control" name="hire_date" value="<?php echo date("Y-m-d"); ?>"></td>
                        </tr>
                        <tr>
                            <th>Gender</th>
                            <td class="checkbox" id="leftAlign">
                                <input type="radio" name="gender" value="M">  Male<br />
                                <input type="radio" name="gender" value="F">  Female
                            </td>
                        </tr>
                    </table>
                    <input class="btn btn-primary" type="submit" value="Create" />
                </form>
            </div>
        </div>
    </div>

    <footer class="container-fluid" id="leftAlign">
        <p>Apisara Choppradit ID:5710497</p>
    </footer>

</body>