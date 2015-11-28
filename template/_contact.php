<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php

$chk_rule = @array(
				new RULE2($_POST["id"], "ID", true),
				new RULE2($_POST["name"], "���O", false, 0, 20),
				new RULE2($_POST["title"], "����", false, 0, 100),
				new RULE2($_POST["addr"], "�A����", false, 0, 100, P_MAIL),
				new RULE2($_POST["body"], "���₢���킹���e", true, 1, 2048),

);


$back = false;
if(isset($_POST["p"])){
	$p = $_POST["p"];
	
	try{
		if($p == 1){
			check();
			require_once("_contact_confirm.php");
			return;
		}else if($p == 2){
			check();
			require_once("_contact_cmp.php");
			return;
		}else if($p == 0){
			$back = true;
		}
		
	}catch(Exception $e){
		$errmsg = makeError($e->getMessage());
		$back = true;
	}
}

$name = "";
$addr = "";
$body = "";
$title = "";

if($back){
	$id = $_POST["id"];
	$name = $_POST["name"];
	$addr = $_POST["addr"];
	$title = $_POST["title"];
	$body = $_POST["body"];
}else{
	$id = make_id("contact");
}

?>
<h2 id="title">���₢���킹<span>Contact</span></h2>
<?php print $errmsg; ?>
<pre>
�ȉ��̊e����@�ɂĂ��₢���킹���������B


<table>
	<tr>
		<td align="right">�d�b�F</td>
		<td><a href="tel:<?php print ht($design["tel"]); ?>"><?php print ht($design["tel"]); ?></a></td>
	</tr>
	<tr>
		<td align="right">FAX�F</td>
		<td><?php print ht($design["fax"]); ?></td>
	</tr>
	<tr>
		<td align="right">���[���F</td>
		<td><a href="mailto:<?php print ht($design["mailaddr"]); ?>"><?php print ht($design["mailaddr"]); ?></a></td>
	</tr>
<table>
<form method="post">
���̓t�H�[���F
<table class="simple">
	<tr valign="top">
	<td>���O</td>
	<td><input type="text" size="40" name="name" value="<?php print ht($name); ?>"></td>
	</tr>
	
	<tr valign="top">
	<td>�A����</td>
	<td><input type="text" size="40" name="addr" value="<?php print ht($addr); ?>"><br /><p class="small2">���[���A�h���X�܂��͓d�b�ԍ�����͂��Ă�������</p></td>
	</tr>

	<tr valign="top">
	<td>����</td>
	<td><input type="text" size="40" name="title" value="<?php print ht($title); ?>"></td>
	</tr>
		
	<tr valign="top">
	<td>���₢���킹���e</td>
	<td><textarea cols="60" rows="8" name="body"><?php print ht($body); ?></textarea></tr>
</table>
<input type="button" value="���M����" class="btn" onclick="submit()">
<input type="hidden" name="p" value="1"><input type="hidden" name="id" value="<?php print ht($id); ?>">
</form>
<hr><pre class="small">�����̓t�H�[���⃁�[���ł̂��₢���킹�ɂ͉񓚂ɂ����Ԃ����������ꍇ���������܂��̂�
���}���̏ꍇ�͂��d�b�ł��₢���킹���������B</pre>
</pre>
