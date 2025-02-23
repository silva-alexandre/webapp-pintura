<?php
use Doctrine\DBAL\DriverManager;

require 'vendor/autoload.php';

$connectionParams = [
    'dbname' => 'bdgr',
    'user' => 'grpintor',
    'password' => 'gr2025pintura',
    'host' => '127.0.0.1',
    'driver' => 'pdo_pgsql',
];

try {
    $conn = DriverManager::getConnection($connectionParams);
    echo "Conexão bem-sucedida!";
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}
?>
