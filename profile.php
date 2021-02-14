<?php

session_start();
if(empty($_SESSION["username"]))
{
  header("Location: login.php");
}

$connection = mysqli_connect("localhost", "root", "", "propertyghar");
//        $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Real Estate Property Advisor">

    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!--CSS FILE-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css.css" />
    <!--FONT 1-->
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
    <!--FONT 2-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <!--Font 3-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">

    <title>Profile</title>
    <style>
        .form-control:focus{border-color: #5cb85c;  box-shadow:0 0 0 .2rem rgba(255,255,255);}  /* form input active/focus color/glow   */
        .has-error .form-control:focus{box-shadow: none; -webkit-box-shadow: none;}
        table, tr, td
        {
          border:1px solid #15aa22; 
        }
        table
        {
          box-shadow:0 0 0 .2rem rgba(40,167,69,.25);
        }
    </style>
</head>


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
                        <a class="nav-link" href="add_client.php"><img style = "width:20px;" src="images/navbar/create.png" alt="add"> Create Add</a>
                    </li>

                  <?php
                }
                // else if user = dealer then directly create add/add plot or 
                else
                {
                  ?>

                    <li class="nav-item">
                        <a class="nav-link" href="add_options.php"><img style = "width:20px;" src="images/navbar/create.png" alt="add"> Create Add</a>
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

<?php

$agent_id = $_SESSION['username'];
if(!empty($_GET['id']))
  $id = $_GET['id'];
  
  if(isset($_POST['removeAdd']))
  {
    if($connection)
    {
        $query = "SELECT * FROM user WHERE Agent_ID = '$agent_id'";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_assoc($result);
        if($_SESSION['role'] != 'user')
        {
            if($_POST['type'] == 'super_hot')
            {
                    $s_hot = $row['Super_Hot'];
                    $s_hot--;
                    $no_of_post = $row['No_of_Posts'];
                    $no_of_post--;
                    $query = "UPDATE user SET Super_Hot = '$s_hot', No_of_Posts = '$no_of_post' WHERE Agent_ID = '$agent_id'";
                    $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
            }
            else if($_GET['add_type'] == 'hot')
            {
                    $hot = $row['Hot'];
                    $hot--;
                    $no_of_post = $row['No_of_Posts'];
                    $no_of_post--;
                    $query = "UPDATE user SET Hot = '$hot', No_of_Posts = '$no_of_post' WHERE Agent_ID = '$agent_id'";
                    $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
            }
            else if($_GET['add_type'] == 'normal')
            {
                    $normal = $row['Normal'];
                    $normal--;
                    $no_of_post = $row['No_of_Posts'];
                    $no_of_post--;
                    $query = "UPDATE user SET Normal = '$normal', No_of_Posts = '$no_of_post' WHERE Agent_ID = '$agent_id'";
                    $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
            }
        }
        else
        {
          $no_of_post = $row['No_of_Posts'];
          $no_of_post--;
          $query = "UPDATE user SET No_of_Posts = '$no_of_post' WHERE Agent_ID = '$agent_id'";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
          $query = "DELETE FROM plot WHERE Plot_ID = '$id'";
          $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
  
    } // if($connection)
  
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
    }
  } // if(isset($_POST['remove']))

  
  if(isset($_POST['removeReq']))
  {
    if($connection)
    {

          $query = "DELETE FROM requirement WHERE Requirement_ID = '$id'";
          $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
  
    } // if($connection)
  
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
    }
  } // if(isset($_POST['remove']))
    
?>
        <h3 style="text-align:center; font-weight:bold; margin-top:105px;">Profile</h3>
