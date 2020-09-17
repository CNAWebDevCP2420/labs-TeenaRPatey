<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Odd Numbers</title>
</head>
<body>
<p>
<?php
    $Count = 1;
   while ($Count <= 100) {
       echo "$Count, ";
       $Count+=2;
   }
?>
</p>
</body>
</html>