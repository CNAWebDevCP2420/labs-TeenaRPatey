<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Display Bug Report</title>
     
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
     
     <?php 
          $DisplayForm="FALSE";
          $DBConnect = @mysqli_connect("localhost", "root", "nIcholaskIan1");
          if ($DBConnect === FALSE)
          echo "<p>Unable to connect to the database server.</p>" . "<p>Error code " . mysqli_connect_errno() . ":" . mysqli_connect_error() . "</p>";

          else {
               $DBName = "bugreport";
               if (!@mysqli_select_db($DBConnect, $DBName))
                    echo "<p>There are no existing reports.</p>";

               else {
                    $TableName = "reports";
                    $SQLstring = "SELECT * FROM $TableName";
                    $QueryResult = @mysqli_query($DBConnect, $SQLstring);
                    if (mysqli_num_rows($QueryResult)==0)
                    echo "<p>There are no existing reports.</p>";
                    else {
                         echo "<p>Existing Reports:</p>";
                         echo "<table width = '100%' border='1'>\n";
                         echo "<tr><th>Report ID</th>" . 
                              "<th>Product Name</th>" . 
                              "<th>Hardware</th>" . 
                              "<th>OS</th>" . 
                              "<th>Frequency</th>" . 
                              "<th>Solutions</th></tr>";
                    
                         while ($Row = mysqli_fetch_assoc($QueryResult)){
                              echo "<tr><td>{$Row['countID']}</td>";
                              echo "<td>{$Row['productName']}</td>";
                              echo "<td>{$Row['hardware']}</td>";
                              echo "<td>{$Row['OS']}</td>";
                              echo "<td>{$Row['frequency']}</td>";
                              echo "<td>{$Row['solutions']}</td></tr>\n";
                         }
                         echo"</table>\n";
                    }
                    mysqli_free_result($QueryResult);
               }    
               mysqli_close($DBConnect); 
          }
          $DisplayForm="TRUE";
          if ($DisplayForm){
     ?>
     <h2 style="text-align:center">Update Report</h2>
     <form id="form1" name="UpdateForm" method="POST" action="UpdateBugReport.php" >
          <div id="form">
               <p>Report ID to Update <input type="text" name="id"/></p>
               <p>Product Name & Version <input type="text" name="productName"/></p>
               <p>Type of Hardware <input type="text" name="hardware" /></p>
               <p>Operating System <input type="text" name="os" /></p>
               <p>Frequency of Occurrence <input type="text" name="frequency" /></p>
               <label for="solutions">Proposed Solutions</label> <br>
               <textarea id="solutions" name="solutions" rows="6" cols="50"></textarea>
          </div>
          <p style="text-align: center"><input type="reset" value="Clear Form" />
          <input type="submit" value="Update" /></p>
     </form>
     <p style="text-align: center"><a href="BugReport.html">Create New Bug Report</a></p>
     <p style="text-align: center"><a href="DisplayBugReport.php">Update Another Report</a></p>
     <?php
     }
     else {
          echo "";
     }
     ?>
          
     
</body>
</html>