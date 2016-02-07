<?php

include_once("Adb.php");

//include_once ("login.php");
//include_once ("mArchive.php");
//>>>>>>> refs/remotes/origin/archive_login

class User extends Adb
{


    /**
     * @param $username
     * @param $password
     * @return bool
     */
    function login($username, $password){
        $string = "select * from users where user_name= ? and password= ?";
        $s = $this->prepare($string);
        $s->bind_param('ss', $username, $password);
        $s->execute();

        return $s->get_result();
    }

    function update(){
        $string = "";
    }

}