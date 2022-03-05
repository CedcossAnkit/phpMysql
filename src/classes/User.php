<?php
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

    function CheckUSer($user, $password)
    {

        try {
            session_start();
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
            } else if (count($arr[0]) == 0) {
                return "Invalid Username Or Password!";
            }
        } catch (PDOException $e) {
            echo "Some Error Occoured!";
        }
    }

    function feachDetails()
    {
        try {
            $sql = "select * from main_table";
            $query = parent::getInstance()->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['user'] = $result;
            // echo "<pre>";
            // print_r($result);

            // echo "</pre>";
        } catch (PDOException $e) {
            echo "Some Erro Occoured";
        }
    }

    function displayTableData($role,$id)
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
                        <td><button id="del" value='.$value['id'].'>Delete</button></td>

                      </tr>';
            }
            else if ($role == "user") {
                if($value['id']==$id){
                    $htm .= '
                        
                        <tr>
                            <td>' . $value['id'] . '</td>
                            <td>' . $value['name'] . '</td>
                            <td>' . $value['email'] . '</td>
                            <td>' . $value['password'] . '</td>
                            <td>' . $value['role'] . '</td>
                            <td>' . $value['status'] . '</td>
                           <td>Not Allow</td>


                        </tr>';
                }
            }
        }

        return $htm;
    }

    function approved($id)
    {
        try {
            $sql = "update main_table set status='approved' where id='$id'";
            parent::getInstance()->query($sql);
        } catch (PDOException $e) {
            echo "Something Went Wrong..";
        }
    }

    function blocked($id)
    {
        try {
            $sql = "update main_table set status='Blocked' where id='$id'";
            parent::getInstance()->query($sql);
        } catch (PDOException $e) {
            echo "Something Went Wrong..";
        }
    }

    function deleteuser($id){
     try{
        $sql="delete from main_table where id='".$id."'";
        parent::getInstance()->query($sql);
     }
     catch(PDOException $e){
        echo "Something Went Wrong..";
     }
       


    }

    public function insertProduct($pid,$pname,$pcat,$pScat,$pprice){
        
        $sql="insert into products
        values ('".$pid."','".$pname."','".$pcat."','".$pScat."','".$pprice."')";
         parent::getInstance()->exec($sql);
         echo "Value Inserted..";
       
        
    }

    public function fatchProduct(){
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

    public function displayproduct($arr){
        $htm="";
        foreach ($arr as $key => $value) {

          
                $htm .= '
                    
                      <tr>
                        <td>' . $value['id'] . '</td>
                        <td>' . $value['product_name'] . '</td>
                        <td>' . $value['category'] . '</td>
                        <td>' . $value['sub_category'] . '</td>
                        <td>' . $value['price'] . '</td>
                        <td><button>Edit</button><button>Delete</button></td>
                      </tr>';
            
            } 
            self::fatchProduct();
            return $htm;
    // echo "<pre>";
    // print_r($_SESSION['p']);
    // echo "</pre>";
    // self::fatchProduct();
    }

 
   
}
