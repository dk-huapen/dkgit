<html>
	<head>
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
					$pointArray[$row['kks']] = array($row['indexID'],$row['name'],$row['X'],$row['Y'],$row['flag']);

				}
				$strre = chop($str,",");
			$strre = $strre."}";

			echo $strre;

			mysqli_close($con);
	
			?>;
		</script>
	<!--SIS画面-->
		<svg width="1400" height="1400" viewBox="0 0 1400 1400" fill="gray">
			<?php
				$locateX = 0;
				$locateY = 0;
				function dkAI($kks){
					global $pointArray;
					global $locateX;
					global $locateY;
				$index = $pointArray[$kks][0];
				$name = $pointArray[$kks][1];
				$x = $pointArray[$kks][2];
				$y = $pointArray[$kks][3];
				echo "<text id = ".$kks." x=".($locateX+$x)." y=".($locateY+$y)."  fill='black' font-size='18' font-family='Arial' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)>512℃</text>";
				}
			?>
			<path d="M 160 200 A 50 50 0 0 1 160 100 L500 100 A50 50 0 0 1 500 200z" stroke="black" stroke="#000" fill="white" />


	<?php 
				foreach($pointArray as $kks=>$d){
					if($d[4]==0){
					dkAI($kks);
					}
				}
				/*
				dkAI("10HAD10CT201");
				dkAI("10HAD10CP101");
				dkAI("10HAD10CP102");
				dkAI("10HAD10CT202");
				dkAI("10HAD10CT203");
				dkAI("10HAD10CT204");
				dkAI("10HAD10CT205");
				dkAI("10HAD10CT206");
				dkAI("10HAD10CL101_L");
				dkAI("10HAD10CL102_L");
				dkAI("10HAD10CL103_L");
				dkAI("10HAD10AA101GT");
				 */
	?>

			<rect id = "10HAD10CL005L"x="140" y="210" width="20" height="20" rx="5" ry="5" fill="gray" onclick=click(this.id,1623) onmouseover=mOver(this.id,"1号炉左侧零水位电接点水位低") onmouseout=mOut() onmouseup=mUp(1623,this.id)></rect>
<!--右侧连排----->
<line x1="480" y1="200" x2="480" y2="300" stroke="purple" stroke-width="2"/>
<polygon name="value1" id="7777" points="470,230 490,230 470,270 490,270" fill="green" stroke="black" stroke-width="2"/>
<polygon name="value1" id="7777" points="470,300 490,300 470,340 490,340" fill="green" stroke="black" stroke-width="2"/>
<line x1="480" y1="340" x2="480" y2="360" stroke="purple" stroke-width="2"/>
<!--左侧连排----->
<line x1="280" y1="200" x2="280" y2="300" stroke="purple" stroke-width="2"/>
<polygon id="10HAD10AA001" points="270,230 290,230 270,270 290,270" fill="white" stroke="black" stroke-width="2" onclick=click(this.id,1871) onmouseover=mOver(this.id,"1号炉左侧连续排污电动阀") onmouseout=mOut() onmouseup=mUp(1871,this.id)></polygon>
<polygon id="10HAD10AA101" points="270,300 290,300 270,340 290,340" fill="white" stroke="black" stroke-width="2" onclick=click(this.id,1010) onmouseover=mOver(this.id,"1号炉左侧连续排污调节阀") onmouseout=mOut() onmouseup=mUp(1010,this.id)></polygon>
<line x1="280" y1="340" x2="280" y2="360" stroke="purple" stroke-width="2"/>
<!--紧急放水----->
<line x1="380" y1="200" x2="380" y2="300" stroke="purple" stroke-width="2"/>
<polygon name="value1" id="7777" points="370,230 390,230 370,270 390,270" fill="green" stroke="black" stroke-width="2"/>
<polygon name="value1" id="7777" points="370,300 390,300 370,340 390,340" fill="green" stroke="black" stroke-width="2"/>
<line x1="380" y1="340" x2="380" y2="360" stroke="purple" stroke-width="2"/>

<line x1="180" y1="200" x2="180" y2="400" stroke="green" stroke-width="2"/>
<line x1="180" y1="400" x2="480" y2="400" stroke="green" stroke-width="2"/>
<line x1="480" y1="400" x2="480" y2="500" stroke="green" stroke-width="2"/>
<line x1="480" y1="500" x2="80" y2="500" stroke="green" stroke-width="2"/>
<polygon name="value1" id="7777" points="170,300 190,300 170,340 190,340" fill="green" stroke="black" stroke-width="2"/>
	</svg>
					<?php include("footer.php")?>
					<?php include("comm.php")?>

</body>
</html>
