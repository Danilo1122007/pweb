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

    $data = date('Y-m-d');
    $unidade = $_POST['unidade'];
    $reclamacao = $_POST['reclamacao'];

    $stmt = $pdo->prepare("INSERT INTO reclamacoes (data, unidade, reclamacao) VALUES (?, ?, ?)");
    $stmt->execute([$data, $unidade, $reclamacao]);

    $success = true;
  } catch (\PDOException $e) {
    $error = "Erro ao processar sua reclamação: " . $e->getMessage();
  }
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

  <?php include '../includes/menu_lateral.php' ?>

  <?php include '../includes/cabecalho.php' ?>

  <main class="container my-5">
    <h2 class="mb-4 text-center">Registro de Reclamações</h2>

    <?php if ($success) : ?>
      <div class="alert alert-success text-center">
        Reclamação registrada com sucesso!
      </div>
    <?php elseif ($error) : ?>
      <div class="alert alert-danger text-center">
        <?php echo $error; ?>
      </div>
    <?php endif; ?>

    <div class="row bg-warning p-4 rounded">
      <div class="col-md-8 mx-auto">
        <form id="formReclamacao" method="POST">
          <div class="mb-3">
            <label for="unidade" class="form-label">Unidade do ocorrido</label>
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

  <?php include '../includes/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>