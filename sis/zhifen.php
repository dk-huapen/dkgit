<html>
	<head>
    		<title>1号炉制粉系统</title>
		<?php include("header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>制粉系统</h1></center>
		<script>
			var page = 3;
			var test =<?php
			include('conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle,indexID,X,Y FROM sis where page=3 or page1=3";
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
				require 'fun.php';
			?>



<!--A层燃烧器----->
<rect x="40" y="20" width="400" height="80" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="190" y="40" fill="black" font-size="20" font-family="Arial">A层燃烧器</text>
<!--磨煤机----->
<rect x="150" y="440" width="240" height="20" fill="silver" stroke="balck" stroke-width="2"></rect>
<line x1="150" y1="460" x2="390" y2="460" stroke="gray" stroke-width="1"/>
<polygon points="150,460 390,460 340,490 340,610 390,640 150,640 200,610 200,490" fill="silver"></polygon>
<rect x="230" y="500" width="80" height="90" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="260" y="630" fill="black" font-size="30" font-family="Arial">A</text>
<line x1="160" y1="720" x2="350" y2="720" stroke="aqua" stroke-width="1"/>
<line x1="160" y1="790" x2="350" y2="790" stroke="aqua" stroke-width="1"/>
<line x1="160" y1="640" x2="160" y2="790" stroke="aqua" stroke-width="1"/>
<text x="450" y="727" fill="black" font-size="20" font-family="Arial">热一次风</text>
<text x="450" y="797" fill="black" font-size="20" font-family="Arial">冷一次风</text>
<path d="M12 4v16l8-8z"/>
<!--A3粉管----->
<line x1="350" y1="140" x2="350" y2="440" stroke="white" stroke-width="2"/>
<line x1="350" y1="140" x2="390" y2="140" stroke="white" stroke-width="2"/>
<line x1="390" y1="140" x2="390" y2="100" stroke="white" stroke-width="2"/>
<text x="350" y="92" fill="black" font-size="20" font-family="Arial">A3</text>
<!--A4粉管----->
<line x1="300" y1="100" x2="300" y2="440" stroke="white" stroke-width="2"/>
<text x="260" y="92" fill="black" font-size="20" font-family="Arial">A4</text>
<!--A1粉管----->
<line x1="250" y1="140" x2="250" y2="440" stroke="white" stroke-width="2"/>
<line x1="250" y1="140" x2="210" y2="140" stroke="white" stroke-width="2"/>
<line x1="210" y1="140" x2="210" y2="100" stroke="white" stroke-width="2"/>
<text x="180" y="92" fill="black" font-size="20" font-family="Arial">A1</text>
<!--A2粉管----->
<line x1="200" y1="140" x2="200" y2="440" stroke="white" stroke-width="2"/>
<line x1="200" y1="140" x2="120" y2="140" stroke="white" stroke-width="2"/>
<line x1="120" y1="140" x2="120" y2="100" stroke="white" stroke-width="2"/>
<text x="100" y="92" fill="black" font-size="20" font-family="Arial">A2</text>
<!--给煤机----->
<line x1="40" y1="292" x2="160" y2="292" stroke="black" stroke-width="3"/>
<line x1="40" y1="328" x2="160" y2="328" stroke="black" stroke-width="3"/>
<line x1="180" y1="440" x2="180" y2="318" stroke="white" stroke-width="4"/>
<line x1="45" y1="190" x2="45" y2="290" stroke="white" stroke-width="4"/>
<circle cx="40" cy="310" r="15" fill="gray" stroke="black" stroke-width="10"></circle>
<line x1="20" y1="520" x2="200" y2="520" stroke="aqua" stroke-width="1"/>
<line x1="50" y1="328" x2="50" y2="520" stroke="aqua" stroke-width="1"/>
<text x="20" y="557" fill="black" font-size="20" font-family="Arial">密封风压力低</text>
<!--A磨油站----->
<rect x="40" y="830" width="400" height="130" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="60" y="855" fill="black" font-size="20" font-family="Arial">液压油</text>

<!--B层燃烧器----->
<rect x="510" y="20" width="400" height="80" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="660" y="40" fill="black" font-size="20" font-family="Arial">B层燃烧器</text>
<!--磨煤机----->
<rect x="620" y="440" width="240" height="20" fill="silver" stroke="balck" stroke-width="2"></rect>
<line x1="620" y1="460" x2="860" y2="460" stroke="gray" stroke-width="1"/>
<polygon points="620,460 860,460 810,490 810,610 860,640 620,640 670,610 670,490" fill="silver"></polygon>
<rect x="700" y="500" width="80" height="90" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="730" y="620" fill="black" font-size="30" font-family="Arial">B</text>
<line x1="630" y1="720" x2="810" y2="720" stroke="aqua" stroke-width="1"/>
<line x1="630" y1="790" x2="810" y2="790" stroke="aqua" stroke-width="1"/>
<line x1="630" y1="640" x2="630" y2="790" stroke="aqua" stroke-width="1"/>
<text x="920" y="727" fill="black" font-size="20" font-family="Arial">热一次风</text>
<text x="920" y="797" fill="black" font-size="20" font-family="Arial">冷一次风</text>
<!--A3粉管----->
<line x1="820" y1="140" x2="820" y2="440" stroke="white" stroke-width="2"/>
<line x1="820" y1="140" x2="860" y2="140" stroke="white" stroke-width="2"/>
<line x1="860" y1="140" x2="860" y2="100" stroke="white" stroke-width="2"/>
<text x="820" y="92" fill="black" font-size="20" font-family="Arial">B3</text>
<!--A4粉管----->
<line x1="770" y1="100" x2="770" y2="440" stroke="white" stroke-width="2"/>
<text x="730" y="92" fill="black" font-size="20" font-family="Arial">B4</text>
<!--A1粉管----->
<line x1="720" y1="140" x2="720" y2="440" stroke="white" stroke-width="2"/>
<line x1="720" y1="140" x2="680" y2="140" stroke="white" stroke-width="2"/>
<line x1="680" y1="140" x2="680" y2="100" stroke="white" stroke-width="2"/>
<text x="650" y="92" fill="black" font-size="20" font-family="Arial">B1</text>
<!--A2粉管----->
<line x1="670" y1="140" x2="670" y2="440" stroke="white" stroke-width="2"/>
<line x1="670" y1="140" x2="590" y2="140" stroke="white" stroke-width="2"/>
<line x1="590" y1="140" x2="590" y2="100" stroke="white" stroke-width="2"/>
<text x="570" y="92" fill="black" font-size="20" font-family="Arial">B2</text>
<!--给煤机----->
<line x1="510" y1="292" x2="630" y2="292" stroke="black" stroke-width="3"/>
<line x1="510" y1="328" x2="630" y2="328" stroke="black" stroke-width="3"/>
<line x1="650" y1="440" x2="650" y2="318" stroke="white" stroke-width="4"/>
<line x1="515" y1="190" x2="515" y2="290" stroke="white" stroke-width="4"/>
<circle cx="510" cy="310" r="15" fill="gray" stroke="black" stroke-width="10"></circle>
<line x1="490" y1="520" x2="670" y2="520" stroke="aqua" stroke-width="1"/>
<line x1="520" y1="328" x2="520" y2="520" stroke="aqua" stroke-width="1"/>
<text x="490" y="557" fill="black" font-size="20" font-family="Arial">密封风压力低</text>
<!--磨油站----->
<rect x="510" y="830" width="400" height="130" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="530" y="855" fill="black" font-size="20" font-family="Arial">液压油</text>

<!--C层燃烧器----->
<rect x="980" y="20" width="400" height="80" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1130" y="40" fill="black" font-size="20" font-family="Arial">C层燃烧器</text>
<!--磨煤机----->
<rect x="1090" y="440" width="240" height="20" fill="silver" stroke="balck" stroke-width="2"></rect>
<line x1="1090" y1="460" x2="1330" y2="460" stroke="gray" stroke-width="1"/>
<polygon points="1090,460 1330,460 1280,490 1280,610 1330,640 1090,640 1140,610 1140,490" fill="silver"></polygon>
<rect x="1170" y="500" width="80" height="90" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1200" y="620" fill="black" font-size="30" font-family="Arial">C</text>
<line x1="1100" y1="720" x2="1280" y2="720" stroke="aqua" stroke-width="1"/>
<line x1="1100" y1="790" x2="1280" y2="790" stroke="aqua" stroke-width="1"/>
<line x1="1100" y1="640" x2="1100" y2="790" stroke="aqua" stroke-width="1"/>
<text x="1390" y="727" fill="black" font-size="20" font-family="Arial">热一次风</text>
<text x="1390" y="797" fill="black" font-size="20" font-family="Arial">冷一次风</text>
<!--A3粉管----->
<line x1="1290" y1="140" x2="1290" y2="440" stroke="white" stroke-width="2"/>
<line x1="1290" y1="140" x2="1330" y2="140" stroke="white" stroke-width="2"/>
<line x1="1330" y1="140" x2="1330" y2="100" stroke="white" stroke-width="2"/>
<text x="1290" y="92" fill="black" font-size="20" font-family="Arial">C3</text>
<!--A4粉管----->
<line x1="1240" y1="100" x2="1240" y2="440" stroke="white" stroke-width="2"/>
<text x="1200" y="92" fill="black" font-size="20" font-family="Arial">C4</text>
<!--A1粉管----->
<line x1="1190" y1="140" x2="1190" y2="440" stroke="white" stroke-width="2"/>
<line x1="1190" y1="140" x2="1150" y2="140" stroke="white" stroke-width="2"/>
<line x1="1150" y1="140" x2="1150" y2="100" stroke="white" stroke-width="2"/>
<text x="1120" y="92" fill="black" font-size="20" font-family="Arial">C1</text>
<!--A2粉管----->
<line x1="1140" y1="140" x2="1140" y2="440" stroke="white" stroke-width="2"/>
<line x1="1140" y1="140" x2="1060" y2="140" stroke="white" stroke-width="2"/>
<line x1="1060" y1="140" x2="1060" y2="100" stroke="white" stroke-width="2"/>
<text x="1040" y="92" fill="black" font-size="20" font-family="Arial">C2</text>
<!--给煤机----->
<line x1="980" y1="292" x2="1100" y2="292" stroke="black" stroke-width="3"/>
<line x1="980" y1="328" x2="1100" y2="328" stroke="black" stroke-width="3"/>
<line x1="1120" y1="440" x2="1120" y2="318" stroke="white" stroke-width="4"/>
<line x1="985" y1="190" x2="985" y2="290" stroke="white" stroke-width="4"/>
<circle cx="980" cy="310" r="15" fill="gray" stroke="black" stroke-width="10"></circle>
<line x1="1060" y1="520" x2="1140" y2="520" stroke="aqua" stroke-width="1"/>
<line x1="990" y1="328" x2="990" y2="520" stroke="aqua" stroke-width="1"/>
<text x="960" y="557" fill="black" font-size="20" font-family="Arial">密封风压力低</text>
<!--磨油站----->
<rect x="980" y="830" width="400" height="130" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1000" y="855" fill="black" font-size="20" font-family="Arial">液压油</text>

<!--D层燃烧器----->
<rect x="1450" y="20" width="400" height="80" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1600" y="40" fill="black" font-size="20" font-family="Arial">D层燃烧器</text>
<!--磨煤机----->
<rect x="1560" y="440" width="240" height="20" fill="silver" stroke="balck" stroke-width="2"></rect>
<line x1="1560" y1="460" x2="1800" y2="460" stroke="gray" stroke-width="1"/>
<polygon points="1560,460 1800,460 1750,490 1750,610 1800,640 1560,640 1610,610 1610,490" fill="silver"></polygon>
<rect x="1640" y="500" width="80" height="90" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1670" y="620" fill="black" font-size="30" font-family="Arial">D</text>
<line x1="1570" y1="720" x2="1750" y2="720" stroke="aqua" stroke-width="1"/>
<line x1="1570" y1="790" x2="1750" y2="790" stroke="aqua" stroke-width="1"/>
<line x1="1570" y1="640" x2="1570" y2="790" stroke="aqua" stroke-width="1"/>
<text x="1780" y="727" fill="black" font-size="20" font-family="Arial">热一次风</text>
<text x="1780" y="797" fill="black" font-size="20" font-family="Arial">冷一次风</text>
<!--A3粉管----->
<line x1="1760" y1="140" x2="1760" y2="440" stroke="white" stroke-width="2"/>
<line x1="1760" y1="140" x2="1800" y2="140" stroke="white" stroke-width="2"/>
<line x1="1800" y1="140" x2="1800" y2="100" stroke="white" stroke-width="2"/>
<text x="1760" y="92" fill="black" font-size="20" font-family="Arial">D3</text>
<!--A4粉管----->
<line x1="1710" y1="100" x2="1710" y2="440" stroke="white" stroke-width="2"/>
<text x="1670" y="92" fill="black" font-size="20" font-family="Arial">D4</text>
<!--A1粉管----->
<line x1="1660" y1="140" x2="1660" y2="440" stroke="white" stroke-width="2"/>
<line x1="1660" y1="140" x2="1620" y2="140" stroke="white" stroke-width="2"/>
<line x1="1620" y1="140" x2="1620" y2="100" stroke="white" stroke-width="2"/>
<text x="1590" y="92" fill="black" font-size="20" font-family="Arial">D1</text>
<!--A2粉管----->
<line x1="1610" y1="140" x2="1610" y2="440" stroke="white" stroke-width="2"/>
<line x1="1610" y1="140" x2="1530" y2="140" stroke="white" stroke-width="2"/>
<line x1="1530" y1="140" x2="1530" y2="100" stroke="white" stroke-width="2"/>
<text x="1510" y="92" fill="black" font-size="20" font-family="Arial">D2</text>
<!--给煤机----->
<line x1="1450" y1="292" x2="1570" y2="292" stroke="black" stroke-width="3"/>
<line x1="1450" y1="328" x2="1570" y2="328" stroke="black" stroke-width="3"/>
<line x1="1590" y1="440" x2="1590" y2="318" stroke="white" stroke-width="4"/>
<line x1="1455" y1="190" x2="1455" y2="290" stroke="white" stroke-width="4"/>
<circle cx="1450" cy="310" r="15" fill="gray" stroke="black" stroke-width="10"></circle>
<line x1="1530" y1="520" x2="1610" y2="520" stroke="aqua" stroke-width="1"/>
<line x1="1460" y1="328" x2="1460" y2="520" stroke="aqua" stroke-width="1"/>
<text x="1430" y="557" fill="black" font-size="20" font-family="Arial">密封风压力低</text>
<!--磨油站----->
<rect x="980" y="830" width="400" height="130" fill="gray" stroke="balck" stroke-width="2"></rect>
<text x="1000" y="855" fill="black" font-size="20" font-family="Arial">液压油</text>



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
