<?php

	date_default_timezone_set('Asia/Tokyo');

	$sg				= parse_ini_file("./conf/sg.ini");
	$head_titles	= parse_ini_file($sg["TEMPLATE_PATH"]."/conf/title.ini");
	$text_titles	= parse_ini_file($sg["TEMPLATE_PATH"]."/conf/text.ini");
	$design			= parse_ini_file($sg["TEMPLATE_PATH"]."/conf/design.ini");
	$paging_max		= parse_ini_file($sg["TEMPLATE_PATH"]."/conf/paging.ini");
	$ment_ini		= parse_ini_file($sg["TEMPLATE_PATH"]."/conf/ment.ini");
	
	require_once($sg["LIB_PATH"]."/lib.php");
	require_once($sg["LIB_PATH"]."/alog.php");
	require_once($sg["LIB_PATH"]."/check.php");

		
	require_once("./test/mysql.php");
	
	$errmsg = "";
	$hh = "";


	function alog(){
		
		global $secret;
		global $hh;
		$v = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
		if($v == "ntaomr003207.aomr.nt.ngn2.ppp.infoweb.ne.jp" || $v == "218.216.75.36"){
			$hh = "@<br>\n";
			$secret = true;
		}
	
		$ref = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : "";
		$ref = preg_replace("/\?.*$/", "", $ref);
		
		$n = sprintf("%s [%s] (%s) [%s] R:[%s] %s\n", 
						date("Y/m/d H:i:s"), 
						$_SERVER["REMOTE_ADDR"],
						gethostbyaddr($_SERVER["REMOTE_ADDR"]),
						basename($_SERVER["REQUEST_URI"]),
						$ref,
						$_SERVER["HTTP_USER_AGENT"]
		);
	
		$lg = "access_".date("YmdH").".log";

		$fp = fopen("./log/".$lg, "a");
		fwrite($fp, $n);
		fclose($fp);
	}


	function login($id, $pw){
		
		global $ment_ini;		
		return ($id === $ment_ini["id"] && $pw === $ment_ini["pw"]);
	}
	

	function cookieCheck(){
		global $sg;
		global $ment_ini;
	
		parse_str($_COOKIE[$sg["COOKIE_KEY"]], $ar);
		return ($ar["id"] === $ment_ini["id"] && $ar["pw"] === $ment_ini["pw"]);
	}


	$secret = false;

	alog();
	
	$nn = get_included_files();
	$fn = basename(array_shift($nn));
	$head_title = (isset($head_titles[$fn])) ?
							$head_titles[$fn] : "家計簿くん";
	
	$paging = "";
	

	
	if(isset($_COOKIE["g_secret"])){
		$secret = true;
	}
	



	$logout_msg = "";
	if(isset($_GET["logout"])){
		// ログアウト
		setcookie($sg["COOKIE_KEY"],'',time() - 3600);  // Cookie削除
		$_COOKIE[$sg["COOKIE_KEY"]] = null;
		$logout_msg = "<p class=\"error\">ログアウトしました</p><br />";
	}

	$ment_mode = false;
	if(isset($_POST["ment_mode"])){
		// メンテ画面 ログインボタン押下
		$f = login($_POST["id"], $_POST["pw"]);
		if($f){
			// ログイン成功
			setcookie($sg["COOKIE_KEY"], "id=".$_POST["id"]."&pw=".$_POST["pw"]);
			$ment_mode = true;
		}
	}

	if(isset($_COOKIE[$sg["COOKIE_KEY"]])){
		$ment_mode = cookieCheck();
	}
	
	
	$uri = basename($_SERVER["SCRIPT_FILENAME"]);
	

	
	// 通常なら通常TEMPLATE使用
	$template = $sg["TEMPLATE_PATH"]."/".$temp;
	if(!file_exists($template)){
		$template = $sg["TEMPLATE_PATH"]."/_no.php";
	}


	require_once($sg["TEMPLATE_PATH"]."/basic/_basic.php");



?>