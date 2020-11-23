<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Survey Results</title>
     
<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body>
     
     <?php 
          $DisplayForm="FALSE";
          $DBConnect = @mysqli_connect("localhost", "root", "Password01");
          if ($DBConnect === FALSE)
          echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ":" . mysqli_connect_error() . "</p>";

          else {
               $DBName = "airlinesurvey";
               if (!@mysqli_select_db($DBConnect, $DBName))
                    echo "<p>There are no existing surveys.</p>";

               else {
                    $TableName = "surveys";
                    $SQLstring = "SELECT * FROM $TableName";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if (mysqli_num_rows($QueryResult)==0)
                    echo "<p>There are no existing surveys.</p>";
                    else {
                         echo "<h3>Existing Surveys</h3>";
                         echo "<table width = '100%' border='1'>\n";
                         echo "<tr><th>Report ID</th>" . 
                              "<th>Flight Date</th>" . 
                              "<th>Flight Time</th>" . 
                              "<th>Flight Number</th>" . 
                              "<th>Friendliness of Staff</th>" . 
                              "<th>Space for Luggage Storage</th>" .
                              "<th>Comfort of Seating</th>" . 
                              "<th>Cleanlines of Aircraft</th>" . 
                              "<th>Noise Level of Aircraft</th>";
                    
                         while ($Row = mysqli_fetch_assoc($QueryResult)){
                              echo "<tr><td>{$Row['countID']}</td>";
                              echo "<td>{$Row['flightDate']}</td>";
                              echo "<td>{$Row['flightTime']}</td>";
                              echo "<td>{$Row['flightNumber']}</td>";
                              echo "<td>{$Row['friendliness']}</td>";
                              echo "<td>{$Row['storage']}</td>";
                              echo "<td>{$Row['comfort']}</td>";
                              echo "<td>{$Row['cleanliness']}</td>";
                              echo "<td>{$Row['noise']}</td></tr>";
                              
                         }
                         echo"</table>\n";
                    }
                    mysqli_free_result($QueryResult);
               }    
               mysqli_close($DBConnect); 
          }
     ?>
     <p style="text-align: center"><a href="Survey.html">Return to Survey</a></p>
     
</body>
</html>