<?php
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $password = $_POST["password"] ?? "";
    $repeatPassword = $_POST["repeat-password"] ?? "";

    // Password match check
    if ($password !== $repeatPassword) {
        echo "Passwords do not match!";
        exit;
    }

    // Password hash
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if the username or email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
    $stmt->execute([":username" => $username, ":email" => $email]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo "Username or Email already exists!";
        exit;
    }

    // Insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
    try {
        $stmt->execute([":username" => $username, ":email" => $email, ":password" => $hashedPassword]);
        echo "Signup successful! <a href='login.html'>Login here</a>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}