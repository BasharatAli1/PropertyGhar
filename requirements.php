<?php
session_start();
if(empty($_SESSION["username"]))
{
  header("Location: login.php");
}
else if($_SESSION["role"] != 'admin')
{
  header("Location: login.php");
}

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

    <title>Requirement</title>
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
        #serachBarInput, #serachBarInput2, #serachBarInput3, #serachBarInput4 {
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

<div  style="margin-bottom: 70px;"></div>

<?php
$size = $phone = $email = $province = $city = $address = $area = $gender = $status = $deal_id = "";

if(!empty($_GET['req_id']) && !empty($_GET['agent_id']))
{
  $req_id = $_GET['req_id'];
  $agent_id = $_GET['agent_id'];
}

if(isset($_POST['remove']))
{
  if($connection)
  {
      
        $query = "DELETE FROM requirement WHERE Requirement_ID = '$req_id'";
        mysqli_query($connection, $query)or die(mysqli_error($connection));
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
  }
}
else if(isset($_POST['show']))
{

  if($connection)
  {
      $query = "UPDATE requirement SET Show_Requirement = 1 WHERE Requirement_ID = '$req_id'";
      $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
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
  }
}
else if(isset($_POST['hide']))
{

  if($connection)
  {
    echo $phone;
    $query = "UPDATE requirement SET Show_Requirement = 0 WHERE Requirement_ID = '$req_id'";
    $result=mysqli_query($connection, $query)or die(mysqli_error($connection));
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
  }
}
    
?>

<h3 style="text-align:center; font-weight:bold; margin-top:10%;"> Requirements </h3>
<div  style="margin-bottom: 30px;"></div>

<br>

<div class="container">
        <div class="row">

            <div class="col-lg-3">
                <input type="text" id="serachBarInput" onkeyup="searchTypeFunction()" placeholder="Search Type" title="Type in a Type">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput2" onkeyup="searchReqFunction()" placeholder="Search Plot ID" title="Type in a Plot ID">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput4" onkeyup="searchAreaFunction()" placeholder="Search Area" title="Type in a Area">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput3" onkeyup="searchCityFunction()" placeholder="Search City" title="Type in a City">
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
                        echo "Type";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Requirement ID";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Agent_ID";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Size";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "L x W";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Facing Road";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Min Range";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Max Range";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "City";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Province";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Society/Area";
                    echo "</th>";
                    echo "<th style='width:40%;' class='pr-5'>";
                        echo "Comment";
                    echo "</th>";
                    echo "<th style='width:40%;' class='pr-5'>";
                        echo "Action";
                    echo "</th>";
                    echo "<th style='width:40%;' class='pr-5'>";
                        echo "Hide/Show";
                    echo "</th>";
                echo "</tr>";
                echo "</thead>";

                $query = "SELECT * FROM requirement WHERE Status = '1'";
                $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
                
                while($row = mysqli_fetch_assoc($result))
                {
                  $address_id = "";
                    echo "<tbody>";
                    echo "<tr>";
                        echo "<td class='pl-2'>";
                            echo $row['Type'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                          $req_id = $row['Requirement_ID'];
                          
                          echo $req_id;
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Agent_ID'];
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
                            $lw = $row['Length'];
                            $lw = $lw . ' x ' . $row['Width'];
                            if($row['Length'] != 0 && $row['Width'] !=0)
                              echo $lw;
                        echo "</td>";
                        echo "<td class='pl-2'>";
                        if($row['Facing_Road'] != 0)
                            echo $row['Facing_Road'] . ' Feet';
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Min_Range'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Max_Range'];
                        echo "</td>";
                        // $result4=mysqli_query($connection, "SELECT * FROM plot_address WHERE Plot_ID = '$plot_id'") or die(mysqli_error($connection));
                        // while($row4 = mysqli_fetch_assoc($result4))
                        //     $address_id = $row4['Address_ID'];
                        // $result5=mysqli_query($connection, "SELECT * FROM address WHERE Address_ID = '$address_id'") or die(mysqli_error($connection));
                        // while($row5 = mysqli_fetch_assoc($result5))
                        // {
                            echo "<td class='pl-2'>";
                                echo $row['City'];
                            echo "</td>";
                            echo "<td class='pl-2'>";
                                echo $row['Province'];
                            echo "</td>";
//                        }
                        echo "<td class='pl-2'>";
                            echo $row['Area'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Comment'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            $status = $row['Status'];
                        if($status == 1)
                          {
                            ?>
                            <form action="requirements.php?req_id=<?php echo $row['Requirement_ID'];?>&agent_id=<?php echo $row['Agent_ID'];?>" method="post">
                                <button type="submit" class="btn-sm btn-danger" name="remove" style="border-radius:10%;"> Remove </button>
                            </form>
                            <?php
                          }
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            $show = $row['Show_Requirement'];
                        if($show == 1)
                          {
                            ?>
                            <form action="requirements.php?req_id=<?php echo $row['Requirement_ID'];?>&agent_id=<?php echo $row['Agent_ID'];?>" method="post">
                                <button type="submit" class="btn-sm btn-danger" name="hide" style="border-radius:10%;"> Hide </button>
                            </form>
                            <?php
                          }
                          else
                          {
                            ?>
                            <form action="requirements.php?req_id=<?php echo $row['Requirement_ID'];?>&agent_id=<?php echo $row['Agent_ID'];?>" method="post">
                                <button type="submit" class="btn-sm btn-info" name="show" style="border-radius:10%;"> Show </button>
                            </form>
                            <?php
                          }
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
    
<script src="js/jquery/jquery.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- <script src="js/script.js"></script> -->

<script>

function searchTypeFunction() {
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

function searchReqFunction() {
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

function searchCityFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("serachBarInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[8];
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

function searchAreaFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("serachBarInput4");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[10];
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
