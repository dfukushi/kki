<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php



if(isset($_GET["i"])){
	// iがあれば作成ページ
	require_once("_lecture_p.php");
	return;
}

$db = new DBLib($sg);
$db->connect();

$sql = "select a.id as id, round, a.title as title, count(b.partid) as c from lesson a
inner join lesson_part b
on a.id = b.id
group by (a.id)
order by round";
$db->prepare($sql);
$db->bind($id);
$arr = $db->execute();

$db->close();


$head_title = "バンド講座";
?>
<h4><img src="img/wakaba.png" width="22px" style="vertical-align: -5px">&nbsp;バンド講座</h2>
<br /><br />
<table class="radio">
	<tr>
		<th>No.</th>
		<th>楽曲</th>
		<th>難易度</th>
	</tr>
<?php foreach($arr as $ar){ ?> 
	<tr>
		<td>第<?php print $ar["round"]; ?>回</td>
		<td><a href="?i=<?php print $ar["id"]; ?>"><?php print ht($ar["title"]); ?></a></td>
		<td>★☆☆☆☆</td>
	</tr>
<?php } ?> 
</table>

<br /><br />
<img src="img/mail1.jpg" width="35px" style="vertical-align: -8px" border=0 title="メールを送る"><a href="mailto:xx">今後取り上げて欲しい楽曲のリクエストはこちらまで</a>
<br />