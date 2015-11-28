<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php


$id = $_POST["id"];
$pid = $_POST["part"];


function upload($key, $out){
	

	$errno = $_FILES[$key]["error"];
	if($errno == UPLOAD_ERR_NO_FILE){
		return "";
	}
	
	$ini_path = php_ini_loaded_file();
	$ini = parse_ini_file($ini_path);


	$tmp = $_FILES[$key]["tmp_name"];

	$err = "ok";
	if(is_uploaded_file($tmp)){
		
		$suf = preg_replace("/^.*\./", "", $_FILES[$key]["name"]);
		
		$o = $out.".".$suf;
		$flg = move_uploaded_file($tmp, $o);
		if(!$flg){
			$err = "�t�@�C���̊i�[�Ɏ��s���܂���";
		}else{
			$err = "ok ".$o;
		}
		
	}else{
		
		$errno = $_FILES[$key]["error"];
		if($errno == UPLOAD_ERR_INI_SIZE || $errno == UPLOAD_ERR_FORM_SIZE){
			$err = "�t�@�C���T�C�Y���傫�߂������ߔj�����܂����B ".$ini["upload_max_filesize"]."�o�C�g�ȓ��̃t�@�C�������A�b�v���[�h�o���܂���";
		}else{
			$err = "�t�@�C���̓��e�Ɏ��s���܂��� ".$errno;
		}
		
	}
	return $err;
}

function rm($v){

	if($v === ""){
		return;
	}
	
	if(!file_exists($v)){
		return;
	}

	print $v."�폜OK";	
	unlink($v);
}

if(isset($_POST["p"])){
	$p = $_POST["p"];

	if($p === "2"){
		// �p�[�g�\��
		$db = new DBLib($sg);
		$db->connect();
		
		$sql = "select 
		title,head,body,tail,img_path,audio_path1,audio_path2,audio_path3
		from lesson_part_item
		where id = ? and partid = ?
		order by itemid";
		
		$db->prepare($sql);
		$db->bind($id);
		$db->bind($pid);
		
		$arr = $db->execute();
		
		$db->close();
		
		
	}else if($p === "3"){
		
		// �ҏW
		
		// �t�@�C������
		$dir = "./img/tmpl/".$id."/".$pid;
		if(!file_exists($dir)){
			// �Ȃ�����
			mkdir($dir, 0755, true);
		}

		
		$db = new DBLib($sg);
		$db->connect();
		
		for($i = 0; $i < 7; $i++){
			$sql = "select 
					img_path, audio_path1,audio_path2,audio_path3  from lesson_part_item
					where id = ? and partid = ? and itemid = ?
					order by itemid";
			
			$db->prepare($sql);
			$db->bind($id);
			$db->bind($pid);
			$db->bind($i);
			
			$ar = $db->execute1();
			
			$dir2 = $dir."/".$i."/";
			if(!file_exists($dir2)){
				// �Ȃ�����
				mkdir($dir2, 0755, true);
			}
			
			$chk0 = isset($_POST["chk0_".$i]);
			$chk1 = isset($_POST["chk1_".$i]);
			$chk2 = isset($_POST["chk2_".$i]);
			$chk3 = isset($_POST["chk3_".$i]);

			
			if($chk0){
				rm($ar["img_path"]);
				$a1 = upload("img".$i, $dir2."thumbnail");
			}else{
				$a1 = $ar["img_path"];
			}
			
			if($chk1){
				rm($ar["audio_path1"]);
				$a2 = upload("audio1_".$i, $dir2."audio1");
			}else{
				$a2 = $ar["audio_path1"];
			}
				
			if($chk2){
				rm($ar["audio_path2"]);
				$a3 = upload("audio2_".$i, $dir2."audio2");
			}else{
				$a3 = $ar["audio_path2"];
			}
			
			if($chk3){
				rm($ar["audio_path3"]);
				$a4 = upload("audio3_".$i, $dir2."audio3");
			}else{
				$a4 = $ar["audio_path3"];
			}

			$a1 = preg_replace("/^ok /", "", $a1);
			if($a1 == ""){
				$a1 = "";
			}

			$a2 = preg_replace("/^ok /", "", $a2);
			if($a2 == ""){
				$a2 = "";
			}
			
			$a3 = preg_replace("/^ok /", "", $a3);
			if($a3 == ""){
				$a3 = "";
			}
			$a4 = preg_replace("/^ok /", "", $a4);
			if($a4 == ""){
				$a4 = "";
			}
						
			if($ar == null){
				// �Ȃ�������
				if($_POST["section".$i] === ""){
					continue;
				}
				
				$sql = "insert into lesson_part_item (id,partid,itemid, title,head,body,tail,img_path,audio_path1,audio_path2,audio_path3)
						values (?, ?,?,?,?,?,?,?,?,?,?)";
				
				$db->prepare($sql);
				$db->bind($id);
				$db->bind($pid);
				$db->bind($i);
				
				$db->bind($_POST["section".$i]);
				$db->bind($_POST["head".$i]);
				$db->bind($_POST["body".$i]);
				$db->bind($_POST["foot".$i]);
				$db->bind($a1);
				$db->bind($a2);
				$db->bind($a3);
				$db->bind($a4);
				
				print $db->execute_update_w();
				
			}else{
				
				// ����΍X�V
				$sql = "update lesson_part_item set title=?, head=?, body=?, tail=?, img_path=?,audio_path1=?,audio_path2=?,audio_path3=? 
						where id =? and partid = ? and itemid = ?";
				
				$sql2 = "delete from lesson_part_item 
						where id =? and partid = ? and itemid = ?";
				
				if($_POST["section".$i] !== ""){
					$db->prepare($sql);
					$db->bind($_POST["section".$i]);
					$db->bind($_POST["head".$i]);
					$db->bind($_POST["body".$i]);
					$db->bind($_POST["foot".$i]);
					
					$db->bind($a1);
					$db->bind($a2);
					$db->bind($a3);
					$db->bind($a4);
					
					
				}else{
					$db->prepare($sql2);
				}
				
				$db->bind($id);
				$db->bind($pid);
				$db->bind($i);

				print $db->execute_update_w();
			}
			
		}
		
		$sql = "select 
		title,head,body,tail,img_path,audio_path1,audio_path2,audio_path3
		from lesson_part_item
		where id = ? and partid = ?
		order by itemid";
		
		$db->prepare($sql);
		$db->bind($id);
		$db->bind($pid);
		
		$arr = $db->execute();

		$db->close();
		
	}
}


