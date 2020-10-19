<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Guest Book (Chapter 6)</title>
</head>

<body>
    <h1>Guest Book</h1>
        <?php
            if((!file_exists("guestbook2.txt")) || (filesize("guestbook2.txt")==0)){
                echo "<p>No guests have signed the guest book.";
            }
            else {
                $GuestArray = file("guestbook2.txt");
                $FinalGuestArray = array_unique($GuestArray);
                array_multisort($FinalGuestArray);
                echo "<table style = \"background-color:lightgray\"
                border =\"1\" width=\"100%\">\n";
                $count = count($FinalGuestArray);
                for ($i=0; $i < $count; ++$i){
                    $CurrGuest = explode(",", $FinalGuestArray[$i]);
                    echo "<tr>\n";
                    echo "<td width=\"5%\" style=\"text-align:center;
                    font-weight:bold\">" . ($i +1) . "</td>\n";
                    echo "<td width=\"95%\"><span style=\"font-weight:bold\">
                    Name:</span> " . htmlentities($CurrGuest[0]) . "<br />\n";
                    echo "<span style=\"font-weigth:bold\">Email: </span> " . 
                    htmlentities($CurrGuest[1]) . "<br />\n";
                    echo "</tr>\n";
                }
                echo "</table>\n";
            }
        ?>
        <p>
            <a href="Guest_Book.html">Sign Guest Book</a>
        </p>
    </body>
    </html>