<hr class="bnd">
<table width="700px"><tr>
	<td width="150px" valign="top"><br />
<img src="<?php print $img1; ?>"<?php print imgsize($img1, 120, 120); ?>>
	</td>
	<td valign="top" width="550px">
<br />
	
	<table class="bnd" width="550px">
	<tr><th colspan="2"><?php print ht($ar["name"]); ?></th></tr>
		
	<tr>
	<td width="120px">バンド名</td>
	<td width="430px"><?php print ht($ar["name"]); ?></td>
	</tr>
<?php if($ar["genre"] !== ""){ ?>
	<tr>
	<td width="120px">ジャンル</td>
	<td width="430px"><?php print ht($ar["genre"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["member"] !== ""){ ?>
	<tr>
	<td width="120px">メンバー</td>
<td width="430px">
<?php print htbr($ar["member"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["place"] !== ""){ ?>
	<tr>
	<td width="120px">主な活動場所</td>
	<td width="430px"><?php print ht($ar["place"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["url"] !== ""){ ?>
	<tr>
	<td width="120px">公式ホームページ</td>
	<td width="430px"><a href="<?php print ht($ar["url"]); ?>" target="_blank"><?php print ht($ar["url"]); ?></a></td>
	</tr>
<?php } ?>
<?php if($ar["soundpage"] !== ""){ ?>
	<tr>
	<td width="120px">サウンド視聴</td>
	<td width="430px"><a href="<?php print ht($ar["soundpage"]); ?>" target="_blank"><?php print ht($ar["soundpage"]); ?></a></td>
	</tr>
<?php } ?>
<?php if($ar["pr"] !== ""){ ?>
	<tr>
	<td width="120px">バンドPR</td>
	<td width="430px">
<?php print htbr($ar["pr"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["next"] !== ""){ ?>
	<tr>
	<td width="120px">今後の活動予定</td>
	<td width="430px">
<?php print htbr($ar["next"]); ?></td>
	</tr>
<?php } ?>
	</table>
	</td>
	</tr>
</table>

<br />
<br />
<br />
