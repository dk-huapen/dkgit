<html>
<head>
<title>2024年7月份碳核查测点历史数据查询</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript"src="dygraph.js"></script>
<link rel="stylesheet" type="text/css"src="dygraph.css" />
</head>
<body>
<div class="card">
		<style>
			.dygraph-legend {text-align:right;} 
			.dygraph-legend > span.highlight {border:1px solid red;}
		</style>
					<div id="graphdiv" style="width:800px;height:400px;"></div>
<fieldset>
<p><label><b>开始时间:</b></label><input type="datetime-local" id="begin_time" value="" width="5"><label><b>结束时间:</b></label><input type="datetime-local" id="end_time" value="" width="5"></p>
<p><button id="plot">查询</button>
<b>下限:</b><input type='text' id='yzero' value='0' width='5'>
<b>上限:</b><input type='text' id='yspan' value='0' width='5'>
			<button id="last">上一页</button><button id="next">下一页</button>
</fieldset>
				</div>
<script type="text/javascript">
var responseText = <?php
$con = mysqli_connect('localhost','phpmyadmin','phpmyadmin','buff');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT Htime,value FROM 40HBK10CP001";

$result = mysqli_query($con,$sql);

$outp = mysqli_fetch_all($result,MYSQLI_NUM);

mysqli_close($con);
echo json_encode($outp);
?>;
//jsJSON=JSON.parse(responseText);
alert(responseText[0][0]);
alert(responseText.length);
let d = new Array(responseText.length);
	for (let i=0;i<responseText.length;i++){
		d[i] = new Array(2);
				d[i][0]=0;
				d[i][1]=0;
	}
	for(var k=0;k<responseText.length;k++){
		d[k][0] = new Date(responseText[k][0]);
		for(var g=1;g <= 1;g++){
		d[k][g] = parseFloat(responseText[k][g]);
		}
	}
Dygraph.onDOMready(function onDOMready() {

  g = new Dygraph(

    // containing div
	  document.getElementById("graphdiv"),d,{
		resizable:"both",//整个窗口缩放:sp
		rollPeriod:1,//曲线平滑度,不能大太，太大容易失真
		title:'MySQL OPCdb',	//标题  
		labels:["date","test2"],
		stackedGraph:false,
		//series:series,
		valueRange:[yzero,yspan],
		highlightCircleSize:2,//选择曲线高亮显示
		strokeWidth:1,
		strokeBorderWidth:null,
		highlightSeriesOpts:{//标签名外的方框,配合dygraph-legend > span.highlight {border:1px solid red;}使用
			strokeWidth:3,
			strokeBorderWidth:1,
			highlightCircleSize:5
		}
}


  );
});
</script>
</body>
</html>
