<?php
if(isset($_POST["TruckID"])) {
    $TruckID=$_POST["TruckID"];
}

if(isset($_POST["Make"])) {
    $Make=$_POST["Make"];
}
if(isset($_POST['Model'])) {
    $Model=$_POST['Model'];
}
if(isset($_POST['MilesDriven'])) {
    $MilesDriven=$_POST['MilesDriven'];
}
if(isset($_POST['DateOfLastInspection'])) {
    $DateOfLastInspection=$_POST['DateOfLastInspection'];
}
if(isset($_POST['DateOfNextInspection'])) {
    $DateOfNextInspection=$_POST['DateOfNextInspection'];
}
if(isset($_POST["TruckMOD"])) {
    $TruckMOD=$_POST["TruckMOD"];
}
if(isset($_POST['ModelMOD'])) {
    $ModelMOD = $_POST['ModelMOD'];
}
if(isset($_POST['UpdateTruckIDMOD'])) {
    $UpdateTruckIDMOD = $_POST['UpdateTruckIDMOD'];
}
if(isset($_POST['TruckIDMOD'])) {
    $TruckIDMOD = $_POST['TruckIDMOD'];
}
if(isset($_POST['Make'])) {
    $Make = $_POST['Make'];
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

        $creatingUser = "INSERT INTO Truck(TruckID, Make, MilesDriven) VALUES ('$TruckID','$Make', '$MilesDriven');";
        mysqli_query($con, $creatingUser);
        echo "User was Added Sucessfully";
        goback();
    }
    else {
        $modifingUser = "UPDATE Truck set $TruckMOD = '$UpdateTruckIDMOD' where TruckID = $TruckIDMOD;";
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
    $result = mysqli_query($con, "SELECT * FROM Truck;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['TruckID'] . " | " . $row['Make'] . " | " . $row['Model'] . " | " . $row['MilesDriven'] . " | " . $row['DateOfLastInspection'] . " | " . $row['DateOfNextInspection'] . "<br />";
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
