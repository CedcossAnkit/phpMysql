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

        public function addUser($user_id, $username, $password, $email, $role, $status){
            $this->user_id = $user_id;
            $this->username = $username;
            $this->password = $password;
            $this->email = $email;
            $this->role = $role;
            $this->status = $status;
            try{
            $sql="insert into main_table(id,name,email,password,role,status)
            values
              (
                '".$this->user_id."','".$this->username."','".$this->email."','".$this->password."','".$this->role."','".$this->status."'
              )";
            parent::getInstance()->exec($sql);
            echo "Data Sucesfully Inserted..";
            }
            catch(PDOException $e) {
                echo $sql . "<br>" . $e->getMessage();
            }
        }

        function CheckUSer($user,$password){

            try{
                $sql="select * from main_table where name='$user' and password='$password' and status='approved'";
                $newquery= parent::getInstance()->prepare($sql);
                $newquery->execute();
                $var=$newquery->fetchAll();
                $arr=array($var);
                // echo "<pre>";
                // print_r($arr);
                // echo count($arr[0]);
                // echo "</pre>";
                if(count($arr[0])!=0){
                   

                    return  "valid";
                  
                }
                else if(count($arr[0])==0){
                    return "Invalid Username Or Password!";
                }
            }
            catch(PDOException $e){
                echo "Some Error Occoured!";
            }

        }

        
    }