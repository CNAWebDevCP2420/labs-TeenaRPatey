<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Sign Guest Book</title>
</head>

<body>
    <?php
        //if statement to check if the user filled in the name fields
        if (empty($_POST['first_name']) || empty($_POST['last_name'])){
            echo "<p>You must enter your first and last name. Click your browser's Back butto to 
            return to the Guest Book.</p>\n";
        }
        //use fwrite() function to add visitor names to a text file
        else{
            $FirstName = addslashes($_POST['first_name']);
            $LastName = addslashes($_POST['last_name']);
            $GuestBook = fopen("guestbook.txt", "ab");
            if (is_writeable("guestbook.txt")){
                if (fwrite($GuestBook, $LastName . ", " . $FirstName . "\n")){
                    echo "<p>Thank you for signing our guest book!</p>\n";
                }
                else {
                    echo "<p>Cannot add your name to the guest book.</p>\n";        
                }    
            }
            else {
                echo "<p>Cannot write to the file.</p>\n";
            }
            fclose($GuestBook);
        }
    ?>
</body>
</html>