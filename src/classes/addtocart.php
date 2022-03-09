<?php

session_start();
require_once "DB.php";
class cart extends DB
{
    function addtocart($id)
    {
        $sql = "select * from products where id='$id'";
        $query = parent::getInstance()->query($sql);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $result['quantity'] = 1;

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();

            $_SESSION['cart'][] = $result;
        } else if (self::checkcart($id) == false) {
            if (isset($_SESSION['cart'])) {

                array_push($_SESSION['cart'], $result);
            } else {

                $_SESSION['cart'] = array();

                $_SESSION['cart'][] = $result;
            }
        } else {
            self::updateQuantity($id, 1);
        }
    }


    //     echo "<pre>";
    //     print_r($_SESSION['cart']);
    //     echo "</pre>";
    // }

    function diaplayCart()
    {
        if (isset($_SESSION['cart'])) {
            $htm = "";
            foreach ($_SESSION['cart'] as $key => $value) {

                $htm .= '
                <tr>
                    <td>' . $value['product_name'] . '</td>
                    <td>' . $value['price'] . ' ₹</td>
                    <td>
                        <input type="text" class="w-20" id="updateValue' . $value['id'] . '">
                        <input type="button" id="updatebtn" class="btn btn-secondary ms-1 w-20" value=' . $value['id'] . '>
                        <label>Quantity:' . $value['quantity'] . '</label>
                        <button href="#" class="link-danger" value="' . $value['id'] . '" id="delll">Remove</button>
                    </td>
                    <td>' . $value['price'] . ' ₹</td>
                </tr>';
            }
            return $htm;
        }
    }

    function totalAmoutn()
    {
        if (isset($_SESSION['cart'])) {
            $Tamount = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $Tamount += $value['price'];
            }
            return $Tamount . " ₹";
        } else {
            return 0;
        }
    }
    function checkcart($id)
    {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $id) {
                return true;
            }
        }
        return false;
    }
    function total()
    {
        if (isset($_SESSION['cart'])) {
            $count = 0;
            foreach ($_SESSION['cart'] as $key => $value) {
                $count++;
            }
            return $count++;
        } else {
            return 0;
        }
    }

    function updateQuantity($id, $quant)
    {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($value['id'] == $id) {

                if ($quant == 0) {
                    $_SESSION['cart'][$key]['quantity'] += $quant;
                } else {
                    $_SESSION['cart'][$key]['price'] *= $quant;
                    $_SESSION['cart'][$key]['quantity'] += $quant;
                }
            }
        }
    }

    function deletCartIteam($id)
    {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['id'] == $id) {
                    unset($_SESSION['cart'][$key]);
                    echo "Delete Sucesfully";
                }
            }
        }
    }

    function Clearcart()
    {
        if (isset($_SESSION['cart'])) {
            unset($_SESSION['cart']);
            echo "Cart Clear Scussfully";
        }
    }

    function showCartItemCheckout()
    {
        $htm = "";
        foreach ($_SESSION['cart'] as $kye => $value) {
            $htm .= '
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <h6 class="my-0">' . $value['product_name'] . '</h6>
                <small class="text-muted">Quantity ' . $value['quantity'] . '</small>
              </div>
              <span class="text-muted">' . $value['price'] . '</span>
            </li>
            ';
        }
        return $htm;
        // echo "<pre>";
        // print_r($_SESSION['cart']);
        // echo "</pre>";
    }

    function billdetails($fname, $lname, $uname, $email, $address, $address2, $country, $state, $zipcode, $paymentmode, $cartholdername, $cartnumber, $expire, $cvv)
    {
        try {
            $sql = "
                insert into Bill(`firstName`, `lastName`, `userName`, `email`, `address`, `address2`, `country`, `state`, `zip`, `paymentMode`, `cartHolderName`, `cartNumber`, `expire`, `cvv`)
                values
                (
                    '$fname',
                   '$lname',
                  '$uname',
                 '$email',
                   '$address',
                  '$address2',
                 '$country',
              '$state',
               '$zipcode',
                 '$paymentmode',
                  '$cartholdername',
                 '$cartnumber',
                 ' $expire',
                 '$cvv'
                )";
            $sql2 = "";
            foreach ($_SESSION['cart'] as $key => $value) {
                $random = rand();
                $sql2 = "
                INSERT INTO orders 
                 VALUES 
                ('$random','$uname','$email','" . $value['price'] . "','" . $value['product_name'] . "', '12/12/2022', '20/12/2022', 'Pending')";
                parent::getInstance()->exec($sql2);
                unset($_SESSION['cart']);
            }
            parent::getInstance()->exec($sql);
        } catch (PDOException $e) {
            echo "something went wrong.$e";
        }
    }

    function fatchOrderDetails()
    {
        $sql = "select * from orders order by userID";
        $query = parent::getInstance()->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['orderDetails'] = $result;
    }

    function showOrderDetails()
    {
        $totalAmount = 0;
        $total = 0;
        self::fatchOrderDetails();
        $sql = "";
        $dil = 0;
        $pend = 0;
        if (isset($_SESSION['orderDetails'])) {
            foreach ($_SESSION['orderDetails'] as $key => $value) {
                $sql .= "
                    <tr>
                    <td>" . $value['orderID'] . "</td>
                    <td>" . $value['userID'] . "</td>
                    <td>" . $value['email'] . "</td>
                    <td>" . $value['price'] . "</td>
                    <td>" . $value['productID'] . "</td>
                    <td>" . $value['placeDate'] . "</td>
                    <td>" . $value['diliveryDate'] . "</td>
                    <td>" . $value['status'] . "</td>
                    <td>
                        <button id='orderaction' value='" . $value['orderID'] . "'>Pending</button>
                        <button id='orderaction'  value='" . $value['orderID'] . "'>Delivered</button>
                    </td>
                    </tr>
                ";
                if ($value['status'] == 'Pending') {
                    $pend++;
                } else {
                    $dil++;
                }
                $total++;
                $totalAmount += $value['price'];
            }
        } else {
            $sql = "Something went wrong";
        }


        $a = "<tr>
                <td><p style='color:red; display:inline;font-size:16px'>Number of Orders: $total</p></td>
                <td><p style='color:green; display:inline;font-size:16px'>Total Price: $totalAmount</p></td>
                <td><p style='color:red; display:inline;font-size:16px'>Total Dilivered: $dil</p></td>
                <td><p style='color:green; display:inline;font-size:16px'>Total Pending: $pend</p></td>
            </tr>";
        $newhtm = $sql . $a;
        echo $newhtm;
        //     echo "<pre>";
        //  print_r($_SESSION['orderDetails']);
        //     echo "</pre>";
    }

    function searchOrder($seachkey)
    {   $dil = 0;
        $pend = 0;
        $sql = "select * from orders where userID='$seachkey'";
        $query = parent::getInstance()->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['SearchOrder'] = $result;
        $htm = "";
        $total = 0;
        $totalAmount = 0;
        foreach ($_SESSION['SearchOrder'] as $key => $value) {
            $htm .= "
            <tr>
            <td>" . $value['orderID'] . "</td>
            <td>" . $value['userID'] . "</td>
            <td>" . $value['email'] . "</td>
            <td>" . $value['price'] . "</td>
            <td>" . $value['productID'] . "</td>
            <td>" . $value['placeDate'] . "</td>
            <td>" . $value['diliveryDate'] . "</td>
            <td>" . $value['status'] . "</td>
            <td>
                <button id='orderaction' value='" . $value['orderID'] . "'>Pending</button>
                <button id='orderaction'  value='" . $value['orderID'] . "'>Delivered</button>
            </td>
            </tr>
                ";
            if ($value['status'] == 'Pending') {
                    $pend++;
            } else {
                    $dil++;
            }
            $total++;
            $totalAmount += $value['price'];
        }
        $a = "<tr>
        <td><p style='color:red; display:inline;font-size:16px'>Number of Orders: $total</p></td>
        <td><p style='color:green; display:inline;font-size:16px'>Total Price: $totalAmount</p></td>
        <td><p style='color:red; display:inline;font-size:16px'>Total Dilivered: $dil</p></td>
        <td><p style='color:green; display:inline;font-size:16px'>Total Pending: $pend</p></td>
            </tr>";
        $newhtm = $htm . $a;
        echo $newhtm;
    }
}
