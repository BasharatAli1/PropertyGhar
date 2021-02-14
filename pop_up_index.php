<!DOCTYPE html>
<html>
<head>
<title>How to display PHP contact form popup using jQuery</title>
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
        <?php

        if(!empty($_GET['id']) && $_GET['id'] == 'error')
        {
            ?>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title"> <center>Some required fields are empty!</center> </h4>
                <br>
                <h4 class="modal-title"> <center>Try Again!</center> </h4>
            <?php
        }
        else
        {
            ?>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                <h4 class="modal-title"> <center>Record Added Successfully!</center> </h4>
                <br>
                <h4 class="modal-title"> <center>Our team will contact you as soon as possible.</center> </h4>
            <?php
        }
        ?>
            </div>

            <div class="modal-body">
            <center><a href="index.php" class="btn btn-success mb-2" role="button" type="submit" name="exit">Ok</a></center>
            


            </div>

        </div>

    </div>

</div>

</body>
</html>





