<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>BurgerHouse - Sobre</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="../css/style.css" />
  <link rel="stylesheet" href="../css/menulat.css" />
  <script src="../js/menulateral.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <?php include '../includes/menu_lateral.php' ?>

  <?php include '../includes/cabecalho_adm.php' ?>

  <div class="container my-5">
    <h2 class="mb-4 text-center">Menu Administrativo</h2>
    <div class="row mt-5">
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="../img/funcionarios.jpg" alt="Funcionarios"/>
          <div class="card-body">
            <h5 class="card-title">Funcionarios</h5>
            <a href="funcionarios.php"> Parte dedicada a administração de Funcionarios </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="../img/mensagem.png" alt="Mensagem" />
          <div class="card-body">
            <h5 class="card-title">Mensagens dos clientes</h5>
            <a href="adm_mensagens.php"> Mensagens enviadas pelos clientes </a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="../img/reclamacao.jpg" alt="Reclamacoes" />
          <div class="card-body">
            <h5 class="card-title">Reclamações dos clientes</h5>
            <a href="adm_reclamacoes.php"> Reclamações aleatorias enviadas pelos clientes </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include '../includes/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>