<?php

//Create connection
$con = mysqli_connect("localhost", "root", "Kaneki18TG", "reportCard3");

//Check connection
if (!$con) {
	die("Connection failed: " . mysqli_error());
}

$sql = "SELECT * FROM  WHERE Manager Driver='$_POST[Driver]'";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "crn: " . $row["Manager"]. " - Name: " . $row["Driver"]. "<br>";
    }
} else {
    echo "0 results";
}

echo "<button onclick='history.go(-1);'>Back </button>";

mysqli_close($con);

?>