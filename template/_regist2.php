<?php


function del_list($db){


	$sql1 = "delete from kk_history where category in (select seq from kk_category where type = 2)";
	$db->prepare($sql1);
	//$db->bind($mn1);
	$db->execute_update();
}




function get_cat_list($db){

	global $text_titles;

	$mn1 = date("Ym");

	$sql1 = "select seq, title from kk_category where type = 2 order by sort_num";
	$db->prepare($sql1);
	//$db->bind($mn1);
	$val = $db->execute();

	return $val;
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
	//$ret .= "<li><span>他、".ht($text_titles["bhour_regular"])."\n";

	return $ret;
}




$db = new DBLib($sg);
$db->connect();

/*
$cat = get_category($db);
$sch = make_schedule($db);
$news = make_news($db);
$pr = make_pr($db);
*/

// ハッシュが登録済みかどうか判定

$user = "99";
$cat = ""; // ループ
$money = "";  //ループ
$day = "1999-01-01";
$ip = $_SERVER["REMOTE_ADDR"]." (".gethostbyaddr($_SERVER["REMOTE_ADDR"]).")";

$total = 0;


// まず全部消す
del_list($db);


$arr = get_cat_list($db);


// 金額分ループする (insert叩く)
foreach($arr as $ar){

	$m = $_POST["cat_".$ar["seq"]];
	$cat = $ar["seq"];

	$kin = trim($m);
	$total += $kin;

	$sql1 = "insert into kk_history (target_date, money, category, type, ip, user, delete_flg, create_date, hash_key) values (?, ?, ?, '1', ?, ?, '0', now(), ?)";

	$db->prepare($sql1);
	$db->bind($day);
	$db->bind($kin);
	$db->bind($cat);
	$db->bind($ip);
	$db->bind($user);
	$db->bind("");

	$val = $db->execute_update();
}

$db->commit();

end:
$db->close();


//$dd = get_date();
$regist_flg = "1";


?>
<br>
固定費を登録しました！<br>
<?php require_once("_ka2.php"); ?>