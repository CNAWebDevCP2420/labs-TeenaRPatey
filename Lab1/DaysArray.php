<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Days Array</title>
</head>
<body>
<p>
<?php 
$Days = array("Sunday", "Monday", "Tuesday", "Wednesday", 
        "Thursday", "Friday", "Saturday");
echo "<p>The days of the week in English are:</p><p>";
echo "$Days[0]<br />";   
echo "$Days[1]<br />";
echo "$Days[2]<br />";
echo "$Days[3]<br />";
echo "$Days[4]<br />";
echo "$Days[5]<br />";
echo "$Days[6]<br />";   
//change days to French
$Days[0] = "Dimanche";
$Days[1] = "Lundi";
$Days[2] = "Mardi";
$Days[3] = "Mercredi";
$Days[4] = "Jeudi";
$Days[5] = "Vendredi";
$Days[6] = "Samedi";

echo "<p>The days of the week in French are:</p><p>";
echo "$Days[0]<br />";   
echo "$Days[1]<br />";
echo "$Days[2]<br />";
echo "$Days[3]<br />";
echo "$Days[4]<br />";
echo "$Days[5]<br />";
echo "$Days[6]<br />";   
?>
</p>
</body>
</html>