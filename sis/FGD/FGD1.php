<html>
	<head>
    		<title>1号吸收塔</title>
		<?php include("../header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>1号吸收塔</h1></center>
		<script>
			var page = 101;
			var test =<?php
			include('../conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle,indexID,X,Y FROM sis where page=101 or page1=101";
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


<!--汽包----->
			<path d="M 160 200 A 50 50 0 0 1 160 100 L500 100 A50 50 0 0 1 500 200z" stroke="black" stroke="#000" fill="white" />
<!--左侧连排----->
<line x1="280" y1="200" x2="280" y2="360" stroke="purple" stroke-width="2"/>
<!--紧急放水----->
<line x1="380" y1="200" x2="380" y2="360" stroke="purple" stroke-width="2"/>
<!--右侧连排----->
<line x1="480" y1="200" x2="480" y2="360" stroke="purple" stroke-width="2"/>
<!--省煤器上水----->
<line x1="150" y1="200" x2="150" y2="500" stroke="green" stroke-width="2"/>
<line x1="150" y1="500" x2="600" y2="500" stroke="green" stroke-width="2"/>
<!--省煤器----->
<rect x="200" y="400" width="400" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>
<line x1="200" y1="400" x2="600" y2="500" stroke="green" stroke-width="2"/>
<line x1="200" y1="500" x2="600" y2="400" stroke="green" stroke-width="2"/>
<rect x="350" y="430" width="100" height="40" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="370" y="455" fill="black" font-size="20" font-family="Arial">省煤器</text>
<!--低温过热器----->
<rect x="730" y="50" width="100" height="500" fill="gray" stroke="balck" stroke-width="2"></rect>
<line x1="730" y1="100" x2="830" y2="500" stroke="red" stroke-width="2"/>
<line x1="730" y1="500" x2="830" y2="100" stroke="red" stroke-width="2"/>
<rect x="760" y="210" width="40" height="180" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="770" y="245" fill="black" font-size="20" font-family="Arial">低</text>
<text x="770" y="275" fill="black" font-size="20" font-family="Arial">温</text>
<text x="770" y="305" fill="black" font-size="20" font-family="Arial">过</text>
<text x="770" y="335" fill="black" font-size="20" font-family="Arial">热</text>
<text x="770" y="365" fill="black" font-size="20" font-family="Arial">器</text>
<!--屏式过热器----->
<rect x="1100" y="50" width="50" height="500" fill="gray" stroke="balck" stroke-width="2" ></rect>
<rect x="1105" y="210" width="40" height="180" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="1115" y="245" fill="black" font-size="20" font-family="Arial">屏</text>
<text x="1115" y="275" fill="black" font-size="20" font-family="Arial">式</text>
<text x="1115" y="305" fill="black" font-size="20" font-family="Arial">过</text>
<text x="1115" y="335" fill="black" font-size="20" font-family="Arial">热</text>
<text x="1115" y="365" fill="black" font-size="20" font-family="Arial">器</text>
<!--高温过热器----->
<rect x="1250" y="50" width="300" height="500" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="1255" y="210" width="40" height="180" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="1265" y="245" fill="black" font-size="20" font-family="Arial">高</text>
<text x="1265" y="275" fill="black" font-size="20" font-family="Arial">温</text>
<text x="1265" y="305" fill="black" font-size="20" font-family="Arial">过</text>
<text x="1265" y="335" fill="black" font-size="20" font-family="Arial">热</text>
<text x="1265" y="365" fill="black" font-size="20" font-family="Arial">器</text>
<!--锅炉集汽集箱----->
<rect x="1590" y="50" width="40" height="400" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="1595" y="160" width="30" height="190" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="1600" y="185" fill="black" font-size="20" font-family="Arial">锅</text>
<text x="1600" y="215" fill="black" font-size="20" font-family="Arial">炉</text>
<text x="1600" y="245" fill="black" font-size="20" font-family="Arial">集</text>
<text x="1600" y="275" fill="black" font-size="20" font-family="Arial">汽</text>
<text x="1600" y="305" fill="black" font-size="20" font-family="Arial">集</text>
<text x="1600" y="335" fill="black" font-size="20" font-family="Arial">箱</text>
<line x1="1200" y1="200" x2="1980" y2="200" stroke="red" stroke-width="2"/>
<line x1="1200" y1="130" x2="1980" y2="130" stroke="red" stroke-width="2"/>
<polygon points='1660,120,1660,140,1700,120,1700,140' fill='white' stroke='black' stroke-width='2' ></polygon>
<line x1="1610" y1="450" x2="1610" y2="830" stroke="red" stroke-width="2"/>
<!--主给水----->
<text x="260" y="655" fill="black" font-size="20" font-family="Arial">单冲量</text>
<line x1="580" y1="500" x2="580" y2="690" stroke="green" stroke-width="2"/>
<line x1="10" y1="690" x2="580" y2="690" stroke="green" stroke-width="2"/>
<line x1="200" y1="690" x2="200" y2="600" stroke="green" stroke-width="2"/>
<line x1="420" y1="690" x2="420" y2="600" stroke="green" stroke-width="2"/>
<line x1="200" y1="600" x2="420" y2="600" stroke="green" stroke-width="2"/>
<line x1="210" y1="690" x2="210" y2="790" stroke="green" stroke-width="2"/>
<line x1="410" y1="690" x2="410" y2="790" stroke="green" stroke-width="2"/>
<line x1="210" y1="790" x2="410" y2="790" stroke="green" stroke-width="2"/>
<polygon points='120,680,120,700,160,680,160,700' fill='white' stroke='black' stroke-width='2' ></polygon>
<!--减温水----->
<line x1="190" y1="690" x2="190" y2="900" stroke="green" stroke-width="2"/>
<line x1="190" y1="900" x2="1100" y2="900" stroke="green" stroke-width="2"/>
<!--一减----->
<line x1="670" y1="900" x2="670" y2="650" stroke="green" stroke-width="2"/>
<!--一减左----->
<line x1="920" y1="650" x2="920" y2="300" stroke="green" stroke-width="2"/>
<line x1="670" y1="650" x2="920" y2="650" stroke="green" stroke-width="2"/>
<polygon points='850,640,850,660,890,640,890,660' fill='white' stroke='black' stroke-width='2' ></polygon>
<!--一减右----->
<line x1="1000" y1="750" x2="1000" y2="300" stroke="green" stroke-width="2"/>
<line x1="670" y1="750" x2="1000" y2="750" stroke="green" stroke-width="2"/>
<polygon points='850,740,850,760,890,740,890,760' fill='white' stroke='black' stroke-width='2' ></polygon>
<!--二减----->
<line x1="1100" y1="900" x2="1100" y2="650" stroke="green" stroke-width="2"/>
<!--二减左----->
<line x1="1100" y1="650" x2="1350" y2="650" stroke="green" stroke-width="2"/>
<line x1="1350" y1="650" x2="1350" y2="200" stroke="green" stroke-width="2"/>
<polygon points='1280,640,1280,660,1320,640,1320,660' fill='white' stroke='black' stroke-width='2' ></polygon>
<!--二减左----->
<line x1="1430" y1="750" x2="1430" y2="200" stroke="green" stroke-width="2"/>
<line x1="1100" y1="750" x2="1430" y2="750" stroke="green" stroke-width="2"/>
<polygon points='1280,740,1280,760,1320,740,1320,760' fill='white' stroke='black' stroke-width='2' ></polygon>





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
