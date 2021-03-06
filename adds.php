<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "propertyghar");
//  $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
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

    <title>Adds</title>
    <style>
        .form-control:focus{border-color: #5cb85c;  box-shadow:0 0 0 .2rem rgba(255,255,255);}  /* form input active/focus color/glow   */
        .has-error .form-control:focus{box-shadow: none; -webkit-box-shadow: none;}
        table, tr, td
        {
          border:1px solid #15aa22; 
          padding: 5px;
        }
        table
        {
          box-shadow:0 0 0 .2rem rgba(40,167,69,.25);
          font-size: 18px;
        }
        table tr.header, table tr:hover {
          background-color: #f1f1f1;
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
                  <a style="font-size:18px;" class="nav-link active" href="adds.php"> <img style = "width:20px;" src="images/navbar/add.png" alt="adds"> Adds </a>
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


<div  style="margin-bottom: 120px;"></div>

<?php

$s_city = $s_area = "";

if(isset($_POST['search']))
{
  $s_city = $_POST['city'];
  $s_area = $_POST['area'];
}

?>
<div style="font-family:Roboto; font-size:18px;">

<form action="adds.php" method="post">

<div class = "container">
  <div class = "row">
    <div class="col-lg-2">
      <input style="background-color : white; border: 1px solid silver; height:10px;" type="text" name = "area" placeholder="Society Name">
    </div>  
    <div class="col-lg-2">
      <input style="background-color : white; border: 1px solid silver; height:10px;" type="text" name = "city" placeholder="City Name">
    </div>  
    <div class = "col-lg-1">
      <button type="submit" class="btn btn-success" name="search">Search</button>
    </div>
  </div>
</div>

</form>

<br>


    <!-- Super Hot Add -->
        <?php
        
        $dealer_contact = $user_contact = $agent_id = $role = $price = $plot_id = $size = $phone = $province = $city = $address = $area = $status = $address_id = $link = $area = $lw = $road = "";
        $house_no = $stories = $bedroom = $kitchen = $washroom = "";
        $count = "0";
          
        if($s_area != "" && $s_city == "")
        {
    //      $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND Area = '$s_area' ORDER BY Date DESC";
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND Area LIKE '%{$s_area}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else if($s_city != "" && $s_area == "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND City LIKE '%{$s_city}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else if($s_area != "" && $s_city != "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND Area LIKE '%{$s_area}%' AND City LIKE '%{$s_city}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        while($row = mysqli_fetch_assoc($result))
        {
          $plot_id = $row['Plot_ID'];
          $agent_id = $row['Agent_ID'];

          $house_no = $row['House_No'];
          $stories = $row['Stories'];
          $bedroom = $row['Bedroom'];
          $kitchen = $row['Kitchen'];
          $washroom = $row['Washroom'];

            if($row['Add_Type'] == 'super_hot')
            {
                $plot_id = $row['Plot_ID'];
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

                  $query2 = "SELECT * FROM user_like WHERE Agent_ID = '$agent_id' AND Plot_ID = '$plot_id'";
                  $result2 = mysqli_query($connection, $query2);
                  $count = mysqli_num_rows($result2);
    ?>
                  <div class = "container">
                <?php
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
                            <center> <a href="add_like.php?page=add&id=1&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/like.png" alt="like it" title = "like it"></a> </center>
                            </div>
                            <?php
                          }
                          else
                          {
                            ?>
                            <div class="col-lg-12">
                            <center> <a href="add_like.php?page=add&id=2&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/liked.png" alt="liked" title = "liked"></a> </center>
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

                  

    <!-- Hot Add -->
    <?php
        if($s_area != "" && $s_city == "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND Area LIKE '%{$s_area}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else if($s_city != "" && $s_area == "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND City LIKE '%{$s_city}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else if($s_area != "" && $s_city != "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND Area LIKE '%{$s_area}%' AND City LIKE '%{$s_city}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        while($row = mysqli_fetch_assoc($result))
        {

          $dealer_contact = $user_contact = $agent_id = $role = $price = $plot_id = $size = $phone = $province = $city = $address = $area = $status = $address_id = $link = $area = $lw = $road = "";
          $house_no = $stories = $bedroom = $kitchen = $washroom = "";

          $plot_id = $row['Plot_ID'];
          $agent_id = $row['Agent_ID'];
          
          if($row['Add_Type'] == 'hot')
            {
              

          $house_no = $row['House_No'];
          $stories = $row['Stories'];
          $bedroom = $row['Bedroom'];
          $kitchen = $row['Kitchen'];
          $washroom = $row['Washroom'];
                $plot_id = $row['Plot_ID'];
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
                  
                  $query2 = "SELECT * FROM user_like WHERE Agent_ID = '$agent_id' AND Plot_ID = '$plot_id'";
                  $result2 = mysqli_query($connection, $query2);
                  $count = mysqli_num_rows($result2);

    ?>
                  <div class = "container">
                  <?php
                if($type == 'House for Rent' || $type == 'House for Sale')
                {
                  ?>
                  <h3 style="text-align:center; font-weight:bold; margin-top:1%;color:blue;"> <?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/hotFlame.png" alt=""> </h3>
                  <?php
                }
                else
                {
                ?>
                <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?> <img style="width:25px; height:30px;" src="images/flame/hotFlame.png" alt=""> </span> </h3>                  <?php
                }
                ?>

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
                            <center> <a href="add_like.php?page=add&id=1&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/like.png" alt="like it" title = "like it"></a> </center>
                            </div>
                            <?php
                          }
                          else
                          {
                            ?>
                            <div class="col-lg-12">
                            <center> <a href="add_like.php?page=add&id=2&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/liked.png" alt="liked" title = "liked"></a> </center>
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



    <!-- Normal Add -->
    <?php
if($s_area != "" && $s_city == "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND Area LIKE '%{$s_area}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else if($s_city != "" && $s_area == "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND City LIKE '%{$s_city}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else if($s_area != "" && $s_city != "")
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' AND Area LIKE '%{$s_area}%' AND City LIKE '%{$s_city}%' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        else
        {
          $query = "SELECT * FROM plot WHERE Status = '1' AND Show_Plot = '1' ORDER BY Date DESC";
          $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
        }
        while($row = mysqli_fetch_assoc($result))
        {

          $dealer_contact = $user_contact = $agent_id = $role = $price = $plot_id = $size = $phone = $province = $city = $address = $area = $status = $address_id = $link = $area = $lw = $road = "";
          $house_no = $stories = $bedroom = $kitchen = $washroom = "";

          $plot_id = $row['Plot_ID'];
          $agent_id = $row['Agent_ID'];
            
          if($row['Add_Type'] == 'normal')
            {
              

          $house_no = $row['House_No'];
          $stories = $row['Stories'];
          $bedroom = $row['Bedroom'];
          $kitchen = $row['Kitchen'];
          $washroom = $row['Washroom'];
              
                $plot_id = $row['Plot_ID'];
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
                  
                  $query2 = "SELECT * FROM user_like WHERE Agent_ID = '$agent_id' AND Plot_ID = '$plot_id'";
                  $result2 = mysqli_query($connection, $query2);
                  $count = mysqli_num_rows($result2);

    ?>
                  <div class = "container">
                  <?php
                if($type == 'House for Rent' || $type == 'House for Sale')
                {
                  ?>
                  <h3 style="text-align:center; font-weight:bold; margin-top:1%; color:blue;"> <?php echo $area ?> </h3>
                  <?php
                }
                else
                {
                ?>
                  <h3 style="text-align:center; font-weight:bold; margin-top:1%;"> <span><?php echo $area ?></span> </h3>
                  <?php
                }
                ?>

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
                            <center> <a href="add_like.php?page=add&id=1&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/like.png" alt="like it" title = "like it"></a> </center>
                            </div>
                            <?php
                          }
                          else
                          {
                            ?>
                            <div class="col-lg-12">
                            <center> <a href="add_like.php?page=add&id=2&agent_id=<?php echo $agent_id ?>&plot_id=<?php echo $plot_id ?>"><img src="images/adds/liked.png" alt="liked" title = "liked"></a> </center>
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


<div style="margin-top:8%;"></div>


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

<script>

</script>

</div>
</body>
</html>
