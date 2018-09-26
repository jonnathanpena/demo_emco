<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

   // Checks whether the array of uploaded files exists
   if(!isset($_FILES['file'])) {
        echo "No es Archivo";
        http_response_code(400);
       exit;
   }

   // Specifies the path to the file
   $path_to_file = "./temp/".$_FILES['file']['name'];

   // Here, make sure that the file will be saved to the required directory.
   // Also, ensure that the client has not uploaded files with malicious content.
   // If all checks are passed, save the file.
  move_uploaded_file($_FILES['file']['tmp_name'], $path_to_file);
?>
