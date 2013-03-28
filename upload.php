<?php
require_once('config.php');
$response = ['success'=>null,'error'=>null];


if(!isset($_FILES['file'])) die('No file input');
else $file = $_FILES['file'];

if($file['error'] != UPLOAD_ERR_OK) {
    die(json_encode($response = ['success'=>false,'error'=>'Upload error: ' . $file['error']] ));
}

//Sanitize the filename (See note below)
$remove_these = array(' ','`','"','\'','\\','/');
$clean_name = str_replace($remove_these, '', $file['name']) . '-' . time();

$hash = sha1(time() . sha1($clean_name));

//Save the uploaded the file to another location
$upload_path = $config['full_file_dir'] . $clean_name;
if (!move_uploaded_file($file['tmp_name'], $upload_path))  {
    $response = ['success'=>false,'error'=>'File upload error'];
}
else $response = ['success'=>true,'error'=>null,'url'=>$config['file_dir'] . $clean_name];
echo json_encode($response);

