<?php
session_start();
$Body ="";
$errors=0;
if(!isset($_SESSION['internID'])){
     $Body .= "<p>You have not logged in or registered. " . 
     "Please return to the " . 
     "<a href='InternLogin.php'>Registration / " . 
     " Log in page</a>.</p>\n";
     ++$errors;
}
if ($errors ==0){
     if (isset($_GET['opportunityID']))
     $OpportunityID = $_GET['opportunityID'];
     else{
          $Body .= "<p>You have not selected an opportunity. " . 
          "Please return to the " . 
          "<a href='AvailableOpportunities.php?" . SID . "'>Available " . 
          " Opportunities page</a>.</p>\n";
          ++$errors;
     }
}
if ($errors == 0){
     $DBConnect = @mysqli_connect("localhost", "root", "Password01");
     if ($DBConnect === FALSE){
          $Body .= "<p>Unable to connect to the database " . 
          " server. Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";
          ++$errors;
     }
     else {
          $DBName = "internships";
          $result = @mysqli_select_db($DBName, $DBConnect);

          if ($result === FALSE){
               $Body .= "<p>Unable to select the database. " . 
               "Error code " . mysqli_errno($DBConnect) . 
               ": " . mysqli_error($DBConnect) . "</p>\n";
               ++$errors;
          }
     }
}
//delee the appropriate row from the assigned_opportunities table
if ($errors == 0){
     $TableName = "assigned_opportunities";
     $SQLstring = "DELETE FROM $TableName" . 
          "WHERE opportunityID=$OpportunityID" . 
          " AND internID=" . $_SESSION['internID'] . 
          " AND date_approved IS NULL";
     $QueryResult = @mysqli_query($DBConnect, $SQLstring);
     if ($QueryResult === FALSE){
          $Body .= "<p>Unable to execute the query. " . 
               "Error code " . mysqli_errno($DBConnect) . 
               ": " . mysqli_error($DBConnect) . 
               "</p>\n";
               ++$errors;
     }
     else {
          $AffectedRows = mysqli_affected_rows($DBConnect);
          if ($AffectedRows == 0){
               $Body .= "<p>You had not previously selected opportunity # " . 
               $OpportunityID . ".</p>\n";
          }
          else {
               $Body .= "<p>Your request for opportunity # " . 
               "$OpportunityID has been removed. </p>\n";
          }
          mysqli_close($DBConnect);
     }
}
//display the appropriate link for the visitor to use
if ($_SESSION['internID'] > 0 ){
     $Body .= "<p>Return to the <a href='" . 
          "AvailableOpportunities</a> page. </p>\n";
}
else {
     $Body .= "<p>Please <a href='InternLogin.php'>Register " . 
          " or Log In</a> to use this page.</p>\n";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Cancel Selection</title>
  
</head>

<body>
     <h1>College Internship</h1>
     <h2>Cancel Selection</h2>
     <?php
          echo $Body;
     ?>
</body>
</html>