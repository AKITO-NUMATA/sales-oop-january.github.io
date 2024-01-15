<?php

require 'Database.php';

class Product extends Database{

    public function store($request)
    {
        $product_name = $request['product_name'];
        $price = $request['price'];
        $quantity = $request['quantity'];

        $sql = "INSERT INTO products (`product_name`, `price`, `quantity`) 
                VALUES ('$product_name', '$price', '$quantity')";

        if($this->conn->query($sql)){
            header('location: ../views/dashboard.php'); //go to index.php
            exit;
        } else{
            die('Error creating the user: ' . $this->conn->error);
        }
    }

    public function login($request)
    {
        $username = $request['username'];
        $password = $request['password'];

        $sql = "SELECT * FROM users WHERE username = '$username'";

        $result = $this->conn->query($sql);

        #Check the username
        if ($result->num_rows == 1){
            # Check if the password is correct
            $user = $result->fetch_assoc();
            // $user = ['id' => 1, 'username' => 'John', 'password' => '$2y$...']

            if(password_verify($password, $user['password']))
            {
                // create a session variables for future use
                session_start();

                $_SESSION['id']         = $user['id'];
                $_SESSION['username']   = $user['username'];
                $_SESSION['full_name']   = $user['first_name'] . " " . $user['last_name'];

                header('location: ../views/dashboard.php');
                exit;
            } else {
                die('Password is incorrect');
            }
        } else {
            die('Username not found');
        }
    }


    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();

        header('location: ../views');
        exit;
    }

    public function getAllProducts()
    {
        $sql = "SELECT id, product_name, price, quantity FROM products";

        if($result = $this->conn->query($sql)){
            return $result;
        } else {
            die('Error retrieving all users: ' . $this->conn->error);
        }
    }

    public function getproduct($id)
    {
        $sql = "SELECT * FROM products WHERE id = $id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        } else {
            die('Error retrieving the product: ' . $this->conn->error);
        }
    }

    public function update($request, $files)
    {
        session_start();
        $id = $_SESSION['id'];
        $first_name = $request['first_name'];
        $last_name = $request['last_name'];
        $username = $request['username'];
        //$photo = $files['photo']['name'];
        //$tmp_photo = $files['photo']['tmp_name'];

        $sql = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username' WHERE id = $id";

        if($this->conn->query($sql))
        {
            $_SESSION['username'] = $username;
            $_SESSION['full_name'] = "$first_name $last_name";

            // if($photo){
            //     $sql = "UPDATE users SET photo = '$photo' WHERE id = $id";
            //     $destination = "../assets/images/$photo";

            //     if($this->conn->query($sql)){
            //         if(move_uploaded_file($tmp_photo, $destination)){
            //             header('location: ../views/dashboard.php');
            //             exit;
            //         }else{
            //             die('Error updating the photo');
            //         }
            //     }else{
            //         die('Error uploading the photo:' .$this->conn->error);
            //     }
            // }
            header('location: ../views/dashboard.php');
            exit;
        }else{
            die('Error uploading the user: '. $this->conn->error);
        }

    }

    public function delete($product_id)
    {
        session_start();

        $sql = "DELETE FROM products WHERE id = $product_id";

        if($this->conn->query($sql))
        {
            $this->logout();
        }else{
            die('Error delete your products' . $this->conn->error);
        }
    }
}
?>
