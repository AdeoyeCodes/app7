<?php 

$servername = "localhost";
$username = "boluxcod_Bolu";
$password = "Boluwatife@30";
$dbname = "boluxcod_mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 

$fname = $conn->real_escape_string($_POST['fname']);
$lname = $conn->real_escape_string($_POST['lname']);
$country = $conn->real_escape_string($_POST['country']);
$email = $conn->real_escape_string($_POST['email']);
$userpassword = $conn->real_escape_string($_POST['password']);
$cpassword = $conn->real_escape_string($_POST['cpassword']);

$sql = "INSERT INTO login (`First_Name`, `Last_Name`, `Country`, `Email`, `Password`, `CPassword`) VALUES (\"".$fname."\", \"".$lname."\", \"".$country."\", \"".$email."\", \"".$userpassword."\", \"".$cpassword."\") ";

if ($conn->query($sql) === TRUE) {
    header("Location: login.php");
    exit;

} else {

    echo "<a href= 'signup.php'>Try again. Error Occured <a><br>" . $conn->error;

}



$conn->close();

?>

