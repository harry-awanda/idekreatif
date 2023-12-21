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
            $_SESSION["role"] = $row["role"];
            header("location: ../users/dashboard.php");
        } else {
            echo "Login failed. Invalid password.";
        }
    } else {
        echo "Login failed. Invalid username.";
    }
}
$conn->close();
?>