<?php
if (isset($_POST['submit'])) {
    include_once("conexao.php");

    // Capturando os dados do formulário
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $documento = $_POST['documento'];
    $nasc = $_POST['nasc'];  // Exemplo: 31/12/1990
    $email = $_POST['email'];
    $number = $_POST['number'];
    $cep = $_POST['cep'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $cidade = $_POST['cidade'];
    $uf = $_POST['estado'];
    $password = $_POST['password'];

    // Validar e converter a data
    if (DateTime::createFromFormat('d/m/Y', $nasc) === false) {
        echo "Data de nascimento inválida.";
        exit;
    } else {
        $data_array = explode('/', $nasc);
        $nasc_formatada = $data_array[2] . '-' . $data_array[1] . '-' . $data_array[0];
    }

    // Inserir os valores separados no banco de dados
    $sql = "INSERT INTO cadastro(telefone, cpf, primeiro_nome, sobrenome, nasc, cep, rua, numero, bairro, complemento, cidade, uf, email)
            VALUES ('$number', '$documento', '$nome', '$sobrenome', '$nasc_formatada', '$cep', '$rua', '$numero', '$bairro', '$complemento', '$cidade', '$uf', '$email')";
    
    $result = mysqli_query($mysqli, $sql);

    $sql = "INSERT INTO login(cpf_login, senha)
            VALUES ('$documento', '$password')";
    $result = mysqli_query($mysqli, $sql);

    // Verificar se a inserção foi bem-sucedida
    if ($result) {
        header("Location:../html/login.html");
    } else {
        echo "Erro ao cadastrar: " . mysqli_error($mysqli);
    }
}

?>