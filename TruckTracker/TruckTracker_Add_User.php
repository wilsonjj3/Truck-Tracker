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
        <?php
            
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

    }

}
?>

