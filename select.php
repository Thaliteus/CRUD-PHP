<?php
include('class/mysql_crud.php');
$db = new Database();
$db->select('produto'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
$res = $db->getResult();
print_r($res);
