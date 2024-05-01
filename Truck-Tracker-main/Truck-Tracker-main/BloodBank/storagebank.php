<?php
if(isset($_POST["StreetBank"])) {
    $Street=$_POST["StreetBank"];
}
if(isset($_POST["cityBank"])) {
    $city=$_POST["cityBank"];
}
if(isset($_POST['stateBank'])) {
    $state = $_POST['stateBank'];
}
if(isset($_POST['bloodBagNumberBank'])) {
    $bloodbagnumber = $_POST['bloodBagNumberBank'];
}
if(isset($_POST['postalcodeBank'])) {
    $postalcode = $_POST['postalcodeBank'];
}
if(isset($_POST['storageMOD'])) {
    $storagemod = $_POST['storageMOD'];
}
if(isset($_POST['StoragebankIDMOD'])) {
    $storageBankIDMOD = $_POST['StoragebankIDMOD'];

}
if(isset($_POST['UpdateStorageIDMOD'])) {
    $UpdateStorageIDMOD = $_POST['UpdateStorageIDMOD'];
}
if(isset($_POST['Onhand'])) {
    $onHand = $_POST['Onhand'];
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
        $creatingUser = "INSERT INTO storagebank(street, city, state, postalcode, bloodbagnumber, onhand) VALUES ('$Street','$city','$state', '$postalcode', $bloodbagnumber, $onHand);";
        mysqli_query($con, $creatingUser);
        echo "User added Successfully";
        goback();
    }
    else {
        $modifingUser = "UPDATE storagebank set $storagemod = '$UpdateStorageIDMOD' where bloodbankID = $storageBankIDMOD;";
        mysqli_query($con, $modifingUser);
        echo "User was Modified Succesfully";
        goback();
    }
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
    $result = mysqli_query($con, "SELECT * FROM storageBank;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['BloodBankID'] . " | " . $row['BloodBagNumber'] . " | " . $row['OnHand'] . " | " . $row['Street'] . " | " . $row['City'] . " | " . $row['State'] . " | " . $row['PostalCode'] . " | " . "<br />";
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