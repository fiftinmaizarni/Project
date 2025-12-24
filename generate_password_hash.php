<?php
/**
 * Script untuk generate password hash
 * Jalankan: php generate_password_hash.php
 */

$password = 'admin123';
$hash = password_hash($password, PASSWORD_DEFAULT);

echo "Password: " . $password . "\n";
echo "Hash: " . $hash . "\n";
echo "\n";
echo "SQL INSERT statement:\n";
echo "INSERT INTO `admin` (`id_admin`, `nama_admin`, `username`, `password`) VALUES\n";
echo "(1, 'Admin User', 'admin', '" . $hash . "');\n";

