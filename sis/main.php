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
<button class="button button1" onclick='location.href=("qishui.php")'>汽水</button>
<button class="button button1">蓝色</button>
<br>
<button class="button button1">红色</button>
<button class="button button1">灰色</button>
<br>
<button class="button button1">黑色</button>
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
</div>
  <div class="box">
<p>3号锅炉</p>
</div>
  <div class="box">
<p>4号锅炉</p>
</div>
  <div class="box1">
<p>辅系统</p>
</div>
  <div class="box1">
<p>公用</p>
</div>
  <div class="box1">
<p>汽轮机</p>
</div>
  <div class="box1">
<p>脱硫</p>
<button class="button button1">蓝色</button>
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
