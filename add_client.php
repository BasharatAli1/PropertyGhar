<?php

session_start();
if(empty($_SESSION["username"]))
{
  header("Location: login.php");
}  
else if($_SESSION["role"] == 'user' || $_SESSION["role"] == 'dealer')
{
  header("Location: login.php");
}


?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Client</title>
    <link rel="stylesheet" href="css/bootstrap/form_bootstrap.min.css">
    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!--CSS FILE-->
    <link rel="stylesheet" href="css/main.css">
    <!--FONT 1-->
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
    <!--FONT 2-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <!--Font 3-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">
    <title>PropertyGhar</title>
    <style>
        .form-control:focus{border-color: #5cb85c;  box-shadow:0 0 0 .2rem rgba(40,167,69,.25);}  /* form input active/focus color/glow   */
        .has-error .form-control:focus{box-shadow: none; -webkit-box-shadow: none;}
    </style>

<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-xl nav-bg fixed-top" style="margin-left:-10px;">
    <a class="navbar-brand" href="http://www.propertyghar.com">
        <img src="images/logo/logo.png" alt="PropertyGhar" class="logo">
    </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse"
        data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-left:-30px;">
        <ul class="navbar-nav">
              <li class="nav-item mx-auto">
                  <a style="font-size:18px;" class="nav-link" href="http://www.propertyghar.com"> <img style = "width:20px;" src="images/navbar/home.png" alt="home"> Home </a>
              </li>
              <li class="nav-item">
                  <a style="font-size:18px;" class="nav-link" href="adds.php"> <img style = "width:20px;" src="images/navbar/add.png" alt="adds"> Adds </a>
              </li>
              <?php
                if(!empty($_SESSION["role"]) && $_SESSION["role"] !='user')
                {
                  ?>
              <li class="nav-item">
                  <a style="font-size:18px;" class="nav-link" href="requirement.php"> <img style = "width:20px;" src="images/navbar/requirement.png" alt="adds"> Requirement </a>
              </li>
              <?php
              }
                ?>
              
                <?php
                // if user is any one of the following, then add client first
                if(!empty($_SESSION["role"]) && ($_SESSION["role"] =='admin' || $_SESSION["role"] =='member' || $_SESSION["role"] =='office'))
                {
                  ?>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="add_client.php"><img style = "width:20px;" src="images/navbar/create.png" alt="add"> Create Add</a>
                    </li>

                  <?php
                }
                // else if user = dealer then directly create add/add plot or 
                else
                {
                  ?>

                    <li class="nav-item">
                        <a class="nav-link active" href="add_options.php"><img style = "width:20px;" src="images/navbar/create.png" alt="add"> Create Add</a>
                    </li>
                  <?php
                }

                

            if(!empty($_SESSION["role"]))
            {
              // if user is any one of the following, then add client first
              if(!empty($_SESSION["role"]) && ($_SESSION["role"] =='admin' || $_SESSION["role"] =='member' || $_SESSION["role"] =='office'))
              {
                ?>
                  
                  <li class="nav-item">
                      <a class="nav-link" href="add_client_req.php"><img style = "width:20px;" src="images/navbar/create.png" alt="add"> Add Requirement</a>
                  </li>

                <?php
              }
              // else if user = dealer then directly create add/add plot or 
              else
              {
                ?>

                  <li class="nav-item">
                      <a class="nav-link" href="req_options.php"><img style = "width:20px;" src="images/navbar/create.png" alt="add"> Add Requirement</a>
                  </li>
                <?php
              }
            }
             ?> 
            <li class="nav-item">
                <a style="font-size:18px;" class="nav-link" href="complain.php"> <img style = "width:20px;" src="images/navbar/complain.png" alt="contact"> Complain </a>
            </li>
              <?php
                if(!empty($_SESSION["username"]) && $_SESSION["role"] == 'admin')
                {
                  ?>
                    <li>
                          <ul class="nav navbar-nav navbar-right ml-auto">  <!-- allign at right-->
                              <li class="dropdown pr-2">
                                <a href="#" class="dropdown-toggle profile_icon nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                          Data
                                </a>
                                <ul class="dropdown-menu">
                                  <li><a href="clients.php" class="profile_icon_option nav-link">Clients</a></li>
                                  <li><a href="allplots.php" class="profile_icon_option nav-link">Plots</a></li>
                                  <li><a href="requirements.php" class="profile_icon_option nav-link">Requirements</a></li>
                                  <li><a href="team.php" class="profile_icon_option nav-link">Team</a></li>
                                  <li><a href="contact_list.php" class="profile_icon_option nav-link">Contacts</a></li>
                                  <li><a href="news.php" class="profile_icon_option nav-link">Add News</a></li>
                                </ul>
                              </li>
                          </ul>
                    </li>
                  <?php
                }
                  ?>
        </ul>     <!-- Main Unordered List of nav END-->
    <?php

    //print_r($_GET);<?php

    if(!empty($_SESSION["username"]))
    {
      ?>
          <!-- ml-auto adds margin-left and margin-right: auto -->
<ul class="nav navbar-nav navbar-right ml-5">  <!-- allign at right-->

<li class="dropdown pr-2">
  <a href="#" class="dropdown-toggle profile_icon" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
    <span class="glyphicon glyphicon-user"><img style = "width:20px;" src="images/navbar/male.png" alt="user"> <?php echo $_SESSION["username"]; ?>&nbsp;
  </a>
  <ul class="dropdown-menu mr-5">
    
    <li><a href="profile.php" class="profile_icon_option nav-link"><img style = "width:20px;" src="images/navbar/male.png" alt="add">Profile</a></li>
    <li><a href="logout.php?logout=true" class="profile_icon_option nav-link"><img style = "width:20px;" src="images/navbar/logout.png" alt="add">Sign Out</a></li>
  </ul>
</li>
</ul>

      <?php
        
    }
    else
    {
      ?>
          <!-- ml-auto adds margin-left and margin-right: auto -->
<ul class="nav navbar-nav navbar-right ml-auto">  <!-- allign at right-->

  <li class="dropdown">
    <a href="login.php" class="nav-link" aria-haspopup="true" aria-expanded="false"><img style = "width:20px;" src="images/navbar/login.png" alt="add"> Login </a>
  </li>
</ul>

      <?php
    }
      ?>
    </div>
</nav>


<div  style="margin-bottom: 100px;"></div>

<?php

if(isset($_POST["exist"]))
{
?>
    <script>
        window.location = "add_options.php";
    </script>
    <?php
}

// define variables and set to empty values
$everyThingOK = true;
$name_err = $phone_err  = $gender_err  = "";
if(isset($_POST["add_customer"]))
{
        $connection = mysqli_connect("localhost", "root", "", "propertyghar");
        //$connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
        if($connection)
        {
                $agent_user_name = $_SESSION["username"];
                $cus_name=$_POST['name'];
                $cus_phone=$_POST['phone'];
                $cus_email=$_POST['email'];
                if($_POST['gender'] == 'male')
                {
                        $cus_gender = 'm';
                }
                else
                {
                        $cus_gender = 'f';
                }
                
                if (empty($_POST["name"])|| empty($_POST["phone"]) || strlen($_POST["phone"]) < 10)
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
                if (strlen($_POST["phone"]) < 10)
                        $phone_err=" uncomplete number";
                if (empty($_POST["name"]))
                        $name_err=" Required";


                // if fields are not empty, then we go further ($everyThingOK = true), else not
                if($everyThingOK)
                {
                        $count = 0;
                        $query="SELECT * FROM client WHERE Phone = '$cus_phone'";
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
                                                
                                                <div class="verifiaction_message_text col-lg-12" style="text-align:center;"><strong>Client </strong> alredy exist Against this Contact number</div></div>
                                                <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Try Again</div>
                                        </div>
                                        
                                        <div class="col-lg-4"></div>
                                </div>
                                </div>
                                <?php
        
                                //if username already exist and now user refresh page, then warning will disappear
//                                $_POST['name']="";
                        }
                        else
                        {
                                /* 
                                SQL Injection - How to Prevent it
        
                                So when we have coal miners or any type of other parentheses or any type
                                of data they're going to clean it up, called scaping sql
                                */
                                $cus_name = mysqli_real_escape_string($connection, $cus_name);
                                $cus_phone = mysqli_real_escape_string($connection, $cus_phone);
                                $cus_email = mysqli_real_escape_string($connection, $cus_email);                

                                // User
                                $date = date("Y-m-d H:i:s", time());
                                $query="INSERT INTO client(Name, Phone, Agent_ID, Email, Gender, Status, Date)
                                VALUES('$cus_name','$cus_phone','$agent_user_name','$cus_email','$cus_gender','1','$date')";
                                                
                                $result=mysqli_query($connection,$query)or die(mysqli_error($connection));

                                if($result)
                                {
                                ?>
                                        <script>
                                                window.location = "add_options.php";
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
                                        //$_POST['name']="";
                                }
                        }
                }
	}
}
?>


