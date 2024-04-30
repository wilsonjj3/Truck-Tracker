<html>
    <head>
        <meta charset="utf-8"/>
        <title>BloodRUs - Home</title>
        <link href="cool1.php" rel="stylesheet"/>
    </head>

    <body>


    <div  class="page-wrapper">
        <?php include 'header.php';?>

        <p id="info">***Before Adding any other entries, Populate the <strong>Nurse</strong> table with at least one entry <strong>before</strong> populating the <strong>Unit Number</strong> table with at least one entry</p>
        <h2>Choose an Option Below:</h2>


        <form action="BloodRUs_Add_User.php" method="post">
            <input type="submit" value="Add/Modify User" >
        </form>
        <form action="BloodRUS_Delete.php" method="post">
            <input type="submit" value="Delete User" />
        </form>
        <form action="BloodRUs_Query_Database.php" method="post" >
            <input type="submit" value="Query The Database">
        </form>
        <form action="BloodRUs_Report_Database.php" method="post">
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
$database = "CREATE DATABASE BloodRUs";

if(mysqli_query($con, $database))
{
    echo "Database created successfully <br>";
}

if(mysqli_query($con, "USE BloodRUS"))
{
    echo "Using BloodRUs database <br>";
}

$nurseTable = "CREATE TABLE Nurse (
      NurseBadgeNumber INT AUTO_INCREMENT PRIMARY KEY,
      LastName VARCHAR(20),
      FirstName VARCHAR(20),
      Street VARCHAR(20),
      City VARCHAR(20),
      State VARCHAR(20),
      PostalCode INT(5)
    )";

if(mysqli_query($con, $nurseTable))
{
    echo "Nurse table created <br>";
}

$donorTable = "CREATE TABLE Donor (
      DonorID INT AUTO_INCREMENT PRIMARY KEY,
      LastName VARCHAR(20),
      FirstName VARCHAR(20),
      Gender VARCHAR(6),
      BloodType VARCHAR(3),
      NurseBadgeNumber INT,
      BloodBagNumber INT,
      FOREIGN KEY (NurseBadgeNumber) REFERENCES Nurse(NurseBadgeNumber) ON UPDATE CASCADE ON DELETE CASCADE
      )";

if(mysqli_query($con, $donorTable))
{
    echo "Donor table created <br>";
}

$patientTable = "CREATE TABLE Patient (
      PatientID INT AUTO_INCREMENT PRIMARY KEY,
      LastName VARCHAR(20),
      FirstName VARCHAR(20),
      BloodType VARCHAR(3),
      Reason VARCHAR(30), 
      BloodBagNumber INT
    )";

if(mysqli_query($con, $patientTable))
{
    echo "Patient table created <br>";
}

$unitNumberTable = "CREATE TABLE UnitNumber (
        BloodBagNumber INT AUTO_INCREMENT PRIMARY KEY,
        NurseBadgeNumber INT,
        Tested VARCHAR(3),
        Usable VARCHAR(3),
        FOREIGN KEY (NurseBadgeNumber) REFERENCES Nurse(NurseBadgeNumber) ON UPDATE CASCADE ON DELETE CASCADE
      )";

if(mysqli_query($con, $unitNumberTable))
{
    echo "Unit Number table created <br>";
}

$storageBankTable = "CREATE TABLE StorageBank (
        BloodBankID INT AUTO_INCREMENT PRIMARY KEY,
        BloodBagNumber INT,
        OnHand INT,
        Street VARCHAR(255),
        City VARCHAR(20),
        State VARCHAR(20),
        PostalCode INT(5),
        FOREIGN KEY (BloodBagNumber) REFERENCES UnitNumber(BloodBagNumber) ON UPDATE CASCADE ON DELETE CASCADE
      )";

if(mysqli_query($con, $storageBankTable))
{
   echo "Storage Bank table created <br>";
}

$bloodDemandTable = "CREATE TABLE BloodDemand (
      BloodBankID INT,
      BloodType VARCHAR(3),
      AmountNeeded INT,
      InDemand VARCHAR(3),
      FOREIGN KEY (BloodBankID) REFERENCES StorageBank(BloodBankID) ON UPDATE CASCADE ON DELETE CASCADE
    )";

if(mysqli_query($con, $bloodDemandTable))
{
    echo "Blood Demand table created <br>";
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
    $con = mysqli_connect("localhost", "test", "test","bloodrus");
    if(!$con){
        echo "Could Not Connect";
    }
    mysqli_query($con, "insert into blooddemand(BloodType, AmountNeeded, InDemand) Values ('AB-', '2', 'yes');");
    mysqli_query($con, "insert into blooddemand(BloodType, AmountNeeded, InDemand) Values ('B+', '1', 'no');");
    mysqli_query($con, "insert into blooddemand(BloodType, AmountNeeded, InDemand) Values ('B-', '7', 'yes');");
    mysqli_query($con, "insert into blooddemand(BloodType, AmountNeeded, InDemand) Values ('O', '24', 'yes');");
}
?>