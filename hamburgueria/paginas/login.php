<?php
session_start();

$erro = '';
if (isset($_POST['entrar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

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

        $stmt = $pdo->prepare("SELECT * FROM login WHERE email = ?");
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && $senha === $usuario['senha']) {
            $_SESSION['logado'] = true;
            $_SESSION['usuario'] = $usuario['email'];
            header("Location: funcionarios.php");
            exit;
        } else {
            $erro = "Email ou senha incorretos!";
        }
    } catch (\PDOException $e) {
        $erro = "Erro no banco de dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Burguer House - Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <h1 class="brgr_house">Burguer House</h1>
            <img src="../img/logo (2).png" alt="Logo Hamburguer" class="logo">
            <h2>Login</h2>
            <?php if ($erro) : ?>
                <p style="color: red;"><?php echo $erro; ?></p>
            <?php endif; ?>
            <form id="formulario" method="POST">
                <label for="email">EMAIL</label>
                <input type="email" id="email" name="email" placeholder="exemplo@email.com" required>

                <label for="senha">SENHA</label>
                <input type="password" id="senha" name="senha" placeholder="*****" required>

                <button type="submit" name="entrar">ENTRAR</button>
                <h3>Não possui uma conta?</h3>
            </form>
            <button onclick="window.location.href='cadastro.php'">CADASTRAR</button>
        </div>
    </div>

    <script>
        document.getElementById("formulario").addEventListener("submit", function(e) {
            const email = document.getElementById("email").value.trim();
            const senha = document.getElementById("senha").value.trim();

            if (!email || !senha) {
                e.preventDefault();
                alert("Por favor, preencha todos os campos!");
            }
        });
    </script>
</body>

</html>