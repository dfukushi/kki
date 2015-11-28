<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php
	
	if(isset($_GET["i"])){
		
		$p = "template/camp/0002_".$_GET["i"].".php";
		if(file_exists($p)){
			require_once($p);
			return;
		}
	}
	
	require_once("camp/0002.php");
	return;
?>
