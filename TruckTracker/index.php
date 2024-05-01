<html>
    <head>
        <meta charset="utf-8"/>
        <title>Truck Tracker - Home</title>
        <link href="cool1.php" rel="stylesheet"/>
    </head>

    <body>


    <div class="page-wrapper">
        <?php include 'header.php';?>

        <h2>Choose an Option Below:</h2>

        <form action="TruckTracker_Add_User.php" method="post">
            <input type="submit" value="Add/Modify User" >
        </form>
        <form action="TruckTracker_Delete.php" method="post">
            <input type="submit" value="Delete User" />
        </form>
        <form action="TruckTracker_Query_Database.php" method="post" >
            <input type="submit" value="Query The Database">
        </form>
        <form action="TruckTracker_Report_Database.php" method="post">
            <input type="submit" value="Run a Report" >
        </form>
        <br />
    </div>

    <p id ="log">Logs:</p>

    </body>
</html>
<?php
$con = mysqli_connect("localhost", "test", "test","");
if(!$con){
    echo "Could Not Connect";
}
$database = "CREATE DATABASE TruckTracker";

if(mysqli_query($con, $database))
{
    echo "Database created successfully <br>";
}

if(mysqli_query($con, "USE TruckTracker"))
{
    echo "Using TruckTracker database <br>";
}

$ManagerTable = "CREATE TABLE Manager (
      ManagerID INT AUTO_INCREMENT PRIMARY KEY,
      LastName VARCHAR(20),
      FirstName VARCHAR(20),
      Street VARCHAR(20),
      City VARCHAR(20),
      State VARCHAR(20),
      PostalCode INT(5),
	Commission INT(7),
	Rate INT(5)
    )";

if(mysqli_query($con, $ManagerTable))
{
    echo "Manager table created <br>";
}

$DriverTable = "CREATE TABLE Driver (
      DriverID INT AUTO_INCREMENT PRIMARY KEY,
      LastName VARCHAR(20),
      FirstName VARCHAR(20),
      Gender VARCHAR(6),
      MilesDriven INT(7),
      ManagerID INT,
      TruckID INT,
	RouteID INT,
      FOREIGN KEY (ManagerID) REFERENCES Manager(ManagerID) ON UPDATE CASCADE ON DELETE CASCADE
      )";

if(mysqli_query($con, $DriverTable))
{
    echo "Driver table created <br>";
}

$TruckTable = "CREATE TABLE Truck (
      TruckID INT AUTO_INCREMENT PRIMARY KEY,
      Make VARCHAR(20),
      Model VARCHAR(20),
      MilesDriven INT(6),
      DateOfLastInspection VARCHAR(30), 
      DateOfNextInspection VARCHAR(30)
    )";

if(mysqli_query($con, $TrucktTable))
{
    echo "Truck table created <br>";
}

$RouteTable = "CREATE TABLE Route (
        RouteID INT AUTO_INCREMENT PRIMARY KEY,
        DepartureLocation VARCHAR(35),
        Destination VARCHAR(30),
        DeliveryDate VARCHAR(30),
        FOREIGN KEY (DriverID) REFERENCES Driver(DriverID) ON UPDATE CASCADE ON DELETE CASCADE
FOREIGN KEY (DeliveryID) REFERENCES Delivery(DeliveryID) ON UPDATE CASCADE ON DELETE CASCADE

      )";

if(mysqli_query($con, $RouteTable))
{
    echo "Route table created <br>";
}

$DeliveryTable = "CREATE TABLE Delivery (
        DeliveryID INT AUTO_INCREMENT PRIMARY KEY,
        Street VARCHAR(255),
        City VARCHAR(20),
        State VARCHAR(20),
        PostalCode INT(5),
        FOREIGN KEY (PaymentID) REFERENCES Payment(PaymentID) ON UPDATE CASCADE ON DELETE CASCADE
      )";

if(mysqli_query($con, $DeliveryTable))
{
   echo "Delivery table created <br>";
}

$PaymentTable = "CREATE TABLE Payment (
      PaymentID INT AUTO_INCREMENT PRIMARY KEY,
      PaymentType VARCHAR(10),
      AmountPaid INT,
      DeliveryID VARCHAR(30),
          )";

if(mysqli_query($con, $PaymentTable))
{
    echo "Payment table created <br>";
}

$donorTableFK = "ALTER TABLE Donor ADD FOREIGN KEY (BloodBagNumber) REFERENCES UnitNumber(BloodBagNumber) ON UPDATE CASCADE ON DELETE CASCADE";
if(mysqli_query($con, $donorTableFK))
{
  // echo "Foreign Key for Donor table created";
}
$patientTableFK = "ALTER TABLE Patient ADD FOREIGN KEY (BloodBagNumber) REFERENCES UnitNumber(BloodBagNumber) ON UPDATE CASCADE ON DELETE CASCADE";
if(mysqli_query($con, $patientTableFK)) {
   // echo  "Foreign Key for Patient ";
}
$result = mysqli_query($con, "SELECT * FROM blooddemand;");
$resultCheck = mysqli_num_rows($result);
if($resultCheck == 0) {
   addingtodemand();
}
function addingtodemand() {
    $con = mysqli_connect("localhost", "test", "test","TruckTracker");
    if(!$con){
        echo "Could Not Connect";
    }
}
?>