<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<style>
.footer {
  padding: 20px;
  text-align: center;
  background: #ddd;
  margin-top: 20px;
}
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 6px 20px;
  text-align: center;
  text-decoration: none;
  font-size: 16px;
  margin: 4px 2px;
  transition-duration: 0.4s;
  cursor: pointer;
  background-color: white; 
  color: black; 
  border: 2px solid #4CAF50;
  border-radius:12px;
}

.button1 {
  display: inline-block;
}

.button:hover {
  background-color: #4CAF50;
  color: white;
}
.flex-container {
  display: flex;
  flex-wrap: nowrap;
  background-color: DodgerBlue;
}

.flex-container .box {
  background-color: #f1f1f1;
  width: 20%;
  margin: 1px;
  text-align: center;
  line-height: 45px;
  font-size: 20px;
}
.flex-container .box1 {
  background-color: #f1f1f1;
  width: 10%;
  margin: 1px;
  text-align: center;
  line-height: 45px;
  font-size: 20px;
}
</style>
</head>
<body>

<center><h1>总画面</h1></center>
<div class="flex-container">
  <div class="box">
<p>1号锅炉</p>
<button class="button button1" onclick='location.href=("Boiler1/qishui.php")'>汽水</button>
<button class="button button1" onclick='location.href=("Boiler1/fengyan.php")'>风烟</button>
<br>
<button class="button button1" onclick='location.href=("Boiler1/zhifen.php")'>制粉</button>
<button class="button button1">灰色</button>
<br>
<button class="button button1" onclick='location.href=("Boiler1/AMill.php")'>A磨</button>
<button class="button button1" onclick='location.href=("Boiler1/BMill.php")'>B磨</button>
<br>
<button class="button button1" onclick='location.href=("Boiler1/CMill.php")'>C磨</button>
<button class="button button1" onclick='location.href=("Boiler1/DMill.php")'>D磨</button>
<br>
<button class="button button1" onclick='location.href=("Boiler1/FDF.php")'>送风机</button>
<button class="button button1" onclick='location.href=("Boiler1/IDF.php")'>引风机</button>
<br>
<button class="button button1" onclick='location.href=("Boiler1/PDF.php")'>一次风机</button>
<button class="button button1">黑色</button>
<br>
<button class="button button1">黑色</button>
<button class="button button1">黑色</button>
<br>
<button class="button button1">黑色</button>
<button class="button button1">黑色</button>
<br>
<button class="button button1">黑色</button>
<button class="button button1">黑色</button>
</div>
  <div class="box">
<p>2号锅炉</p>
<button class="button button1" onclick='location.href=("Boiler2/qishui.php")'>汽水</button>
<button class="button button1" onclick='location.href=("Boiler2/fengyan.php")'>风烟</button>
</div>
  <div class="box">
<p>3号锅炉</p>
</div>
  <div class="box">
<p>4号锅炉</p>
</div>
  <div class="box1">
<p>辅系统</p>
<button class="button button1" onclick='location.href=("Auxiliary/qishuiquyang.php")'>汽水取样</button>
<button class="button button1" onclick='location.href=("Auxiliary/chuzha12.php")'>1-2除渣</button>
<button class="button button1" onclick='location.href=("System/SystemStatus.php")'>系统状态</button>
</div>
  <div class="box1">
<p>公用</p>
<button class="button button1" onclick='location.href=("Public/gaoyazhengqi.php")'>高压蒸汽</button>
<br>
<button class="button button1" onclick='location.href=("Public/cigaoyazhengqi.php")'>次高压蒸汽</button>
<br>
<button class="button button1" onclick='location.href=("Public/zhongyazhengqi.php")'>中压蒸汽</button>
<br>
<button class="button button1" onclick='location.href=("Public/diyazhengqi.php")'>低压蒸汽</button>
<br>
<button class="button button1" onclick='location.href=("Public/didiyazhengqi.php")'>低低压蒸汽</button>
<br>
<button class="button button1" onclick='location.href=("Public/chuyangqi.php")'>除氧器</button>
<br>
<button class="button button1" onclick='location.href=("Public/gaojia.php")'>高加</button>
<br>
<button class="button button1" onclick='location.href=("Public/1dianbeng.php")'>1号电泵</button>
<br>
<button class="button button1" onclick='location.href=("Public/2dianbeng.php")'>2号电泵</button>
<br>
<button class="button button1" onclick='location.href=("Public/3dianbeng.php")'>3号电泵</button>
<br>
<button class="button button1" onclick='location.href=("Public/4dianbeng.php")'>4号电泵</button>
<br>
<button class="button button1" onclick='location.href=("Public/changquliuliangcanshu.php")'>厂区流量参数</button>
</div>
  <div class="box1">
<p>汽轮机</p>
<button class="button button1" onclick='location.href=("Turbine1/benti.php")'>1号汽轮机</button>
<button class="button button1" onclick='location.href=("Turbine2/benti.php")'>2号汽轮机</button>
<button class="button button1" onclick='location.href=("Turbine3/benti.php")'>3号汽轮机</button>
<button class="button button1" onclick='location.href=("Turbine4/benti.php")'>4号汽轮机</button>
<button class="button button1" onclick='location.href=("Turbine5/benti.php")'>5号汽轮机</button>
</div>
  <div class="box1">
<p>脱硫</p>
<button class="button button1" onclick='location.href=("FGD/CEMS.php")'>环保</button>
<button class="button button1" onclick='location.href=("FGD/FGD1.php")'>1号脱硫</button>
<br>
<button class="button button1">红色</button>
<br>
<button class="button button1">红色</button>
<br>
<button class="button button1">红色</button>
<br>
<button class="button button1">红色</button>
<br>
<button class="button button1">红色</button>
<br>
<button class="button button1">红色</button>
</div>
</div>


		<div class="footer">

<?php
	include("../lib/phpqrcode/qrlib.php");
echo "扫一扫下方二维码登录SIS系统";
	$text = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
	echo "<center><img src='../lib/QRPager.php?id=".$text."'></img></center>";
?>
		</div>
</body>
</html>
