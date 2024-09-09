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
            $sql = "SELECT valor, descricao, vencimento
                    FROM debitos
                    INNER JOIN pj_debitos ON debitos.id = pj_debitos.debitos_id
                    INNER JOIN pj p ON pj_debitos.pj_id = p.id";

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

                        $data_vencimento = DateTime::createFromFormat('Y-m-d', $row["vencimento"]);
                        $data_formatada = $data_vencimento->format('d-m-Y');

                        echo "<p>Tipo: " . $row["descricao"] . "</p>";
                        echo "<p>Valor: R$ " . $row["valor"] . "</p>";
                        echo "<p>Data de Vencimento: " . $data_formatada . "</p>";
                        // Adicione um formulário para enviar os dados para o script 'boleto_bradesco.php'
                        echo "<form action='boleto_bradesco.php' method='post'>";
                        echo "<input type='hidden' name='valor' value='" . $row["valor"] . "'>";
                        echo "<input type='hidden' name='descricao' value='" . $row["descricao"] . "'>";
                        echo "<input type='hidden' name='vencimento' value='" . $row["vencimento"] . "'>";
                        echo "<button type='submit'>Gerar Boleto</button>";
                        echo "</form>";
                    }
                } else {
                    echo "Nenhum débito encontrado.";
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
