<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Rounded Values</title>
</head>
<body>
<p>
<?php 
   //round() rounds to nearest whole number
$FirstNumber = 2.653;
echo "<p>The number ", $FirstNumber, ' after using round(): ', round($FirstNumber),"</p>";
   //ceil() rounds up to nearest whole number
$SecondNumber = 1.34;
echo"<p>The number ", $SecondNumber, ' after using ceil(): ', ceil($SecondNumber),"</p>";
   //floor() rounds down to nearest whole number
$ThirdNumber = 4.345;
echo"<p>The number ", $ThirdNumber, ' after using floor(): ', floor($ThirdNumber),"<br />";
?>
</p>
</body>
</html>