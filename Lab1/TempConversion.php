<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Temp Conversion</title>
</head>
<body>
<p>
<?php 
  //display a list of the celsius equivalents of 0-100 farenheit
    //convert f to c: f-32, * 5/9
    //use round() to show one place after the decimal

    $Count = 1;
    $Farenheit = array();
  //populate an array with the farenheit temperatures
    while ($Count <= 100) {
        $Farenheit[] = $Count;
        ++$Count;
      }
      //convert each to celcius
     foreach ($Farenheit as $Temp){
        $Celsius = ($Temp-32)* (5/9);
        echo "<p>$Temp degrees Farenheit to Celsius is </p>"; 
        echo (round($Celsius,1)); 
     }

           
?>
</p>

</body>
</html>