<?php
$success = false;
$error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
    $email = $_POST['email'];
    $duvida = $_POST['mensagem'];

    $stmt = $pdo->prepare("INSERT INTO duvidas (nome, email, duvida) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $duvida]);

    $success = true;
  } catch (\PDOException $e) {
    $error = "Erro ao enviar sua mensagem: " . $e->getMessage();
  }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>BurgerHouse - Contato</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/menulat.css" />
  <script src="../js/menulateral.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <?php include '../includes/menu_lateral.php' ?>

  <?php include '../includes/cabecalho.php' ?>

  <main class="container my-5">
    <h2 class="mb-4 text-center">Nos envie sua opinião</h2>

    <?php if ($success) : ?>
      <div class="alert alert-success text-center">
        Mensagem enviada com sucesso!
      </div>
    <?php elseif ($error) : ?>
      <div class="alert alert-danger text-center">
        <?php echo $error; ?>
      </div>
    <?php endif; ?>

    <div class="row bg-warning p-4 rounded">
      <div class="col-md-6">
        <form method="POST">
          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required />
          </div>
          <div class="mb-3">
            <label for="mensagem" class="form-label">Mensagem</label>
            <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
          </div>
          <button type="submit" class="btn btn-dark">Enviar</button>
        </form>
      </div>

      <div class="col-md-6">
        <h2 class="text-danger">Nosso Endereço</h2>
        <p>Rua dos Sabores, 123 - Chapecó, SC</p>
        <iframe width="100%" height="350" src="https://www.openstreetmap.org/export/embed.html?bbox=-52.60577380657197%2C-27.10301502635449%2C-52.60075271129608%2C-27.099767744649007&amp;layer=mapnik" style="border: 1px solid black"></iframe>
        <br />
        <small>
          <a href="https://www.openstreetmap.org/?#map=18/-27.101391/-52.603263&amp;layers=N" target="_blank">
            Ver mapa ampliado
          </a>
        </small>
      </div>
    </div>
  </main>

  <?php include '../includes/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>