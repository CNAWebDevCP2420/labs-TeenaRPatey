<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Conditional Script</title>
</head>
<body>
<p>
<?php 
  $IntVariable = 75;
  if ($IntVariable > 100) 
        $Result = '$IntVariable is greater than 100';
    else    
    $Result = '$IntVariable is less than or equal to 100';

    echo "<p>$Result</p>"
?>
</p>
</body>
</html>