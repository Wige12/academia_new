<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
} 

// Create database
$sql = "CREATE DATABASE academia";
if ($conn->query($sql) === TRUE) {
	header('Location: ./?step=2');
} else {
    echo "Erro ao criar Banco de Dados: " . $conn->error;
}

$conn->close();
?>

 