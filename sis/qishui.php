<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=GBK">
    <title>SIS系统</title>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<script type="text/javascript"src="../lib/dygraph.js"></script>
<link rel="stylesheet" type="text/css"src="../diary_css/dygraph.css" />
<script src="myScript.js"></script>
</head>
<body>
	<!--SIS最顶部展示栏-->
<ul>
  <li><span>Home</span></li>
  <li><span>News</span></li>
  <li><span>Contact</span></li>
  <li><span>About</span></li>
</ul>
<center><h1>汽水系统</h1></center>
			<script>
var test =<?php
include('conn.php');

$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag FROM boler where page=1 or page1=1";
$result = mysqli_query($con,$sql);

$str = "{";
while($row = mysqli_fetch_assoc($result)){
$str = $str. "_".$row['kks'].":{name:'".$row['name']."',HH:'".$row['HH']."',H:'".$row['H']."',HHH:'".$row['HHH']."',L:'".$row['L']."',LL:'".$row['LL']."',LLL:'".$row['LLL']."',updatetime:'".$row['updatetime']."',unit:'".$row['unit']."',value:".$row['value'].",flag:".$row['flag']."},";
//$str = $str. "_".$row['kks'].":{name:'".$row['name']."',HH:'".$row['HH']."',H:'".$row['H']."',HHH:'".$row['HHH']."',L:'".$row['L']."',LL:'".$row['LL']."',LLL:'".$row['LLL']."',value:".$row['value'].",flag:".$row['flag']."},";
//$str = $str. "_".$row['kks'].":{HH:'".$row['HH']."',H:'".$row['H']."',HHH:'".$row['HHH']."',L:'".$row['L']."',LL:'".$row['LL']."',LLL:'".$row['LLL']."',value:".$row['value'].",flag:".$row['flag']."},";
}
$strre = chop($str,",");
$strre = $strre."}";

echo $strre;

mysqli_close($con);
	
?>;
			</script>
	<!--SIS画面-->
	<svg width="500" height="500" viewBox="0 0 500 500" fill="gray">
		<text id = "40HBK10CP001" name="6572" x="100" y="350" fill="black" font-size="20" font-family="Arial"onclick=click(this.id,6572) onmouseover=mOver("40HBK10CP001","4号炉膛出口烟气压力") onmouseout=mOut() onmouseup=mUp(6572,this.id)>bad!</text>
		<text id = "40HSA40CQ105" x="300" y="350" fill="black" font-size="20" font-family="Arial"onclick=click(this.id,5707) onmouseover=mOver("40HSA40CQ105","4号炉脱硝反应器出口NH3逃逸") onmouseout=mOut() onmouseup=mUp(5707,this.id)>bad!</text>
<rect id = "10HBK10CP105"x="400" y="360" width="20" height="20" rx="5" ry="5" fill="gray" onclick=click(this.id,1813) onmouseover=mOver("10HBK10CP105","1号炉膛出口烟气压力低低停炉") onmouseout=mOut() onmouseup=mUp(1813,this.id)></rect>
<polygon id = "10HLA11AA001" points="250,250 250,300 350,250,350,300" fill="white" stroke="black" stroke-width="2" onclick=click(this.id,1132) onmouseover=mOver("10HLA11AA001","1号炉A送风机出口风门") onmouseout=mOut() onmouseup=mUp(1132,this.id)></polygon>
	</svg>
	<!--SIS最底部导航栏-->
<div class="btn-group">
  <button class="button" onclick='location.href=("test.php")'>汽水</button>
  <button class="button" onclick='location.href=("feng.php")'>风烟</button>
  <button class="button">制粉</button>
  <button class="button">制粉</button>
  <button class="button">制粉</button>
  <button class="button">制粉</button>
  <button class="button">制粉</button>
  <button class="button">制粉</button>
  <button class="button">制粉</button>
  <button class="button">Button</button>
</div>
	<!--鼠标右键历史曲线窗口-->
    <div id="sishistory"class="history">
  	<div id="draghistory" class="historytop">
		<span class="close" onclick="closed('sishistory')">X</span>
  	</div>
  	<div class="historyDygraph">
<div id="graphdiv" style="width:800px;height:400px;"></div>

  	</div>
  	<div class="historyparam">
<p><label><b>开始时间:</b></label><input type="datetime-local" id="begin_time" value="" width="5"><label><b>结束时间:</b></label><input type="datetime-local" id="end_time" value="" width="5"><button id="plot">查询</button><button id="last">上一页</button><button id="next">下一页</button></p>
<p><b>KKS:</b><input type='text' id='kks' value='' width='5'><b>下限:</b><input type='text' id='yzero' value='' width='5'>
<b>上限:</b><input type='text' id='yspan' value='' width='5'></p>
			
  	</div>
    </div>
	<!--鼠标左键点击弹出窗口-->
    <div id="lookup"class="lookme">
  	<div id="draglookup" class="topheader">
		<span class="close" onclick="closed('lookup')">X</span>
  	</div>
  	<div class="container">
	    <p id="lookup_kks">KKS</p>
	    <p id="lookup_name">设备名称</p>
  	</div>
  	<div class="containerkks">
	    <span id="lookup_value">值</span>
	    <span>更新时间:</span>
	    <span id="lookup_time">值</span>
  	</div>
  	<div class="header">
		<img id = 'erweima' src=></img>
		<span id="lookup_h">H</span>
	    <span id="lookup_hh">HH</span>
	    <span id="lookup_hhh">HHH</span>
  	</div>
    </div>
	<!--鼠标右键点击弹出窗口-->
	<div id="contextMenu" class="context-menu">
    		<div class="context-menu-item" onclick="count(global_count_id)">设备台账</div>
    		<div class="context-menu-item" onclick="showHistory(global_kks)">历史曲线</div>
    		<div class="context-menu-item" onclick="handleItemClick('剪切')">预留功能</div>
	</div>
	<!--Tip窗口-->
	<div id="vartip" class="context-menu">
    		<div id="kks" class="context-menu-item">KKS码</div>
    		<div id="name" class="context-menu-item">设备名称</div>
	</div>
	<!--1秒刷新一次SIS画面参数-->
	<script> 
        drag("draglookup","lookup");
        	//drag("sishistory");//拖动查看窗口
        	drag("draghistory","sishistory");//拖动查看窗口
		updateValue(1);
		setInterval(updateValue,1000,1);
	</script>




</body>
</html>
