<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Airline Survey</title>
     
<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body>
     
     <?php 
          if (empty($_POST['flightDate']) || 
               empty($_POST['flightTime'])  || 
               empty($_POST['flightNumber'])  || 
               empty($_POST['friendliness']) || 
               empty($_POST['storage']) || 
               empty($_POST['comfort']) || 
               empty($_POST['cleanliness']) || 
               empty($_POST['noise'])){

               echo "<p>You must complete all fields!
                    Click your browser's Back button to return to the form.</p>";
          }
          //try to connect to database. If unable to connect...
          else{
               $DBConnect = @mysqli_connect("localhost", "root", "nIcholaskIan1");
               if ($DBConnect===FALSE){
               echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . "</p>";
               }
          
          //create a database named airlineSurvey if it does not already exist
          else{
               $DBName = "airlineSurvey";
               if(!@mysqli_select_db($DBConnect, $DBName)){
                         $SQLstring = "CREATE DATABASE $DBName";
                         $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                         if($QueryResult === FALSE)
                              echo "<p>Unable to execute the query.</p>" . 
                              "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                         else 
                              echo "<p>Survey Submitted Successfully</p>";     
               }

               mysqli_select_db($DBConnect, $DBName);
               //create a table named surveys if it does not already exist
               $TableName = "surveys";
               $SQLstring = "SHOW TABLES LIKE '$TableName'";
               $QueryResult = mysqli_query($DBConnect, $SQLstring);

               if (mysqli_num_rows($QueryResult) == 0){
                    $SQLstring = "CREATE TABLE $TableName 
                         (countID INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
                         flightDate DATE, 
                         flightTime TIME, 
                         flightNumber INT, 
                         friendliness VARCHAR(15), 
                         storage VARCHAR(15),
                         comfort VARCHAR(15),
                         cleanliness VARCHAR(15),
                         noise VARCHAR(15)
                         )";

                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                         if ($QueryResult === FALSE)
                              echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
               }          
                    //add INFO to database and close database connection
                    $FlightDate = stripslashes($_POST['flightDate']);
                    $FlightTime = stripslashes($_POST['flightTime']);
                    $FlightNumber = stripslashes($_POST['flightNumber']);
                    $Friendliness = stripslashes($_POST['friendliness']);
                    $Storage = stripslashes($_POST['storage']);
                    $Comfort = stripslashes($_POST['comfort']);
                    $Cleanliness = stripslashes($_POST['cleanliness']);
                    $Noise = stripslashes($_POST['noise']);

                    $SQLstring = "INSERT INTO $TableName VALUES(NULL, 
                                        '$FlightDate', 
                                        '$FlightTime', 
                                        '$FlightNumber', 
                                        '$Friendliness',
                                        '$Storage',
                                        '$Comfort',
                                        '$Cleanliness',                                                            
                                        '$Noise')";

                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if ($QueryResult === FALSE)
                         echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                    else
                         echo "<h1>Thank you for submitting your survey.</h1>";
                    
                    mysqli_close($DBConnect);
               }
          }
     ?>
     <p style="text-align: center"><a href="ViewSurveys.php">View Survey Results</a></p>
</body>
</html>