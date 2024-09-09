<?php
// Conexão com o banco de dados (substitua os valores conforme necessário)
include_once("conexao.php");

// Verificar se foi feita uma solicitação de busca
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar se a opção foi selecionada
    if (isset($_POST['opcao']) && isset($_POST['dados'])) {
        $opcao = $_POST['opcao'];
        $dados = $_POST['dados'];

        // Verificar se a opção selecionada é válida
        if ($opcao === 'im' || $opcao === 'cnpj') {
            // Construir a consulta SQL base
            $sql = "SELECT c.tipo, c.numero_certidao, c.data_vencimento 
                    FROM certidoes c
                    INNER JOIN pj_certidoes pc ON c.id = pc.certidoes_id
                    INNER JOIN pj p ON pc.pj_id = p.id";

            // Verificar se o tipo de certidão foi selecionado
            if (isset($_POST['tipoCertidao']) && !empty($_POST['tipoCertidao'])) {
                $tipoCertidao = $_POST['tipoCertidao'];
                if ($tipoCertidao === 'alvara') {
                    $sql .= " WHERE c.tipo = 'Alvará de Localização e Funcionamento' ";
                } elseif ($tipoCertidao === 'alvaraprovisorio') {
                    $sql .= " WHERE c.tipo = 'Alvará de Localização e Funcionamento Provisório' ";
                }
            }

            // Adicionar a condição baseada na opção selecionada (im ou cnpj)
            if ($opcao === 'im') {
                $sql .= " AND p.im = ?";
            } elseif ($opcao === 'cnpj') {
                $sql .= " AND EXISTS (SELECT 1 FROM cnpj cn WHERE p.cnpj_id = cn.id AND cn.cnpj = ?)";
            }

            // Preparar e executar a consulta SQL
            $stmt = $mysqli->prepare($sql);

            if ($stmt) {
                if (isset($dados)) {
                    $stmt->bind_param("s", $dados);
                }
                $stmt->execute();
                $result = $stmt->get_result();

                // Exibir os resultados na tela
                if ($result->num_rows > 0) {
                    echo "<h2>Resultados da Busca:</h2>";
                    while ($row = $result->fetch_assoc()) {

                        $data_vencimento = DateTime::createFromFormat('Y-m-d', $row["data_vencimento"]);
                        $data_formatada = $data_vencimento->format('d-m-Y');

                        echo "<p>Tipo: " . $row["tipo"] . "</p>";
                        echo "<p>Número da Certidão: " . $row["numero_certidao"] . "</p>";
                        echo "<p>Data de Vencimento: " . $data_formatada . "</p>";
                    }
                } else {
                    echo "Nenhuma certidão encontrada.";
                }
            } else {
                echo "Erro ao preparar a consulta SQL.";
            }
        } else {
            echo "Opção inválida.";
        }
    } else {
        echo "Nenhuma opção selecionada.";
    }
} 
?>