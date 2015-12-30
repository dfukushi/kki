<?php

	$alog = new Alog();

	ob_start();
	// ここだけ動的に  (バッファリングする)
	require_once($template);
	$body = ob_get_clean();

	if(!$secret){
		//$alog->write();
	}

	require_once($sg["TEMPLATE_PATH"]."/basic/_head.php");

?>
<table>
	<tr>
	<td valign="top" width="200px">
<?php
	require_once($sg["TEMPLATE_PATH"]."/basic/_menu.php");
?>
	</td>
	<td valign="top">
<?php
	print $body;
?>
	</td>
	</tr>
</table>
<?php
	require_once($sg["TEMPLATE_PATH"]."/basic/_tail.php");
?>