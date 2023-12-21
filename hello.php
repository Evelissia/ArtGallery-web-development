<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Описание галереии">

      <!--Bootstrap CSS-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Kalnia:wght@400;600&family=Noto+Sans:wght@300;400;500;700&family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">
      
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/3ace3ebe9b.js" crossorigin="anonymous"></script>

      <link rel="stylesheet" href="/st.css">
      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <title>Галерея живописи</title>

  </head>
  <body>
    <div class="wrapper">
    <header class="container-fluid" id="menu">
      <div class="container">
        <div class="row">
          <div class="col-4">
          
            <h1 class="logoo"><img src="/documents/img/favicon.ico" alt="Галерея" class="gallery-image">
            <a href="http://localhost/hello.php" class="logo" title="Главная страница">Картинная галерея</a></h1>
          </div>
          <nav class="col-8">
            <ul>
              <li><a href="http://localhost/documents/autor/autors.php">Авторы</a></li>
              <li><a href="http://localhost/documents/genre/genre.php" title="Список жанров">Жанры</a></li>
              <li><a href="http://localhost/documents/genre/all_picturies.php" title="Список картин">Картины</a></li>
              
              <li>
                <a href="#">
                  <i class="fa fa-user"></i>
                  Кабинет</a>
                <ul>
                <li><a href="http://localhost/documents/admin" title="">Админ панель</a></li>
              <li><a href="#" title="">Выход</a></li>
                </ul>
              </li>
            </ul>
          </nav>
      </div>
      </div>
    </header>
    <div class="parent">
      <div class="block">
        <h2>Добро пожаловать!</h2>
        
        <h4>Для вашего удобства мы собрали огромную картинную галерею. На нашем сайте вы можете найти список жанров, список авторов, все картины определенного автора, все картины выбранного жанра.</h4>
      </div>
    </div>

    <footer class="footer">
    &copy; <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
    
  </footer>
    </div>
    

  </body>
</html>


