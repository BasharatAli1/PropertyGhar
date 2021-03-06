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

    <title>Team</title>
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
$role = $name = $f_name = $agent_id = $cnic = $p_phone = $o_phone = $email = $province = $city = $address = $area_id = $area = $gender = $status = "";

if(!empty($_GET['id']))
$agent_id = $_GET['id'];
if(isset($_POST['block']))
{
  if($connection)
  {
      $query = "UPDATE user SET Status = 0 WHERE Agent_ID = '$agent_id'";
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
else if(isset($_POST['unblock']))
{

  if($connection)
  {
      $query = "UPDATE user SET Status = 1 WHERE Agent_ID = '$agent_id'";
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

<h3 style="text-align:center; font-weight:bold; margin-top:10%;"> Members </h3>
<div  style="margin-bottom: 70px;"></div>


<br>

<div class="container">
        <div class="row">

            <div class="col-lg-3">
                <input type="text" id="serachBarInput" onkeyup="searchRoleFunction()" placeholder="Search Role" title="Type in a Role">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput2" onkeyup="searchNameFunction()" placeholder="Search Name" title="Type in a Name">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput4" onkeyup="searchUserNameFunction()" placeholder="Search usernameame" title="Type in a usernameame">
            </div>

            <div class="col-lg-3">
                <input type="text" id="serachBarInput3" onkeyup="searchAreaFunction()" placeholder="Search Area" title="Type in ana Area">
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
                        echo "Role";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Name";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Father Name";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Username";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "CNIC";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Personal Phone";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Office Phone";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "E-mail";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Address";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "City";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Province";
                    echo "</th>";
                    echo "<th class='pr-5'>";
                        echo "Area";
                    echo "</th>";
                    echo "<th style='width:40%;' class='pr-5'>";
                        echo "Gender";
                    echo "</th>";
                    echo "<th style='width:40%;' class='pr-5'>";
                        echo "Status";
                    echo "</th>";
                echo "</tr>";
                echo "</thead>";
                $query = "SELECT * FROM user WHERE Role != 'user'";
                $result = mysqli_query($connection, $query)or die(mysqli_error($connection));
                
                while($row = mysqli_fetch_assoc($result))
                {
                    if($row['Gender'] == 'm')
                        $gender = 'Male';
                    else
                        $gender  = 'Female';
                    $status = $row['Status'];
                    
                    echo "<tbody>";
                    echo "<tr>";
                        echo "<td class='pl-2'>";
                            echo $row['Role'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Name'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Father_Name'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Agent_ID'];
                            $agent_id = $row['Agent_ID'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['CNIC'];
                        echo "</td>";

                            // $result2=mysqli_query($connection, "SELECT * FROM user_contact WHERE Agent_ID = '$agent_id'");
                            // while($row2 = mysqli_fetch_assoc($result2))
                            // {
                            //   $phone_id = $row2['Contact_ID'];
                              
                            //   $result3=mysqli_query($connection, "SELECT * FROM contact WHERE Contact_ID = '$phone_id'");
                            //   $row3 = mysqli_fetch_assoc($result3);
                            //   if($row3['Type'] == 'personal')
                            //     $p_phone = $row3['Phone'];
                            //   else
                            //     $o_phone = $row3['Phone'];
                            // }

                        echo "<td class='pl-2'>";
                          if($row['Personal_Phone'] != '0')
                            echo $row['Personal_Phone'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Office_Phone'];
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $row['Email'];
                        echo "</td>";
                        // $result4=mysqli_query($connection, "SELECT * FROM user_address WHERE Agent_ID = '$agent_id'");
                        // while($row4 = mysqli_fetch_assoc($result4))
                        //     $address_id = $row4['Address_ID'];
                        // $result5=mysqli_query($connection, "SELECT * FROM address WHERE Address_ID = '$address_id'");
                        // while($row5 = mysqli_fetch_assoc($result5))
//                        {
                            echo "<td class='pl-2'>";
                                echo $row['Address'];
                            echo "</td>";
                            echo "<td class='pl-2'>";
                                echo $row['City'];
                            echo "</td>";
                            echo "<td class='pl-2'>";
                                echo $row['Province'];
                            echo "</td>";
//                        }
                        echo "<td class='pl-2'>";
                          
                          $query2 = "SELECT * FROM user_area where Agent_ID = '$agent_id'";
                          $result6 = mysqli_query($connection, $query2)or die(mysqli_error($connection));
                          while($row = mysqli_fetch_assoc($result6))
                          {
                                  $area_id=$row['Area_ID'];
                                  
                                  $query3 = "SELECT * FROM area where Area_ID = '$area_id'";
                                  $result7 = mysqli_query($connection, $query3)or die(mysqli_error($connection));
                                  while($row = mysqli_fetch_assoc($result7))
                                  {
                                          $area = $area . ', ' . $row['Area'];
                                  }
                          }

                            echo $area;
                            $area = "";
                        echo "</td>";
                        echo "<td class='pl-2'>";
                            echo $gender;
                        echo "</td>";
                        echo "<td class='pl-2'>";
                        if($status == 1)
                          {
                            ?>
                            <form action="team.php?id=<?php echo $agent_id;?>" method="post">
                                <button type="submit" class="btn-sm btn-danger" name="block" style="border-radius:10%;"> Block </button>
                            </form>
                            <?php
                          }
                          if($status == 0)
                            {
                              ?>
                              <form action="team.php?id=<?php echo $agent_id;?>" method="post">
                                
                                  <button type="submit" class="btn-sm btn-success" name="unblock" style="border-radius:10%;"> Un Block </button>
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

function searchRoleFunction() {
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

function searchNameFunction() {
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

function searchAreaFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("serachBarInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[11];
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

function searchUserNameFunction() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("serachBarInput4");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
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