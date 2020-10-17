<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Reunion Photos</title>
</head>

<body>
    <h1>Here are your photos!</h1>
    <?php
        $ImageInfo = file("information.txt");
        for($i=0; $i<count($ImageInfo); ++$i){
            $CurPhoto = explode(", ", $ImageInfo[$i]);
            echo "<img src='/files/{$CurPhoto[0]}' width='200' height='200'><br>\n";
            echo "<p>Name: {$CurPhoto[1]}<br>\n";
            echo "Description: {$CurPhoto[2]}</p>\n";
           
        }
    ?>
</body>
</html>