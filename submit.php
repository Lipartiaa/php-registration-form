<?php
$servername = "localhost";
$username = "root";
$password = "MyStrongPass123!";
$dbname = "NIKA";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $firstName = trim($_POST['first_name']);
        $lastName = trim($_POST['last_name']);
        $email = trim($_POST['email']);
        $dob = $_POST['dob'];
        $phone = trim($_POST['phone']);


        if (empty($firstName) || empty($lastName) || empty($email) || empty($dob) || empty($phone)) {
            throw new Exception('All fields are required.');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Invalid email format.');
        }


        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, email, dob, phone) 
                               VALUES (:first_name, :last_name, :email, :dob, :phone)");
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':phone', $phone);

        $stmt->execute();


        echo json_encode(['status' => 'success', 'message' => 'Registration successful!']);
    } else {
        throw new Exception('Invalid request method.');
    }
} catch (Exception $e) {

    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
