<?php
$pdo = new PDO("mysql:host=localhost;dbname=your_database", "your_db_username", "your_db_password");

$hashedPassword = password_hash("mypassword123", PASSWORD_DEFAULT);
$stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
$stmt->execute([":username" => "testuser", ":password" => $hashedPassword]);

echo "User added!";
?>