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
