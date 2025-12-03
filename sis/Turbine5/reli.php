<html>
	<head>
    		<title>4号汽轮机本体</title>
		<?php include("../header.php")?>
	</head>
	<body>
		<?php include("top.php")?>
		<center><h1>4号汽轮机本体</h1></center>
		<script>
			var page = 321;
			var test =<?php
			include('../conn.php');
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle,indexID,X,Y FROM sis where page=321 union SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,angle1,indexID,X1,Y1 FROM sis where page1=321";
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


<line x1="1170" y1="30" x2="1700" y2="30" stroke="green" stroke-width="2"/><!---减温水管道-->
<line x1="1170" y1="30" x2="1170" y2="70" stroke="green" stroke-width="2"/><!---减温水管道-->
<polygon points='180,20,180,40,220,20,220,40' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='320,20,320,40,360,20,360,40' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='500,20,500,40,540,20,540,40' fill='white' stroke='black' stroke-width='2' ></polygon>

<line x1="425" y1="90" x2="425" y2="170" stroke="red" stroke-width="2"/><!---进口蒸汽旁路管道-->
<line x1="425" y1="90" x2="1750" y2="90" stroke="red" stroke-width="2"/>
<circle cx='1170' cy='90' r='20' fill='white' stroke='black' stroke-width='2'></circle>
<line x1="1750" y1="90" x2="1750" y2="420" stroke="red" stroke-width="2"/>
<line x1="1500" y1="420" x2="1750" y2="420" stroke="red" stroke-width="2"/>
<line x1="1500" y1="420" x2="1500" y2="560" stroke="red" stroke-width="2"/>
<line x1="1500" y1="560" x2="1590" y2="560" stroke="red" stroke-width="2"/>
<text x="1510" y="530" fill="black" font-size="20" font-family="Arial">二级旁路</text>
<circle cx='1550' cy='560' r='20' fill='white' stroke='black' stroke-width='2'></circle>

<text x="10" y="150" fill="black" font-size="20" font-family="Arial">5.0蒸汽</text>
<line x1="20" y1="170" x2="730" y2="170" stroke="red" stroke-width="3"/><!---5.0进口蒸汽主管道-->


<text x="125" y="201" fill="black" font-size="18" font-family="Arial">故障</text>
<line x1="50" y1="240" x2="210" y2="240" stroke="red" stroke-width="2"/>
<line x1="50" y1="170" x2="50" y2="240" stroke="red" stroke-width="2"/>
<line x1="210" y1="170" x2="210" y2="240" stroke="red" stroke-width="2"/>
<polygon points='70,230,70,250,110,230,110,250' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='150,230,150,250,190,230,190,250' fill='white' stroke='black' stroke-width='2' ></polygon>

<line x1="320" y1="170" x2="320" y2="320" stroke="red" stroke-width="2"/>
<polygon points='310,225,330,225,310,265,330,265' fill='white' stroke='black' stroke-width='2' ></polygon>
<line x1="250" y1="180" x2="250" y2="310" stroke="red" stroke-width="2"/>
<line x1="250" y1="180" x2="320" y2="180" stroke="red" stroke-width="2"/>
<line x1="250" y1="310" x2="320" y2="310" stroke="red" stroke-width="2"/>
<polygon points='240,195,260,195,240,235,260,235' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='240,255,260,255,240,295,260,295' fill='white' stroke='black' stroke-width='2' ></polygon>

<text x="10" y="290" fill="black" font-size="20" font-family="Arial">来至中压饱和蒸汽蒸汽</text>
<line x1="20" y1="320" x2="320" y2="320" stroke="red" stroke-width="3"/><!---2.8进口蒸汽主管道-->
<line x1="50" y1="390" x2="210" y2="390" stroke="red" stroke-width="2"/>
<line x1="50" y1="320" x2="50" y2="390" stroke="red" stroke-width="2"/>
<line x1="210" y1="320" x2="210" y2="390" stroke="red" stroke-width="2"/>
<polygon points='70,380,70,400,110,380,110,400' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='150,380,150,400,190,380,190,400' fill='white' stroke='black' stroke-width='2' ></polygon>

