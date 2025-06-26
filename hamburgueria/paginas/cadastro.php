<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burguer House</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h1 class="brgr_house">Burguer House</h1>
            <img src="../img/logo (2).png" alt="Logo Hamburguer" class="logo">
            <h2>Cadastre-se</h2>
            <form id="formulario_cadastro" method="post" action="">
                <label for="nome">NOME</label>
                <input type="text" id="nome" name="nome" placeholder="Asterix" required>

                <label for="telefone">TELEFONE</label>
                <input type="tel" id="telefone" name="telefone" placeholder="(00) 999999999" required>

                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="asterix@hotmail.com" required>

                <label for="senha">SENHA</label>
                <input type="password" id="senha" name="senha" placeholder="*****" required>

                <button type="submit" name="cadastrar">CADASTRAR</button>
            </form>
        </div>
    </div>

    <?php
    $success = false;
    $error = false;

    if (isset($_POST['cadastrar'])) {
        try {
            $host = '127.0.0.1';
            $db   = 'p2_pweb';
            $user = 'root';
            $pass = '';
            $charset = 'utf8mb4';

            $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $pdo = new PDO($dsn, $user, $pass, $options);

            $nome = $_POST['nome'];
            $telefone = $_POST['telefone'];
            $email = $_POST['email'];
            $senha = $_POST['senha'];

            $stmt = $pdo->prepare("INSERT INTO login (nome, email, login, senha) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $email, $telefone, $senha]);

            $success = true;
            echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login.php';</script>";
        } catch (\PDOException $e) {
            $error = "Erro ao cadastrar: " . $e->getMessage();
            echo "<script>alert('$error');</script>";
        }
    }
    ?>
</body>

</html>