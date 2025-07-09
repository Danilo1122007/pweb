<?php
$success = false;
$error = false;
$mensagens = [];
$editar = false;
$mensagem_editar = null;

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

    if (isset($_GET['editar'])) {
        $id = $_GET['editar'];
        $stmt = $pdo->prepare("SELECT * FROM duvidas WHERE id = ?");
        $stmt->execute([$id]);
        $mensagem_editar = $stmt->fetch();
        $editar = true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $mensagem = $_POST['mensagem'];

        $stmt = $pdo->prepare("UPDATE duvidas SET nome = ?, email = ?, duvida = ? WHERE id = ?");
        $stmt->execute([$nome, $email, $mensagem, $id]);
        $success = "Mensagem atualizada com sucesso!";
        $editar = false;
    }

    if (isset($_GET['excluir'])) {
        $id = $_GET['excluir'];
        $stmt = $pdo->prepare("DELETE FROM duvidas WHERE id = ?");
        $stmt->execute([$id]);
        $success = "Mensagem excluída com sucesso!";
    }

    $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
    $sql = "SELECT * FROM duvidas";
    if (!empty($pesquisa)) {
        $sql .= " WHERE nome LIKE '%$pesquisa%'";
    }
    $sql .= " ORDER BY id DESC";
    
    $stmt = $pdo->query($sql);
    $mensagens = $stmt->fetchAll();

} catch (\PDOException $e) {
    $error = "Erro no banco de dados: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>BurgerHouse - Admin Mensagens</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/menulat.css">
    <script src="../js/menulateral.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <?php include '../includes/menu_lateral.php' ?>

    <?php include '../includes/cabecalho_adm.php' ?>

    <main class="container my-5">
        <h2 class="mb-4">Administração de Mensagens</h2>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php elseif ($error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar por nome" value="<?= isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : '' ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                </div>
            </div>
        </form>

        <?php if ($editar): ?>
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3>Editar Mensagem</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?= $mensagem_editar['id'] ?>">
                        
                        <div class="form-group">
                            <label>Nome:</label>
                            <input type="text" name="nome" class="form-control" value="<?= $mensagem_editar['nome'] ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" class="form-control" value="<?= $mensagem_editar['email'] ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Mensagem:</label>
                            <textarea name="mensagem" class="form-control" rows="5" required><?= $mensagem_editar['duvida'] ?></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                        <a href="adm_mensagens.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="mb-0">Todas as Mensagens</h3>
            </div>
            <div class="card-body">
                <?php if (empty($mensagens)): ?>
                    <div class="alert alert-info">Nenhuma mensagem encontrada.</div>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Mensagem</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mensagens as $msg): ?>
                            <tr>
                                <td><?= $msg['id'] ?></td>
                                <td><?= $msg['nome'] ?></td>
                                <td><?= $msg['email'] ?></td>
                                <td>
                                    <div class="mensagem-completa">
                                        <?= nl2br($msg['duvida']) ?>
                                    </div>
                                </td>
                                <td>
                                    <a href="?editar=<?= $msg['id'] ?>" class="btn btn-primary btn-sm">Editar</a>
                                    <a href="?excluir=<?= $msg['id'] ?>" class="btn btn-danger btn-sm" 
                                       onclick="return confirm('Tem certeza que deseja excluir esta mensagem?')">
                                        Excluir
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
</body>
</html>