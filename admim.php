<?php
require_once 'conexao.php';

$senhaSecreta = "123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senhadigitada = $_POST['senha'];

    //DIGITOU A SENHA CERTO
    if ($senhadigitada === $senhaSecreta) {
        $sql = "SELECT * FROM usuarios";
        $result = $conn->query($sql);
        $mostrarFormulario = false; // Definir esta variável para false para esconder o formulário
    } else {
        echo "<h1>Senha Incorreta!</h1>";
        $mostrarFormulario = true; // Se a senha estiver incorreta, manter o formulário visível
    }
} else {
    $mostrarFormulario = true; // Se a página acabou de ser carregada, mostrar o formulário
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
</head>

<body>

    <?php if ($mostrarFormulario) : ?>
        <form method="post">
            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="Digite sua senha" required>
            <button type="submit">Enviar</button>
        </form>
    <?php endif; ?>

    <div class="user">
        <?php if (isset($result) && $result->num_rows > 0) : ?>
            <h2 style="text-align:center">Ultimos usuários cadastrados</h2>
            <ul>
                <?php while ($row = $result->fetch_assoc()) : ?>
                    <li>
                        <strong>Nome: </strong> <?php echo $row["nome"]; ?><br>
                        <strong>Email: </strong> <?php echo $row["email"]; ?><br>
                        <strong>Escolaridade: </strong> <?php echo $row["escolaridade"]; ?><br>
                        <strong>Idade: </strong> <?php echo $row["idade"]; ?><br>
                        <strong>Data de Cadastro: </strong> <?php echo $row["data"]; ?><br>
                        <strong>Hora de Cadastro: </strong> <?php echo $row["hora"]; ?><br>
                        <strong>cidade: </strong> <?php echo $row["cidade"]; ?><br>
                        <strong>raça: </strong> <?php echo $row["raca"]; ?><br><br><br>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else : ?>
            <p>Faça o login para ver os usuários cadastrados.</p>
        <?php endif; ?>
    </div>

</body>

</html>