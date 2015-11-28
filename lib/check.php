<?php

define("P_ALPHA", "/^[a-zA-Z]*$/");
define("P_ALPHANUM", "/^[a-zA-Z0-9]*$/");
define("P_MAIL", "/^[-a-zA-Z0-9\._@+*#$%&=~\|]*$/");
define("P_YMD_YMDH", "/^([0-9]{4}[-\/][0-9]{1,2}[-\/][0-9]{1,2}|[0-9]{4}[-\/][0-9]{1,2}[-\/][0-9]{1,2} [0-9]{1,2}:[0-9]{1,2})$/");
define("P_YMD", "/^([0-9]{4}[-\/][0-9]{1,2}[-\/][0-9]{1,2})$/");
define("P_URL", "/^(http:\/\/|https:\/\/).*$/");


class RULE{
	
	var $chk;
	var $msg;
	
	function __construct($_chk, $_msg){
		$this->chk = $_chk;
		$this->msg = $_msg;
	}
	function run(){
		if($this->chk){
			throw new Exception($this->msg);
		}
	}
}


class RULE2{
	
	var $val;
	var $msg;
	var $need;
	var $min;
	var $max;
	var $pattern;
	
	function __construct($_val, $_msg, $_need = false, $_min = 0, $_max = 0, $_pattern = ""){
		
		$this->val = $_val;
		$this->msg = $_msg;
		$this->need = $_need;
		$this->min = $_min;
		$this->max = $_max;
		$this->pattern = $_pattern;
	}
	
	function run(){
		
		if($this->need){ // �K�{�`�F�b�N
			if($this->val == null || $this->val === ""){
				throw new Exception($this->msg."�����͂���Ă��܂���");
			}
		}
		if($this->min > 0){  // �ŏ��`�F�b�N
			if(strlen($this->val) < $this->min){
				throw new Exception($this->msg."��".$this->min."�o�C�g�ȏ���͂��Ă�������");
			}
		}
		if($this->max > 0){  // �ő�`�F�b�N
			if(strlen($this->val) > $this->max){
				throw new Exception($this->msg."��".$this->max."�o�C�g�ȓ��œ��͂��Ă�������");
			}
		}
		
		if($this->val === ""){
			return;
		}
		if($this->pattern !== ""){  // �p�^�[���`�F�b�N
			if(!preg_match($this->pattern, $this->val)){
				
				if($this->pattern === P_YMD_YMDH){
					throw new Exception($this->msg."��YYYY/MM/DD �������� YYYY/MM/DD HH:Mi �`���œ��͂��Ă�������");
				}
				if($this->pattern === P_YMD){
					throw new Exception($this->msg."��YYYY/MM/DD �`���œ��͂��Ă�������");
				}
				if($this->pattern === P_URL){
					throw new Exception($this->msg."��http�܂���https����n�߂Ă�������");
				}	
				throw new Exception($this->msg."�Ɏg�p�o���Ȃ��������܂܂�Ă��܂�");
			}
		}
		
	}
}

function getPost($key){
	if(!isset($_POST[$key])){
		return null;
	}
	return $_POST[$key];
}

function check(){
	
	global $chk_rule;

	foreach($chk_rule as $chk){
		if($chk instanceof RULE){
			$chk->run();
		}else{
			$chk->run();
		}
	}
}


function makeError($v){
	
	return "<br /><img src=\"img/caution.jpg\" width=\"24px\" style=\"vertical-align: -4px\">&nbsp;<p class=\"errmsg\">".ht($v)."</p><br />\n";
}



?>
