<?php

$d = date("YmdHis", time());

ob_start();
phpinfo();
$phpinfo = ob_get_contents();
ob_end_clean();
$filename = "./log/phpinfo.".$d.".log.html";
//file_put_contents($filename, $phpinfo);

$secret = true;
?>
<pre>
<img src="img/illust3470.png" width="300px">


Coming Soon...
</pre>