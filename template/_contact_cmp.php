<?php if (array_shift(get_included_files()) === __FILE__) die('cannot call directly'); ?>
<?php

$head_title = "���₢���킹 - ����";

$sql = "insert into contact 
(id,term,title,name,mail_addr,body,from_ip,from_addr,delete_flg,delete_date)
values
(?, sysdate(), ?, ?, ?, ?, ?, ?, '0', 0)";

$db = new DBLib($sg);
$db->connect();

$db->prepare($sql);

$db->bind($_POST["id"]);
$db->bind($_POST["title"]);
$db->bind($_POST["name"]);
$db->bind($_POST["addr"]);
$db->bind($_POST["body"]);
$db->bind($_SERVER["REMOTE_ADDR"]);
$db->bind(gethostbyaddr($_SERVER["REMOTE_ADDR"]));

$msg = $db->execute_update_w();

$db->close();



?>
<h2 id="title">���₢���킹 - ����</h2>
<pre>
<p class="cation">���₢���킹������܂����B
���ӌ����肪�Ƃ��������܂����B</p>

<a href="contact.php">�� �߂�</a>
</pre>
