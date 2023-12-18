<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/style.css">
      <link rel="stylesheet" href="/media.css">
      <title>Картины жанра</title>
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
                  $genreId = $_GET['id'];

                   // Выполнение SQL-запроса для получения имени автора
                  $genreSql = "SELECT genre FROM genre WHERE id = $genreId";
                  $genreResult = mysqli_query($conn, $genreSql);

                  if (mysqli_num_rows($genreResult) > 0) {
                    $genreRow = mysqli_fetch_assoc($genreResult);
                    $genreName = $genreRow["genre"];
              
                    echo "<h1 style='width: 100%; text-align: center;'>Картины $genreName:</h1>";
              
                    // Выполнение SQL-запроса для получения картин конкретного автора
                    $sql = "SELECT * FROM images WHERE gallery_id = $genreId";
                    $result = mysqli_query($conn, $sql);
              
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='image-item'>";
                        echo "<img src='../img/" . $row["img"] . "' alt='Картина'>";
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