<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php

$chk_rule = @array(
				new RULE2($_POST["id"], "ID", true),
				new RULE2($_POST["name"], "名前", false, 0, 20),
				new RULE2($_POST["title"], "件名", false, 0, 100),
				new RULE2($_POST["addr"], "連絡先", false, 0, 100, P_MAIL),
				new RULE2($_POST["body"], "お問い合わせ内容", true, 1, 2048),

);


$back = false;
if(isset($_POST["p"])){
	$p = $_POST["p"];
	
	try{
		if($p == 1){
			check();
			require_once("_contact_confirm.php");
			return;
		}else if($p == 2){
			check();
			require_once("_contact_cmp.php");
			return;
		}else if($p == 0){
			$back = true;
		}
		
	}catch(Exception $e){
		$errmsg = makeError($e->getMessage());
		$back = true;
	}
}

$name = "";
$addr = "";
$body = "";
$title = "";

if($back){
	$id = $_POST["id"];
	$name = $_POST["name"];
	$addr = $_POST["addr"];
	$title = $_POST["title"];
	$body = $_POST["body"];
}else{
	$id = make_id("contact");
}

?>
<h2 id="title">お問い合わせ<span>Contact</span></h2>
<?php print $errmsg; ?>
<pre>
以下の各種方法にてお問い合わせください。


<table>
	<tr>
		<td align="right">電話：</td>
		<td><a href="tel:<?php print ht($design["tel"]); ?>"><?php print ht($design["tel"]); ?></a></td>
	</tr>
	<tr>
		<td align="right">FAX：</td>
		<td><?php print ht($design["fax"]); ?></td>
	</tr>
	<tr>
		<td align="right">メール：</td>
		<td><a href="mailto:<?php print ht($design["mailaddr"]); ?>"><?php print ht($design["mailaddr"]); ?></a></td>
	</tr>
<table>
<form method="post">
入力フォーム：
<table class="simple">
	<tr valign="top">
	<td>名前</td>
	<td><input type="text" size="40" name="name" value="<?php print ht($name); ?>"></td>
	</tr>
	
	<tr valign="top">
	<td>連絡先</td>
	<td><input type="text" size="40" name="addr" value="<?php print ht($addr); ?>"><br /><p class="small2">メールアドレスまたは電話番号を入力してください</p></td>
	</tr>

	<tr valign="top">
	<td>件名</td>
	<td><input type="text" size="40" name="title" value="<?php print ht($title); ?>"></td>
	</tr>
		
	<tr valign="top">
	<td>お問い合わせ内容</td>
	<td><textarea cols="60" rows="8" name="body"><?php print ht($body); ?></textarea></tr>
</table>
<input type="button" value="送信する" class="btn" onclick="submit()">
<input type="hidden" name="p" value="1"><input type="hidden" name="id" value="<?php print ht($id); ?>">
</form>
<hr><pre class="small">※入力フォームやメールでのお問い合わせには回答にお時間をいただく場合がございますので
お急ぎの場合はお電話でお問い合わせください。</pre>
</pre>
