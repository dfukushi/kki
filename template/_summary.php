<?php



function get_date($day){

	$ret = "<select name=\"day\" onchange=\"submit()\">\n";

	for($i = 2; $i >= 0; $i--){
		$mn1 = date("Y/m", strtotime("-${i} month"));
		$mn2 = date("Ym", strtotime("-${i} month"))."01";

		$chk = ($mn2 == $day) ? " selected" : "";

		$ret .= "<option value=\"".$mn2."\"".$chk.">".ht($mn1)."</option>\n";
	}

	for($i = 1; $i < 2; $i++){
		$mn1 = date("Y/m", strtotime("+${i} month"));
		$mn2 = date("Ym", strtotime("+${i} month"))."01";

		$chk = ($mn2 == $day) ? " selected" : "";

		$ret .= "<option value=\"".$mn2."\"".$chk.">".ht($mn1)."</option>\n";
	}


	$ret .= "</select>\n";
	return $ret;


}

function get_category($db){

	global $text_titles;

	$mn1 = date("Ym");

	$sql1 = "select seq, title from kk_category where type <> 2 order by sort_num";
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


function get_list($db, $day){

	$sql1 = "select kh.seq seq,kh.money money,kc.title title,kh.create_date create_date from kk_history kh
inner join kk_category kc
on kh.category = kc.seq
where target_date >= ? and target_date < ?
order by kc.sort_num";

	$db->prepare($sql1);
	$db->bind(date("Y-m-d", strtotime($day)));
	$db->bind(date("Y-m-d", strtotime($day." +1 month")));
	$arr = $db->execute();



	$sql1 = "select sum(money) sum, kc.title title from kk_history kh
inner join kk_category kc
on kh.category = kc.seq
where target_date >= ? and target_date < ?
group by kh.category
order by kc.sort_num";

	$db->prepare($sql1);
	$db->bind(date("Y-m-d", strtotime($day)));
	$db->bind(date("Y-m-d", strtotime($day." +1 month")));
	$cat_arr = $db->execute();



	$total = 0;
	foreach($arr as $ar){
		$total += $ar["money"];
	}

	$ret = "<br><br>トータル：<b style=\"color:red\">".number_format($total)."円</b><br><br>";


	$ret .= "<table class=\"simple\">\n";
	foreach($cat_arr as $ar){

		$ret .= "<tr>";
		$ret .= "<td style=\"text-align:right\">".number_format($ar["sum"])."</td>\n";
		$ret .= "<td>".htmlspecialchars($ar["title"])."</td>\n";
		$ret .= "</tr>\n";

	}
	$ret .= "</table><br><br><br>\n";


	$ret .= "<table class=\"simple\">\n";
	foreach($arr as $ar){

		$ret .= "<tr>";
		$ret .= "<td style=\"text-align:right\">".number_format($ar["money"])."</td>\n";
		$ret .= "<td>".htmlspecialchars($ar["title"])."</td>\n";
		$ret .= "<td>".htmlspecialchars($ar["create_date"])."</td>\n";

		$ret .= "<td><input type=\"checkbox\" name=\"del_".$ar["seq"]."\"></td>\n";
		$ret .= "</tr>\n";

	}
	$ret .= "</table>\n";


	return $ret;
}


$day = (isset($_POST["day"]) ? $_POST["day"] : date("Ym")."01");

$db = new DBLib($sg);
$db->connect();

$lst = get_list($db, $day);
/*
$sch = make_schedule($db);
$news = make_news($db);
$pr = make_pr($db);
*/


$db->close();


$dd = get_date($day);



?>
<br>
<form method="post">
<table class="simple">
	<tr>
	<td>対象月</td>
	<td>
	<?php print $dd; ?>
	</td>
	</tr>
</table>
</form>

<form method="post" action="del.php">
<?php print $lst; ?>
<br>
<input type="button" value="削除" onclick="if(confirm('消していいですか？'))submit();">
</form>

