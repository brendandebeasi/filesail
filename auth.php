<?php
$reveal_db = true;
require_once('conf/config.php');
$action = $_POST['action'];
$return = [ 'success'   => false,'message'   => 'Invalid action specified'];
switch($action) {
    case 'login':
        $return = [ 'success'   => false,'message'   => 'Username / Password Is Unset'];
        if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $return = [ 'success'   => false,'message'   => 'Login failed, invalid username / password'];

            $login = $_POST['login'];
            $password = sha1($_POST['login']);

            $return = $fs_db->getUserByEmail($login,$password);
            if(count($return)) {
                $key = $fs_db->generateSessionKeyForUser($return->id);
                if($key != false) {
                    $return = ['success'=>true,'key'=>$key,'data'=>['username'=>$return->username,'name'=>$return->name, 'created'=>$return->created,'email'=>$return->email]];
                    $_SESSION['auth'] = $return;
                }
            }

        }
        echo json_encode($return);
        break;
    case 'getAuthFromSession':
        $return = ['success'=>false];
        if(isset($_SESSION['auth'])) echo json_encode($_SESSION['auth']);
        break;
}