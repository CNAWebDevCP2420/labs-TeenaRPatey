<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Bowling</title>
</head>

<body>
    <h1>Bowling Tournament Registration</h1>
    <?php
        if (isset($_POST['submit'])){
                if (isset($_POST['name']) && isset($_POST['age']) && isset($_POST['average'])){
                    $BowlerName = addslashes($_POST['name']);
                    $BowlerAge = addslashes($_POST['age']);
                    $BowlerAverage = addslashes($_POST['average']);
                    
                    $NewBowler = "$BowlerName, $BowlerAge, $BowlerAverage\n";
                    $BowlersFile = "bowlers.txt";
                    
                    if (file_put_contents($BowlersFile, $NewBowler, FILE_APPEND) > 0){
                        echo "<p>" . stripslashes($_POST['name']) . 
                        " has been registered for the tournament!</p>\n";
                    }
                    else {
                        echo "<p>Registration error!</p>";
                    }
                    
                }
                else {
                    echo "<p>To register for the bowling tournament, enter your name, age and average and
                        click the Register button.</p>"
                }
        }
    ?>
   
    
</body>
</html>