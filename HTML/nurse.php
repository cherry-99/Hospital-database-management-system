<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";
$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();
$emp_id = $_COOKIE["empid"];
$nurse_id = $_COOKIE["nurse_id"];

if(isset($_POST["update_info"]))
{
    $age = $_POST["age"];
    $name=$_POST["name"];
    $contact_no=$_POST["contact_no"];
    $house_no = $_POST["house_no"];
    $street = $_POST["street"];
    $area =$_POST["area"];
    $city =$_POST["city"];
    $query = "UPDATE hospital_employee SET employee_name='".$name."',contact_no='".$contact_no."', age = '".$age."' WHERE emp_id = $emp_id";
    $result = pg_query($db,$query);
    $query = "UPDATE emp_address SET house_no='".$house_no."',street='".$street."', area = '".$area."',city = '".$city."' WHERE emp_id = $emp_id";
    $result = pg_query($db,$query);
    header("location: nurse.php");
}

if(isset($_POST["update_password"]))
{
    $curr_psw=$_POST["curr_psw"];
    $new_psw=$_POST["new_psw"];
    $rep_psw=$_POST["rep_new_psw"];
    $query = "SELECT password FROM EMPLOYEE_LOGIN WHERE emp_id = $emp_id";
    $result = pg_query($db,$query);
    $result_array = pg_fetch_assoc($result);
    $check_psw = $result_array["password"];
    if($rep_psw!=$new_psw)
    {
        echo '<script language="javascript">';
        echo 'alert("Repeat Password does not match New password")';
        echo '</script>';
        array_push($errors1,"1");
    }
    if($curr_psw != $check_psw)
    {
        echo '<script language="javascript">';
        echo 'alert("Current Password does not match")';
        echo '</script>';
        array_push($errors1,"0");
    }
    if(count($errors1)<=0)
    {
        $query="UPDATE employee_login SET password = '".$new_psw."' WHERE emp_id = $emp_id";
        $result=pg_query($db,$query);
        header("location: login.html");
    }
}
//The following code is for retrieving the nurse details and displaying it in the form
//Remove the address field or add multiple fields so that we can retrieve the same in order from the address cross reference table
$query = "SELECT employee_name , gender, age, emp_type, salary ,contact_no FROM hospital_employee WHERE emp_id = $emp_id";
$result = pg_query($db,$query);
$answer = pg_fetch_array($result);
$name = $answer[0];
$gender = $answer[1];
$age = $answer[2];
$emp_type = $answer[3];
$salary = $answer[4];
$ph_no = $answer[5];
$query = "SELECT house_no , street, area, city FROM emp_address WHERE emp_id = $emp_id";
$result = pg_query($db,$query);
$answer = pg_fetch_array($result);
$house_no = $answer[0];
$street = $answer[1];
$area = $answer[2];
$city = $answer[3];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Hospital Database</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="main.css">
    <script src="myScript.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>

