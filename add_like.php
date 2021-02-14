<?php

$id = $_GET['id'];
$plot_id = $_GET['plot_id'];
$agent_id = $_GET['agent_id'];
$page = $_GET['page'];

$connection = mysqli_connect("localhost", "root", "", "propertyghar");

if($id=='1')
{
    $query1 = "INSERT INTO user_like (Agent_ID, Plot_ID) VALUES('$agent_id', '$plot_id')";
    $result1 = mysqli_query($connection, $query1)or die(mysqli_error($connection));

    $query2 = "SELECT Likes FROM plot WHERE Plot_ID = '$plot_id'";
    $result2 = mysqli_query($connection, $query2)or die(mysqli_error($connection));
    $row1 = mysqli_fetch_assoc($result2);
    $num_of_likes = $row1['Likes'];
    $num_of_likes++;

    $query3 = "UPDATE plot SET Likes = '$num_of_likes' WHERE Plot_ID = '$plot_id'";
    $result3 = mysqli_query($connection, $query3)or die(mysqli_error($connection));
    if($page == 'add')
        header("location:adds.php");
    else
        header("location:profile.php");
}
else
{
    $query1 = "DELETE FROM user_like WHERE Agent_ID = '$agent_id' AND Plot_ID = '$plot_id'";
    $result1 = mysqli_query($connection, $query1)or die(mysqli_error($connection));

    $query2 = "SELECT Likes FROM plot WHERE Plot_ID = '$plot_id'";
    $result2 = mysqli_query($connection, $query2)or die(mysqli_error($connection));
    $row1 = mysqli_fetch_assoc($result2);
    $num_of_likes = $row1['Likes'];
    $num_of_likes--;

    $query3 = "UPDATE plot SET Likes = '$num_of_likes' WHERE Plot_ID = '$plot_id'";
    $result3 = mysqli_query($connection, $query3)or die(mysqli_error($connection));
    if($page == 'add')
        header("location:adds.php");
    else
        header("location:profile.php");
}

?>