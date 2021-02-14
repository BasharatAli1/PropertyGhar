<?php

session_start();
if(empty($_SESSION["username"]))
{
  header("Location: login.php");
}  
if(empty($_GET["type"]))
{
  header("Location: index.php");
}
$agent_id = $_SESSION['username'];
$role = $_SESSION['role'];

$num = 0;
$normal = $hot = $s_hot = $no_of_post = "";
$bool_normal = $bool_hot = $bool_s_hot = true;

$connection = mysqli_connect("localhost", "root", "", "propertyghar");
//  $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");

// Admin can post unlimited adds (all types)
// Dealer and member can post 30 add (including 6 super hot & 9 hot adds)
// Office member can post unlimited adds (including 6 super hot & 9 hot adds)
// Common user can post 2 adds

if($role == 'dealer' || $role == 'member' || $role == 'office')
{
        $query = "SELECT * FROM user WHERE Agent_ID = '$agent_id'";
        $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        $row = mysqli_fetch_assoc($result);
        if($_SESSION['role'] != 'office' && $row['No_of_Posts'] >= 30)
        {
                ?>
                <script>
                        window.location = "pop_up.php?id=add_limit_exceed";
                </script>
                <?php
        }
        else
        {
                $normal = $row['Normal'];
                $hot = $row['Hot'];
                $s_hot = $row['Super_Hot'];
                $no_of_post = $row['No_of_Posts'];

                if($_SESSION['role'] != 'office' && $normal >= 15)
                        $bool_normal = false;
                        
                if($hot >= 9)
                        $bool_hot = false;
                
                if($s_hot >= 6)
                        $bool_s_hot = false;
        }
        
}

else if($role == 'user')
{
        $query = "SELECT No_of_Posts FROM user WHERE Agent_ID = '$agent_id'";
        $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        $row = mysqli_fetch_assoc($result);
        $num = $row['No_of_Posts'];
        if($num >= 2)
        {
           ?>
           <script>
                   window.location = "pop_up.php?id=add_limit_exceed";
           </script>
           <?php
        }
}

// if(empty($_GET['type']))
// {
//   header("Location: add_customer.php");
// }

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
<script src="js/jquery/jquery.js"></script>

    <title>Create Add</title>

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

