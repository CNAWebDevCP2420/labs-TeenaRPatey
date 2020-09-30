<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title></title>
</head>

<body>

    <?php 
    $StringOne = "level";
    $StringTwo = "Madam, I'm Adam";

    if (strrev($StringOne) == $StringOne)
        echo "<p>" . $StringOne . " is a perfect palindrome.</p>\n";
    else
        echo "<p>" . $StringOne . " is not a perfect palindrome.</p>\n";
        
    if (strrev($StringTwo) == $StringTwo)
        echo "<p>" . $StringTwo . " is a perfect palindrome.</p>\n";
    else
        echo "<p>" . $StringTwo . " is not a perfect palindrome.</p>\n";
    ?>

</body>
</html>