<?php
    $name = $phone_p = $phone_o = $f_name = $cnic = $email = $gender = $role = $estate = $province = $city = $address = "";

    $user_name = $_SESSION['username'];

    $query = "SELECT * FROM user where Agent_ID = '$user_name' AND Status = '1'";
    $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
    
    while($row = mysqli_fetch_assoc($result))
    {      
        $name = $row['Name'];
        $f_name = $row['Father_Name'];
        $cnic = $row['CNIC'];
        $email = $row['Email'];
        if($row['Gender'] == 'm')
            $gender = 'Male';
        else
            $gender  = 'Female';
        $role = $row['Role'];
        if($role == 'dealer')
            $estate = $row['Estate_Name'];
        if($role == 'dealer')
        {
          $phone_o = $row['Office_Phone'];
        }
        $phone_p = $row['Personal_Phone'];

        $province = $row['Province'];
        $city = $row['City'];
        $address = $row['Address'];
    }
    

?>
<div class="container">
        <div class="row">
          <div class="col-lg-1"></div>
          <div class="col-lg-10">
              <div class="container">
                  <div class="row">
                          <div class="col-lg-4">
                              Name: <?php echo $name;?>
                          </div>
                          <?php
                          if($_SESSION['role'] != 'user')
                          {
                            ?>
                          <div class="col-lg-4">
                              Father Name: <?php echo $f_name;?>
                          </div>
                          <?php
                          }
                          ?>
                          <div class="col-lg-4">
                              Personal # <?php if($phone_p != '0') echo $phone_p;?>
                          </div>
                  </div>
                  <?php 
                  if($role == 'dealer')
                  {
                    ?>
                  <div class="row">
                          <div class="col-lg-4">
                              Office # <?php echo $phone_o;?>
                          </div>
                  </div>
                  <?php
                  }
                  ?>
                  <div class="row">
                          <div class="col-lg-4">
                              Gender: <?php echo $gender ?>
                          </div>
                          <div class="col-lg-4">
                              Email: <?php echo $email ?>
                          </div>
                          <?php
                          if($_SESSION['role'] != 'user')
                          {
                            ?>
                            <div class="col-lg-4">
                                CNIC #  <?php echo $cnic ?>
                            </div>
                          <?php
                          }
                          ?>
                  </div>
                  <div class="row">
                          <div class="col-lg-4">
                              Address: <?php echo $address ?>
                          </div>
                          <div class="col-lg-4">
                              City: <?php echo $city ?>
                          </div>
                          <div class="col-lg-4">
                              Province:  <?php echo $province ?>
                          </div>
                  </div>
                  <div class="row">
                          <div class="col-lg-4">
                                <?php
                                    if(!empty($role) && $role == 'dealer')
                                    {
                                        ?>
                                             Estate: <?php echo $estate;
                                    }
                                ?>
                          </div>

                  </div>
              </div>
          </div>
          <div class="col-lg-1"></div>
        </div>
</div>

<center><hr class="hr_style" style="margin-top:5%; width:80%;"></center>

<br>

