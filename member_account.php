<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Member Account</title>
    <link rel="stylesheet" href="css/bootstrap/form_bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">
    <style type="text/css">
    </style>
<body>

<?php

// define variables and set to empty values

$everyThingOK = true;
$phone_p_id = $address_id = "";
$name_err = $f_name_err = $u_name_err = $pass_err = $phone_err = $city_err = $province_err = $address_err = $gender_err = "";

if(isset($_POST["member_account"]))
{
        $connection = mysqli_connect("localhost", "root", "", "propertyghar");
//        $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
        // Check connection
        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }
        if($connection)
        {
                $name=$_POST['name'];
                $father_name=$_POST['fatherName'];
                $cnic=$_POST['cnic'];
                $u_name=$_POST['userName'];
                $pass=$_POST['password'];
                $phone_p=$_POST['phone_personal'];
                $email=$_POST['email'];
                $city=$_POST['city'];
                $province=$_POST['province'];
                $address=$_POST['address'];
                if($_POST['gender'] == 'male')
                {
                        $gender = 'm';
                }
                else
                {
                        $gender = 'f';
                }

                if (empty($_POST["name"])|| empty($_POST["fatherName"])||empty($_POST["userName"])||empty($_POST["password"])||empty($_POST["city"])||empty($_POST["province"])||empty($_POST["address"]))
                {
                        ?>
                        <div class="container">
                        <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4" style="background-color:red; border-radius:10px; margin-top:3%;">
                                
                                <div class="row">
                                        
                                        <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Some of the required fields are not filled.</div>
                                </div>
                                
                                <div class="col-lg-4"></div>
                        </div>
                        </div>
                        <?php

                        // if $everyThingOK = false then we don't execute curies, as some of required fields are empty
                        $everyThingOK = false;

                        //if username already exist and now user refresh page, then warning will disappear
                        //$_POST['name']="";
                }
                if (strlen($_POST["phone_personal"]) < 10)
                        $phone_err=" uncomplete number";
                if (empty($_POST["name"]))
                        $name_err=" Required";
                if (empty($_POST["fatherName"]))
                        $f_name_err=" Required";
                if (empty($_POST["userName"]))
                         $u_name_err=" Required";
                if (empty($_POST["password"]))
                        $pass_err=" Required";
                if (empty($_POST["city"]))
                        $city_err=" Required";
                if (empty($_POST["province"]))
                        $province_err=" Required";
                if (empty($_POST["address"]))
                         $address_err=" Required";
                if (empty($_POST["password"]))
                        $gender_err="Required";
                // if fields are not empty, then we go further ($everyThingOK = true), else not
                if($everyThingOK)
                {
                        $count = 0;
                        $query="SELECT * FROM user WHERE Agent_ID = '$u_name'";
                        $result = mysqli_query($connection,$query);
                        $count = mysqli_num_rows($result);
                        if ($count != 0)
                        {
                                ?>
                                <div class="container">
                                <div class="row">
                                        <div class="col-lg-4"></div>
                                        <div class="col-lg-4" style="background-color:red; border-radius:10px; margin-top:3%;">
                                        
                                        <div class="row">
                                                
                                                <div class="verifiaction_message_text col-lg-12" style="text-align:center;"><strong>Username </strong> alredy exist </div></div>
                                                <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Try Again</div>
                                        </div>
                                        
                                        <div class="col-lg-4"></div>
                                </div>
                                </div>
                                <?php
        
                                //if username already exist and now user refresh page, then warning will disappear
                                $_POST['name']="";
                        }
                        else
                        {
                                /* 
                                SQL Injection - How to Prevent it
        
                                So when we have coal miners or any type of other parentheses or any type
                                of data they're going to clean it up, called scaping sql
                                */
        
                                $name = mysqli_real_escape_string($connection, $name);
                                $father_name = mysqli_real_escape_string($connection, $father_name);
                                $cnic = mysqli_real_escape_string($connection, $cnic);
                                $u_name = mysqli_real_escape_string($connection, $u_name);
                                $pass = mysqli_real_escape_string($connection, $pass);
                                $email = mysqli_real_escape_string($connection, $email);
                                $phone_p = mysqli_real_escape_string($connection, $phone_p);
                                $city = mysqli_real_escape_string($connection, $city);
                                $province = mysqli_real_escape_string($connection, $province);
                                $address = mysqli_real_escape_string($connection, $address);
                        
                                // User
                                $query="INSERT INTO user(Name, Father_Name, CNIC, Agent_ID, Password, Email, Estate_Name, Gender, Role, Personal_Phone, Office_Phone, City, Province, Address, Status, No_of_Req, No_of_Posts, Normal, Super_Hot, Hot)
                                VALUES('$name','$father_name','$cnic','$u_name','$pass','$email','','$gender','member','$phone_p','','$city','$province','$address','1','0','0','0','0','0')";
                                                                
                                $result=mysqli_query($connection,$query)or die(mysqli_error($connection));
                                
                                if($result)
                                {
                                ?>
                                        <script>
                                                window.location = "login.php";
                                        </script>
                                <?php
                                }
                                else
                                {
                                        ?>
                                        <div class="container">
                                        <div class="row">
                                                <div class="col-lg-4"></div>
                                                <div class="col-lg-4" style="background-color:red; border-radius:10px; margin-top:3%;">
                                                
                                                <div class="row">
                                                        
                                                        <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Something went wrong</div>
                                                </div>
                                                
                                                <div class="col-lg-4"></div>
                                        </div>
                                        </div>
                                        <?php
        
                                        //if username already exist and now user refresh page, then warning will disappear
//                                        $_POST['name']="";
                                }
                        }
                }

	}
}
?>

