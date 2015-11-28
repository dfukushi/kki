<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php


$i = $_GET["i"];


if($i === "new"){
	// �V�K
	$id = make_id("lesson");
	
}else{
	// �ҏW
	
	$id = $i;
	
	$db = new DBLib($sg);
	$db->connect();	
	
	$sql = "select round, title from lesson where id = ?";
	$db->prepare($sql);
	$db->bind($id);
	$val = $db->execute1();
			
	$sql = "select a.title as title, subtitle, page, count(b.id) as c
from lesson_part a
inner join lesson_part_item b
on a.id = b.id and a.partid = b.partid
where a.id = ?
group by (b.partid)";
	$db->prepare($sql);
	$db->bind($id);
	$arr = $db->execute();
	
	$db->close();

}

if(isset($_POST["p"])){
	$p = $_POST["p"];
	
	$id = $_POST["id"];

	if($p === "1"){
		// �p�[�g�ꗗ�m��
		$db = new DBLib($sg);
		$db->connect();
		
		// �e�������������邩
		$sql = "select 1 from lesson where id = ?";
		$db->prepare($sql);
		$db->bind($id);
		
		$a = $db->execute11();
		if($a == null){
			// �Ȃ�����C���T�[�g
			$sql = "insert into lesson (id, round, title) values (?, ?, ?)";
			$db->prepare($sql);
			$db->bind($id);
			$db->bind($_POST["round"]);
			$db->bind($_POST["title"]);
			
			print $db->execute_update_w();
		}
		
		// �A�b�v�f�[�g
		$sql = "update lesson set round = ?, title = ? where id = ?";
		$db->prepare($sql);
		$db->bind($_POST["round"]);
		$db->bind($_POST["title"]);
		$db->bind($id);
		print $db->execute_update_w();
		
		// �q������
		$sql = "delete from lesson_part where id = ?";
		$db->prepare($sql);
		$db->bind($id);
		print $db->execute_update_w();
		
		for($i = 0; $i < 10; $i++){
			if($_POST["part".$i] == ""){
				continue;
			}
			
			$sql = "insert into lesson_part (id,partid,title,subtitle,page) value (?, ?, ?, ?, ?)";
			$db->prepare($sql);
			$db->bind($id);
			$db->bind(sprintf("%010d", $i));
			$db->bind($_POST["part".$i]);
			$db->bind($_POST["sub".$i]);
			$db->bind(isset($_POST["chk".$i]) ? "1" : "0");
			print $db->execute_update_w();
		}

		
		$sql = "select round, title from lesson where id = ?";
		$db->prepare($sql);
		$db->bind($id);
		$val = $db->execute1();
		
		$sql = "select title, subtitle, page from lesson_part where id = ?";
		$db->prepare($sql);
		$db->bind($id);
		$arr = $db->execute();
		
		$db->close();
		
		
	}else if($p === "2"){
		
		require_once("template/_lessonmake_create2.php");
		return;
		
	}else if($p === "3"){
		
		require_once("template/_lessonmake_create2.php");
		return;
	}
}
?>
<h2 id="title">�u���쐬</h2>
<pre>

<form method="post">
<table class="simple">
	<tr>
		<td>ID�F</td>
		<td><?php print $id; ?></td>
	</tr>
	<tr>
		<td>���E���h�F</td>
		<td>��<input type="text" name="round" size="10" value="<?php print ht($val["round"]); ?>">��</td>
	</tr>
	<tr>
		<td>�^�C�g���F</td>
		<td><input type="text" name="title" size="60" value="<?php print ht($val["title"]); ?>"></td>
	</tr>
</table>

<?php for($i = 0; $i < 10; $i++){ 
	$ar = $arr[$i];
?>
<hr>
�p�[�g�F<input type="text" name="part<?php print $i; ?>" size="40" value="<?php print ht($ar["title"]); ?>">&nbsp;<input
type="text" name="sub<?php print $i; ?>" value="<?php print ht($ar["subtitle"]); ?>"> <input
type="button" value="�ҏW" onclick="document.forms[0].p.value=2;document.forms[0].part.value='<?php printf("%010d", $i); ?>';submit()">&nbsp;<?php print isset($ar["c"]) ? $ar["c"] : "0"; ?>�Z�N�V���� 
<p class="small2">(��)�M�^�[�p�[�g����K���悤�A�x�[�X�p�[�g����K���悤</p>

<input type="checkbox" name="chk<?php print $i; ?>"<?php if($ar["page"] === "1"){print " checked";} ?>>���y�[�W

<?php } ?>

<hr>
<input type="button" value="�m��" class="btn" onclick="submit()">
<input type="hidden" name="p" value="1">
<input type="hidden" name="part" value="">
<input type="hidden" name="id" value="<?php print $id; ?>">
</form>

<a href="lessonmake.php">�� �߂�</a>
</pre>