<html>
	<head>
    		<title>1号汽轮机空冷</title>
		<?php include("../header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>1号汽轮机空冷系统</h1></center>
		<script>
			var page = 302;
			var test =<?php
			include('../conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle,indexID,X,Y FROM sis where page=302 union SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle1,indexID,X1,Y1 FROM sis where page1=302";
			$result = mysqli_query($con,$sql);
			$pointArray = array();

			$str = "{";
				while($row = mysqli_fetch_assoc($result)){
					$str = $str. "_".$row['kks'].":{name:'".$row['name']."',HH:'".$row['HH']."',H:'".$row['H']."',HHH:'".$row['HHH']."',L:'".$row['L']."',LL:'".$row['LL']."',LLL:'".$row['LLL']."',updatetime:'".$row['updatetime']."',unit:'".$row['unit']."',value:".$row['value'].",flag:".$row['flag']."},";
					$pointArray[$row['kks']] = array($row['indexID'],$row['name'],$row['X'],$row['Y'],$row['flag'],$row['LLL'],$row['angle']);

				}
				$strre = chop($str,",");
			$strre = $strre."}";

			echo $strre;

			mysqli_close($con);
	
			?>;
		</script>
	<!--SIS画面-->
		<svg width="1860" height="1000" viewBox="0 0 1860 1000" fill="gray">
			<?php
				$locateX = 0;
				$locateY = 0;
			?>


<text x="1750" y="20" fill="black" font-size="20" font-family="Arial">环境温度</text>
<line x1="1850" y1="30" x2="1850" y2="900" stroke="green" stroke-width="2"/><!---右边界线-->

<!---1号风机x330y320-->
<line x1="960" y1="130" x2="960" y2="250" stroke="black" stroke-width="2"/>
<line x1="790" y1="130" x2="790" y2="300" stroke="black" stroke-width="2"/>
<line x1="875" y1="90" x2="960" y2="130" stroke="black" stroke-width="2"/>
<line x1="875" y1="90" x2="790" y2="130" stroke="black" stroke-width="2"/>
<text x="830" y="151" fill="black" font-size="18" font-family="Arial">准备好</text>
<text x="830" y="176" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="810" y="216" fill="black" font-size="20" font-family="Arial">FB</text>
<text x="810" y="236" fill="black" font-size="20" font-family="Arial">SP</text>
<text x="840" y="285" fill="black" font-size="20" font-family="Arial">1号风机</text>
<!---2号风机330-->
<line x1="1290" y1="130" x2="1290" y2="250" stroke="black" stroke-width="2"/>
<line x1="1120" y1="130" x2="1120" y2="300" stroke="black" stroke-width="2"/>
<line x1="1205" y1="90" x2="1290" y2="130" stroke="black" stroke-width="2"/>
<line x1="1205" y1="90" x2="1120" y2="130" stroke="black" stroke-width="2"/>
<text x="1160" y="151" fill="black" font-size="18" font-family="Arial">准备好</text>
<text x="1160" y="176" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="1140" y="216" fill="black" font-size="20" font-family="Arial">FB</text>
<text x="1140" y="236" fill="black" font-size="20" font-family="Arial">SP</text>
<text x="1170" y="285" fill="black" font-size="20" font-family="Arial">2号风机</text>
<!---3号风机-->
<line x1="1620" y1="130" x2="1620" y2="250" stroke="black" stroke-width="2"/>
<line x1="1450" y1="130" x2="1450" y2="300" stroke="black" stroke-width="2"/>
<line x1="1535" y1="90" x2="1620" y2="130" stroke="black" stroke-width="2"/>
<line x1="1535" y1="90" x2="1450" y2="130" stroke="black" stroke-width="2"/>
<text x="1490" y="151" fill="black" font-size="18" font-family="Arial">准备好</text>
<text x="1490" y="176" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="1470" y="216" fill="black" font-size="20" font-family="Arial">FB</text>
<text x="1470" y="236" fill="black" font-size="20" font-family="Arial">SP</text>
<text x="1500" y="285" fill="black" font-size="20" font-family="Arial">3号风机</text>
<!---4号风机x330y320-->
<line x1="960" y1="450" x2="960" y2="570" stroke="black" stroke-width="2"/>
<line x1="790" y1="450" x2="790" y2="620" stroke="black" stroke-width="2"/>
<line x1="875" y1="410" x2="960" y2="450" stroke="black" stroke-width="2"/>
<line x1="875" y1="410" x2="790" y2="450" stroke="black" stroke-width="2"/>
<text x="830" y="471" fill="black" font-size="18" font-family="Arial">准备好</text>
<text x="830" y="496" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="810" y="536" fill="black" font-size="20" font-family="Arial">FB</text>
<text x="810" y="556" fill="black" font-size="20" font-family="Arial">SP</text>
<text x="840" y="605" fill="black" font-size="20" font-family="Arial">4号风机</text>
<!---5号风机330-->
<line x1="1290" y1="450" x2="1290" y2="570" stroke="black" stroke-width="2"/>
<line x1="1120" y1="450" x2="1120" y2="620" stroke="black" stroke-width="2"/>
<line x1="1205" y1="410" x2="1290" y2="450" stroke="black" stroke-width="2"/>
<line x1="1205" y1="410" x2="1120" y2="450" stroke="black" stroke-width="2"/>
<text x="1160" y="471" fill="black" font-size="18" font-family="Arial">准备好</text>
<text x="1160" y="496" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="1140" y="536" fill="black" font-size="20" font-family="Arial">FB</text>
<text x="1140" y="556" fill="black" font-size="20" font-family="Arial">SP</text>
<text x="1170" y="605" fill="black" font-size="20" font-family="Arial">5号风机</text>
<!---6号风机-->
<line x1="1620" y1="450" x2="1620" y2="570" stroke="black" stroke-width="2"/>
<line x1="1450" y1="450" x2="1450" y2="620" stroke="black" stroke-width="2"/>
<line x1="1535" y1="410" x2="1620" y2="450" stroke="black" stroke-width="2"/>
<line x1="1535" y1="410" x2="1450" y2="450" stroke="black" stroke-width="2"/>
<text x="1490" y="471" fill="black" font-size="18" font-family="Arial">准备好</text>
<text x="1490" y="496" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="1470" y="536" fill="black" font-size="20" font-family="Arial">FB</text>
<text x="1470" y="556" fill="black" font-size="20" font-family="Arial">SP</text>
<text x="1500" y="605" fill="black" font-size="20" font-family="Arial">6号风机</text>
<!---A列凝结水回水-->
<line x1="960" y1="250" x2="1640" y2="250" stroke="green" stroke-width="2"/>
<line x1="1640" y1="250" x2="1640" y2="300" stroke="green" stroke-width="2"/>
<line x1="790" y1="300" x2="1810" y2="300" stroke="green" stroke-width="2"/>
<line x1="1810" y1="300" x2="1810" y2="360" stroke="green" stroke-width="2"/>
<text x="1818" y="320" fill="black" font-size="20" font-family="Arial">A</text>
<text x="1815" y="340" fill="black" font-size="20" font-family="Arial">列</text>
<text x="1815" y="360" fill="black" font-size="20" font-family="Arial">凝</text>
<text x="1815" y="380" fill="black" font-size="20" font-family="Arial">结</text>
<text x="1815" y="400" fill="black" font-size="20" font-family="Arial">水</text>
<text x="1815" y="420" fill="black" font-size="20" font-family="Arial">回</text>
<text x="1815" y="440" fill="black" font-size="20" font-family="Arial">水</text>
<!---B列凝结水回水-->
<line x1="960" y1="570" x2="1640" y2="570" stroke="green" stroke-width="2"/>
<line x1="1640" y1="570" x2="1640" y2="620" stroke="green" stroke-width="2"/>
<line x1="790" y1="620" x2="1810" y2="620" stroke="green" stroke-width="2"/>
<line x1="1810" y1="620" x2="1810" y2="680" stroke="green" stroke-width="2"/>
<text x="1818" y="640" fill="black" font-size="20" font-family="Arial">B</text>
<text x="1815" y="660" fill="black" font-size="20" font-family="Arial">列</text>
<text x="1815" y="680" fill="black" font-size="20" font-family="Arial">凝</text>
<text x="1815" y="700" fill="black" font-size="20" font-family="Arial">结</text>
<text x="1815" y="720" fill="black" font-size="20" font-family="Arial">水</text>
<text x="1815" y="740" fill="black" font-size="20" font-family="Arial">回</text>
<text x="1815" y="760" fill="black" font-size="20" font-family="Arial">水</text>
<!---排汽管道-->
<line x1="700" y1="89" x2="1770" y2="90" stroke="red" stroke-width="2"/>
<line x1="700" y1="409" x2="1770" y2="410" stroke="red" stroke-width="2"/>
<!---抽汽管道-->
<line x1="1140" y1="50" x2="1770" y2="50" stroke="aqua" stroke-width="2"/>
<line x1="1140" y1="50" x2="1140" y2="119" stroke="aqua" stroke-width="2"/>
<line x1="1270" y1="50" x2="1270" y2="119" stroke="aqua" stroke-width="2"/>
<line x1="1140" y1="370" x2="1770" y2="370" stroke="aqua" stroke-width="2"/>
<line x1="1140" y1="370" x2="1140" y2="439" stroke="aqua" stroke-width="2"/>
<line x1="1270" y1="370" x2="1270" y2="439" stroke="aqua" stroke-width="2"/>
<line x1="1770" y1="50" x2="1770" y2="900" stroke="aqua" stroke-width="3"/>
<line x1="670" y1="900" x2="1770" y2="900" stroke="aqua" stroke-width="3"/>
<line x1="670" y1="500" x2="670" y2="900" stroke="aqua" stroke-width="3"/>

<!---真空泵By200-->
<text x="360" y="820" fill="black" font-size="20" font-family="Arial">2号真空泵</text>
<line x1="250" y1="850" x2="670" y2="850" stroke="aqua" stroke-width="2"/>
<line x1="30" y1="870" x2="170" y2="870" stroke="green" stroke-width="2"/>
<text x="30" y="860" fill="black" font-size="20" font-family="Arial">除盐水</text>
<line x1="90" y1="900" x2="190" y2="900" stroke="green" stroke-width="1"/>
<line x1="90" y1="900" x2="90" y2="930" stroke="green" stroke-width="1"/>
<polyline points="70,920 70,950 110,950 110,920" style="fill:none" stroke="black" stroke-width="3"/>
<polygon points='110,890,110,910,150,890,150,910' fill='white' stroke='black' stroke-width='2' ></polygon>

<path d="M 170 760 A 30 20 0 0 1 250 760 L250 890 A30 20 0 0 1 170 890z" stroke="black" stroke="#000" fill="gray" />
<line x1="170" y1="760" x2="250" y2="760" stroke="black" stroke-width="2"/>
<line x1="170" y1="890" x2="250" y2="890" stroke="black" stroke-width="2"/>
<rect x="195" y="770" width="30" height="110" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="200" y="795" fill="black" font-size="20" font-family="Arial">分</text>
<text x="200" y="820" fill="black" font-size="20" font-family="Arial">离</text>
<text x="200" y="845" fill="black" font-size="20" font-family="Arial">器</text>
<text x="203" y="870" fill="black" font-size="20" font-family="Arial">B</text>

<line x1="380" y1="850" x2="380" y2="880" stroke="green" stroke-width="1"/>
<line x1="350" y1="880" x2="380" y2="880" stroke="green" stroke-width="1"/>
<rect x="290" y="860" width="60" height="40" fill="gray" stroke="none" stroke-width="2"></rect>

<polygon points='450,840,450,860,490,840,490,860' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='530,840,530,860,570,840,570,860' fill='white' stroke='black' stroke-width='2' ></polygon>
<circle cx="610" cy="850" r="13" fill="gray" stroke="black" stroke-width="2"></circle>
<line x1="610" y1="837" x2="610" y2="863" stroke="black" stroke-width="3"/>









	<?php 
				foreach($pointArray as $kks=>$d){
					if($d[4]==0){
					dkAI($kks);
					}
					if($d[4]==1){
					dkDI($kks);
					}
					if($d[4]==2){
					dkValue($kks);
					}
				}
	?>

	</svg>
					<?php include("footer.php")?>

</body>
</html>