<rect x="430" y="150" width="70" height="140" fill="gray" stroke="black" stroke-width="1"></rect>
<rect x="450" y="155" width="30" height="125" fill="gray" stroke="white" stroke-width="1"></rect>
<text x="455" y="175" fill="black" font-size="20" font-family="Arial">疏</text>
<text x="455" y="200" fill="black" font-size="20" font-family="Arial">水</text>
<text x="455" y="225" fill="black" font-size="20" font-family="Arial">收</text>
<text x="455" y="250" fill="black" font-size="20" font-family="Arial">集</text>
<text x="455" y="275" fill="black" font-size="20" font-family="Arial">器</text>


<text x="595" y="201" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="555" y="271" fill="black" font-size="18" font-family="Arial">故障</text>
<line x1="520" y1="240" x2="680" y2="240" stroke="red" stroke-width="2"/>
<line x1="520" y1="170" x2="520" y2="240" stroke="red" stroke-width="2"/>
<line x1="680" y1="170" x2="680" y2="240" stroke="red" stroke-width="2"/>
<polygon points='620,230,620,250,660,230,660,250' fill='white' stroke='black' stroke-width='2' ></polygon>
<!--主汽阀----->
<rect x="730" y="150" width="50" height="85" fill="gray" stroke="black" stroke-width="1"></rect>
<rect x="740" y="155" width="30" height="75" fill="gray" stroke="white" stroke-width="1"></rect>
<text x="745" y="175" fill="black" font-size="20" font-family="Arial">主</text>
<text x="745" y="200" fill="black" font-size="20" font-family="Arial">汽</text>
<text x="745" y="225" fill="black" font-size="20" font-family="Arial">阀</text>

<line x1="780" y1="180" x2="1270" y2="180" stroke="red" stroke-width="2"/><!---主蒸汽阀后进口蒸汽主管道-->
<line x1="780" y1="200" x2="1270" y2="200" stroke="red" stroke-width="2"/>
<line x1="1270" y1="180" x2="1270" y2="200" stroke="red" stroke-width="2"/>



<!--均压箱----->
<rect x="740" y="380" width="200" height="80" fill="gray" stroke="black" stroke-width="1"></rect>
<text x="800" y="450" fill="black" font-size="20" font-family="Arial">均压箱</text>
<line x1="760" y1="460" x2="760" y2="570" stroke="green" stroke-width="2"/>
<line x1="830" y1="460" x2="830" y2="570" stroke="green" stroke-width="2"/>
<text x="650" y="530" fill="black" font-size="20" font-family="Arial">至排汽装置</text>

<!---汽封加热器---->
<rect x="430" y="670" width="170" height="70" fill="gray" stroke="black" stroke-width="1"></rect>
<text x="470" y="690" fill="black" font-size="20" font-family="Arial">汽封加热器</text>
<line x1="230" y1="580" x2="450" y2="580" stroke="red" stroke-width="2"/>
<polygon points='380,570,380,590,420,570,420,590' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='260,570,260,590,300,570,300,590' fill='white' stroke='black' stroke-width='2' ></polygon>
<line x1="230" y1="650" x2="450" y2="650" stroke="red" stroke-width="2"/>
<polygon points='380,640,380,660,420,640,420,660' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='260,640,260,660,300,640,300,660' fill='white' stroke='black' stroke-width='2' ></polygon>
<line x1="230" y1="650" x2="230" y2="530" stroke="red" stroke-width="2"/>
<line x1="450" y1="580" x2="450" y2="670" stroke="red" stroke-width="2"/>
<text x="255" y="555" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="255" y="685" fill="black" font-size="18" font-family="Arial">故障</text>

<line x1="450" y1="700" x2="450" y2="880" stroke="green" stroke-width="2"/>
<polygon points='440,820,460,820,440,860,460,860' fill='white' stroke='black' stroke-width='2' ></polygon>
<line x1="580" y1="700" x2="580" y2="880" stroke="green" stroke-width="2"/>
<polygon points='570,820,590,820,570,860,590,860' fill='white' stroke='black' stroke-width='2' ></polygon>





<!--抽汽母管----->
<line x1="20" y1="480" x2="1400" y2="480" stroke="red" stroke-width="3"/>

