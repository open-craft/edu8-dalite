<?php
$config = new \Doctrine\DBAL\Configuration();
$connectionParams = [
'dbname' => 'dalite',
    'user' => 'root',
    'password' => 'pass',
    'host' => 'localhost',
    'driver' => 'pdo_mysql'];
return \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
?>
