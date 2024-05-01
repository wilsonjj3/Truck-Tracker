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
                <option value="Trucker">Trucker</option>
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
            case "Trucker":
                $condition = 'TruckerID';
                break;
            case "Manager":
                $condition = 'ManagerID';
                break;
            case "Truck":
                $condition = 'TruckID';
                break;
        }
        $sqldelete = "DELETE from $dropdown WHERE $condition = $primaryID";
        mysqli_query($con, $sqldelete);

        displayallData();
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
            case "patient":
                $result = mysqli_query($con, "SELECT * FROM patient;");
                $resultCheck = mysqli_num_rows($result);
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo $row['PatientID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['BloodType'] . " | " . $row['Reason'] . "<br />";
                    }
                    }
                    break;

                case
                    "nurse":
                $result = mysqli_query($con, "SELECT * FROM nurse;");
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['NurseBadgeNumber'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['Street'] . " | " . $row['City'] . " | " . $row['State'] . " | " . $row['PostalCode'] . " | " . "<br />";
            }
            }
            break;

        case
            "storageBank":
                $result = mysqli_query($con, "SELECT * FROM storageBank;");
        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['BloodBankID'] . " | " . $row['BloodBagNumber'] . " | " . $row['OnHand'] . " | " . $row['Street'] . " | " . $row['City'] . " | " . $row['State'] . " | " . $row['PostalCode'] . " | " . "<br />";
            }
        }
            break;
            case "donor":
                $result = mysqli_query($con, "SELECT * FROM donor;");
            $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo $row['DonorID'] . " | " . $row['LastName'] . " | " . $row['FirstName'] . " | " . $row['Gender'] . " | " . $row['BloodType'] . " | " . $row['NurseBadgeNumber'] . " | " . $row['BloodBagNumber'] . " | " . "<br />";
            }
            break;
        }
        }
    }


}
?>