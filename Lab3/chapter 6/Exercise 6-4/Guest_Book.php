<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Guest Book (Chapter 6)</title>
</head>

<body>
    <?php
       if (isset($_POST['submit'])){
           $Name = stripslashes($_POST['name']);
           $Email = stripslashes($_POST['email']);
           $GuestBook = fopen("guestbook2.txt", "ab");
           $Signature = "$Name, $Email\n";
            if ($GuestBook === FALSE){
                echo "Unable to add your name to the guest book.\n";
            }
            else {
                fwrite($GuestBook, $Signature);
                fclose($GuestBook);
                echo "Your name has been added to the Guest Book.\n";
            }
        }
    ?>
     <p>
            <a href="View_Guest_Book.php">View Guest Book</a>
        </p>
     
</body>
</html>