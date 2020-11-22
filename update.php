<?php
include('class/mysql_crud.php');
$db = new Database();
$db->update('produto',array('SKU'=>'"12ASD321"','descricao'=>'"PLAYSTATION 3 COMPLETO"','nome'=>'"PLAY3"','valor'=>'"3000 R$"','peso'=>123),' SKU = "12ASD321"'); // Table name, column names and values, WHERE conditions
$res = $db->getResult();
print_r($res);