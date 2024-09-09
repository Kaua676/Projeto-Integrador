<?php 
// Inclua o arquivo de conexão com o banco de dados
include('conexao.php');

use Dompdf\Dompdf;

// Carregue a biblioteca Dompdf
require_once 'dompdf/autoload.inc.php';

// Verifique se os parâmetros foram passados na URL
if(isset($_GET['im'])) {
    // Recupere o parâmetro da URL
    $im = $_GET['im'];

    // Construa a consulta SQL para recuperar as informações com base no parâmetro
    $sql = "SELECT 
    cpf.cpf, cpf.nome AS nome_pf, cpf.data_nasc,
    cnpj.cnpj, cnpj.razao_social AS nome_pj,
    endereco.rua, endereco.numero, endereco.bairro, endereco.cidade, endereco.uf
    FROM
    pj_socios
    LEFT JOIN socio_pf ON pj_socios.socio_pf_id = socio_pf.id
    LEFT JOIN cpf ON socio_pf.cpf_id = cpf.id
    LEFT JOIN socio_pj ON pj_socios.socio_pj_id = socio_pj.id
    LEFT JOIN cnpj ON socio_pj.cnpj_id = cnpj.id
    LEFT JOIN endereco ON socio_pf.endereco_id = endereco.id OR socio_pj.endereco_id = endereco.id";

    // Preparar a consulta
    $stmt = $mysqli->prepare($sql);

    // Verificar se a preparação da consulta foi bem-sucedida
    if (!$stmt) {
        die("Erro na preparação da consulta: " . $mysqli->error);
    }

    // Vincular os parâmetros aos marcadores de posição
    $stmt->bind_param("s", $im);

    // Executar a consulta
    $stmt->execute();

    // Obter o resultado da consulta
    $result = $stmt->get_result();

    // Verifique se há resultados na consulta
    if ($result->num_rows > 0) {
        // Inicialize uma variável para armazenar o HTML dos dados
        $html = '';
        $html = '<html>';
        $html .= '<head><style>';
        $html .= 'table { border-collapse: collapse; width: 100%; }';
        $html .= 'th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; }';
        $html .= 'th { background-color: #f2f2f2; }';
        $html .= '</style></head>';
        $html .= '<body>';
        $html .= '<h1>Relatório de Sócios</h1>';
        $html .= '<table>';
        $html .= '<tr><th>CPF</th><th>Nome</th><th>Data de Nascimento</th><th>CNPJ</th><th>Razão Social</th><th>Rua</th><th>Número</th><th>Bairro</th><th>Cidade</th><th>UF</th></tr>';
      
       echo $html;

        /*// Crie uma instância do Dompdf
        $dompdf = new Dompdf();
        
        // Carregue o HTML no Dompdf
        $dompdf->loadHtml($html);

        // Defina a fonte padrão
        $dompdf->set_option('defaultFont', 'sans');

        // Defina o tamanho do papel e a orientação (retrato ou paisagem)
        $dompdf->setPaper('A4', 'portrait');

        // Renderize o PDF
        $dompdf->render();

        // Gere o PDF para visualização no navegador
        $dompdf->stream("dados.pdf");*/
    } else {
        // Se não houver resultados na consulta, exiba uma mensagem
        echo "Nenhum resultado encontrado.";
    }
} else {
    // Se os parâmetros não foram passados na URL, exiba uma mensagem de erro
    echo "Parâmetros ausentes na URL.";
}

// Feche a conexão com o banco de dados
$mysqli->close();
?>
