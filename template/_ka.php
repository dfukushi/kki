<?php



function get_date($day){

	$ret = "<select name=\"day\">\n";

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

function get_category($db, $cat){

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
		$chk = ($cat == $v["seq"]) ? " selected" : "";

		$ret .= "<option value=\"".$v["seq"]."\"".$chk.">".ht($v["title"])."</option>\n";


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



$day = (isset($_POST["day"]) ? $_POST["day"] : date("Ym")."01");
$cat = (isset($_POST["category"]) ? $_POST["category"] : "");
$user = (isset($_POST["user"]) ? $_POST["user"] : "0");




$db = new DBLib($sg);
$db->connect();


$cat = get_category($db, $cat);
/*
$sch = make_schedule($db);
$news = make_news($db);
$pr = make_pr($db);
*/


$db->close();


$dd = get_date($day);
$hash = date("YmdHis");

?>
<br>
<form action="regist.php" method="post">
<table class="simple">
	<tr>
	<td>‘ÎÛŒ</td>
	<td>
	<?php print $dd; ?>
	</td>
	</tr>

	<tr>
	<td>ƒJƒeƒSƒŠ[</td>
	<td>
		<?php print $cat; ?>
	</td>
	</tr>

	<tr>
	<td>“ü—ÍÒ</td>
	<td>
	<select name="user">
		<option value="1"<?php print ($user == 1 ? " selected" : ""); ?>>”ü‚³‚ñ</option>
		<option value="2"<?php print ($user == 2 ? " selected" : ""); ?>>‘å•ã‚³‚ñ</option>
	</select>
	</td>
	</tr>

	<tr>
	<td>‹àŠz</td>
	<td><textarea rows=8 cols=40 name="money"></textarea></td>
	</tr>
</table>
<input type="hidden" name="hash" value="<?php print $hash; ?>">
<br>
<input type="button" value="@“o˜^@" onclick="submit()">
</form>