<body>

    <div class="page-header">
        <h1>Hospital Database</h1>
    </div>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <ul class="nav navbar-nav">
                <li class="active" onclick="nurse_forms(1)"><a href="#">Personal Information</a></li>
                <li><a href="update_inventory.php">Update Inventory</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li onclick="nurse_forms(2)"><a href="#">Update Information</a></li>
                        <li onclick="nurse_forms(3)"><a href="#">Change Password</a></li>
                        <li><a href="login.html">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <div id="nurse_details">
        <form class="form">
            <div class="form-group-sm">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $name; ?>">
            </div>
            <div class="form-group-sm">
                <h5><b>Gender:</b></h5>
                <input type="text" class="form-control" id="name" name="name" disabled value="<?php echo $gender; ?>">
            </div>
            <div class="form-group-sm">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" disabled value="<?php echo $age; ?>">
            </div>
            <div class="form-group-sm">
                <label for="contact_no">Contact Number:</label>
                <input type="tel" class="form-control" id="contact_no" name="contact_no" disabled value="<?php echo $ph_no; ?>">
            </div>
            <div class="form-group-sm">
                <label for="job_type">Job Type:</label>
                <input type="text" class="form-control" id="job_type" name="job_type" disabled value="<?php echo $emp_type; ?>">
            </div>
            <div class="form-group-sm">
                <label for="house_no">House No:</label>
                <input type="number" class="form-control" id="house_no" name="house_no" disabled value="<?php echo $house_no; ?>">
            </div>
            <div class="form-group-sm">
                <label for="street">Street:</label>
                <input type="text" class="form-control" id="street" name="street" disabled value="<?php echo $street; ?>">
            </div>
            <div class="form-group-sm">
                <label for="area">Area:</label>
                <input type="text" class="form-control" id="area" name="area" disabled value="<?php echo $area; ?>">
            </div>
            <div class="form-group-sm">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" disabled value="<?php echo $city; ?>">
            </div>
            <div class="form-group-sm">
                <label for="salary">Salary:</label>
                <input type="text" class="form-control" id="salary" name="salary" disabled value="<?php echo $salary; ?>">
            </div>
        </form>
        <?php 
            $host = "host = localhost";
            $port = "port = 5432";
            $dbname = "dbname = test";
            $credentials = "user = postgres password=15739";
            $db = pg_connect("$host $port $dbname $credentials");
            $query="CREATE VIEW nurse_rooms AS SELECT room_incharge.room_no,room_assigned.pat_id,pat_name FROM room_incharge LEFT OUTER JOIN room_assigned ON room_incharge.room_no=room_assigned.room_no LEFT OUTER JOIN patient ON room_assigned.pat_id=patient.pat_id WHERE room_incharge.nurse_id=$nurse_id";
            $result = pg_query($db,$query);
            $query = "SELECT * FROM nurse_rooms";
            $result = pg_query($db,$query);
            echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
            echo "<thead><tr><th>ROOM NO</th><th>Patient ID</th> <th>PATIENT NAME</th></tr></thead><tbody>";
            // loop through results of database query, displaying them in the table
            while($row = pg_fetch_array( $result )) 
            {
                    // echo out the contents of each row into a table
                    echo "<tr>";
                    echo '<td>' . $row['room_no'] . '</td>';
                    echo '<td>' . $row['pat_id'] . '</td>';
                    echo '<td>' . $row['pat_name'] . '</td>'.'</tr>';
            }
            echo "</tbody></table>";
            $query="DROP VIEW nurse_rooms";
            $result = pg_query($db,$query);
        ?>
    </div>
    <div id="info_form">
        <form class="form" action="/Hospital-DBMS/HTML/nurse.php" method="POST" >
            <div class="form-group-sm">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="age">Age:</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $age; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="contact_no">Contact Number:</label>
                <input type="number" class="form-control" id="contact_no" name="contact_no" value="<?php echo $ph_no; ?>" required>
            </div>
             <div class="form-group-sm">
                <label for="house_no">House No:</label>
                <input type="number" class="form-control" id="house_no" name="house_no" value="<?php echo $house_no; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="street">Street:</label>
                <input type="text" class="form-control" id="street" name="street" value="<?php echo $street; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="area">Area:</label>
                <input type="text" class="form-control" id="area" name="area" value="<?php echo $area; ?>" required>
            </div>
            <div class="form-group-sm">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" value="<?php echo $city; ?>" required>
            </div>
            <button type="submit" name="update_info" class="btn btn-default" value="submit">Submit</button>
        </form>
    </div>

    <div id="pass_form">
        <form class="form" action="/Hospital-DBMS/HTML/nurse.php" method="POST">
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Current Password" name="curr_psw" value="" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="New Password" name="new_psw" value="" required />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Repeat New Password" name="rep_new_psw" value="" required />
            </div>
            <button type="submit" name="update_password" class="btn btn-default" value="submit">Submit</button>
        </form>
    </div>
</body>

</html>