<?php
session_start();
if (!isset($_SESSION["user_id"])) {
header("Location: login.html");
    exit;
}

try {
    $pdo = new PDO(
        "sqlsrv:Server=192.168.40.101\\MSSQLSERVER,1433;Database=UserDB;TrustServerCertificate=Yes",
        "sa",
        "Gi604132328!!!",
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
    $stmt->bindParam(":id", $_SESSION["user_id"], PDO::PARAM_INT);

    if ($stmt->execute()) {
        session_destroy();
        header("Location: signup.html");
        exit;
    } else {
        echo "Error: account could not be deleted.";
    }
} catch (PDOException $e) {
    echo "Error deleting account: " . $e->getMessage();
}