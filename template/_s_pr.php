<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php



if(isset($_GET["i"])){
	// i������Ώڍ׃y�[�W�\��
	require_once("_s_pr_p.php");
	return;
}

function make_body($db){
	
	global $ment_mode;

	$temp = file_get_contents("./template/loop/".basename(__FILE__));
	
	$ed_temp = "\n\n<input type=\"button\" value=\"�ҏW\" onclick=\"d('u');document.forms[0].id.value='%s';submit()\">&nbsp;<input type=\"button\" value=\"�폜\" onclick=\"d('d');document.forms[0].id.value='%s';submit()\">\n";

	$sql = "select id, name,DATE_FORMAT(term, '%Y�N%m��%d��') as term,title,body, img_path, nice_count, play_count,
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
<h2 id="title">���K���i<span>Practice Scenery</span></h2>
<br />
<div class="camp2">���X�^�W�I�ł����K�����������o���h�l�̒���
����]�����������o���h�l�̗��K��������J���Ă���܂��B</div><br /><br />
<p class="small">��������Đ����邽�߂ɂ�mp4���Đ��o��������K�v�ł��B</p>
<br />
<?php print $body; ?>
<?php print $paging; ?> 
<br />
<hr>
<p class="small">���K���i�̌��J����]����邨�q���܂͓����̗��K�J�n�O�ɃX�^�b�t�܂Ō��J��]�̎|�����`�����������B<br />
�X�^�W�I���ɏ�݂̎B�e�p�J�����ɂĎB�e�����Ă�����������Ō�����J�v���܂��B<br />
<br />
�Ȃ��\���󂠂�܂��񂪎B�e�����f���f�ނ̌ʂ̒񋟂͏o�����˂܂��̂ł��������������B<br /></p>
