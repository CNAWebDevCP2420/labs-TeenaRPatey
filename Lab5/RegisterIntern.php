<?php
//declare and initialzie the $Body string variable
$Body = "";
$errors = 0;
$email = "";
if (empty($_POST['email'])) {
	++$errors;
	$Body .="<p>You need to enter an e-mail address.</p>\n";
}
else {
	$email = stripslashes($_POST['email']);
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
		++$errors;
		$Body .= "<p>You need to enter a valid e-mail address.</p>\n";
		$email="";
	}
}

if (empty($_POST['password'])){
	++$errors;
	$Body .= '<p>You need to enter a password.</p>\n';
	$password = "";
}
else
	$password = stripslashes($_POST['password']);

if (empty($_POST['password2'])){
	++$errors;
	$Body .= "<p>You need to enter a confirmation password.</p>\n";
	$password2 = " ";
}
else
	$password2 = stripslashes($_POST['password2']);

if ((!(empty($password))) && (!(empty($password2)))){
	if(strlen($password) < 6){
		++$errors;
		$Body .= "<p>The password is too short.</p>\n";
		$password = "";
		$password2 = "";
	}
}

$DBConnect = FALSE;
if ($errors == 0){
	$DBConnect = @mysqli_connect("localhost", "root", "Password01");

	if ($DBConnect === FALSE){
		$Body .= "<p>Unable to connect to the database server. " .
		"Error code " . mysqli_errno($DBConnect) . ": " .
		mysqli_error($DBConnect) . "</p>\n";
		++$errors;
	}
	else{
		$DBName = "internships";
		$result = @mysqli_select_db($DBConnect, $DBName);
		if ($result === FALSE){
			$Body .= "<p>Unable to select the database. Error code " . 
			mysqli_errno($DBConnect) . ": " . mysqli_error($DBConnect) . 
			"</p>\n";
			++$errors;
		}
	}
}
$TableName = "interns";
if ($errors == 0){
     $SQLString = "SELECT count(*) FROM $TableName where email='email'";
     $QueryResult = @mysqli_query($DBConnect, $SQLString);

     if ($QueryREsult !==FALSE){
          $Row = mysqli_fetch_row($QueryResult);
          if ($Row[0] > 0){
          $Body .= "<p>The email address entered (" . htmlentities($email) . ") is already registered.</p>\n";
          ++$errors;
          }
     }
}
if ($errors>0) {
     $Body .= "<p>Please use your browser’s BACK button to return to the form and fix the errors indicated.</p>\n";
}
if ($errors == 0){
     $first = stripslashes($_POST['first']);
     $last = stripslashes($_POST['last']);
     $SQLString = "INSERT INTO $TableName " .
	" (first, last, email, password_md5) " .
     " VALUES( '$first', '$last', '$email', " . 
     " '" . md5($password) . "')";
$QueryResult - @mysqli_query($DBConnect, $SQLString);
if ($QueryResult === FALSE){
	$Body .= "<p>Unable to save your registration information." .
	"Error code " . mysqli_errno($DBConnect) . ": " .
	mysqli_error($DBConnect) . "</p>\n";
     ++$errors;
}
else {
     $InternID = mysqli_insert_id($DBConnect);
}
setcookie("internID", $InternID);
mysqli_close($DBConnect);
}
if ($errors == 0){
$InternName = $first . " " . $last;
$Body .= "<p>Thank you, $InternName. ";
$Body .= " Your new Intern ID is <strong>" .
	$InternID . "</strong>.</p>\n";
}

if ($errors == 0){
     $Body .= "<form method='post' action='AvailableOpportunities.php' >\n";
     $Body .= "<input type='hidden' name='internID' value='$InternID' >\n";
     $Body .= "<input type='submit' name='submit' value='View Available Opportunities' >\n";
     $Body .= "</form>\n";
     }
     
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Register Intern</title>
  
</head>

<body>
<h1>College Internship</h1>
<h2>Intern Registration</h2>

<?php
echo $Body;
?>
</body>
</html>