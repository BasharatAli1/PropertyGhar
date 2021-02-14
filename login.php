<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PropertyGhar</title>
    <link rel="stylesheet" href="css/bootstrap/form_bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style type="text/css">
    </style>
<body>

    <div class="container-fluid">
        <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4">
                        <form class="form-one-col" style="margin: 15% 0 3% 0;" method="post" action="login.php">
                                <div class="form-group">
                                    <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"> <a href = "http://www.propertyghar.com"> <img style="width: 100%; height:105%; padding-bottom: 10%;" src="images/logo/logo_full.png" alt="PropertyGhar"> </a> </div>
                                            <div class="col-md-4"></div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-12">
                                                <label for=" ">Username</label>
                                                <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id="" name="username" placeholder="Enter username">

                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-lg-12">
                                                <label for=" ">Password</label>
                                                <input style="background-color : white; border: 1px solid silver;"  type="password" class="form-control" id="password_id" name="password" placeholder="Password">

                                        </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-12">
                                                <input style="background-color : white; border: 1px solid silver;"  type="checkbox" onclick="togglePass()"> Show Password
                                        </div>
                                </div>
                    
                                <div class="form-group">
                                </div>
                                <br>
                                
                                <button type="submit" class="btn btn-success" name="login">Login</button>
                                <a href="create_account.php" class="brn-link">Create Account</a>
                        </form>

                </div>  <!-- End of 2nd Col -->
                <div class="col-lg-3"></div>
        </div>  <!-- End of Row -->
    </div>  <!-- End of Container -->
   
    <?php

// function decrypt($encryption)
// {
//     // Store the cipher method 
//     $ciphering = "AES-128-CTR"; 
      
//     // Use OpenSSl Encryption method 
//     $iv_length = openssl_cipher_iv_length($ciphering); 
//     $options = 0; 
      
//     // Non-NULL Initialization Vector for encryption 
//     $decryption_iv = '1234567891011121'; 
      
//     // Store the encryption key 
//     $decryption_key = "JinnahKaPakistan"; 
        
//         // Use openssl_decrypt() function to decrypt the data 
//         $decryption = openssl_decrypt ($encryption, $ciphering, $decryption_key, $options, $decryption_iv); 
//         return $decryption;
// }

session_start();
// if user already loged on
if(isset($_SESSION["username"]))
{
    header("location:index.php");
}

$u_name = "";
$pass = "";

if(isset($_POST["login"]))
{
    if(empty($_POST["username"]) && empty($_POST["password"]))
    {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4" style="background-color:red; border-radius:10px;">
                    
                    <div class="row">
                        
                        <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Both fields are required</div></div>
                    </div>
                    
                <div class="col-lg-4"></div>
            </div>
        </div>
        <?php
    }
    else
    {
        $connection = mysqli_connect("localhost", "root", "", "propertyghar");
//        $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
        if($connection)
        {
            $count=0;

            $u_name = mysqli_real_escape_string($connection, $_POST["username"]);
            $pass = mysqli_real_escape_string($connection, $_POST["password"]);
            
//            $pass = md5($pass);

            // $result = mysqli_query($connection, "SELECT * FROM user");
            // while($row = mysqli_fetch_assoc($result))
            // {
            //     $p = password_verify(1, $row['password']);
            //     print_r($p);
            //     echo'<br> </br>';
            //     print_r($row['Username']);
            //     echo'<br> </br>';
            // }
            // echo'<br> this </br>';
            // while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
            // {
            //     echo '<tr>';
            //     echo '<td>'.decrypt($row['username']).'</td>';
            //     echo '<td>'.decrypt($row['password']).'</td>';
            //     echo '</tr>';
            // }
            $query="SELECT * FROM user WHERE Agent_ID = '$u_name' AND Password = '$pass' AND Status = '1'";
            $result = mysqli_query($connection,$query);
            $count = mysqli_num_rows($result);
            if($count==0)
            {
                ?>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4" style="background-color:red; border-radius:10px;">
                            
                            <div class="row">
                                
                                <div class="verifiaction_message_text col-lg-12" style="text-align:center;"><strong>Invalid</strong> username or Password</div></div>
                                <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Try Again</div>
                            </div>
                            
                        <div class="col-lg-4"></div>
                    </div>
                </div>
                <?php
            }
            else
            {
                $result = mysqli_query($connection, "SELECT * FROM user");
                while($row = mysqli_fetch_assoc($result))
                {
                    if($u_name == $row['Agent_ID'])
                    {
                        $_SESSION['role'] = $row['Role'];
                        break;
                    }
                }
                $_SESSION['username'] = $u_name;
                
                // if(isset($_POST['remember']))
                // {
                //     $name = 'uname';
                //     $expiration = time() + (60*60*24*7);
                //     setcookie($name,$u_name,$expiration);    // cookie name, cookie value, when cooky expire
                    
                //     $name='pass';
                //     $expiration = time() + (60*60*24*7);
                //     setcookie($name,$pass,$expiration);
  
                //     echo $_COOKIE['uname'];
                //     echo $_COOKIE['pass'];
                // }
                header('location:index.php');
            }
        }
    }
}
?>

<script>
        function togglePass() 
        {
                var x = document.getElementById("password_id");
                if (x.type === "password") 
                {
                        x.type = "text";
                }
                else
                {
                        x.type = "password";
                }
        }
</script>

</body>
</html>

