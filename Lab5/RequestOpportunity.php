<?php
     //validate submitted data
     $Body = "";
     $errors = 0;
     $InternID = 0;
     if (isset ($_GET['internID'])){
          $InternID = $_GET['internID'];
     }
     else {
          $Body .= "<p>You have not logged in or registered. " . 
          "Please return to the <a href='InternLogin.php'>Registration/ " . 
          " Log In page</a>.</p>";
          ++$errors;
     }
     if ($errors == 0){
          if (isset($_GET['opportunityID'])){
               $OpportunityID = $_GET['opportunityID'];
          }
          else {
               $Body .= "<p>You have not selected an opportunity. " . 
               "Please return to the <a href='AvailableOpportunities.php?" . 
               "internID=$InternID'>Available Opportunities page</a>.</p>";
               ++$errors;
          }
     }
     //connect to database server and open or create the internships database
     if ($errors ==0){
          $DBConnect = @mysqli_connect("localhost", "root", "Password01");
          if ($DBConnect === FALSE){
               $Body .= "<p>Unable to connect to the database server. Error code " . 
                    mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . 
                    "</p>\n";
                    ++$errors;
          }
          else {
               $DBName = "internships";
               $result = @mysqli_select_db($DBConnect, $DBName);
               if ($result === FALSE){
                    $Body .= "<p>Unable to select the database. Error code " . 
                    mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . 
                    "</p>\n";
                    ++$errors;
               }
          }
     }
     //mark the opportunity as selected in the assigned_opportunities table and close connection
     $DisplayDate = date("l, F j, Y, g:i A");
     $DatabaseDate = date("Y-m-d H:i:s");
     if ($errors == 0){
          $TableName = "assigned_opportunities";
          $SQLstring = "INSERT INTO $TableName " . 
               " (opportunityID, internID, date_selected) " . 
               "VALUES ($OpportunityID, $InternID, '$DatabaseDate')";
          $QueryResult = @mysqli_query($DBConnect, $SQLstring);
          if ($QueryResult === FALSE){
               $Body .= "<p>Unable to execute the query. Error code " . 
                         mysqli_errno($DBConnect) . ": " . 
                         mysqli_error($DBConnect) . "</p>\n";
                         ++$errors;
          }     
          else {
               $Body .= "<p>your request for opportunity #" . 
                         "$OpportunityID has been entered" . 
                         " on $DisplayDate.</p>\n";
          }
          mysqli_close($DBConnect);
     }
     //provide a link back to the Available Opportunities page if the intern ID is valid
     //or to Registration/Log in page if not valid
     if ($InternID > 0){
          $Body .= "<p>Return to the <a href='Available Opportunities.php?internId=$InternID'>" . 
                    "Available Opportunities</a> page. </p>\n";

     }
     else {
          $Body .= "<p>Please <a href='InternLogin.php'>Register " . 
                    " or Log In</a> to use this page.</p>\n";
     }
     //create a persistant cookie set to expire in one week
     if ($errors == 0){
          setcookie("LastRequestDate", urlencode($DisplayDate), time()+60*60*24*7);
     }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Request Opportunity</title>
  
</head>

<body>
<h1>College Internship</h1>
<h2>Intern Registration</h2>

<?php
echo $Body;
?>
</body>
</html>