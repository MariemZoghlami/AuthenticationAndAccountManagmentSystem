<?php
session_start();

// Ensure the user is logged in
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
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Fetch the logged-in user's data from the database
$userId = $_SESSION["user_id"];
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = :user_id");
$stmt->execute([":user_id" => $userId]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Account Management</h1>
    <p><strong>Username:</strong> <?= htmlspecialchars($user["username"]) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($user["email"]) ?></p>
    
    <!-- Link to delete account with confirmation dialog -->
    <a href="delete_account.php" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">Delete Account</a>
</body>
</html>
