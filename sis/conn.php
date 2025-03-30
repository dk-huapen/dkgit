<?php
	$con = mysqli_connect('localhost','root','dk1314lich,forever!','sisbuff');
	if(!$con){
		die("连接失败". mysqli_connect_error());
	}else
	{ 
		//echo"连接成功";
	}
	mysqli_query($con, "set names utf8");
?>
