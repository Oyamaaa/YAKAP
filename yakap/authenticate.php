<?php

session_start();

include 'db.php';

$username = $_POST['username'];

$password = $_POST['password'];

$sql = mysqli_query(

$conn,

"SELECT * FROM users
WHERE username='$username'
AND password='$password'"

);

if(mysqli_num_rows($sql)>0){

    $row = mysqli_fetch_assoc($sql);

    $_SESSION['id'] = $row['id'];

    $_SESSION['name'] = $row['username'];

    header("Location: dashboard.php");

}else{

    $_SESSION['login_error'] =
    "Invalid Username or Password!";

    header("Location: login.php");

}

exit();

?>