<?php
/////////////////////////////////////////////////////////
if(isset($_POST['show']))
{
  if($connection)
  {
    ?>
      <h3 style="text-align:center; font-weight:bold; margin-top:5%;"> Your Add </h3>
    <?php
      $query = "SELECT * FROM plot WHERE Plot_ID = '$id'";
      $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
    
      $row = mysqli_fetch_assoc($result);
    
      $dealer_contact = $user_contact = $price = $size = $phone = $province = $city = $address = $area = $status = $address_id = $link = $area = $lw = $road = "";
      $count2 = "0";
      $house_no = $stories = $bedroom = $kitchen = $washroom = "";
      

      $house_no = $row['House_No'];
      $stories = $row['Stories'];
      $bedroom = $row['Bedroom'];
      $kitchen = $row['Kitchen'];
      $washroom = $row['Washroom'];

          $id = $row['Plot_ID'];
          $price = $row['Demand'];
          $type = $row['Type'];
          $area = $row['Area'];
          if($row['Width'] != 0 && $row['Length'] != 0)
          {
            $lw = $row['Width'];
            $lw = $lw . ' x ' . $row['Length'] . ' Feet';
          }
          if($row['Facing_Road'] != 0)
            $road = $row['Facing_Road'] . ' Feet'; 
          
          if($type=='file')  $type = 'File';
          else if ($type=='general') $type = 'General Plot';
          else if ($type=='industrial') $type = 'Industrial Land';
          else if ($type=='agricultural') $type = 'Agricultural Land';
          else if ($type=='commercial') $type = 'Commercial Plot';
          else if ($type=='house' && $row['House_For'] == 'r') $type = 'House for Rent';
          else if ($type=='house' && $row['House_For'] == 's') $type = 'House for Sale';

          if($row['Acre'] != 0)
            $size = $size . $row['Acre'] . ' Acre, ';
          if($row['Kanal'] != 0)
            $size = $size . $row['Kanal'] . ' Kanal, ';
          if($row['Marla'] != 0)
            $size = $size . $row['Marla'] . ' Marla';

            $address = $row['Address'];
            $city = $row['City'];
            $province = $row['Province'];
            
        $query2 = "SELECT * FROM user_like WHERE Agent_ID = '$agent_id' AND Plot_ID = '$id'";
        $result2 = mysqli_query($connection, $query2);
        $count2 = mysqli_num_rows($result2);
?>
            <div class = "container">

            <?php
            if($row['Add_Type'] == 'super_hot')
            {
                if($type == 'House for Rent' || $type == 'House for Sale')
                {
                  ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%; color:blue;"> <?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/SHotFlame.png" alt=""> </h3>
                  <?php
                }
                else
                {
                ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/SHotFlame.png" alt=""> </span> </h3>
                <?php
                }
            }
            else if($row['Add_Type'] == 'hot')
            {
                if($type == 'House for Rent' || $type == 'House for Sale')
                {
                  ?>
                  <h3 style="text-align:center; font-weight:bold; margin-top:1%;color:blue;"> <?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/hotFlame.png" alt=""> </h3>
                  <?php
                }
                else
                {
                ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/hotFlame.png" alt=""> </span> </h3>
                <?php
                }
            }
            else
            {
              if($type == 'House for Rent' || $type == 'House for Sale')
              {
                ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;color:blue;"> <?php echo $area ?> </h3>
                <?php
              }
              else
              {
              ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?> </span> </h3>
              <?php
              }
            }
                                    $query5 = "SELECT * FROM user where Agent_ID = '$agent_id'";
                                    $result5 = mysqli_query($connection, $query5);
                                    $row5 = mysqli_fetch_assoc($result5);
                   // if $role = 'dealer', then show estate name
                   if($role == 'dealer')
                   {
                     ?>
                     <h2 style="text-align:center; font-weight:bold; margin-top:1%; font-size:18px;"> <?php echo $row5['Estate_Name']; ?> </h2>
                     <?php
                     
                   }
                 ?>
             <center><?php echo $size;?>, <?php echo $type ?></center>
                     <div class = "row">  <!-- Price & Type -->
                         <div class="col-lg-2">
                         <?php

                           if($role=='dealer')
                           {
                             
                             $dealer_contact = $row5['Office_Phone'];

                           }
                           else if($role=='user')
                           {
                             
                             $user_contact = $row5['Personal_Phone'];

                           }

                         ?>
                         </div>
                         <div class="col-lg-5">                
                         <?php
                           if($type == 'House for Rent')
                           {
                           ?>
                             <span style="font-weight:bold;color:blue;">Rent:</span> <?php echo 'Rs: ' . $price;?>
                           <?php
                           }
                           else if($type == 'House for Sale')
                           {
                           ?>
                             <span style="font-weight:bold;color:blue;">Price:</span> <?php echo 'Rs: ' . $price;?>
                           <?php
                           }
                           else
                           {
                             ?>
                               <span style="font-weight:bold;">Price:</span> <?php echo 'Rs: ' . $price;?>
                               <?php
                           }
                           ?>
                         </div>
                         <div class="col-lg-5">          
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">Contact # </span> 
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Contact # </span> 
                             <?php
                           }
                           if(strtolower($area) == 'lda' || strtolower($area) == 'lda city')
                           {

                             echo '0301-1036890';
                           }
                           else if($role == 'dealer')
                           {
                             echo $dealer_contact;
                           }
                           else if($role == 'user')
                             echo $user_contact;
                           else
                             echo '0301-1036890';
                         ?>
                         </div>
                     </div>

                     <div class = "row">
                         <div class="col-lg-2"></div>
                         <?php
                         if($type == 'House for Rent' || $type == 'House for Sale')
                         {
                           ?>
                           <div class="col-lg-5">
                           <span style="font-weight:bold;color:blue;">Stories:</span> 
                             <?php 
                               if($stories == "one")
                                 echo "Single";
                               else if($stories == "two")
                               echo "Double";
                               else if($stories == "three")
                                 echo "Triple";
                             ?>
                           </div>
                           <?php
                         }
                         else if($lw != "")
                         {
                         ?>
                         <div class="col-lg-5">
                         
                         <span style="font-weight:bold;">Width x Lehgth:</span> <?php echo $lw;?>

                         </div>
                         <?php
                         }
                         if($road != "")
                         {
                         ?>
                         <div class="col-lg-5">

                           <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">Facing Road:</span> <?php echo $road;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Facing Road:</span> <?php echo $road;?>
                             <?php
                           }
                           ?>
                         </div>
                         <?php
                         }
                         ?>
                     </div>
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>       
                             <div class = "row">
                               <div class="col-lg-2"></div>
                               <div class="col-lg-5">
                                 <span style="font-weight:bold;color:blue;">Bedroom:</span> <?php echo $bedroom;?>
                               </div>
                               <div class="col-lg-5">
                                 <span style="font-weight:bold;color:blue;">Kitchen:</span> <?php echo $kitchen;?>
                               </div>
                             </div> 
                             <div class = "row">
                               <div class="col-lg-2"></div>
                               <div class="col-lg-5">
                                 <span style="font-weight:bold;color:blue;">Attached Washroom:</span> <?php echo $washroom;?>
                               </div>
                             </div>
                             <?php
                           }
                         ?>

                     <div class = "row">
                         <div class="col-lg-2"></div>
                         <div class="col-lg-5">
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">City:</span> <?php echo $city;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">City:</span> <?php echo $city;?>
                             <?php
                           }
                           ?>
                         </div>
                         <div class="col-lg-5">
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                         <span style="font-weight:bold;color:blue;">Province:</span> <?php echo $province;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Province:</span> <?php echo $province;?>
                             <?php
                           }
                           ?>
                         </div>
                     </div>

                     <div class = "row">
                         <div class="col-lg-2"></div>
                         <div class="col-lg-10">
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">Addressss:</span> <?php echo $address;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Addressss:</span> <?php echo $address;?>
                             <?php
                           }
                           ?>
                         </div>
                     </div>
                     
                     <div class = "row">
                     <?php
                     if(!empty($_SESSION['username']))
                     {
                         if($count2 == 0)
                         {
                           ?>
                           <div class="col-lg-12">
                           <center> <a href="add_like.php?page=prof&id=1&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $id ?>"><img src="images/adds/like.png" alt="like it" title = "like it"></a> </center>
                           </div>
                           <?php
                         }
                         else
                         {
                           ?>
                           <div class="col-lg-12">
                           <center> <a href="add_like.php?page=prof&id=2&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $id ?>"><img src="images/adds/liked.png" alt="liked" title = "liked"></a> </center>
                           </div>
                           <?php
                         }
                       }
                       else
                       {
                         
                         ?>
                         <div class="col-lg-12">
                         <center> <a href="login.php"><img src="images/adds/like.png" alt="like it" title = "like it"></a> </center>
                         </div>
                         <?php
                       }
                         ?>
                     </div>

                     <center><span style="font-weight:bold;"></span> <a href="<?php echo $link;?>"><img style="width:30px; height:22px;" src="images/adds/youtube.png" alt="Link"> Click here to watch video</a></center>
                 <hr class="hr_style" style="margin-top:5%;">
                       <br>
               </div>
               <?php
   
  } // if($connection)

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
  }
}
?>

