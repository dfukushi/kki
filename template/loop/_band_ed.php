<hr class="bnd">
<table><tr>
	<td width="150px" valign="top"><br />
<img src="<?php print $img1; ?>"<?php print imgsize($img1, 110, 110); ?>>
	</td>
	<td valign="top">
<br />
	
	<table class="bnd">
	<tr><th colspan="2"><?php print ht($ar["name"]); ?></th></tr>
		
	<tr>
	<td>バンド名</td>
	<td><?php print ht($ar["name"]); ?></td>
	</tr>
<?php if($ar["genre"] !== ""){ ?>
	<tr>
	<td>ジャンル</td>
	<td><?php print ht($ar["genre"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["member"] !== ""){ ?>
	<tr>
	<td>メンバー</td>
<td>
<pre><?php print ht($ar["member"]); ?></pre></td>
	</tr>
<?php } ?>
<?php if($ar["place"] !== ""){ ?>
	<tr>
	<td>主な活動場所</td>
	<td><?php print ht($ar["place"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["url"] !== ""){ ?>
	<tr>
	<td>公式ホームページ</td>
	<td><a href="<?php print ht($ar["url"]); ?>" target="_blank"><?php print ht($ar["url"]); ?></a></td>
	</tr>
<?php } ?>
<?php if($ar["soundpage"] !== ""){ ?>
	<tr>
	<td>サウンド視聴</td>
	<td><a href="<?php print ht($ar["soundpage"]); ?>"><?php print ht($ar["soundpage"]); ?></a></td>
	</tr>
<?php } ?>
<?php if($ar["pr"] !== ""){ ?>
	<tr>
	<td>バンドPR</td>
	<td>
<pre><?php print ht($ar["pr"]); ?></pre></td>
	</tr>
<?php } ?>
<?php if($ar["next"] !== ""){ ?>
	<tr>
	<td>今後の活動予定</td>
	<td>
<pre><?php print ht($ar["next"]); ?>
</pre></td>
	</tr>
<?php } ?>
	</table>
	</td>
	</tr>
</table>

<br />
<br />