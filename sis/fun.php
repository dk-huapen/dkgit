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
				echo "<polygon id = ".$kks." points='".($locateX+$x-10).",".($locateY+$y-20).",".($locateX+$x+10).",".($locateY+$y-20).",".($locateX+$x-10).",".($locateY+$y+20).",".($locateX+$x+10).",".($locateY+$y+20)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
				}
				if($toward == 1){
				echo "<polygon id = ".$kks." points='".($locateX+$x-20).",".($locateY+$y-10).",".($locateX+$x-20).",".($locateY+$y+10).",".($locateX+$x+20).",".($locateY+$y-10).",".($locateX+$x+20).",".($locateY+$y+10)."' fill='white' stroke='black' stroke-width='2' onclick=click(this.id,".$index.") onmouseover=mOver(this.id,'".$name."') onmouseout=mOut() onmouseup=mUp(".$index.",this.id)></polygon>";
				}
			}
			?>
