<?php

require_once("User.php");
require_once('addtocart.php');
$action = $_POST['action'];
$myobj = new User();
$cart = new cart();

switch ($action) {
    case 'register':
        $id = $_POST['id'];
        $username = $_POST['user'];
        // echo $_POST['user'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $role = $_POST['role'];
        $status = $_POST['status'];
        $myobj->addUser($id, $username, $password, $email, $role, $status);
        break;
    case 'login':
        $username = $_POST['username'];
        $password = $_POST['password'];
        echo $myobj->CheckUSer($username, $password);
        break;
    case 'updateapprov':
        $id = $_POST['id'];
        $myobj->approved($id);
        break;

    case 'updateblock':
        $id = $_POST['id'];
        $myobj->blocked($id);
        break;
    case 'delvalue':
        $id = $_POST['id'];
        $myobj->deleteuser($id);
        break;
    case 'productInsert':
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pcat = $_POST['pcat'];
        $pScat = $_POST['pScat'];
        $pprice = $_POST['pprice'];
        $image = $_POST['pimage'];

        $myobj->insertProduct($pid, $pname, $pcat, $pScat, $pprice, $image);
        break;
    case 'delvalueProduct':
        $id = $_POST['id'];
        $myobj->deleteProduct($id);
        break;
    case 'search1':
        $id = $_POST['id'];
        $myobj->search($id);
        break;
    case 'search2':
        $PdName = $_POST['key'];
        // echo $PdName;
        $myobj->fatchSearch($PdName);
        break;
    case 'filter':
        $key = $_POST['key'];
        $myobj->filter($key);
        break;
    case 'addtocart':
        $id = $_POST['id'];
        $cart->addtocart($id);
        break;
    case 'updateQuant':
        $id = $_POST['id'];
        $quantValue = $_POST['Quantity'];
        $cart->updateQuantity($id, $quantValue);
        break;
    case 'deleteCartItem':
        $id = $_POST['id'];
        $cart->deletCartIteam($id);
        break;
    case 'clearcart':
        $cart->Clearcart();
        break;
    case 'ViewProduct':
        $pname = $_POST['pname'];
        $myobj->ShowFatchProduct($pname);
        break;
    case 'EditProduct':
        $id = $_POST['id'];
        echo $myobj->fatchEditDetails($id);
        break;
    case 'updateEditValue':
        $myobj->EDITuserDETAILS($_POST['pid'], $_POST['pname'], $_POST['pcat'], $_POST['pscat'], $_POST['price'], $_POST['image'], $_POST['realid']);
        break;
    case 'placeorder':
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $address2 = $_POST['address2'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipcode'];
        $paymentmode = $_POST['paymentmode'];
        $cartholdername = $_POST['cartholdername'];
        $cartnumber = $_POST['cartnumber'];
        $expire = $_POST['expire'];
        $cvv = $_POST['cvv'];

        $cart->billdetails($fname, $lname, $uname, $email, $address, $address2, $country, $state, $zipcode, $paymentmode, $cartholdername, $cartnumber, $expire, $cvv);
        // echo "<pre>";
        // print_r($_POST);
        // echo "</pre>";
        break;

    case 'SearchOrder':
        $searchKey = $_POST['searchkey'];
        $cart->searchOrder($searchKey);
        break;
    case 'updateStatusOrder':
        $id = $_POST['id'];
        $value = $_POST['value'];
        $myobj->ChangeOrderStatus($value, $id);
        break;
    case "signout":
        $myobj->SignOut();
        break;
    case 'pagination':
        $offsetvalue=$_POST['offsetvalue'];
        // echo "$offsetvalue";
        echo $myobj->productListing($offsetvalue);
        break;
    case 'paginationproduct':
        // echo "working..";
        $offsetvaluee=$_POST['offset'];
        // echo $offsetvalue;
        $myobj->paginationProduct($offsetvaluee);
        break;
    case "paginationproductuser":
        // echo "working";
        $offsetvalueeee=$_POST['offset'];
        // echo $offsetvalueeee
        $myobj->feachDetailsNEW($offsetvalueeee);
        break;
}