<div class="container">
    
    <form class="two_row_form" action="member_account.php" method="post">
            <div class="form-group">
                <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2"> <a href = "http://www.propertyghar.com"> <img style="width: 100%; height:105%; padding-bottom: 10%;" src="images/logo/logo_full.png" alt="PropertyGhar"> </a> </div>
                        <div class="col-md-4"></div>
                </div>
            </div>
            
            <p><span class="error">* Required field</span></p>

            <div class="row">
                    <div class="col-lg-6">
                            <label for=" ">Name<span class="error">*<?php echo $name_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="name" placeholder="Name">
                    </div>
                    <div class="col-lg-6">
                            <label for=" ">Father Name<span class="error">*<?php echo $f_name_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="fatherName" placeholder="Father Name">
                    </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-lg-6">
                            <label for=" ">CNIC #</label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="cnic" placeholder="CNIC">
                    </div>
                    <div class="col-lg-6">
                            <label for=" ">Username<span class="error">*<?php echo $u_name_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="userName" placeholder="Username">
                    </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-lg-6">
                            <label for=" ">Password<span class="error">*<?php echo $pass_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="password" class="form-control" id="password_id" name="password" placeholder="Password">
                            <input style="background-color : white; border: 1px solid silver;"  type="checkbox" onclick="togglePass()"> Show Password
                    </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-lg-6">
                            <label for=" ">Phone #<span class="error">*<?php echo $phone_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " value="" name="phone_personal" placeholder="Phone number">
                    </div>
                    <div class="col-lg-6">
                            <label for=" ">Email address</label>
                            <input style="background-color : white; border: 1px solid silver;"  type="email" class="form-control" id=" " name="email" placeholder="E-mail">
                    </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-lg-3">
                            <label for=" ">City<span class="error">*<?php echo $city_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="city" placeholder="City">
                    </div>
                    <div class="col-lg-3">
                            <label for=" ">Province<span class="error">*<?php echo $province_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="province" placeholder="Province">
                    </div>
                    <div class="col-lg-6">
                            <label for=" ">Address<span class="error">*<?php echo $address_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="address" placeholder="Address">
                    </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-lg-6">
                            <label for=" ">Gender <span class="error">*<?php echo $gender_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="radio" name="gender" value="male" checked>Male
                            <input style="background-color : white; border: 1px solid silver;"  type="radio" name="gender" value="female">Female
                    </div>
            </div>

            <br>

            <button type="submit" class="btn btn-success" name="member_account">Create Account</button>
    </form>

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

</div>
</body>
</html>
