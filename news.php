<?php

session_start();
// if(empty($_SESSION["username"]))
// {
//   header("Location: login.php");
// }
// else if($_SESSION["role"] != 'admin')
// {
//   header("Location: login.php");
// }
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

    <title>Add News</title>
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
$connection = mysqli_connect("localhost", "root", "", "propertyghar");
//  $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
  
  if($connection)
  {
    if(isset($_POST['add_news']))
    {
      $query = "SELECT * FROM news";
      $result = mysqli_query($connection, $query);
      $row = mysqli_fetch_assoc($result);

      $newsid = $row['News_ID'];
      $query = "DELETE FROM news WHERE News_ID = '$newsid'";
      $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
      
      $news = $_POST['news'];
      $result=mysqli_query($connection, "INSERT INTO news(News) Value('$news')");
    }
    if(isset($_POST['remove']))
    {
      $newsid = $_GET['id'];
      $query = "DELETE FROM news WHERE News_ID = '$newsid'";
      $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
    }
  }
?>

<center><h3 style="margin-top:10%;">Add News</h3></center>
<div class="container">

      <form class="" action="news.php" method="post">
              <div class="form-group">
                <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <textarea class="form-control" rows="5" id="" name="news"></textarea>
                        </div>
                        <div class="col-md-2">  </div>
                        
                    </div>
            </div>
            <br>
            <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-success" name="add_news">Add</button>
                        </div>
                        
            </div>
      </form>

</div>

<div class="container">
    <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <hr class="hr_style" style="margin-top:10%;">
        </div>
        <div class="col-md-1"></div>
    </div>
</div>


<center><h3 style="margin-top:10%;">News</h3></center>

<?php
  if($connection)
  {
    echo "<div class='container'>";
    echo "<div class='table-responsive'>"; 
        echo "<center>";

          echo '<table style="width:90%;" calss = "table table-hover table-bordered">';
            echo '<thead class="thead-light">';
            echo "<tr>";
                echo "<th style='width:90%;' class='pr-5'>";
                    echo "News";
                echo "</th>";
                echo "<th style='width:10%;' class='pr-5'>";
                    echo "Action";
                echo "</th>";
            echo "</tr>";
            echo "</thead>";

            $query = "SELECT * FROM news";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<tbody>";
                  echo "<td style='height:45px;' class='pl-2'>";
                  echo $row['News'];
                  echo "</td>";
                  echo "<td class='pl-2'>";
                    ?>
                      <form action="news.php?id=<?php echo $row['News_ID'];?>" method="post">
                          <button type="submit" class="btn-sm btn-danger" name="remove" style="border-radius:10%;"> Remove </button>
                      </form>
                    <?php
                  echo "</td>";
              echo "</tr>";   
              echo "</tbody>";
            }

      echo "</table>";
    echo "</center>";
  echo "</div>";
echo "</div>";
  }
?>

<script src="js/jquery/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- <script src="js/script.js"></script> -->

<div style="margin-top:8%;"></div>

</body>
</html>