// define variables and set to empty values
$everyThingOK = true;
$type = $_GET['type'];
$count = 0;
$agent_user_name = $plot_id = $address_id = $marla = $road = $kanal = $acre = $length = $width = $demand = $link = $add_type = "";
$house_no = $stories = $bedroom = $kitchen = $washroom = $house_for = "";
$size_err = $demand_err  = $city_err = $province_err  = $address_err = $area_err = $link_err = $sale_pur_err = $comment_err = $phone_err  = "";
if(isset($_POST["add_plot"]))
{
     if($connection)
      {
             $agent_user_name = $_SESSION["username"];
        //      $query = "SELECT No_of_Posts FROM user WHERE Agent_ID = '$agent_user_name'";
        //      $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        //      $row = mysqli_fetch_assoc($result);

                if($_GET['type'] == 'general' || $_GET['type'] == 'commercial')
                {
                        if(empty($_POST['marla_gen_comm']) && empty($_POST['kanal_gen_comm']))
                        {
                                $size_err = " Required";
                                $everyThingOK = false;
                        }
                        $marla = $_POST['marla_gen_comm'];
                        $kanal = $_POST['kanal_gen_comm'];
                        $width = $_POST['w_gen_comm'];
                        $length = $_POST['l_gen_comm'];
                        $road = $_POST['facing_road'];

                }
                else if($_GET['type'] == 'file')
                {
                        if(empty($_POST['marla_file']) && empty($_POST['kanal_file']))
                        {
                                $size_err = " Required";
                                $everyThingOK = false;
                        }
                        $marla = $_POST['marla_file'];
                        $kanal = $_POST['kanal_file'];
                }
                else if($_GET['type'] == 'house')
                {
                        if(empty($_POST['marla_house']) && empty($_POST['kanal_house']))
                        {
                                $size_err = " Required";
                                $everyThingOK = false;
                        }
                        $marla = $_POST['marla_house'];
                        $kanal = $_POST['kanal_house'];
                        $road = $_POST['facing_road'];
                }
                else if($_GET['type'] == 'industrial' || $_GET['type'] == 'agricultural')
                {
                        if(empty($_POST['marla_ind_agr']) && empty($_POST['kanal_ind_agr']) && empty($_POST['acre_ind_agr']))
                        {
                                $size_err = " Required";
                                $everyThingOK = false;
                        }
                        $marla = $_POST['marla_ind_agr'];
                        $kanal = $_POST['kanal_ind_agr'];
                        $acre = $_POST['kanal_ind_agr'];
                        $width = $_POST['w_ind_agr'];
                        $length = $_POST['l_ind_agr'];
                        $road = $_POST['facing_road'];
                }
                

                if ($_SESSION['role'] != 'user' && $_SESSION['role'] != 'dealer' && strlen($_POST["phone"]) < 10)
                {
                        $phone_err=" uncomplete number";
                        $everyThingOK = false;
                }
                if (empty($_POST["demand"]))
                {
                        $demand_err=" Required";
                        $everyThingOK = false;
                }
                if (empty($_POST["city"]))
                {
                        $city_err=" Required";
                        $everyThingOK = false;
                }
                if (empty($_POST["province"]))
                {
                        $province_err=" Required";
                        $everyThingOK = false;
                }
                if (empty($_POST["address"]))
                {
                        $address_err=" Required";
                        $everyThingOK = false;
                }
                if (empty($_POST["area"]))
                {
                        $area_err=" Required";
                        $everyThingOK = false;
                }
                if ($_SESSION['role']!='dealer' && empty($_POST["comment"]))
                {
                        $comment_err=" Required";
                        $everyThingOK = false;
                }
                if ($_GET['type']!='file' && empty($_POST["link"]))
                {
                        $link_err=" Required";
                        $everyThingOK = false;
                }

                
                if (!$everyThingOK)
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

                // if fields are not empty, then we go further ($everyThingOK = true), else not
                if($everyThingOK)
                {
                        
                        $demand=$_POST['demand'];
                        if($_SESSION['role'] != 'user' && $_SESSION['role'] != 'dealer')
                            $client_phone=$_POST['phone'];
                        $city=$_POST['city'];
                        $province=$_POST['province'];
                        $address=$_POST['address'];
                        $area=$_POST['area'];
                        $link=$_POST['link'];
                        $comment=$_POST['comment'];
                        $house_no = $_POST['house_no'];
                        $stories = $_POST['stories'];
                        $bedroom = $_POST['bedroom'];
                        $kitchen = $_POST['kitchen'];
                        $washroom = $_POST['washroom'];
                        
                        if($_POST['stories'] == 'one')
                                $stories = 'one';
                        else if($_POST['stories'] == 'two')
                                $stories = 'two';
                        else if($_POST['stories'] == 'three')
                                $stories = 'three';
                        else if($_POST['stories'] == 'four')
                                $stories = 'four';

                        if($_POST['house_type'] == 'sale')
                                $house_for = 's';
                        else if($_POST['house_type'] == 'rent')
                                $house_for = 'r';


                        if($role == 'user')
                        {
                                $add_type = 'normal';
                        }
                        else
                        {
                                if($_POST['add_type'] == 'super_hot')
                                {
                                        $add_type = 'super_hot';
                                }
                                else if($_POST['add_type'] == 'hot')
                                {
                                        $add_type = 'hot';
                                }
                                else if($_POST['add_type'] == 'normal')
                                {
                                        $add_type = 'normal';
                                }
                        }

                        $agent_user_name = mysqli_real_escape_string($connection, $agent_user_name);
                        $marla = mysqli_real_escape_string($connection, $marla);
                        $kanal = mysqli_real_escape_string($connection, $kanal);
                        $acre = mysqli_real_escape_string($connection, $acre);
                        $length = mysqli_real_escape_string($connection, $length);
                        $width = mysqli_real_escape_string($connection, $width);
                        $road = mysqli_real_escape_string($connection, $road);
                        $demand = mysqli_real_escape_string($connection, $demand);
                        $city = mysqli_real_escape_string($connection, $city);
                        $province = mysqli_real_escape_string($connection, $province);
                        $address = mysqli_real_escape_string($connection, $address);
                        $area = mysqli_real_escape_string($connection, $area);
                        $house_no = mysqli_real_escape_string($connection, $house_no);
                        $stories = mysqli_real_escape_string($connection, $stories);
                        $bedroom = mysqli_real_escape_string($connection, $bedroom);
                        $kitchen = mysqli_real_escape_string($connection, $kitchen);

                        if($_SESSION['role']!='user' && $_SESSION['role'] != 'dealer')
                              $client_phone = mysqli_real_escape_string($connection, $client_phone);
                        $comment = mysqli_real_escape_string($connection, $comment);

                        if($_SESSION['role'] != 'user' && $_SESSION['role'] != 'dealer')
                        {
                                $query="SELECT * FROM client WHERE Phone = '$client_phone'";
                                $result = mysqli_query($connection,$query)or die(mysqli_error($connection));;
                                $count = mysqli_num_rows($result);
                        }
                        if ($count == 0 && $_SESSION['role']!='user' && $_SESSION['role'] != 'dealer')
                        {
                                ?>
                                <script>
                                        window.location = "pop_up.php?id=clientNot_exist&cus_id=<?php echo $client_phone?>&type=<?php echo $_GET['type'];?>";
                                </script>
                                <?php
        
                                //if username already exist and now user refresh page, then warning will disappear
//                                $_POST['name']="";
                        }
                        else
                        {

                                $date = date("Y-m-d H:i:s", time());
                                $query="INSERT INTO plot(Agent_ID, Marla, Kanal, Acre, Width, Length, Facing_Road, Demand, Area, Link, Type,House_No, Stories, Bedroom, Kitchen, Washroom, House_For, Add_Type, Comment, City, Province, Address, Likes, Status, Show_Plot, Date)
                                VALUES('$agent_user_name','$marla','$kanal','$acre','$width','$length','$road','$demand','$area','$link','$type', '$house_no','$stories','$bedroom','$kitchen','$washroom','$house_for','$add_type','$comment', '$city','$province','$address','','1', '1','$date')";
                                $result=mysqli_query($connection,$query)or die(mysqli_error($connection));

                                // get current plot ID (to send to pop up)
                                $result2 = mysqli_query($connection, "SELECT * FROM plot");
                                while($row = mysqli_fetch_assoc($result2))
                                {
                                        $plot_id = $row['Plot_ID'];
                                }

                                if($_SESSION['role']!='user' && $_SESSION['role'] != 'dealer')
                                {
                                        // client_plot
                                        $query2="INSERT INTO client_plot(Client_Phone, Plot_ID) VALUES('$client_phone','$plot_id')";
                                        $result3=mysqli_query($connection,$query2)or die(mysqli_error($connection));
                                }
                                // else
                                // {
                                //         // user_plot
                                //         $query2="INSERT INTO user_plot(Agent_ID, Plot_ID) VALUES('$agent_user_name','$plot_id')";
                                //         $result3=mysqli_query($connection,$query2)or die(mysqli_error($connection));
                                // }
                                if($result)             // if operation successful
                                {
                                        if($_SESSION['role'] == 'user')
                                        {
                                                $query = "SELECT No_of_Posts FROM user WHERE Agent_ID = '$agent_user_name'";
                                                $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
                                                $row = mysqli_fetch_assoc($result);
                                                $num = $row['No_of_Posts'];
                                                $num++;
                                                                                                
                                                $query = "UPDATE user SET No_of_Posts = '$num' WHERE Agent_ID = '$agent_user_name'";
                                                $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
                                        
                                        ?>
                                                <script>
                                                        // Plot is added by agent
                                                        window.location = "pop_up.php?id=plot_id&value=<?php echo $plot_id?>&type=<?php echo $_GET['type'];?>";
                                                </script>
                                        <?php
                                        }
                                        else
                                        {
                                                if($_POST['add_type'] == 'super_hot')
                                                {
                                                        $s_hot++;
                                                        $no_of_post++;
                                                        $query = "UPDATE user SET Super_Hot = '$s_hot', No_of_Posts = '$no_of_post' WHERE Agent_ID = '$agent_id'";
                                                        $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
                                                }
                                                else if($_POST['add_type'] == 'hot')
                                                {
                                                        $hot++;
                                                        $no_of_post++;
                                                        $query = "UPDATE user SET Hot = '$hot', No_of_Posts = '$no_of_post' WHERE Agent_ID = '$agent_id'";
                                                        $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
                                                }
                                                else if($_POST['add_type'] == 'normal')
                                                {
                                                        $normal++;
                                                        $no_of_post++;
                                                        $query = "UPDATE user SET Normal = '$normal', No_of_Posts = '$no_of_post' WHERE Agent_ID = '$agent_id'";
                                                        $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
                                                }
                                                ?>
                                                <script>
                                                            // Plot is added by agent
                                                        window.location = "pop_up.php?id=plot_id&value=<?php echo $plot_id?>";
                                                </script>
                                                <?php
                                        }
                                }
                                else
                                {
                                        ?>
                                                <script>
                                                        <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Something went wrong</div>
                                                </script>
                                        <?php
                                }

                        }
                }
           
       }
}
?>

