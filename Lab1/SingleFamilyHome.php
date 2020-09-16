<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Single Family Home</title>
</head>
<body>
<p>
<?php 
$SingleFamilyHome = 399500;
$SingleFamilyHome_Display =
    number_format (@$SingleFamilyHome, 2);
echo "<p>The current median price of a single family home in Pleasanton, CA is
    $$SingleFamilyHome_Display.</p>";   
?>
</p>
</body>
</html>