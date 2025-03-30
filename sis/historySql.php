<?php
	$begin_time=$_GET['begin_time'];
	$end_time=$_GET['end_time'];
	$kks=$_GET['kks'];
	include('conn.php');
	$sql="SELECT Htime,value FROM ".$kks." where htime between '".$begin_time."' and '".$end_time."'";

	$result = mysqli_query($con,$sql);

	$outp = mysqli_fetch_all($result,MYSQLI_NUM);

	mysqli_close($con);
	echo json_encode($outp);
?>
