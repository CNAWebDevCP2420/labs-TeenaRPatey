<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Show Guest Book</title>
</head>

<body>
    <?php
        $file = "guestbook.txt";
        if (file_exists($file)){
            echo "<pre>";
            echo readfile($file);
            echo "</pre>";
        }
        else {
            echo "<p>File does not exist</p>\n";
        }
        
    ?>
</body>
</html>