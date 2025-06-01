<html>
	<head>
    		<title>1号炉风烟系统</title>
		<?php include("header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>风烟系统</h1></center>
		<script>
			var page = 2;
			var test =<?php
			include('conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,indexID,X,Y FROM sis where page=2 or page1=2";
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
		<svg width="1600" height="1000" viewBox="0 0 1600 1000" fill="gray">
			<?php
				$locateX = 0;
				$locateY = 0;
				require 'fun.php';
			?>



<!--炉膛----->
<rect x="50" y="170" width="250" height="30" fill="black" stroke="balck" stroke-width="2"></rect>
<rect x="50" y="200" width="250" height="400" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="50" y="600" width="250" height="30" fill="black" stroke="balck" stroke-width="2"></rect>
<text x="150" y="380" fill="black" font-size="40" font-family="Arial">炉</text>
<text x="150" y="440" fill="black" font-size="40" font-family="Arial">膛</text>
<!---炉膛-省煤器---->
<line x1="300" y1="350" x2="490" y2="350" stroke="black" stroke-width="2"/>
<line x1="300" y1="450" x2="490" y2="450" stroke="black" stroke-width="2"/>
<!--省煤器----->
<rect x="390" y="310" width="30" height="180" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="395" y="350" fill="black" font-size="20" font-family="Arial">省</text>
<text x="395" y="400" fill="black" font-size="20" font-family="Arial">煤</text>
<text x="395" y="450" fill="black" font-size="20" font-family="Arial">器</text>
<!---省煤器-脱硝---->
<line x1="490" y1="350" x2="490" y2="450" stroke="black" stroke-width="2"/>
<line x1="490" y1="400" x2="590" y2="400" stroke="black" stroke-width="2"/>
<!--脱硝----->
<rect x="500" y="340" width="30" height="120" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="505" y="380" fill="black" font-size="20" font-family="Arial">脱</text>
<text x="505" y="430" fill="black" font-size="20" font-family="Arial">硝</text>
<!---脱硝-空预器---->
<line x1="590" y1="240" x2="590" y2="560" stroke="black" stroke-width="2"/>
<line x1="590" y1="560" x2="960" y2="560" stroke="black" stroke-width="2"/>
<line x1="590" y1="240" x2="960" y2="240" stroke="black" stroke-width="2"/>
<line x1="960" y1="240" x2="960" y2="560" stroke="black" stroke-width="2"/>
<!--空预器----->
<rect x="750" y="70" width="50" height="250" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="750" y="490" width="50" height="250" fill="gray" stroke="balck" stroke-width="2"></rect>
<!---炉膛-空预器---->
<!---左侧--->
<line x1="300" y1="185" x2="750" y2="185" stroke="black" stroke-width="2"/>
<line x1="230" y1="125" x2="750" y2="125" stroke="black" stroke-width="2"/>
<text x="30" y="130" fill="black" font-size="20" font-family="Arial">磨煤机热一次风母管</text>
<line x1="230" y1="20" x2="750" y2="20" stroke="black" stroke-width="2"/>
<!---右侧--->
<line x1="300" y1="615" x2="750" y2="615" stroke="black" stroke-width="2"/>
<line x1="230" y1="685" x2="750" y2="685" stroke="black" stroke-width="2"/>
<text x="30" y="690" fill="black" font-size="20" font-family="Arial">磨煤机热一次风母管</text>
<!---脱硝-空预器---->
<line x1="590" y1="240" x2="590" y2="560" stroke="black" stroke-width="2"/>
<line x1="590" y1="560" x2="960" y2="560" stroke="black" stroke-width="2"/>
<line x1="590" y1="240" x2="960" y2="240" stroke="black" stroke-width="2"/>
<line x1="960" y1="240" x2="960" y2="560" stroke="black" stroke-width="2"/>
<line x1="960" y1="400" x2="1080" y2="400" stroke="black" stroke-width="2"/>
<!--除尘----->
<rect x="980" y="360" width="80" height="80" fill="gray" stroke="balck" stroke-width="2"></rect>
<!--引风机----->
<line x1="1080" y1="240" x2="1080" y2="560" stroke="black" stroke-width="2"/>
<line x1="1080" y1="560" x2="1480" y2="560" stroke="black" stroke-width="2"/>
<line x1="1080" y1="240" x2="1480" y2="240" stroke="black" stroke-width="2"/>
<line x1="1480" y1="240" x2="1480" y2="560" stroke="black" stroke-width="2"/>
<line x1="1480" y1="400" x2="1570" y2="400" stroke="black" stroke-width="2"/>
<!--脱硫----->
<rect x="1520" y="340" width="30" height="120" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="1570" y="200" width="10" height="260" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1525" y="380" fill="black" font-size="20" font-family="Arial">脱</text>
<text x="1525" y="430" fill="black" font-size="20" font-family="Arial">硫</text>


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
