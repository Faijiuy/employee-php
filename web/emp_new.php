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
<h3>New Employee</h3>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <input type="hidden" name="cmd" value="add" />
    <table>
        <tr>
            <th>Emp#</th>
            <td><input type="text" name="emp_no"></td>
        </tr>
        <tr>
            <th>First Name</th>
            <td><input type="text" name="first_name"></td>
        </tr>
        <tr>
            <th>Last Name</th>
            <td><input type="text" name="last_name"></td>
        </tr>
        <tr>
            <th>Birth Date</th>
            <td><input type="date" name="birth_date"></td>
        </tr>
        <tr>
            <th>Hire Date</th>
            <td><input type="date" name="hire_date" value="<?php echo date("Y-m-d"); ?>"></td>
        </tr>
        <tr>
            <th>Gender</th>
            <td>
                <input type="radio" name="gender" value="M">Male<br />
                <input type="radio" name="gender" value="F">Female
            </td>
        </tr>
    </table>
    <input type="submit" value="Create" />
</form>