<?php


$db = mysql_connect("localhost", "u_triplexross", "VWXWCLWC");

if(!$db){
	die('DB connect error '.mysql_error());
	die;
}

$s = mysql_select_db("u_triplexross", $db);
if(!$s){
	print mysql_error();
	mysql_close($db);
	die('DB select error ');
}

mysql_set_charset('SHIFT-JIS');

/*
$sql = "delete from AAA";
//$sql = "create table AAA (id varchar(10), name varchar(20))";
$result_flag = mysql_query($sql);

if (!$result_flag) {
	print mysql_error();
	mysql_close($db);
    die('INSERT�N�G���[�����s���܂����B');
}
*/
$sql = "INSERT INTO AAA VALUES (4, '����������')";
$result_flag = mysql_query($sql);

if (!$result_flag) {
	print mysql_error();
	mysql_close($db);
    die('INSERT�N�G���[�����s���܂����B');
}



$result = mysql_query('SELECT id, name from AAA');
while ($row = mysql_fetch_assoc($result)) {
    print($row['id']);
    print($row['name']);
}

mysql_close($db);
?>