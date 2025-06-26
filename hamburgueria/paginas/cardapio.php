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
          <li class="nav-item active">
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