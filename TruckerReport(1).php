<?php 

//Create connection
$con = mysqli_connect("localhost", "root", "root", "reportCard3");

//Check connection
if (!$con) {
	die("Connection failed: " . mysqli_error());
}

$sql = "SELECT * 
FROM Manager
WHERE  managerID='$_POST[managerID]'";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["managerFName"]. " - Name: " . $row["mangerLName"]. " " . $row["rate"]. " " . $row["commission"] . " - Email: " . $row["street"]. " " . $row["postalcode"]. " " . $row["state"]. " " . [city]. "<br>";
    }
} else {
    echo "0 results";
}

echo "<button onclick='history.go(-1);'>Back </button>";

mysqli_close($con);

?>