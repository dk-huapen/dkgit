<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=GBK">
    <title>SIS系统</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<script src="myScript.js"></script>
</head>
<body>
<center><h1>风烟系统</h1></center>
<ul>
  <li><a href="test.php">汽水系统</a></li>
  <li><a class="active" href="feng.php">风烟系统</a></li>
  <li><a href="#contact">Contact</a></li>
  <li><a href="#about">About</a></li>
</ul>
    <div id="lookup"class="lookme">
<p style="float:right" onclick="closed()">&#9949;</p>
	    <center><p>KKS</p></center>
	    <center><p>设备名称</p></center>
    </div>
    <script type="text/javascript">
        drag("lookup");
    </script>
			<script>
var test =<?php

$con = mysqli_connect('localhost','phpmyadmin','phpmyadmin','buff');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT kks,value,HH,H,HHH,L,LL,LLL,flag FROM boler";
$result = mysqli_query($con,$sql);
$outp = array();

$str = "{";
while($row = mysqli_fetch_assoc($result)){
$str = $str. "_".$row['kks'].":{HH:'".$row['HH']."',H:'".$row['H']."',HHH:'".$row['HHH']."',L:'".$row['L']."',LL:'".$row['LL']."',LLL:'".$row['LLL']."',value:".$row['value'].",flag:".$row['flag']."},";
//$str = $str. "_".$row['kks'].":{HH:'".$row['HH']."',value:".$row['value'].",flag:".$row['flag']."},";
}
$strre = chop($str,",");
$strre = $strre."}";

echo $strre;

mysqli_close($con);
	
?>;
			</script>
	<!--鼠标右键点击弹出窗口-->
	<div id="contextMenu" class="context-menu">
    		<div class="context-menu-item" onclick="count(global_count_id)">设备台账</div>
    		<div class="context-menu-item" onclick="handleItemClick('粘贴')">历史曲线</div>
    		<div class="context-menu-item" onclick="handleItemClick('剪切')">预留功能</div>
	</div>
	<!--Tip窗口-->
	<div id="vartip" class="context-menu">
    		<div id="kks" class="context-menu-item">KKS码</div>
    		<div id="name" class="context-menu-item">设备名称</div>
	</div>
	<!--SIS画面-->
	<svg width="500" height="500" viewBox="0 0 500 500" fill="gray">
		<text id = "40HBK10CP001" x="100" y="350" fill="black" font-size="20" font-family="Arial"onclick=click(this.id) onmouseover=mOver("40HBK10CP001","4号炉膛出口烟气压力") onmouseout=mOut() onmouseup=mUp(6572)>bad!</text>
		<text id = "40HSA40CQ105" x="300" y="350" fill="black" font-size="20" font-family="Arial"onclick=click(this.id) onmouseover=mOver("40HSA40CQ105","4号炉脱硝反应器出口NH3逃逸") onmouseout=mOut() onmouseup=mUp(5707)>bad!</text>
<rect id = "10HBK10CP105"x="400" y="360" width="20" height="20" rx="5" ry="5" fill="gray" onclick=click(this.id) onmouseover=mOver("10HBK10CP105","1号炉膛出口烟气压力低低停炉") onmouseout=mOut() onmouseup=mUp(1813)></rect>
<polygon id = "10HLA11AA001" points="250,250 250,300 350,250,350,300" fill="white" stroke="black" stroke-width="2" onclick=click(this.id) onmouseover=mOver("10HLA11AA001","1号炉A送风机出口风门") onmouseout=mOut() onmouseup=mUp(1132)></polygon>
	</svg>
	<!--1秒刷新一次SIS画面参数-->
	<script> 
		showUser();
		setInterval(showUser,1000);
	</script>




</body>
</html>
