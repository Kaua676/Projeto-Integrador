<?php
session_start();
include_once 'conexao.php';

// Verificar se a sessão do usuário está ativa
if (isset($_SESSION['user_cpf'])) {
    $user_cpf = $_SESSION['user_cpf'];

    // Preparar a consulta para obter o primeiro nome do usuário
    $stmt = $mysqli->prepare("
        SELECT c.primeiro_nome 
        FROM cadastro c
        INNER JOIN login l ON c.cpf = l.cpf_login
        WHERE l.cpf_login = ?");
    $stmt->bind_param("s", $user_cpf);
    $stmt->execute();
    $stmt->bind_result($primeiro_nome);
    $stmt->fetch();

    // Verificar se o nome foi encontrado e retornar
    if ($primeiro_nome) {
        echo htmlspecialchars($primeiro_nome);
    } else {
        echo "Usuário";
    }
} else {
    echo "Usuário";
}
?>

