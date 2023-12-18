<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Все авторы">
      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/style.css">
      <link rel="stylesheet" href="/media.css">
      <title>Авторы</title>
    <style>
      
    </style>
  </head>
  <body>
    <header id="menu">
      <script type="text/javascript" src="/script.js"></script>
    </header>
    <div class="image-container">
            <h1 style="width: 100%; text-align: center;">Авторы:</h1>
                  
                  <?php
                    require_once '../genre/db_connect.php';
                    $sql = "SELECT * FROM author";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            $authorId = $row["id"]; // Получение ID автора
                            echo "<div class='image-item'>";
                            echo "<a href='http://localhost/documents/autor/pictures.php?id=" . $authorId . "' target='_blank'>";
                            echo "<img src='../img/" . $row["img"] . "' alt='Изображение автора'>";
                            echo "</a>";
                            echo "<h2>" . $row["name"] . "</h2>";
                            echo "</div>";
                            // Создание ссылки для каждого автора с использованием его ID и открытием в новом окне
                            /*$authorLink = "<a href='http://localhost/documents/autor/pictures.php?id=" . $authorId . "' target='_blank'>" . $row["name"] . "</a>";
                           
                            echo "<div class='image-item'>";
                            echo "<img src='../img/" . $row["img"] . "' alt='Картина'>";
                            echo "<h2>" . $authorLink . "</h2>";
                            echo "</div>";*/
                        }
                    }
                    mysqli_close($conn);
                  ?>
        </div>
    <footer>
    &copy; <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
  </footer>
  </body>
</html>