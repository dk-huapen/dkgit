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
			$sql="SELECT kks,name,value,unit,updatetime,HH,H,HHH,L,LL,LLL,flag,indexID,X,Y FROM sis where page=3 or page1=3";
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
		<svg width="1880" height="1000" viewBox="0 0 1880 1000" fill="gray">
			<?php
				$locateX = 0;
				$locateY = 0;
				require 'fun.php';
			?>



<!--A层燃烧器----->
<rect x="20" y="20" width="400" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>
<!--B层燃烧器----->
<rect x="500" y="20" width="400" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>
<!--C层燃烧器----->
<rect x="980" y="20" width="400" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>
<!--D层燃烧器----->
<rect x="1460" y="20" width="400" height="100" fill="gray" stroke="balck" stroke-width="2"></rect>



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