<div class="container">
    
    <form class="two_row_form" action="add_client.php" method="post">
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
                            <label for=" ">Customer Name <span class="error">*<?php echo $name_err;?></span> </label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="name" placeholder="Customer Name">
                    </div>
                    <div class="col-lg-6">
                            <label for=" ">Customer's Contact # <span class="error">*<?php echo $phone_err;?></span> </label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " value="" name="phone" placeholder="Customer's Contact">
                    </div>
            </div>
            <br>
            <div class="row">
                    <div class="col-lg-6">
                            <label for=" ">Customer's Email address</label>
                            <input style="background-color : white; border: 1px solid silver;"  type="email" class="form-control" id=" " name="email" placeholder="E-mail">
                    </div>
                    <div class="col-lg-6">
                            <label for=" ">Customer's Gender <span class="error">*<?php echo $gender_err;?></span> </label>
                            <br>
                            <input style="background-color : white; border: 1px solid silver;"  type="radio" name="gender" value="male" checked>Male
                            <input style="background-color : white; border: 1px solid silver;"  type="radio" name="gender" value="female">Female
                    </div>
            </div>

            <br>

            <button type="submit" class="btn btn-success mb-2" name="add_customer">Add Customer</button>
            <button type="submit" class="btn btn-success mb-2" name="exist">Already Exist</button>
            <a href="http://www.propertyghar.com" class="btn btn-success mb-2" role="button" type="submit" name="exit">Exit</a>
    </form>
</div>

<script src="js/jquery/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- <script src="js/script.js"></script> -->

</body>
</html>
