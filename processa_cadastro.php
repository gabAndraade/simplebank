<?php

$config = parse_ini_file('.env');

$servername = $config['DB_HOST'];
$username = $config['DB_USER'];
$password = $config['DB_PASS'];
$dbname = $config['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$dataNascimento = !empty($_POST['dataNascimento']) ? $_POST['dataNascimento'] : null;
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$avatar = $_FILES['avatar']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["avatar"]["name"]);
move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file);

$stmt = $conn->prepare("INSERT INTO users (nome, cpf, data_nascimento, senha, avatar) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $nome, $cpf, $dataNascimento, $senha, $avatar);

if ($stmt->execute()) {
    header("Location: inicio.php?id=" . $stmt->insert_id);
    exit();
} else {
    echo "Erro: " . $stmt->error;
}



$stmt->close();
$conn->close();
?>
