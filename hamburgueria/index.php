<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <title>BurgerHouse - Início</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/menulat.css" />
  <script src="js/menulateral.js" defer></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
</head>

<body>

  <nav>
    <div id="menu-lateral" class="menu-lateral">
      <span class="btn-menu" onclick="mostrarMenu()">
        <img id="ham" src="img/icon-hamburger-menu.png" alt="menu" />
      </span>
      <ul class="menu-itens">
        <li><a class="nav-link" href="index.php">Início</a></li>
        <li><a class="nav-link" href="paginas/sobre.php">Sobre</a></li>
        <li><a class="nav-link" href="paginas/cardapio.php">Cardápio</a></li>
        <li><a class="nav-link" href="paginas/contato.php">Contato</a></li>
        <li><a class="nav-link" href="paginas/conta.php">Reclamações</a></li>
        <li><a class="nav-link" href="paginas/login.php">Administrativo</a></li>
      </ul>
    </div>
  </nav>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex align-items-center justify-content-between">
      <div class="d-flex align-items-center">
        <img src="img/logo (2).png" alt="Logo" class="burger-logo mr-2" />
        <a class="navbar-brand mb-0 h1" href="#">
          <h1>BurgerHouse</h1>
        </a>
        <button id="toggleSidebar" class="btn btn-outline-light d-lg-none ml-3"></button>
      </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-left" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              <h2>Início</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="paginas/sobre.php">
              <h2>Sobre</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="paginas/cardapio.php">
              <h2>Cardápio</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="paginas/contato.php">
              <h2>Contato</h2>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="paginas/conta.php">
              <h2>Reclamações</h2>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <section class="section">
    <h1 class="texto-cor">Bem-vindo à BurgerHouse</h1>
    <p class="texto-cor">O sabor que conquista a primeira mordida.</p>
  </section>

  <div id="burgerCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#burgerCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#burgerCarousel" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="img/burger-carrossel1.avif" alt="Hambúrguer artesanal" />
        <div class="carousel-caption d-none d-md-block">
          <h2>O melhor hambúrguer da cidade</h2>
          <h3>Receitas artesanais, ingredientes frescos e muito sabor.</h3>
        </div>
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="img/burger-carrossel2.avif" alt="Combos deliciosos" />
        <div class="carousel-caption d-none d-md-block">
          <h2>Combos imperdíveis</h2>
          <h3>Hambúrguer + Batata + Bebida com preço especial.</h3>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#burgerCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#burgerCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>

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
      <b>&copy; 2025 BurgerHouse</b>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
</body>

</html>