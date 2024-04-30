<?php

if(isset($_POST['unitNumberMOD'])) {
    $unitNumberMOD = $_POST['unitNumberMOD'];
}
if(isset($_POST['nursebadgenumberUnit'])) {
    $nursebadgenumberUnit = $_POST['nursebadgenumberUnit'];

}
if(isset($_POST['testedUnit'])) {
    $testedUnit = $_POST['testedUnit'];

}
if(isset($_POST['usableUnit'])) {
    $usableUnit = $_POST['usableUnit'];

}
if(isset($_POST['unitNumberMODID'])) {
    $unitNumberMODID = $_POST['unitNumberMODID'];

}
if(isset($_POST['UpdateUnitNumberID'])) {
    $UpdateUnitNumberID = $_POST['UpdateUnitNumberID'];

}
$con = mysqli_connect("localhost","test","test","BloodRUS");
if(!$con){
    echo "Could not Connect To Database";
}
if(isset($_POST['add'])) {
    $creatingUser = "INSERT INTO unitnumber(nursebadgenumber, Tested, Usable) VALUES ('$nursebadgenumberUnit','$testedUnit','$usableUnit');";
    mysqli_query($con, $creatingUser);
    echo "User added Successfully";
    goback();
}
else {
    $modifingUser = "UPDATE unitnumber set $unitNumberMOD = '$UpdateUnitNumberID' where bloodbagnumber = $unitNumberMODID;";
    mysqli_query($con, $modifingUser);
    echo "User was Modified Succesfully";
    goback();
}
function displayallData()
{
    $con = mysqli_connect("localhost", "test", "test", "bloodrus");
    if (!$con) {
        die("Could not Connect");
    }
    $result = mysqli_query($con, "SELECT * FROM unitnumber;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['BloodBagNumber'] . " | " . $row['NurseBadgeNumber'] . " | " . $row['Tested'] . " | " . $row['Usable'] . " | " . "<br />";
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