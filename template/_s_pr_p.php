<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php



	$sql = "select id, name,DATE_FORMAT(term, '%Y�N%m��%d��') as term,title,body, img_path,(play_count+1) as play_count,nice_count,
movie_path
from practice 
where id = ? and delete_flg = '0'";



	$sql2 = "update practice set play_count = (play_count + 1)
where id = ? and delete_flg = '0'";

	$sql3 = "update practice set nice_count = (nice_count + 1)
where id = ? and delete_flg = '0'";


$id = $_GET["i"];


$db = new DBLib($sg);
$db->connect();

$db->prepare($sql);
$db->bind($id);
$ar = $db->execute1();


if($ar == null){
	$db->close();
	require_once("_s_pr_p0.php");
	return;
}

$db->prepare($sql2);
$db->bind($id);
$db->execute_update_w();

if(isset($_POST["p"])){
	$db->prepare($sql3);
	$db->bind($id);
	$db->execute_update_w();
	$ar["nice_count"]++;
}

$db->close();


$img = "img/noimage.jpg";
if($ar["img_path"] != ""){
	$img = $ar["img_path"];
	if(!file_exists($img)){
		$img = "img/noimage.jpg";
	}
}

$mv = "nomv.php";
if($ar["movie_path"] != ""){
	$mv = $ar["movie_path"];
	if(!file_exists($mv)){
		$mv = "nomv.php";
	}
}

$head_title = "���K���i - �ڍ�";

if($mv === "nomv.php"){
	require_once("_s_pr_pno1.php");
	return;
}

$size = filesize($mv);



?>
<h2 id="news"><span><?php print ht($ar["name"]); ?> �l�̗��K���i</span></h2>
<br />
<br />
<table>
	<tr valign="top">
		<td width="130px"><img src="<?php print $img; ?>"<?php print imgsize($img, 110, 110); ?>></td>
		<td>
<img src="./img/movie-logo.jpg"><br /><p class="small10">�t�@�C���T�C�Y�F<?php print number_format($size); ?>byte</p><br />
<img src="./img/star.png" width="24px"style="vertical-align: -2px">&nbsp;&nbsp;<b style="color:#f00; font-size:18pt"><?php print number_format($ar["nice_count"]); ?></b>&nbsp;�����ˁI<br />
		</td>
	</tr>
</table>
<br />
<a href="<?php print $mv; ?>" style="font-size:14pt"><img src="img/play2.gif" width="30px" style="vertical-align: -5px">&nbsp;���̓�����Đ�����</a><br />
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
<input type="hidden" name="p" value="5">
</form>
<hr>
<a href="s_pr.php">�� �߂�</a>
