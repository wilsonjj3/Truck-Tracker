<?php

if(isset($_POST["lnameNurse"])) {
    $lname=$_POST["lnameNurse"];

}
if(isset($_POST["fnameNurse"])) {
    $fname=$_POST["fnameNurse"];

}
if(isset($_POST["StreetNurse"])) {
    $Street=$_POST["StreetNurse"];

}
if(isset($_POST["cityNurse"])) {
    $city=$_POST["cityNurse"];

}
if(isset($_POST['stateNurse'])) {

    $state =$_POST['stateNurse'];
}
if(isset($_POST['postalcodeNurse'])) {
    $postalcode = $_POST['postalcodeNurse'];

}
if(isset($_POST['nurseMOD'])) {
    $nurseMOD = $_POST['nurseMOD'];

}
if(isset($_POST['nurseIDMOD'])) {
    $nurseIDMOD = $_POST['nurseIDMOD'];

}
if(isset($_POST['UpdateNurseIDMOD'])) {
    $UpdateNurseIDMOD = $_POST['UpdateNurseIDMOD'];

}
$con = mysqli_connect("localhost","test","test","BloodRUS");
if(!$con){
    echo "Could not Connect To Database";
}
if(isset($_POST['add'])) {
    $creatingUser = "INSERT INTO nurse(LastName, FirstName, Street, City, State, PostalCode ) VALUES ('$lname','$fname','$Street','$city','$state', '$postalcode');";
    mysqli_query($con, $creatingUser);
    echo "User was Added Successfully";
    goback();

}
else {
    $modifingUser = "UPDATE nurse set $nurseMOD = '$UpdateNurseIDMOD' where nursebadgenumber = $nurseIDMOD;";
    mysqli_query($con, $modifingUser);
    echo "User was Modified successfully";
   goback();
}
function displayallData() {
        $con = mysqli_connect("localhost", "test", "test","bloodrus");
        if(!$con) {
            die("Could not Connect");
        }
        $result = mysqli_query($con, "SELECT * FROM nurse;");
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo $row['NurseBadgeNumber'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['Street'] . " | " . $row['City'] . " | " .$row['State'] . " | " .$row['PostalCode'] . " | " . "<br />";
            }
        }
    mysqli_close($con);
}
function goback() {
    ?>
    <form action="BloodRUs_Add_User.php" method="post" >
        <input type="submit" value="Go back to Previous Page"> <br />
    </form>
    <?php
    exit;
}