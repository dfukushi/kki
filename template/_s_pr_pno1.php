<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<h2 id="news"><span><?php print ht($ar["name"]); ?> �l�̗��K���i</span></h2>
<br />
<br />
<table>
	<tr valign="top">
		<td width="130px"><img src="<?php print $img; ?>"<?php print imgsize($img, 110, 110); ?>></td>
		<td>
<img src="./img/movie-logo.jpg"><br /><p class="small10">�t�@�C���T�C�Y�F --- byte</p><br />
<img src="./img/star.png" width="24px" style="vertical-align: -2px">&nbsp;&nbsp;<b style="color:#f00; font-size:18pt"><?php print number_format($ar["nice_count"]); ?></b>&nbsp;�����ˁI<br />
		</td>
	</tr>
</table>
<br />
<img src="img/x.png" width="30px">&nbsp;&nbsp;<b style="color:#f00">���݂��̓���͍Đ��o���܂���</b>
<pre class="small">�� ������Đ����邽�߂ɂ�mp4���Đ��o��������K�v�ł��B
�� �p�P�b�g�T�C�Y���傫�����߃��o�C���ʐM�@��������p�̕��̓p�P�b�g��z���̂����p���������߂��܂��B
   �p�P�b�g�����ɂ��Ă͊e�ʐM���Ǝ҂̃z�[���y�[�W�������Q�Ƃ��������B</pre>
<br />
<table><tr>
<td><a href="javascript:void(0)" onclick="alert('�����ˁI');document.forms[0].submit();return false;"><img src="img/good.png" width="60px" title="�����ˁI" border="0"></a></td>
<td><font color="#00f"><b><a href="javascript:void(0)" onclick="alert('�����ˁI');document.forms[0].submit();return false;"> �� ���̓��悪�C�ɓ�������PUSH�I</a></b></font></td></tr></table>
<br />
<hr class="bnd2">
<br />
<table class="camp">
	<tr valign="top">
		<td class="z">�o���h��</td>
		<td><?php print ht(g_name($ar["name"])); ?></td>
	</tr>
	<tr valign="top">
		<td class="z">���t��</td>
		<td><?php print ht(g_song($ar["title"])); ?></td>
	</tr>
	<tr valign="top">
		<td class="z">�B�e��</td>
		<td><?php print ht($ar["term"]); ?></td>
	</tr>
	<tr valign="top">
		<td class="z">�Đ���</td>
		<td><?php print number_format($ar["play_count"]); ?>��</td>
	</tr>
	<tr valign="top">
		<td class="z">�o���h����ꌾ</td>
		<td><pre style="display:inline"><?php print ht(g_body($ar["body"])); ?></pre></td>
	</tr>
</table>
<br /><br /><br />
<form method="post">
<input type="hidden" name="p" value="1">
</form>
<hr>
<a href="s_pr.php">�� �߂�</a>
