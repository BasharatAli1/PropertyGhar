<?php

session_start();
if(empty($_SESSION["username"]))
{
  header("Location: login.php");
}  


?>

<!DOCTYPE html>
<html>
<head>
<title>PropertyGhar</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>

    body
    {
        background-image: url('images/pop_up/room.jpg');        
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: cover;
    }
    h4 
    {
        font-size:16px;
    }
</style>

<script>

    $(document).ready(function(){

        $("#myModal").modal('show');

    });

</script>

<body>


    

<div id="myModal" class="modal fade">

        <div class="modal-dialog">
    
            <div class="modal-content">
    
                <div class="modal-header">
    
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    
    <?php 
        if(!empty($_GET['id']) && !empty($_GET['value']))
        {
            // Client is added by agent, now ask option
            if($_GET['id']=="cus_id")
            {
                ?>
                
                    <h4 class="modal-title"> <center>Record Addes Successfully!</center> </h4>

                    <h4 class="modal-title"> <center><?php echo '"' . $_GET['value'] . '"' . 'is ID of Client';?></center> </h4>
                    <br>
                    <h4 class="modal-title"> <center>Select an option:</center> </h4>
                    <center>
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Sale Plot<span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?id=<?php echo $_GET['id']?>&value=<?php echo $_GET['value']?>&type=file">File</a></li>
                                <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?id=<?php echo $_GET['id']?>&value=<?php echo $_GET['value']?>&type=general">General Plot</a></li>
                                <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?id=<?php echo $_GET['id']?>&value=<?php echo $_GET['value']?>&type=commercial">Commercial Plot</a></li>
                                <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?id=<?php echo $_GET['id']?>&value=<?php echo $_GET['value']?>&type=industrial">Industrial Land</a></li>
                                <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?id=<?php echo $_GET['id']?>&value=<?php echo $_GET['value']?>&type=agricultural">Agricultural Land</a></li>
                            </ul>
                            <a href="add_options.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Sale Plot </a>
                            <a href="requirement_options.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Purchase Plot </a>
                        <!--<a href="deal.php?id=<?php// echo $_GET['id']?>&value=<?php// echo $_GET['value']?>" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Purchase Plot </a>-->
                        </div> 
                    </center>
                <?php
            }
                ?>
                    </div>
                    <div class="modal-body">
                <?php
            // Plot is added by agent
            if($_GET['id']=="plot_id")
            {
                ?>
                    <h4 class="modal-title"> <center>Record Addes Successfully!</center> </h4>

                    <h4 class="modal-title"> <center><?php echo $_GET['value'] . ' is ID of your Add';?></center> </h4>
                    <center><a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Ok</a></center>
                <?php
            }
            // Requirement is added by agent
            if($_GET['id']=="req_id")
            {
                ?>
                    <h4 class="modal-title"> <center>Record Addes Successfully!</center> </h4>

                    <h4 class="modal-title"> <center><?php echo $_GET['value'] . ' is ID of Requirement';?></center> </h4>
                    <center><a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Ok</a></center>
                <?php
            }
            // Deal is added
            if($_GET['id']=="deal")
            {
                ?>
                    <h4 class="modal-title"> <center>Record Addes Successfully!</center> </h4>

                    <h4 class="modal-title"> <center><?php echo $_GET['value'] . ' is ID of Deal';?></center> </h4>
                    <center><a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Ok</a></center>
                <?php
            }
            // Deal already exist for plot
            if($_GET['id']=="deal_exist_for_plot")
            {
                 ?>
                     <!-- <h4 class="modal-title"> <center>Deal already exist for this plot!</center> </h4>

            //         <center>
            //             <a href="deal.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Try Again</a>
            //             <a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Ok</a>
            //         </center> -->
                 <?php
            }
            // Deal already exist for plot
            if($_GET['id']=="access_denied")
            {
            //     ?>
                     <!-- <h4 class="modal-title"> <center>Access Denied!</center> </h4>

            //         <center>
            //             <a href="deal.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Try Again</a>
            //             <a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Ok</a>
            //         </center> -->
                 <?php
            }
            
        } 
        // if client already exist, then show options
        else if(!empty($_GET['id']) && $_GET['id'] == "add_plot" && empty($_GET['value']))
        {
            ?>
            <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
            <center>
                <div class="dropdown">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Sale Plot<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?type=file">File</a></li>
                        <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?type=general">General Plot</a></li>
                        <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?type=commercial">Commercial Plot</a></li>
                        <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?type=industrial">Industrial Land</a></li>
                        <li><a style="color:#15aa22; font-size:15px; font-weight:bold;" href="add_plot.php?type=agricultural">Agricultural Land</a></li>
                    </ul>
                <a href="#" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Purchase Plot </a>
                </div> 
            </center>
            <?php
        }
        // if agent want to add plot but client doesn't exist
        else if(!empty($_GET['id']) && !empty($_GET['cus_id']) && $_GET['id'] == 'clientNot_exist')
        {
            $cus_id = $_GET['cus_id'];
            ?>
            <h4 class="modal-title"> <center>  Client doesn't exist against Client ID =  <?php echo $cus_id; ?></center> </h4>
            <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
            <center>
                <a href="add_client.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Add Client </a>
                <a href="add_plot.php?type=<?php echo $_GET['type'];?>" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Try Again </a>
            </center>
            <?php
        }
        // if agent want to add request but client doesn't exist
        else if(!empty($_GET['id']) && !empty($_GET['cus_id']) && $_GET['id'] == 'clientNot_exist_req')
        {
            $cus_id = $_GET['cus_id'];
            ?>
            <h4 class="modal-title"> <center>  Client doesn't exist against Client ID =  <?php echo $cus_id; ?></center> </h4>
            <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
            <center>
                <a href="add_client_req.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Add Client </a>
                <a href="add_requirement.php?type=<?php echo $_GET['type'];?>" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Try Again </a>
            </center>
            <?php
        }
        // if agent want to add deal but plot doesn't exist
        else if(!empty($_GET['id']) && !empty($_GET['plot_id']) && $_GET['id'] == 'plot_not_exist')
        {
        //     $plot_id = $_GET['plot_id'];
             ?>
        <!--      <h4 class="modal-title"> <center>  Plot doesn't exist against Plot ID =  <?php echo $plot_id; ?></center> </h4>
             <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
             <center>
                 <a href="add_client.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Add Plot </a>
                 <a href="deal.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Try Again </a>
             </center> -->
             <?php
        }
        // if agent want to add deal but client doesn't exist
        else if(!empty($_GET['id']) && !empty($_GET['client_id']) && $_GET['id'] == 'client_not_exist')
        {
        //     $client_id = $_GET['client_id'];
        //     ?>
             <!-- <h4 class="modal-title"> <center>  Client doesn't exist against Client ID =  <?php echo $client_id; ?></center> </h4>
        //     <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
        //     <center>
        //         <a href="add_client.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Add Client </a>
        //         <a href="deal.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Try Again </a>
        //     </center> -->
             <?php
        }
        // If a visitor/common user want to create a add but his limit is exceed
        else if(!empty($_GET['id']) && $_GET['id'] == 'add_limit_exceed')
        {
            if($_SESSION['role'] == 'user')
            {
            ?>
            <h4 class="modal-title"> <center>  You can post Maximum 2 Ads!</center> </h4>
            <?php
            }
            else
            {
                ?>
                <h4 class="modal-title"> <center>  You can post Maximum 30 Ads!</center> </h4>
                <?php
            }
            ?>
            <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
            <center>
                <a href="profile.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Remove an Add </a>
                <a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Ok </a>
            </center>
            <?php
        }
        // If a user want to create a req but his limit is exceed
        else if(!empty($_GET['id']) && $_GET['id'] == 'req_limit_exceed')
        {
            if($_SESSION['role'] == 'user')
            {
            ?>
            <h4 class="modal-title"> <center>  You can post Maximum 2 Requirements!</center> </h4>
            <?php
            }
            else
            {
                ?>
                <h4 class="modal-title"> <center>  You can post Maximum 30 Requirements!</center> </h4>
                <?php
            }
            ?>
            <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
            <center>
                <a href="profile.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Remove a Requirement </a>
                <a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Ok </a>
            </center>
            <?php
        }
        // // If a user want to create a req but his limit is exceed
        // else if(!empty($_GET['id']) && $_GET['id'] == 'req_limit_exceed')
        // {
        //     if($_SESSION['role'] == 'user')
        //     {
             ?>
             <!-- <h4 class="modal-title"> <center>  You can post Maximum 1 Requirement!</center> </h4> -->
             <?php
        //     }
        //     else if($_SESSION['role'] == 'dealer' || $_SESSION['role'] == 'member')
        //     {
                 ?>
        <!--          <h4 class="modal-title"> <center>  You can post Maximum 7 Requirements!</center> </h4> -->
                 <?php
        //     }
        //     else if($_SESSION['role'] == 'office')
        //     {
                 ?>
                 <!-- <h4 class="modal-title"> <center>  You can post Maximum 15 Requirements!</center> </h4> -->
                 <?php
        //     }
             ?>
             <!-- <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
             <center>
                 <a href="profile.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Remove a Requirement </a>
                <a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Ok </a>
             </center> -->
             <?php
        // }
        // if agent want to add deal but plot & client both doesn't exist
        else if(!empty($_GET['id']) && !empty($_GET['plot_id']) && !empty($_GET['client_id']) && $_GET['id'] == 'plot_and_client_not_exist')
        {
        //     $plot_id = $_GET['plot_id'];
        //     $client_id = $_GET['client_id'];
             ?>
             <!-- <h4 class="modal-title"> <center>  Plot doesn't exist against Plot ID =  <?php echo $plot_id; ?></center> </h4>
        //     <h4 class="modal-title"> <center>  Client doesn't exist against Plot ID =  <?php echo $client_id; ?></center> </h4>
        //     <h4 class="modal-title"> <center>Select an option:</center> </h4>
            
        //     <center>
        //         <a href="add_client.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Add Client & Plot </a>
        //         <a href="deal.php" class="btn btn-success mb-2" role="button" type="submit" name="exit"> Try Again </a>
        //     </center> -->
             <?php
        }
        else
        {
            ?>
                    <div class="modal-body">

                    <h4 class="modal-title"> <center>Record Addes Successfully!</center> </h4>
                    <center><a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Ok</a></center>
        <?php
        }
        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
