<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Описание галереии">
      <link rel="stylesheet" href="./style.css">
      <link rel="stylesheet" href="/media.css">
      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <title>Галерея живописи</title>

  </head>
  <body>
    <header id="menu">
    <div class="duplicated-links">
        <a href="http://localhost/documents/autor/autors.php" title="Список всех авторов">Авторы</a>
        <a href="http://localhost/documents/genre/genre.php" title="Список жанров">Жанры</a>
        <a href="http://localhost/documents/genre/all_picturies.php" title="Список картин">Картины</a>
        <button class="btn-print" onclick="javascript:window.print()">Печать</button>
      </div>
      
      <script type="text/javascript" src="script.js"></script>
    </header>
    <div class="parent">
      <div class="block">
        <h2>Добро пожаловать!</h2>
        
        <h4>Для вашего удобства мы собрали огромную картинную галерею. На нашем сайте вы можете найти список жанров, список авторов, все картины определенного автора, все картины выбранного жанра.</h4>
      </div>
    </div>

    <footer>
    &copy; <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
    
  </footer>

  </body>
</html>


