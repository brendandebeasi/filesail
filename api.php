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
        $file['name'] = str_replace($remove_these, '',$file['name']);

        $file['extension']  = explode('.',$file['name'] );
        $file['extension']= strtolower($file['extension'][count($file['extension']) - 1]);

        $file['name'] = trim(str_replace($file['extension'],'',$file['name'] ),'.');


        $file['type'] = 'unknown';
        switch($file['extension']) {
            case 'jpg' :
                $file['type']= 'img';
                break;
            case 'jpeg' :
                $file['type']= 'img';
                break;
            case 'png' :
                $file['type']= 'img';
                break;
            case 'gif' :
                $file['type']= 'img';
                break;
            case 'mov' :
                $file['type']= 'mov';
                break;
            case 'avi' :
                $file['type']= 'mov';
                break;
            case 'mp4' :
                $file['type']= 'mov';
                break;
            case 'mkv' :
                $file['type']= 'mov';
                break;
        }

        $file['hash'] = sha1(time() . sha1('calliefile' . $file['name']));

        $file['fs_group'][0] = date('Y.m.d');
        $file['fs_group'][1] = time() . '-' . rand(0,100);

//TODO: Update logic to support multiple file uploads


        $folder['name'] = $file['name'];
        $folder['hash'] = sha1(time() . sha1('calliefolder' . $folder['name']));

//Save pertinant info to DB
        $folder['id'] = $fs_db->createFolder($folder['name'],$folder['hash']);
        $fs_db->createFile($file['name'], implode('/',$file['fs_group']) , $file['type'], $file['hash'], $file['extension'], $folder['id']);


        $upload_path = $config['full_file_dir'] . implode('/',$file['fs_group']) . '/' . $file['name'] . '.' . $file['extension'];

//make sure main dir is created
        if (!is_dir($config['full_file_dir'])) {
            mkdir($config['full_file_dir']);
        }
//make sure date grouping dir is created
        if (!is_dir($config['full_file_dir'] . $file['fs_group'][0] )) {
            mkdir($config['full_file_dir'] . $file['fs_group'][0]);
        }
//make sure split time dir is created
        if (!is_dir($config['full_file_dir'] . $file['fs_group'][0] . '/' . $file['fs_group'][1])) {
            mkdir($config['full_file_dir'] . $file['fs_group'][0] . '/' . $file['fs_group'][1]);
        }

//Save the uploaded the file to another location
        if (!move_uploaded_file($file['tmp_name'], $upload_path))  {
            $response = ['success'=>false,'error'=>'File upload error'];
        }
        else $response = ['success'=>true,'data'=>['file'=>$file,'folder'=>$folder]];
        echo json_encode($response);

        break;
    case 'get-files':

        break;
}