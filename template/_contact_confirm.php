<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php

$head_title = "���₢���킹 - �m�F";

?>
<h2 id="title">���₢���킹 - �m�F</h2>
<pre>
<p class="cation">�ȉ��̓��e�ő��M���܂�����낵���ł��傤���H
���Ȃ����[�m��]���������Ă��������B
�C������ꍇ��[�߂�]���������Ă��������B</p>
<form method="post">
<table class="simple">
	<tr valign="top">
	<td>���O</td>
	<td><input type="hidden" size="40" name="name" value="<?php print ht($_POST["name"]); ?>"><?php print g_name(ht($_POST["name"])); ?></td>
	</tr>
	
	<tr valign="top">
	<td>�A����</td>
	<td><input type="hidden" size="40" name="addr" value="<?php print ht($_POST["addr"]); ?>"><?php print ht($_POST["addr"]); ?></td>
	</tr>

	<tr valign="top">
	<td>����</td>
	<td><input type="hidden" size="40" name="title" value="<?php print ht($_POST["title"]); ?>"><?php print g_title(ht($_POST["title"])); ?></td>
	</tr>

	<tr valign="top">
	<td>���₢���킹���e</td>
	<td width="400px"><?php print ht($_POST["body"]); ?></tr>
</table>
<br />
<input type="button" value="���M����" class="btn" onclick="d('2');submit()">&nbsp;&nbsp;<input type="button" value="�߂�" class="btn" onclick="d('0');submit()">
<input type="hidden" name="p" value="2"><input type="hidden" name="id" value="<?php print ht($_POST["id"]); ?>">
<input type="hidden" name="body" value="<?php print ht($_POST["body"]); ?>">
</form><hr><pre class="small">�����̓t�H�[���⃁�[���ł̂��₢���킹�ɂ͉񓚂ɂ����Ԃ����������ꍇ���������܂��̂�
���}���̏ꍇ�͂��d�b�ł��₢���킹���������B</pre>
</pre>
