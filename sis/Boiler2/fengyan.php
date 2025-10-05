<html>
	<head>
    		<title>1号炉风烟系统</title>
		<?php include("../header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>风烟系统</h1></center>
		<script>
			var page = 2;
			var test =<?php
			include('../conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle,indexID,X,Y FROM sis where page=2 or page1=2";
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



<!--炉膛----->
<rect x="50" y="190" width="250" height="30" fill="silver" stroke="balck" stroke-width="2"></rect>
<text x="150" y="210" fill="black" font-size="20" font-family="Arial">左风箱</text>
<rect x="50" y="220" width="250" height="400" fill="gray" stroke="balck" stroke-width="2"></rect>
<rect x="50" y="620" width="250" height="30" fill="silver" stroke="balck" stroke-width="2"></rect>
<text x="160" y="260" fill="black" font-size="20" font-family="Arial">压力高高停炉</text>
<text x="160" y="590" fill="black" font-size="20" font-family="Arial">压力低低停炉</text>
<text x="150" y="640" fill="black" font-size="20" font-family="Arial">右风箱</text>
<text x="160" y="400" fill="black" font-size="40" font-family="Arial">炉</text>
<text x="160" y="460" fill="black" font-size="40" font-family="Arial">膛</text>
<!---炉膛-省煤器---->
<line x1="300" y1="370" x2="490" y2="370" stroke="black" stroke-width="2"/>
<line x1="300" y1="470" x2="490" y2="470" stroke="black" stroke-width="2"/>
<!--省煤器----->
<rect x="390" y="330" width="30" height="180" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="395" y="370" fill="black" font-size="20" font-family="Arial">省</text>
<text x="395" y="420" fill="black" font-size="20" font-family="Arial">煤</text>
<text x="395" y="470" fill="black" font-size="20" font-family="Arial">器</text>
<!---省煤器-脱硝---->
<line x1="490" y1="370" x2="490" y2="470" stroke="black" stroke-width="2"/>
<line x1="490" y1="420" x2="590" y2="420" stroke="black" stroke-width="2"/>
<!--脱硝----->
<rect x="500" y="360" width="30" height="120" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="505" y="400" fill="black" font-size="20" font-family="Arial">脱</text>
<text x="505" y="450" fill="black" font-size="20" font-family="Arial">硝</text>
<!---脱硝-空预器---->
<line x1="590" y1="300" x2="590" y2="540" stroke="black" stroke-width="2"/>
<line x1="590" y1="540" x2="960" y2="540" stroke="black" stroke-width="2"/>
<line x1="590" y1="300" x2="960" y2="300" stroke="black" stroke-width="2"/>
<line x1="960" y1="300" x2="960" y2="540" stroke="black" stroke-width="2"/>
<line x1="960" y1="420" x2="1080" y2="420" stroke="black" stroke-width="2"/>
<!---炉膛-空预器---->
<!---左侧--->
<line x1="230" y1="30" x2="1070" y2="30" stroke="aqua" stroke-width="2"/>
<line x1="300" y1="205" x2="1710" y2="205" stroke="aqua" stroke-width="2"/>
<line x1="230" y1="145" x2="1070" y2="145" stroke="aqua" stroke-width="2"/>
<text x="30" y="150" fill="black" font-size="20" font-family="Arial">磨煤机热一次风母管</text>
<!---右侧--->
<line x1="300" y1="635" x2="1710" y2="635" stroke="aqua" stroke-width="2"/>
<line x1="230" y1="705" x2="1070" y2="705" stroke="aqua" stroke-width="2"/>
<text x="30" y="710" fill="black" font-size="20" font-family="Arial">磨煤机热一次风母管</text>
<line x1="230" y1="830" x2="1070" y2="830" stroke="aqua" stroke-width="2"/>
<line x1="1070" y1="30" x2="1070" y2="830" stroke="aqua" stroke-width="2"/>
<line x1="1010" y1="205" x2="1010" y2="635" stroke="aqua" stroke-width="2"/>
<!--一次风机----->
<line x1="1070" y1="100" x2="1600" y2="100" stroke="aqua" stroke-width="2"/>
<line x1="1070" y1="760" x2="1600" y2="760" stroke="aqua" stroke-width="2"/>
<!--空预器----->
<rect x="750" y="90" width="50" height="250" fill="silver" stroke="balck" stroke-width="2"></rect>
<line x1="750" y1="90" x2="800" y2="340" stroke="black" stroke-width="1"/>
<line x1="750" y1="340" x2="800" y2="90" stroke="black" stroke-width="1"/>
<rect x="765" y="160" width="20" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="765" y="180" fill="black" font-size="20" font-family="Arial">空</text>
<text x="765" y="205" fill="black" font-size="20" font-family="Arial">预</text>
<text x="765" y="230" fill="black" font-size="20" font-family="Arial">器</text>
<text x="768" y="255" fill="black" font-size="20" font-family="Arial">A</text>
<rect x="750" y="510" width="50" height="250" fill="silver" stroke="balck" stroke-width="2"></rect>
<line x1="750" y1="510" x2="800" y2="760" stroke="black" stroke-width="1"/>
<line x1="750" y1="760" x2="800" y2="510" stroke="black" stroke-width="1"/>
<rect x="765" y="580" width="20" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="765" y="600" fill="black" font-size="20" font-family="Arial">空</text>
<text x="765" y="625" fill="black" font-size="20" font-family="Arial">预</text>
<text x="765" y="650" fill="black" font-size="20" font-family="Arial">器</text>
<text x="768" y="675" fill="black" font-size="20" font-family="Arial">B</text>
<!--除尘----->
<rect x="990" y="380" width="100" height="80" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="990" y="425" fill="black" font-size="20" font-family="Arial">布袋除尘</text>
<!--引风机----->
<line x1="1120" y1="300" x2="1120" y2="540" stroke="black" stroke-width="2"/>
<line x1="1120" y1="540" x2="1520" y2="540" stroke="black" stroke-width="2"/>
<line x1="1120" y1="300" x2="1520" y2="300" stroke="black" stroke-width="2"/>
<line x1="1520" y1="300" x2="1520" y2="540" stroke="black" stroke-width="2"/>
<line x1="1520" y1="420" x2="1770" y2="420" stroke="black" stroke-width="2"/>
<!--脱硫----->
<rect x="1580" y="360" width="30" height="120" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1585" y="400" fill="black" font-size="20" font-family="Arial">脱</text>
<text x="1585" y="450" fill="black" font-size="20" font-family="Arial">硫</text>
<!--烟囱----->
<rect x="1770" y="220" width="20" height="260" fill="gray" stroke="balck" stroke-width="2"></rect>
<!--CEMS----->
<rect x="1650" y="400" width="70" height="40" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1655" y="428" fill="black" font-size="20" font-family="Arial">CEMS</text>


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
