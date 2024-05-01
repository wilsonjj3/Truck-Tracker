<?php
if(isset($_POST["lname"])) {
    $lname=$_POST["lname"];
}

if(isset($_POST["fname"])) {
    $fname=$_POST["fname"];
}
if(isset($_POST['bloodtype'])) {
    $bloodtype=$_POST['bloodtype'];
}
if(isset($_POST['Circumstance'])) {
    $circumstance=$_POST['Circumstance'];
}
if(isset($_POST["patientMOD"])) {
    $patientMOD=$_POST["patientMOD"];
}
if(isset($_POST['bloodtypeMOD'])) {
    $bloodtypeMOD = $_POST['bloodtypeMOD'];
}
if(isset($_POST['UpdatepatientIDMOD'])) {
    $UpdatepatientIDMOD = $_POST['UpdatepatientIDMOD'];
}
if(isset($_POST['patientIDMOD'])) {
    $patientIDMOD = $_POST['patientIDMOD'];
}
if(isset($_POST['bloodbagnumber'])) {
    $bloodbagnumber = $_POST['bloodbagnumber'];
}
$con = mysqli_connect("localhost","test","test","BloodRUS");
if(!$con){
    echo "Could not Connect To Database";
}
$checkingFromNurse = mysqli_query($con, "SELECT * FROM nurse");
$checkingFromUnitNumber = mysqli_query($con, "SELECT * FROM unitnumber");

$numofRowsNurse = mysqli_num_rows($checkingFromNurse);
$numofRowsUnitnumber = mysqli_num_rows($checkingFromUnitNumber);
if($numofRowsNurse > 0 && $numofRowsUnitnumber > 0) {
    if(isset($_POST['add'])) {

        $creatingUser = "INSERT INTO patient(LastName, FirstName, BloodType, Reason, BloodBagNumber) VALUES ('$lname','$fname','$bloodtype', '$circumstance', '$bloodbagnumber');";
        mysqli_query($con, $creatingUser);
        echo "User was Added Sucessfully";
        goback();
    }
    else {
        $modifingUser = "UPDATE patient set $patientMOD = '$UpdatepatientIDMOD' where patientID = $patientIDMOD;";
        mysqli_query($con, $modifingUser);
        echo "User was Modified Successfully";
        goback();
    }
}
else {
    echo "You will have to Populate Nurse and Unit tables with at least one entry";
}

function displayallData()
{
    $con = mysqli_connect("localhost", "test", "test", "bloodrus");
    if (!$con) {
        die("Could not Connect");
    }
    $result = mysqli_query($con, "SELECT * FROM patient;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['PatientID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['BloodType'] . " | " . $row['Reason'] . $row['BloodBagNumber'] . "<br />";
        }
    }
}
function goback() {
    ?>
    <form action="BloodRUs_Add_User.php" method="post" >
        <input type="submit" value="Go back to Previous Page"> <br />
    </form>
    <?php
    exit;
}
?>

