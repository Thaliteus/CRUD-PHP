<?php
include('class/mysql_crud.php');
$db = new Database();
$db->delete('produto','"12ASD321"');  // Table name, WHERE conditions
$res = $db->getResult();  
print_r($res);