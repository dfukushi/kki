<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php
	
	
	$msg = "";
	if(isset($_POST["id"])){
		// ログイン入力
		
		$f = login($_POST["id"], $_POST["pw"]);
		if(!$f){
			$msg = "<p class=\"error\">IDもしくはパスワードが違います</p>";
		}
	}
	
	
?>
<h2 id="title">管理者ログイン</h2>
<?php print $msg; ?><?php print $logout_msg; ?>
<form method="post" action="ment.php">
<br />
<table class="camp">
	<tr>
		<td class="z">管理者ID：</td>
		<td><input type="text" size="20" name="id"></td>
	</tr>
	<tr>
		<td class="z">管理者パスワード：</td>
		<td><input type="password" size="20" name="pw"></td>
	</tr>
</table>
<br /><br />
<input type="button" onclick="submit()" value="ログイン">
<input type="hidden" name="ment_mode" value="1">
