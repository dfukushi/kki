<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php


function make_schedule($db){
	
	global $text_titles;
	
	$mn1 = date("Ym");

	$sql1 = "select body from schedule where ymd = ?";
	$db->prepare($sql1);
	$db->bind($mn1);

	$val = $db->execute11();
	if($val == null){
		
		$ret = "<ul id=\"ul1\">\n";
		$ret .= "<li><span>". ht($text_titles["bhour_regular"])."</span>\n";
		$ret .= "</ul>";
		return $ret;
		
	}

	$r = explode("\r\n", $val);

	$ret = "<ul id=\"ul1\">\n";
	$cnt = 0;
	foreach($r as $v){
		$v = trim($v);
		if($v == ""){
			continue;
		}
		$ret .= "<li><span>".ht($v)."</span></li>\n";
		$cnt++;
	}
	$ret .= "<li><span>他、".ht($text_titles["bhour_regular"])."</li>\n";
	$ret .= "</ul>";

	return $ret;
}



$db = new DBLib($sg);
$db->connect();

$sch = make_schedule($db);


$db->close();

	
?>
<h2 id="title">営業時間のお知らせ<span>Business hours</span></h2>
<br />
<table class="bhour">
	<tr>
		<td>平日</td>
		<td><?php print ht($design["bhour_regular"]); ?></td>
	</tr>
	<tr>
		<td>土日祝</td>
		<td><?php print ht($design["bhour_other"]); ?></td>
	</tr>
</table>
<br />
定休日：<?php print ht($design["bhour_holiday"]); ?><br />
<br />
<br />
<div class="x">
<br /><b> 今月の予定</b><hr>
<?php print $sch; ?></div>
