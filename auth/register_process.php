<?php
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["name"];
    $password = $_POST["password"];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, name, password) VALUES ('$username', '$name', '$hashedPassword')";
    if ($conn->query($sql) === TRUE) {
      header("Location: register.php?success=true");
        exit();
  } else {
      // Registrasi gagal
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
?>