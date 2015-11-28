<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); 


function make_schedule($db){
	
	global $text_titles;
	
	$mn1 = date("Ym");

	$sql1 = "select body from schedule where ymd = ?";
	$db->prepare($sql1);
	$db->bind($mn1);

	$val = $db->execute11();
	if($val == null){
	
		$ret = "<li><span>". ht($text_titles["bhour_regular"])."\n";
		return $ret;
		
	}

	$r = explode("\r\n", $val);

	$ret = "";
	$cnt = 0;
	foreach($r as $v){
		$v = trim($v);
		if($v == ""){
			continue;
		}
		$ret .= "<li><span>".ht($v)."</span></li>\n";
		$cnt++;
	}
	$ret .= "<li><span>他、".ht($text_titles["bhour_regular"])."\n";

	return $ret;
}

function make_news($db){

	$sql1 = "select id,title from news 
where delete_flg = '0' and open_flg = '1' and start_date <= sysdate() and end_date > sysdate()
order by start_date desc
limit 3";

	$db->prepare($sql1);

	$arr = $db->execute();
	$ret = "";
	foreach($arr as $ar){
		
		$ret .= sprintf("<li><span><a href=\"news.php?i=%s\">%s</a></span></li>\n",
									$ar["id"],
									g_title(ht($ar["title"])));
	}

	return $ret;
}

function make_pr($db){

	$sql1 = "select id,name,movie_path,date_format(term, '%Y年%m月%d日') as term from practice 
where delete_flg = '0'
order by create_date desc
limit 2";

	$db->prepare($sql1);

	$arr = $db->execute();
	$ret = "";
	foreach($arr as $ar){

		$ret .= sprintf("<li><a href=\"s_pr.php?i=%s\">%s 様</a>&nbsp;&nbsp;<p class=\"small2\">(%sの練習風景)</p></li>\n",
									$ar["id"],
									g_name(ht($ar["name"])),
									ht($ar["term"]));
	}

	return $ret;
}





$db = new DBLib($sg);
$db->connect();

$sch = make_schedule($db);
$news = make_news($db);
$pr = make_pr($db);

if($news == ""){
	$news = "<li><span>ニュースは特にありません</span></li>";
}

$db->close();

?>
<h4><img src="img/arrow21-006-03.gif" style="vertical-align: -2px">&nbsp;&nbsp;今月の営業日</h4>
<div class="x">
<ul id="ul3">
<?php print $sch; ?>
</ul>
</div>

<br />
<h4><img src="img/arrow21-003-03.gif" style="vertical-align: -2px">&nbsp;&nbsp;お知らせ&nbsp;&nbsp;<img src="img/new01.gif"></h4>
<div class="x">

<ul id="ul1">
<?php print $news; ?>
</ul>
&nbsp;&nbsp;<p class="small10"><a href="news.php">(お知らせ一覧はこちら)</a></p>
</div>
<br />
</div>
<h4 class="a2"><img src="img/o-green.gif" style="vertical-align: -3px"> 練習風景ムービー配信中！<img src="img/o-yellow.gif" style="vertical-align: -3px"></h4>
<table><tr valign="top"><td width="160px" valign="top"><img src="img/st1.jpg" width="150px"><br /><img src="img/st2.jpg" width="150px"></td>
<td valign="top" valign="top"><img src="img/movie-logo.jpg" style="vertical-align: -20px">
<font color="#07f">当スタジオでの練習風景を続々配信中!!</font><br />
<br />
<p style="color:#9C3; display:inline;font-weight:bold;">＜現在配信中のバンド＞</p>
<ul id="ul3">
<?php print $pr; ?>
</ul>
<p class="small10"><a href="s_pr.php">(その他の配信バンド一覧はこちら)</a></p><br /><br />
</td></tr></table>
<hr class="bnd2"><br /><hr />
<pre>
<?php if($sg["TITLE_IMG_OFF"] != 5){ ?>
<a href="campaign.php?i=0001" title="バンドを始めよう！"><img src="img/ba001.jpg"></a>
<a href="campaign.php?i=0002" title="レコーディングについて紹介！"><img src="img/ba002.jpg"></a>
<a href="campaign.php?i=0003" title="iTunes Storeで楽曲を販売しよう！"><img src="img/ba003.jpg"></a>
<a href="campaign.php?i=0004" title="「弾いてみた」「歌ってみた」に投稿しよう！"><img src="img/ba004.jpg"></a>
<?php } ?>
</pre>
	</td>
	</tr>
</table>