<div class="container">
    
    <form class="two_row_form" action="add_plot.php?type=<?php echo $_GET['type']?>" method="post">
            <div class="form-group">
                <div class="row">
                        <div class="col-md-5"></div>
                        <div class="col-md-2"> <a href = "http://www.propertyghar.com"> <img style="width: 100%; height:105%; padding-bottom: 10%;" src="images/logo/logo_full.png" alt="PropertyGhar"> </a> </div>
                        <div class="col-md-4"></div>
                </div>
            </div>
            
            <p><span class="error">* Required field</span></p>

            <div class="row">
                    
                    <?php
                    if($_GET['type']=='general' || $_GET['type']=='commercial')
                    {
                        ?>
                        <!-- Left Side of 1st Row -->
                            <div class="col-lg-2">
                                
                                    <label for=" "><b>Plot Area</b></label>
                            </div>

                            <div class="col-lg-2">
                                    
                                    <label for=" ">Kanal<span class="error">*<?php echo $size_err;?></span></label>
                                    <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="kanal_gen_comm" placeholder="Size">
                            </div>
                            <div class="col-lg-2">
                                    
                                    <label for=" ">Marla<span class="error">*<?php echo $size_err;?></span></label>
                                    <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="marla_gen_comm" placeholder="Size">
                            </div>
                            
                        <!-- Right Side of 1st Row -->

                        <div class="col-lg-2">
                                
                                <label for=" "><b>Plot Size</b></label>
                        </div>
                            <div class="col-lg-2">
                                    
                                    <label for=" ">Length (Feet) </label>
                                    <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="l_gen_comm" placeholder="Feet">
                            </div>
                            <div class="col-lg-2">
                                    
                                    <label for=" ">Width (Feet) </label>
                                    <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="w_gen_comm" placeholder="Feet">
                            </div>
                         <?php
                     }
                     else if($_GET['type']=='file')
                     {
                     ?>
                         <div class="col-lg-2">
                                 
                                 <label for=" "><b>File Size</b></label>
                         </div>

                         <div class="col-lg-4">
                                 
                                 <label for=" ">Kanal<span class="error">*<?php echo $size_err;?></span></label>
                                 <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="kanal_file" placeholder="Size">
                         </div>
                         <div class="col-lg-6">
                                 
                                 <label for=" ">Marla<span class="error">*<?php echo $size_err;?></span></label>
                                 <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="marla_file" placeholder="Size">
                         </div>

                      <?php
                      }
                      else if($_GET['type']=='house')
                      {
                      ?>
                          <div class="col-lg-2">
                                  
                                  <label for=" "><b>House Size</b></label>
                          </div>
 
                          <div class="col-lg-4">
                                  
                                  <label for=" ">Kanal<span class="error">*<?php echo $size_err;?></span></label>
                                  <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="kanal_house" placeholder="Size">
                          </div>
                          <div class="col-lg-6">
                                  
                                  <label for=" ">Marla<span class="error">*<?php echo $size_err;?></span></label>
                                  <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="marla_house" placeholder="Size">
                          </div>
 
                       <?php
                       }
                      else if($_GET['type']=='industrial' || $_GET['type']=='agricultural')
                      {
                          ?>
                          <!-- Left Side of 1st Row -->
                              <div class="col-lg-2">
                                      
                                 <label for=" "><b>Land Area</b></label>
                              </div>
                              <div class="col-lg-4">
                                      
                                      <label for=" ">Acre<span class="error">*<?php echo $size_err;?></span></label>
                                      <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="acre_ind_agr" placeholder="Size">
                              </div>
                                                        
                              <div class="col-lg-3">
                                      
                                      <label for=" ">Kanal<span class="error">*<?php echo $size_err;?></span></label>
                                      <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="kanal_ind_agr" placeholder="Size">
                              </div>
                              <!-- Right Side of 1st Row -->
                              <div class="col-lg-3">
                                      
                                      <label for=" ">Marla<span class="error">*<?php echo $size_err;?></span></label>
                                      <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="marla_ind_agr" placeholder="Size">
                              </div>
      
                              


                           <?php
                       }
                        ?>
            </div>
            <br>
        
        <!-- 2nd row -->
        <?php
        if($_GET['type']=='general' || $_GET['type']=='commercial')
        {
        ?>
             <div class="row">                    
                    <div class="col-lg-6">
                        <label for=" ">Facing Road (Feet) </label>
                        <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="facing_road" placeholder="Feet">
                    </div>
            </div>
            <br>
        <?php
        }
        else if($_GET['type'] == 'house')
        {
                ?>
                <div class="row">                    
                       <div class="col-lg-6">
                           <label for=" ">Facing Road (Feet) </label>
                           <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="facing_road" placeholder="Feet">
                       </div>
                        <div class="col-lg-6">
                                <label for=" ">Video Link<span class="error">*<?php echo $link_err;?></span></label>
                                <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="link" placeholder="https://">
                        </div>
                </div>
                <?php
        }
        else if($_GET['type']=='industrial' || $_GET['type']=='agricultural')
        {
        ?>
             <div class="row">                    
                    <div class="col-lg-6">
                        <label for=" ">Facing Road (Feet) </label>
                        <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="facing_road" placeholder="Feet">
                    </div>
                    
                        <!-- Right Side of 1st Row -->

                        <div class="col-lg-2">
                                
                                <label for=" "><b>Land Size</b></label>
                        </div>
                        <div class="col-lg-2">
                                      
                                <label for=" ">Length (Feet) </label>
                                <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="l_ind_agr" placeholder="Feet">
                        </div>
                        <div class="col-lg-2">
                                      
                                <label for=" ">Width (Feet) </label>
                                <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="w_ind_agr" placeholder="Feet">
                        </div>

            </div>
            <br>
        <?php
        }
        ?>
        <!-- 3rd row -->
            <div class="row">
                    <div class="col-lg-6">
                        <label for=" ">Society/Area<span class="error">*<?php echo $area_err;?></span></label>
                        <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="area" placeholder="Area Name">
                    </div>
                <?php
                  if($_GET['type']=='file')
                  {
                ?>
                    <div class="col-lg-6">
                        <label for=" ">Video Link<span class="error"></label>
                        <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="link" placeholder="https://">
                    </div>
                <?php
                  }
                  else if($_GET['type']!='house')
                  {
                ?>
                    <div class="col-lg-6">
                        <label for=" ">Video Link<span class="error">*<?php echo $link_err;?></span></label>
                        <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="link" placeholder="https://">
                    </div>
                <?php
                  }
                  else if($_GET['type'] == 'house')
                  {
                        ?>
                            <div class="col-lg-3">
                                <label for=" ">House #</label>
                                <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="house_no" placeholder="H #">
                            </div>
                            <div class="col-lg-3">
                                <label for=" ">Stories</label>
                                <br>
                                <select name="stories" id="" style="height:35px; width:100%;" class="mt-2 form-control">
                                        <option class = "mx-auto" value="one">One</option>
                                        <option value="two">Two</option>
                                        <option value="three">Three</option>
                                </select>
                            </div>
                        <?php   
                  }
                ?>
            </div>
            <br>
        <?php
        if($type=='house')
        {
        ?>
            <div class="row">
                <div class="col-lg-3">
                    <label for=" ">Bedrooms</label>
                    <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="bedroom" placeholder="Bedrooms">
                    </div>
                    <div class="col-lg-3">
                            <label for=" ">Kitchen</label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="kitchen" placeholder="Kitchen">
                    </div>
                    <div class="col-lg-3">
                            <label for=" ">Attached Washroom</label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="washroom" placeholder="Washroom">
                    </div>
                    <div class="col-lg-3">
                        <label for=" ">House for<span class="error">*</span></label>
                        <br>
                        <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="house_type" value="sale" class="mt-3" checked>Sale
                        <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="house_type" value="rent">Rent

                    </div>
            </div>
            <br>
            <?php
                }
                ?>

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
                             <label for=" ">Demand<span class="error">*<?php echo $demand_err;?></span></label>
                             <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " name="demand" placeholder="Rs:">
                    </div>
                    <div class="col-lg-6">
                    <?php
                    if($_SESSION['role']!='user' && $_SESSION['role']!='dealer')
                    {
                        if(!empty($_GET['value']))
                        {
                                    ?>
                           <label for=" ">Client ID(Phone #)<span class="error">*<?php echo $phone_err;?></span></label>
                           <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " value=<?php echo $_GET['value']; ?> name="phone" placeholder="Phone number">
                            
                                    <?php
                        }
                        else
                        {
                                    ?>
                            <label for=" ">Client ID(Phone #)<span class="error">*<?php echo $phone_err;?></span></label>
                            <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id=" " value="" name="phone" placeholder="Client ID">
                                    <?php
                        }
                    }
                    ?>
                    </div>
            </div>
            <br>
            <?php
            if($_SESSION['role'] != 'user')
            {
            ?>
                <div class = "row">
                        <div class = "col-lg-12">

                                <div class = "container">
                                        <div class="row">
                                                <div class = "col-lg-2">
                                                        <label for=" ">Add Type<span class="error">*</span></label>
                                                </div>         
                                                <div class = "col-lg-2">
                                                        <?php
                                                        if($bool_normal)
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="normal" checked>Normal Add
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="normal" id = "inActive1">Normal Add
                                                        <?php
                                                        }
                                                        ?>
                                                </div>         
                                                <div class = "col-lg-2">
                                                        <?php
                                                        if($bool_hot && !$bool_normal)
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="hot" checked>Hot Add
                                                        <?php
                                                        }
                                                        else if($bool_hot && $bool_normal)
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="hot">Hot Add
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="hot" id = "inActive2">Hot Add
                                                        <?php
                                                        }
                                                        ?>
                                                </div>         
                                                <div class = "col-lg-3">
                                                
                                                        <?php
                                                        if($bool_s_hot && !$bool_normal && !$bool_hot)
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="super_hot" checked>Super Hot Add
                                                        <?php
                                                        }
                                                        else if($bool_s_hot)
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="super_hot">Super Hot Add
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                                <input style="background-color : white; border: 1px solid silver; margin-left:3%;"  type="radio" name="add_type" value="super_hot" id = "inActive3">Super Hot Add
                                                        <?php
                                                        }
                                                        ?>
                                                </div>                        
                                        </div>                    
                                </div>  <!-- End of Add Container -->
                        </div>  <!-- End of Col for Add Container -->
                </div>  <!-- End of Row of Add Container -->
            <?php
            }
            ?>
            <br>
            <div class="row">
                    <div class="col-lg-6">
                    <?php
                    if($_SESSION['role'] =='dealer')
                    {
                            ?>
                            <label for=" "> Comment </label>
                    <?php
                    }
                    else
                    {
                            ?>
                            <label for=" ">Comment <span class="error">*<?php echo $comment_err;?></span></label>
                    <?php
                    }
                    ?>
                            <textarea class="form-control" rows="4" cols="50" name="comment"></textarea>
                    </div>
            </div>
            <br>

                <button type="submit" class="btn btn-success mb-2" name="add_plot">Create Add</button>
                <a href="http://www.propertyghar.com" class="btn btn-success mb-2" role="button" type="submit" name="exit">Exit</a>
        
    </form>


    <script>
        $(document).ready(function () {
            // it will hide "show" button at start
            $("#sale").hide();  //instead of show

            // it will toggle buttens "On Click"
            $("#purchase").click(function () {  //instead of hide
                
//                $("img").toggle();    // we can also use built in toogle function
//                $(this).toggle();    
//                $("#show").toggle();

                $("btn").hide();
                $(this).hide();
                $("#sale").show();

            });
            $("#sale").click(function () {
                $("btn").show();
                $(this).hide();
                $("#purchase").show();

            });
        });
    </script>

