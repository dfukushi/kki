<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php


$sql = "select title, body, date_format(start_date, '%Y/%m/%d') as start_date, date_format(create_date, '%Y/%m/%d') as create_date
from news
where id = ? and delete_flg = '0' and open_flg = '1' and start_date <= sysdate() and end_date > sysdate()
";

$ix = (isset($_GET["ix"]) ? $_GET["ix"] : "");
if($ix !== ""){
	if($ix === "1"){
		$ix = "";
	}else{
		$ix = "?ix=".ht($ix);
	}
}


$db = new DBLib($sg);
$db->connect();

$db->prepare($sql);
$db->bind($id);
$rs = $db->execute1();

if($rs == null){
	// レコードなし
	$rs["body"] = "<p class=\"cation\">該当の記事が見つかりませんでした</p>\n";
	$rs["title"] = "最新情報";
	$time = "";
}else{
	$st = $rs["start_date"];
	if(startsWith($st, "1970")){
		$st = $rs["create_date"];
	}
	
	$time = "(".$st.")";
}

$db->close();

	
$head_title = $rs["title"];


function br($v){

	$v = str_replace("\r", "", $v);
	$v = str_replace("\n", "<br>", $v);
	return $v;
}
?>
<h2 id="news"><span><?php print g_title(ht($rs["title"])); ?></span></h2>
<br />
<div style="width:520px; word-break: break-all;">
<?php print br($rs["body"]); ?>
<br /><br />
</div>
<pre>
<hr><p class="small"><?php print $time; ?></p>



<a href="news.php<?php print $ix; ?>">＜ 戻る</a>
</pre>