<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php

$head_title = "お問い合わせ - 確認";

?>
<h2 id="title">お問い合わせ - 確認</h2>
<pre>
<p class="cation">以下の内容で送信しますがよろしいでしょうか？
問題なければ[確定]を押下してください。
修正する場合は[戻る]を押下してください。</p>
<form method="post">
<table class="simple">
	<tr valign="top">
	<td>名前</td>
	<td><input type="hidden" size="40" name="name" value="<?php print ht($_POST["name"]); ?>"><?php print g_name(ht($_POST["name"])); ?></td>
	</tr>
	
	<tr valign="top">
	<td>連絡先</td>
	<td><input type="hidden" size="40" name="addr" value="<?php print ht($_POST["addr"]); ?>"><?php print ht($_POST["addr"]); ?></td>
	</tr>

	<tr valign="top">
	<td>件名</td>
	<td><input type="hidden" size="40" name="title" value="<?php print ht($_POST["title"]); ?>"><?php print g_title(ht($_POST["title"])); ?></td>
	</tr>

	<tr valign="top">
	<td>お問い合わせ内容</td>
	<td width="400px"><?php print ht($_POST["body"]); ?></tr>
</table>
<br />
<input type="button" value="送信する" class="btn" onclick="d('2');submit()">&nbsp;&nbsp;<input type="button" value="戻る" class="btn" onclick="d('0');submit()">
<input type="hidden" name="p" value="2"><input type="hidden" name="id" value="<?php print ht($_POST["id"]); ?>">
<input type="hidden" name="body" value="<?php print ht($_POST["body"]); ?>">
</form><hr><pre class="small">※入力フォームやメールでのお問い合わせには回答にお時間をいただく場合がございますので
お急ぎの場合はお電話でお問い合わせください。</pre>
</pre>
