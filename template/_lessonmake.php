<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php



if(isset($_GET["i"])){
	// iがあれば作成ページ
	require_once("_lessonmake_create.php");
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

if(trim($paging) === "<hr>"){
	$paging = "";
}

?>
<h2 id="title">講座作成</h2>
<br /><br />
<a href="?i=new">新規作成</a>
<br /><br />
<table class="simple">
	<tr>
		<td>ID</td>
		<td>ラウンド</td>
		<td>タイトル</td>
		<td>パート数</td>
		<td>操作</td>
	</tr>
<?php foreach($arr as $ar){ ?>
	<tr>
		<td><?php print $ar["id"]; ?></td>
		<td><?php print $ar["round"]; ?></td>
		<td><?php print ht($ar["title"]); ?></td>
		<td><?php print ht($ar["c"]); ?></td>
		<td><a href="?i=<?php print ht($ar["id"]); ?>">編集</a></td>
	</tr>
<?php } ?> 
</table>