<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Rounded Values</title>
</head>
<body>
<p>
<?php 
   $x = 4.02;
   //check to see if variable is a number
   $Result = (is_numeric($x) ? "true":"false"); 
    echo '$x is numeric: ', $Result,"<br />"; 
      
    //see if even: round first
    $y = round($x);
    $Result = (($y % 2 == 0) ? "true":"false");
    echo '$x is even: ', $Result; 
?>
</p>
</body>
</html>