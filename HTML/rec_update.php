<?php
$host = "host = localhost";
$port = "port = 5432";
$dbname = "dbname = test";
$credentials = "user = postgres password=15739";

$db = pg_connect("$host $port $dbname $credentials");
$errors1 = array();

if(isset($_POST["update_info"]))
{
    $pat_id = $_POST["pat_id"];
    $diagnosis=$_POST["diag"];
    $med_id = $_POST["med_id"];
    $query = "UPDATE patient SET diagnosis = '".$diagnosis."' WHERE pat_id = $pat_id";
    $query2 = "UPDATE medication SET med_id = '".$med_id."' WHERE pat_id = $pat_id";
    $result = pg_query($db,$query);
    $result2 = pg_query($db,$query2);
    header("location: rec_update.php");
}

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
                <li><a href="rec_insert.php">Add</a></li>
                <li class="active"><a href="rec_update.php">Change</a></li>
                <li><a href="rec_delete.php">Remove</a></li>
                <li><a href="view_database.php">View DB</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span
                            class="glyphicon glyphicon-user"></span> Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="rec_insert.php">Update Information</a></li>
                        <li><a href="rec_insert.php">Change Password</a></li>
                        <li><a href="login.html">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <?php  if (count($errors1) > 0) : ?>
    <div class="error">
        <?php foreach ($errors1 as $error) : ?>
        <p><?php echo $error ?></p>
        <?php endforeach ?>
    </div>
    <?php  endif ?>
    <div class="container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#emp">Employee</a></li>
            <li><a data-toggle="tab" href="#pat">Patient</a></li>
            <li><a data-toggle="tab" href="#med_inv">Medicine Inventory</a></li>
            <li><a data-toggle="tab" href="#nur">Nurse</a></li>
            <li><a data-toggle="tab" href="#house_keep">Housekeeping</a></li>
            <li><a data-toggle="tab" href="#patdoc">Pat-Doc</a></li>
        </ul>
        <div class="tab-content">
            <div id="emp" class="tab-pane fade in active">
                <h3>Employee</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group-sm">
                        <h5><b>Gender:</b></h5>
                        <input type="text" class="form-control" id="gender" name="gender" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="age">Age:</label>
                        <input type="number" class="form-control" id="age" name="age" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="contact_no">Contact Number:</label>
                        <input type="tel" class="form-control" id="contact_no" name="contact_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="job_type">Job Type:</label>
                        <input type="text" class="form-control" id="job_type" name="job_type" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="house_no">House No:</label>
                        <input type="number" class="form-control" id="house_no" name="house_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="street">Street:</label>
                        <input type="text" class="form-control" id="street" name="street" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="area">Area:</label>
                        <input type="text" class="form-control" id="area" name="area" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="salary">Salary:</label>
                        <input type="number" class="form-control" id="salary" name="salary" required>
                    </div>
                    <button type="submit" name="update_emp" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="pat" class="tab-pane fade">
                <h3>Patient</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group-sm">
                        <h5><b>Gender:</b></h5>
                        <input type="text" class="form-control" id="gender" name="gender" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="dob">Date of Birth:</label>
                        <input type="date" class="form-control" id="dob" name="dob" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="contact_no">Contact Number:</label>
                        <input type="tel" class="form-control" id="contact_no" name="contact_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="house_no">House No:</label>
                        <input type="number" class="form-control" id="house_no" name="house_no" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="street">Street:</label>
                        <input type="text" class="form-control" id="street" name="street" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="area">Area:</label>
                        <input type="text" class="form-control" id="area" name="area" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="admit_date">Admit Date:</label>
                        <input type="date" class="form-control" id="admit_date" name="admit_date" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="diag">Diagnosis:</label>
                        <input type="text" class="form-control" id="diag" name="diag" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="discharge_date">Discharge Date:</label>
                        <input type="date" class="form-control" id="discharge_date" name="discharge_date" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="doc_id">Doctor Assigned(Doc ID):</label>
                        <input type="number" class="form-control" id="doc_id" name="doc_id" required>
                    </div><div class="form-group-sm">
                        <label for="room_id">Room Assigned(Room ID):</label>
                        <input type="number" class="form-control" id="room_id" name="room_id" required>
                    </div>
                    <button type="submit" name="update_pat" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="med_inv" class="tab-pane fade">
                <h3>Medicine Inventory</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="name">Medicine Name:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="cost">Cost:</label>
                        <input type="number" class="form-control" id="cost" name="cost" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="quantity">Quantity:</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <button type="submit" name="update_med_inv" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="nur" class="tab-pane fade">
                <h3>Nurse</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="room_id">Room ID:</label>
                        <input type="number" class="form-control" id="room_id" name="room_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="nurse_id">Nurse ID:</label>
                        <input type="number" class="form-control" id="nurse_id" name="nurse_id" required>
                    </div>
                    <button type="submit" name="update_nur" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="house_keep" class="tab-pane fade">
                <h3>Housekeeping</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="room_id">Room ID:</label>
                        <input type="number" class="form-control" id="room_id" name="room_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="hk_id">Housekeeping ID:</label>
                        <input type="number" class="form-control" id="hk_id" name="hk_id" required>
                    </div>
                    <button type="submit" name="update_hk" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
            <div id="patdoc" class="tab-pane fade">
                <h3>Pat-Doc</h3>
                <form class="form" action="/Hospital-DBMS/HTML/rec_update.php" method="POST">
                    <div class="form-group-sm">
                        <label for="pat_id">Patient ID:</label>
                        <input type="number" class="form-control" id="pat_id" name="pat_id" required>
                    </div>
                    <div class="form-group-sm">
                        <label for="doc_id">Doctor ID:</label>
                        <input type="number" class="form-control" id="doc_id" name="doc_id" required>
                    </div>
                    <button type="submit" name="update_pat_doc" class="btn btn-default" value="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>