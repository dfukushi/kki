<?php

function get_value($arr, $key){

	foreach($arr as $ar){

		if($ar["category"] == $key){
			return $ar["money"];
		}
	}
	return 0;
}

function get_category($db){

	global $text_titles;

	$mn1 = date("Ym");

	$sql1 = "select seq, title from kk_category where type = 2 order by sort_num";
	$db->prepare($sql1);
	//$db->bind($mn1);
	$val = $db->execute();

	$ret = "<table class=\"simple\">\n";



	$sql2 = "select category,money from kk_history where category in (select seq from kk_category where type = 2)";
	$db->prepare($sql2);
	$arr2 = $db->execute();

	foreach($val as $v){

		$mn = get_value($arr2, $v["seq"]);
		$ret .= "<tr><td>".ht($v["title"])."</td><td><input type=\"text\" name=\"cat_".$v["seq"]."\" value=\"".$mn."\"></td></tr>\n";

	}

	$ret .= "</table>";

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

?>
<br>
ŒÅ’èŠz

<form action="regist2.php" method="post">


<?php print $cat; ?>

<br>
<input type="button" value="@“o˜^@" onclick="submit()">
</form>

