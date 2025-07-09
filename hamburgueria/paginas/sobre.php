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

  <?php include '../includes/cabecalho.php' ?>

  <div class="container my-5">
    <h2 class="mb-4 text-center">Sobre a BurgerHouse</h2>
    <p class="lead text-center">
      A BurgerHouse nasceu da paixão por hambúrgueres artesanais. Desde 2020,
      servimos sabor, qualidade e experiência.
    </p>
    <div class="row mt-5">
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="../img/ingredientes.webp" alt="Missão" />
          <div class="card-body">
            <h5 class="card-title">Nossa Missão</h5>
            <p class="card-text">
              Oferecer hambúrgueres artesanais com ingredientes frescos e
              atendimento de excelência.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="../img/hamburgers.webp" alt="Visão" />
          <div class="card-body">
            <h5 class="card-title">Nosso Objetivo</h5>
            <p class="card-text">
              Ser reconhecida como a melhor hamburgueria artesanal da região
              sul do Brasil.
            </p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card">
          <img class="card-img-top" src="../img/equipe.jpg" alt="Valores" />
          <div class="card-body">
            <h5 class="card-title">Nossos Valores</h5>
            <p class="card-text">
              Qualidade, transparência, respeito ao cliente e paixão pelo que
              fazemos. Tudo de bom grado.
            </p>
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