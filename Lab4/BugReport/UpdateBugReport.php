<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Update Bug Report</title>

<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
       <?php
          if (empty($_POST['id'])){
               echo "<p>You must complete include a Report ID!<br>Click your browser's Back button to return to the form.</p>";
          }
          else {
               $DBName = "bugreport";
               $DBConnect = @mysqli_connect("localhost", "root", "nIcholaskIan1", $DBName);
               if ($DBConnect === FALSE)
               echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ":" . mysqli_connect_error() . "</p>";

               //connect to database
               else{
                    $TableName="reports";
                    //update database and close database connection
                    $ID = stripslashes($_POST['id']);
                    $ProductName = stripslashes($_POST['productName']);
                    $Hardware = stripslashes($_POST['hardware']);
                    $OS = stripslashes($_POST['os']);
                    $Frequency = stripslashes($_POST['frequency']);
                    $Solutions = stripslashes($_POST['solutions']);
                    $SQLstring = "UPDATE $TableName 
                                   SET productName='$ProductName', hardware='$Hardware', os='$OS', frequency='$Frequency', solutions='$Solutions' 
                                   WHERE countId='$ID'";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if ($QueryResult === FALSE)
                         echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                    else
                         echo "<h1>Successfully updated report.</h1>";
                    
                    mysqli_close($DBConnect);
               }
          }
     
     ?>
   
     <p style="text-align: center"><a href="BugReport.html">Create New Bug Report</a></p>
     <p style="text-align: center"><a href="DisplayBugReport.php">Update Existing Report</a></p>
     
    
          
     
</body>
</html>