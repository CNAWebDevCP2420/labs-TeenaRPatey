<?php
     $Count = 1;
     $UserName="";
     $Email="";

     //check to see if cookies are present- if so, they must be registered
     if((isset($_COOKIE['userName']))&&(isset($_COOKIE['email']))){
         $UserName=$_COOKIE['userName'];
         $Email=$_COOKIE['email'];
         echo "User Name: $UserName<br>" . "E-mail: $Email\n";
     }

     //check to see if count cookie is present
     else if((isset($_COOKIE['count']))){
          $Count=$_COOKIE['count'] + 1;

          if ($Count%5 == 0)
          {
               echo "Please remember to register.";
          }
     }
     //if not, set count cookie
     else {
          setcookie("count", $Count);
     }
     //if user submits registration
     if (isset($_POST['Submit'])){
          if (empty($_POST['email'])) {
               echo "<p>You need to enter an e-mail address.</p>\n";
          }
          else {
               $email = stripslashes($_POST['email']);
               if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    echo "<p>You need to enter a valid e-mail address.</p>\n";
                    $email="";
               }
          }
          
          if (empty($_POST['userName'])){
               echo "<p>You need to enter a name.</p>\n";
               $UserName = "";
          }
          else{
               $UserName = stripslashes($_POST['userName']);
          }
          //delete nag counter
          setcookie("count", $Count, time()-3600);
          //set cookies
          setcookie("userName", $UserName, time()+(60*60*24*365));
          setcookie("email", $Email,time()+(60*60*24*365));
         
     }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Nag Counter</title>
</head>

<body>
     <h1>Registration</h1>
     <p>To register, please enter your name and e-mail.</p>
     <hr />
     <form method="post" action="Nag.php">
          <p>Enter Your Name: <br>
          <input type="text" name="userName" />
          </p>
          <p>
          Enter your e-mail address: <br>
          <input type="text" name="email" />
          </p>
     <input type="submit" name="register" value="Register" />
     </form>
     <hr />
</body>
</html>
