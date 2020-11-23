<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sign Guest Book</title>
</head>

<body>
     <?php
          if (empty($_POST['first_name']) || empty($_POST['last_name'])){
               echo "<p>You must enter your first and last name!
                    Click your browser's Back button to return to the Guest Book form.</p>";
          }
          //connect to database
          else{
               $DBConnect = @mysqli_connect("localhost", "root", "Password01");
               if ($DBConnect===FALSE){
                    echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ": " . mysqli_connect_error() . 
                    "</p>";
               }
          
          //create a database named guestbook if it does not already exist
          else{
               $DBName = "guestbook";
               if(!@mysqli_select_db($DBConnect, $DBName)){
                    $SQLstring = "CREATE DATABASE $DBName";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if($QueryResult === FALSE)
                         echo "<p>Unable to execute the query.</p>" . 
                         "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                    else 
                         echo "<p>You are the first visitor!</p>";     
               }
               mysqli_select_db($DBConnect, $DBName);
               //create a table named count if it does not already exist
               $TableName = "visitors";
               $SQLstring = "SHOW TABLES LIKE '$TableName'";
               $QueryResult = mysqli_query($DBConnect, $SQLstring);
               if (mysqli_num_rows($QueryResult) == 0){
                    $SQLstring = "CREATE TABLE $TableName (countID SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY, last_name VARCHAR(40), first_name VARCHAR(40))";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if ($QueryResult === FALSE)
                         echo "<p>Unable to create the table.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
               }          
               //add visitor to database and close database connection
               $LastName = stripslashes($_POST['last_name']);
               $FirstName = stripslashes($_POST['first_name']);
               $SQLstring = "INSERT INTO $TableName VALUES(NULL, '$LastName', '$FirstName')";
               $QueryResult = @mysqli_query($DBConnect, $SQLstring);
               if ($QueryResult === FALSE)
                    echo "<p>Unable to execute the query.</p>" . "<p>Error code " . mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . "</p>";
                else
                    echo "<h1>Thank you for signing our guest book!</h1>";
               
               mysqli_close($DBConnect);
          }
     }
     ?>

</body>
</html>