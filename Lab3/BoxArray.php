<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Box Array</title>
</head>

<body>
    <?php
        //declare and initialize a two-dimensional index array with a single statement(pg.357)
        $Boxes_Array = array(
                    "SmallBox"=>array("Length"=>12, "Width"=>10, "Depth"=>2.5),
                    "MediumBox"=>array("Length"=>30, "Width"=>20, "Depth"=>4),
                    "LargeBox"=>array("Length"=>60, "Width"=>40, "Depth"=>11.5)
        );

        //add statements that display the volume of each box
        foreach ($Boxes_Array as $BoxSize=>$Box){
            echo "The size of the " . $BoxSize .  " is " .
            ($Box["Length"]*$Box["Width"]*$Box["Depth"]) .  " cubic inches.<br>\n";
        }
        
    ?>
</body>
</html>