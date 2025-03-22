<?php
	$begin_time=$_GET['begin_time'];
	$end_time=$_GET['end_time'];
	$kks=$_GET['kks'];
	$con = mysqli_connect('localhost','phpmyadmin','phpmyadmin','buff');
	if (!$con) {
    		die('Could not connect: ' . mysqli_error($con));
	}
	$sql="SELECT Htime,value FROM ".$kks." where htime between '".$begin_time."' and '".$end_time."'";

	$result = mysqli_query($con,$sql);

	$outp = mysqli_fetch_all($result,MYSQLI_NUM);

	mysqli_close($con);
	echo json_encode($outp);
?>
