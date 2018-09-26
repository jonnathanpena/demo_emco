<?php
    // Specifies the maximum size allowed for the uploaded files (700 kb)
    $max_file_size = 700*1024;

    // Specifies the path to the file
    $path_to_file = "temp/".$_FILES['file']['name'];

    try {
        // Checks whether the array of uploaded files exists
        if(!isset($_FILES['file'])) {
            throw new Exception('File is not specified');
        }

        // Checks that the file was successfully uploaded to the temporary directory
        if(!is_uploaded_file($_FILES['file']['tmp_name'])) {
            throw new Exception('Possible file upload attack');
        }

        // Checks that the file size does not exceed the allowed size
        if($_FILES['file']['size'] > $max_file_size) {
            throw new Exception('File is too big');
        }

        // Checks that the file is an image
        if(strpos($_FILES['file']['type'], "image") === false) {
            throw new Exception('Invalid file type');
        }

        // Here, make sure that the file will be saved to the required directory.
        // Also, ensure that the client has not uploaded files with malicious content.
        // If all checks are passed, save the file.
        move_uploaded_file($_FILES['file']['tmp_name'], $path_to_file);
    } catch(Exception $e) {
        http_response_code(500);
        // Sends the error message to the client in JSON format
        echo json_encode($e->getMessage());
        exit;
    }
?>
