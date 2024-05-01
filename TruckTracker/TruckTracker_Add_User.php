<html>
    <head>
        <meta charset="utf-8"/>
        <title>TruckTracker - Add</title>
        <link href="cool1.php" rel="stylesheet"/>
    </head>

    <body>

    <?php include 'backToFront.php';?>

    <div  class="page-wrapper">

        <?php include 'header.php';?>


            <h2>Choose an Entity to Add/Modify:</h2>
            <form action="TruckTracker_Add_User.php" method="post">
                <select name="dropdown" >
                    <option value="">Select A Table</option>
                    <option value="TruckerID">TruckerID</option>
                    <option value="FirstName">FirstName</option>
                    <option value="LastName">LastName</option>
                    <option value="TruckModel">TruckModel</option>
                    <option value="LastLocation">LastLocation</option>
                    <option value="Distance">Distance</option>
                </select>

                <select name ="addormodify">
                        <option value ="">Select an Option</option>
                        <option value="add">Add a user</option>
                        <option value="modify">Modify a User</option>
                    </select>
                <input type="submit" value="Submit" > <br />
                </form>
            <br />

    </div>
    </body>

</html>

<?php
$con = mysqli_connect("localhost","test","test","TruckTracker");
if(!$con) {
    echo "Can't Connect to Database";
}

if(isset($_POST['addormodify'])) {
    $addormodify =$_POST['addormodify'];
    switch ($addormodify) {
        case "add":
            add();
            break;
        case "modify":
            modify();
            break;
    }
}
function add() {
    $dropdown = $_POST['dropdown'];
    switch ($dropdown) {
        case "patient":
               ?>
        <form method="post" action="patient.php">
            <input type="text" name="lname" placeholder="Enter Patient Last Name" required>
            <input type="text" name="fname" placeholder="Enter Patient First Name" required>
            <select name="bloodtype" >
                <option value ="">Select a blood type</option>
                <option value ="A+">A+</option>
                <option value ="A-">A-</option>
                <option value ="B+">B+</option>
                <option value ="B-">B-</option>
                <option value ="AB+">AB+</option>
                <option value ="AB-">AB-</option>
                <option value ="O+">O+</option>
                <option value ="O-">O-</option>
            </select>
            <input type="text" name="Circumstance" placeholder="Circumstance/Reason" required>
            <input type="text" name="bloodbagnumber" placeholder="Blood Bag Number" >
            <input type="hidden" name="add" value="add">
            <input type="submit" value="Submit" >
        </form>
<?php
            break;
        case "storageBank":
            ?>
            <form method="post" action="storageBank.php">
                <input type="text" name="StreetBank" placeholder="Enter Street and number" required>
                <input type="text" name="cityBank" placeholder="Enter City" required>
                <input type="text" name="stateBank" placeholder="Enter State" required>
                <input type="text" name="postalcodeBank" placeholder="Postal Code" required>
                <input type="text" name="bloodBagNumberBank" placeholder="Blood Bag Number" required>
                <input type="text" name="Onhand" placeholder="OnHand" >
                <input type="hidden" name="add" value="add">
                <input type="submit" value="Submit" >
            </form>

<?php
            break;
        case "donor":
            ?>
        <form method="post" action="donor.php">
            <input type="text" name="lnameDonor" placeholder="Enter Donor Last Name" required>
            <input type="text" name="fnameDonor" placeholder="Enter Donor First Name" required>
            <br /> <br />
            <p>Select a Gender for the Donor</p>
            <input type="radio" name="genderDonor" value="Male" required> Male
            <input type="radio" name="genderDonor" value="Female" required> Female <br /> <br />
            <select name="bloodtypeDonor" >
                <option value ="">Select a blood type</option>
                <option value ="A+">A+</option>
                <option value ="A-">A-</option>
                <option value ="B+">B+</option>
                <option value ="B-">B-</option>
                <option value ="AB+">AB+</option>
                <option value ="AB-">AB-</option>
                <option value ="O+">O+</option>
                <option value ="O-">O-</option>
            </select>
            <input type="text" name="nursebadgenumberDonor" placeholder="Enter Nurse Badgenumber" required>
            <input type="text" name="bloodbagnumber" placeholder="Enter BloodBag Number" required>
            <input type="hidden" name="add" value="add">
            <input type="submit" value="Submit" >
        </form>
<?php
            break;
        case "nurse":
?>
<form method="post" action="nurse.php">
    <input type="text" name="lnameNurse" placeholder="Enter Nurse Last Name" required>
    <input type="text" name="fnameNurse" placeholder="Enter Nurse First Name" required>
    <input type="text" name="StreetNurse" placeholder="Enter Street and number" required>
    <input type="text" name="cityNurse" placeholder="Enter City" required>
    <input type="text" name="stateNurse" placeholder="Enter State" required>
    <input type="text" name="postalcodeNurse" placeholder="Postal Code" required>
    <input type="hidden" name="add" value="add">
    <input type="submit" value="Submit" >
</form>
<?php
            break;
        case "blooddemand":
            echo "Can Not Add Anything To This Table Because You Do Not Have Permission" ;
            break;
        case "unitNumber":
            ?>
            <form method="post" action="unitNumber.php" >
                <input type="text" placeholder="Nurse Badge Number" name="nursebadgenumberUnit">
                <input type="text" placeholder="Tested" name="testedUnit">
                <input type="text" placeholder="Usable" name="usableUnit">
                <input type="hidden" name="add" value="add">
                <input type="submit" value="Submit" >
            </form>
        <?php
            break;
    }
}
//blood demand can only be updated not add to
function modify()
{
    $dropdown = $_POST['dropdown'];
    switch ($dropdown) {
        case "patient":
            ?>
            <form method="post" action="patient.php">
            <input type="text" name="lname" placeholder="Enter Trucker Last Name" required>
            <input type="text" name="fname" placeholder="Enter Trucker First Name" required>
            <select name="dropdown" >
                <option value ="">Select a truck model</option>
                <option value ="Freightliner">Freightliner</option>
                <option value ="Kenworth">Kenworth</option>
                <option value ="Peterbilt">Peterbilt</option>
                <option value ="Volvo">Volvo</option>
                <option value ="Mack">Mack</option>
                <option value ="Western Star">Western Star</option>
                <option value ="International Harvester">International Harvester</option>
            </select>
            <input type="text" name="Distance" placeholder="Distance to drive" required>
            <input type="text" name="Route" placeholder="Route to take" >
            <input type="hidden" name="add" value="add">
            <input type="submit" value="Submit" >
            </form>


                <input type="submit" value="Submit" >
            </form>
    <?php
            break;

    }

}
?>

