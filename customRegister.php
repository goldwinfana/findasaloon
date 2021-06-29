<?php

include 'layouts/session.php';
$conn = $pdo->open();
$return = $_SERVER['HTTP_REFERER'];

if(isset($_POST['register'])){

        $name = $_POST['name'];
        $email = $_POST['email'];
       // $mobile= $_POST['mobile'];
        $password = $_POST['password'];
        $gender =$_POST['gender'];
        $idNo=$_POST['idNo'];

        try {

            $stmt = $conn->prepare("INSERT INTO student (name,gender, email,id_number, password) 
            VALUES (:name, :gender,:email,:id_number,:password)");
            $stmt->execute(['name' => $name, 'gender' => $gender, 'email' => $email,'id_number' => $idNo, 'password' => $password]);
            $userid = $conn->lastInsertId();

            $_SESSION['success'] = 'Account successfully created. Proceed to Login';
            header('location: login.php');

        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
            header('location: '.$return);
        }

}

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    try{

        $sql = $conn->prepare("SELECT *, COUNT(*) AS countRow FROM admin WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($results['countRow'] > 0){
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

        $sql = $conn->prepare("SELECT *, COUNT(*) AS countRow FROM student WHERE email = :email");
        $sql->execute(['email'=>$email]);
        $results = $sql->fetch();

        if($results['countRow'] > 0){
            if($password == $results['password']){
                $_SESSION['user'] = 'student';
                $_SESSION['name'] = $results['name'];
                $_SESSION['studentNo'] = $results['studentNo'];
                $_SESSION['id'] = $results['id'];
                $_SESSION["islogged"] = true;
                $_SESSION["email"] = $results['email'];
                header('location: student/dashboard.php');
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



$pdo->close();
?>
