<?php
    session_start();
    
    unset($_SESSION['username']);
    session_destroy();
//    $_SESSION("username")=nulll;

    // if(isset($_COOKIE['username']) && isset($_COOKIE['password']))
    // {
    //     $value=$_COOKIE['username'];
    //     $expiration = time() - 1;
    //     setcookie('username',$value,$expiration);
        
    //     $value=$_COOKIE['password'];
    //     $expiration = time() - 1;
    //     setcookie('password',$value,$expiration);
    // }
    
        header("location: index.php");
?>