<h3 style="text-align:center; font-weight:bold; margin-top:5%;"> Plots </h3>
<br>

<?php

  if($connection)
  {
      echo "<div class='container'>";
        echo "<div class='table-responsive'>"; 
            echo "<center>";
              echo '<table style="width:90%;" calss = "table table-hover table-bordered">';
                echo '<thead class="thead-light">';
                echo "<tr>";
                    echo "<th class='pr-5'>";
                        echo "Plot ID";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Demand";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Size";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Area";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "City";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Likes";
                    echo "</th>";
                    if($_SESSION['role'] != 'user')
                    {
                      echo "<th class='pr-5'>";
                          echo "Add Type";
                      echo "</th>";
                    }
                    echo "<th style='width:40%;' class='pr-5'>";
                        echo "Comment";
                    echo "</th>";
                    if($_SESSION['role'] != 'member')
                    {
                      echo "<th class='pr-5'>";
                          echo "Action";
                      echo "</th>";
                    }
                    echo "<th class='pr-5'>";
                        echo "Add";
                    echo "</th>";
                echo "</tr>";
                echo "</thead>";

            $query = "SELECT * FROM plot where Agent_ID = '$user_name' AND Status = '1'";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<tbody>";
              echo "<tr>";
                  echo "<td class='pl-2'>";
                      echo $row['Plot_ID'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['Demand'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                  $size = "";
                  if($row['Acre'] != 0)
                    $size = $size . $row['Acre'] . ' Acre, ';
                  if($row['Kanal'] != 0)
                    $size = $size . $row['Kanal'] . ' Kanal, ';
                  if($row['Marla'] != 0)
                    $size = $size . $row['Marla'] . ' Marla';
                      echo $size;
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['Area'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['City'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['Likes'];
                  echo "</td>";
                  if($_SESSION['role'] != 'user')
                  {
                    echo "<td class='pl-2'>";
                        echo $row['Add_Type'];
                    echo "</td>";
                  }
                  echo "<td class='pl-2'>";
                      echo $row['Comment'];
                  echo "</td>";
                  if($_SESSION['role'] != 'member')
                  {
                    echo "<td class='pl-2' style='height:45px;' >";
                        ?>
                          <form action="profile.php?id=<?php echo $row['Plot_ID'];?>&add_type=<?php echo $row['Add_Type'];?>" method="post">
                              <button type="submit" class="btn-sm btn-danger" name="removeAdd" style="border-radius:10%;"> Remove </button>
                          </form>
                        <?php
                    echo "</td>";
                  }
                  echo "<td class='pl-2' style='height:45px;' >";
                      ?>
                        <form action="profile.php?id=<?php echo $row['Plot_ID'];?>&add_type=<?php echo $row['Add_Type'];?>" method="post">
                            <button type="submit" class="btn-sm btn-success" name="show" style="border-radius:10%;"> Show </button>
                        </form>
                      <?php
                  echo "</td>";
              echo "</tr>";   
              echo "</tbody>";
            }
        }
          echo "</table>";
        echo "</center>";
      echo "</div>";
    echo "</div>";
?>


<h3 style="text-align:center; font-weight:bold; margin-top:5%;"> Requirements </h3>
<br>

<?php

  if($connection)
  {
      echo "<div class='container'>";
        echo "<div class='table-responsive'>"; 
            echo "<center>";
              echo '<table style="width:90%;" calss = "table table-hover table-bordered">';
                echo '<thead class="thead-light">';
                echo "<tr>";
                    echo "<th class='pr-5'>";
                        echo "Requirement ID";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Min Range";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Max Range";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Size";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Area";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "City";
                    echo "</th>";
                    echo "<th style='width:40%;' class='pr-5'>";
                        echo "Comment";
                    echo "</th>";
                    if($_SESSION['role'] != 'member')
                    {
                      echo "<th class='pr-5'>";
                          echo "Action";
                      echo "</th>";
                    }
                echo "</tr>";
                echo "</thead>";

            $query = "SELECT * FROM requirement where Agent_ID = '$user_name' AND Status = '1'";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<tbody>";
              echo "<tr>";
                  echo "<td class='pl-2'>";
                      echo $row['Requirement_ID'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['Min_Range'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['Max_Range'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                  $size = "";
                  if($row['Acre'] != 0)
                    $size = $size . $row['Acre'] . ' Acre, ';
                  if($row['Kanal'] != 0)
                    $size = $size . $row['Kanal'] . ' Kanal, ';
                  if($row['Marla'] != 0)
                    $size = $size . $row['Marla'] . ' Marla';
                      echo $size;
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['Area'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['City'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                      echo $row['Comment'];
                  echo "</td>";
                    echo "<td class='pl-2' style='height:45px;' >";
                        ?>
                          <form action="profile.php?id=<?php echo $row['Requirement_ID'];?>" method="post">
                              <button type="submit" class="btn-sm btn-danger" name="removeReq" style="border-radius:10%;"> Remove </button>
                          </form>
                        <?php
                    echo "</td>";
              echo "</tr>";   
              echo "</tbody>";
            }
        }
          echo "</table>";
        echo "</center>";
      echo "</div>";
    echo "</div>";
?>



<hr class="hr_style" style="margin-top:5%;">
<h3 style="text-align:center; font-weight:bold; margin-top:105px;">Favourite Adds</h3>

    <!-- Featured adds -->
    <?php
        
        $user_id = $_SESSION['username'];
        $dealer_contact = $user_contact = $agent_id = $role = $price = $plot_id = $size = $phone = $province = $city = $address = $area = $status = $address_id = $link = $area = $lw = $road = "";
        $house_no = $stories = $bedroom = $kitchen = $washroom = "";
        $count = $count3 = "0";
          
        $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' ORDER BY Date DESC";
        $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        while($row = mysqli_fetch_assoc($result))
        {
          

          $house_no = $row['House_No'];
          $stories = $row['Stories'];
          $bedroom = $row['Bedroom'];
          $kitchen = $row['Kitchen'];
          $washroom = $row['Washroom'];

          $plot_id = $row['Plot_ID'];
          $agent_id = $row['Agent_ID'];


          $query6 = "SELECT * FROM user_like WHERE Agent_ID = '$user_id' AND Plot_ID = '$plot_id'";
          $result6 = mysqli_query($connection, $query6)or die(mysqli_error($connection));
          $count = mysqli_num_rows($result6);
          
          $plot_id = $row['Plot_ID'];
          $price = $row['Demand'];
          $type = $row['Type'];
          $area = $row['Area'];
          
                
          if($type=='file')  $type = 'File';
          else if ($type=='general') $type = 'General Plot';
          else if ($type=='industrial') $type = 'Industrial Land';
          else if ($type=='agricultural') $type = 'Agricultural Land';
          else if ($type=='commercial') $type = 'Commercial Plot';
          else if ($type=='house' && $row['House_For'] == 'r') $type = 'House for Rent';
          else if ($type=='house' && $row['House_For'] == 's') $type = 'House for Sale';

          if($count != '0')
          {
                
            if($row['Add_Type'] == 'super_hot')
            {
                if($type == 'House for Rent' || $type == 'House for Sale')
                {
                  ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%; color:blue;"> <?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/SHotFlame.png" alt=""> </h3>
                  <?php
                }
                else
                {
                ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/SHotFlame.png" alt=""> </span> </h3>
                <?php
                }
            }
            else if($row['Add_Type'] == 'hot')
            {
                if($type == 'House for Rent' || $type == 'House for Sale')
                {
                  ?>
                  <h3 style="text-align:center; font-weight:bold; margin-top:1%;color:blue;"> <?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/hotFlame.png" alt=""> </h3>
                  <?php
                }
                else
                {
                ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/hotFlame.png" alt=""> </span> </h3>
                <?php
                }
            }
            else
            {
              if($type == 'House for Rent' || $type == 'House for Sale')
              {
                ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;color:blue;"> <?php echo $area ?> </h3>
                <?php
              }
              else
              {
              ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?> </span> </h3>
              <?php
              }
            }
                
                if($row['Width'] != 0 && $row['Length'] != 0)
                {
                  $lw = $row['Width'];
                  $lw = $lw . ' x ' . $row['Length'] . ' Feet';
                }
                if($row['Facing_Road'] != 0)
                  $road = $row['Facing_Road'] . ' Feet'; 

                if($row['Acre'] != 0)
                  $size = $size . $row['Acre'] . ' Acre, ';
                if($row['Kanal'] != 0)
                  $size = $size . $row['Kanal'] . ' Kanal, ';
                if($row['Marla'] != 0)
                  $size = $size . $row['Marla'] . ' Marla';

                  $address = $row['Address'];
                  $city = $row['City'];
                  $province = $row['Province'];

                  $query2 = "SELECT * FROM user_like WHERE Agent_ID = '$agent_id' AND Plot_ID = '$plot_id'";
                  $result2 = mysqli_query($connection, $query2);
                  $count3 = mysqli_num_rows($result2);
    ?>
                  <div class = "container">


                  <?php
                                          $query5 = "SELECT * FROM user where Agent_ID = '$agent_id'";
                                          $result5 = mysqli_query($connection, $query5);
                                          $row5 = mysqli_fetch_assoc($result5);
                                          $role = $row5['Role'];
                   // if $role = 'dealer', then show estate name
                   if($role == 'dealer')
                   {
                     ?>
                     <h2 style="text-align:center; font-weight:bold; margin-top:1%; font-size:18px;"> <?php echo $row5['Estate_Name']; ?> </h2>
                     <?php
                     
                   }
                 ?>
             <center><?php echo $size;?>, <?php echo $type ?></center>
                     <div class = "row">  <!-- Price & Type -->
                         <div class="col-lg-2">
                         <?php

                           if($role=='dealer')
                           {
                             
                             $dealer_contact = $row5['Office_Phone'];

                           }
                           else if($role=='user')
                           {
                             
                             $user_contact = $row5['Personal_Phone'];

                           }

                         ?>
                         </div>
                         <div class="col-lg-5">                
                         <?php
                           if($type == 'House for Rent')
                           {
                           ?>
                             <span style="font-weight:bold;color:blue;">Rent:</span> <?php echo 'Rs: ' . $price;?>
                           <?php
                           }
                           else if($type == 'House for Sale')
                           {
                           ?>
                             <span style="font-weight:bold;color:blue;">Price:</span> <?php echo 'Rs: ' . $price;?>
                           <?php
                           }
                           else
                           {
                             ?>
                               <span style="font-weight:bold;">Price:</span> <?php echo 'Rs: ' . $price;?>
                               <?php
                           }
                           ?>
                         </div>
                         <div class="col-lg-5">          
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">Contact # </span> 
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Contact # </span> 
                             <?php
                           }
                           if(strtolower($area) == 'lda' || strtolower($area) == 'lda city')
                           {

                             echo '0301-1036890';
                           }
                           else if($role == 'dealer')
                           {
                             echo $dealer_contact;
                           }
                           else if($role == 'user')
                             echo $user_contact;
                           else
                             echo '0301-1036890';
                         ?>
                         </div>
                     </div>

                     <div class = "row">
                         <div class="col-lg-2"></div>
                         <?php
                         if($type == 'House for Rent' || $type == 'House for Sale')
                         {
                           ?>
                           <div class="col-lg-5">
                           <span style="font-weight:bold;color:blue;">Stories:</span> 
                             <?php 
                               if($stories == "one")
                                 echo "Single";
                               else if($stories == "two")
                               echo "Double";
                               else if($stories == "three")
                                 echo "Triple";
                             ?>
                           </div>
                           <?php
                         }
                         else if($lw != "")
                         {
                         ?>
                         <div class="col-lg-5">
                         
                         <span style="font-weight:bold;">Width x Lehgth:</span> <?php echo $lw;?>

                         </div>
                         <?php
                         }
                         if($road != "")
                         {
                         ?>
                         <div class="col-lg-5">

                           <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">Facing Road:</span> <?php echo $road;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Facing Road:</span> <?php echo $road;?>
                             <?php
                           }
                           ?>
                         </div>
                         <?php
                         }
                         ?>
                     </div>
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>       
                             <div class = "row">
                               <div class="col-lg-2"></div>
                               <div class="col-lg-5">
                                 <span style="font-weight:bold;color:blue;">Bedroom:</span> <?php echo $bedroom;?>
                               </div>
                               <div class="col-lg-5">
                                 <span style="font-weight:bold;color:blue;">Kitchen:</span> <?php echo $kitchen;?>
                               </div>
                             </div> 
                             <div class = "row">
                               <div class="col-lg-2"></div>
                               <div class="col-lg-5">
                                 <span style="font-weight:bold;color:blue;">Attached Washroom:</span> <?php echo $washroom;?>
                               </div>
                             </div>
                             <?php
                           }
                         ?>

                     <div class = "row">
                         <div class="col-lg-2"></div>
                         <div class="col-lg-5">
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">City:</span> <?php echo $city;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">City:</span> <?php echo $city;?>
                             <?php
                           }
                           ?>
                         </div>
                         <div class="col-lg-5">
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                         <span style="font-weight:bold;color:blue;">Province:</span> <?php echo $province;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Province:</span> <?php echo $province;?>
                             <?php
                           }
                           ?>
                         </div>
                     </div>

                     <div class = "row">
                         <div class="col-lg-2"></div>
                         <div class="col-lg-10">
                         <?php
                           if($type == 'House for Rent' || $type == 'House for Sale')
                           {
                             ?>
                             <span style="font-weight:bold;color:blue;">Addressss:</span> <?php echo $address;?>
                             <?php
                           }
                           else
                           {
                             ?>
                             <span style="font-weight:bold;">Addressss:</span> <?php echo $address;?>
                             <?php
                           }
                           ?>
                         </div>
                     </div>
                     
                     <div class = "row">
                     <?php
                     if(!empty($_SESSION['username']))
                     {
                         if($count == 0)
                         {
                           ?>
                           <div class="col-lg-12">
                           <center> <a href="add_like.php?page=prof&id=1&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/like.png" alt="like it" title = "like it"></a> </center>
                           </div>
                           <?php
                         }
                         else
                         {
                           ?>
                           <div class="col-lg-12">
                           <center> <a href="add_like.php?page=prof&id=2&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/liked.png" alt="liked" title = "liked"></a> </center>
                           </div>
                           <?php
                         }
                       }
                       else
                       {
                         
                         ?>
                         <div class="col-lg-12">
                         <center> <a href="login.php"><img src="images/adds/like.png" alt="like it" title = "like it"></a> </center>
                         </div>
                         <?php
                       }
                         ?>
                     </div>

                     <center><span style="font-weight:bold;"></span> <a href="<?php echo $link;?>"><img style="width:30px; height:22px;" src="images/adds/youtube.png" alt="Link"> Click here to watch video</a></center>
                 <hr class="hr_style" style="margin-top:5%;">
                       <br>
               </div>
               <?php
           } // End of if($row['Add_Type'] == 'super_hot')
       } // End of While Loop
       ?>


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

<script src="js/jquery/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- <script src="js/script.js"></script> -->

</body>
</html>