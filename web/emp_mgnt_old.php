<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
    .box {
        border: solid 1px black;
    }
</style>
<?php
require_once("config.php");

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<?php
// Process previous request
if (isset($_POST['cmd']) && $_POST['cmd'] == 'del') {
    // Delete employee
    $emp_no = $_POST['emp_no'];
    $sql = "DELETE FROM employees WHERE emp_no = $emp_no";
    //$result = mysqli_query($conn, $sql);

    //if ($conn->query($sql) === TRUE) {

    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_connect_error();;
    }
}
?>

<h1>Employee Management</h1>
<?php
//$sql = "SELECT * FROM employees LIMIT 10";
$sql = "
      select * from (employees e left join dept_emp de on e.emp_no = de.emp_no) join departments d on de.dept_no = d.dept_no
      limit 10;
      ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
?>
    <table>
        <tbody>
            <?php
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $emp_no = $row['emp_no'];
                // echo "<form action=\"{$_SERVER['PHP_SELF']}\" method=\"POST\" id=\"form{$emp_no}\">";
                // echo "<input type='hidden' name='cmd' value='del' />";
                // echo "<input type='hidden' name='emp_no' value='{$emp_no}'/>";
                // echo "<input type='button' onclick='confirmDelete(\"form{$emp_no}\",\"{$row['first_name']}\")' value='Delete' />";
                // echo " [{$emp_no}]:  - {$row['first_name']} {$row['last_name']}";
                // echo "</form>";
            ?>
                <tr>
                    <td class="box"><?php echo $row['emp_no']; ?></td>
                    <td class="box"><?php echo $row['first_name']; ?></td>
                    <td class="box"><?php echo $row['last_name']; ?></td>
                    <td class="box"><?php echo $row['birth_date']; ?></td>
                    <td class="box"><?php echo $row['hire_date']; ?></td>
                    <td class="box"><?php echo $row['gender']; ?></td>
                    <td class="box">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form<?php echo $row['emp_no']; ?>">
                            <input type="hidden" name="emp_no" value="<?php echo $row['emp_no']; ?>" />
                            <input type="hidden" name="cmd" value="del" />
                        </form>
                        <!-- <button type="submit" form="form<?php echo $row['emp_no']; ?>">
                            <img src="img/del_icon.jpg" width="20">
                        </button> -->
                        <button onClick='confirmDelete("form<?php echo $row['emp_no']; ?>", "<?php echo $row['first_name']; ?>")'>
                            <img src="img/del_icon.jpg" width="20">
                        </button>
                    </td>
                    <td class="box">
                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="formUpdate<?php echo $row['emp_no']; ?>">
                            <input type="hidden" name="emp_no" value="<?php echo $row['emp_no']; ?>" />
                            <input type="hidden" name="cmd" value="update" />
                            <button onClick=''>
                                <img src="img/edit_icon.png" width="20" />
                            </button>
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

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
<?php
}
mysqli_close($conn);
?>
<script>
    function confirmDelete(formId, empName) {
        // to type this `, hold ALT and then type 96
        if (confirm(`Are you sure to delete ${empName}?`)) {
            // go on an delete
            console.log("DELETE")
            document.getElementById(formId).submit()
        }
    }
</script>