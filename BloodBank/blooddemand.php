<?php
if(isset($_POST['blooddemandMOD'])) {
    $blooddemandMOD = $_POST['blooddemandMOD'];
}
if(isset($_POST['bloodtypeDemand'])) {
    $bloodtypeDemand = $_POST['bloodtypeDemand'];
}
if(isset($_POST['UpdateindemandIDMOD'])) {
    $UpdateindemandIDMOD = $_POST['UpdateindemandIDMOD'];
}
if(isset($_POST['BloodBankIDMOD'])) {
    $BloodBankIDMOD = $_POST['BloodBankIDMOD'];
}
$con = mysqli_connect("localhost", "test","test", "bloodrus");
$checkingFromNurse = mysqli_query($con, "SELECT * FROM nurse");
$checkingFromUnitNumber = mysqli_query($con, "SELECT * FROM unitnumber");

$numofRowsNurse = mysqli_num_rows($checkingFromNurse);
$numofRowsUnitnumber = mysqli_num_rows($checkingFromUnitNumber);
if($numofRowsNurse > 0 && $numofRowsUnitnumber > 0) {
        $modifingUser = "UPDATE blooddemand set $blooddemandMOD = '$UpdateindemandIDMOD' where bloodbankID = $BloodBankIDMOD;";
        mysqli_query($con, $modifingUser);
        echo "User was modified Successfully";
        goback();
}
else {
    echo "You will have to Populate Nurse and Unit Tables with at least one entry";
}
function displayallData()
{
    $con = mysqli_connect("localhost", "test", "test", "bloodrus");
    if (!$con) {
        die("Could not Connect");
    }
    $result = mysqli_query($con, "SELECT * FROM blooddemand;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['BloodBankID'] . " | " . $row['BloodType'] . " | " . $row['AmountNeeded'] . " | " . $row['InDemand'] . " | " . "<br />";
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