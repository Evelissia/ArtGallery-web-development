<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Жанры картин">
      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <link rel="stylesheet" href="/style.css">
      <link rel="stylesheet" href="/media.css">
      <title>Жанры</title>
      <style>
       
      </style>
  </head>
  <body>
    <div class="wrapper">
    <header id="menu">
      <script type="text/javascript" src="../../script.js"></script>
    </header>
    <div class="image-container">
    <h1 style="width: 100%; text-align: center;">Жанры:</h1>
      <?php
        require_once 'db_connect.php';
        $sql = "SELECT * FROM genre";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            $genreId = $row["id"];

            $genreLink = "<a href='http://localhost/documents/genre/genre_picturies.php?id=" . $genreId . "' target='_blank'>" . $row["genre"] . "</a>";
            echo "<div class='image-item'>";
            echo "<img src='../img/" . $row["img"] . "' alt='Картина'>";
            echo "<h2>" . $genreLink . "</h2>";
            echo "</div>";
          }
        }
        mysqli_close($conn);
      ?>
    </div>
    </div>
    <footer>
    &copy; <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
  </footer>
  </body>
</html>