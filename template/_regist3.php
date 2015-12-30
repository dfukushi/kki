<?php



function get_date2(){

	$ret = "<select name=\"category\">\n";

	for($i = 2; $i >= 0; $i--){
		$mn1 = date("Y/m", strtotime("-${i} month"));
		$mn2 = date("Ym", strtotime("-${i} month"))."01";
		$ret .= "<option value=\"".$mn2."\">".ht($mn1)."</option>\n";
	}

	for($i = 1; $i < 2; $i++){
		$mn1 = date("Y/m", strtotime("+${i} month"));
		$mn2 = date("Ym", strtotime("+${i} month"))."01";
		$ret .= "<option value=\"".$mn2."\">".ht($mn1)."</option>\n";
	}


	$ret .= "</select>\n";
	return $ret;


}

function get_category2($db){

	global $text_titles;

	$mn1 = date("Ym");

	$sql1 = "select seq, title from kk_category order by sort_num";
	$db->prepare($sql1);
	//$db->bind($mn1);
	$val = $db->execute();

	$ret = "<select name=\"category\">\n";

	foreach($val as $v){

		/*
		print "---";
		var_dump($v);
		print "---";
		*/

		$ret .= "<option value=\"".$v["seq"]."\">".ht($v["title"])."</option>\n";


		/*
		$v = trim($v);

		if($v == ""){
			continue;
		}
		$ret .= "<li><span>".ht($v)."</span></li>\n";
		$cnt++;
		*/
	}

	$ret .= "</select>";
	//$ret .= "<li><span>‘¼A".ht($text_titles["bhour_regular"])."\n";

	return $ret;
}


function is_hash($hash, $db){

	$sql1 = "select 1 from kk_pay where hash_key = ?";
	$db->prepare($sql1);
	$db->bind($hash);
	$val = $db->execute();

	return (count($val) > 0);

}





$db = new DBLib($sg);
$db->connect();

/*
$cat = get_category($db);
$sch = make_schedule($db);
$news = make_news($db);
$pr = make_pr($db);
*/

// ƒnƒbƒVƒ…‚ª“o˜^Ï‚İ‚©‚Ç‚¤‚©”»’è

$hash = $_POST["hash"];
$user = $_POST["user"];
$cat = "0";
$money = $_POST["money"];
$day = $_POST["day"];
$mm = explode("\n", $money);
$ip = $_SERVER["REMOTE_ADDR"]." (".gethostbyaddr($_SERVER["REMOTE_ADDR"]).")";

$total = 0;


$f = is_hash($hash, $db);
if($f){
	// “o˜^Ï‚İ
	print "“o˜^Ï‚İ‚Å‚·";
	goto end;
}



// ‹àŠz•ªƒ‹[ƒv‚·‚é (insert’@‚­)
foreach($mm as $m){
	$kin = trim($m);
	$total += $kin;
	if($kin == 0 || $kin == ""){
		continue;
	}

	$sql1 = "insert into kk_pay (target_date, money, category, type, ip, user, delete_flg, create_date, hash_key) values (?, ?, ?, '1', ?, ?, '0', now(), ?)";

	$db->prepare($sql1);
	$db->bind($day);
	$db->bind($kin);
	$db->bind("0");
	$db->bind($ip);
	$db->bind($user);
	$db->bind($hash);

	$val = $db->execute_update();
}

$db->commit();

end:
$db->close();


//$dd = get_date();
$regist_flg = "1";


?>
<br>
<?php print $total; ?>‰~•ª“o˜^‚µ‚Ü‚µ‚½I<br>
<br>
ˆø‚«‘±‚«“ü—Ío—ˆ‚Ü‚·<br>
<br>
<br>
<?php require_once("_ka.php"); ?>