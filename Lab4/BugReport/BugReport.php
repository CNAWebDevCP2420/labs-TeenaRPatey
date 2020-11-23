<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Bug Report</title>

<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
     <?php
          if (empty($_POST['productName']) || empty($_POST['hardware'])  || empty($_POST['os'])  || empty($_POST['frequency'])){
               echo "<p>You must complete all fields!
                    Click your browser's Back button to return to the form.</p>";
          }
          //connect to database
          else{
               $DBConnect = @mysqli_connect("localhost", "root", "Password01");
               if ($DBConnect===FALSE){
                    echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . 
                    "</p>";
               }
          
          //create a database named bugReport if it does not already exist
          else{
               $DBName = "bugreport";
               if(!@mysqli_select_db($DBConnect, $DBName)){
                    $SQLstring = "CREATE DATABASE $DBName";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if($QueryResult === FALSE)
                         echo "<p>Unable to execute the query.</p>" . 
                         "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                    else 
                         echo "<p>Report Submitted Successfully</p>";     
               }
               mysqli_select_db($DBConnect, $DBName);
               //create a table named reports if it does not already exist
               $TableName = "reports";
               $SQLstring = "SHOW TABLES LIKE '$TableName'";
               $QueryResult = mysqli_query($DBConnect, $SQLstring);
               if (mysqli_num_rows($QueryResult) == 0){
                    $SQLstring = "CREATE TABLE $TableName (countID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, productName VARCHAR(40), hardware VARCHAR(40), OS VARCHAR(40), frequency VARCHAR(40), solutions VARCHAR(1000))";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if ($QueryResult === FALSE)
                         echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
               }          
               //add INFO to database and close database connection
               $ProductName = stripslashes($_POST['productName']);
               $Hardware = stripslashes($_POST['hardware']);
               $OS = stripslashes($_POST['os']);
               $Frequency = stripslashes($_POST['frequency']);
               $Solutions = stripslashes($_POST['solutions']);
               $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$ProductName', '$Hardware', '$OS', '$Frequency', 
                                                            '$Solutions')";
               $QueryResult = @mysqli_query($DBConnect, $SQLstring);
               if ($QueryResult === FALSE)
                    echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                else
                    echo "<h1>Thank you for submitting your report.</h1>";
               
               mysqli_close($DBConnect);
               
          }
     }
     
     ?>
     <p style="text-align: center"><a href="BugReport.html">Create New Bug Report</a></p>
     <p style="text-align: center"><a href="DisplayBugReport.php">Update Existing Report</a></p>

</body>
</html>