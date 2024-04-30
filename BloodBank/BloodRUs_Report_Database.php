<html>
    <head>
        <meta charset="utf-8"/>
        <title>BloodRUs - Reports</title>
        <link href="cool1.php" rel="stylesheet"/>
    </head>

    <body>

        <?php include 'backToFront.php';?>

        <div  class="page-wrapper">

            <?php include 'header.php';?>

        <h2>Create Report For All Nurses or All Patients</h2>


        <form action="BloodRUs_Report_Database.php" method="post">
            <select name = "choice">
                <option value="Nurse">Nurse Report</option>
                <option value="Patient">Patient Report</option>
            </select>
            <INPUT type="submit" value="Generate Report">
        </form>

        </div>
    </body>
</html>


<?php

//based on "choice" variable in dropdown menu, call function to produce Query
if (isset($_POST['choice'])) {

    if ($_POST['choice'] == "Nurse") {
        NurseReport();
    }
    else if ($_POST['choice'] == "Patient") {
        PatientReport();
    }

}//end isset if

function NurseReport(){

    //Connect to DBMS
    $con = mysqli_connect("localhost", "test", "test", "BloodRUs");
    if (!$con){
        die('could not connect: ' . mysqli_connect_error());
    }


    //create Report
    $result = mysqli_query($con,"SELECT * FROM Nurse");
    $resultCheck = mysqli_num_rows($result);

    //print data that is the result of the query
    if($resultCheck > 0) {

        echo "<p id ='info'>------------------------------------Information on all [NURSES] current/previously employed by BloodRUs:------------------------------------</p>";
        echo "<table id = 'table'>
                <tr>
                   <th>Nurse Badge #</th>
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

                "<td>" . $row['NurseBadgeNumber'] . "</td>" .
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

function PatientReport(){

    //Connect to DBMS
    $con = mysqli_connect("localhost", "test", "test", "BloodRUs");
    if (!$con){
        die('could not connect: ' . mysqli_connect_error());
    }

    //Select the Blood_R_Us database
   //mysqli_select_db($con, "name of database");

    //create Report
    $result = mysqli_query($con,"SELECT * FROM Patient");
    $resultCheck = mysqli_num_rows($result);

    //print data that is the result of the query
    if($resultCheck > 0) {

        echo "<p id='info'>------------------------------------Information on all [PATIENTS] that have interacted with BloodRUs:------------------------------------</p>";
        echo "<table id = 'table'>
                <tr>
                   <th>PatientID</th>
                   <th>Last Name</th>
                   <th>First Name</th>
                   <th>Blood Type</th>
                   <th>Reason</th>                       
                </tr>
        ";

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>" .

                "<td>" . $row['PatientID'] . "</td>" .
                "<td>" . $row['LastName']  . "</td>" .
                "<td>" . $row['FirstName']  . "</td>" .
                "<td>" . $row['BloodType']  . "</td>" .
                "<td>" . $row['Reason']  . "</td>"

                . "</tr>";
        }
    }

    //close connection to database
    mysqli_close($con);

}
