<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<head>
<title>Reunion Upload</title>
</head>

<body>
    <?php
        $Dir = "files";
        if(isset($_POST['upload'])){
            if(isset($_FILES['new_file'])){
                if(move_uploaded_file($_FILES['new_file']['tmp_name'],
                    $Dir . "/" . $_FILES['new_file']['name']) == TRUE){
                        chmod($Dir . "/" . $_FILES['new_file']['name'], 0644);
                        $PhotoUpload = htmlentities($_FILES['new_file']
                        ['name']);
                        echo "File \"" . $PhotoUpload . "\"successfully uploaded.<br />\n";
                        //write to file
                        //if statement to check if the user filled in the required fields
                        if (empty($_POST['name']) || empty($_POST['description'])){
                            echo "<p>You must enter a name and description of the photo. Click your browser's Back button to 
                            return go to the Reunion.html page.</p>\n";
                        }
                        //use fwrite() function to add name and description to a text file
                        else{
                            $Name = addslashes($_POST['name']);
                            $Description = addslashes($_POST['description']);
                            $InformationFile = fopen("information.txt", "ab");
                            if (is_writeable("information.txt")){
                                if (fwrite($InformationFile, $PhotoUpload . ", " . $Name . ", " . $Description . "\n")){
                                    echo "<p>Thank you for submitting a photo!</p>\n";
                                    echo "<a href='ShowReunionPhotos.php'>Click here to view all photo submissions.</a>";
                                }
                                else {
                                    echo "<p>Cannot add your photo.</p>\n";        
                                }    
                            }
                            else {
                                echo "<p>Cannot write to the file.</p>\n";
                            }
                            fclose($InformationFile);
                        }
                    }
                else {
                    echo "There was an error uploading \"" . 
                    htmlentities($_FILES['new_file']['name']) . "\".<br />\n";
                }        
            }
        }

        
    ?>
    <h1>Photo Upload</h1>
    <form action = "Reunion_Upload.php" method = "POST" enctype="multipart/form-data">
    <p>Name <input type="text" name="name" /></p>
    <p>Image Description <input type="text" name="description" /></p>
    <input type ="hidden" name="MAX_FILE_SIZE" value ="30000" /><br />
    File to upload:<br />
    <input type="file" name="new_file" /><br />
    (30000 byte limit)<br />
    <input type ="submit" name ="upload" value="Upload the File" />
    <br />
    </form>
   
</body>
</html>