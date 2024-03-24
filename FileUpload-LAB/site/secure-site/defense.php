<?php
// Verified sender file and errors
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
 // Directory to save file
    $uploadDir = 'uploadsec/';
    $fileName = uniqid() . "_" . $_FILES["file"]["name"];
// Complete filename
// blacklist
	if (preg_match('/^.+\.ph(p|ps|tml)/', $fileName)) {
        http_response_code(500);
        die();
    }	
// whitelist test
    if (!preg_match('/^.*\.(jpg|jpeg|png|gif)$/', $fileName)) {
        http_response_code(500);
        die();
    }
    $uploadPath = $uploadDir . $fileName;
    
    $type = mime_content_type($_FILES['file']['tmp_name']);

    if (!in_array($type, array('image/jpg', 'image/jpeg', 'image/png', 'image/gif'))) {
// move temp file to destination file and verified mimetype image
        http_response_code(500);
        die();
    } else{
        move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath);
    }
} else{
// if exist error send request 500 to file incorrect
    http_response_code(500);
}
?>


