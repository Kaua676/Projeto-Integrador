<?php
// Conexão com o banco de dados (substitua os valores conforme necessário)

include_once("conexao.php");
// Verificar a conexão
if ($mysqli->connect_error) {
    die("Falha na conexão: " . $mysqli->connect_error);
}

// Verificar se foi feita uma solicitação de busca
if (isset($_POST['opcao']) && isset($_POST['dados'])) {
    $opcao = $_POST['opcao'];
    $dados = $_POST['dados'];

    // Modificar a consulta SQL de acordo com a opção selecionada pelo usuário
    if ($opcao === 'im') {
        $sql = "SELECT pj.im AS inscricao_municipal, cnpj.cnpj, cnpj.razao_social, situacao.tipo AS situacao
                FROM pj
                INNER JOIN cnpj ON pj.cnpj_id = cnpj.id
                INNER JOIN situacao ON pj.situacao_id = situacao.id
                WHERE pj.im = ?";
    } elseif ($opcao === 'cnpj') {
        $sql = "SELECT pj.im AS inscricao_municipal, cnpj.cnpj, cnpj.razao_social, situacao.tipo AS situacao
                FROM pj
                INNER JOIN cnpj ON pj.cnpj_id = cnpj.id
                INNER JOIN situacao ON pj.situacao_id = situacao.id
                WHERE cnpj.cnpj = ?";
    } elseif ($opcao === 'razao_social') {
        $sql = "SELECT pj.im AS inscricao_municipal, cnpj.cnpj, cnpj.razao_social, situacao.tipo AS situacao
                FROM pj
                INNER JOIN cnpj ON pj.cnpj_id = cnpj.id
                INNER JOIN situacao ON pj.situacao_id = situacao.id
                WHERE cnpj.razao_social LIKE ?";
        // Adicione % para fazer uma busca com correspondência parcial
        $dados = "%$dados%";
    }

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("s", $dados); 
    $stmt->execute();
    $result = $stmt->get_result();
   
    // Exibir os resultados na tabela HTML
    if ($result->num_rows >= 0) {
        
        while($row = $result->fetch_assoc()) {
            
            
            // Inserir os dados da linha nas colunas correspondentes
            echo "<td>" . $row["inscricao_municipal"] . "</td>";
            echo "<td>" . $row["cnpj"] . "</td>";
            echo "<td>" . $row["razao_social"] . "</td>";
            echo "<td>" . $row["situacao"] . "</td>";

            //

            echo "<td><a href='../php/pdf.php?im=" . $row['inscricao_municipal'] . "&cnpj=" . $row['cnpj'] . "&razao_social=" . $row['razao_social'] . "&situacao=" . $row['situacao'] . "'>Ficha Cadastral</a></td>";

            //

            echo "<td><a href='../html/debitos.html?im=" . $row['inscricao_municipal'] . "'>Ver Débitos</a></td>";
            echo "<td><a href='../html/alvaras.html?im=" . $row['inscricao_municipal'] . "'>Ver Alvarás e Certidões</a></td>";
            echo "<td><a href='../html/licença.html?im=" . $row['inscricao_municipal'] . "'>Ver Licenças</a></td>";
            
        }

        
    } else {
        // Se nenhum resultado for encontrado, exibe uma mensagem dentro de uma única célula na tabela
        echo "<tbody><tr><td colspan='3'>Nenhum resultado encontrado.</td></tr></tbody>";
    }
}
?>
