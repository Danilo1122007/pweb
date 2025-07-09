<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>BurgerHouse - Cardápio</title>
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

  <main class="container my-5" role="main">
    <h2 class="mb-4 text-center">Nossos Hambúrgueres</h2>

    <div class="card-deck mb-4">
      <div class="card bg-warning">
        <img src="../img/h1.avif" class="card-img-top" alt="Hambúrguer Clássico" />
        <div class="card-body">
          <h3 class="card-title">Burguer Clássico</h3>
          <p class="card-text">
            - 2 Pães selados na chapa.<br />
            - Queijo Prato.<br />
            - Hambúrguer de 180g.<br />
            - Tomate, Alface, Cebola roxa.<br />
            - Molho da Casa.
          </p>
        </div>
      </div>
      <div class="card bg-warning">
        <img src="../img/h2.jpg" class="card-img-top" alt="Bacon Burger" />
        <div class="card-body">
          <h3 class="card-title">Bacon Burger</h3>
          <p class="card-text">
            - Hambúrguer de 360g.<br />
            - Queijo derretido.<br />
            - Tiras de bacon.<br />
            - Cebola roxa e Molho da Casa.
          </p>
        </div>
      </div>
      <div class="card bg-warning">
        <img src="../img/h3.webp" class="card-img-top" alt="Vegetariano" />
        <div class="card-body">
          <h3 class="card-title">Vegetariano</h3>
          <p class="card-text">
            - Hambúrguer 100% vegano.<br />
            - Tomate, Alface, Cebola roxa.<br />
            - Molho da Casa.
          </p>
        </div>
      </div>
    </div>

    <section class="card bg-danger text-white">
      <div class="row no-gutters">
        <div class="col-md-4">
          <img src="../img/ambiente.jpg" class="card-img" alt="Ambiente da hamburgueria" />
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h3 class="card-title">Nosso Espaço</h3>
            <p class="card-text">
              Ambiente climatizado e aconchegante para você e sua família
              aproveitarem nossos hambúrgueres com conforto.
            </p>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include '../includes/footer.php'; ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>