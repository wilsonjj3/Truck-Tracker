<?php
if(isset($_POST["LastName"])) {
    $LastName=$_POST["LastName"];
}

if(isset($_POST["FirstName"])) {
    $FirstName=$_POST["FirstName"];
}
if(isset($_POST['Model'])) {
    $Model=$_POST['Model'];
}
if(isset($_POST['MilesDriven'])) {
    $MilesDriven=$_POST['MilesDriven'];
}
if(isset($_POST['RouteID'])) {
    $RouteID=$_POST['RouteID'];
}
if(isset($_POST['ManagerID'])) {
    $ManagerID=$_POST['ManagerID'];
}
if(isset($_POST['TruckID'])) {
    $TruckID=$_POST['TruckID'];
}
if(isset($_POST["DriverMOD"])) {
    $patientMOD=$_POST["patientMOD"];
}
if(isset($_POST['ModelMOD'])) {
    $ModelMOD = $_POST['ModelMOD'];
}
if(isset($_POST['UpdateDriverIDMOD'])) {
    $UpdateDriverIDMOD = $_POST['UpdateDriverIDMOD'];
}
if(isset($_POST['DriverIDMOD'])) {
    $DriverIDMOD = $_POST['DriverIDMOD'];
}
if(isset($_POST['RouteID'])) {
    $RouteID = $_POST['RouteID'];
}
$con = mysqli_connect("localhost","test","test","TruckTracker");
if(!$con){
    echo "Could not Connect To Database";
}
$checkingFromDriver = mysqli_query($con, "SELECT * FROM Driver");
$checkingFromManager = mysqli_query($con, "SELECT * FROM Manager");

$numofRowsDriver = mysqli_num_rows($checkingFromDriver);
$numofRowsManager = mysqli_num_rows($checkingFromManager);
if($numofRowsDriver >= 0 && $numofRowsManager >= 0) {
    if(isset($_POST['add'])) {

        $creatingUser = "INSERT INTO Driver(LastName, FirstName, MilesDriven) VALUES ('$LastName','$FirstName', '$MilesDriven');";
        mysqli_query($con, $creatingUser);
        echo "User was Added Sucessfully";
        goback();
    }
    else {
        $modifingUser = "UPDATE Driver set $DriverMOD = '$UpdateDriverIDMOD' where DriverID = $DriverIDMOD;";
        mysqli_query($con, $modifingUser);
        echo "User was Modified Successfully";
        goback();
    }
}
else {
    echo "NAH";
}

function displayallData()
{
    $con = mysqli_connect("localhost", "test", "test", "TruckTracker");
    if (!$con) {
        die("Could not Connect");
    }
    $result = mysqli_query($con, "SELECT * FROM Driver;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['DriverID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['MilesDriven'] . $row['ManagerID'] . "<br />";
        }
    }
}
function goback() {
    ?>
    <form action="TruckTracker_Add_User.php" method="post" >
        <input type="submit" value="Go back to Previous Page"> <br />
    </form>
    <?php
    exit;
}
?>

