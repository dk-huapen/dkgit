<html>
	<head>
    		<title>1号炉汽水系统</title>
		<?php include("header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>汽水系统</h1></center>
		<script>
			var page = 1;
			var test =<?php
			include('conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,indexID,X,Y FROM sis where page=1 or page1=1";
			$result = mysqli_query($con,$sql);
			$pointArray = array();

			$str = "{";
				while($row = mysqli_fetch_assoc($result)){
					$str = $str. "_".$row['kks'].":{name:'".$row['name']."',HH:'".$row['HH']."',H:'".$row['H']."',HHH:'".$row['HHH']."',L:'".$row['L']."',LL:'".$row['LL']."',LLL:'".$row['LLL']."',updatetime:'".$row['updatetime']."',unit:'".$row['unit']."',value:".$row['value'].",flag:".$row['flag']."},";
					$pointArray[$row['kks']] = array($row['indexID'],$row['name'],$row['X'],$row['Y'],$row['flag'],$row['LLL']);

				}
				$strre = chop($str,",");
			$strre = $strre."}";

			echo $strre;

			mysqli_close($con);
	
			?>;
		</script>
	<!--SIS画面-->
		<svg width="1800" height="1000" viewBox="0 0 1600 1000" fill="gray">
			<?php
				$locateX = 0;
				$locateY = 0;
				require 'fun.php';
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
<line x1="150" y1="500" x2="480" y2="500" stroke="green" stroke-width="2"/>
<line x1="480" y1="500" x2="480" y2="650" stroke="green" stroke-width="2"/>
<line x1="480" y1="650" x2="80" y2="650" stroke="green" stroke-width="2"/>
<!--省煤器----->
<rect x="200" y="400" width="300" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>
<line x1="200" y1="400" x2="500" y2="500" stroke="green" stroke-width="2"/>
<line x1="200" y1="500" x2="500" y2="400" stroke="green" stroke-width="2"/>
<rect x="300" y="430" width="100" height="40" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="320" y="455" fill="black" font-size="20" font-family="Arial">省煤器</text>
<!--低温过热器----->
<rect x="680" y="50" width="100" height="500" fill="gray" stroke="balck" stroke-width="2"></rect>
<line x1="680" y1="100" x2="780" y2="500" stroke="red" stroke-width="2"/>
<line x1="680" y1="500" x2="780" y2="100" stroke="red" stroke-width="2"/>
<rect x="710" y="210" width="40" height="180" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="720" y="245" fill="black" font-size="20" font-family="Arial">低</text>
<text x="720" y="275" fill="black" font-size="20" font-family="Arial">温</text>
<text x="720" y="305" fill="black" font-size="20" font-family="Arial">过</text>
<text x="720" y="335" fill="black" font-size="20" font-family="Arial">热</text>
<text x="720" y="365" fill="black" font-size="20" font-family="Arial">器</text>
<!--屏式过热器----->
<rect x="1025" y="50" width="50" height="500" fill="gray" stroke="balck" stroke-width="2" ></rect>
<rect x="1030" y="210" width="40" height="180" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="1040" y="245" fill="black" font-size="20" font-family="Arial">屏</text>
<text x="1040" y="275" fill="black" font-size="20" font-family="Arial">式</text>
<text x="1040" y="305" fill="black" font-size="20" font-family="Arial">过</text>
<text x="1040" y="335" fill="black" font-size="20" font-family="Arial">热</text>
<text x="1040" y="365" fill="black" font-size="20" font-family="Arial">器</text>
<!--高温过热器----->
<rect x="1100" y="50" width="250" height="500" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="1105" y="210" width="40" height="180" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="1115" y="245" fill="black" font-size="20" font-family="Arial">高</text>
<text x="1115" y="275" fill="black" font-size="20" font-family="Arial">温</text>
<text x="1115" y="305" fill="black" font-size="20" font-family="Arial">过</text>
<text x="1115" y="335" fill="black" font-size="20" font-family="Arial">热</text>
<text x="1115" y="365" fill="black" font-size="20" font-family="Arial">器</text>
<!--锅炉集汽集箱----->
<rect x="1390" y="50" width="40" height="400" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="1395" y="160" width="30" height="190" fill="gray" stroke="white" stroke-width="2"></rect>
<text x="1400" y="185" fill="black" font-size="20" font-family="Arial">锅</text>
<text x="1400" y="215" fill="black" font-size="20" font-family="Arial">炉</text>
<text x="1400" y="245" fill="black" font-size="20" font-family="Arial">集</text>
<text x="1400" y="275" fill="black" font-size="20" font-family="Arial">汽</text>
<text x="1400" y="305" fill="black" font-size="20" font-family="Arial">集</text>
<text x="1400" y="335" fill="black" font-size="20" font-family="Arial">箱</text>



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
					<?php include("comm.php")?>

</body>
</html>
