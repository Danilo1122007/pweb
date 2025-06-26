<?php
$success = false;
$error = false;
$funcionarios = [];

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

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome'])) {
    $nome = $_POST['nome'];
    $contratacao = $_POST['contratacao'];
    $salario = $_POST['salario'];

    $stmt = $pdo->prepare("INSERT INTO funcionarios (nome, contratacao, salario) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $contratacao, $salario]);
    $success = "Funcionário cadastrado com sucesso!";
  }

  if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $pdo->prepare("DELETE FROM funcionarios WHERE id = ?");
    $stmt->execute([$id]);
    $success = "Funcionário excluído com sucesso!";
  }

  $stmt = $pdo->query("SELECT * FROM funcionarios ORDER BY contratacao DESC");
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
  <nav>
    <div id="menu-lateral" class="menu-lateral">
      <span class="btn-menu" onclick="mostrarMenu()">
        <img id="ham" src="../img/icon-hamburger-menu.png" alt="menu" />
      </span>
      <ul class="menu-itens">
        <li class="nav-item">
          <a class="nav-link" href="../index.php">Início</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="sobre.php">Sobre</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="cardapio.php">Cardápio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contato.php">Contato</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="conta.php">Reclamações</a>
        </li>
        <li><a class="nav-link" href="login.php">Administrativo</a></li>
      </ul>
    </div>
  </nav>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <img src="../img/logo (2).png" alt="Logo" class="burger-logo mr-2" />
        <a class="navbar-brand mb-0 h1" href="../index.php">
          <h1>BurgerHouse</h1>
        </a>
        <button id="toggleSidebar" class="btn btn-outline-light d-lg-none ml-3">
          ☰ Menu
        </button>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="../index.php">
              <h2>Início</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="sobre.php">
              <h2>Sobre</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cardapio.php">
              <h2>Cardápio</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contato.php">
              <h2>Contato</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="conta.php">
              <h2>Reclamações</h2>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container my-5">
    <h2 class="mb-4 text-center">Gestão de Funcionários</h2>

    <?php if ($success) : ?>
      <div class="alert alert-success text-center"><?php echo $success; ?></div>
    <?php elseif ($error) : ?>
      <div class="alert alert-danger text-center"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="card mb-5">
      <div class="card-header bg-dark text-white">
        <h3 class="mb-0">Cadastrar Novo Funcionário</h3>
      </div>
      <div class="card-body">
        <form method="POST">
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="nome" class="form-label">Nome Completo</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="contratacao" class="form-label">Data de Contratação</label>
              <input type="date" class="form-control" id="contratacao" name="contratacao" required>
            </div>
            <div class="col-md-3 mb-3">
              <label for="salario" class="form-label">Salário (R$)</label>
              <input type="number" step="0.01" class="form-control" id="salario" name="salario" required>
            </div>
          </div>
          <button type="submit" class="btn btn-success">Cadastrar Funcionário</button>
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
                      <a href="?excluir=<?php echo $func['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este funcionário?')">
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

  <!-- Rodapé -->
  <footer class="text-center p-4 text-light cor">
    <h2>Nos sigam em nossas redes sociais</h2>
    <div class="container">
      <ol class="list-unstyled mb-3 d-flex justify-content-center flex-wrap">
        <li class="mx-3">
          <a href="https://www.instagram.com" class="text-light" target="_blank">
            <i class="fa-brands fa-instagram"></i> Instagram
          </a>
        </li>
        <li class="mx-3">
          <a href="https://wa.me/seunumerodetelefone" class="text-light" target="_blank">
            <i class="fa-brands fa-whatsapp"></i> WhatsApp
          </a>
        </li>
        <li class="mx-3">
          <a href="https://www.facebook.com" class="text-light" target="_blank">
            <i class="fa-brands fa-facebook"></i> Facebook
          </a>
        </li>
        <li class="mx-3">
          <a href="https://twitter.com" class="text-light" target="_blank">
            <i class="fa-brands fa-x-twitter"></i> Twitter (X)
          </a>
        </li>
      </ol>
      <b class="mb-0">&copy; <?php echo date("Y"); ?> BurgerHouse</b>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>