<script src="js/jquery/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>

<script>
function radioButtonFunc1()
{
        document.getElementById("inActive1").disabled = true;
}
  document.getElementById("inActive1").innerHTML = radioButtonFunc1();
  
</script>


<script>
function radioButtonFunc2()
{
        document.getElementById("inActive2").disabled = true;
}
  document.getElementById("inActive2").innerHTML = radioButtonFunc2();
  
</script>

<script>
function radioButtonFunc3()
{
        document.getElementById("inActive3").disabled = true;
}
  document.getElementById("inActive3").innerHTML = radioButtonFunc3();
</script>

</div>


        <!-- footer -->
<footer>

        <div class="container-fluid footer_bg pl-md-5 mt-5">
        <div class = "row pt-5">
                                    <div class="col-lg-12">
                                      <h4 class="footer_heading">Property Ghar </h4>
                                    </div>
                                </div>
                <div class="row pt-4 pb-5" style="border:0px solid red;">   <!-- Row covering whole footer-->
                          
                          <div class="col-lg-4 pt-3">
                              <div class = "container">

                                <div class = "row">
                                    <div class="col-lg-12">
                                      <img style="float:left; width:30px; height:30px; color:white;" src="images/footer/location.png" alt="location"> <p class = "pl-5">Main LDA City road, 5.No stop,Main ferozpur road Lahore </p>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-lg-12">
                                      <img style="float:left; width:30px; height:30px; color:white;" src="images/footer/call.png" alt="call"> <p class = "pl-5">+ 92 301 1036890 </p>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-lg-12">
                                      <img style="float:left; width:30px; height:30px; color:white;" src="images/footer/wa.png" alt="whatsapp"> <p class = "pl-5">+ 92 301 1036890 </p>
                                    </div>
                                </div>
                              </div> <!-- Footer 1st Col container end -->
                          </div> <!-- Footer main container 1st Col end -->

                          <div class="col-lg-4 pt-4"> <!-- Footer main container 2nd Col Start -->
                            <div class="container">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <a style="text-decoration:none;" href="https://www.facebook.com/propertyghar1/"><img style="float:left; width:30px; height:30px; color:white;" src="images/footer/fb.png" alt="Facebook" title="Facebook">  <p title="Facebook" class = "pl-5">Facebook </p> </a>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12">
                                    <a style="text-decoration:none;" href="https://www.youtube.com/channel/UCoPSQkwkIqog9o0v8nwiFbg"> <img style="float:left; width:30px; height:30px; color:white;" src="images/footer/yt.png" alt="YouTube" title = "YouTube"><p title = "YouTube" class = "pl-5">YouTube</p></a>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12">
                                  <a style="text-decoration:none;" href="https://www.instagram.com/propertyghar/"> <img style="float:left; width:30px; height:30px; color:white;" src="images/footer/ins.png" alt="Instagram" title = "Instagram"><p title = "Instagram" class = "pl-5">Instagram </p> </a>
                                  </div>
                                </div>
                            </div> <!-- Footer 2nd Col container end -->
                      </div>    <!-- Footer main container 2nd Col end -->
                      
                      <div class="col-lg-4 pt-4"> <!-- Footer main container 3rd Col Start -->
                            <div class="container">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <a style="text-decoration:none;" href="http://www.propertyghar.com"><img style="float:left; width:30px; height:30px; color:white;" src="images/footer/home.png" alt="Home" title = "Home"><p title = "Home"class = "pl-5">Home </p> </a>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12">
                                    <a style="text-decoration:none;" href="contact.php"> <img style="float:left; width:30px; height:30px; color:white;" src="images/footer/contact.png" alt="Contact" title = "Contact"><p title = "Contact" class = "pl-5">Contact</p></a>
                                  </div>
                                </div>
                                <div class="row">
                                  <div class="col-lg-12">
                                  <a style="text-decoration:none;" href="adds.php"> <img style="float:left; width:30px; height:30px; color:white;" src="images/footer/add.png" alt="Adds" title = "Adds"><p title = "Adds" class = "pl-5">Adds </p> </a>
                                  </div>
                                </div>
                            </div> <!-- Footer 2nd Col container end -->
                      </div>    <!-- Footer main container 2nd Col end -->
                      
                      
            </div>    <!-- Mian Row of Footer -->
        </div>    <!-- Mian Container of Footer -->
    
    </footer>


</body>
</html>
