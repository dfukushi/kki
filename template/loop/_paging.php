<?php
	
	$line = "<a 
href=\"?ix=%d\">%d</a>&nbsp;&nbsp;";
	$line2 = "<p 
class=\"pg\">%d</p>&nbsp;&nbsp;";

	$prev = "�� �O�̃y�[�W&nbsp;&nbsp;";
	$prev2 = "<a href=\"?ix=%d\">�� �O�̃y�[�W</a>&nbsp;&nbsp;";

	$next = "���̃y�[�W ��";
	$next2 = "<a href=\"?ix=%d\">���̃y�[�W ��</a>";
		
	$p_body = "";
	
	
	if($ix <= 1){
		$p_body .= $prev;
	}else{
		$p_body .= sprintf($prev2, ($ix - 1));
	}
	
	for($i = 1; $i <= $page_cnt; $i++){
		if($i == $ix){
			$p_body .= sprintf($line2, $i);
		}else{
			$p_body .= sprintf($line, $i, $i);
		}
	}
	
	if($ix >= $page_cnt){
		$p_body .= $next;
	}else{
		$p_body .= sprintf($next2, ($ix + 1));
	}
	
?><hr><center><?php print $p_body; ?></center> 
