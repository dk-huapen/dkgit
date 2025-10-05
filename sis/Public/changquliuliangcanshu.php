<html>
	<head>
    		<title>厂区流量参数</title>
		<?php include("../header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>厂区部分动力管道参数及累积流量流</h1></center>
		<script>
			var page = 261;
			var test =<?php
			include('../conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle,indexID,X,Y FROM sis where page=261 union SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle1,indexID,X1,Y1 FROM sis where page1=261";
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


<!--1号炉----->
<line x1="30" y1="100" x2="30" y2="910" stroke="black" stroke-width="2"/>

<line x1="30" y1="100" x2="460" y2="100" stroke="black" stroke-width="2"/>
<text x="130" y="135" fill="black" font-size="20" font-family="Arial">来至厂区氮气管道压力</text>
<line x1="30" y1="145" x2="460" y2="145" stroke="black" stroke-width="2"/>

<line x1="30" y1="190" x2="460" y2="190" stroke="black" stroke-width="2"/>

<line x1="30" y1="235" x2="460" y2="235" stroke="black" stroke-width="2"/>
<line x1="30" y1="280" x2="460" y2="280" stroke="black" stroke-width="2"/>
<line x1="30" y1="325" x2="460" y2="325" stroke="black" stroke-width="2"/>
<line x1="30" y1="370" x2="460" y2="370" stroke="black" stroke-width="2"/>
<line x1="30" y1="415" x2="460" y2="415" stroke="black" stroke-width="2"/>
<line x1="30" y1="460" x2="460" y2="460" stroke="black" stroke-width="2"/>
<line x1="30" y1="505" x2="460" y2="505" stroke="black" stroke-width="2"/>
<line x1="30" y1="550" x2="460" y2="550" stroke="black" stroke-width="2"/>
<line x1="30" y1="595" x2="460" y2="595" stroke="black" stroke-width="2"/>
<line x1="30" y1="640" x2="460" y2="640" stroke="black" stroke-width="2"/>
<line x1="30" y1="685" x2="460" y2="685" stroke="black" stroke-width="2"/>
<line x1="30" y1="730" x2="460" y2="730" stroke="black" stroke-width="2"/>
<line x1="30" y1="775" x2="460" y2="775" stroke="black" stroke-width="2"/>
<line x1="30" y1="820" x2="460" y2="820" stroke="black" stroke-width="2"/>
<line x1="30" y1="865" x2="460" y2="865" stroke="black" stroke-width="2"/>

<line x1="30" y1="910" x2="460" y2="910" stroke="black" stroke-width="2"/>

<line x1="460" y1="100" x2="460" y2="910" stroke="black" stroke-width="2"/>

<!--2号炉----->
<line x1="490" y1="20" x2="920" y2="20" stroke="black" stroke-width="2"/>
<line x1="490" y1="20" x2="490" y2="950" stroke="black" stroke-width="2"/>
<text x="500" y="150" fill="black" font-size="20" font-family="Arial">来至厂区仪用气管道压力</text>
<line x1="920" y1="20" x2="920" y2="950" stroke="black" stroke-width="2"/>

<line x1="950" y1="20" x2="950" y2="950" stroke="black" stroke-width="2"/>
<!--3号炉----->
<text x="970" y="150" fill="black" font-size="20" font-family="Arial">9.8MPa过热蒸汽(1)累积流量</text>
<line x1="1380" y1="20" x2="1380" y2="950" stroke="black" stroke-width="2"/>

<line x1="1410" y1="20" x2="1410" y2="950" stroke="black" stroke-width="2"/>
<!--4号炉----->
<text x="1440" y="150" fill="black" font-size="20" font-family="Arial">来至厂区氮气管道压力</text>
<line x1="1840" y1="20" x2="1840" y2="950" stroke="black" stroke-width="2"/>





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
