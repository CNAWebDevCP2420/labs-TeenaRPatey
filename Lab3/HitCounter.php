<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Hit Counter</title>
</head>

<body>
    <?php
        $CounterFile = "hitcount.txt";
        //add if statement to determine whether .txt file exists.
        //if exists, retrieve value from file and increment by 1
        if(file_exists($CounterFile)){
            $Hits = file_get_contents($CounterFile);
            ++$Hits;
        }
        //if file does not exist, assign value of 1 to $Hits variable
        else{
            $Hits = 1;        
        }    
        //display number of hits
        //use if to update the value in .txt file
        //file_put_contents() function opens file or creates if it does not exist
        echo "<h1>There have been $Hits hits to this page.</h1>\n";
        if (file_put_contents($CounterFile, $Hits)){
            echo "<p>The counter file has been updated.</p>\n";
        }
    ?>

</body>
</html>