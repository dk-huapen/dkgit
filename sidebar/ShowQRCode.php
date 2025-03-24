<?php
	include("../../lib/phpqrcode/qrlib.php");
	$text = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	echo "<center>扫码访问本页</center>";
	echo "<center><img src='../../lib/QRPager.php?id=".$text."'></img></center>";
	echo "<center>发送给你的老铁</center>";
?>

