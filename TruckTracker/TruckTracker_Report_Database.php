<html>
    <!-- Modified by Jesse-->
    <head>
        <meta charset="utf-8"/>
        <title>Truck Tracker - Reports</title>
        <link href="cool1.php" rel="stylesheet"/>
    </head>

    <body>

        <?php include 'backToFront.php';?>

        <div  class="page-wrapper">

            <?php include 'header.php';?>

        <h2>Create Report For All Managers or All Truckers</h2>


        <form action="TruckTracker_Report_Database.php" method="post">
            <select name = "choice">
                <option value="Manager">Manager Report</option>
                <option value="Trucker">Trucker Report</option>
            </select>
            <INPUT type="submit" value="Generate Report">
        </form>

        </div>
    </body>
</html>


<?php

//based on "choice" variable in dropdown menu, call function to produce Query
if (isset($_POST['choice'])) {

    if ($_POST['choice'] == "Manager") {
        ManagerReport();
    }
    else if ($_POST['choice'] == "Trucker") {
        TruckerReport();
    }

}//end isset if

function ManagerReport(){

    //Connect to DBMS
    $con = mysqli_connect("localhost", "test", "test", "TruckTracker");
    if (!$con){
        die('could not connect: ' . mysqli_connect_error());
    }


    //create Report
    $result = mysqli_query($con,"SELECT * FROM Manager");
    $resultCheck = mysqli_num_rows($result);

    //print data that is the result of the query
    if($resultCheck > 0) {

        echo "<p id ='info'>------------------------------------Information on all [Manager] currently employed------------------------------------</p>";
        echo "<table id = 'table'>
                <tr>
                   <th>Manager Badge #</th>
                   <th>Last Name</th>
                   <th>First Name</th>
                   <th>Street</th>
                   <th>City</th>
                   <th>State</th>
                   <th>PostalCode</th>             
                </tr>
        ";


        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>" .

                "<td>" . $row['ManagerID'] . "</td>" .
                "<td>" . $row['LastName']  . "</td>" .
                "<td>" . $row['FirstName']  . "</td>" .
                "<td>" . $row['Street']  . "</td>" .
                "<td>" . $row['City']  . "</td>" .
                "<td>" . $row['State']  . "</td>" .
                "<td>" . $row['PostalCode']  . "</td>"

                . "</tr>";
        }
    }

    //close connection to database
    mysqli_close($con);

}

function TruckerReport(){

    //Connect to DBMS
    $con = mysqli_connect("localhost", "test", "test", "TruckTracker");
    if (!$con){
        die('could not connect: ' . mysqli_connect_error());
    }

    //create Report
    $result = mysqli_query($con,"SELECT * FROM Trucker");
    $resultCheck = mysqli_num_rows($result);

    //print data that is the result of the query
    if($resultCheck > 0) {

        echo "<p id='info'>------------------------------------Information on all Truckers that are currently employed:------------------------------------</p>";
        echo "<table id = 'table'>
                <tr>
                   <th>TruckerID</th>
                   <th>Last Name</th>
                   <th>First Name</th>
                   <th>Hourly Rate</th>
                </tr>
        ";

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>" .

                "<td>" . $row['TruckerID'] . "</td>" .
                "<td>" . $row['LastName']  . "</td>" .
                "<td>" . $row['FirstName']  . "</td>" .
                "<td>" . $row['HourlyRate']  . "</td>" .
                "</tr>";
        }
    }

    //close connection to database
    mysqli_close($con);

}
