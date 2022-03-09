<?php
// namespace ankit;

require_once "DB.php";
class User extends DB
{
    public int $user_id;
    public string $username;
    public string $password;
    public string $email;
    public string $role;
    public string $status;

    public function addUser($user_id, $username, $password, $email, $role, $status)
    {
        $this->user_id = $user_id;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->role = $role;
        $this->status = $status;
        try {
            $sql = "insert into main_table(id,name,email,password,role,status)
            values
              (
                '" . $this->user_id . "','" . $this->username . "','" . $this->email . "','" . $this->password . "','" . $this->role . "','" . $this->status . "'
              )";
            parent::getInstance()->exec($sql);
            echo "Data Sucesfully Inserted..";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }

    public function CheckUSer($user, $password)
    {
        try {

            $sql = "select * from main_table where name='$user' and password='$password' and status='approved'";
            $newquery = parent::getInstance()->prepare($sql);
            $newquery->execute();
            $var = $newquery->fetchAll(PDO::FETCH_ASSOC);
            $arr = array($var);
            $_SESSION['admin'] = $arr[0];

            // echo "<pre>";
            // print_r($_SESSION['admin']);

            // echo "</pre>";
            if (count($arr[0]) != 0) {
                return  "valid";
            } elseif (count($arr[0]) == 0) {
                return "Invalid Username Or Password!";
            }
        } catch (PDOException $e) {
            echo "Some Error Occoured!";
        }
    }

    public function feachDetails($role, $id)
    {
        try {
            $sql = "select * from main_table limit 5 offset 0";
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $result;
            // echo "<pre>";
            // print_r($result);

            // echo "</pre>";
            echo self::displayTableData($role, $id);
        } catch (PDOException $e) {
            echo "Some Erro Occoured";
        }
    }

    public function feachDetailsNEW($offset)
    {
        try {
            $sql = "select * from main_table limit 5 offset $offset";
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $result;
            // echo "<pre>";
            // print_r($result);

            // echo "</pre>";
            echo self::displayusertable();
        } catch (PDOException $e) {
            echo "Some Erro Occoured";
        }
    }

    public function displayusertable()
    {
        $htm = "";
        foreach ($_SESSION['user'] as $key => $value) {
            $htm .= '
                    
                      <tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . $value['email'] . '</td>
                        <td>' . $value['password'] . '</td>
                        <td>' . $value['role'] . '</td>
                        <td>' . $value['status'] . '</td>
                        <td><button id="aprov" value=' . $value["id"] . '>Approved</button><button id="block" value=' . $value["id"] . '>Blocked</button></td>
                        <td><button id="del" value=' . $value['id'] . '>Delete</button></td>


                      </tr>';
        }

        return $htm;
    }

    public function displayTableData($role, $id)
    {
        $htm = "";
        foreach ($_SESSION['user'] as $key => $value) {
            if ($role == "admin") {
                $htm .= '
                    
                      <tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['name'] . '</td>
                        <td>' . $value['email'] . '</td>
                        <td>' . $value['password'] . '</td>
                        <td>' . $value['role'] . '</td>
                        <td>' . $value['status'] . '</td>
                        <td><button id="aprov" value=' . $value["id"] . '>Approved</button><button id="block" value=' . $value["id"] . '>Blocked</button></td>
                        <td><button id="del" value=' . $value['id'] . '>Delete</button></td>


                      </tr>';
            } elseif ($role == "user") {
                if ($value['id'] == $id) {
                    $htm .= '
                        
                        <tr>
                            <td>' . $value['id'] . '</td>
                            <td>' . $value['name'] . '</td>
                            <td>' . $value['email'] . '</td>
                            <td>' . $value['password'] . '</td>
                            <td>' . $value['role'] . '</td>
                            <td>' . $value['status'] . '</td>
                           <td>Not Allow</td>
                           <td>Not Allow</td>



                        </tr>';
                }
            }
        }

        return $htm;
    }

    public function approved($id)
    {
        try {
            $sql = "update main_table set status='approved' where id='$id'";
            parent::getInstance()->query($sql);
        } catch (PDOException $e) {
            echo "Something Went Wrong..";
        }
    }

    public function blocked($id)
    {
        try {
            $sql = "update main_table set status='Blocked' where id='$id'";
            parent::getInstance()->query($sql);
        } catch (PDOException $e) {
            echo "Something Went Wrong..";
        }
    }

    public function deleteuser($id)
    {
        try {
            $sql = "delete from main_table where id='" . $id . "'";
            parent::getInstance()->query($sql);
        } catch (PDOException $e) {
            echo "Something Went Wrong..";
        }
    }

    public function insertProduct($pid, $pname, $pcat, $pScat, $pprice, $image)
    {
        $sql = "insert into products
        values ('" . $pid . "','" . $pname . "','" . $pcat . "','" . $pScat . "','" . $pprice . "','" . $image . "')";
        parent::getInstance()->exec($sql);
        echo "Value Inserted..";
    }

    public function fatchProduct()
    {
        try {
            $sql = "select * from products";
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['p'] = $result;
            // echo "<pre>";
            // print_r($_SESSION['p']);

            // echo "</pre>";
        } catch (PDOException $e) {
            echo "Some Erro Occoured";
        }
    }

    public function fatchProductDashboard()
    {
        try {
            $sql = "select * from products ORDER BY id DESC limit 5";
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['p'] = $result;
            // echo "<pre>";
            // print_r($_SESSION['p']);

            echo self::displayproduct($_SESSION['p']);
        } catch (PDOException $e) {
            echo "Some Erro Occoured";
        }
    }

    function paginationProduct($offset)
    {
        try {
            $sql = "select * from products limit 10 offset $offset";
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['p'] = $result;
            // echo "<pre>";
            // print_r($_SESSION['p']);

            echo self::displayproduct($_SESSION['p']);
        } catch (PDOException $e) {
            echo "Some Erro Occoured";
        }
    }


    public function displayproduct($arr)
    {
        $htm = " <tr>
        <th scope='col'>id</th>
        <th scope='col'>Name</th>
        <th scope='col'>Catagory</th>
        <th scope='col'>Sub Catagory</th>
        <th scope='col'>Price</th>
        <th scope='col'>Action</th>

      </tr>";
        foreach ($arr as $key => $value) {
            $htm .= '
                    
                      <tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['product_name'] . '</td>
                        <td>' . $value['category'] . '</td>
                        <td>' . $value['sub_category'] . '</td>
                        <td>' . $value['price'] . '</td>
                        <td><button id="editt" value=' . $value['id'] . '>Edit</button><button id="dell" value="' . $value['id'] . '">Delete</button></td>
                      </tr>';
        }
        self::fatchProduct();
        return $htm;
        // echo "<pre>";
        // print_r($_SESSION['p']);
        // echo "</pre>";
        // self::fatchProduct();
    }

    public function fatchProductDashboard2($userID)
    {
        try {
            $sql = "select * from orders where userID='$userID'";
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['p'] = $result;
            // echo "<pre>";
            // print_r($_SESSION['p']);

            echo self::displayproduct2($_SESSION['p']);
        } catch (PDOException $e) {
            echo "Some Erro Occoured";
        }
    }
    public function displayproduct2($arr)
    {
        $htm = "";
        foreach ($arr as $key => $value) {
            $htm .= '
                    <tbody>
                      <tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['product_name'] . '</td>
                        <td>' . $value['category'] . '</td>
                        <td>' . $value['sub_category'] . '</td>
                        <td>' . $value['price'] . '</td>
                        <td><button id="editt" value=' . $value['id'] . '>Edit</button><button id="dell" value="' . $value['id'] . '">Delete</button></td>
                      </tr>
                      </tbody>';
        }
        self::fatchProduct();
        return $htm;
        // echo "<pre>";
        // print_r($_SESSION['p']);
        // echo "</pre>";
        // self::fatchProduct();
    }
    public function deleteProduct($id)
    {
        try {
            $sql = "delete from products where id='" . $id . "'";
            parent::getInstance()->query($sql);
            echo "Product Sucesfully Deleted...";
        } catch (PDOException $e) {
            echo "Something went wrong..";
        }
    }

    public function search($id)
    {
        try {
            $htm = "";
            if (!$id) {
                $sql = "select * from products";
            } else {
                $sql = "select * from products where id='$id' or product_name='$id' or category='$id' or price='$id'";
            }
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['search'] = $result;

            if ($query == true) {
                foreach ($_SESSION['search'] as $key => $value) {
                    $htm .= '<tr>
                    <td>' . $value['id'] . '</td>
                    <td>' . $value['product_name'] . '</td>
                    <td>' . $value['category'] . '</td>
                    <td>' . $value['sub_category'] . '</td>
                    <td>' . $value['price'] . '</td>
                    <td><button id="editt" value=' . $value['id'] . '>Edit</button><button id="dell" value="' . $value['id'] . '">Delete</button></td>
                  </tr>';
                }
                echo $htm;
            } else {
                echo "Not Found";
            }
        } catch (PDOException $e) {
            echo "Not Found";
        }
    }
    public function FeachAllProduct($offsetvalue)
    {
        $sql = "select * from products limit 6 offset $offsetvalue";
        $query = parent::getInstance()->query($sql);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['allProduct'] = $result;
    }
    public function productListing($offsetvalue)
    {
        $htm = "";
        self::FeachAllProduct($offsetvalue);
        foreach ($_SESSION['allProduct'] as $key => $value) {
            $htm .= '<div class="col">
           <div class="card shadow-sm">
             <img  class="viewProduct" value="' . $value['id'] . '" src="../images/' . $value['image'] . '" style="height:250px; width:300px border-radius:15px"></img>
 
             <div class="card-body">
                 <h5 class="viewProduct">' . $value['product_name'] . '</h5>
               <p class="card-text">Sample text below</p>
               <div class="d-flex justify-content-between align-items-center">
                 <p><strong>' . $value['price'] . '</strong>&nbsp;<del><small class="link-danger">$180</small></del></p>
                 <button class="btn btn-primary" id="addtocart" value=' . $value['id'] . '>Add To Cart</button>
               </div>
             </div>
           </div>
         </div>';
        }

        return $htm;
    }

    public function fatchSearch($pdname)
    {
        try {
            if ($pdname == "") {
                $sql = "select * from products";
            } else {
                $sql = "select * from products where product_name='$pdname' or category='$pdname'";
            }

            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['SearchPD'] = $result;
            $htm = "";
            foreach ($_SESSION['SearchPD'] as $key => $value) {
                $htm .= '<div class="col">
            <div class="card shadow-sm" >
              <img class="viewProduct" src="../images/' . $value['image'] . '" style="height:250px; width:300px border-radius:15px"></img>
  
              <div class="card-body">
                  <h5 class="viewProduct">' . $value['product_name'] . '</h5>
                <p class="card-text">Sample text below</p>
                <div class="d-flex justify-content-between align-items-center">
                  <p><strong>' . $value['price'] . '</strong>&nbsp;<del><small class="link-danger">$180</small></del></p>
                  <button class="btn btn-primary" id="addtocart" value=' . $value['id'] . '>Add To Cart</button>
                </div>
              </div>
            </div>
          </div>';
            }

            echo $htm;
        } catch (PDOException $e) {
            echo "Something Went Wrong";
        }
    }

    public function filter($key)
    {
        try {
            if ($key == 'price') {
                $sql = "select * from products where price order by price desc";
                $query = parent::getInstance()->query($sql);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['filter'] = $result;
            } elseif ($key == 'Recently Added') {
                $sql = "select * from products order by id desc limit 5";
                $query = parent::getInstance()->query($sql);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['filter'] = $result;
            } elseif ($key == "Popularity") {
                $sql = "select * from products";
                $query = parent::getInstance()->query($sql);
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $_SESSION['filter'] = $result;
            }

            $htm = "";
            foreach ($_SESSION['filter'] as $key => $value) {
                $htm .= '<div class="col">
            <div class="card shadow-sm">
              <img class="viewProduct" src="../images/' . $value['image'] . '" style="height:250px; width:300px border-radius:15px"></img>
  
              <div class="card-body">
                  <h5 class="viewProduct">' . $value['product_name'] . '</h5>
                <p class="card-text">Sample text below</p>
                <div class="d-flex justify-content-between align-items-center">
                  <p><strong >' . $value['price'] . '</strong>&nbsp;<del><small class="link-danger">$180</small></del></p>
                  <button class="btn btn-primary" id="addtocart" value=' . $value['id'] . '>Add To Cart</button>
                </div>
              </div>
            </div>
          </div>';
            }
            echo $htm;
        } catch (PDOException $e) {
            echo "Something Wen Wrong..";
        }
    }
    public function ShowFatchProduct($pname)
    {
        try {
            $myobj = new DB();
            $sql = "select * from  products where product_name ='$pname'";
            $query = $myobj->getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['ProductinView'] = $result;

            echo self::DisplayViewProduct();
        } catch (PDOException $e) {
            echo "Some went Wrong->$e";
        }
    }

    public function DisplayViewProduct()
    {
        $htm = "";
        foreach ($_SESSION['ProductinView'] as $key => $value) {
            $htm .= '
            <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div class="col-md-6"><img class="card-img-top mb-5 mb-md-0" src="../images/' . $value['image'] . '" alt="..." /></div>
                <div class="col-md-6">
                    <div class="small mb-1">SKU: ' . $value['id'] . '</div>
                    <h1 class="display-5 fw-bolder">' . $value['product_name'] . '</h1>
                    <div class="fs-5 mb-5">
                        <span class="text-decoration-line-through">' . $value['price'] . '</span>
                        <span>$40.00</span>
                    </div>
                    <p class="lead">Lorem ipsum dolor sit amet consectetur adipisicing elit. Praesentium at dolorem quidem modi. Nam sequi consequatur obcaecati excepturi alias magni, accusamus eius blanditiis delectus ipsam minima ea iste laborum vero?</p>
                    <div class="d-flex">
                        <input class="form-control text-center me-3" id="inputQuantity" type="num"  style="max-width: 3rem" />
                        <button value=' . $value['id'] . ' id="updatebtn" class="btn btn-outline-dark flex-shrink-0" type="button">
                            <i class="bi-cart-fill me-1"></i>
                            Add to cart
                        </button>
                    </div>
                </div>
            </div>
        </div>';
        }

        return $htm;
    }

    public function fatchEditDetails($id)
    {
        $htm = array();
        foreach ($_SESSION['p'] as $key => $value) {
            if ($value['id'] == $id) {
                array_push($htm, $value);
            }
        }

        echo json_encode($htm);
    }

    public function EDITuserDETAILS($pid, $pname, $pcat, $scat, $price, $pimage, $readid)
    {
        try {
            $sql = "update products set id='$pid', product_name='$pname', category='$pcat', sub_category='$scat', price='$price', image='$pimage' where id='$readid'";
            parent::getInstance()->exec($sql);
            echo "update sucesfuly";
        } catch (PDOException $e) {
            echo "Error Occoured->" . $e;
        }
    }

    function ChangeOrderStatus($key, $id)
    {
        $sql = "update orders set status='$key' where orderID='$id'";
        parent::getInstance()->exec($sql);
        echo "status updated of orders table";
    }

    function SignOut()
    {
        unset($_SESSION['admin']);
    }
}
