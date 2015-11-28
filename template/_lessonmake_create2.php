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
			$err = "ファイルの格納に失敗しました";
		}else{
			$err = "ok ".$o;
		}
		
	}else{
		
		$errno = $_FILES[$key]["error"];
		if($errno == UPLOAD_ERR_INI_SIZE || $errno == UPLOAD_ERR_FORM_SIZE){
			$err = "ファイルサイズが大き過ぎたため破棄しました。 ".$ini["upload_max_filesize"]."バイト以内のファイルしかアップロード出来ません";
		}else{
			$err = "ファイルの投稿に失敗しました ".$errno;
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

	print $v."削除OK";	
	unlink($v);
}

if(isset($_POST["p"])){
	$p = $_POST["p"];

	if($p === "2"){
		// パート表示
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
		
		// 編集
		
		// ファイル操作
		$dir = "./img/tmpl/".$id."/".$pid;
		if(!file_exists($dir)){
			// なきゃ作る
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
				// なきゃ作る
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
				// ないから作る
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
				
				// あれば更新
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
	
	// いる
	return "";
}
?>
<h2 id="title">講座作成 - パート</h2>
<pre>
<form method="post" enctype="multipart/form-data">
id：<?php print $id; ?> 
pid：<?php print $pid; ?> 


<a href="?i=<?php print $id; ?>">＜ 戻る</a>


<?php for($i = 0; $i < 7; $i++){ 
	$ar = $arr[$i];
?>
<hr>
<b>セクション</b>：<input type="text" name="section<?php print $i; ?>" size="40" value="<?php print ht($ar["title"]); ?>">

ヘッダ
<textarea name="head<?php print $i; ?>" cols=60 rows=3><?php print ht($ar["head"]); ?></textarea>

ボディ
<textarea name="body<?php print $i; ?>" cols=60 rows=3><?php print ht($ar["body"]); ?></textarea>

フッダ
<textarea name="foot<?php print $i; ?>" cols=60 rows=3><?php print ht($ar["tail"]); ?></textarea>


<table class="simple">
	<tr>
		<td><a href="<?php print $ar["img_path"]; ?>"><img src="<?php print $ar["img_path"]; ?>"<?php print imgsize($ar["img_path"], 40, 40); ?>></a></td>
		<td>譜面画像</td>
		<td><input type="file" name="img<?php print $i; ?>" size="70"><input type="button" value="クリア" onclick="document.forms[0].img<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk0_<?php print $i; ?>"<?php print newcheck($ar["img_path"]); ?>>更新</td>
	</tr>
	<tr>
		<td><?php print play($ar["audio_path1"]); ?></td>
		<td>汎用動画</td>
		<td><input type="file" name="audio1_<?php print $i; ?>" size="70"><input type="button" value="クリア" onclick="document.forms[0].audio1_<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk1_<?php print $i; ?>"<?php print newcheck($ar["audio_path1"]); ?>>更新</td>
	</tr>
	<tr>
		<td><?php print play($ar["audio_path2"]); ?></td>
		<td>お手本</td>
		<td><input type="file" name="audio2_<?php print $i; ?>" size="70"><input type="button" value="クリア" onclick="document.forms[0].audio2_<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk2_<?php print $i; ?>"<?php print newcheck($ar["audio_path2"]); ?>>更新</td>
	</tr>
	<tr>
		<td><?php print play($ar["audio_path3"]); ?></td>
		<td>練習用</td>
		<td><input type="file" name="audio3_<?php print $i; ?>" size="70"><input type="button" value="クリア" onclick="document.forms[0].audio3_<?php print $i; ?>.value=''"></td>
		<td><input type="checkbox" name="chk3_<?php print $i; ?>"<?php print newcheck($ar["audio_path3"]); ?>>更新</td>
	</tr>
</table>
<input type="button" value="確定" class="btn" onclick="submit()"> <a href="?i=<?php print $id; ?>">＜ 戻る</a>

<?php } ?>

<hr>
<input type="button" value="確定" class="btn" onclick="submit()">
<input type="hidden" name="p" value="3">
<input type="hidden" name="part" value="<?php print $pid; ?>">
<input type="hidden" name="id" value="<?php print $id; ?>">
</form>

<a href="?i=<?php print $id; ?>">＜ 戻る</a>
</pre>