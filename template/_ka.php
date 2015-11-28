<?php



function get_date(){
	
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

function get_category($db){
	
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

function make_news($db){

	$sql1 = "select id,title from news 
where delete_flg = '0' and open_flg = '1' and start_date <= sysdate() and end_date > sysdate()
order by start_date desc
limit 3";

	$db->prepare($sql1);

	$arr = $db->execute();
	$ret = "";
	foreach($arr as $ar){
		
		$ret .= sprintf("<li><span><a href=\"news.php?i=%s\">%s</a></span></li>\n",
									$ar["id"],
									g_title(ht($ar["title"])));
	}

	return $ret;
}

function make_pr($db){

	$sql1 = "select id,name,movie_path,date_format(term, '%Y”N%mŒ%d“ú') as term from practice 
where delete_flg = '0'
order by create_date desc
limit 2";

	$db->prepare($sql1);

	$arr = $db->execute();
	$ret = "";
	foreach($arr as $ar){

		$ret .= sprintf("<li><a href=\"s_pr.php?i=%s\">%s —l</a>&nbsp;&nbsp;<p class=\"small2\">(%s‚Ì—ûK•—Œi)</p></li>\n",
									$ar["id"],
									g_name(ht($ar["name"])),
									ht($ar["term"]));
	}

	return $ret;
}





$db = new DBLib($sg);
$db->connect();

$cat = get_category($db);
/*
$sch = make_schedule($db);
$news = make_news($db);
$pr = make_pr($db);
*/


$db->close();


$dd = get_date();
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
		<option value="1">”ü‚³‚ñ</option>
		<option value="2">‘å•ã‚³‚ñ</option>
	<select>
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