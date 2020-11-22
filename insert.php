<?php
include('class/mysql_crud.php');
$db = new Database();

$db->insert('produto',array('SKU'=>'"12ASD321"','descricao'=>'"PLAYSTATION 2 COMPLETO"','nome'=>'"PLAY2"','valor'=>'"300 R$"','peso'=>123));  // Table name, column names and respective values
$res = $db->getResult();  
print_r($res);