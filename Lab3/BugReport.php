<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Bug Report</title>
</head>

<body>
<?php
        $Dir = "files";
            
           //write to file if submit report button is clicked
               /*  switch ($_POST['submit_btn']){
                    case 'Submit Report': */
                    //if statement to check if the user filled in the required fields
                        if (empty($_POST['name']) || empty($_POST['hardware'] || empty($_POST['os'] || empty($_POST['frequency'])){
                            echo "<p>You must fill out all fields. Click your browser's Back button to 
                                return to form.</p>\n";
                        }
                    
                        else{
                            $Name = addslashes($_POST['name']);
                            $Hardware = addslashes($_POST['hardware']);
                            $OS = addslashes($_POST['os']);
                            $Frequency = addslashes($_POST['frequency']);
                            $Solutions = addslashes($_POST['solutions']);
                            $CurrentTime = microtime();
                            $TimeArray = explode(" ", $CurrentTime);
                            $TimeStamp = (float)$TimeArray[1] + (float)$TimeArray[0];
                            $SaveFileName = fopen("$Dir/Name.$TimeStamp.txt", "ab");
                        
                            //write to the file
                            if (is_writeable($SaveFileName)){
                                if (fwrite($SaveFileName, $Name . ", " . $Hardware . ", " . 
                                    $OS . ", " . $Frequency . ", " . $Solutions . "\n")){
                                    echo "<p>Thank you for submitting your report. The file
                                        name is: $SaveFileName</p>\n";
                                }
                                else {
                                    echo "<p>Error- Cannot submit report.</p>\n";        
                                }    
                            }
                        else {
                            echo "<p>Cannot write to the file.</p>\n";
                            fclose($SaveFileName);
                        }
                    
                   // break;
                           
                
               // case 'Update Existing Report':
                //link to updatedbugreport.html
                  /*   <a href= "UpdatedBugReport.html"></a>
                  
                break;
                
                case 'Update':
                    $FileName = addslashes($_POST['name']);
                    $Update = addslashes($_POST['submit_update']);
                    $fp = fopen($FileName, 'a');//opens file in append mode
                    fwrite($fp, $Update);
                    fclose($fp);
                    echo "File appended successfully.";
                break; */
           // }//end switch       
        //end if statement
       /*  else {
            echo "Error.";
        }   */    
    
    ?>
</body>
</html>