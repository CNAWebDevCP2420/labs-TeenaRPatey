<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Candidates</title>
<link href="main.css" rel="stylesheet" type="text/css">

</head>

<body>
     <?php
          if (empty($_POST['intName']) || empty($_POST['position'])  || empty($_POST['interviewDate'])  || empty($_POST['canName']) || empty($_POST['communication']) || empty($_POST['appearance']) || empty($_POST['comSkills']) ||
          empty($_POST['knowledge'])){
               echo "<p>You must complete all fields!
                    Click your browser's Back button to return to the form.</p>";
          }
          //connect to database
          else{
               $DBConnect = @mysqli_connect("localhost", "root", "nIcholaskIan1");
               if ($DBConnect===FALSE){
                    echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . 
                    "</p>";
               }
          
          //create a database named interview if it does not already exist
          else{
               $DBName = "interview";
               if(!@mysqli_select_db($DBConnect, $DBName)){
                    $SQLstring = "CREATE DATABASE $DBName";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if($QueryResult === FALSE)
                         echo "<p>ERROR: Unable to execute the query.</p>" . 
                         "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                    else 
                         echo "<p>Interview Recorded Successfully</p>";     
               }
               mysqli_select_db($DBConnect, $DBName);
               //create a table named interviews if it does not already exist
               $TableName = "interviews";
               $SQLstring = "SHOW TABLES LIKE '$TableName'";
               $QueryResult = mysqli_query($DBConnect, $SQLstring);
               if (mysqli_num_rows($QueryResult) == 0){
                    $SQLstring = "CREATE TABLE $TableName (countID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, intName VARCHAR(40), position VARCHAR(40), intDate Date, canName VARCHAR(40), communication VARCHAR(50), appearance VARCHAR(50), skills VARCHAR(500), knowledge VARCHAR(500), comments VARCHAR(1000))";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if ($QueryResult === FALSE)
                         echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
               }          
               //add INFO to database and close database connection
               $Interviewer = stripslashes($_POST['intName']);
               $Position = stripslashes($_POST['position']);
               $Date = stripslashes($_POST['interviewDate']);
               $Candidate = stripslashes($_POST['canName']);
               $Communication = stripslashes($_POST['communication']);
               $Appearance = stripslashes($_POST['appearance']);
               $ComputerSkills = stripslashes($_POST['comSkills']);
               $Knowledge = stripslashes($_POST['knowledge']);
               $Comments = stripslashes($_POST['comments']);

               $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$Interviewer', '$Position', '$Date', '$Candidate', 
                                                            '$Communication', '$Appearance', '$ComputerSkills', '$Knowledge', '$Comments')";
               $QueryResult = @mysqli_query($DBConnect, $SQLstring);
               if ($QueryResult === FALSE)
                    echo "<p>ALERT: Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                else
                    echo "<h3>Thank you for submitting your report.</h3>";
               
               mysqli_close($DBConnect);
               
          }
     }
     
     ?>
     <p style="text-align: center"><a href="DisplayCandidates.php">View Candidates</a></p>
     

</body>
</html>