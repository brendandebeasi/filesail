<?php
//todo: remove hard-coded DB
include_once('conf/config.php');

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
        $sql = 'SELECT * FROM `users` WHERE `'.$login_type.'` = "'.mysql_real_escape_string($login).'"';

        $return = $this->query($sql);
        if(count($return) == 1) $return = $return[0];
        return $return;
    }

    private function dbconnect() {
//        $conn = mysql_connect($config['db']['host'], $config['db']['user'], $config['db']['pass'])
        $conn = mysql_connect('localhost', 'root', 'root')
            or die ("<br/>Could not connect to MySQL server");

//        mysql_select_db($config['db']['name'],$conn)
        mysql_select_db('filesail',$conn)
            or die ("<br/>Could not select the indicated database");

        return $conn;
    }

    private function query($sql){

        $this->dbconnect();

        $res = mysql_query($sql);

        if ($res){
            if (strpos($sql,'SELECT') === false){
                return true;
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