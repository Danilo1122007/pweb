<?php
$success = false;
$error = false;
$reclamacoes = [];
$editar = false;
$reclamacao_editar = null;

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
        $stmt = $pdo->prepare("SELECT * FROM reclamacoes WHERE id = ?");
        $stmt->execute([$id]);
        $reclamacao_editar = $stmt->fetch();
        $editar = true;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
        $id = $_POST['id'];
        $unidade = $_POST['unidade'];
        $reclamacao = $_POST['reclamacao'];

        $stmt = $pdo->prepare("UPDATE reclamacoes SET unidade = ?, reclamacao = ? WHERE id = ?");
        $stmt->execute([$unidade, $reclamacao, $id]);
        $success = "Reclamação atualizada com sucesso!";
        $editar = false;
    }

    if (isset($_GET['excluir'])) {
        $id = $_GET['excluir'];
        $stmt = $pdo->prepare("DELETE FROM reclamacoes WHERE id = ?");
        $stmt->execute([$id]);
        $success = "Reclamação excluída com sucesso!";
    }

    $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
    $sql = "SELECT * FROM reclamacoes";
    if (!empty($pesquisa)) {
        $sql .= " WHERE unidade LIKE '%$pesquisa%'";
    }
    $sql .= " ORDER BY data DESC";
    
    $stmt = $pdo->query($sql);
    $reclamacoes = $stmt->fetchAll();
} catch (\PDOException $e) {
    $error = "Erro no banco de dados: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>BurgerHouse - Administração de Reclamações</title>
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
        <h2 class="mb-4 text-center">Administração de Reclamações</h2>

        <?php if ($success) : ?>
            <div class="alert alert-success text-center"><?php echo htmlspecialchars($success); ?></div>
        <?php elseif ($error) : ?>
            <div class="alert alert-danger text-center"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="GET" class="mb-3">
            <div class="input-group">
                <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar por unidade" value="<?= isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : '' ?>">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                </div>
            </div>
        </form>

        <?php if ($editar) : ?>
            <div class="card mb-5">
                <div class="card-header bg-dark text-white">
                    <h3 class="mb-0">Editar Reclamação</h3>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($reclamacao_editar['id']); ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="unidade" class="form-label">Unidade</label>
                                <select class="form-control" id="unidade" name="unidade" required>
                                    <option value="Chapecó - SC" <?php echo $reclamacao_editar['unidade'] == 'Chapecó - SC' ? 'selected' : ''; ?>>Chapecó - SC</option>
                                    <option value="São Paulo - SP" <?php echo $reclamacao_editar['unidade'] == 'São Paulo - SP' ? 'selected' : ''; ?>>São Paulo - SP</option>
                                    <option value="Curitiba - PR" <?php echo $reclamacao_editar['unidade'] == 'Curitiba - PR' ? 'selected' : ''; ?>>Curitiba - PR</option>
                                    <option value="Porto Alegre - RS" <?php echo $reclamacao_editar['unidade'] == 'Porto Alegre - RS' ? 'selected' : ''; ?>>Porto Alegre - RS</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="data" class="form-label">Data</label>
                                <input type="text" class="form-control" id="data" 
                                       value="<?php echo htmlspecialchars(date('d/m/Y', strtotime($reclamacao_editar['data']))); ?>" readonly>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="reclamacao" class="form-label">Reclamação</label>
                            <textarea class="form-control" id="reclamacao" name="reclamacao" rows="5" required><?php echo htmlspecialchars($reclamacao_editar['reclamacao']); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Atualizar Reclamação</button>
                        <a href="adm_reclamacoes.php" class="btn btn-secondary">Cancelar</a>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <div class="card">
            <div class="card-header bg-dark text-white">
                <h3 class="mb-0">Todas as Reclamações</h3>
            </div>
            <div class="card-body">
                <?php if (empty($reclamacoes)) : ?>
                    <div class="alert alert-info">Nenhuma reclamação registrada ainda.</div>
                <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Data</th>
                                    <th>Unidade</th>
                                    <th>Reclamação</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($reclamacoes as $reclamacao) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($reclamacao['id']); ?></td>
                                        <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($reclamacao['data']))); ?></td>
                                        <td><?php echo htmlspecialchars($reclamacao['unidade']); ?></td>
                                        <td><?php echo nl2br(htmlspecialchars(substr($reclamacao['reclamacao'], 0, 100))); ?><?php echo strlen($reclamacao['reclamacao']) > 100 ? '...' : ''; ?></td>
                                        <td>
                                            <a href="?editar=<?php echo htmlspecialchars($reclamacao['id']); ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="?excluir=<?php echo htmlspecialchars($reclamacao['id']); ?>" class="btn btn-danger btn-sm" 
                                               onclick="return confirm('Tem certeza que deseja excluir esta reclamação?')">
                                                <i class="fas fa-trash-alt"></i> Excluir
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>