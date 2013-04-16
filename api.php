<?php
require_once('conf/env.php');
require_once('conf/config.php');
if(!isset($_GET['action'])) die('No action set');
$action = $_GET['action'];

switch($action) {
    case 'upload':
        $response = ['success'=>null,'error'=>null];
        if(!isset($_FILES['file'])) die('No file input');
        else $file = $_FILES['file'];

        if($file['error'] != UPLOAD_ERR_OK) {
            die(json_encode($response = ['success'=>false,'error'=>'Upload error: ' . $file['error']] ));
        }

//Sanitize the filename (See note below)
        $remove_these = array(' ','`','"','\'','\\','/');
        $clean_name = str_replace($remove_these, '',$file['name']);
        $extension = explode('.',$clean_name);
        $extension = strtolower($extension[count($extension) - 1]);

        $clean_name = trim(str_replace($extension,'',$clean_name ),'.');

        $type = 'unknown';
        switch($extension) {
            case 'jpg' :
                $type = 'img';
                break;
            case 'jpeg' :
                $type = 'img';
                break;
            case 'png' :
                $type = 'img';
                break;
            case 'gif' :
                $type = 'img';
                break;
            case 'mov' :
                $type = 'mov';
                break;
            case 'avi' :
                $type = 'mov';
                break;
            case 'mp4' :
                $type = 'mov';
                break;
            case 'mkv' :
                $type = 'mov';
                break;
        }


        $hash = sha1(time() . sha1('calliefile' . $clean_name));




//TODO: Update logic to support multiple file uploads

        $upload_folder = date('Y.m.d');
        $time_freeze = time() . '-' . rand(0,100);

        $folder_name = $clean_name;
        $folder_hash = $hash = sha1(time() . sha1('calliefolder' . $clean_name));
//Save pertinant info to DB
        $folder_id = $fs_db->createFolder($folder_name,$folder_hash);
        $fs_db->createFile($clean_name, $upload_folder , $type, $hash, $extension, $folder_id);


        $upload_path = $config['full_file_dir'] . $upload_folder . '/' . $time_freeze .'/' . $clean_name . $extension;
        echo $config['full_file_dir'] . $upload_folder;
//make sure main dir is created
        if (!is_dir($config['full_file_dir'])) {
            mkdir($config['full_file_dir']);
        }
//make sure date grouping dir is created
        if (!is_dir($config['full_file_dir'] . $upload_folder )) {
            mkdir($config['full_file_dir'] . $upload_folder);
        }
//make sure split time dir is created
        if (!is_dir($config['full_file_dir'] . $upload_folder . '/' . $time_freeze)) {
            mkdir($config['full_file_dir'] . $upload_folder . '/' . $time_freeze);
        }

//Save the uploaded the file to another location
        if (!move_uploaded_file($file['tmp_name'], $upload_path))  {
            $response = ['success'=>false,'error'=>'File upload error'];
        }
        else $response = ['success'=>true,'error'=>null,'name'=>$file['name'],'size'=>''.$file['size'],'url'=>$upload_path];
        echo json_encode($response);

        break;
    case 'get-files':

        break;
}