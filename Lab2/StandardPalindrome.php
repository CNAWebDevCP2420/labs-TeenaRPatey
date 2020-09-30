<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Standard Palindrome</title>
</head>

<body>

    <?php 
    $StringOne = "I did, did I";
    $StringTwo = "Madam, I'm Adam";

    $Palindrome = strtolower(preg_replace("([^A-Za-z0-9])", "", $StringOne));
    $PalindromeReversed = strtolower(strrev($Palindrome));

    if ($Palindrome == $PalindromeReversed)
        echo"<p>\"$StringOne\" is a standard Palindrome </p>\n";
    else
        echo "<p>\"$StringOne\" is not a standard Palindrome </p> \n";   

    $PalindromeTwo = strtolower(preg_replace("([^A-Za-z0-9])", "", $StringTwo));
    $PalindromeReversedTwo = strtolower(strrev($PalindromeTwo));        
   
    if ($PalindromeTwo == $PalindromeReversedTwo)
        echo"<p>\"$StringTwo\" is a standard Palindrome </p> \n";
    else
        echo "<p>\"$StringTwo\" is not a standard Palindrome </p>\n";
    ?>

</body>
</html>