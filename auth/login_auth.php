<?php
session_start();
require_once("../config.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["name"] = $row["name"];
            $_SESSION["role"] = $row["role"];
            $_SESSION["user_id"] = $row["user_id"];
            header("location: ../dashboard.php");
        } else {
            header("Location: login.php?status=false");
        }
    } else {
        header("Location: login.php?status=false");
    }
}
$conn->close();
?>