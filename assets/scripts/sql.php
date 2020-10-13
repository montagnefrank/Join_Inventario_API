<?php

$filename = 'joinventory.sql';
$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_database = 'joinventory';

//CONEXION A DB
$c = mysqli_connect($mysql_host, $mysql_username, $mysql_password, $mysql_database);
if (!$c) {
    echo "Error: No hay conexión a la Base de Datos." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

$templine = '';
$lines = file($filename);
foreach ($lines as $line) {
    
    if (substr($line, 0, 2) == '--' || $line == '')
        continue;

    $templine .= $line;
    if (substr(trim($line), -1, 1) == ';') {
        $result = $c->query($templine) or die('error mysql' . $c->error);
        $templine = '';
    }
}

echo "BASE DE DATOS IMPORTADA EXITOSAMENTE";
