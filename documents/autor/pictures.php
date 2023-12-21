<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Все картины выбранного автора">
      <!--Bootstrap CSS-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Kalnia:wght@400;600&family=Noto+Sans:wght@300;400;500;700&family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">
      
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/3ace3ebe9b.js" crossorigin="anonymous"></script>

      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/st.css">
      <title>Картины автора</title>
      <style>
      
    </style>
  </head>
  <body>
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
                <li><a href="#" title="">Админ панель</a></li>
              <li><a href="#" title="">Выход</a></li>
                </ul>
              </li>
            </ul>
          </nav>
      </div>
      </div>
    </header>
    <div class="image-container">
            
          
    <?php
    require_once '../genre/db_connect.php';
    // Получение ID автора из URL-параметра
    $authorId = $_GET['id'];

    // Выполнение SQL-запроса для получения имени автора
    $authorSql = "SELECT name FROM author WHERE id = $authorId";
    $authorResult = mysqli_query($conn, $authorSql);

    if (mysqli_num_rows($authorResult) > 0) {
        $authorRow = mysqli_fetch_assoc($authorResult);
        $authorName = $authorRow["name"];

        echo "<h1 style='width: 100%; text-align: center; margin-top: 30px;'>Картины $authorName:</h1>";

        // Выполнение SQL-запроса для получения картин конкретного автора
        $sql = "SELECT * FROM images WHERE author_id = $authorId";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='image-item'>";
                echo "<div class='img-container'>"; // Добавлен контейнер для изображения и текста
                echo "<img src='../img/" . $row["img"] . "' alt='Картина' class='img-item img-fluid'>";
                echo "<h2 class='hidden-title'>" . $row["description"] . "</h2>"; // Добавлен скрытый заголовок
                echo "</div>";
                echo "</div>";
            }
        } else {
            echo "<p>У данного автора нет картин.</p>";
        }
    } else {
        echo "<p>Автор не найден.</p>";
    }

    mysqli_close($conn);
?>

        
    </div>
    <script type="text/javascript">
      
    </script>

<footer class="footer">
    &copy; <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
  </footer>
  </body>
</html>