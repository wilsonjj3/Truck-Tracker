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
                <select name="patientMOD">
                    <option value="">Select An Attribute</option>
                    <option value="LastName">Last Name</option>
                    <option value="FirstName">First Name</option>
                    <option value="Circumstance">Circumstance/Reason</option>
                </select>
                <input type="number" name="patientIDMOD"placeholder="patient ID" required>
                <input type="text" name="UpdatepatientIDMOD" placeholder="Update To">
                <br />
                <p>Only Select if Need to update Blood Type</p>
                <select name="bloodtypeMOD">
                    <option value="">Select a blood type</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <br /><br /><br />
                <input type="submit" value="Submit">
            </form>
        <?php
            break;
        case "storageBank":
?>
<form method="post" action="storagebank.php">
    <select name="storageMOD">
        <option value="">Select An Attribute</option>
        <option value="Street">Street</option>
        <option value="city">City</option>
        <option value="state">State</option>
        <option value="postalcode">Postal Code</option>
        <option value="onhand">onHand</option>
    </select>
    <input type="number" name="StoragebankIDMOD" placeholder="Storage ID" required>
    <input type="text" name="UpdateStorageIDMOD" placeholder="Update To">
    <input type="submit" value="Submit" >
</form>
<?php
            break;
        case "donor":
            ?>

            <form method="post" action="donor.php">
                <select name="donorMOD">
                    <option value="">Select An Attribute</option>
                    <option value="LastName">LastName</option>
                    <option value="FirstName">FirstName</option>
                    <option value="nurseBadgeNumber" >Nurse Badge Number</option>
                    <option value="bloodBagNumber" >Blood Bag Number</option>
                    <option value="Gender" >Gender</option>
                </select> <br />
                <p>Only Select if Need to update Blood Type</p>
                <select name="bloodtypeMOD">
                    <option value="">Select a blood type</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                </select>
                <input type="number" name="donorIDMOD"placeholder="donorIDMOD" required>
                <input type="text" name="UpdateDonorIDMOD" placeholder="Update To" required>
                <input type="submit" value="Submit" >
            </form>
            <?php
            break;
        case "nurse":
            ?>
            <form method="post" action="nurse.php">
                <select name="nurseMOD">
                    <option value="">Select An Attribute</option>
                    <option value="LastName">LastName</option>
                    <option value="FirstName">FirstName</option>
                    <option value="Street">Street</option>
                    <option value="city">City</option>
                    <option value="state">State</option>
                    <option value="postalcode">Postal Code</option>
                </select>
                <input type="number" name="nurseIDMOD"placeholder="Nurse ID" required>
                <input type="text" name="UpdateNurseIDMOD" placeholder="Update To" required>
                <input type="submit" value="Submit" >
            </form>
            <?php
            break;
        case "blooddemand":
            ?>
        <form method="post" action="blooddemand.php" >
            <select name="blooddemandMOD">
                <option value="">Select An Attribute</option>
                <option value="Amount Needed">Amount Needed</option>
                <option value="In Demand"> In Demand</option>
            </select>
            <select name="bloodtypeDemand">
                <option value="">Select a Blood Type</option>
                <option value="A+">A+</option>
                <option value="A-">A-</option>
                <option value="B+">B+</option>
                <option value="B-">B-</option>
                <option value="AB+">AB+</option>
                <option value="AB-">AB-</option>
                <option value="O+">O+</option>
                <option value="O-">O-</option>
            </select>
            <input type="number" name="UpdateindemandIDMOD" placeholder="Update To" required>
            <input type="number" name="BloodBankIDMOD" placeholder="BloodbankID" required>
            <input type="submit" value="Submit" >
        </form>
<?php
            break;
    case "unitNumber":
?>
            <form method="post" action="unitNumber.php" >
                <select name="unitNumberMOD">
                    <option value="">Select An Attribute</option>
                    <option value="Tested">Tested</option>
                    <option value="Usable">Usable</option>
                </select>
                <input type="text" name="unitNumberMODID" placeholder="Blood Bad Number">

                <input type="text" name="UpdateUnitNumberID" placeholder="Update To" required>

                <input type="submit" value="Submit" >
            </form>
    <?php
            break;

    }

}
?>

