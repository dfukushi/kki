<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<h2 id="news"><span><?php print ht($ar["name"]); ?> 様の練習風景</span></h2>
<br />
<br />
<table>
	<tr valign="top">
		<td width="130px"><img src="<?php print $img; ?>"<?php print imgsize($img, 110, 110); ?>></td>
		<td>
<img src="./img/movie-logo.jpg"><br /><p class="small10">ファイルサイズ： --- byte</p><br />
<img src="./img/star.png" width="24px" style="vertical-align: -2px">&nbsp;&nbsp;<b style="color:#f00; font-size:18pt"><?php print number_format($ar["nice_count"]); ?></b>&nbsp;いいね！<br />
		</td>
	</tr>
</table>
<br />
<img src="img/x.png" width="30px">&nbsp;&nbsp;<b style="color:#f00">現在この動画は再生出来ません</b>
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
<input type="hidden" name="p" value="1">
</form>
<hr>
<a href="s_pr.php">＜ 戻る</a>
