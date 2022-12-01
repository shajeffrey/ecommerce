<?php

class login
{
    public $username;
    public $password;

    public function userLogin()
    {
        include "../conn.php";

        $this->username = $_REQUEST['username'];
        $this->password = $_REQUEST['FrmPassword'];
        

    }
}
