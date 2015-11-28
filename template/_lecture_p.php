<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php


$i = $_GET["i"];
$id = $i;

	
$db = new DBLib($sg);
$db->connect();	

$sql = "select round, title from lesson where id = ?";
$db->prepare($sql);
$db->bind($id);
$ar = $db->execute1();
		
$sql = "select a.title as title, subtitle, page, b.img_path,audio_path1,audio_path2,audio_path3, b.title as btitle, b.head, b.body, b.tail
from lesson_part a
inner join lesson_part_item b
on a.id = b.id and a.partid = b.partid
where a.id = ?";
$db->prepare($sql);
$db->bind($id);
$item = $db->execute();


$sql = "select title, subtitle, page
from lesson_part
where id = ?";
$db->prepare($sql);
$db->bind($id);
$part = $db->execute();


$db->close();


$head_title = $ar["title"];
?>
<h4>��<?php print ht($ar["round"]); ?>��&nbsp;&nbsp;<?php print ht($ar["title"]); ?></h2>
<pre>

<div class="camp1">xx�K�[���Y�o���h�̑�\�i�ESCANDAL��10���ڂ̃V���O���u�n���J�v�̃J�b�v�����O�ȂƂ��Ď��^����Ă���u�T�e�B�X�t�@�N�V�����v�����グ�܂��B<br />
�e�p�[�g�Ƃ���r�I�e���₷����Ƀ��C�u�ł�����オ��A�b�p�[�`���[���Ȃ̂ł��Ѓ}�X�^�[���悤�I
</div>
<!--<img src="img/scandal.jpg" title="scandal">-->

<table class="simple" style="font-size:10pt">
<?php $i = 1;
foreach($part as $pa){
?>
	<tr><td><?php print $i ?>. <a href=""><?php print ht($pa["title"]); ?></a></td></tr>
<?php
	$i++;
	}
?> 
</table>
<p class="small">�� ���u���p�Ɋe�p�[�g�͊ȗ������Ă���܂��̂Ŏ��ۂ�CD�����Ƃ͈قȂ�ꍇ������܂��B</p>

<?php 
	$i = 1;
	foreach($part as $pa){ 
?>
<p class="linecam"><?php print $i ?>.  <?php print ht($pa["title"]); ?></p>
<?php 
	foreach($item as $it){ 
?>
<u class="sub"><?php print ht($it["title"]); ?></u>
<a href="<?php print ht($it["img_path"]); ?>"><img src="<?php print ht($it["img_path"]); ?>"<?php imgsize($it["img_path"], 100, 100); ?> border=0 title="�g�傷��"></a>&nbsp;&nbsp;<p class="small2">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;<?php print ht($it["head"]); ?>
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>

<?php
	}
?> 
<?php
	$i++;
	}
?> 

<p class="linecam">2. ���[�h�M�^�[�p�[�g�̗��K <span>(MAMI�p�[�g)</span></p>


<u class="sub">A����</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;�C���g����������I�ȃJ�b�e�B���O�Ŏn�܂�܂��B���G�����ɒ������邩���m��܂��񂪍���̃R�[�h�͂����Ɠ����Ȃ̂ŁA�܂��͍���̉����������o���āA��͉E��̃��Y�����o���܂��B
�J�b�e�B���O���鎞�͍���𕂂����܂��B���肪�オ��؂�Ȃ��Ɖ����c���Ă��܂��Ĕ��ɃJ�b�R���������ɂȂ��Ă��܂��̂ŉ������o���܂��傤�B
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>

<u class="sub">B����</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;�C���g����������I�ȃJ�b�e�B���O�Ŏn�܂�܂��B���G�����ɒ������邩���m��܂��񂪍���̃R�[�h�͂����Ɠ����Ȃ̂ŁA�܂��͍���̉����������o���āA��͉E��̃��Y�����o���܂��B
�J�b�e�B���O���鎞�͍���𕂂����܂��B���肪�オ��؂�Ȃ��Ɖ����c���Ă��܂��Ĕ��ɃJ�b�R���������ɂȂ��Ă��܂��̂ŉ������o���܂��傤�B
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>


<u class="sub">�T�r</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;�C���g����������I�ȃJ�b�e�B���O�Ŏn�܂�܂��B���G�����ɒ������邩���m��܂��񂪍���̃R�[�h�͂����Ɠ����Ȃ̂ŁA�܂��͍���̉����������o���āA��͉E��̃��Y�����o���܂��B
�J�b�e�B���O���鎞�͍���𕂂����܂��B���肪�オ��؂�Ȃ��Ɖ����c���Ă��܂��Ĕ��ɃJ�b�R���������ɂȂ��Ă��܂��̂ŉ������o���܂��傤�B
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>



<p class="linecam">3. ���[�h�M�^�[�p�[�g�̗��K <span>(HARUKA�p�[�g)</span></p>
<u class="sub">�C���g��</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0 title="�g�傷��"></a>&nbsp;&nbsp;<p class="small2">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;�C���g����������I�ȃJ�b�e�B���O�Ŏn�܂�܂��B���G�����ɒ������邩���m��܂��񂪍���̃R�[�h�͂����Ɠ����Ȃ̂ŁA�܂��͍���̉����������o���āA��͉E��̃��Y�����o���܂��B
�J�b�e�B���O���鎞�͍���𕂂����܂��B���肪�オ��؂�Ȃ��Ɖ����c���Ă��܂��Ĕ��ɃJ�b�R���������ɂȂ��Ă��܂��̂ŉ������o���܂��傤�B
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>


<u class="sub">A����</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;�C���g����������I�ȃJ�b�e�B���O�Ŏn�܂�܂��B���G�����ɒ������邩���m��܂��񂪍���̃R�[�h�͂����Ɠ����Ȃ̂ŁA�܂��͍���̉����������o���āA��͉E��̃��Y�����o���܂��B
�J�b�e�B���O���鎞�͍���𕂂����܂��B���肪�オ��؂�Ȃ��Ɖ����c���Ă��܂��Ĕ��ɃJ�b�R���������ɂȂ��Ă��܂��̂ŉ������o���܂��傤�B
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>

<u class="sub">B����</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;�C���g����������I�ȃJ�b�e�B���O�Ŏn�܂�܂��B���G�����ɒ������邩���m��܂��񂪍���̃R�[�h�͂����Ɠ����Ȃ̂ŁA�܂��͍���̉����������o���āA��͉E��̃��Y�����o���܂��B
�J�b�e�B���O���鎞�͍���𕂂����܂��B���肪�オ��؂�Ȃ��Ɖ����c���Ă��܂��Ĕ��ɃJ�b�R���������ɂȂ��Ă��܂��̂ŉ������o���܂��傤�B
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>


<u class="sub">�T�r</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">�� �N���b�N����Ɗg��\���o���܂�</p>

<div class="camp1">&nbsp;&nbsp;�C���g����������I�ȃJ�b�e�B���O�Ŏn�܂�܂��B���G�����ɒ������邩���m��܂��񂪍���̃R�[�h�͂����Ɠ����Ȃ̂ŁA�܂��͍���̉����������o���āA��͉E��̃��Y�����o���܂��B
�J�b�e�B���O���鎞�͍���𕂂����܂��B���肪�オ��؂�Ȃ��Ɖ����c���Ă��܂��Ĕ��ɃJ�b�R���������ɂȂ��Ă��܂��̂ŉ������o���܂��傤�B
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">����{</td>
		<td class="z" style="text-align:center">�M�^�[�Ȃ�</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="���̉������Đ�����" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>



<hr><a href="?i=1001_2">���̃y�[�W�� ��</a>

<hr><a href="?i=1000">�ꗗ�ɖ߂�</a>
</pre>