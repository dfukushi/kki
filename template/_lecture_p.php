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
<h4>第<?php print ht($ar["round"]); ?>回&nbsp;&nbsp;<?php print ht($ar["title"]); ?></h2>
<pre>

<div class="camp1">xxガールズバンドの代表格・SCANDALの10枚目のシングル「ハルカ」のカップリング曲として収録されている「サティスファクション」を取り上げます。<br />
各パートとも比較的弾きやすい上にライブでも盛り上がるアッパーチューンなのでぜひマスターしよう！
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
<p class="small">※ 当講座用に各パートは簡略化してありますので実際のCD音源とは異なる場合があります。</p>

<?php 
	$i = 1;
	foreach($part as $pa){ 
?>
<p class="linecam"><?php print $i ?>.  <?php print ht($pa["title"]); ?></p>
<?php 
	foreach($item as $it){ 
?>
<u class="sub"><?php print ht($it["title"]); ?></u>
<a href="<?php print ht($it["img_path"]); ?>"><img src="<?php print ht($it["img_path"]); ?>"<?php imgsize($it["img_path"], 100, 100); ?> border=0 title="拡大する"></a>&nbsp;&nbsp;<p class="small2">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;<?php print ht($it["head"]); ?>
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>

<?php
	}
?> 
<?php
	$i++;
	}
?> 

<p class="linecam">2. リードギターパートの練習 <span>(MAMIパート)</span></p>


<u class="sub">Aメロ</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;イントロから特徴的なカッティングで始まります。複雑そうに聴こえるかも知れませんが左手のコードはずっと同じなので、まずは左手の押さえ方を覚えて、後は右手のリズムを覚えます。
カッティングする時は左手を浮かせます。左手が上がり切らないと音が残ってしまって非常にカッコ悪い感じになってしまうので加減を覚えましょう。
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>

<u class="sub">Bメロ</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;イントロから特徴的なカッティングで始まります。複雑そうに聴こえるかも知れませんが左手のコードはずっと同じなので、まずは左手の押さえ方を覚えて、後は右手のリズムを覚えます。
カッティングする時は左手を浮かせます。左手が上がり切らないと音が残ってしまって非常にカッコ悪い感じになってしまうので加減を覚えましょう。
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>


<u class="sub">サビ</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;イントロから特徴的なカッティングで始まります。複雑そうに聴こえるかも知れませんが左手のコードはずっと同じなので、まずは左手の押さえ方を覚えて、後は右手のリズムを覚えます。
カッティングする時は左手を浮かせます。左手が上がり切らないと音が残ってしまって非常にカッコ悪い感じになってしまうので加減を覚えましょう。
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>



<p class="linecam">3. リードギターパートの練習 <span>(HARUKAパート)</span></p>
<u class="sub">イントロ</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0 title="拡大する"></a>&nbsp;&nbsp;<p class="small2">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;イントロから特徴的なカッティングで始まります。複雑そうに聴こえるかも知れませんが左手のコードはずっと同じなので、まずは左手の押さえ方を覚えて、後は右手のリズムを覚えます。
カッティングする時は左手を浮かせます。左手が上がり切らないと音が残ってしまって非常にカッコ悪い感じになってしまうので加減を覚えましょう。
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>


<u class="sub">Aメロ</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;イントロから特徴的なカッティングで始まります。複雑そうに聴こえるかも知れませんが左手のコードはずっと同じなので、まずは左手の押さえ方を覚えて、後は右手のリズムを覚えます。
カッティングする時は左手を浮かせます。左手が上がり切らないと音が残ってしまって非常にカッコ悪い感じになってしまうので加減を覚えましょう。
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>

<u class="sub">Bメロ</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;イントロから特徴的なカッティングで始まります。複雑そうに聴こえるかも知れませんが左手のコードはずっと同じなので、まずは左手の押さえ方を覚えて、後は右手のリズムを覚えます。
カッティングする時は左手を浮かせます。左手が上がり切らないと音が残ってしまって非常にカッコ悪い感じになってしまうので加減を覚えましょう。
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>


<u class="sub">サビ</u>
<a href="img/JPGPFA03626.gif"><img src="img/JPGPFA03626.gif" width="100px" border=0></a>
<p class="small">※ クリックすると拡大表示出来ます</p>

<div class="camp1">&nbsp;&nbsp;イントロから特徴的なカッティングで始まります。複雑そうに聴こえるかも知れませんが左手のコードはずっと同じなので、まずは左手の押さえ方を覚えて、後は右手のリズムを覚えます。
カッティングする時は左手を浮かせます。左手が上がり切らないと音が残ってしまって非常にカッコ悪い感じになってしまうので加減を覚えましょう。
</div>
<table class="camp">
	<tr align="center">
		<td class="z" style="text-align:center">お手本</td>
		<td class="z" style="text-align:center">ギターなし</td>
	</tr>
	<tr>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
		<td style="text-align:center"><a href=""><img src="img/play.gif" border=0 title="この音源を再生する" style="vertical-align: -3px; width:30px"></a></td>
	</tr>
</table>



<hr><a href="?i=1001_2">次のページへ ＞</a>

<hr><a href="?i=1000">一覧に戻る</a>
</pre>