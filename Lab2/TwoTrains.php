<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Two Trains</title>
</head>

<body>
    <?php 
        $DisplayForm = TRUE;
        $SpeedA = "";
        $SpeedB = "";
        $Distance = "";

        if(isset($_POST['Submit'])){
            $SpeedA = $_POST['speedA'];
            if (is_numeric($SpeedA)){
               if ($SpeedA > 0){
                $DisplayForm = FALSE;
               }
                else{
                    echo "Speed must be greater than 0";
                    $DisplayForm =TRUE;
                }
            }
            else{
                echo "<p> You need to enter a numeric value for train A speed.</p>\n";
                $DisplayForm = TRUE;
            }
        }
        if(isset($_POST['Submit'])){
            $SpeedB = $_POST['speedB'];
            if (is_numeric($SpeedB)){
                if($SpeedB > 0){
                $DisplayForm = FALSE;
                }
                else{
                    echo "Speed must be greater than 0";
                    $DisplayForm =TRUE;
                }
            }
            else{
                echo "<p> You need to enter a numeric value for train B speed.</p>\n";
                $DisplayForm = TRUE;
            }
        }
        if(isset($_POST['Submit'])){
            $Distance = $_POST['distance'];
            if (is_numeric($Distance)){
                if($Distance > 0){
                $DisplayForm = FALSE;
                }
                else{
                    echo "Distance must be greater than 0";
                    $DisplayForm =TRUE;
                }
            }
            else{
                echo "<p> You need to enter a numeric value for the distance.</p>\n";
                $DisplayForm = TRUE;
            }
        }
        //display form
        if ($DisplayForm){
            ?>
            <form name="TrainForm" action = "TwoTrains.php" method = "post">
                <p>Enter a speed for train A: <input type = "text" name = "speedA"
                value = "<?php echo $SpeedA; ?>" /></p>
                <p>Enter a speed for train B: <input type = "text" name = "speedB"
                value = "<?php echo $SpeedB; ?>" /></p>
                <p>Enter distance between trains (km): <input type = "text" name = "distance"
                value = "<?php echo $Distance; ?>" /></p>
                <p><input type = "reset" value = "Clear Form" />&nbsp;
                    &nbsp; <input type = "submit" name = "Submit" value = "Send Form" /></p>
        </form>
        <?php
        }
        else{
            $DistanceA = (($SpeedA/$SpeedB)*$Distance) /
                (1 + ($SpeedA / $SpeedB));
            $DistanceB = $Distance - $DistanceA;
            $TimeA = $DistanceA / $SpeedA;
            $TimeB = $DistanceB / $SpeedB;
            $Time = round(($TimeA),2);
            $DistanceA = round(($DistanceA),2);
            $DistanceB = round(($DistanceB),2);
            echo "<p>The distance travelled for train A is " . $DistanceA . " km.<br />The distance travelled for train B is " . $DistanceB . 
            " km.<br />The time travelled before they meet is " . $Time . " hours.</p>\n";
        }
    ?>
</body>

</html>