function play($v){
	
	if($v == ""){
		return;
	}
	
	if(!file_exists($v)){
		return "";
	}
	
	return "<a href=\"".$v."\"><img src=\"img/play.gif\" width=\"30px\"></a>";
	
}
function newcheck($v){
	if($v == ""){
		return " checked";
	}
	
	if(!file_exists($v)){
		return " checked";
	}
	
	// ����
	return "";
}
?>
<h2 id="title">�u���쐬 - �p�[�g</h2>
<pre>
<form method="post" enctype="multipart/form-data">
id�F<?php print $id; ?> 
pid�F<?php print $pid; ?> 


<a href="?i=<?php print $id; ?>">�� �߂�</a>


<?php for($i = 0; $i < 7; $i++){ 
	$ar = $arr[$i];
?>
<hr>
<b>�Z�N�V����</b>�F<input type="text" name="section<?php print $i; ?>" size="40" value="<?php print ht($ar["title"]); ?>">

�w�b�_
<textarea name="head<?php print $i; ?>" cols=60 rows=3><?php print ht($ar["head"]); ?></textarea>

�{�f�B
<textarea name="body<?php print $i; ?>" cols=60 rows=3><?php print ht($ar["body"]); ?></textarea>

�t�b�_
<textarea name="foot<?php print $i; ?>" cols=60 rows=3><?php print ht($ar["tail"]); ?></textarea>


<table class="simple">
	<tr>
		<td><a href="<?php print $ar["img_path"]; ?>"><img src="<?php print $ar["img_path"]; ?>"<?php print imgsize($ar["img_path"], 40, 40); ?>></a></td>
		<td>���ʉ摜</td>
		<td><input type="file" name="img<?php print $i; ?>" size="70"><input type="button" value="�N���A" onclick="document.forms[0].img<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk0_<?php print $i; ?>"<?php print newcheck($ar["img_path"]); ?>>�X�V</td>
	</tr>
	<tr>
		<td><?php print play($ar["audio_path1"]); ?></td>
		<td>�ėp����</td>
		<td><input type="file" name="audio1_<?php print $i; ?>" size="70"><input type="button" value="�N���A" onclick="document.forms[0].audio1_<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk1_<?php print $i; ?>"<?php print newcheck($ar["audio_path1"]); ?>>�X�V</td>
	</tr>
	<tr>
		<td><?php print play($ar["audio_path2"]); ?></td>
		<td>����{</td>
		<td><input type="file" name="audio2_<?php print $i; ?>" size="70"><input type="button" value="�N���A" onclick="document.forms[0].audio2_<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk2_<?php print $i; ?>"<?php print newcheck($ar["audio_path2"]); ?>>�X�V</td>
	</tr>
	<tr>
		<td><?php print play($ar["audio_path3"]); ?></td>
		<td>���K�p</td>
		<td><input type="file" name="audio3_<?php print $i; ?>" size="70"><input type="button" value="�N���A" onclick="document.forms[0].audio3_<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk3_<?php print $i; ?>"<?php print newcheck($ar["audio_path3"]); ?>>�X�V</td>
	</tr>
</table>
<input type="button" value="�m��" class="btn" onclick="submit()"> <a href="?i=<?php print $id; ?>">�� �߂�</a>

<?php } ?>

<hr>
<input type="button" value="�m��" class="btn" onclick="submit()">
<input type="hidden" name="p" value="3">
<input type="hidden" name="part" value="<?php print $pid; ?>">
<input type="hidden" name="id" value="<?php print $id; ?>">
</form>

<a href="?i=<?php print $id; ?>">�� �߂�</a>
</pre>