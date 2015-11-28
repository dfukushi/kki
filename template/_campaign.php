<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php
	

	if(isset($_GET["i"])){
		
		$p = "template/camp/".$_GET["i"].".php";
		if(file_exists($p)){
			require_once($p);
			return;
		}
		
	}
	
?>
<h2 id="title">キャンペーン<span>Campaign</span></h2>
<pre>

随時新しい情報を公開していきます


</pre>