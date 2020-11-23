<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Available Opportunities</title>
  
</head>

<body>
<h1>College Internship</h1>
<h2>Available Opportunities</h2>

<?php
     if ($isset($_REQUEST['internID'])){
          $InternID = $_REQUEST['internID'];
     }
     else {
          $InternID = -1;
     }
     if (isset($_COOKIE['LastRequestDate'])){
          $LastRequestDate = $_COOKIE['LastRequestDate'];
     }
     else {
          $LastRequestDate = "";
     }

     $errors = 0;
     $DBConnect = @mysqli_connect("root", "Password01");
     if ($DBConnect === FALSE){
          echo "<p>Unable to connect to the database server. Error code " . 
          mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>\n";
          ++$errors;
     }
     else {
          $DBName = "internships";
          $result = @mysqli_select_db($DBConnect, $DBName);
          if ($result === FALSE) {
               echo "<p>Unable to select the database. Error code " . 
               mysqli_errno($DBConnect) . ": " . 
               mysqli_error($DBConnect) . "</p>\n";
               ++$errors;
          }
     }
//retrieve user's info from the interns table
$TableName = "interns";
if ($errors == 0){
     $SQLstring = "SELECT * FROM $TableName WHERE ". "internID = '$InternID'";
     $QueryResult = @mysqli_query($DBConnect, $SQLString);
     if ($QueryResult === FALSE){
          echo "<p>Unable to execute the query. ". 
               "Error code ". mysqli_errno($DBConnect). ": ". 
               mysqli_error($DBConnect). "</p>\n";
               ++$errors;
     }
     else {
          if (mysqli_num_rows($QueryResult)==0){
               echo "<p>Invalid Intern ID!</p>";
               ++$errors;
          }
     }
}
//retrieve user's first and last names
if ($errors == 0){
     $Row = mysqli_fetch_assoc($QueryResult);
     $InternName = $Row['first'] . " " . $Row['last'];
}
else {
     $InternName ="";
}
//check the table to determine if current id has been approved for an opportunity
$TableName = "assigned_opportunities";
$ApprovedOpportunities = 0;
$SQLstring = "SELECT COUNT(opportunityID) FROM $TableName ". 
" WHERE internID='$InternID' ". 
" AND date_approved IS NOT NULL";
$QueryResult = @mysqli_query($DBConnect, $SQLString);
if (mysqli_num_rows($QueryResult) > 0){
     $Row = mysqli_fetch_row($QueryResult);
     $ApprovedOpportunities = $Row[0];
     mysqli_free_result($QueryResult);
}
//retrieve list of opportunity ids for the current intern ID
$SelectedOpportunities = array();
$SQLstring = "SELECT opportunityID FROM $TableName ". 
"WHERE internID='$InternID'";
$QueryResult = @mysqli_query($DBConnect, $SQLstring);
if (mysqli_num_rows($QueryResult) > 0){
     while (($Row = mysqli_fetch_row($QueryResult)) !== FALSE){
          $SelectedOpportunities[] = $Row[0];
     }
     mysqli_free_result($QueryResult);
}
// retrieve the list of opportunity IDs from the table that has been approved
//for any intern ID
$AssignedOpportunities = array();
$SQLstring = "SELECT opportunityID FROM $TableName ". 
"WHERE date_approved IS NOT NULL";
$QueryResult = @mysqli_query($DBConnect, $SQLstring);
if (mysqli_num_rows($QueryResult) > 0){
     while (($Row = mysqli_fetch_row($QueryResult))!==FALSE)
          $AssignedOpportunities[] = $Row[0];
     mysqli_free_result($QueryResult);
}
//retrieve the list of opportunities from the opportunities table
//query result stored in array
//close database connection
$TableName = "opportunities";
$Opportunities = array();
$SQLstring = "SELECT opportunityID, company, city, " . 
          "start_date, end_date, position, description " . 
          " FROM $TableName";
$QueryResult = @mysqli_query($DBConnect, $SQLstring);
if (mysqli_num_rows($QueryResult) >0 ){
     while (($Row = mysqli_fetch_assoc($QueryResult)) !== FALSE)
          $Opportunities[] = $Row;
          mysqli_free_result($QueryResult);
}          
mysqli_close($DBConnect);

//display the value of the LastRequestDate cookie if it is set
if (!empty ($LastRequestDate)){
     echo "<p>you last requested an internship opportunity " . 
          "on $LastRequestDate.<p>\n";
}
//build table
echo"<table border='1' width='100%'>\n";
echo "<tr>\n";
echo " <th style='background-color:cyan'>Company</th>\n";
echo " <th style='background-color:cyan'>City</th>\n";
echo " <th style='background-color:cyan'>Start Date</th>\n";
echo " <th style='background-color:cyan'>End Date</th>\n";
echo " <th style='background-color:cyan'>Position</th>\n";
echo " <th style='background-color:cyan'>Description</th>\n";
echo " <th style='background-color:cyan'>Status</th>\n";
echo "</tr>\n";
foreach ($Opportunities as $Opportunity){
     if (!in_array($Opportunity['opportunityID'], $AssignedOpportunities)){
          echo "<tr>\n";
          echo"     <td>" . htmlentities($Opportunity['company']) . "</td>\n";
          echo"     <td>" . htmlentities($Opportunity['city']) . "</td>\n";
          echo"     <td>" . htmlentities($Opportunity['start_date']) . "</td>\n";
          echo"     <td>" . htmlentities($Opportunity['end_date']) . "</td>\n";
          echo"     <td>" . htmlentities($Opportunity['position']) . "</td>\n";
          echo"     <td>" . htmlentities($Opportunity['description']) . "</td>\n";
          echo"     <td>";
          if (in_array($Opportunity['opportunityID'], $SelectedOpportunities)){
               echo "Selected";
          }
          else {
               if ($ApprovedOpportunities >0 ){
                    echo "Open";
               }
               else {
                    echo "<a href = 'RequestOpportunity.php?" .
                         "internID=$InternID&" .
                         "opportunityID=" . $Opportunity['opportunityID'] . 
                         "'>Available</a>";
               }
               echo "</td>\n";
               echo "</tr>\n";
          }
     }
     echo "</table\n";
     echo "<p><a href='InternLogin.php'>Log Out</a></p>\n";
}

?>