<?php
//hash the password submitted after cleaning the values for possible breaches. we then check if their login info and password matched before closing the connection and sending them to the correct page.
if(isset($_POST['submit'])){

    include 'database.php';
    $db = new database();

    $login = $db -> conn -> real_escape_string($_POST['loginInfo']);
    $password = hash('sha512', $db -> conn -> real_escape_string($_POST['password']));

    if($db -> read($login, $password)){
        mysqli_close($db -> conn);
        $db = null;
        header("Location: ../login-success.php");
        exit;
    }else{
        mysqli_close($db -> conn);
        $db = null;
        header("Location: ../index.php?loginFailed");
        exit;
    }

} else{
    header("Location: index.php?NotThatEasy");
    exit;
}