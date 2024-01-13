<?php include("path.php"); ?>

<header class="container-fluid" id="menu">
  <div class="container">
    <div class="row">
      <div class="col-4">

        <h1 class="logoo"><img src="/documents/img/favicon.ico" alt="Галерея" class="gallery-image">
          <a href="<?php echo BASE_URL ?>index.php" class="logo" title="Главная страница">Картинная галерея</a>
        </h1>
      </div>
      <nav class="col-8">
        <ul>

          <li>
            <a href="#">
              <i class="fa"></i>
              <?php echo $_SESSION['login']; ?>
            </a>
          </li>
          <li>
            <a href="<?php echo BASE_URL ?>documents/admin/logout.php" title="">Выход</a>
          </li>

        </ul>
      </nav>
    </div>
  </div>
</header>
