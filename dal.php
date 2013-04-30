<?php
//todo: remove hard-coded DB

class DALQueryResult {

    private $_results = array();

    public function __construct(){}

    public function __set($var,$val){
        $this->_results[$var] = $val;
    }

    public function __get($var){
        if (isset($this->_results[$var])){
            return $this->_results[$var];
        }
        else{
            return null;
        }
    }
}
class DAL {

    public function __construct(){}

    public function generateSessionKeyForUser($users_id) {
        $key = uniqid('filesail_',true);
        if((int)$users_id == 0) return false;
        else {
            $sql = 'INSERT INTO `api_keys` (`users_id`,`api_key`) VALUES ("'.$users_id.'","'.$key.'")';
            $this->query($sql);
            return $key;
        }

    }
    public function getUserByEmail($login,$password){

        $login_type = null;
        if(stripos('@',$login) !== false) $login_type = 'email';
        $login_type = 'username';
        $password = sha1($password);
        $sql = 'SELECT * FROM `users` WHERE `'.$login_type.'` = "'.mysql_real_escape_string($login).'" AND `password` = "'.$password.'"';
        $return = $this->query($sql);
        if(count($return) == 1) $return = $return[0];
        return $return;
    }

    public function invalidateSessionKey($session_key) {
        $sql = 'DELETE FROM `api_keys` WHERE `api_key` = "'.mysql_real_escape_string($session_key).'" ';
        $this->query($sql);
    }

    public function createFolder($name,$hash,$enable_comments=1,$enable_password=0,$download_password=null,$enable_download_notification=0,$download_notification_type=null,$enable_expiration_time=0,$expiration_date=null) {
        if($_SESSION['auth']['success'] == 1)
        {
            $users_id = $_SESSION['auth']['data']['id'];
            $sql = "INSERT INTO `folders`
            (`name`,`hash`,`users_id`,`enable_comments`,`enable_password`,`download_password`,`enable_download_notification`,`download_notification_type`,`enable_expiration_time`,`expiration_date`)
            VALUES ('". mysql_real_escape_string($name) ."','". mysql_real_escape_string($hash) ."','". mysql_real_escape_string($users_id) ."','". mysql_real_escape_string($enable_comments) ."','". mysql_real_escape_string($enable_password) ."','". mysql_real_escape_string($download_password) ."','". mysql_real_escape_string($enable_download_notification) ."','". mysql_real_escape_string($download_notification_type) ."','". mysql_real_escape_string($enable_expiration_time) ."','". mysql_real_escape_string($expiration_date) ."')";

            $result = $this->query($sql);
            return $result;
        }
        else die('Invalid session OR user ID isn\'t set');

    }

    public function createFile($name, $size, $download_dir_name, $type, $hash, $extension, $folders_id, $version=1, $is_latest_version=1) {
        if($_SESSION['auth']['success'] == 1)
        {
            $users_id = $_SESSION['auth']['data']['id'];
            $sql = "INSERT INTO `files`
                    (`name`,`size`,`download_dir_name`,`type`,`hash`,`extension`,`folders_id`,`users_id`,`version`,`is_latest_version`)
                    VALUES ('". mysql_real_escape_string($name) ."','". $size ."','". mysql_real_escape_string($download_dir_name) ."','". mysql_real_escape_string($type) ."','". mysql_real_escape_string($hash) ."','". mysql_real_escape_string($extension) ."','". mysql_real_escape_string($folders_id) ."','". mysql_real_escape_string($users_id) ."','". mysql_real_escape_string($version) ."','". mysql_real_escape_string($is_latest_version) ."')";

            $result = $this->query($sql);
            return $result;
        }
        else die('Invalid session OR user ID isn\'t set');
    }

    public function getFilesForSessionUser() {
        if($_SESSION['auth']['success'] == 1)
        {
            $users_id = $_SESSION['auth']['data']['id'];
            $sql = "SELECT `files`.*,`folders`.`id` AS `folder_id`,`folders`.`name` AS `folder_name`,`folders`.`hash` AS `folder_hash` FROM `files`
                    JOIN `folders`
                    ON `folders`.`id` = `files`.`folders_id`
                    WHERE `files`.`users_id` = " . $users_id;
            $result = $this->query($sql);
            $previous_folder_id = 0;
            $folders = [];
            if(count($result) != false) {
                foreach($result as $file) {
                    if($previous_folder_id == 0 || $file->folder_id != $previous_folder_id) {
                        $folders[$file->folder_id] = [
                            'id'=>$file->folder_id,
                            'name'=>$file->folder_name,
                            'hash'=>$file->folder_hash,
                            'files'=>[]
                        ];
                        $previous_folder_id=$file->folder_id;
                    }

                    $folders[$file->folder_id]['files'][] = [
                        'name'=>$file->name,
                        'download_dir_name'=>$file->download_dir_name,
                        'type'=>$file->type,
                        'hash'=>$file->hash,
                        'extension'=>$file->extension,
                        'folders_id'=>$file->folders_id,
                        'users_id'=>$file->users_id,
                        'version'=>$file->version,
                        'is_latest_version'=>$file->is_latest_version
                    ];
                }
            }
            return $folders;
        }
    }

    private function dbconnect() {
        include('conf/env.php');
        include('conf/config.php');

        $conn = mysql_connect($config['db']['host'], $config['db']['user'], $config['db']['pass'])
        //$conn = mysql_connect('localhost', 'root', 'root')
            or die ("<br/>Could not connect to MySQL server" . mysql_error());

        mysql_select_db($config['db']['name'],$conn)
//        mysql_select_db('filesail',$conn)
            or die ("<br/>Could not select the indicated database");

        return $conn;
    }

    private function query($sql){

        $this->dbconnect();

        $res = mysql_query($sql);
        if ($res){
            if (strpos($sql,'SELECT') === false){
                if(strpos($sql,'INSERT') !== false) return mysql_insert_id();
                else return true;
            }
        }
        else{
            if (strpos($sql,'SELECT') === false){
                return false;
            }
            else{
                return null;
            }
        }

        $results = array();

        while ($row = mysql_fetch_array($res)){
            $result = new DALQueryResult();

            foreach ($row as $k=>$v){
                $result->$k = $v;
            }

            $results[] = $result;
        }
        return $results;
    }
}

?>