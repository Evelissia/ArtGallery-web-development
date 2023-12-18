<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Все картины выбранного автора">
      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/style.css">
      <link rel="stylesheet" href="/media.css">
      <title>Картины автора</title>
      <style>
      
    </style>
  </head>
  <body>
    <header id="menu">
      <script type="text/javascript" src="/script.js"></script>
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
              
                    echo "<h1 style='width: 100%; text-align: center;'>Картины $authorName:</h1>";
              
                    // Выполнение SQL-запроса для получения картин конкретного автора
                    $sql = "SELECT * FROM images WHERE author_id = $authorId";
                    $result = mysqli_query($conn, $sql);
              
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='image-item'>";
                        echo "<img src='../img/" . $row["img"] . "' alt='Картина'>";
                        echo "<p>" . $row["description"] . "</p>";
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

<footer>
    &copy; <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
  </footer>
  </body>
</html>