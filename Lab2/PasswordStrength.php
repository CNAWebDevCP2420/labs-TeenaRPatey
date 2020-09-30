<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Password Strength</title>
</head>

<body>

    <?php 
        $PasswordArray = array(
            "Password 1!", "Password2!", "password3!", "PASSWORD4!",
            "Password!", "Password6", "Pass7!", "Password8!", "Password9!", "Password10!"
        );

        foreach ($PasswordArray as $Password){
            
        $Uppercase = preg_match("/[A-Z]/", $Password);
        $Lowercase = preg_match("/[a-z]/", $Password);
        $Number = preg_match("/[0-9]/", $Password);
        $SpecialChars = preg_match("/[^\w]/", $Password);
        $Spaces = preg_match("/[\s]/", $Password);

        
            if(!$Uppercase && $Lowercase && $Number && $SpecialChars & !$Spaces && strlen($Password)>8 && strlen($Password)<16)
            {
                    echo "<p>Password requires an uppercase letter.</p>\n";
                    
            }
            else if($Uppercase && !$Lowercase && $Number && $SpecialChars & !$Spaces && strlen($Password)>8 && strlen($Password)<16)
            {
                    echo "<p>Password requires a lowercase letter.</p>\n";
                    
            }
            else if($Uppercase && $Lowercase && !$Number && $SpecialChars & !$Spaces && strlen($Password)>8 && strlen($Password)<16)
            {
                    echo "<p>Password requires a number.</p>\n";
                    
            }
            else if($Uppercase && $Lowercase && $Number && !$SpecialChars & !$Spaces && strlen($Password)>8 && strlen($Password)<16)
            {
                    echo "<p>Password requires a special character.</p>\n";
                    
            }
            else if($Uppercase && $Lowercase && $Number && $SpecialChars & $Spaces && strlen($Password)>8 && strlen($Password)<16)
            {
                    echo "<p>Password cannot contain a space.</p>\n";
                    
            }
            else  if($Uppercase && $Lowercase && $Number && $SpecialChars && !$Spaces && (strlen($Password)<8 || strlen($Password)>16))
            {
                    echo "<p>Password must be between 8 and 16 characters in length.</p>\n";
                    
            } 
            else {
                echo "<p>Strong Password.</p>\n";
            }   
        }
    ?>

</body>
</html>