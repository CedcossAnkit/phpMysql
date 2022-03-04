<?php

require_once("User.php");

$action=$_POST['action'];
$myobj=new User();


switch($action){


    case 'register':
        $id=$_POST['id'];
        $username=$_POST['user'];
        // echo $_POST['user'];
        $password=$_POST['password'];
        $email=$_POST['email'];
        $role=$_POST['role'];
        $status=$_POST['status'];
        $myobj->addUser($id,$username,$password,$email,$role,$status);
    
    case 'login':
        $username=$_POST['username'];
        $password=$_POST['password'];
        echo $myobj->CheckUSer($username,$password);
  
        

}
?>