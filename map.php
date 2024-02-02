<?php

function getscore(){
	$score =-5;//0점
	return $score;
}

function getMilitary(){
	$score = getscore();
	$m = "일반군";
	if ($score < 0){
		$m = "준비중";
	}else{
		if ($score > 0 and $score < 3000){
			$m = "일반군";
		}else{
			if ($score < 7000){
				$m = "4군";
			}else{
				if ($score < 9900){
					$m = "3군";
				}else{
					if ($score < 15000){
						$m = "2군";
					}else{
						if ($score < 18000){
							$m = "1군";
						}else{
							if ($score < 20000){
								$m = "주력";
							}else{
								if ($score > 20099){
									$m = "선수";
								}else{
								}
							}
						}
					}
				}
			}
		}
	}
	return $m;
}

?>