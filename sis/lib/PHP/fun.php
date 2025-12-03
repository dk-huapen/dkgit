<?php
//模拟量
	function dkAI($kks){
					global $pointArray;
					global $locateX;
					global $locateY;
				$index = $pointArray[$kks][0];
				$name = $pointArray[$kks][1];
				$x = $pointArray[$kks][2];
				$y = $pointArray[$kks][3];
				echo "<text id = ".$kks." x=".($locateX+$x)." y=".($locateY+$y)."  fill='black' font-size='18' font-family='Arial' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)>999</text>";
				}
//单反馈的开关量
				function dkDI($kks){
					global $pointArray;
					global $locateX;
					global $locateY;
				$index = $pointArray[$kks][0];
				$name = $pointArray[$kks][1];
				$x = $pointArray[$kks][2];
				$y = $pointArray[$kks][3];
				$toward = $pointArray[$kks][5];
				$angle = $pointArray[$kks][6];
				if($toward == 0){//正方形矩形
					echo "<rect id = ".$kks." x=".($locateX+$x-10)." y=".($locateY+$y-10)." width='20' height='20' rx='5' ry='5' fill='gray' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></rect>";
				}
				if($toward == 1){//圆形
					echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='10' fill='gray' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
				}
				if($toward == 10){//单反馈M大电机
					echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='20' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
					echo "<text x=".($locateX+$x-12)." y=".($locateY+$y+9)." fill='black' font-size='30' font-family='Arial'>M</text>";
				}
				if($toward == 11){//单反馈M小电机
					echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='15' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
					echo "<text x=".($locateX+$x-8)." y=".($locateY+$y+6)." fill='black' font-size='18' font-family='Arial'>M</text>";
				}
				if($toward == 20){//单反馈泵
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='20' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
					echo "<polygon points='".($locateX+$x-5).",".($locateY+$y).",".($locateX+$x-10).",".($locateY+$y).",".($locateX+$x).",".($locateY+$y-14).",".($locateX+$x+10).",".($locateY+$y).",".($locateX+$x+5).",".($locateY+$y).",".($locateX+$x+5).",".($locateY+$y+12).",".($locateX+$x-5).",".($locateY+$y+12)."' fill='white' fill-opacity='0' stroke='black' stroke-width='2'></polygon>";
					echo "</g>";
				}
				if($toward == 30){//单反馈气动开关门矩形
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<rect x=".($locateX+$x-7)." y=".($locateY+$y-24)." width='14' height='14' fill='white' stroke='black' stroke-width='1'></rect>";

					//echo "<text x=".($locateX+$x-6)." y=".($locateY+$y-14)." fill='black' font-size='15' font-family='Arial'>M</text>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-10)." x2=".($locateX+$x)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
				echo "<polygon id = ".$kks." points='".($locateX+$x-20).",".($locateY+$y-10).",".($locateX+$x-20).",".($locateY+$y+10).",".($locateX+$x+20).",".($locateY+$y-10).",".($locateX+$x+20).",".($locateY+$y+10)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
					echo "</g>";
				}
				}
				function dkValue($kks){//开关双反馈开关量
					global $pointArray;
					global $locateX;
					global $locateY;
				$index = $pointArray[$kks][0];
				$name = $pointArray[$kks][1];
				$x = $pointArray[$kks][2];
				$y = $pointArray[$kks][3];
				$toward = $pointArray[$kks][5];
				$angle = $pointArray[$kks][6];
				if($toward == 0){//电动门圆圈M
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<circle cx=".($locateX+$x)." cy=".($locateY+$y-19)." r='9' fill='white' stroke='black' stroke-width='1'></circle>";

					echo "<text x=".($locateX+$x-6)." y=".($locateY+$y-14)." fill='black' font-size='15' font-family='Arial'>M</text>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-10)." x2=".($locateX+$x)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
				echo "<polygon id = ".$kks." points='".($locateX+$x-20).",".($locateY+$y-10).",".($locateX+$x-20).",".($locateY+$y+10).",".($locateX+$x+20).",".($locateY+$y-10).",".($locateX+$x+20).",".($locateY+$y+10)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
					echo "</g>";
				}
				if($toward == 1){//气动开关门矩形
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<rect x=".($locateX+$x-7)." y=".($locateY+$y-24)." width='14' height='14' fill='white' stroke='black' stroke-width='1'></rect>";

					//echo "<text x=".($locateX+$x-6)." y=".($locateY+$y-14)." fill='black' font-size='15' font-family='Arial'>M</text>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-10)." x2=".($locateX+$x)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
				echo "<polygon id = ".$kks." points='".($locateX+$x-20).",".($locateY+$y-10).",".($locateX+$x-20).",".($locateY+$y+10).",".($locateX+$x+20).",".($locateY+$y-10).",".($locateX+$x+20).",".($locateY+$y+10)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
					echo "</g>";
				}
				if($toward == 2){//气动调节门半圆形
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
					//echo "<rect x=".($locateX+$x-7)." y=".($locateY+$y-24)." width='14' height='14' fill='white' stroke='black' stroke-width='1'></rect>";
					echo "<path d='M ".($locateX+$x-9)." ".($locateY+$y-19)." A 9 9 0 1 1 ".($locateX+$x+9)." ".($locateY+$y-19)."z' fill='white' stroke='black' stroke-width='1'></path>";

					//echo "<text x=".($locateX+$x-6)." y=".($locateY+$y-14)." fill='black' font-size='15' font-family='Arial'>M</text>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-19)." x2=".($locateX+$x)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
				echo "<polygon id = ".$kks." points='".($locateX+$x-20).",".($locateY+$y-10).",".($locateX+$x-20).",".($locateY+$y+10).",".($locateX+$x+20).",".($locateY+$y-10).",".($locateX+$x+20).",".($locateY+$y+10)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
					echo "</g>";
				}
				if($toward == 10){//双反馈电机风机
					//echo "<g transform='rotate(-45 ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
				echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='30' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
					echo "<line x1=".($locateX+$x-30)." y1=".($locateY+$y)." x2=".($locateX+$x+30)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-30)." x2=".($locateX+$x)." y2=".($locateY+$y+30)." stroke='black' stroke-width='2'/>";
					echo "</g>";
				}
				if($toward == 20){//双反馈M电机
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='20' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
					echo "<text x=".($locateX+$x-12)." y=".($locateY+$y+9)." fill='black' font-size='30' font-family='Arial'>M</text>";
					echo "</g>";
				}
				if($toward == 30){//双反馈泵
					echo "<g transform='rotate(".$angle." ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='20' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
					echo "<polygon points='".($locateX+$x-5).",".($locateY+$y).",".($locateX+$x-10).",".($locateY+$y).",".($locateX+$x).",".($locateY+$y-14).",".($locateX+$x+10).",".($locateY+$y).",".($locateX+$x+5).",".($locateY+$y).",".($locateX+$x+5).",".($locateY+$y+12).",".($locateX+$x-5).",".($locateY+$y+12)."' fill='white' fill-opacity='0' stroke='black' stroke-width='2'></polygon>";
					echo "</g>";
				}
			}
			?>
