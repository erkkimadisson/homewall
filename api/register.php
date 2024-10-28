<?php
session_start();
require_once '../database/Database.php';
$database = new Database();
$conn = $database->getConnection();

function generateUuidv4() {
    $data = random_bytes(16);

    $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // Set version to 0100
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
 // Set bits 6-7 to 10

    return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data),4));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['first'];
    $lastname = $_POST['last'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $email = $_POST['email'];
    $id = generateUuidv4();

    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("INSERT INTO users (id, firstname, lastname, password, email) VALUES (:id, :firstname, :lastname, :password, :email)");
            $stmt->bindParam(':id', $id);
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