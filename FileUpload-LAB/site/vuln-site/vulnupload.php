<?php
// Verified sender file and errors
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
 // Directory to save file
    $uploadDir = 'uploadvuln/';
       // Complete filename
    $fileName = basename($_FILES['file']['name']);
    $uploadPath = $uploadDir . $fileName;

    // move temp file to destination file and verified
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
        http_response_code(200);
    } else {
            // if exist error send request 500 to file incorrect
            http_response_code(500);
    }
} else {
    // if exist error send request 400
    http_response_code(400);
}
?>
