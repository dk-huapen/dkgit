<?php
$page = $_GET['q'];

$con = mysqli_connect('localhost','phpmyadmin','phpmyadmin','buff');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

//$sql="SELECT kks,value,updatetime FROM boler";
$sql="SELECT kks,value,updatetime FROM boler where page =".$page." or page1 =".$page;
//$sql="SELECT kks,value,updatetime FROM boler where page =".$page;

$result = mysqli_query($con,$sql);
$outp = array();

$outp = mysqli_fetch_all($result,MYSQLI_ASSOC);

echo json_encode($outp);
mysqli_close($con);
?>
