<?php
$reveal_db = true;
require_once('conf/env.php');
require_once('conf/config.php');
$action = $_POST['action'];
$return = [ 'success'   => false,'message'   => 'Invalid action specified'];
switch($action) {
    case 'login':
        $return = [ 'success'   => false,'message'   => 'Username / Password Is Unset'];
        if(isset($_POST['login']) && !empty($_POST['login']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $return = [ 'success'   => false,'message'   => 'Login failed, invalid username / password'];

            $login = $_POST['login'];
            $password = $_POST['password'];

            $user = $fs_db->getUserByEmail($login,$password);

            if(count($user)) {
                $key = $fs_db->generateSessionKeyForUser($user->id);
                if($key != false) {
                    $return = ['success'=>true,'key'=>$key,'data'=>['username'=>$user->username,'name'=>$user->name, 'created'=>$user->created,'email'=>$user->email, 'id'=>$user->id]];
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
    case 'logout':
        $fs_db->invalidateSessionKey($_SESSION['auth']['key']);
        unset($_SESSION["auth"]);
        session_destroy();
        break;
}