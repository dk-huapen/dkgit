<html>
	<head>
		<title>增加待采购备件</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="stylesheet" type="text/css" href="../../diary_css/my_diary.css" />
	</head>
	<body>
<!------------------------------------------------------------------------------表单验证-------------------------------------------------------------------------------->
		<?php
		if ($_SERVER["REQUEST_METHOD"] == "POST"){
	include_once('../../lib/conn.php');
//获取add_job.php传递过来的数据
	$part_id = $_POST["part_id"]; 
	$part_declare_serial = $_POST["part_declare_serial"]; 
	$part_declare_number = $_POST["part_declare_number"]; 
	$part_need_time = $_POST["part_need_time"]; 
	$part_remarks = $_POST["part_remarks"]; 
	$part_declare_people = $_POST["part_declare_people"]; 
	$part_system = $_POST["part_system"]; 
	/******************************************************/
	$part_source = 1; //点击申报备件后直接将待申报备件修改为待采购备件也就直接将它从待申报清单中删除了
	$part_status = 1; 
	/******************************************************/
	//$part_declare_time = $_POST["part_declare_time"]; 
	//$goods_id = $_POST["goods_id"]; 
	$part_come_time = "0000-00-00"; 
	$part_check_people = "-1"; 
	$part_price = "-1"; 
	$part_come_number = "-1"; 
	$part_check_time = "0000-00-00"; 


	$sql = "UPDATE tb_sparepart SET part_system='".$part_system."',part_declare_serial='".$part_declare_serial."',part_declare_people='".$part_declare_people."',part_remarks='".$part_remarks."',part_need_time='".$part_need_time."',part_declare_number='".$part_declare_number."',part_status='".$part_status."',part_source='".$part_source."' WHERE part_id=".$part_id;
	echo $sql;
	if(mysqli_query($conn,$sql)){
	//	echo "插入成功";	
	mysqli_close($conn);
                        echo "<script>alert('添加成功！！');location='record.php'</script>";
	}else{
                echo "<script>alert('添加失败！！');</script>";
		echo "插入失败:". mysqli_error($conn);
	mysqli_close($conn);
	}
	
		}
		?>
<!-------------------------------------------------------------------------------------------------------------------------------------------------------------->
		<div class="header">
			<h1>热控班组管理平台</h1>
		</div>
		<div class="topnav">
			<?php include("../../lib/look_goods.php") ?>
			<?php include("../../lib/topnav/topnav.php") ?>
		</div>
		<div class="row">
			<div class="leftcolumn">
				<div class="card">
					<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<?php
						include_once("../../lib/class/Purchase.class.php");
						$purchase_obj = new Purchase;
						$goods_id = $purchase_obj->add_purchase_list($_GET['id']);
						?>
                                        	<input type="submit"style='width:100%' value="保存"></input>
					</form>
				</div>
				<div class="card">
					<?php
					include_once("../../lib/class/Goods.class.php");
					$goods_obj = new Goods;
					$goods_obj->lookGoods($goods_id);
					?>
				</div>
			</div>
			<div class="rightcolumn">
				<div class="card">
					<ul class="right">
						<li><a class="active" href='#'>备件清单</a></li>
						<li><a href='../inventory/inventory.php'>库存清单</a></li>
						<li><a href='../record/purchase_record.php'>采购计划</a></li>
						<li><a href='../record/record.php'>记录清单</a></li>
						<li><a href="add_content.php">新增物品</a></li>
					</ul>
				</div>
				<div class="card">
					<?php include("../../sidebar/quick_index.php") ?>
				</div>
				<div class="card">
				<!--最新通知-->
					<?php include("../../sidebar/notice.php")?>
				</div>
				<div class="card">
				<!--最新资讯-->
					<?php include("../../sidebar/news.php")?>
				</div>
			</div>
		</div>
		<div class="footer">
			<?php include("../../lib/footer/footer.php")?>
		</div>
</body>
</html>
