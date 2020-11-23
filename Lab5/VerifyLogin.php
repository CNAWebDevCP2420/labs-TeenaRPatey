<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Verify Login</title>
  
</head>

<body>
<h1>College Internship</h1>
<h2>Verify Intern</h2>
<?php
     $errors=0;
     $DBConnect = @mysqli_connect("localhost", "root", "Password01");
     if($DBConnect ===FALSE){
          echo"<p>Unable to connect to the database server. " .
          "Error code " . mysqli_errno($DBConnect) . ": " .
          mysqli_error($DBConnect) . "</p>\n";
          ++$errors;
     }
     else {
          $DBName = "internships";
          $result = @mysqli_select_db($DBConnect, $DBName);
          if ($result === FALSE){
               Echo "<p>Unable to select the database. Error code " . 
               mysqli_errno($DBConnect) . "</p>\n";
               ++$errors;
          }
     }


     $TableName = "interns";
     if ($errors == 0){
          $SQLString = "SELECT internID, first, last FROM $TableName" .
          " where email='" . stripslashes($_POST['email']) . "' and password_md5='" .
          md5(stripslashes($_POST['password'])) . "'";

          $QueryResult = @mysqli_query($DBConnect, $SQLString);

          if (mysqli_num_rows($QueryResult) == 0){
               echo "<p>The e-mail address/password combination entered is not valid.</p>\n";
               ++$errors;
          }
     

          else {
               $Row = mysqli_fetch_assoc($QueryResult);
               $InternID = $Row['internID'];
               $InternName = $Row['first'] . " " . $Row['last'];
               echo "<p>Welcome back, $InternName!</p>\n";
          }
     }

     //show appropriate message if there were errors
     if ($errors > 0){
          echo "<p>Please use your browser's BACK button to return " .
          " to the form and fix the errors indicated.</p>\n";
     }
     //include the form with the hidden field if there was no errors
     /* if ($errors == 0){
          echo "<form method='post' action='AvailableOpportunities.php' >\n";
          echo "<input type='hidden' name='internID' value='$InternID'>\n";
          echo "<input type='submit' name='submit' value='View Available Opportunities' >\n";
          echo "</form>\n";
     } */
     //page 516: replace the form with the following
     echo "<p><a href='AvailableOpportunities.php?" . 
          "internID=$InternID'>Available Opportunities</a></p>\n";
?>
</body>
</html>