<?php

session_start();

// $cookie_name = $_SESSION["username"];  // if user is not loggedon, it will generate error
// $cookie_value = 100;
// $expiration = time() + (60*60*24*7);
// setcookie($cookie_name,$cookie_value,$expiration);

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

    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- <script src="js/script.js"></script> -->


    <title>Complain</title>
    <style>
        .form-control:focus{border-color: #5cb85c;  box-shadow:0 0 0 .2rem rgba(255,255,255);}  /* form input active/focus color/glow   */
        .has-error .form-control:focus{box-shadow: none; -webkit-box-shadow: none;}
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
                        <a class="nav-link" href="add_client.php"><img style = "width:20px;" src="images/navbar/create" alt="add"> Create Add</a>
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
                <a style="font-size:18px;" class="nav-link active" href="complain.php"> <img style = "width:20px;" src="images/navbar/complain.png" alt="contact"> Complain </a>
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

<div  style="margin-bottom: 70px;"></div>


<?php
    $name_err = $phone_err  = $comment_err  = "";
    $incomplete_details = false;

    if(isset($_POST["complain"]))
    {
            if($connection)
            {
                    $estate_name=$_POST['estate_name'];
                    $phone=$_POST['phone'];
                    $comment=$_POST['comment'];
                    if($_POST['complain_about'] == 'team')
                      $type = 'team';
                    else if($_POST['complain_about'] == 'video')
                      $type = 'video';
                    else if($_POST['complain_about'] == 'property')
                      $type = 'property';
                    else if($_POST['complain_about'] == 'add')
                      $type = 'add';
                    else if($_POST['complain_about'] == 'requirement')
                      $type = 'req';
                    else if($_POST['complain_about'] == 'other')
                      $type = 'other';

    

                    if (empty($_POST["estate_name"]))
                    {
                      $incomplete_details = true;
                      $name_err=" Required";
                    }
                    
                    if (empty($_POST["comment"]))
                    {
                      $incomplete_details = true;
                      $comment_err=" Required";
                    }

                    if (strlen($_POST["phone"]) < 10)
                    {
                            $phone_err=" uncomplete number";
                            $incomplete_details = true;
                    }
                    if($incomplete_details)
                    {
                      ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4" style="background-color:red; border-radius:10px; margin-top: 5%;">
                                    
                                    <div class="row">
                                        
                                        <div class="verifiaction_message_text col-lg-12" style="text-align:center;">Some of the required fields are empty!</div></div>
                                    </div>
                                    
                                <div class="col-lg-4"></div>
                            </div>
                        </div>
                      <?php
                    }
                    else
                    {        
                      
                    //                echo '$gender';
                                 /* 
                                 SQL Injection - How to Prevent it
            
                                 So when we have coal miners or any type of other parentheses or any type
                                 of data they're going to clean it up, called scaping sql
                                 */

                                 $estate_name = mysqli_real_escape_string($connection, $estate_name);
                                 $phone = mysqli_real_escape_string($connection, $phone);
                                 $comment = mysqli_real_escape_string($connection, $comment);
          
                                 $date = date("Y-m-d H:i:s", time());
                                 $query="INSERT INTO complain(Estate_Name, Phone, Type, Comment, Date)
                                 VALUES('$estate_name','$phone','$type','$comment','$date')";
                                 $result=mysqli_query($connection,$query)or die(mysqli_error($connection));
                                 if($result)
                                 {
                                 ?>
                                         <script>
                                                 window.location = "pop_up_index.php";
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
//                                         $_POST['name']="";
                                 }       
                    }    
      }
    }
    ?>


<div class="container-fluid">
        <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                        <form class="form-one-col" style="margin: 15% 0 3% 0;" method="post" action="complain.php">
                                <div class="form-group">
                                    <div class="row">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4"> <a href = "http://www.propertyghar.com"> <img style="width: 100%; height:105%; padding-bottom: 10%;" src="images/logo/logo_full.png" alt="PropertyGhar"> </a> </div>
                                            <div class="col-md-4"></div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-12">
                                                <label for=" ">Estate Name<span class="error">*<?php echo $name_err;?></span> </label>
                                                <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id="" name="estate_name" placeholder="Estate Name">

                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-lg-12">
                                                <label for=" ">Contact #<span class="error">*<?php echo $phone_err;?></span> </label>
                                                <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id="password_id" name="phone" placeholder="Contact #">

                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                          <div class = "col-lg-12">
                                             <label for=" ">Complain About<span class="error">*</span> </label>
                                          </div> 

                                        <div class="col-lg-12">
                                            <div class = "container">
                                                <div class="row">

                                                        <div class = "col-lg-4 ml-2">
                                                          <input type="radio" name="complain_about" value="team">Our Team
                                                        </div>
                                                        <div class = "col-lg-4 ml-2">
                                                        <input type="radio" name="complain_about" value="property">Fake Property
                                                        </div>
                                                        <div class = "col-lg-3 ml-2">
                                                        <input type="radio" name="complain_about" value="video">Video Link
                                                        </div>
                                                        
                                                </div>
                                                <div class="row">

                                                        <div class = "col-lg-4 ml-2">
                                                          <input type="radio" name="complain_about" value="add">Add Related
                                                        </div>
                                                        <div class = "col-lg-4 ml-2">
                                                          <input type="radio" name="complain_about" value="requirement">Fake Requirement
                                                        </div>
                                                        <div class = "col-lg-3 ml-2">
                                                         <input type="radio" name="complain_about" value="other" checked>Other
                                                        </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <br>
                                <div class="row">
                                        <div class="col-lg-12">
                                                <label for=" "> Comment <span class="error">*<?php echo $comment_err;?></span> </label>
                                                <textarea class="form-control" rows="4" id="" name="comment" placeholder="Few words about your complain"></textarea>
                                        </div>
                                </div>
                    
                                <div class="form-group">
                                </div>
                                <button type="submit" class="btn btn-success" name="complain">Add Complain</button>
                        </form>

                </div>  <!-- End of 2nd Col -->
                <div class="col-lg-3"></div>
        </div>  <!-- End of Row -->
    </div>  <!-- End of Container -->

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
                      
                      
            <div style = "margin-bottom:10px; color: #15aa22;"> .</div>
            </div>    <!-- Mian Row of Footer -->

        </div>    <!-- Mian Container of Footer -->
    
    </footer>

 <script>  
     
 </script>

</body>
</html>