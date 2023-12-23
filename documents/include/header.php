<?php include("path.php"); ?>

<header class="container-fluid" id="menu">
  <div class="container">
    <div class="row">
      <div class="col-4">

        <h1 class="logoo"><img src="/documents/img/favicon.ico" alt="Галерея" class="gallery-image">
          <a href="<?php echo BASE_URL ?>hello.php" class="logo" title="Главная страница">Картинная галерея</a>
        </h1>
      </div>
      <nav class="col-8">
        <ul>
          <li><a href="<?php echo BASE_URL ?>documents/autor/autors.php">Авторы</a></li>
          <li><a href="<?php echo BASE_URL ?>documents/genre/genre.php" title="Список жанров">Жанры</a></li>
          <li><a href="<?php echo BASE_URL ?>documents/genre/all_picturies.php" title="Список картин">Картины</a></li>

          <li>
            <a href="#">
              <i class="fa fa-user"></i>
              Кабинет</a>
            <ul>
              <li><a href="<?php echo BASE_URL ?>documents/admin/reg.php" title="">Админ панель</a></li>
              <li><a href="<?php echo BASE_URL ?>documents/admin/users.php" title="">Users</a></li>
              <li><a href="#" title="">Выход</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</header>
