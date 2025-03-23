<?php
					include_once("Table.class.php");
class Workticket extends dkTable{

	function __construct(){
		$this->conn = mysqli_connect('localhost','root','dk1314lich,forever!','db_rekong');
		if(!$this->conn){
			die("数据库连接失败". mysqli_connect_error());
		}else { 
		//echo"连接成功";
		}
		mysqli_query('set names utf8');
		$this->pagesize=5;
		$this->pageFunction = workticketPage;
		$this->tableHead = array("work_ticket_id"=>"序号","work_ticket_number"=>"工作票号","work_ticket_content"=>"工作内容","work_begain_header"=>"负责人","work_begain_time"=>"许可时间","work_ticket_status"=>"状态","management"=>"管理","path"=>"./","action"=>"content");
		$this->selectinfo = array("table"=>"tb_work_ticket","id"=>"work_ticket_id","caption"=>"工作票列表","status"=>"work_ticket_status","quick"=>"work_begain_time");
		$this->keyinfo = array("number"=>"work_ticket_number","content"=>"work_ticket_content","remark"=>"work_ticket_remarks");
		$this->sql = "SELECT work_ticket_id,work_ticket_number,work_ticket_content,(SELECT tb_user.user_name FROM tb_user WHERE tb_user.user_id = work_begain_header) AS work_begain_header,work_begain_time,(SELECT tb_work_ticket_status.work_ticket_status_name FROM tb_work_ticket_status WHERE tb_work_ticket_status.work_ticket_status_id = work_ticket_status) AS work_ticket_status FROM `tb_work_ticket` WHERE ";
		$this->count_sql = "select count(*) from tb_work_ticket where ";
		//$josn = json_encode($this->tableHead);
		//echo $josn;
	}
	public function retrievalBox(){//显示缺陷的检索栏
	echo "<fieldset>",
		"<legend style='border:1px'>检索选择</legend>",
		"<label><input type='checkbox' name='select_checkbox[work_ticket_status]' value='select_work_ticket_status'></input>工作票状态</label>",
		"<select name='select_work_ticket_status' style='width:20%' class='selectfont'>",
			"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>";
			$tb_work_ticket_status_sql = "SELECT * FROM `tb_work_ticket_status` WHERE 1";
			$tb_work_ticket_status_result = mysqli_query($this->conn, $tb_work_ticket_status_sql);
			while($tb_work_ticket_status_arr=mysqli_fetch_assoc($tb_work_ticket_status_result)){
                		echo "<option value=".$tb_work_ticket_status_arr['work_ticket_status_id'].">".$tb_work_ticket_status_arr['work_ticket_status_name']."</option>";
			}
                echo "</select>";
		echo "<label><input type='checkbox' name='select_checkbox[work_type]'value='select_work_type'></input>工作类型</label>",
		"<select name='select_work_type'style='width:15%' class='selectfont'>",
			"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>";
			$tb_work_type_sql = "SELECT * FROM `tb_work_type` WHERE 1";
			$tb_work_type_result = mysqli_query($this->conn, $tb_work_type_sql);
			while($tb_work_type_arr=mysqli_fetch_assoc($tb_work_type_result)){
                		echo "<option value=".$tb_work_type_arr['work_type_id'].">".$tb_work_type_arr['work_type_name']."</option>";
			}
                echo "</select>";
		echo "<label><input type='checkbox' name='select_checkbox[work_end_header]'value='select_work_end_header'></input>负责人</label> ",
		"<select name='select_work_end_header' style='width:20%' class='selectfont'>",
			"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>";
			$tb_user_sql = "SELECT * FROM `tb_user` WHERE 1";
			$tb_user_result = mysqli_query($this->conn, $tb_user_sql);
			while($tb_user_arr=mysqli_fetch_assoc($tb_user_result)){
                       		echo "<option value=".$tb_user_arr['user_id'].">".$tb_user_arr['user_name']."</option>";
			}
            	echo "</select>";
		echo "<br>";
		echo "<label><input type='checkbox' name='select_checkbox[work_ticket_type]'value='select_work_ticket_type'></input>工作票类型</label>",
		"<select name='select_work_ticket_type'style='width:20%' class='selectfont'>",
			"<option value='0'>--请选择--</option>";
			$tb_work_ticket_system_sql = "SELECT * FROM `tb_work_ticket_type` WHERE 1";
			$tb_work_ticket_system_result = mysqli_query($this->conn, $tb_work_ticket_system_sql);
			while($tb_work_ticket_system_arr=mysqli_fetch_assoc($tb_work_ticket_system_result)){
                		echo "<option value=".$tb_work_ticket_system_arr['work_ticket_type_id'].">".$tb_work_ticket_system_arr['work_ticket_type_name']."</option>";
			}
                echo "</select>",
		"<label><input type='checkbox' name='select_checkbox[work_ticket_specialty]'value='select_work_ticket_specialty'></input>所属专业</label>",
		"<select name='select_work_ticket_specialty'style='width:15%' class='selectfont'>",
			"<option value='0'>--请选择--</option>";
			$tb_work_ticket_type_sql = "SELECT * FROM `tb_specialty` WHERE 1";
			$tb_work_ticket_type_result = mysqli_query($this->conn, $tb_work_ticket_type_sql);
			while($tb_work_ticket_type_arr=mysqli_fetch_assoc($tb_work_ticket_type_result)){
                	echo "<option value=".$tb_work_ticket_type_arr['specialty_id'].">".$tb_work_ticket_type_arr['specialty_name']."</option>";
			}
                echo "</select>",
		"<label><input type='checkbox' name='select_checkbox_key' value='select_key'>关键字</label>",
		"<input type='text'style='width:20%' name='select_key' size='10'></input>",
	"</fieldset>",
                                        "<input type='submit'style='width:100%' value='搜索'></input>";
	}
	public function addWorkTicket(){
				echo "<fieldset>",
				"<legend style='border:1px'>检索选择</legend>",
					"<label>工作票编号 <input type='text'style='width:15%' name='work_ticket_number' size='10' value='".$tb_work_ticket_arr['work_ticket_number']."'></input></label>",
					"<label>工作票内容<input type='text'style='width:40%' name='work_ticket_content' size='50' value='".$tb_work_ticket_arr['work_ticket_content']."'></input></label>",
					"<br>",
					"<label> 工作负责人",
						"<select name='work_begain_header'style='width:15%' class='selectfont'>",
							"<option value='-1'>--请选择--</option>";
							$tb_begain_user_sql = "SELECT * FROM `tb_user` WHERE 1";
							$tb_begain_user_result = mysqli_query($this->conn, $tb_begain_user_sql);
							while($tb_begain_user_arr=mysqli_fetch_assoc($tb_begain_user_result)){
								if($tb_begain_user_arr['user_id']==$tb_work_ticket_arr['work_begain_header']){
                							echo "<option value=".$tb_begain_user_arr['user_id']." selected='selected'>".$tb_begain_user_arr['user_name']."</option>";
								}else{
                							echo "<option value=".$tb_begain_user_arr['user_id'].">".$tb_begain_user_arr['user_name']."</option>";
								}
							}
                				echo "</select>",
					"</label>",
					"<label>许可人<input type='text'style='width:15%' name='work_begain_people' size='5' value=".$tb_work_ticket_arr['work_begain_people']."></input></label>",
					"<label>许可时间<input type='text'style='width:20%' name='work_begain_time' size='10' value=".$tb_work_ticket_arr['work_begain_time']."></input></label>",
					"</fieldset>",
				"<fieldset>",
					"<label>工作票类型",
						"<select name='work_ticket_type'style='width:20%' class='selectfont'>",
							"<option value='0'>--请选择--</option>",
							$tb_work_ticket_type_sql = "SELECT * FROM `tb_work_ticket_type` WHERE 1";
							$tb_work_ticket_type_result = mysqli_query($this->conn, $tb_work_ticket_type_sql);
							while($tb_work_ticket_type_arr=mysqli_fetch_assoc($tb_work_ticket_type_result)){
								if($tb_work_ticket_type_arr['work_ticket_type_id']==$tb_work_ticket_arr['work_ticket_type']){
                						echo "<option value=".$tb_work_ticket_type_arr['work_ticket_type_id']." selected='selected'>".$tb_work_ticket_type_arr['work_ticket_type_name']."</option>";
								}else{
                						echo "<option value=".$tb_work_ticket_type_arr['work_ticket_type_id'].">".$tb_work_ticket_type_arr['work_ticket_type_name']."</option>";
								}
							}
                				echo "</select>",
					"<label>所属专业",
						"<select name='work_ticket_specialty'style='width:20%' class='selectfont'>",
							"<option value='0'>--请选择--</option>",
							$tb_work_ticket_specialty_sql = "SELECT * FROM `tb_specialty` WHERE 1";
							$tb_work_ticket_specialty_result = mysqli_query($this->conn, $tb_work_ticket_specialty_sql);
							while($tb_work_ticket_specialty_arr=mysqli_fetch_assoc($tb_work_ticket_specialty_result)){
								if($tb_work_ticket_specialty_arr['specialty_id']==$tb_work_ticket_arr['work_ticket_specialty']){
                						echo "<option value=".$tb_work_ticket_specialty_arr['specialty_id']." selected='selected'>".$tb_work_ticket_specialty_arr['specialty_name']."</option>";
								}else{
                					echo "<option value=".$tb_work_ticket_specialty_arr['specialty_id'].">".$tb_work_ticket_specialty_arr['specialty_name']."</option>";
								}
							}
                					echo "</select>",
					"</label>",
"<label>工作日期",
"<select name='diary_id'style='width:20%' class='selectfont'>",
"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>",
		$tb_diary_sql = "SELECT * FROM `tb_diary` WHERE 1 order by diary_id desc limit 0,90";
		$tb_diary_result = mysqli_query($this->conn, $tb_diary_sql);
		while($tb_diary_arr=mysqli_fetch_assoc($tb_diary_result)){
		if($tb_diary_arr['diary_id']==$tb_work_ticket_arr['diary_id']){
                                        echo "<option value=".$tb_diary_arr['diary_id']." selected='selected'>".$tb_diary_arr['createtime']."</option>";
}else{
                                        echo "<option value=".$tb_diary_arr['diary_id'].">".$tb_diary_arr['createtime']."</option>";
	}
	}
                                        echo "</select>",
"</label>",
				"<br>",
					"<label>工作票状态",
						"<select name='work_ticket_status'style='width:20%' class='selectfont'>",
							"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>";
							$tb_work_ticket_status_sql = "SELECT * FROM `tb_work_ticket_status` WHERE 1";
							$tb_work_ticket_status_result = mysqli_query($this->conn, $tb_work_ticket_status_sql);
							while($tb_work_ticket_status_arr=mysqli_fetch_assoc($tb_work_ticket_status_result)){
								if($tb_work_ticket_status_arr['work_ticket_status_id']==$tb_work_ticket_arr['work_ticket_status']){
                							echo "<option value=".$tb_work_ticket_status_arr['work_ticket_status_id']." selected='selected'>".$tb_work_ticket_status_arr['work_ticket_status_name']."</option>";
								}else{
                							echo "<option value=".$tb_work_ticket_status_arr['work_ticket_status_id'].">".$tb_work_ticket_status_arr['work_ticket_status_name']."</option>";
								}
							}
                				echo "</select>",
					"</label>",
					"<label>工作类型",
						"<select name='work_type'style='width:20%' class='selectfont'>",
						"<option selected='selected' disabled='disabled' style='display: none' value=''></option>",
						$tb_work_type_sql = "SELECT * FROM `tb_work_type` WHERE 1";
						$tb_work_type_result = mysqli_query($this->conn, $tb_work_type_sql);
						while($tb_work_type_arr=mysqli_fetch_assoc($tb_work_type_result)){
							if($tb_work_type_arr['work_type_id']==$tb_work_ticket_arr['work_type']){
                					echo "<option value=".$tb_work_type_arr['work_type_id']." selected='selected'>".$tb_work_type_arr['work_type_name']."</option>";
							}else{
                					echo "<option value=".$tb_work_type_arr['work_type_id'].">".$tb_work_type_arr['work_type_name']."</option>";
							}
						}
                				echo "</select>",
					"</label>",
					"<label>到期时间<input type='text' style='width:20%' name='work_delay_time' size='10' value=".$tb_work_ticket_arr['work_delay_time']."></input></label>",
	"</fieldset>";
	}
	public function editWorkTicket($id){
		$tb_work_ticket_sql = 'SELECT * FROM tb_work_ticket WHERE work_ticket_id='.$id;
		$tb_work_ticket_result = mysqli_query($this->conn, $tb_work_ticket_sql);
		$tb_work_ticket_arr=mysqli_fetch_assoc($tb_work_ticket_result);
		echo "<fieldset id='fieldset1'disabled='true'>",
			"<legend style='border:1px'>许可工作票<input onclick=\"lockBox(this,'fieldset1')\" type='button'value='🔓'/></input></legend>",
			"<input type='hidden' name='work_ticket_id' size='3' value=".$tb_work_ticket_arr['work_ticket_id']."></input>",
			"<label>工作票编号<input type='text'style='width:15%' name='work_ticket_number' size='10' value=".$tb_work_ticket_arr['work_ticket_number']."></input></label>",
			"<label>工作票内容<input type='text'style='width:40%' name='work_ticket_content' size='50' value=".$tb_work_ticket_arr['work_ticket_content']."></input></label>",
			"<br>",
			"<label>开始负责人",
				"<select name='work_begain_header'style='width:15%' width='500' class='selectfont'>",
					"<option value='-1'>--请选择--</option>";
					$tb_begain_user_sql = "SELECT * FROM `tb_user` WHERE 1";
					$tb_begain_user_result = mysqli_query($this->conn, $tb_begain_user_sql);
					while($tb_begain_user_arr=mysqli_fetch_assoc($tb_begain_user_result)){
						if($tb_begain_user_arr['user_id']==$tb_work_ticket_arr['work_begain_header']){
                					echo "<option value=".$tb_begain_user_arr['user_id']." selected='selected'>".$tb_begain_user_arr['user_name']."</option>";
						}else{
                					echo "<option value=".$tb_begain_user_arr['user_id'].">".$tb_begain_user_arr['user_name']."</option>";
						}
					}
                		echo "</select>",
			"</label>",
			"<label>许可人<input type='text'style='width:15%' name='work_begain_people' size='5' value=".$tb_work_ticket_arr['work_begain_people']."></input></label>",
			"<label>许可时间<input type='text'style='width:20%' name='work_begain_time' size='16' value='".$tb_work_ticket_arr['work_begain_time']."'></input></label>",
		"</fieldset>",
		"<fieldset id='fieldset2'disabled='true'>",
			"<legend style='border:1px'>编辑工作票<input onclick=\"lockBox(this,'fieldset2')\" type='button'value='🔓'></input></legend>",
			"<label>工作票类型",
				"<select name='work_ticket_type'style='width:20%' class='selectfont'>",
					"<option value='0'>--请选择--</option>",
					$tb_work_ticket_type_sql = "SELECT * FROM `tb_work_ticket_type` WHERE 1";
					$tb_work_ticket_type_result = mysqli_query($this->conn, $tb_work_ticket_type_sql);
					while($tb_work_ticket_type_arr=mysqli_fetch_assoc($tb_work_ticket_type_result)){
						if($tb_work_ticket_type_arr['work_ticket_type_id']==$tb_work_ticket_arr['work_ticket_type']){
               						echo "<option value=".$tb_work_ticket_type_arr['work_ticket_type_id']." selected='selected'>".$tb_work_ticket_type_arr['work_ticket_type_name']."</option>";
						}else{
                					echo "<option value=".$tb_work_ticket_type_arr['work_ticket_type_id'].">".$tb_work_ticket_type_arr['work_ticket_type_name']."</option>";
						}
					}
                		echo "</select>",
			"</label>",
			"<label>所属专业",
				"<select name='work_ticket_specialty'style='width:20%' class='selectfont'>",
					"<option value='0'>--请选择--</option>",
						$tb_work_ticket_specialty_sql = "SELECT * FROM `tb_specialty` WHERE 1";
						$tb_work_ticket_specialty_result = mysqli_query($this->conn, $tb_work_ticket_specialty_sql);
						while($tb_work_ticket_specialty_arr=mysqli_fetch_assoc($tb_work_ticket_specialty_result)){
							if($tb_work_ticket_specialty_arr['specialty_id']==$tb_work_ticket_arr['work_ticket_specialty']){
                						echo "<option value=".$tb_work_ticket_specialty_arr['specialty_id']." selected='selected'>".$tb_work_ticket_specialty_arr['specialty_name']."</option>";
							}else{
                						echo "<option value=".$tb_work_ticket_specialty_arr['specialty_id'].">".$tb_work_ticket_specialty_arr['specialty_name']."</option>";
							}
						}
                		echo "</select>",
			"</label>",
			"<label>到期时间:<input type='text'style='width:20%' name='work_delay_time' size='10' value='".$tb_work_ticket_arr['work_delay_time']."'></input></label>",
			"<br>",
			"<label>工作票状态",
				"<select name='work_ticket_status'style='width:20%' class='selectfont'>",
					"<option selected='selected' disabled='disabled' style='display: none' value=''></option>";
					$tb_work_ticket_status_sql = "SELECT * FROM `tb_work_ticket_status` WHERE 1";
					$tb_work_ticket_status_result = mysqli_query($this->conn, $tb_work_ticket_status_sql);
					while($tb_work_ticket_status_arr=mysqli_fetch_assoc($tb_work_ticket_status_result)){
						if($tb_work_ticket_status_arr['work_ticket_status_id']==$tb_work_ticket_arr['work_ticket_status']){
                					echo "<option value=".$tb_work_ticket_status_arr['work_ticket_status_id']." selected='selected'>".$tb_work_ticket_status_arr['work_ticket_status_name']."</option>";
						}else{
                					echo "<option value=".$tb_work_ticket_status_arr['work_ticket_status_id'].">".$tb_work_ticket_status_arr['work_ticket_status_name']."</option>";
						}
					}
                		echo "</select>",
			"</label>",
			"<label>工作类型",
				"<select name='work_type'style='width:20%' class='selectfont'>",
					"<option selected='selected' disabled='disabled' style='display: none' value=''></option>";
					$tb_work_type_sql = "SELECT * FROM `tb_work_type` WHERE 1";
					$tb_work_type_result = mysqli_query($this->conn, $tb_work_type_sql);
					while($tb_work_type_arr=mysqli_fetch_assoc($tb_work_type_result)){
						if($tb_work_type_arr['work_type_id']==$tb_work_ticket_arr['work_type']){
                					echo "<option value=".$tb_work_type_arr['work_type_id']." selected='selected'>".$tb_work_type_arr['work_type_name']."</option>";
						}else{
                					echo "<option value=".$tb_work_type_arr['work_type_id'].">".$tb_work_type_arr['work_type_name']."</option>";
						}
					}
                		echo "</select>",
			"</label>",
			"<label>终结时间<input type='text'style='width:20%' name='work_end_time' size='10' value='".$tb_work_ticket_arr['work_end_time']."'></input></label>",
			"<br>",
			"<label>结束负责人",
				"<select name='work_end_header'style='width:20%' class='selectfont'>",
					"<option value='-1'>--请选择--</option>";
					$tb_end_user_sql = "SELECT * FROM `tb_user` WHERE 1";
					$tb_end_user_result = mysqli_query($this->conn, $tb_end_user_sql);
					while($tb_end_user_arr=mysqli_fetch_assoc($tb_end_user_result)){
						if($tb_end_user_arr['user_id']==$tb_work_ticket_arr['work_end_header']){
                					echo "<option value=".$tb_end_user_arr['user_id']." selected='selected'>".$tb_end_user_arr['user_name']."</option>";
						}else{
                					echo "<option value=".$tb_end_user_arr['user_id'].">".$tb_end_user_arr['user_name']."</option>";
						}
					}
                		echo "</select>",
			"</label>",
			"<label>工作日期",
				"<select name='diary_id'style='width:20%' class='selectfont'>",
					"<option selected='selected' disabled='disabled'  style='display: none' value=''></option>",
					$tb_diary_sql = "SELECT * FROM `tb_diary` WHERE 1 order by diary_id desc";
					$tb_diary_result = mysqli_query($this->conn, $tb_diary_sql);
					while($tb_diary_arr=mysqli_fetch_assoc($tb_diary_result)){
						if($tb_diary_arr['diary_id']==$tb_work_ticket_arr['diary_id']){
                                        		echo "<option value=".$tb_diary_arr['diary_id']." selected='selected'>".$tb_diary_arr['createtime']."</option>";
						}else{
                                        		echo "<option value=".$tb_diary_arr['diary_id'].">".$tb_diary_arr['createtime']."</option>";
						}
					}
                              	echo "</select>",
			"</label>",
			"<label>工作票终结人<input type='text'style='width:15%' name='work_end_people' size='8' value=".$tb_work_ticket_arr['work_end_people']."></input></label>",
		"</fieldset>",
		"<fieldset id='fieldset3'disabled='true'>",
			"<legend style='border:1px'>检修交代<input onclick=\"lockBox(this,'fieldset3')\" type='button'value='🔓'></input></legend>",
			"<textarea rows='5'style='width:100%' name='work_ticket_remarks'>".$tb_work_ticket_arr['work_ticket_remarks']."</textarea>",
		"</fieldset>";
		return $tb_work_ticket_arr["work_ticket_number"];
	}
	public function lookWorkTicket($id){
		$tb_work_ticket_sql = 'SELECT * FROM tb_work_ticket WHERE work_ticket_id='.$id;
		$tb_work_ticket_result = mysqli_query($this->conn, $tb_work_ticket_sql);
		$tb_work_ticket_arr=mysqli_fetch_assoc($tb_work_ticket_result);
		echo "<fieldset>",
			"<legend style='border:1px'>查看".$id."号工作票</legend>",
			"<input type='hidden' name='work_ticket_id' size='3' value=".$tb_work_ticket_arr['work_ticket_id']."></input>",
			"<label>工作票编号<input type='text' readonly style='width:15%' size='10' value='".$tb_work_ticket_arr['work_ticket_number']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<label>工作票内容<input type='text' readonly style='width:40%'  size='50' value='".$tb_work_ticket_arr['work_ticket_content']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<br>";
					$tb_begain_user_sql = "SELECT * FROM `tb_user` WHERE user_id =".$tb_work_ticket_arr['work_begain_header'];
					$tb_begain_user_result = mysqli_query($this->conn, $tb_begain_user_sql);
					$tb_begain_user_arr=mysqli_fetch_assoc($tb_begain_user_result);
			echo "<label>开始负责人<input type='text' readonly style='width:15%'  size='50' value='".$tb_begain_user_arr['user_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<label>许可人<input type='text' readonly style='width:15%' name='work_begain_people' size='5' value='".$tb_work_ticket_arr['work_begain_people']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<label>许可时间<input type='text' readonly style='width:20%' name='work_begain_time' size='10' value='".$tb_work_ticket_arr['work_begain_time']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"</fieldset>",
		"<fieldset>",
			"<legend style='border:1px'>编辑工作票</legend>";
					$tb_work_ticket_type_sql = "SELECT * FROM `tb_work_ticket_type` WHERE work_ticket_type_id =".$tb_work_ticket_arr['work_ticket_type'];
					$tb_work_ticket_type_result = mysqli_query($this->conn, $tb_work_ticket_type_sql);
					$tb_work_ticket_type_arr=mysqli_fetch_assoc($tb_work_ticket_type_result);
			echo "<label>工作票类型<input type='text' readonly style='width:20%' name='work_begain_time' size='10' value='".$tb_work_ticket_type_arr['work_ticket_type_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>";
						$tb_work_ticket_specialty_sql = "SELECT * FROM `tb_specialty` WHERE specialty_id =".$tb_work_ticket_arr['work_ticket_specialty'];
						$tb_work_ticket_specialty_result = mysqli_query($this->conn, $tb_work_ticket_specialty_sql);
						$tb_work_ticket_specialty_arr=mysqli_fetch_assoc($tb_work_ticket_specialty_result);
			echo "<label>所属专业<input type='text' readonly style='width:20%' size='10' value='".$tb_work_ticket_specialty_arr['specialty_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<label>到期时间:<input type='text' readonly style='width:20%' size='10' value='".$tb_work_ticket_arr['work_delay_time']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<br>";
					$tb_work_ticket_status_sql = "SELECT * FROM `tb_work_ticket_status` WHERE work_ticket_status_id =".$tb_work_ticket_arr['work_ticket_status'];
					$tb_work_ticket_status_result = mysqli_query($this->conn, $tb_work_ticket_status_sql);
					$tb_work_ticket_status_arr=mysqli_fetch_assoc($tb_work_ticket_status_result);
			echo "<label>工作票状态<input type='text' readonly style='width:20%' size='10' value='".$tb_work_ticket_status_arr['work_ticket_status_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>";
					$tb_work_type_sql = "SELECT * FROM `tb_work_type` WHERE work_type_id =".$tb_work_ticket_arr['work_type'];
					$tb_work_type_result = mysqli_query($this->conn, $tb_work_type_sql);
					$tb_work_type_arr=mysqli_fetch_assoc($tb_work_type_result);
			echo "<label>工作类型<input type='text' readonly style='width:20%' size='10' value='".$tb_work_type_arr['work_type_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<label>终结时间<input type='text' readonly style='width:20%' size='10' value='".$tb_work_ticket_arr['work_end_time']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<br>";
					$tb_end_user_sql = "SELECT * FROM `tb_user` WHERE user_id =".$tb_work_ticket_arr['work_end_header'];
					$tb_end_user_result = mysqli_query($this->conn, $tb_end_user_sql);
					$tb_end_user_arr=mysqli_fetch_assoc($tb_end_user_result);
			echo "<label>结束负责人<input type='text' readonly style='width:20%' size='10' value='".$tb_end_user_arr['user_name']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>";
					$tb_diary_sql = "SELECT * FROM `tb_diary` WHERE diary_id =".$tb_work_ticket_arr['diary_id'];
					$tb_diary_result = mysqli_query($this->conn, $tb_diary_sql);
					$tb_diary_arr=mysqli_fetch_assoc($tb_diary_result);
			echo "<label>工作日期<input type='text' readonly style='width:20%' size='10' value='".$tb_diary_arr['createtime']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
			"<label>工作票终结人<input type='text' readonly style='width:15%' size='8' value='".$tb_work_ticket_arr['work_end_people']."' onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'></input></label>",
		"</fieldset>",
		"<fieldset>",
			"<legend style='border:1px'>检修交代</legend>",
			"<textarea rows='5' readonly style='width:100%'  onmouseover=\"this.style.borderColor='black';this.style.backgroundColor='plum'\" onmouseout=\"this.style.borderColor='black';this.style.backgroundColor='#ffffff'\" style='border-width:1px;border-color=black'>".$tb_work_ticket_arr['work_ticket_remarks']."</textarea>",
		"</fieldset>";
		return $tb_work_ticket_arr["work_ticket_number"];
	}
	public function showDiary($diaryId){//显示Id为LedgerId的工作记录
		//$this->tableHead = array("job_id"=>"编号","job_content"=>"内容","job_header_name"=>"工作负责人","job_people"=>"成员","job_status"=>"状态","management"=>"管理","path"=>"./job/","action"=>"content");
		$this->tableHead = array("work_ticket_id"=>"序号","work_ticket_number"=>"工作票号","work_ticket_content"=>"工作内容","work_begain_header"=>"负责人","work_begain_time"=>"许可时间","work_ticket_status"=>"状态","management"=>"管理","path"=>"../../management/work_ticket/","action"=>"content");
		$count_sql = $this->count_sql."diary_id = ".$diaryId;
        	$re = mysqli_query($this->conn,$count_sql);
        	$result = mysqli_fetch_row($re);
        	$num = $result[0];
		$this->num=$num;
		$str = $this->sql."diary_id = ".$diaryId;
		$sql = $str.' order by '.$this->selectinfo['id'].' desc limit 0,'.$this->pagesize;
        	$result = mysqli_query($this->conn,$sql);
		$this->result = $result;
		$pageSql = $str.' order by '.$this->selectinfo['id'].' desc limit ';
		$this->pageSql = $pageSql;
		$this->tbodyId = "tbodyId".$status;
		$this->sqlId = "sqlId".$status;
		if($this->num > 0){
			$this->showTable();
		}else{
			echo "目前无新增工作票！";
		}
		if($this->num > $this->pagesize){
			$json = json_encode($this->tableHead);
			//echo $json;
			$page_obj = new Page($this->num,$this->pagesize,$this->sqlId,$this->tbodyId,$this->pageFunction,$json);
			$page_obj->showPage();
		}

	}
}
?>

