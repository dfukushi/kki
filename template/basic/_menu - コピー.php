<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php if($ment_mode){ ?><br /><a href="./ment.php">�Ǘ���ʃg�b�v��</a>
<br /><br /><a href="./ment.php?logout=1">�Ǘ���ʂ��烍�O�A�E�g</a><?php }else{ ?>
<br />&nbsp;&nbsp;&nbsp;<a href="./">�� �g�b�v��ʂ�</a><br />
<?php } ?>
<p class="button">
	<a href="news.php" title="�ŐV����\�����܂�">�� �ŐV���</a>
	<a href="bhour.php" title="�e�c�Ǝ��Ԃ��x���̏���\�����܂�">�� �c�Ǝ���</a>
	<a href="studio.php" title="�e�����̏��◿���\�Ȃǂ��܂Ƃ߂Ă���܂�">�� �X�^�W�I�Љ�</a>
	<a href="reserve.php" title="�X�^�W�I�̗\����@��\�����܂�">�� �X�^�W�I�\��</a>
	<a href="recording.php" title="���R�[�f�B���O�ɂ��ďЉ�Ă��܂�">�� ���R�[�f�B���O</a>
</p><hr class="design" /><p class="button">
	<a href="s_pr.php" title="���X�^�W�I�ŗ��K�����������o���h�̗��K�����z�M���Ă��܂�">�� ���K���i</a>
	<a href="band.php" title="�n���Ŋ������̃o���h���Љ�Ă��܂�">�� �o���h�Љ�</a>
</p><hr class="design" /><p class="button">
	<a href="b_member.php" title="�f���ł��̂Ń����o�[��W�Ɏ��R�ɂ����p��������">�� �����o�[��W</a>
	<a href="b_event.php" title="�f���ł��̂ŃC�x���g�̍��m�Ɏ��R�ɂ����p��������">�� �C�x���g���m</a>
</p><hr class="design" /><p class="button">
	<a href="access.php" title="���X�^�W�I�̏��ݒn���ʎ�i�Ȃǂ�\�����܂�">�� �A�N�Z�X</a>
	<a href="faq.php" title="���X�^�W�I�ւ悭��������������܂Ƃ߂Ă���܂�">�� �悭���鎿��</a>
	<a href="contact.php" title="���X�^�W�I�ւ̂��₢���킹�͂�����܂�">�� ���₢���킹</a>
</p><hr class="design" />
<br />
<?php if($sg["TITLE_IMG_OFF"] != 1){ ?>
<a href="https://twitter.com/&#8206;" title="twitter" target="_blank"><img src="img/twitter.jpg" border="0"></a>
<a href="http://line.naver.jp/ja/" title="line" target="_blank"><img src="img/linex.jpg" height="27px" border="0"></a>
<a href="https://ja-jp.facebook.com/" title="facebook" target="_blank"><img src="img/facebook.jpg" border="0"></a>
<a href="http://www.youtube.com/?gl=JP&hl=ja" title="YouTube" target="_blank"><img src="img/youtube.jpg" border="0"></a>
<a href="http://www.nicovideo.jp/" title="�j�R�j�R����" target="_blank"><img src="img/nico.jpg" border="0"></a>
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