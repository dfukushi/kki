<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php

function make_faq($db){

	$temp = "<div class=\"x_o\">Q. %s</div>
%s


";
	$sql = "select question,answer from faq order by id asc";
	$db->prepare($sql);
	
	$ret = "";
	$arr = $db->execute();
	foreach($arr as $ar){
		
		//$ret .= sprintf($temp, ht($ar["question"]), ht($ar["answer"]));
		$ret .= sprintf($temp, $ar["question"], $ar["answer"]);
	}
	
	return $ret;
}


$db = new DBLib($sg);
$db->connect();

$body = make_faq($db);

$db->close();



?>
<h2 id="title">‚æ‚­‚ ‚éŽ¿–â<span>Frequently Asked Question</span></h2>
<pre>

<?php print $body ?>
</pre>