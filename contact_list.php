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

    <title>Add Conact</title>
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
        #serachBarInput, #serachBarInput2, #serachBarInput3 {
          background-position: 10px 10px;
          background-repeat: no-repeat;
          width: 100%;
          font-size: 16px;
          padding: 12px 20px 12px 40px;
          border: 1px solid #ddd;
          margin-bottom: 12px;
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


<center><h3 style="margin-top:10%; margin-bottom:5%;">Add News</h3></center>
<?php
$connection = mysqli_connect("localhost", "root", "", "propertyghar");
//  $connection=mysqli_connect("localhost:3306", "proper10_db_login", "~s*}t&~}ZuC{1", "proper10_propertyghar");
  
  if($connection)
  {
    if(isset($_POST['add_contact']))
    {
      $name = $_POST['name'];
      $number = $_POST['number'];
      $address = $_POST['address'];
      $comment = $_POST['comment'];

      
      $name = mysqli_real_escape_string($connection, $name);
      $number = mysqli_real_escape_string($connection, $number);
      $address = mysqli_real_escape_string($connection, $address);
      $comment = mysqli_real_escape_string($connection, $comment);

      $query = "INSERT INTO contact_list(Name, Phone, Address, Comment) VALUES('$name','$number','$address','$comment')";
      $result=mysqli_query($connection, $query)or die(mysqli_error($connection));

    }
    if(isset($_POST['remove']))
    {
      $contact_id = $_GET['id'];
      $query = "DELETE FROM contact_list WHERE Contact_ID = '$contact_id'";
      $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
    }
  }
?>


<div class="container">

      <form class="" action="contact_list.php" method="post">
              <div class="form-group">
                <div class="row">
                      <div class="col-lg-2"></div>
                      <div class="col-lg-8">
                        <div class="container">
                          <div class="row">
                                <div class="col-lg-6">

                                  <label for=" ">Name</label>
                                  <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id="" name="name" placeholder="Enter Name">

                                </div>
                                <div class="col-lg-6">
                                  
                                  <label for=" ">Number</label>
                                  <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id="" name="number" placeholder="Enter Contact Number">

                                </div>
                                  
                          </div>  <!-- End of 1st row, 2nd container -->
                          
                          <div class="row">
                                <div class="col-md-12">
                                  <label for=" ">Address</label>
                                  <input style="background-color : white; border: 1px solid silver;"  type="text" class="form-control" id="" name="address" placeholder="Enter Address">
                                </div>
                                <div class="col-md-2">  </div>
                                  
                          </div>  <!-- End of 2nd row, 2nd container -->

                          <div class="row">
                                <div class="col-md-12">
                                  <label for=" ">Comment</label>
                                    <textarea class="form-control" rows="5" id="" name="comment"></textarea>
                                </div>
                                <div class="col-md-2">  </div>
                                  
                          </div>  <!-- End of 3rd row, 2nd container -->

                        </div>  <!-- End of 2nd container -->
                      </div>  <!-- End of 2nd col, 1st container -->
                      <div class="col-lg-2"></div>
                        
                </div>  <!-- End of only row, 1st container -->
            </div>  <!-- End of main div of form -->
            <br>
            <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-10">
                            <button type="submit" class="btn btn-success" name="add_contact">Add</button>
                        </div>
                        
            </div>  <!-- End of 2nd row, 1st container -->
      </form>     <!-- End of form -->

</div>  <!-- End of 1st container -->


<center><h3 style="margin-top:10%; margin-bottom:5%;">Contacts</h3></center>

<div class="container">
        <div class="row">

            <div class="col-lg-1"></div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput" onkeyup="searchNameFunction()" placeholder="Search Name" title="Type in a Name">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput2" onkeyup="searchNumberFunction()" placeholder="Search Number" title="Type in a Number">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput3" onkeyup="searchAddressFunction()" placeholder="Search Address" title="Type in Address">
            </div>

        </div>
</div>


<?php
  if($connection)
  {
    echo "<div class='container'>";
    echo "<div class='table-responsive'>"; 
        echo "<center>";

        echo '<table id = "myTable" style="width:90%;" calss = "table table-hover table-bordered table_design">';
            echo '<thead class="thead-light">';
            echo "<tr>";
                echo "<th class='pr-5'>";
                    echo "Name";
                echo "</th>";

                echo "<th class='pr-5'>";
                    echo "Number";
                echo "</th>";
                
                echo "<th class='pr-5'>";
                    echo "Address";
                echo "</th>";

                echo "<th class='pr-5'>";
                    echo "Comment";
                echo "</th>";
                echo "<th style='width:10%;' class='pr-5'>";
                    echo "Action";
                echo "</th>";
            echo "</tr>";
            echo "</thead>";

            $query = "SELECT * FROM contact_list";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result))
            {
              echo "<tbody>";
                  echo "<td style='height:45px;' class='pl-2'>";
                  echo $row['Name'];
                  echo "</td>";
                  
                  echo "<td style='height:45px;' class='pl-2'>";
                  echo $row['Phone'];
                  echo "</td>";
                  
                  echo "<td style='height:45px;' class='pl-2'>";
                  echo $row['Address'];
                  echo "</td>";

                  echo "<td style='height:45px;' class='pl-2'>";
                  echo $row['Comment'];
                  echo "</td>";
                  
                  echo "<td class='pl-2'>";
                    ?>
                      <form action="contact_list.php?id=<?php echo $row['Contact_ID'];?>" method="post">
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

<script>


function searchNameFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("serachBarInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function searchNumberFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("serachBarInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

function searchAddressFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("serachBarInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}

</script>

<div style="margin-top:8%;"></div>

</body>
</html>