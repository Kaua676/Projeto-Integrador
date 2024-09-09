<?php
session_start();

if (isset($_POST['submit']) && !empty($_POST['documento']) && !empty($_POST['password']) && !empty($_POST['captchaInput'])) {
    include_once 'conexao.php';

    $limite_tentativas = 2;
    $tempo_bloqueio = 5; // 5 segundos

    if (!isset($_SESSION['tentativas_login'])) {
        $_SESSION['tentativas_login'] = 0;
    }

    if (!isset($_SESSION['bloqueio_tempo'])) {
        $_SESSION['bloqueio_tempo'] = 0;
    }

    if ($_SESSION['tentativas_login'] >= $limite_tentativas) {
        $tempo_restante = time() - $_SESSION['bloqueio_tempo'];
        if ($tempo_restante < $tempo_bloqueio) {
            $segundos_espera = $tempo_bloqueio - $tempo_restante;
            echo "<script>
                localStorage.setItem('tempoRestante', $segundos_espera);
                window.location.href = '../html/login.html';
            </script>";
            exit();
        } else {
            $_SESSION['tentativas_login'] = 0;
            $_SESSION['bloqueio_tempo'] = 0;
        }
    }

    $documento = $_POST['documento'];
    $senha = $_POST['password'];
    $captchaInput = $_POST['captchaInput'];
    $captchaCode = $_POST['captcha_code'];

    if ($captchaInput != $captchaCode) {
        echo "<script>alert('CAPTCHA incorreto.'); window.location.href = '../html/login.html';</script>";
        exit();
    }

    $stmt = $mysqli->prepare("SELECT * FROM login WHERE cpf_login = ? AND senha = ?");
    $stmt->bind_param("ss", $documento, $senha);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['tentativas_login'] = 0;
        $_SESSION['bloqueio_tempo'] = 0;
        $_SESSION['user_cpf'] = $documento;
        header("Location: ../html/principal.html");
    } else {
        $_SESSION['tentativas_login']++;
        $_SESSION['bloqueio_tempo'] = time();
        if ($_SESSION['tentativas_login'] >= $limite_tentativas) {
            $tempo_restante = $tempo_bloqueio;
            echo "<script>
                localStorage.setItem('tempoRestante', $tempo_restante);
                window.location.href = '../html/login.html';
            </script>";
        } else {
            echo "<script>alert('CPF ou senha incorretos.'); window.location.href = '../html/login.html';</script>";
        }
    }
} else {
    echo "<script>alert('Todos os campos são obrigatórios.'); window.location.href = '../html/login.html';</script>";
}
?>

