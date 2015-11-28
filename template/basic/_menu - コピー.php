<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php if($ment_mode){ ?><br /><a href="./ment.php">管理画面トップへ</a>
<br /><br /><a href="./ment.php?logout=1">管理画面からログアウト</a><?php }else{ ?>
<br />&nbsp;&nbsp;&nbsp;<a href="./">＞ トップ画面へ</a><br />
<?php } ?>
<p class="button">
	<a href="news.php" title="最新情報を表示します">■ 最新情報</a>
	<a href="bhour.php" title="各営業時間や定休日の情報を表示します">■ 営業時間</a>
	<a href="studio.php" title="各部屋の情報や料金表などをまとめてあります">■ スタジオ紹介</a>
	<a href="reserve.php" title="スタジオの予約方法を表示します">■ スタジオ予約</a>
	<a href="recording.php" title="レコーディングについて紹介しています">■ レコーディング</a>
</p><hr class="design" /><p class="button">
	<a href="s_pr.php" title="当スタジオで練習いただいたバンドの練習動画を配信しています">■ 練習風景</a>
	<a href="band.php" title="地元で活躍中のバンドを紹介しています">■ バンド紹介</a>
</p><hr class="design" /><p class="button">
	<a href="b_member.php" title="掲示板ですのでメンバー募集に自由にご利用ください">■ メンバー募集</a>
	<a href="b_event.php" title="掲示板ですのでイベントの告知に自由にご利用ください">■ イベント告知</a>
</p><hr class="design" /><p class="button">
	<a href="access.php" title="当スタジオの所在地や交通手段などを表示します">■ アクセス</a>
	<a href="faq.php" title="当スタジオへよくいただく質問をまとめてあります">■ よくある質問</a>
	<a href="contact.php" title="当スタジオへのお問い合わせはこちらまで">■ お問い合わせ</a>
</p><hr class="design" />
<br />
<?php if($sg["TITLE_IMG_OFF"] != 1){ ?>
<a href="https://twitter.com/&#8206;" title="twitter" target="_blank"><img src="img/twitter.jpg" border="0"></a>
<a href="http://line.naver.jp/ja/" title="line" target="_blank"><img src="img/linex.jpg" height="27px" border="0"></a>
<a href="https://ja-jp.facebook.com/" title="facebook" target="_blank"><img src="img/facebook.jpg" border="0"></a>
<a href="http://www.youtube.com/?gl=JP&hl=ja" title="YouTube" target="_blank"><img src="img/youtube.jpg" border="0"></a>
<a href="http://www.nicovideo.jp/" title="ニコニコ動画" target="_blank"><img src="img/nico.jpg" border="0"></a>
<a href="http://www.ustream.tv/new" title="Ustream" target="_blank"><img src="img/ust1.jpg" border="0"></a>
<?php
	$sql = "select id,title,url,img_path, priority
	from link where delete_flg = '0' order by priority asc";

	$db = new DBLib($sg);
	$db->connect();
	$db->prepare($sql);

	$arr = $db->execute();
	$db->close();
	
	$fmt = '<a href="%s" title="%s" target="_blank"><img src="%s" border="0"%s></a>' . "\n";
		
	foreach($arr as $ar){
		
		$img = "img/noimage.jpg";
		if($ar["img_path"] != ""){
			$img = $ar["img_path"];
			if(!file_exists($img)){
				$img = "img/noimage.jpg";
			}else{
			}
		}
		
		
		$v = sprintf($fmt, 
						ht($ar["url"]),
						ht($ar["title"]),
						$img,
						imgsize($img, 120, 20)
		);
		
		print $v;
	}

?>
<br /><br /><img src="img/QRcode.gif" width="100px">
<?php } ?>