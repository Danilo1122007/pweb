<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

  try {
    $pdo = new PDO($dsn, $user, $pass, $options);
  } catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
  }

  $data = date('Y-m-d');
  $unidade = $_POST['unidade'];
  $reclamacao = $_POST['reclamacao'];

  $stmt = $pdo->prepare("INSERT INTO reclamacoes (data, unidade, reclamacao) VALUES (?, ?, ?)");
  $stmt->execute([$data, $unidade, $reclamacao]);

  header("Location: reclamacoes.php?success=1");
  exit();
} else {
  header("Location: reclamacoes.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>BurgerHouse - Reclamações</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/menulat.css" />
  <script src="../js/menulateral.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
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
          <a class="nav-link" href="conta.php">Conta</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="reclamacoes.php">Reclamações</a>
        </li>
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
              <h2>Conta</h2>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="reclamacoes.php">
              <h2>Reclamações</h2>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="container my-5">
    <h2 class="mb-4 text-center">Registro de Reclamações</h2>
    <div class="row bg-warning p-4 rounded">
      <div class="col-md-8 mx-auto">
        <form id="formReclamacao" action="processa_reclamacao.php" method="POST">
          <div class="mb-3">
            <label for="unidade" class="form-label">Unidade</label>
            <select class="form-control" id="unidade" name="unidade" required>
              <option value="">Selecione a unidade</option>
              <option value="Chapecó - SC">Chapecó - SC</option>
              <option value="São Paulo - SP">São Paulo - SP</option>
              <option value="Curitiba - PR">Curitiba - PR</option>
              <option value="Porto Alegre - RS">Porto Alegre - RS</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="reclamacao" class="form-label">Reclamação</label>
            <textarea class="form-control" id="reclamacao" name="reclamacao" rows="5" required></textarea>
          </div>
          <button type="submit" class="btn btn-dark">Enviar Reclamação</button>
        </form>
      </div>
    </div>
  </main>

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
      <b class="mb-0">&copy; 2025 BurgerHouse</b>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>