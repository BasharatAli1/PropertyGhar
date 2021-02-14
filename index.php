<?php

session_start();

// $cookie_name = $_SESSION["username"];  // if user is not loggedon, it will generate error
// $cookie_value = 100;
// $expiration = time() + (60*60*24*7);
// setcookie($cookie_name,$cookie_value,$expiration);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="googlebot" content="index,follow">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Property Ghar is a best Property Portal">

    <!--Favicon-->
    <link rel="icon" href="images/logo/logo.png" type="image/gif" sizes="16x16">

    <!--BOOTSTRAP-->
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <!--CSS FILE-->
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/style.css">
    <!--FONT 1-->
    <link href="https://fonts.googleapis.com/css?family=Courgette&display=swap" rel="stylesheet">
    <!--FONT 2-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <!--Font 3-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700&display=swap" rel="stylesheet">

    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <!-- <script src="js/script.js"></script> -->


    <title>Property Ghar - Property Portal</title>
    <style>
        .form-control:focus{border-color: #5cb85c;  box-shadow:0 0 0 .2rem rgba(255,255,255);}  /* form input active/focus color/glow   */
        .has-error .form-control:focus{box-shadow: none; -webkit-box-shadow: none;}
    </style>
    
    <script>
    $(document).ready(function()
    {
        $("#area").autocomplete("ajaxcomplete.php",{selectFirst: true});
    });
    </script>
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
                  <a style="font-size:18px;" class="nav-link active" href="http://www.propertyghar.com"> <img style = "width:20px;" src="images/navbar/home.png" alt="home"> Home </a>
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

<div  style="margin-bottom: 70px;"></div>

  <header>

  
    <!-- Start of Slider -->
            <!-- <img src="images/home/Slide1.png" alt="LDA City Lahore" class="carousel_img"> -->
            
                      <!-- Hero Image is a large image with text, often placed at the top of a webpage -->
    <div class="hero-image">
        <img src="images/home/Slide1.png" alt="LDA City Lahore" class="carousel_img">
    
            <div class="hero-text">
            
                <p style="color:white">Find Job, Employment, and Career Opportunities</p>
                <h1 style="font-size:35px; color:white">The Eassiest Way to Get Your New Job</h1><br>
              
              <div class="ftco-search">
                <div class="row">
        
                  <div class="col-md-12 nav-link-wrap">
                    <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                      <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Buy</a>
                      <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Rent</a>
                    </div>
                  </div>
                  
                <div class="col-md-12 tab-wrap">
                  <div class="tab-content p-4" id="v-pills-tabContent">
                
                    <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
                      <form action="#" class="search-job">
                        <div class="row">
                            <div class="col-md">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="icon"><span class="icon-briefcase"></span></div>
                                  <input name="area" type="text" class="form-control" placeholder="Area">
                                </div>
                              </div>
                            </div>
        
                            <div class="col-md">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="select-wrap">
                                    <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                        <select name="" id="" class="form-control">
                                          <option value="">Category</option>
                                          <option value="">Full Time</option>
                                          <option value="">Part Time</option>
                                        </select>
                                    </div>
                                </div>
                              </div>
                            </div>
        
                            <div class="col-md">
                              <div class="form-group">
                                <div class="form-field">
                                  <div class="icon"><span class="icon-map-marker"></span></div>
                                  <input type="text" class="form-control" placeholder="Location">
                                </div>
                              </div>
                            </div>
        
                            <div class="col-md">
                              <div class="form-group">
                                <div class="form-field">
                                  <input type="submit" value="Search" class="form-control btn btn-primary">
                                </div>
                              </div>
                            </div>
                            
                        </div>  <!-- End of Row -->
                      </form>
                    </div>
                
                    <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
                      <form action="#" class="search-job">
                        <div class="row">
        
                          <div class="col-md">
                            <div class="form-group">
                              <div class="form-field">
                                <div class="icon"><span class="icon-user"></span></div>
                                <input type="text" class="form-control" placeholder="eg. Adam Scott">
                              </div>
                            </div>
                          </div>
        
                          <div class="col-md">
                            <div class="form-group">
                              <div class="form-field">
                                <div class="select-wrap">
                                  <div class="icon"><span class="ion-ios-arrow-down"></span></div>
                                    <select name="" id="" class="form-control">
                                      <option value="">Category</option>
                                      <option value="">Full Time</option>
                                      <option value="">Part Time</option>
                                    </select>
                                  </div>
                              </div>
                            </div>
                          </div>
        
                          <div class="col-md">
                            <div class="form-group">
                              <div class="form-field">
                                <div class="icon"><span class="icon-map-marker"></span></div>
                              <input type="text" class="form-control" placeholder="Location">
                              </div>
                            </div>
                          </div>
        
                          <div class="col-md">
                            <div class="form-group">
                              <div class="form-field">
                              <input type="submit" value="Search" class="form-control btn btn-primary">
                              </div>
                            </div>
                          </div>
        
                        </div>  <!-- End of Row -->
                      </form>
                    </div>
                  </div>
                </div>
              </div>  <!-- End of Row -->
            </div>    <!-- End of <div class="ftco-search"> -->
          </div>      <!-- End of <div class="hero-text"> -->
        </div>        <!-- End of <div class="hero-image"> -->
        
  </header>

  <?php
  
        
  $news = "";
  $connection = mysqli_connect("localhost", "root", "", "propertyghar");
//  $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
  $result = mysqli_query($connection, "SELECT * FROM news")or die(mysqli_error($connection));
  ?>

  <div class="marquee">


	<p><b>
    <?php
      while($row = mysqli_fetch_assoc($result))
      {
          $news = $row['News'];
          echo $news;
      }
    ?>
  </b></p>
</div>

  <!--Contact Icon Start-->
<div class="container-fluid">
        <div class = "row">
          <div class="col-lg-11"></div>
          <div class="col-lg-1">
              <img onclick="document.getElementById('id01').style.display='block'" src="images/home/Messaging-Icon.png" id = "contact_icon" alt="Send Message">
          </div>
        </div>
</div>

<div id="id01" class="modal">
    <div class="container">
    
  <form class="modal-content" action="index.php" method="post">

  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <br>
      <h1>Contact US</h1>
      <br>
                                  <div class = "container">
                                          <div class="row">
                                                <div class="col-lg-6">
                                                    <p><span class="">How may I help you?</span></p>
                                                </div>
                                          </div>

                                          <div class="row">
                                                <div class="col-lg-6">
                                                        <label for=" ">Name <span class="error">*</span></label>
                                                        <input type="text" class="form-control" id=" " name="name" placeholder="Name">
                                                </div>
                                                <div class="col-lg-6">
                                                        <label for=" " >Phone #<span class="error">*</span></label>
                                                        <input type="text" class="form-control" id=" " value="" name="phone" placeholder="Phone number">
                                                </div>
                                          </div>

                                          <br>
                                          
                                          <div class="row">
                                                <div class="col-lg-6">
                                                        <label for=" ">Subject </label>
                                                        <input type="text" class="form-control" id=" " name="subject" placeholder="Subject">
                                                </div>
                                                <div class="col-lg-6">
                                                        <label for=" ">Email</label>
                                                        <input type="text" class="form-control" id=" " name="email" placeholder="Email">
                                                </div>
                                          </div>
  
                                          <br>

                                          <div class = "row" style="border:0px solid red;">
                                                      <div class = "col-lg-6">
                                                        <!-- <label for="" style = "width: 12%;" class="pl-3"> Comment: </label> -->
                                                        <label for=""> Comment: </label>
                                                        <textarea class="form-control" rows="3" cols="50" name="comment"></textarea>
                                                      </div>
                                          </div>
                                          <br>
                                          <br>
                                          <br>
                                          <br>
                                          <div class = "row">
                                                    <div class = "col-lg-6">
                                                      <button type="submit" class="btn btn-success" name="msg">Send</button>
                                                      <button type="submit" class="btn btn-danger" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button> 
                                                    </div>
                                          </div>
  
                                  </div>  <!-- End of container -->
      <div class="clearfix mt-3">
      </div>

      </form>
    </div>  <!-- End of container -->
</div>

  <!--Contact Icon End-->

  

  <h3 style="text-align:center; font-weight:bold; margin-top:5%;">Description</h3>
<!-- First Grid -->
    <div class="container" style="margin-top:3%;">
        <div class="row">
          <div class="col-lg-6">
              <p class="text-alignment">
                  LDA City is a project by Lahore Development Authority (LDA) and aims to provide its residents a life of comfort and convenience at a highly attractive price point. Utilising town planning of the highest standards, the developers have ensured that this massive project spanning over 41,000 kanals offers the best facilities around to over 50,000 families.
              </p>
          </div>
          <div class="col-md-6">
              <img src="images/home/grid_1.png" alt=""  style="width:100%;">
          </div>
        </div>
    </div>


<!-- Second Grid -->
    <h3 style="text-align:center; font-weight:bold; margin-top:5%;">A project with all the right approvals</h3>
    <div class="container" style="margin-top:3%;">
        <div class="row">
            <div class="col-md-6">
                <img src="images/home/grid_2.png" alt=""  style="width:100%;">
            </div>
          <div class="col-md-6">
              <p class="text-alignment">
                    This project, being a venture by the Lahore Development Authority LDA, comes already equipped with all the necessary approvals. So, you won’t have to worry about the legal status of your property in LDA City. All allotments for this society will also be directly managed by the Lahore Development Authority LDA, so the process will be handled efficiently. The allotment letters will be handed over directly by Lahore Development Authority (LDA).              </p>
          </div>
        </div>
    </div>


<!-- Third Grid -->
    <h3 style="text-align:center; font-weight:bold; margin-top:5%;">Amazing Location</h3>
    <div class="container" style="margin-top:3%;">
        <div class="row">
          <div class="col-md-6">
              <p class="text-alignment">
                  LDA City is a project by Lahore Development Authority (LDA) and aims to provide its residents a life of comfort and convenience at a highly attractive price point. Utilising town planning of the highest standards, the developers have ensured that this massive project spanning over 41,000 kanals offers the best facilities around to over 50,000 families.
              </p>
          </div>
          <div class="col-md-6">
              <img src="images/home/grid_3.png" alt=""  style="width:100%;">
          </div>
        </div>
    </div>

    
    <?php
    $name_err = $phone_err  = "";
    $incomplete_details = true;

    if(isset($_POST["msg"]))
    {
            if($connection)
            {
                    $name=$_POST['name'];
                    $phone=$_POST['phone'];
                    $subject=$_POST['subject'];
                    $email=$_POST['email'];
                    $comment=$_POST['comment'];
    
                    if (empty($_POST["name"]))
                    {
                      $incomplete_details = false;
                      $name_err=" Required";
                    }

                    if (strlen($_POST["phone"]) < 10)
                    {
                            $phone_err=" uncomplete number";
                            $incomplete_details = false;
                    }
                    if($incomplete_details == false)
                    {
                      ?>
                      <script>
                        window.location = "pop_up_index.php?id=error";
                      </script>
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

                                 $name = mysqli_real_escape_string($connection, $name);
                                 $phone = mysqli_real_escape_string($connection, $phone);
                                 $subject = mysqli_real_escape_string($connection, $subject);
                                 $email = mysqli_real_escape_string($connection, $email);
                                 $comment = mysqli_real_escape_string($connection, $comment);

                                 $date = date("Y-m-d H:i:s", time());
                                 $query="INSERT INTO visitor_msg(Name, Phone, Subject, Email, Comment, Date)
                                 VALUES('$name','$phone','$subject','$email','$comment','$date')";
                                 $result=mysqli_query($connection,$query);
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
      $(document).ready(function(){  
           $('.hover').popover({  
                title:fetchData,  
                html:true,  
                placement:'right'  
           });  
           function fetchData(){  
                var fetch_data = '';  
                var element = $(this);  
                var id = element.attr("id");  
                $.ajax({  
                     url:"fetch.php",  
                     method:"POST",  
                     async:false,  
                     data:{id:id},  
                     success:function(data){  
                          fetch_data = data;  
                     }  
                });  
                return fetch_data;  
           }  
      });  

      // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) 
    {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
 </script>

</body>
</html>