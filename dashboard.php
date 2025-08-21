<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.html");
    exit;
}
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #4b3fcf;
            color: white;
            padding: 10px 20px;
        }
        .menu {
            position: relative;
            display: inline-block;
        }
        .menu button {
            background: none;
            border: none;
            font-size: 24px;
            color: white;
            cursor: pointer;
        }
        .dropdown {
            display: none;
            position: absolute;
            right: 0;
            background: white;
            color: black;
            min-width: 150px;
            box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
            border-radius: 6px;
            z-index: 1;
        }
        .dropdown a, .dropdown form button {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: black;
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }
        .dropdown a:hover, .dropdown form button:hover {
            background: #eee;
        }
        .menu:hover .dropdown {
            display: block;
        }
    </style>
</head>
<body>
    <div class="topbar">
        <h2>Welcome, <?php echo htmlspecialchars($username); ?>!</h2>
        <div class="menu">
            <button>☰</button>
            <div class="dropdown">
                <a href="logout.php">Logout</a>
                <form action="delete_account.php" method="POST" style="margin:0;">
                    <button type="submit" name="delete">Delete Account</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>