<?php
$server = 'SERVERDOMAIN';

try{
	$config = parse_ini_file('db.ini');
	$datab = $config['db'];
	$conn = new PDO("mysql:host=$server;dbname=$datab;", $config[username], $config[password]);
} catch(PDOException $e){
	die( "Connection failed: " . $e->getMessage());
}