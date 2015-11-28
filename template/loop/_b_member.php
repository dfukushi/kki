<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php
	
	$back = false;
	if(isset($_POST["p"])){
	
		$p = $_POST["p"];
		if($p == "a"){
			require_once("_b_member_create.php");
			return;
			
		}else if($p == "1"){
			require_once("_b_member_confirm.php");
			return;
		}else if($p == "2"){
			require_once("_b_member_cmp.php");
			return;
		}else if($p == "0"){
			$back = true;
			require_once("_b_member_create.php");
			return;
		}
	}


$sql = "select date_format(term, '%Y/%m/%d %H:%i') as term,name,title,mail_addr,body from bbs_member where delete_flg = '0' order by term desc";
$db = new DBLib($sg);
$db->connect();

$db->prepare($sql);
$arr = $db->execute();

$db->close();

$temp = 
"<p class=\"line\">%s</p>投稿者：%s&nbsp;&nbsp;&nbsp;(%s)&nbsp;&nbsp;&nbsp;<a href=\"mailto:%s\"><img 
src=\"img/mail1.jpg\" width=\"35px\" style=\"vertical-align: -10px\" border=0></a>\n\n%s





";

$body = "";
foreach($arr as $ar){
	$body .= sprintf($temp, 
						ht($ar["title"]),
						ht($ar["name"]),
						ht($ar["term"]),
						ht($ar["mail_addr"]),
						ht($ar["body"])
	);
	
}

?>
<h2 id="title">メンバー募集<span>Member Collection</span></h2>
<br />
<pre>

<?php print $body; ?>

<?php print $paging; ?>


</pre>
<form method="post">
<input type="button" value="書き込む" onclick="submit()">
<input type="hidden" name="p" value="a">
</form>