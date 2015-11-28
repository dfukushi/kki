<!DOCTYPE html>
<html lang="ja">

<head>
<?php 
	$u = basename($_SERVER["SCRIPT_FILENAME"]);
	if($u === "index.php"){
		// トップページならインデックスOK
?>
	<meta name="robots" content="index,nofollow,noarchive,noydir">
	<meta name="Googlebot-Image" content="noindex,nofollow">
	<meta name="psbot" content="index,nofollow">
	<meta name="Yahoo-MMCrawler" content="index,nofollow">
	<meta name="keywords" content="<?php print ht($design["google_key"]); ?>">
	<meta name="description" content="<?php print ht($design["google_desc"]); ?>">
<?php
	}else{
?>
	<meta name="robots" content="noindex,nofollow,noarchive,noydir">
	<meta name="Googlebot-Image" content="noindex,nofollow">
	<meta name="psbot" content="noindex,nofollow">
	<meta name="Yahoo-MMCrawler" content="noindex,nofollow">
<?php
	}
?>
	<meta http-equiv="Content-Type" content="text/html ; charset=Shift_JIS">
	<meta http-equiv="Content-Style-Type" content="text/css">
	<meta http-equiv="Content-Script-Type" content="text/javascript">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
	<title><?php print ht($head_title); ?></title>
	<link rel="stylesheet" type="text/css" href="css/a.css">
	<script type="text/javascript" src="css/a.js"></script>
</head>
<body>