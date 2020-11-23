<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Display Candidates</title>
     
<link href="main.css" rel="stylesheet" type="text/css">
</head>

<body>
     
     <?php 
          $DisplayForm="FALSE";
          $DBConnect = @mysqli_connect("localhost", "root", "Password01");
          if ($DBConnect === FALSE)
          echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ":" . mysqli_connect_error() . "</p>";

          else {
               $DBName = "interview";
               if (!@mysqli_select_db($DBConnect, $DBName))
                    echo "<p>There are no existing reports.</p>";

               else {
                    $TableName = "interviews";
                    $SQLstring = "SELECT * FROM $TableName";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if (mysqli_num_rows($QueryResult)==0)
                    echo "<p>There are no existing reports.</p>";
                    else {
                         echo "<p>Existing Reports:</p>";
                         echo "<table width = '100%' border='1'>\n";
                         echo "<tr><th>Report ID</th>" . 
                              "<th>Interviewer Name</th>" . 
                              "<th>Position</th>" . 
                              "<th>Interview Date</th>" . 
                              "<th>Candidate Name</th>" . 
                              "<th>Communication</th>" . 
                              "<th>Appearance</th>" . 
                              "<th>Computer Skills</th>" . 
                              "<th>Knowledge</th>" . 
                              "<th>Comments</th></tr>";
                    
                         while ($Row = mysqli_fetch_assoc($QueryResult)){
                              echo "<tr><td>{$Row['countID']}</td>";
                              echo "<td>{$Row['intName']}</td>";
                              echo "<td>{$Row['position']}</td>";
                              echo "<td>{$Row['intDate']}</td>";
                              echo "<td>{$Row['canName']}</td>";
                              echo "<td>{$Row['communication']}</td>";
                              echo "<td>{$Row['appearance']}</td>";
                              echo "<td>{$Row['skills']}</td>";
                              echo "<td>{$Row['knowledge']}</td>";
                              echo "<td>{$Row['comments']}</td></tr>\n";
                         }
                         echo"</table>\n";
                    }
                    mysqli_free_result($QueryResult);
               }    
               mysqli_close($DBConnect); 
          }
     ?>
     
</body>
</html>