<?php
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
				function dkDI($kks){
					global $pointArray;
					global $locateX;
					global $locateY;
				$index = $pointArray[$kks][0];
				$name = $pointArray[$kks][1];
				$x = $pointArray[$kks][2];
				$y = $pointArray[$kks][3];
				echo "<rect id = ".$kks." x=".($locateX+$x)." y=".($locateY+$y)." width='20' height='20' rx='5' ry='5' fill='gray' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></rect>";
				}
				function dkValue($kks){
					global $pointArray;
					global $locateX;
					global $locateY;
				$index = $pointArray[$kks][0];
				$name = $pointArray[$kks][1];
				$x = $pointArray[$kks][2];
				$y = $pointArray[$kks][3];
				$toward = $pointArray[$kks][5];
				if($toward == 0){
					echo "<g transform='rotate(-90 ".($locateX+$x).",".($locateY+$y).")'>";
					echo "<circle cx=".($locateX+$x)." cy=".($locateY+$y-19)." r='9' fill='white' stroke='black' stroke-width='1'></circle>";

					echo "<text x=".($locateX+$x-6)." y=".($locateY+$y-14)." fill='black' font-size='15' font-family='Arial'>M</text>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-10)." x2=".($locateX+$x)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
				echo "<polygon id = ".$kks." points='".($locateX+$x-20).",".($locateY+$y-10).",".($locateX+$x-20).",".($locateY+$y+10).",".($locateX+$x+20).",".($locateY+$y-10).",".($locateX+$x+20).",".($locateY+$y+10)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
					echo "</g>";
				}
				if($toward == 1){
					echo "<g>";
					echo "<circle cx=".($locateX+$x)." cy=".($locateY+$y-19)." r='9' fill='white' stroke='black' stroke-width='1'></circle>";

					echo "<text x=".($locateX+$x-6)." y=".($locateY+$y-14)." fill='black' font-size='15' font-family='Arial'>M</text>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-10)." x2=".($locateX+$x)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
				echo "<polygon id = ".$kks." points='".($locateX+$x-20).",".($locateY+$y-10).",".($locateX+$x-20).",".($locateY+$y+10).",".($locateX+$x+20).",".($locateY+$y-10).",".($locateX+$x+20).",".($locateY+$y+10)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
					echo "</g>";
				}
				if($toward == 10){
					echo "<g transform='rotate(-45 ".($locateX+$x).",".($locateY+$y).")'>";
				echo "<circle id = ".$kks." cx=".($locateX+$x)." cy=".($locateY+$y)." r='30' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></circle>";
					echo "<line x1=".($locateX+$x-30)." y1=".($locateY+$y)." x2=".($locateX+$x+30)." y2=".($locateY+$y)." stroke='black' stroke-width='2'/>";
					echo "<line x1=".($locateX+$x)." y1=".($locateY+$y-30)." x2=".($locateX+$x)." y2=".($locateY+$y+30)." stroke='black' stroke-width='2'/>";
					echo "</g>";
				}
			}
			?>
