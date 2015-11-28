<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php



	$sql = "select id, name,DATE_FORMAT(term, '%Y年%m月%d日') as term,title,body, img_path,(play_count+1) as play_count,nice_count,
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

$head_title = "練習風景 - 詳細";

if($mv === "nomv.php"){
	require_once("_s_pr_pno1.php");
	return;
}

$size = filesize($mv);



?>
<h2 id="news"><span><?php print ht($ar["name"]); ?> 様の練習風景</span></h2>
<br />
<br />
<table>
	<tr valign="top">
		<td width="130px"><img src="<?php print $img; ?>"<?php print imgsize($img, 110, 110); ?>></td>
		<td>
<img src="./img/movie-logo.jpg"><br /><p class="small10">ファイルサイズ：<?php print number_format($size); ?>byte</p><br />
<img src="./img/star.png" width="24px"style="vertical-align: -2px">&nbsp;&nbsp;<b style="color:#f00; font-size:18pt"><?php print number_format($ar["nice_count"]); ?></b>&nbsp;いいね！<br />
		</td>
	</tr>
</table>
<br />
<a href="<?php print $mv; ?>" style="font-size:14pt"><img src="img/play2.gif" width="30px" style="vertical-align: -5px">&nbsp;この動画を再生する</a><br />
<pre class="small">※ 動画を再生するためにはmp4を再生出来る環境が必要です。
※ パケットサイズが大きいためモバイル通信機器をご利用の方はパケット定額制のご利用をおすすめします。
   パケット料金については各通信事業者のホームページ等をご参照ください。</pre>
<br />
<table><tr>
<td><a href="javascript:void(0)" onclick="alert('いいね！');document.forms[0].submit();return false;"><img src="img/good.png" width="60px" title="いいね！" border="0"></a></td>
<td><font color="#00f"><b><a href="javascript:void(0)" onclick="alert('いいね！');document.forms[0].submit();return false;"> ← この動画が気に入ったらPUSH！</a></b></font></td></tr></table>
<br />
<hr class="bnd2">
<br />
<table class="camp">
	<tr valign="top">
		<td class="z">バンド名</td>
		<td><?php print ht(g_name($ar["name"])); ?></td>
	</tr>
	<tr valign="top">
		<td class="z">演奏曲</td>
		<td><?php print ht(g_song($ar["title"])); ?></td>
	</tr>
	<tr valign="top">
		<td class="z">撮影日</td>
		<td><?php print ht($ar["term"]); ?></td>
	</tr>
	<tr valign="top">
		<td class="z">再生回数</td>
		<td><?php print number_format($ar["play_count"]); ?>回</td>
	</tr>
	<tr valign="top">
		<td class="z">バンドから一言</td>
		<td><pre style="display:inline"><?php print ht(g_body($ar["body"])); ?></pre></td>
	</tr>
</table>
<br /><br /><br />
<form method="post">
<input type="hidden" name="p" value="5">
</form>
<hr>
<a href="s_pr.php">＜ 戻る</a>
