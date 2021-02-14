<?php
	$q=$_GET['q'];
	$my_data=$q;
	$connection=mysqli_connect('localhost','root','', 'propertyghar') or die("Database Error");
	$query="SELECT * FROM area_suggestion WHERE Area LIKE '%$my_data%' ORDER BY id LIMIT 10";
	$result = mysqli_query($connection,$query)or die(mysqli_error($connection));
	
	if($result)
	{
		while($row=mysqli_fetch_array($result))
		{
			echo $row['Area']."\n";
		}
	}
?>