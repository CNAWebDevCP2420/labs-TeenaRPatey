<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title></title>
</head>

<body>
    <form action="inc_requestDump.php" method = "post">
        Number 1: <input type = "text" name = "number[]" />
        Number 2: <input type = "text" name = "number[]" />
        Number 3: <input type = "text" name = "number[]" />
        Number 4: <input type = "text" name = "number[]" />
        <input type = "submit" />

    </form>
    <?php 
    //create a table to display contents of $_REQUEST
    //$_REQUEST - an array of all elements in $_GET $_POST array
    //create table
    //two columns: name/value
    //use for each to retrieve the index(name) and value(of the array elements) 
    foreach ($_REQUEST['number'] as $value){
        //use stripslashes before displaying
        $value = stripslashes ($value);
        //use htmlentitites before displaying
        $value = hrmlentities($value);
        //show in table
        echo  []\n;

    }
    ?>

</body>
</html>