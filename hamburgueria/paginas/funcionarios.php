<?php
$success = false;
$error = false;
$funcionarios = [];
$editar = false;
$funcionario_editar = null;

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
    $stmt = $pdo->prepare("SELECT * FROM funcionarios WHERE id = ?");
    $stmt->execute([$id]);
    $funcionario_editar = $stmt->fetch();
    $editar = true;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $contratacao = $_POST['contratacao'];
    $salario = $_POST['salario'];

    if ($editar && isset($_POST['id'])) {
      $id = $_POST['id'];
      $stmt = $pdo->prepare("UPDATE funcionarios SET nome = ?, contratacao = ?, salario = ? WHERE id = ?");
      $stmt->execute([$nome, $contratacao, $salario, $id]);
      $success = "Funcionário atualizado com sucesso!";
      $editar = false;
    } else {
      $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, contratacao, salario) VALUES (?, ?, ?)");
      $stmt->execute([$nome, $contratacao, $salario]);
      $success = "Funcionário cadastrado com sucesso!";
    }
  }

  if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
    $stmt->execute([$id]);
    $success = "Funcionário excluído com sucesso!";
  }

  $pesquisa = isset($_GET['pesquisa']) ? $_GET['pesquisa'] : '';
  $sql = "SELECT * FROM funcionarios";
  if (!empty($pesquisa)) {
      $sql .= " WHERE nome LIKE '%$pesquisa%'";
  }
  $sql .= " ORDER BY contratacao DESC";
  
  $stmt = $pdo->query($sql);
  $funcionarios = $stmt->fetchAll();
} catch (\PDOException $e) {
  $error = "Erro no banco de dados: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>BurgerHouse - Gestão de Funcionários</title>
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
    <h2 class="mb-4 text-center">Gestão de Funcionários</h2>

    <?php if ($success) : ?>
      <div class="alert alert-success text-center"><?php echo $success; ?></div>
    <?php elseif ($error) : ?>
      <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="GET" class="mb-3">
      <div class="input-group">
        <input type="text" name="pesquisa" class="form-control" placeholder="Pesquisar por nome" value="<?= isset($_GET['pesquisa']) ? htmlspecialchars($_GET['pesquisa']) : '' ?>">
        <div class="input-group-append">
          <button class="btn btn-primary" type="submit">Pesquisar</button>
        </div>
      </div>
    </form>

    <div class="card mb-5">
      <div class="card-header bg-dark text-white">
        <h3 class="mb-0"><?php echo $editar ? 'Editar Funcionário' : 'Cadastrar Novo Funcionário'; ?></h3>
      </div>
      <div class="card-body">
        <form method="POST">
          <?php if ($editar) : ?>
            <input type="hidden" name="id" value="<?php echo $funcionario_editar['id']; ?>">
          <?php endif; ?>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nome" class="form-label">Nome Completo</label>
              <input type="text" class="form-control" id="nome" name="nome" 
                     value="<?php echo $editar ? htmlspecialchars($funcionario_editar['nome']) : ''; ?>" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="contratacao" class="form-label">Data de Contratação</label>
              <input type="date" class="form-control" id="contratacao" name="contratacao" 
                     value="<?php echo $editar ? $funcionario_editar['contratacao'] : ''; ?>" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="salario" class="form-label">Salário (R$)</label>
              <input type="number" step="0.01" class="form-control" id="salario" name="salario" 
                     value="<?php echo $editar ? $funcionario_editar['salario'] : ''; ?>" required>
            </div>
          </div>
          <button type="submit" class="btn btn-success">
            <?php echo $editar ? 'Atualizar Funcionário' : 'Cadastrar Funcionário'; ?>
          </button>
          <?php if ($editar) : ?>
            <a href="funcionarios.php" class="btn btn-secondary">Cancelar</a>
          <?php endif; ?>
        </form>
      </div>
    </div>

    <div class="card">
      <div class="card-header bg-dark text-white">
        <h3 class="mb-0">Funcionários Cadastrados</h3>
      </div>
      <div class="card-body">
        <?php if (empty($funcionarios)) : ?>
          <div class="alert alert-info">Nenhum funcionário cadastrado ainda.</div>
        <?php else : ?>
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Data de Contratação</th>
                  <th>Salário</th>
                  <th>Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($funcionarios as $func) : ?>
                  <tr>
                    <td><?php echo $func['id']; ?></td>
                    <td><?php echo htmlspecialchars($func['nome']); ?></td>
                    <td><?php echo date('d/m/Y', strtotime($func['contratacao'])); ?></td>
                    <td>R$ <?php echo number_format($func['salario'], 2, ',', '.'); ?></td>
                    <td>
                      <a href="?editar=<?php echo $func['id']; ?>" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i> Editar
                      </a>
                      <a href="?excluir=<?php echo $func['id']; ?>" class="btn btn-danger btn-sm" 
                         onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">
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