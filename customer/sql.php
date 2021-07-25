<?php
include './../layouts/session.php';
$init = $pdo->open();
$return = $_SERVER['HTTP_REFERER'];

if(isset($_POST['user'])) {
    $name = $_POST['add-name'];
    $email = $_POST['add-email'];
    $idNo = $_POST['add-idNo'];
    $gender = $_POST['add-gender'];
    $password = $_POST['password'];
    $studentNo=date('Y').substr($idNo,2,4).substr(rand(),0,2);
    if($_POST['user'] =='Admin'){
        $sql = $init->prepare("SELECT * FROM admin WHERE email=:email ");
        $sql->execute(['email' => $email]);

        if ($sql->rowCount() > 0) {
            $_SESSION['error'] = 'Email already exits';
        } else {

            $sql = $init->prepare("INSERT INTO admin(name, email,id_number,gender, password) 
						VALUES (:name,:email,:id_number,:gender, :password)");
            $sql->execute(['name'=>$name, 'email'=>$email,'id_number'=>$idNo,'gender'=>$gender, 'password'=>$password]);
            $_SESSION['success'] = 'Admin added successfully';
        }
        header('Location: '.$return);
    }else{
        $sql = $init->prepare("SELECT * FROM student WHERE email=:email ");
        $sql->execute(['email' => $email]);

        if ($sql->rowCount() > 0) {
            $_SESSION['error'] = 'Email already exits';
        } else {

            $sql = $init->prepare("INSERT INTO student(studentNo,name, email,id_number,gender, password) 
						VALUES (:studentNo,:name,:email,:id_number,:gender, :password)");
            $sql->execute(['studentNo'=>$studentNo,'name'=>$name, 'email'=>$email,'id_number'=>$idNo,'gender'=>$gender, 'password'=>$password]);
            $_SESSION['success'] = 'Student added successfully';
        }
        header('Location: '.$return);
    }
}

if(isset($_POST['add-category'])) {
    $category = $_POST['category'];

    $sql = $init->prepare("SELECT * FROM category WHERE categoryName=:categoryName ");
    $sql->execute(['categoryName' => $category]);

    if ($sql->rowCount() > 0) {
        $_SESSION['error'] = 'Category already exits';
    } else {

        $sql = $init->prepare("INSERT INTO category(categoryName) VALUES (:categoryName)");
        $sql->execute(['categoryName'=>$category]);
        $_SESSION['success'] = 'Category added successfully';
    }
    header('Location: '.$return);
}

if(isset($_POST['add-book'])) {
    $book = $_POST['book'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $shelve = $_POST['shelve'];
    $price= $_POST['price'];
    $quantity= $_POST['quantity'];

    $sql = $init->prepare("SELECT * FROM book WHERE bookName=:bookName ");
    $sql->execute(['bookName' => $book]);

    if ($sql->rowCount() > 0) {
        $_SESSION['error'] = 'Book already exits';
    } else {

        $sql = $init->prepare("INSERT INTO book(bookName, categoryID,quantity,author, shelveNumber, price) 
						VALUES (:bookName,:categoryID,:quantity,:author, :shelveNumber, :price)");
        $sql->execute(['bookName'=>$book, 'categoryID'=>$category,'quantity'=>$quantity,'author'=>$author, 'shelveNumber'=>$shelve, 'price'=>$price]);
        $_SESSION['success'] = 'Book added successfully';
    }
    header('Location: '.$return);
}

if(isset($_POST['edit-customer'])) {
    $id = $_POST['edit-customer'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    $sql = $init->prepare("SELECT * FROM customer WHERE id=:id ");
    $sql->execute(['id' => $id]);

    if ($sql->rowCount() < 0) {
        $_SESSION['error'] = 'Customer does not exit';
    } else {

        try{
            $sql = $init->prepare("UPDATE customer SET  name=:name,email=:email,mobile=:mobile,password=:password
                                         WHERE id=:id");
            $sql->execute(['name'=>$name,'email'=>$email, 'mobile'=>$mobile, 'password'=>$password,'id'=>$id]);
            $_SESSION['success'] = 'Details updated successfully';
        }catch (Exception $e){
            $_SESSION['error'] = $e->getMessage();
        }

    }
    header('Location: '.$return);
}

if (isset($_POST['getSaloon'])) {
    $service = $_POST['getSaloon'];

    $sql = $init->prepare("SELECT *,service.id AS serID FROM service,saloon 
                                    WHERE service.saloonID=saloon.id
                                    AND saloon.id=:id");
    $sql->execute(['id' => $service]);
    $results = $sql->fetchAll();

    echo json_encode($results);
}

if (isset($_POST['getSession'])) {
    $user = $_SESSION['id'];

    $sql = $init->prepare("SELECT * FROM session WHERE customerID=:id");
    $sql->execute(['id' => $user]);
    $results = $sql->fetchAll();

    echo json_encode($results);
}

if (isset($_POST['getService'])) {
    $service = $_POST['getService'];

    $sql = $init->prepare("SELECT *,service.id AS serID FROM service,category,saloon 
                                    WHERE service.id=:id AND categoryID=category.id 
                                    AND saloonID=saloon.id");
    $sql->execute(['id' => $service]);
    $results = $sql->fetch();

    echo json_encode($results);
}

if (isset($_POST['test'])) {
    $date = $_POST['test'];
    $start = $_POST['start'];
    $end= $_POST['end'];

    try{
        $sql = $init->prepare("SELECT * FROM session WHERE date=:date 
                                        AND startTime BETWEEN :start AND :end ");
        $sql->execute(['date' => $date,'start'=>$start,'end'=>$end]);
        $results = $sql->fetch();
    }catch (Exception $e){
        $results = $e->getMessage();
    }

    echo json_encode($end+1);
}

if (isset($_POST['loadData'])) {
    $id= $_SESSION['id'];

    $sql = $init->prepare("SELECT * FROM session
                                    WHERE customerID=:id ");
    $sql->execute(['id' => $id]);
    $results = $sql->fetchAll();

    echo json_encode($results);
}

if (isset($_POST['getAllStuff'])) {
    $saloon = $_POST['getAllStuff'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    try{

//        $sql = $init->prepare("SELECT * FROM session WHERE startTime >= {$start} AND endTime < {$end}");
//        $sql->execute();
//        $ids = $sql->fetchAll();
//        $arr=array(0);
//        foreach ($ids as $id){
//            array_push($arr,$id['stuffID']);
//        }
//        $iD = implode(',',$arr);

        $sql = $init->prepare("SELECT * FROM stuff,saloon WHERE saloon.id=stuff.saloonID
                                        AND saloon.id=:id");
        $sql->execute(['id'=>$saloon]);
        $results = $sql->fetchAll();
    }
    catch(PDOException $e){
        $results = $e->getMessage();
    }

    echo json_encode($results);
}


if(isset($_POST['cancelBooking'])){
    $id = $_SESSION['id'];
    $bookID = $_POST['cancelBooking'];

    try{

        $sql = $init->prepare("UPDATE session SET status='cancelled' WHERE customerID=:customerID AND id=:id");
        $sql->execute(['customerID' => $id,'id'=>$bookID]);

        $_SESSION['success'] = 'Booking cancelled successfully';

    }
    catch(PDOException $e){
        echo json_encode($e->getMessage());
    }
    header('Location: '.$return);
}


if(isset($_POST['booking'])) {

    $user = $_SESSION['id'];
//    $stuff = $_POST['stuff'];
    $saloon = $_POST['saloon'];
    $service = $_POST['service'];
    $startTime = $_POST['start'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $endTime = $_POST['end'];
    $duration = $_POST['duration'];
    $bookDate = date('Y M D H:i');

    try{
        $sql = $init->prepare("INSERT INTO session (startTime, endTime,duration, customerID,stuffID, saloonID,price,service,date,bookDate,status)
                    VALUES (:startTime, :endTime,:duration, :customerID,:stuffID, :saloonID,:price,:service,:date,:bookDate,:status)");
        $sql->execute(['startTime'=>$startTime,'endTime'=>$endTime,'duration'=>$duration,'service'=>$service,'price'=>$price,
            'customerID'=>$user,'stuffID'=>'','saloonID'=>$saloon, 'date'=>$date,'bookDate'=>$bookDate,'status'=>'pending']);

        $_SESSION['success'] = 'Booking confirmed successfully at '.$bookDate;
    }catch (Exception $e){
        $_SESSION['error'] = $e->getMessage();
    }

    header('Location: '.$return);
}

if(isset($_POST['complete'])){
    $session = $_POST['complete'];

    try{

        $sql = $init->prepare("UPDATE session SET status=:status WHERE id=:id");
        $sql->execute(['id' => $session,'status'=>'complete']);

    }
    catch(PDOException $e){
        echo json_encode($e->getMessage());
    }
    header('Location: '.$return);
}

if(isset($_POST['endBooking'])){
    $session = $_POST['endBooking'];

    try{

        $sql = $init->prepare("UPDATE session SET status=:status WHERE id=:id");
        $sql->execute(['id' => $session,'status'=>'cancelled']);

        $_SESSION['success'] = 'Session cancelled successfully';


    }
    catch(PDOException $e){
        echo json_encode($e->getMessage());
    }
    header('Location: '.$return);
}

if(isset($_POST['report'])){

    $fugitive_num = $_POST['report'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $case_num = substr(rand(),0,6);
    $id = $_SESSION['id'];

    try{

        $sql = $conn->prepare("INSERT INTO alert(case_number,fugitive_id,user_id,lat,lng) 
                                        VALUES(:case_number,:fugitive_id,:user_id,:lat,:lng)");
        $sql->execute(['case_number'=>$case_num,'fugitive_id'=>$fugitive_num,'user_id'=>$id,'lat'=>$lat,'lng'=>$lng]);


        $sql = $conn->prepare("SELECT * FROM fugitive WHERE id=:id");
        $sql->execute(['id'=>$fugitive_num]);
        $results = $sql->fetch();



    }
    catch(PDOException $e){
        $case_num = $e->getMessage();
    }
    $_SESSION['case_number'] = $case_num;
}

if(isset($_POST['upload-image'])){

    $user = $_SESSION['id'];
    $description = $_POST['description'];
    $image = basename( $_FILES['photo']['name']);
    try{
        $sql = $init->prepare("INSERT INTO search (customerID,image,description) VALUES (:customerID, :image,:description)");
        $sql->execute(['customerID'=>$user,'image'=>$image,'description'=>$description]);

        if(!empty($_FILES['photo']))
        {
            $path = "uploads/";
            $path = $path . basename( $_FILES['photo']['name']);

            if(move_uploaded_file($_FILES['photo']['tmp_name'], $path)) {
                echo "The file ".  basename( $_FILES['photo']['name']).
                    " has been uploaded";
            } else{
                echo "There was an error uploading the file, please try again!";
            }
        }
        $_SESSION['success']='Image uploaded successfully, you will get email from different saloon that offer the service requested..';
    }catch(PDOException $e){
        $_SESSION['error'] = $e->getMessage();
    }
    header('Location: '.$return);
}


$pdo->close();

?>
