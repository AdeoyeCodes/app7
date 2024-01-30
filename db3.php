<?php
$servername = "localhost";
$username = "boluxcod_Bolu";
$password = "Boluwatife@30";
$dbname = "boluxcod_mydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    $response = ["success" => false, "error" => "Connection failed: " . $conn->connect_error];
    die(json_encode($response));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $response = ["success" => true]; // Default success value

    // Handle music file upload
    if (isset($_FILES["music"])) {
        $target_dir_music = "uploads/music/";
        $target_file_music = $target_dir_music . basename($_FILES["music"]["name"]);

        if (move_uploaded_file($_FILES["music"]["tmp_name"], $target_file_music)) {
            $response["musicFileName"] = $_FILES["music"]["name"];

            // Perform database operations for the music file
            $musicFileName = $conn->real_escape_string($_FILES["music"]["name"]);
            $musicInsertQuery = "INSERT INTO music (music_filename) VALUES ('$musicFileName')";

            if (!$conn->query($musicInsertQuery)) {
                $response = ["success" => false, "error" => "Error inserting music file into the database: " . $conn->error];
            }
        } else {
            $response = ["success" => false, "error" => "Sorry, there was an error uploading your music file."];
        }
    }

    // Handle image file upload
    if (isset($_FILES["picture"])) {
        $target_dir_picture = "uploads/images/";
        $target_file_picture = $target_dir_picture . basename($_FILES["picture"]["name"]);

        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file_picture)) {
            $response["pictureFileName"] = $_FILES["picture"]["name"];

            // Perform database operations for the image file
            $pictureFileName = $conn->real_escape_string($_FILES["picture"]["name"]);
            $pictureInsertQuery = "INSERT INTO picture (picture_filename) VALUES ('$pictureFileName')";

            if (!$conn->query($pictureInsertQuery)) {
                $response = ["success" => false, "error" => "Error inserting image file into the database: " . $conn->error];
            }
        } else {
            $response = ["success" => false, "error" => "Sorry, there was an error uploading your image file."];
        }
    }

    // Output the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    $response = ["success" => false, "error" => "Invalid request method."];
    // Output the JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
}

// Close the database connection
$conn->close();
?>