<line x1="350" y1="480" x2="350" y2="540" stroke="red" stroke-width="2"/>
<line x1="450" y1="480" x2="450" y2="540" stroke="red" stroke-width="2"/>
<line x1="350" y1="540" x2="450" y2="540" stroke="red" stroke-width="2"/>
<polygon points='380,530,380,550,420,530,420,550' fill='white' stroke='black' stroke-width='2' ></polygon>

<line x1="1360" y1="300" x2="1360" y2="480" stroke="red" stroke-width="2"/>
<line x1="1400" y1="300" x2="1400" y2="480" stroke="red" stroke-width="2"/>
<line x1="890" y1="480" x2="890" y2="580" stroke="green" stroke-width="2"/>
<polygon points='920,470,920,490,960,470,960,490' fill='white' stroke='black' stroke-width='2' ></polygon>
<text x="910" y="510" fill="black" font-size="18" font-family="Arial">速关阀</text>

<line x1="990" y1="200" x2="990" y2="580" stroke="green" stroke-width="2"/>

<line x1="1060" y1="150" x2="1060" y2="580" stroke="green" stroke-width="2"/>

<line x1="1250" y1="250" x2="1250" y2="400" stroke="green" stroke-width="2"/>
<line x1="1130" y1="400" x2="1250" y2="400" stroke="green" stroke-width="2"/>
<line x1="1130" y1="400" x2="1130" y2="580" stroke="green" stroke-width="2"/>


<line x1="1450" y1="440" x2="1450" y2="300" stroke="green" stroke-width="2"/>
<line x1="1200" y1="440" x2="1450" y2="440" stroke="green" stroke-width="2"/>
<line x1="1200" y1="440" x2="1200" y2="580" stroke="green" stroke-width="2"/>

<line x1="1300" y1="480" x2="1300" y2="580" stroke="green" stroke-width="2"/>
<polygon points='1230,470,1230,490,1270,470,1270,490' fill='white' stroke='black' stroke-width='2' ></polygon>
<text x="1220" y="510" fill="black" font-size="18" font-family="Arial">逆止阀</text>


<rect x="850" y="580" width="500" height="30" fill="gray" stroke="black" stroke-width="1"></rect>
<text x="1040" y="600" fill="black" font-size="20" font-family="Arial">疏水膨胀箱</text>

<line x1="1000" y1="630" x2="1590" y2="630" stroke="green" stroke-width="2"/>
<polygon points='1100,620,1100,640,1140,620,1140,640' fill='white' stroke='black' stroke-width='2' ></polygon>
<text x="900" y="635" fill="black" font-size="20" font-family="Arial">去地沟</text>

<line x1="750" y1="650" x2="1590" y2="650" stroke="green" stroke-width="2"/>
<line x1="750" y1="650" x2="750" y2="740" stroke="green" stroke-width="2"/>
<line x1="690" y1="740" x2="750" y2="740" stroke="green" stroke-width="2"/>
<line x1="600" y1="720" x2="680" y2="720" stroke="green" stroke-width="2"/>

<polygon points='740,670,760,670,740,710,760,710' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='620,710,620,730,660,710,660,730' fill='white' stroke='black' stroke-width='2' ></polygon>
<rect x="680" y="705" width="10" height="40" fill="gray" stroke="black" stroke-width="1"></rect>

<line x1="1050" y1="670" x2="1590" y2="670" stroke="green" stroke-width="2"/>
<line x1="1050" y1="670" x2="1050" y2="800" stroke="green" stroke-width="2"/>
<line x1="200" y1="800" x2="1050" y2="800" stroke="green" stroke-width="2"/>
<line x1="200" y1="750" x2="200" y2="880" stroke="green" stroke-width="2"/>
<line x1="30" y1="750" x2="200" y2="750" stroke="green" stroke-width="2"/>
<text x="50" y="710" fill="black" font-size="20" font-family="Arial">至凝结水系统</text>

