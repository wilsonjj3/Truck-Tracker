<?php
if(isset($_POST["lnameDonor"])) {
    $lname=$_POST["lnameDonor"];

}

if(isset($_POST["fnameDonor"])) {
    $fname=$_POST["fnameDonor"];

}
if(isset($_POST['genderDonor'])) {

    $genderdonor = $_POST['genderDonor'];
}
if(isset($_POST['bloodtypeDonor'])) {
    $bloodtypeDonor=$_POST['bloodtypeDonor'];

}
if(isset($_POST['nursebadgenumberDonor'])) {
    $nurse=$_POST['nursebadgenumberDonor'];

}
if(isset($_POST['bloodbagnumber'])) {
    $bloodbagNumber=$_POST['bloodbagnumber'];

}
if(isset($_POST['donorMOD'])) {
    $donorMOD=$_POST['donorMOD'];

}
if(isset($_POST['bloodtypeMOD'])) {
    $bloodtypeMOD=$_POST['bloodtypeMOD'];

}
if(isset($_POST['donorIDMOD'])) {
    $donorIDMOD=$_POST['donorIDMOD'];

}
if(isset($_POST['UpdateDonorIDMOD'])) {
    $UpdateDonorIDMOD=$_POST['UpdateDonorIDMOD'];

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
        $creatingUser = "INSERT INTO donor(LastName, FirstName, nurseBadgeNumber, bloodBagNumber, gender, bloodtype) VALUES ('$lname','$fname','$nurse',$bloodbagNumber, '$genderdonor','$bloodtypeDonor' );";
        mysqli_query($con, $creatingUser);

        echo "User was Added Successfully";
        goback();

    }
    else {
        $modifingUser = "UPDATE donor set $donorMOD = '$UpdateDonorIDMOD' where donorID = $donorIDMOD;";
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
    $result = mysqli_query($con, "SELECT * FROM donor;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['DonorID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['Gender'] . " | " . $row['BloodType'] . " | " . $row['NurseBadgeNumber'] . " | " . $row['BloodBagNumber'] . " | " . "<br />";
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