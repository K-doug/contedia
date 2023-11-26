<?php

require "Database.php";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $formData = $_POST;

    // Process uploaded file
    if (!empty($_FILES)) {
        foreach ($_FILES as $key => $file) {
            $formData['photo'] = $file['name'];

            // Move the uploaded file to a specific directory
            $photoTmpName = $file['tmp_name'];
            $photoDirectory = "C:/xampp/htdocs/contedia/photos/";
            $pictureFilename = $file['name'];

            if (move_uploaded_file($photoTmpName, $photoDirectory . $pictureFilename)) {
                //move is successful
            } else {
                // Failed to move the uploaded photo
                echo "Failed to upload photo. Please try again.";
            }
        }
    }
    
    if (!empty($formData)) {

        $db = new Database("localhost", "contedia", "contediaTest2023", "contedia");
        
        if ($db->connect()) {
            $db->insert('form_options', $formData);
            $db->disconnect();
            echo "addition successful";
        } else {
            echo "An error occurred while connecting to the database.";
        }
    } else {
        echo "An error occurred while decoding form data.";
    }
} else {
    echo "POST request appears to be empty.";
}
?>