<line x1="790" y1="740" x2="790" y2="800" stroke="green" stroke-width="2"/>
<line x1="990" y1="740" x2="990" y2="800" stroke="green" stroke-width="2"/>
<line x1="790" y1="740" x2="990" y2="740" stroke="green" stroke-width="2"/>
<polygon points='870,730,870,750,910,730,910,750' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='810,790,810,810,850,790,850,810' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='930,790,930,810,970,790,970,810' fill='white' stroke='black' stroke-width='2' ></polygon>
<!---汽轮机本体---->
<rect x="1150" y="255" width="500" height="10" fill="gray" stroke="black" stroke-width="1"></rect>

<rect x="1215" y="150" width="25" height="90" fill="gray" stroke="black" stroke-width="1"></rect>
<polygon points='1215,230 1580,180 1580,340 1215,290'fill='gray' stroke='black' stroke-width='1'></polygon>
<text x="1355" y="275" fill="black" font-size="20" font-family="Arial">汽轮机</text>
<!--排汽装置----->
<text x="1680" y="475" fill="black" font-size="17" font-family="Arial">排汽装置真空低</text>
<rect x="1590" y="550" width="110" height="140" fill="gray" stroke="black" stroke-width="1"></rect>
<text x="1600" y="590" fill="black" font-size="20" font-family="Arial">排汽装置</text>
<polygon points='1610,510,1680,510,1700,550,1590,550' fill='gray' stroke='black' stroke-width='2' ></polygon>
<rect x="1610" y="485" width="70" height="22" fill="gray" stroke="black" stroke-width="1"></rect>


<line x1="1850" y1="310" x2="1850" y2="910" stroke="red" stroke-width="2"/>


<line x1="1620" y1="690" x2="1620" y2="880" stroke="green" stroke-width="2"/>
<!--1号凝结水泵y=240----->
<line x1="1150" y1="750" x2="1620" y2="750" stroke="green" stroke-width="2"/>
<polygon points='1550,740,1550,760,1590,740,1590,760' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='1410,740,1410,760,1450,740,1450,760' fill='white' stroke='black' stroke-width='2' ></polygon>
<text x="1465" y="695" fill="black" font-size="18" font-family="Arial">1号凝泵</text>
<text x="1495" y="721" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="1195" y="786" fill="black" font-size="18" font-family="Arial">故障</text>
<rect x="1455" y="775" width="110" height="37" fill="none" stroke="black" stroke-width="1"></rect>
<text x="1460" y="790" fill="black" font-size="18" font-family="Arial">SP</text>
<text x="1460" y="810" fill="black" font-size="18" font-family="Arial">FB</text>
<!--2号凝结水泵----->
<line x1="200" y1="880" x2="1620" y2="880" stroke="green" stroke-width="2"/>
<polygon points='495,870,495,890,535,870,535,890' fill='white' stroke='black' stroke-width='2' ></polygon><!---凝结水泵母管出口手动门--->

<polygon points='1550,870,1550,890,1590,870,1590,890' fill='white' stroke='black' stroke-width='2' ></polygon>
<polygon points='1410,870,1410,890,1450,870,1450,890' fill='white' stroke='black' stroke-width='2' ></polygon>
<text x="1465" y="950" fill="black" font-size="18" font-family="Arial">2号凝泵</text>
<text x="1495" y="925" fill="black" font-size="18" font-family="Arial">故障</text>
<text x="1195" y="917" fill="black" font-size="18" font-family="Arial">故障</text>
<rect x="1455" y="820" width="110" height="37" fill="none" stroke="black" stroke-width="1"></rect>
<text x="1460" y="835" fill="black" font-size="18" font-family="Arial">SP</text>
<text x="1460" y="855" fill="black" font-size="18" font-family="Arial">FB</text>
<!--凝结水泵出口母管----->
<line x1="1150" y1="750" x2="1150" y2="880" stroke="green" stroke-width="2"/>
<line x1="1000" y1="920" x2="1130" y2="920" stroke="green" stroke-width="2"/>
<line x1="1000" y1="880" x2="1000" y2="920" stroke="green" stroke-width="2"/>
<polygon points='1040,910,1040,930,1080,910,1080,930' fill='white' stroke='black' stroke-width='2' ></polygon>
<text x="990" y="950" fill="black" font-size="20" font-family="Arial">作真空密封用水</text>







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
