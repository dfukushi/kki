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
	<td width="120px">�o���h��</td>
	<td width="430px"><?php print ht($ar["name"]); ?></td>
	</tr>
<?php if($ar["genre"] !== ""){ ?>
	<tr>
	<td width="120px">�W������</td>
	<td width="430px"><?php print ht($ar["genre"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["member"] !== ""){ ?>
	<tr>
	<td width="120px">�����o�[</td>
<td width="430px">
<?php print htbr($ar["member"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["place"] !== ""){ ?>
	<tr>
	<td width="120px">��Ȋ����ꏊ</td>
	<td width="430px"><?php print ht($ar["place"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["url"] !== ""){ ?>
	<tr>
	<td width="120px">�����z�[���y�[�W</td>
	<td width="430px"><a href="<?php print ht($ar["url"]); ?>" target="_blank"><?php print ht($ar["url"]); ?></a></td>
	</tr>
<?php } ?>
<?php if($ar["soundpage"] !== ""){ ?>
	<tr>
	<td width="120px">�T�E���h����</td>
	<td width="430px"><a href="<?php print ht($ar["soundpage"]); ?>" target="_blank"><?php print ht($ar["soundpage"]); ?></a></td>
	</tr>
<?php } ?>
<?php if($ar["pr"] !== ""){ ?>
	<tr>
	<td width="120px">�o���hPR</td>
	<td width="430px">
<?php print htbr($ar["pr"]); ?></td>
	</tr>
<?php } ?>
<?php if($ar["next"] !== ""){ ?>
	<tr>
	<td width="120px">����̊����\��</td>
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
