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
<h2 id="title">�L�����y�[��<span>Campaign</span></h2>
<pre>

�����V�����������J���Ă����܂�


</pre>