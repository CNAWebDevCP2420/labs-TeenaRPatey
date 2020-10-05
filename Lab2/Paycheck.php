<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Pay Check</title>
</head>
<body>
    <?php
        $errorCount = 0;
        //validate hours worked to ensure it's a number
        if(is_numeric($_POST['hrsWorked']))
        {
            //use round and assign to variable
            $hrsWorked = round($_POST['hrsWorked'],2);
           
            if($hrsWorked < 40)
            {
                //assign regular hours
                $regularHours = $hrsWorked;
                $overTimeHours = 0;
            }
            else{
                //calculate overtime hours
                $overTimeHours = $hrsWorked - 40;
                $regularHours = 40;
            }
        }
            //if no numeric value
        else{
                ++$errorCount;
                echo "<p> Error: Hours worked must be numeric. </p>\n";
        }
            //validate wages to ensure it's a number
        if(is_numeric($_POST['hrlyWage']))
        {
            //use round and assign to variable
             $hrlyWage = round($_POST['hrlyWage'],2);
          
             $totalPay = ($hrlyWage*$regularHours)+($hrlyWage*($overTimeHours*1.5));
             echo "<p>The total pay is " . $totalPay . "</p>";
           
        }
            //if no numeric value
        else{
            ++$errorCount;
            echo "<p> Error: Must be numeric. </p>\n";
        }

        if($errorCount>0){
            echo "Please re-enter the information.<br />\n";
            
        }
    
        ?>
    
    
     
    </body>
    </html>