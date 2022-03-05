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
        break;
    case 'login':
        $username=$_POST['username'];
        $password=$_POST['password'];
        echo $myobj->CheckUSer($username,$password);
        break;
    case 'updateapprov':
        $id=$_POST['id'];
        $myobj->approved($id);
        break;

    case 'updateblock':
        $id=$_POST['id'];
        $myobj->blocked($id);
        break;
    case 'delvalue':
        $id=$_POST['id'];
        $myobj->deleteuser($id);
        break;
    case 'productInsert':
        $pid=$_POST['pid'];
        $pname=$_POST['pname'];
        $pcat=$_POST['pcat'];
        $pScat=$_POST['pScat'];
        $pprice=$_POST['pprice'];
        $myobj->insertProduct($pid,$pname,$pcat,$pScat,$pprice);
        break;

}
?>