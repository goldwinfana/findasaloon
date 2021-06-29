<?php

include 'layouts/session.php';
$conn = $pdo->open();
$return = $_SERVER['HTTP_REFERER'];

if(isset($_POST['register'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile= $_POST['mobile'];
        $password = $_POST['password'];
        $accType = $_POST['accountType'];

        $sql = $conn->prepare("SELECT * FROM customer WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $row = $sql->fetch();

        if($sql->rowCount() >0){
            $_SESSION['error']= 'Email already exists.';
            header('location: '.$return);
            exit(0);
        }

        $sql = $conn->prepare("SELECT * FROM saloon WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $row = $sql->fetch();

        if($sql->rowCount() >0){
            $_SESSION['error']= 'Email already exists.';
            header('location: '.$return);
            exit(0);
        }

        $sql = $conn->prepare("SELECT * FROM admin WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $row = $sql->fetch();

        if($sql->rowCount() >0){
            $_SESSION['error']= 'Email already exists.';
            header('location: '.$return);
            exit(0);
        }


        if($accType =='business'){
            try {

                $stmt = $conn->prepare("INSERT INTO saloon (name, email,regNo,mobile, password) 
            VALUES (:name,:email,:regNo,:mobile,:password)");
                $stmt->execute(['name' => $name, 'email' => $email,'regNo' => $_POST['regNo'], 'mobile' => $mobile,'password' => $password]);

                $_SESSION['success'] = 'Account successfully created. Proceed to Login';
                header('location: login.php');

            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
                header('location: '.$return);
            }
        }else{
            try {

                $stmt = $conn->prepare("INSERT INTO customer (name, email,mobile, password) 
            VALUES (:name,:email,:mobile,:password)");
                $stmt->execute(['name' => $name, 'email' => $email,'mobile' => $mobile, 'password' => $password]);

                $_SESSION['success'] = 'Account successfully created. Proceed to Login';
                header('location: login.php');

            } catch (PDOException $e) {
                $_SESSION['error'] = $e->getMessage();
                header('location: '.$return);
            }
        }



}

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    try{

        $sql = $conn->prepare("SELECT * FROM admin WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($sql->rowCount() >  0){
            if($password == $results['password']){
                $_SESSION['user'] = 'admin';
                $_SESSION['name'] = $results['name'];
                $_SESSION['id'] = $results['id'];
                $_SESSION["islogged"] = true;
                $_SESSION["email"] = $results['email'];
                header('location: admin/dashboard.php');
            }
            else{
                $_SESSION['error'] = 'Incorrect Password...';
                header('location: '.$return);
            }
        }

        $sql = $conn->prepare("SELECT * FROM customer WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($sql->rowCount() >  0){
            if($password == $results['password']){
                $_SESSION['user'] = 'customer';
                $_SESSION['name'] = $results['name'];
                $_SESSION['id'] = $results['id'];
                $_SESSION["islogged"] = true;
                $_SESSION["email"] = $results['email'];
                header('location: customer/dashboard.php');
            }
            else{
                $_SESSION['error'] = 'Incorrect Password...';
                header('location: '.$return);
            }
        }

        $sql = $conn->prepare("SELECT * FROM saloon WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($sql->rowCount() >  0){
            if($password == $results['password']){
                $_SESSION['user'] = 'saloon';
                $_SESSION['name'] = $results['name'];
                $_SESSION['id'] = $results['id'];
                $_SESSION["islogged"] = true;
                $_SESSION["email"] = $results['email'];
                header('location: saloon/dashboard.php');
            }
            else{
                $_SESSION['error'] = 'Incorrect Password...';
                header('location: '.$return);
            }
        }
        else{
            $_SESSION['error'] = 'Email Does Not Exist...';
            header('location: '.$return);
        }
    }
    catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }


}


if (isset($_POST['getSaloon'])) {

    $sql = $conn->prepare("SELECT * FROM saloon");
    $sql->execute();
    $results = $sql->fetchAll();

    echo json_encode($results);
}


$pdo->close();
?>
