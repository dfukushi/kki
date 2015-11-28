<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php



if(isset($_GET["i"])){
	// iがあれば詳細ページ表示
	require_once("_s_pr_p.php");
	return;
}

function make_body($db){
	
	global $ment_mode;

	$temp = file_get_contents("./template/loop/".basename(__FILE__));
	
	$ed_temp = "\n\n<input type=\"button\" value=\"編集\" onclick=\"d('u');document.forms[0].id.value='%s';submit()\">&nbsp;<input type=\"button\" value=\"削除\" onclick=\"d('d');document.forms[0].id.value='%s';submit()\">\n";

	$sql = "select id, name,DATE_FORMAT(term, '%Y年%m月%d日') as term,title,body, img_path, nice_count, play_count,
movie_path
from practice 
where delete_flg = '0'
order by term desc, create_date desc";



	$sql = paging($db, $sql);

	$db->prepare($sql);
	
	$ret = "";
	$arr = $db->execute();
	foreach($arr as $ar){
		
		$img = "img/noimage.jpg";
		if($ar["img_path"] != ""){
			$img = $ar["img_path"];
			if(!file_exists($img)){
				$img = "img/noimage.jpg";
			}else{
			}
		}
	
		
		$ret .= sprintf(
						$temp, 
						$img,
						imgsize($img, 110, 110),
						ht($ar["name"]),
						ht($ar["name"]),
						ht($ar["term"]),
						number_format($ar["nice_count"]),
						number_format($ar["play_count"]),
						ht($ar["id"]),
						($ment_mode) ? sprintf($ed_temp, $ar["id"], $ar["id"]) : ""
		
		);
	}
	
	return $ret;
}



$db = new DBLib($sg);
$db->connect();

$body = make_body($db);

$db->close();

if(trim($paging) === "<hr>"){
	$paging = "";
}

?>
<h2 id="title">練習風景<span>Practice Scenery</span></h2>
<br />
<div class="camp2">当スタジオでご練習いただいたバンド様の中で
ご希望いただいたバンド様の練習動画を公開しております。</div><br /><br />
<p class="small">※動画を再生するためにはmp4を再生出来る環境が必要です。</p>
<br />
<?php print $body; ?>
<?php print $paging; ?> 
<br />
<hr>
<p class="small">練習風景の公開を希望されるお客さまは当日の練習開始前にスタッフまで公開希望の旨をお伝えください。<br />
スタジオ内に常設の撮影用カメラにて撮影させていただいた上で後日公開致します。<br />
<br />
なお申し訳ありませんが撮影した映像素材の個別の提供は出来かねますのでご了承ください。<br /></p>
