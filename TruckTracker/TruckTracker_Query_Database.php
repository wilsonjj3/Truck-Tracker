<html xmlns="http://www.w3.org/1999/html">
    <head>
        <meta charset="utf-8"/>
        <title>BloodRUs - Query</title>
        <link href="cool1.php" rel="stylesheet"/>
    </head>

    <body>

        <?php include 'backToFront.php';?>

        <div  class="page-wrapper">

            <?php include 'header.php';?>

            <h2>Database Query Based on Manager/Trucker Last Name:</h2>

            <form action="TruckTracker_Query_Database.php" method="post">
                <select name = "choice">
                    <option value="Manager">Manager Query</option>
                    <option value="Trucker">Trucker Query</option>
                </select>
                Last Name: <input type="text" name="theName" />
                <INPUT type="submit" value="Query Database">
            </form>



        </div>
    </body>
</html>


<?php

//based on "choice" variable in dropdown menu, call function to produce Query
if (isset($_POST['choice'])){

    if ($_POST['choice'] == "Trucker") {
        TruckerQuery($_POST['theName']);
    } else if ($_POST['choice'] == "Trucker") {
        ManagerQuery($_POST['theName']);
    }

}//end isset if


function TruckerQuery($lastName){

    //Connect to DBMS
    $con = mysqli_connect("localhost", "test", "test", "TruckTracker");
    if (!$con){
        die('could not connect: ' . mysqli_connect_error());
    }

    //create query that uses argument
    $result = mysqli_query($con,"SELECT * FROM Trucker WHERE LastName =  '$lastName'");
    $resultCheck = mysqli_num_rows($result);

    //print data that is the result of the query
    if($resultCheck > 0) {

        echo "<p id = 'info'>------------------------------------Information for Trucker(s) with last name <strong>[$lastName]</strong>:------------------------------------</p>";
        echo "<table id = 'table'>
                <tr>
                   <th>TruckerID</th>
                   <th>Last Name</th>
                   <th>First Name</th>
                   <th>HourlyRate</th>         
                </tr>
        ";

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>" .

               "<td>" . $row['TruckerID'] . "</td>" .
                "<td>" . $row['LastName']  . "</td>" .
                "<td>" . $row['FirstName']  . "</td>" .
                "<td>" . $row['HourlyRate']  . "</td>"
                . "</tr>";

        }
    }else{
        echo "ERROR: Table is empty or Last name doesn't exist!";
    }

    echo "</table>";

    //close connection to database
    mysqli_close($con);

}//end TruckerQuery function



function ManagerQuery($lastName)
{

    //Connect to DBMS
    $con = mysqli_connect("localhost", "test", "test", "BloodRUs");
    if (!$con){
        die('could not connect: ' . mysqli_connect_error());
    }

    //create query that uses argument
    $result = mysqli_query($con,"SELECT * FROM Manager WHERE LastName = '$lastName'");
    $resultCheck = mysqli_num_rows($result);

    //print data that is the result of the query
    if($resultCheck > 0) {

        echo "<p>------------------------------------Information for Patient(s) with Last Name <strong>[$lastName]</strong>:------------------------------------</p>";
        echo "<table id = 'table'>
                <tr>
                   <th>ManagerID</th>
                   <th>Last Name</th>
                   <th>First Name</th>
                   <th>Commission</th>
                </tr>
        ";


        while ($row = mysqli_fetch_assoc($result)) {

            echo "<tr>" .

                "<td>" . $row['PatientID'] . "</td>" .
                "<td>" . $row['LastName']  . "</td>" .
                "<td>" . $row['FirstName']  . "</td>" .
                "<td>" . $row['Commission']  . "</td>"
                . "</tr>";
        }
    }else{
        echo "ERROR: Table is empty or Last name doesn't exist!";
    }

    //close connection to database
    mysqli_close($con);

}//end ManagerQuery function

?>
