<?php
// Verified sender file and errors
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
     // Directory to save file
    $uploadDir = 'uploadmedium/';
    $fileName = basename($_FILES['file']['name']);
     // Complete filename
    $uploadPath = $uploadDir . $fileName;
    // whitelist test
    if (!preg_match('/^.*\.(jpg|jpeg|png|gif)$/', $fileName)) {
            http_response_code(500);
            echo 'texto';
            die();
    }
    // move temp file to destination file and verified
    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath)) {
        http_response_code(200);
    } else {
        http_response_code(500);
    }
} else {
    // if exist error send request 400
    http_response_code(400);
}
?>

