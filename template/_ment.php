<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php
	
	
	$msg = "";
	if(isset($_POST["id"])){
		// ���O�C������
		
		$f = login($_POST["id"], $_POST["pw"]);
		if(!$f){
			$msg = "<p class=\"error\">ID�������̓p�X���[�h���Ⴂ�܂�</p>";
		}
	}
	
	
?>
<h2 id="title">�Ǘ��҃��O�C��</h2>
<?php print $msg; ?><?php print $logout_msg; ?>
<form method="post" action="ment.php">
<br />
<table class="camp">
	<tr>
		<td class="z">�Ǘ���ID�F</td>
		<td><input type="text" size="20" name="id"></td>
	</tr>
	<tr>
		<td class="z">�Ǘ��҃p�X���[�h�F</td>
		<td><input type="password" size="20" name="pw"></td>
	</tr>
</table>
<br /><br />
<input type="button" onclick="submit()" value="���O�C��">
<input type="hidden" name="ment_mode" value="1">
