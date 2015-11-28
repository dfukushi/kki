<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php

$block = "	<tr>
		<td>%s</td>
		<td>%s<br />%s</td>
		<td>%s<br />%s</td>
		<td>%s<br />%s</td>
	</tr>";

function gaku($p){
	if($p == ""){
		return "";
	}
	
	return sprintf("<p class=\"small3\">(%s)</span>", escape($p));
}

function escape($val){
	
	$val = preg_replace("/[^0-9]/", "", $val);
	if($val == ""){
		return "---------";
	}
	return "��".number_format($val);
}

$i = 1;
$b1 = sprintf($block,
				"A st",
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)]),
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)]),
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)])
	);

$b2 = sprintf($block,
				"B st",
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)]),
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)]),
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)])
	);

$b3 = sprintf($block,
				"��",
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)]),
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)]),
				escape($design["studio_p0".$i]),
				gaku($design["studio_p1".($i++)])
	);


function cr($v){
	return str_replace("\r\n", "<br />\n", $v);
}

?>
<h2 id="title">�X�^�W�I�Љ�<span>Studio Introduction </span></h2>
<pre>

<div class="camp2"><?php print cr(ht($design["studio_head"])); ?> </div>


</pre>
<b style="font-size:14pt;color:#0099FF;">�� 1���Ԃ�����̗����\</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="reserve.php">���\��͂����炩��</a><br />
<table class="bhour" style="width:580px">
	<tr>
		<th width="50px">ROOM</th>
		<th width="120px"><?php print ht($design["studio_s1"]); ?></th>
		<th width="120px"><?php print ht($design["studio_s2"]); ?></th>
		<th width="180px"><?php print ht($design["studio_s3"]); ?></th>
	</tr>
<?php print $b1; ?>
<?php print $b2; ?>
<?php print $b3; ?>
</table>
<pre class="small">
<?php print ht($design["studio_cation"]); ?> 



</pre>


<p class="lineh">�� A st</p>
<table><tr>
<td valign="top" width="220px"><br /><img src="img/st1.jpg" width="200px"></td>
<td valign="top">
<pre class="small10"><?php print ht($design["studio_b1"]); ?></pre>
</td>
</tr></table>
<br />
<br />
<p class="lineh">�� B st</p>
<table><tr>
<td valign="top" width="220px"><br /><img src="img/st2.jpg" width="200px"></td>
<td valign="top">
<pre class="small10"><?php print ht($design["studio_b2"]); ?></pre>
</td>
</tr></table>
<br />
<p class="lineh">�� �v���C�x�[�g���[��(��)</p>
<table><tr>
<td valign="top" width="220px"><br /><img src="img/st3.jpg" width="200px"></td>
<td valign="top">
<pre class="small10"><?php print ht($design["studio_b3"]); ?></pre>
</td>
</tr></table>
<br />
<br />
<br />
<div class="x_y">
<b><br />�L�����Z�������|���V�[</b><hr><pre class="small9"><?php print ht($design["studio_cancel"]); ?></pre></div>
<br /><br />
<div class="x_y">
<br /><b>���p�K��</b><hr>
<pre class="small9"><?php print ht($design["studio_riyou"]); ?></pre></div>
