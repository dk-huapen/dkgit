<?php
					include_once("Table.class.php");
class Point extends dkTable{

	function __construct(){
		$this->conn = mysqli_connect('localhost','root','dk1314lich,forever!','db_rekong');
		if(!$this->conn){
			die("数据库连接失败". mysqli_connect_error());
		}else { 
		//echo"连接成功";
		}
		mysqli_query('set names utf8');
		$this->pagesize=10;
		$this->pageFunction = PointPage;
		$this->tableHead = array("point_number"=>"序号","point_kks"=>"KKS","point_description"=>"点描述","point_type"=>"I/O类型","point_cabinet"=>"机柜编号","point_slot"=>"槽位号","module_type"=>"卡件型号","point_channel"=>"通道号","point_terminal"=>"端子组","terminal_a"=>"端","terminal_b"=>"子","terminal_c"=>"号","management"=>"管理","path"=>"./","action"=>"content");
		$this->selectinfo = array("table"=>"tb_point_table","id"=>"point_number","caption"=>"测点清单","status"=>"goods_type","quick"=>"work_begain_time");
		$this->keyinfo = array("number"=>"point_kks","content"=>"point_description","remark"=>"goods_parameters");
		//$this->sql = "select tb_goods.goods_id,tb_goods.goods_name,tb_goods.goods_modle,tb_goods.goods_main_parameters from tb_goods where ";
		//$this->count_sql = "select count(*) from tb_goods where ";
//		$this->sql = 'SELECT * FROM tb_point_table WHERE ';
		$this->sql = 'SELECT point_number,point_kks,point_description,point_type,point_cabinet,point_slot,module_type,point_channel,point_terminal,terminal_a,terminal_b,terminal_c FROM tb_point_table WHERE ';
		$this->count_sql = "select count(*) from tb_point_table where ";
	}
	public function retrievalBox(){//显示缺陷的检索栏
		echo "<fieldset>",
		"<legend style='border:1px'>检索选择</legend>",

		"<label><input type='checkbox' name='select_point[point_kks]' value='select_point_kks'></input>编码</label>",
		"<input type='text'style='width:25%' name='select_point_kks' size='10'></input>",

		"<label><input type='checkbox' name='select_point[point_cabinet]' value='select_point_cabinet'></input>机柜号</label>",
		"<input type='text'style='width:15%' name='select_point_cabinet' size='1'></input>",

		"<label><input type='checkbox' name='select_point[point_type]' value='select_point_type'></input>类型</label>",
		"<input type='text'style='width:15%' name='select_point_type' size='15'></input>",
		"<br>",
		"<label><input type='checkbox' name='select_point[point_description]' value='select_point_description'></input>名称</label>",
		"<input type='text'style='width:25%' name='select_point_description' size='15'></input>",
		"<label><input type='checkbox' name='select_point[point_slot]' value='select_point_slot'></input>槽位号</label>",
		"<input type='text'style='width:15%' name='select_point_slot' size='10'></input>",
		"<label><input type='checkbox' name='select_point[module_type]' value='select_module_type'></input>卡件</label>",
		"<input type='text'style='width:15%' name='select_module_type' size='15'></input>",
		"<br>",
		"<label><input type='checkbox' name='select_point[point_remark]' value='select_point_remark'>备注</input></label>",
		"<input type='text'style='width:25%' name='select_point_remark' size='1'></input>",
		"<label><input type='checkbox' name='select_point[point_terminal]' value='select_point_terminal'></input>端子组</label>",
		"<input type='text'style='width:15%' name='select_point_terminal' size='1'></input>",
		"<label><input type='checkbox' name='select_point_n[point_channel]' value='select_point_channel'></input>通道</label>",
		"<input type='text'style='width:15%' name='select_point_channel' size='15'></input>",
		"<br>",
		"</fieldset>",
                "<input type='submit'style='width:100%' value='搜索'></input>";
	}
	public function retrievalResult(){//检索栏检索结果
		$select_defect_str = $this->sql;
		$count_str = $this->count_sql;
		$str=' ';
		$str1=' order by '.$this->selectinfo['id'].' desc limit 0,'.$this->pagesize;
	//************************************************************************************
		$arr=$_POST['select_point_n'];
		foreach($arr as $key=>$value){
		$str.= $key.'='.$_POST[$value];
		$str.=" AND ";
		}
		$arr=$_POST['select_point'];
		foreach($arr as $key=>$value){
		//$str.= $key.' LIKE '.'"%'.$_POST[$value].'%"';
		$str.= $key.' LIKE '.'\'%'.$_POST[$value].'%\'';
		$str.=" AND ";
		}
		$str=chop($str," AND ");
		$tb_defect_sql=$select_defect_str.$str;
		$tb_count_sql=$count_str.$str;
	//************************************************************
        	$re = mysqli_query($this->conn,$tb_count_sql);
        	$result = mysqli_fetch_row($re);
        	$num = $result[0];
		$this->num=$num;
		$sql = $tb_defect_sql.$str1;
		//echo $sql;
		$result = mysqli_query($this->conn, $sql);
		$this->result=$result;
		$pageSql=$tb_defect_sql.' order by '.$this->selectinfo['id'].' desc limit ';
		$this->pageSql = $pageSql;
	//echo $this->pageSql;
		$this->tbodyId = "tbodyId";
		$this->sqlId = "sqlId";
		$this->showTable();
		if($this->num > $this->pagesize){
			$json = json_encode($this->tableHead);
			$page_obj = new Page($this->num,$this->pagesize,$this->sqlId,$this->tbodyId,$this->pageFunction,$json);
		//	echo "test";
			$page_obj->showPage();
		}
	}
	public function editPoint($id){//生成编辑缺陷表单
		$tb_point_table_sql = 'SELECT * FROM tb_point_table WHERE point_number='.$id;
		$tb_point_table_result = mysqli_query($this->conn, $tb_point_table_sql);
		$tb_point_table_arr=mysqli_fetch_assoc($tb_point_table_result);
	echo "<fieldset id='fieldset1' disabled='true'>",
		"<legend style='border:1px'>".$tb_point_table_arr['point_number']."号测点基本信息<input onclick=\"lockBox(this,'fieldset1')\" type='button'value='🔓'></input></legend>",
		"<input type='hidden' name='point_number' value=".$tb_point_table_arr['point_number']."></input>",
		"<label>测点编码<input type='text'style='width:20%' name='point_kks' size='15' value=".$tb_point_table_arr['point_kks']."></input></label>",
		"<label>测点类型<input type='text'style='width:15%' name='point_type' size='10' value=".$tb_point_table_arr['point_type']."></input></label>",
		"<label>机柜号<input type='text'style='width:15%' name='point_cabinet' size='10' value=".$tb_point_table_arr['point_cabinet']."></input></label>",
		"<label>量程下限<input type='text'style='width:10%' name='point_rangelo' size='10' value=".$tb_point_table_arr['point_rangelo']."></input></label>",
		"<br>",
		"<label>测点名称<input type='text'style='width:20%' name='point_description' size='15' value=".$tb_point_table_arr['point_description']."></input></label>",
		"<label>卡见型号<input type='text'style='width:15%' name='module_type' size='10' value=".$tb_point_table_arr['module_type']."></input></label>",
		"<label>槽位号<input type='text'style='width:15%' name='point_slot' size='10' value=".$tb_point_table_arr['point_slot']."></input></label>",
		"<label>量程上限<input type='text'style='width:10%' name='point_rangehi' size='10' value=".$tb_point_table_arr['point_rangehi']."></input></label>",
		"<br>",
		"<label>控制系统<input type='text'style='width:20%' name='point_sys' size='10' value=".$tb_point_table_arr['point_sys']."></input></label>",
		"<label>电气特性<input type='text'style='width:15%' name='point_spec' size='10' value=".$tb_point_table_arr['point_spec']."></input></label>",
		"<label>通道号<input type='text' style='width:15%'name='point_channel' size='10' value=".$tb_point_table_arr['point_channel']."></input></label>",
		"<label>工艺单位<input type='text' style='width:10%'name='point_unit' size='10' value=".$tb_point_table_arr['point_unit']."></input></label>",
		"<br>",
		"<label>工艺图号<input type='text'style='width:20%' name='point_p_id' size='10' value=".$tb_point_table_arr['point_p_id']."></input></label>",
		"<label>供电电压<input type='text'style='width:15%' name='point_pwr' size='10' value=".$tb_point_table_arr['point_pwr']."></input></label>",
		"<label>继电器<input type='text'style='width:15%' name='point_relay' size='10' value=".$tb_point_table_arr['point_relay']."></input></label>",
		"<label>端子组号<input type='text'style='width:10%' name='point_terminal' size='10' value=".$tb_point_table_arr['point_terminal']."></input></label>",
		"<br>",
		"<label>典型回路<input type='text'style='width:20%' name='point_loop' size='10' value=".$tb_point_table_arr['point_loop']."></input></label>",
		"<label>端子编号<input type='text'style='width:10%'name='terminal_a' size='1' value=".$tb_point_table_arr['terminal_a']."></input> <input type='text'style='width:10%' name='terminal_b' size='1' value=".$tb_point_table_arr['terminal_b']."></input> <input type='text'style='width:10%' name='terminal_c' size='1' value=".$tb_point_table_arr['terminal_c']."></input></label>",
		"</fieldset>",
	"<fieldset id='fieldset2' disabled='true'>",
		"<legend style='border:1px'>".$tb_point_table_arr['point_number']."号测点日志<input onclick=\"lockBox(this,'fieldset2')\" type='button'value='🔓'></legend>",
		"<label>低<input type='text'style='width:10%' name='point_l' size='10' value=".$tb_point_table_arr['L_LMT']."></input></label>",
		"<label>低低<input type='text'style='width:10%' name='point_ll' size='10' value=".$tb_point_table_arr['LL_LMT']."></input></label>",
		"<label>低低低<input type='text'style='width:10%' name='point_lll' size='10' value=".$tb_point_table_arr['LLL_LMT']."></input></label>",
		"<br>",
		"<label>高<input type='text'style='width:10%' name='point_h' size='10' value=".$tb_point_table_arr['H_LMT']."></input></label>",
		"<label>高高<input type='text'style='width:10%' name='point_hh' size='10' value=".$tb_point_table_arr['HH_LMT']."></input></label>",
		"<label>高高高<input type='text'style='width:10%' name='point_hhh' size='10' value=".$tb_point_table_arr['HHH_LMT']."></input></label>",
		"<label>备注<input type='text'style='width:40%' name='point_remark' size='10' value=".$tb_point_table_arr['point_remark']."></input></label>",
		"<textarea style='width:100%'disabled='disabled' name ='point_logs' id='textarea'rows='6'>".$tb_point_table_arr['point_logs']."</textarea>",
	"</fieldset>";
	}
	public function lookPoint($id){//生成编辑缺陷表单
		$tb_point_table_sql = 'SELECT * FROM tb_point_table WHERE point_number='.$id;
		$tb_point_table_result = mysqli_query($this->conn, $tb_point_table_sql);
		$tb_point_table_arr=mysqli_fetch_assoc($tb_point_table_result);
	echo "<fieldset>",
		"<legend style='border:1px'>".$tb_point_table_arr['point_number']."号测点基本信息</legend>",
		"<input type='hidden' name='point_number' value=".$tb_point_table_arr['point_number']."></input>",
		"<label>测点编码<input type='text' readonly style='width:20%' name='point_kks' size='15' value='".$tb_point_table_arr['point_kks']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>测点类型<input type='text' readonly style='width:15%' name='point_type' size='10' value='".$tb_point_table_arr['point_type']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>机柜号<input type='text' readonly style='width:15%' name='point_cabinet' size='10' value='".$tb_point_table_arr['point_cabinet']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>量程下限<input type='text' readonly style='width:10%' name='point_rangelo' size='10' value='".$tb_point_table_arr['point_rangelo']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<br>",
		"<label>测点名称<input type='text' readonly style='width:20%' name='point_description' size='15' value='".$tb_point_table_arr['point_description']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>卡见型号<input type='text' readonly style='width:15%' name='module_type' size='10' value='".$tb_point_table_arr['module_type']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>槽位号<input type='text' readonly style='width:15%' name='point_slot' size='10' value='".$tb_point_table_arr['point_slot']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>量程上限<input type='text' readonly style='width:10%' name='point_rangehi' size='10' value='".$tb_point_table_arr['point_rangehi']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<br>",
		"<label>控制系统<input type='text' readonly style='width:20%' name='point_sys' size='10' value='".$tb_point_table_arr['point_sys']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>电气特性<input type='text' readonly style='width:15%' name='point_spec' size='10' value='".$tb_point_table_arr['point_spec']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>通道号<input type='text' readonly  style='width:15%'name='point_channel' size='10' value='".$tb_point_table_arr['point_channel']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>工艺单位<input type='text' readonly  style='width:10%'name='point_unit' size='10' value='".$tb_point_table_arr['point_unit']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<br>",
		"<label>工艺图号<input type='text' readonly style='width:20%' name='point_p_id' size='10' value='".$tb_point_table_arr['point_p_id']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>供电电压<input type='text' readonly style='width:15%' name='point_pwr' size='10' value='".$tb_point_table_arr['point_pwr']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>继电器<input type='text' readonly style='width:15%' name='point_relay' size='10' value='".$tb_point_table_arr['point_relay']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>端子组号<input type='text' readonly style='width:10%' name='point_terminal' size='10' value='".$tb_point_table_arr['point_terminal']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<br>",
		"<label>典型回路<input type='text' readonly style='width:20%' name='point_loop' size='10' value='".$tb_point_table_arr['point_loop']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>端子编号<input type='text' readonly style='width:10%'name='terminal_a' size='1' value='".$tb_point_table_arr['terminal_a']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input> <input type='text' readonly style='width:10%' name='terminal_b' size='1' value='".$tb_point_table_arr['terminal_b']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input> <input type='text' readonly style='width:10%' name='terminal_c' size='1' value='".$tb_point_table_arr['terminal_c']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"</fieldset>",
	"<fieldset>",
		"<legend style='border:1px'>".$tb_point_table_arr['point_number']."号测点日志</legend>",
		"<label>低<input type='text' readonly style='width:10%' name='point_l' size='10' value='".$tb_point_table_arr['L_LMT']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>低低<input type='text' readonly style='width:10%' name='point_ll' size='10' value='".$tb_point_table_arr['LL_LMT']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>低低低<input type='text' readonly style='width:10%' name='point_lll' size='10' value='".$tb_point_table_arr['LLL_LMT']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<br>",
		"<label>高<input type='text' readonly style='width:10%' name='point_h' size='10' value='".$tb_point_table_arr['H_LMT']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>高高<input type='text' readonly style='width:10%' name='point_hh' size='10' value='".$tb_point_table_arr['HH_LMT']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>高高高<input type='text' readonly style='width:10%' name='point_hhh' size='10' value='".$tb_point_table_arr['HHH_LMT']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<label>备注<input type='text' readonly style='width:40%' name='point_lll' size='10' value='".$tb_point_table_arr['point_remark']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"<textarea style='width:100%' name ='point_remark' id='textarea'rows='6' readonly onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'>".$tb_point_table_arr['point_logs']."</textarea>",
	"</fieldset>";
	}
	public function showSlot($strSlot){//生成编辑缺陷表单
		$this->tableHead = array("point_number"=>"序号","point_kks"=>"KKS","point_description"=>"点描述","point_type"=>"I/O类型","point_cabinet"=>"机柜编号","point_slot"=>"槽位号","module_type"=>"卡件型号","point_channel"=>"通道号","point_terminal"=>"端子组","terminal_a"=>"端","terminal_b"=>"子","terminal_c"=>"号","management"=>"无","action"=>"content");
		$count_sql = $this->count_sql."(point_slot LIKE ";
		$count_sql.= '"%'.$strSlot.'%"'.')';
        	$re = mysqli_query($this->conn,$count_sql);
        	$result = mysqli_fetch_row($re);
        	$num = $result[0];
		$this->num=$num;
		$str = $this->sql."(point_slot LIKE ";
		$str.= '"%'.$strSlot.'%"'.')';
		$sql = $str.' order by '.$this->selectinfo['id'].' asc limit 0,'.$this->pagesize;
        	$result = mysqli_query($this->conn,$sql);
		$this->result = $result;
		$pageSql = $str.' order by '.$this->selectinfo['id'].' asc limit ';
		$this->pageSql = $pageSql;
		$this->tbodyId = "tbodyId".$status;
		$this->sqlId = "sqlId".$status;
		$this->showTable();
		if($this->num > $this->pagesize){
			$json = json_encode($this->tableHead);
			//echo $json;
			$page_obj = new Page($this->num,$this->pagesize,$this->sqlId,$this->tbodyId,$this->pageFunction,$json);
			$page_obj->showPage();
		}

	}
	public function showKKS($strKKS){//生成编辑缺陷表单
		$this->tableHead = array("point_number"=>"序号","point_kks"=>"KKS","point_description"=>"点描述","point_type"=>"I/O类型","point_cabinet"=>"机柜编号","point_slot"=>"槽位号","module_type"=>"卡件型号","point_channel"=>"通道号","point_terminal"=>"端子组","terminal_a"=>"端","terminal_b"=>"子","terminal_c"=>"号","management"=>"无","action"=>"content");
		$count_sql = $this->count_sql."(point_kks LIKE ";
		$count_sql.= '"%'.$strKKS.'%"'.')';
        	$re = mysqli_query($this->conn,$count_sql);
        	$result = mysqli_fetch_row($re);
        	$num = $result[0];
		$this->num=$num;
		$str = $this->sql."(point_kks LIKE ";
		$str.= '"%'.$strKKS.'%"'.')';
		$sql = $str.' order by '.$this->selectinfo['id'].' desc limit 0,'.$this->pagesize;
        	$result = mysqli_query($this->conn,$sql);
		$this->result = $result;
		$pageSql = $str.' order by '.$this->selectinfo['id'].' desc limit ';
		$this->pageSql = $pageSql;
		$this->tbodyId = "tbodyId".$status;
		$this->sqlId = "sqlId".$status;
		$this->showTable();
		if($this->num > $this->pagesize){
			$json = json_encode($this->tableHead);
			//echo $json;
			$page_obj = new Page($this->num,$this->pagesize,$this->sqlId,$this->tbodyId,$this->pageFunction,$json);
			$page_obj->showPage();
		}

	}
	public function ShowProtectPointTable(){//生成编辑缺陷表单
		$this->tableHead = array("flag2"=>"序号","point_kks"=>"KKS","point_description"=>"点描述","point_type"=>"I/O类型","point_unit"=>"单位","L_LMT"=>"低I值","LL_LMT"=>"低II值","LLL_LMT"=>"低III值","H_LMT"=>"高I值","HH_LMT"=>"高II值","HHH_LMT"=>"高III值","point_remark"=>"备注","management"=>"无","action"=>"content");
		$count_sql = "select count(*) from ProtectPointTable where 1";
        	$re = mysqli_query($this->conn,$count_sql);
        	$result = mysqli_fetch_row($re);
        	$num = $result[0];
		$this->num=$num;
		$str = 'SELECT * FROM ProtectPointTable WHERE 1';
		$sql = $str.' limit 0,'.$this->pagesize;
        	$result = mysqli_query($this->conn,$sql);
		$this->result = $result;
		$pageSql = $str.' limit ';
		$this->pageSql = $pageSql;
		$this->tbodyId = "tbodyId".$status;
		$this->sqlId = "sqlId".$status;
		$this->showTable();
		if($this->num > $this->pagesize){
			$json = json_encode($this->tableHead);
			//echo $json;
			$page_obj = new Page($this->num,$this->pagesize,$this->sqlId,$this->tbodyId,$this->pageFunction,$json);
			$page_obj->showPage();
		}

	}
}

