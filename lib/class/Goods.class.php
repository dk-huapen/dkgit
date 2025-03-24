<?php
					include_once("Table.class.php");
class Goods extends dkTable{

	function __construct(){
		$this->conn = mysqli_connect('localhost','root','dk1314lich,forever!','db_rekong');
		if(!$this->conn){
			die("数据库连接失败". mysqli_connect_error());
		}else { 
		//echo"连接成功";
		}
		mysqli_query('set names utf8');
		$this->pagesize=10;
		$this->pageFunction = goodsPage;
		$this->tableHead = array("goods_id"=>"序号","goods_name"=>"名称","goods_modle"=>"规格型号","goods_main_parameters"=>"主要技术参数","management"=>"管理","path"=>"./","action"=>"content");
		$this->selectinfo = array("table"=>"tb_goods","id"=>"goods_id","caption"=>"备件列表","status"=>"goods_type","quick"=>"work_begain_time");
		$this->keyinfo = array("number"=>"goods_modle","content"=>"goods_name","remark"=>"goods_parameters");
		$this->sql = "select tb_goods.goods_id,tb_goods.goods_name,tb_goods.goods_modle,tb_goods.goods_main_parameters from tb_goods where ";
		$this->count_sql = "select count(*) from tb_goods where ";
		//$josn = json_encode($this->tableHead);
		//echo $josn;
	}
	public function retrievalBox(){//显示缺陷的检索栏
	echo "<fieldset>",
		"<legend style='border:1px'>检索选择</legend>",
		"<label><input type='checkbox' name='select_checkbox[goods_category]'value='select_goods_category'></input>备件种类</label>",
		"<select name='select_goods_category'style='width:20%'class='selectfont'>",
		"<option selected='selected' disabled='disabled'style='display: none' value=''></option>";
		$tb_goods_category_sql = "SELECT * FROM `tb_goods_category` WHERE 1";
		$tb_goods_category_result = mysqli_query($this->conn, $tb_goods_category_sql);
		while($tb_goods_category_arr=mysqli_fetch_assoc($tb_goods_category_result)){
			echo "<option value=".$tb_goods_category_arr['goods_category_id'].">".$tb_goods_category_arr['goods_category_name']."</option>";
		}
               	echo "</select>";
		echo "<label><input type='checkbox' name='select_checkbox[goods_type]'value='select_goods_type'></input>备件类型</label>";
		echo "<select name='select_goods_type' style='width:20%'class='selectfont'>";
		echo "<option selected='selected' disabled='disabled'  style='display: none' value=''></option>";
		$tb_goods_type_sql = "SELECT * FROM `tb_goods_type` WHERE 1";
		$tb_goods_type_result = mysqli_query($this->conn, $tb_goods_type_sql);
		while($tb_goods_type_arr=mysqli_fetch_assoc($tb_goods_type_result)){
			echo "<option value=".$tb_goods_type_arr['goods_type_id'].">".$tb_goods_type_arr['goods_type_name']."</option>";
		}
                                        echo "</select>";
		echo "<label><input type='checkbox' name='select_checkbox_key' value='select_key'>关键字</label><input type='text'style='width:20%' name='select_key' size='10'placeholder='名称/型号/参数'></input>",
		"<br>",
	"</fieldset>",
                        "<input type='submit'style='width:100%' value='搜索'></input>";
	}
	public function editGoods($goodsId){//生成编辑缺陷表单
		$tb_goods_sql = 'SELECT * FROM tb_goods WHERE goods_id='.$goodsId;
		$tb_goods_result = mysqli_query($this->conn, $tb_goods_sql);
		$tb_goods_arr=mysqli_fetch_assoc($tb_goods_result);
		echo "<fieldset id='fieldset' disabled='true'><legend style='border:1px'>".$tb_goods_arr['goods_id']."号备件<input onclick=\"lockBox(this,'fieldset')\" type='button'value='🔓'/></legend>";
			echo "<fieldset>";
				echo "<legend style='border:1px'>".$tb_goods_arr['goods_id']."号备件信息</legend>";
				echo "<input type='hidden' name='goods_id' value=".$tb_goods_arr['goods_id']."></input>";
				echo "<label>物品名称<input type='text' style='width:30%' name='goods_name' size='30' value='".$tb_goods_arr['goods_name']."'></input></label>";
				echo "<label>相关备件<input type='text'style='width:15%' name='goods_childs' size='30' value=".$tb_goods_arr['goods_childs']."></input></label>";
				echo "<label>物品种类";
					echo "<select name='goods_category'style='width:20%'  class='selectfont'>",
						"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>";
						$tb_goods_category_sql = "SELECT * FROM `tb_goods_category` WHERE 1";
						$tb_goods_category_result = mysqli_query($this->conn, $tb_goods_category_sql);
						while($tb_goods_category_arr=mysqli_fetch_assoc($tb_goods_category_result)){
							if($tb_goods_category_arr['goods_category_id']==$tb_goods_arr['goods_category']){
                						echo "<option value=".$tb_goods_category_arr['goods_category_id']." selected='selected'>".$tb_goods_category_arr['goods_category_name']."</option>";
							}else{
                						echo "<option value=".$tb_goods_category_arr['goods_category_id'].">".$tb_goods_category_arr['goods_category_name']."</option>";
							}
						}
                			echo "</select>",
				"</label><br>",
				"<label>物品型号<input type='text'style='width:30%' name='goods_modle' size='30' value='".$tb_goods_arr['goods_modle']."'></input></label>",
				"<label>相关资料<input type='text' style='width:15%' name='goods_remarks' size='30' value=".$tb_goods_arr['goods_remarks']."></input></label>",
				"<label>物品类型",
					"<select name='goods_type' style='width:20%'  class='selectfont'>",
						"<option selected='selected' disabled='disabled' style='display: none' value=''></option>";
						$tb_goods_type_sql = "SELECT * FROM `tb_goods_type` WHERE 1";
						$tb_goods_type_result = mysqli_query($this->conn, $tb_goods_type_sql);
						while($tb_goods_type_arr=mysqli_fetch_assoc($tb_goods_type_result)){
							if($tb_goods_type_arr['goods_type_id']==$tb_goods_arr['goods_type']){
                						echo "<option value=".$tb_goods_type_arr['goods_type_id']." selected='selected'>".$tb_goods_type_arr['goods_type_name']."</option>";
							}else{
                						echo "<option value=".$tb_goods_type_arr['goods_type_id'].">".$tb_goods_type_arr['goods_type_name']."</option>";
							}
						}
                			echo "</select>",
				"</label><br>",
				"<label>物品厂家<input type='text' style='width:30%' name='goods_manufacturers' size='30' value='".$tb_goods_arr['goods_manufacturers']."'></input></label>",
				"<label>备件价格<input type='text' style='width:15%' name='goods_price' size='30' value=".$tb_goods_arr['goods_price']."></input></label>",
				"<label>主要参数<input type='text' style='width:20%' name='goods_main_parameters' size='30' value='".$tb_goods_arr['goods_main_parameters']."'></input></label>",
			"</fieldset>",
			"<fieldset style='width:100%'>",
				"<legend style='border:1px'>".$tb_goods_arr['goods_id']."号备件具体技术参数和用途</legend>",
				"<textarea style='width:50%'rows='5' name='goods_parameters'>".$tb_goods_arr['goods_parameters']."</textarea>",
				"<textarea style='width:45%'rows='5' name='goods_use'>".$tb_goods_arr['goods_use']."</textarea>",
			"</fieldset>",
		"</fieldset>";
						return array($tb_goods_arr['goods_childs'],$tb_goods_arr['goods_remarks']);
	}
	public function lookGoods($goodsId){//查看缺陷表单
		if($goodsId>0){
			//echo $goodsId;
		$tb_goods_sql = "SELECT * FROM `tb_goods` WHERE `goods_id`=".$goodsId;
		$tb_goods_result = mysqli_query($this->conn, $tb_goods_sql);
		$tb_goods_arr=mysqli_fetch_assoc($tb_goods_result);
	echo '<fieldset>';
	echo "<legend style='border:1px'>".$tb_goods_arr['goods_id']."号备件</legend>";
	echo "<fieldset>";
	echo "<legend style='border:1px'>".$tb_goods_arr['goods_id']."号备件信息</legend>";
	echo "<input type='hidden' name='goods_id' value=".$tb_goods_arr['goods_id']."/>";
	echo "<label>";
	echo "物品名称<input type='text' readonly style='width:30%' size='30' value='".$tb_goods_arr['goods_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'/>";
	echo "</label>";
	echo "<label>";
	echo "相关备件<input type='text' readonly style='width:15%' size='30' value='".$tb_goods_arr['goods_childs']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' />";
	echo "</label>";
	echo "<label>物品种类";
//从tb_user数据库中取出所有用户信息,添加工作负责人下拉列表
	//	$tb_goods_category_sql = "SELECT * FROM `tb_goods_category` WHERE 1";
		$tb_goods_category_sql = "SELECT * FROM `tb_goods_category` WHERE `goods_category_id` =". $tb_goods_arr['goods_category'];
		$tb_goods_category_result = mysqli_query($this->conn, $tb_goods_category_sql);
		$tb_goods_category_arr=mysqli_fetch_assoc($tb_goods_category_result);
	echo "<input type='text' readonly style='width:20%' size='30' value='".$tb_goods_category_arr['goods_category_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'/>";
	echo '</label>';
	echo '<br>';
	echo '<label>';
	echo "物品型号<input type='text' readonly style='width:30%' value='".$tb_goods_arr['goods_modle']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' />";
	echo "</label>";
	echo "<label>";
	echo "相关资料<input type='text' readonly style='width:15%' value='".$tb_goods_arr['goods_remarks']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' />";
	echo "</label>";
	echo "<label>物品类型";
//从tb_user数据库中取出所有用户信息,添加工作负责人下拉列表
		$tb_goods_type_sql = "SELECT * FROM `tb_goods_type` WHERE `goods_type_id`=".$tb_goods_arr['goods_type'];
		$tb_goods_type_result = mysqli_query($this->conn, $tb_goods_type_sql);
		$tb_goods_type_arr=mysqli_fetch_assoc($tb_goods_type_result);
		echo "<input type='text' readonly style='width:20%' size='30' value='".$tb_goods_type_arr['goods_type_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' />";
	echo '</label>';
	echo '<br>';
	echo '<label>';
	echo "物品厂家<input type='text' readonly style='width:30%'  size='30' value='".$tb_goods_arr['goods_manufacturers']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' />";
	echo '</label>';
	echo '<label>';
	echo "备件价格<input type='text' readonly style='width:15%' size='30' value='".$tb_goods_arr['goods_price']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' />";
	echo '</label>';
	echo '<label>';
	echo "主要参数<input type='text' readonly style='width:20%' size='30' value='".$tb_goods_arr['goods_main_parameters']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' />";
	echo '</label>';
	echo '</fieldset>';
	echo "<fieldset style='width:100%'>";
	echo "<legend style='border:1px'>".$tb_goods_arr['goods_id']."号备件具体技术参数和用途</legend>";
	echo "<textarea style='width:50%' rows='5' readonly onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'>".$tb_goods_arr['goods_parameters']."</textarea>";
	echo "<textarea style='width:45%'rows='5' readonly onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black' >".$tb_goods_arr['goods_use']."</textarea>";
	echo "</fieldset>";
	echo "</fieldset>";
		}
						return array($tb_goods_arr['goods_childs'],$tb_goods_arr['goods_remarks']);
	}
	public function addGoods(){//生成新增备件表单
	echo "<fieldset>",
	"<legend style='border:1px'>添加新的备件信息</legend>",
	"<fieldset>",
	"<legend style='border:1px'>新增备件基本信息</legend>",
	"<label>物品名称<input type='text'style='width:30%'name='goods_name' size='30' value=''></input></label>",
	"<label>相关备件<input type='text'style='width:15%' name='goods_childs' size='30' value=''></input></label>",
	"<label>物品种类",
		"<select name='goods_category'style='width:20%' class='selectfont'>",
		"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>",
//从tb_user数据库中取出所有用户信息,添加工作负责人下拉列表
		$tb_goods_category_sql = "SELECT * FROM `tb_goods_category` WHERE 1";
		$tb_goods_category_result = mysqli_query($this->conn, $tb_goods_category_sql);
		while($tb_goods_category_arr=mysqli_fetch_assoc($tb_goods_category_result)){
                	echo "<option value=".$tb_goods_category_arr['goods_category_id'].">".$tb_goods_category_arr['goods_category_name']."</option>";
		}
                echo "</select>",
	"</label><br>",
	"<label>物品型号<input type='text'style='width:30%' name='goods_modle' size='30' value=''></input></label>",
	"<label>相关资料<input type='text'style='width:15%' name='goods_remarks' size='30' value=''></input></label>",
	"<label> 物品类型",
		"<select name='goods_type'style='width:20%' class='selectfont'>",
		"<option selected='selected' disabled='disabled' style='display: none' value=''></option>";
//从tb_user数据库中取出所有用户信息,添加工作负责人下拉列表
		$tb_goods_type_sql = "SELECT * FROM `tb_goods_type` WHERE 1";
		$tb_goods_type_result = mysqli_query($this->conn, $tb_goods_type_sql);
		while($tb_goods_type_arr=mysqli_fetch_assoc($tb_goods_type_result)){
                	echo "<option value=".$tb_goods_type_arr['goods_type_id'].">".$tb_goods_type_arr['goods_type_name']."</option>";
		}
                echo "</select>",
	"</label><br>",
	"<label>物品厂家<input type='text'style='width:30%' name='goods_manufacturers' size='30' value=''></input></label>",
	"<label>备件价格<input type='text'style='width:15%' name='goods_price' size='30' value=''></input></label>",
	"<label>主要参数<input type='text'style='width:20%' name='goods_main_parameters' size='30' value=''></input></label>",
	"</fieldset>",
	"<fieldset style='width:100%'>",
		"<legend style='border:1px'>新增备件具体技术参数和用途</legend>",
		"<textarea style='width:50%'rows='5' name='goods_parameters'></textarea>",
		"<textarea style='width:45%'rows='5' name='goods_use'></textarea>",
	"</fieldset>",
	"</fieldset>";
	}
}
?>

