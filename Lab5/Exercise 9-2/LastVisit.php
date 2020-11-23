<?php
     //assign a value to the $lastVIsit variable. if $_COOKIE['lastVisit'] is set, the 
     //date and time of the last visit is assigned to the $LastVisit variable
     //otherwise, response is assigned
     if(isset($_COOKIE['lastVisit'])){
          $LastVisit = "<p>Your last visit was on " . $_COOKIE['lastVisit'];
     }
     else{
          $LastVisit = "<p>This is your first visit!</p>\n";
     }
     //assign the date, set cookie to expire in one year
     setcookie("lastVisit", date("F j, Y, g:i a"),
     time()+60*60*24*365);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Last Visit</title>
  
</head>

<body>
     <?php echo $LastVisit; ?>
</body>
</html>