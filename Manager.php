<?php
if(isset($_POST["LastName"])) {
    $LastName=$_POST["LastName"];
}

if(isset($_POST["FirstName"])) {
    $FirstName=$_POST["FirstName"];
}
if(isset($_POST['Street'])) {
    $Street=$_POST['Street'];
}
if(isset($_POST['City'])) {
    $City=$_POST['City'];
}
if(isset($_POST['State'])) {
    $State=$_POST['State'];
}
if(isset($_POST['ManagerID'])) {
    $ManagerID=$_POST['ManagerID'];
}
if(isset($_POST['PostalCode'])) {
    $PostalCode=$_POST['PostalCode'];
}
if(isset($_POST['Commission'])) {
    $Commission=$_POST['Commission'];
}
if(isset($_POST['Rate'])) {
    $Rate=$_POST['Rate'];
}
if(isset($_POST["ManagerMOD"])) {
    $ManagerMOD=$_POST["ManagerMOD"];
}
if(isset($_POST['StreetMOD'])) {
    $StreetMOD = $_POST['StreetMOD'];
}
if(isset($_POST['UpdateManagerIDMOD'])) {
    $UpdateManagerIDMOD = $_POST['UpdateManagerIDMOD'];
}
if(isset($_POST['ManagerIDMOD'])) {
    $ManagerIDMOD = $_POST['ManagerIDMOD'];
}
if(isset($_POST['Street'])) {
    $Street = $_POST['Street'];
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

        $creatingUser = "INSERT INTO Manager(LastName, FirstName, ManagerID) VALUES ('$LastName','$FirstName', '$ManagerID');";
        mysqli_query($con, $creatingUser);
        echo "User was Added Sucessfully";
        goback();
    }
    else {
        $modifingUser = "UPDATE Manager set $ManagerMOD = '$UpdateManagerIDMOD' where ManagerID = $ManagerIDMOD;";
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
    $result = mysqli_query($con, "SELECT * FROM Manager;");
    $resultCheck = mysqli_num_rows($result);

    if ($resultCheck > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row['ManagerID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['Commission'] . $row['Rate'] . "<br />";
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

