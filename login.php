<?php

$host = 'localhost';
$db = 'siteeco';
$user = 'root'; // Troque pelo seu usuário
$pass = 'siteeco';   // Troque pela sua senha

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Não foi possível conectar ao banco de dados: " . $e->getMessage());
}


// login.php - Rota de Login

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'login') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $usuario = $stmt->fetch();

    if ($usuario && password_verify($senha, $usuario['senha'])) {
        echo "Login bem-sucedido! Bem-vindo, " . $usuario['nome'];
        // Aqui você pode iniciar uma sessão ou gerar um token se necessário
    } else {
        echo "Email ou senha inválidos.";
    }
}
?>