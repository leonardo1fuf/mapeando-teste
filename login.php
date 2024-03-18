<?php
// Verificar se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexão com o banco de dados 
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pdf1";

    // Crie a conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Dados do formulário
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $escolaridade = $_POST["escolaridade"];
    $idade = $_POST["idade"];
    $data_atual = date('d/m/Y'); 
    $hora_atual = date('H:i:s');
    $raca = $_POST["etnia"];
    $cidade = $_POST["cidade"];


    // Inserir os dados no banco de dados
    $smtp = $conn->prepare("INSERT INTO usuarios (nome, email, escolaridade, idade, data, hora, raca, cidade) VALUES (?,?,?,?,?,?,?,?)");
    $smtp->bind_param("ssssssss",$nome, $email, $escolaridade, $idade, $data_atual, $hora_atual, $raca, $cidade);

    if ($smtp->execute() === TRUE) {
        // Se os dados foram inseridos com sucesso, redirecione para o PDF
        $caminho = "download.html#mapas1";
        header("Location: $caminho");
        exit();
    } else {
        echo "Erro ao inserir dados: " . $smtp->error;
    }

    $conn->close();
} else {
    // Se o formulário não foi submetido, redirecione de volta para a página anterior
    header("Location: index.html");
    exit();
}
?>