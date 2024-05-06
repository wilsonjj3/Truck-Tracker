<html>
<head>
    <meta charset="utf-8"/>
    <title>Truck Tracker - Delete</title>
    <link href="cool1.php" rel="stylesheet"/>
</head>

<body>

<?php include 'backToFront.php';?>

<div  class="page-wrapper">

    <?php include 'header.php';?>

    <h2>Choose an entity to Delete:</h2>
    <form action="TruckTracker_Delete.php" method="post">
        <select name="dropdown" >
            <option value="">Select A Table</option>
            <option value="Driver">Driver</option>
            <option value="Manager">Manager</option>
            <option value="Truck">Truck</option>
        </select> <br />

        <input type="number" name="primaryID" placeholder="Primary ID of Record">

        <input type="submit" value="Submit" > <br />
    </form> <br />

</div>

</body>

</html>
<?php
if(isset($_POST['dropdown'])) {
    $dropdown = $_POST['dropdown'];

    if (isset($_POST['primaryID'])) {
        $primaryID = $_POST['primaryID'];

        $con = mysqli_connect("localhost", "test", "test", "TruckTracker");
        if (!$con) {
            echo "Database is not connected";
        }

        switch ($dropdown) {
            case "Driver":
                $condition = 'DriverID';
                break;
            case "Manager":
                $condition = 'ManagerID';
                break;
            case "Truck":
                $condition = 'TruckID';
                break;
        }

        // Prepare the DELETE statement
        $sqldelete = "DELETE FROM $dropdown WHERE $condition = ?";
        $stmt = mysqli_prepare($con, $sqldelete);
        if ($stmt) {
            // Bind the parameter
            mysqli_stmt_bind_param($stmt, "i", $primaryID); // Assuming $primaryID is an integer

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle error
            echo "Error: " . mysqli_error($con);
        }

        // Close the connection
        mysqli_close($con);
    }
}

function displayallData()
{
    $con = mysqli_connect("localhost", "test", "test", "TruckTracker");
    if (!$con) {
        die("Could not Connect");
    }
    if (isset($_POST['dropdown'])) {
        $dropdown = $_POST['dropdown'];
        switch ($dropdown) {
            case "Driver":
                $result = mysqli_query($con, "SELECT * FROM Driver;");
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo $row['DriverID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['ManagerID'] . " | " . $row['Model'] . "<br />";
                    }
                }
                break;

            case "Manager":
                $result = mysqli_query($con, "SELECT * FROM Manager;");
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo $row['ManagerID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['Street'] . " | " . $row['City'] . " | " . $row['State'] . " | " . $row['PostalCode'] . " | " . "<br />";
                    }
                }
                break;

            case "Truck":
                $result = mysqli_query($con, "SELECT * FROM Truck;");
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo $row['TruckID'] . " | " . $row['Make'] . " | " . $row['Model'] . " | " . $row['MilesDriven'] . " | " . $row['DateOfLastInspection'] . " | " . $row['DateNextInspection'] .  "<br />";
                    }
                }
                break;
        }
    }
}
?>
