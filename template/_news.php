<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php
	

	$id = isset($_GET['i']);
	if($id){
		$id = $_GET['i'];
		require_once("_news_p.php");
		return;
	}

$sql = "select id, title, body, date_format(start_date, '%Y/%m/%d') as start_date, date_format(create_date, '%Y/%m/%d') as create_date
from news
where delete_flg = '0' and open_flg = '1' and start_date <= sysdate() and end_date > sysdate()
order by start_date desc
";


$ix = (isset($_GET["ix"]) ? $_GET["ix"] : "");
if($ix !== ""){
	if($ix === "1"){
		$ix = "";
	}else{
		$ix = "&ix=".ht($ix);
	}
}


$db = new DBLib($sg);
$db->connect();

$sql = paging($db, $sql);


$db->prepare($sql);
$db->bind($id);

$arr = $db->execute();



$db->close();

$loop = file_get_contents("./template/loop/".basename(__FILE__));
$body = "";
foreach($arr as $ar){
	$st = $ar["start_date"];
	if(startsWith($st, "1970")){
		$st = $ar["create_date"];
	}
	$body .= sprintf($loop, $ar["id"].$ix, g_title(ht($ar["title"])), $st);
}
	
?>
<h2 id="title">Н≈РVПоХс<span>Information</span></h2>
<br />
<ul id="ul2">
<?php print $body ?>
</ul>
<pre>
<?php print $paging; ?>
</pre>
