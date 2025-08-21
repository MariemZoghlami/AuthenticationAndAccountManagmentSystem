<?php
// Database configuration
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

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputEmail = $_POST["email"] ?? "";
    $inputPassword = $_POST["password"] ?? "";

    // Prepare query to check email
    $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE email = :email");
    $stmt->execute([":email" => $inputEmail]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($inputPassword, $user["password"])) {
        session_start();
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];

        header("Location: dashboard.php");
        exit;
    } else {
        echo "Invalid email or password.";
    }
}