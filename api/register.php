<?php
require_once '../database/Database.php';
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['first'];
    $lastname = $_POST['last'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, password, email) VALUES (:firstname, :lastname, :password, :email)");
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);

            if ($stmt->execute()) {
                // Don't redirect here, just return success
                echo "";
                exit();
            } else {
                $error = "Error registering user.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Email already exists.";
            } else {
                $error = "Error: " . $e->getMessage();
            }
        }
    }

    // If there was an error, echo it for the AJAX response
    if (!empty($error)) {
        echo $error;
    }
    exit(); // Always exit after processing AJAX request
}