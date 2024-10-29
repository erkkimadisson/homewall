<?php
session_start();
require_once __DIR__ . '/../database/Database.php';
$database = new Database();
$conn = $database->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        $stmt = $conn->prepare("SELECT id, firstname, lastname, password FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['firstname'] = $row['firstname'];
                $_SESSION['lastname'] = $row['lastname'];

                // AJAX success response
                echo "";
                exit();
            } else {
                $error = "Incorrect password or email.";
            }
        } else {
            $error = "Incorrect password or email.";
        }
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }

    // AJAX error response
    if (!empty($error)) {
        echo $error;
    }
    exit();
}