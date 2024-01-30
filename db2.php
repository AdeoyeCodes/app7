<?php

if (isset($_POST['submit'])) 

    $servername = "localhost";
    $username = "boluxcod_Bolu";
    $password = "Boluwatife@30";
    $dbname = "boluxcod_mydatabase";

    $conn = mysqli_connect($servername, $username, $password, $dbname);


    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

 $email = $conn->real_escape_string($_POST['email']);
 $userpassword = $conn->real_escape_string($_POST['password']);

$query = "SELECT * FROM `login` WHERE `Email` = '$email' AND `Password` = '$userpassword'";
$result = mysqli_query($conn, $query);

if($result) {
    if (mysqli_num_rows($result) == 1) { 
    $_SESSION["email"] = $email;
    header("Location: homepage.php");   
    exit();
}else {
    
    echo "<script> alert('Email or Password not Correct') </script>";
    echo "<a href= 'index.php'> Back to Log in Page </a>";
}
} else {
    echo "Error: " . mysqli_error($conn); 
}

mysqli_commit($conn);
mysqli_rollback($conn);
mysqli_close($conn);

?>

