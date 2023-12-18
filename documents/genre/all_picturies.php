<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Все картины жанров и авторов">
    <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="/style.css">
    <title>Все картины</title>
    <style>

    </style>
  </head>
  <body>
    <div class="wrapper">
    <header id="menu">
      <script type="text/javascript" src="/script.js"></script>
    </header>
    <div class="image-container">
    <h1 style="width: 100%; text-align: center;">Картины:</h1>
      <?php
        require_once 'db_connect.php';
        $sql = "SELECT * FROM images";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while($row = mysqli_fetch_assoc($result)) {
            echo "<div class='image-item'>";
            echo "<img src='../img/" . $row["img"] . "' alt='Картина'>";
            echo "<h2>" . $row["description"] . "</h2>";
            echo "</div>";
          }
        }
        mysqli_close($conn);
      ?>
    </div>
    <footer>
      &copy; <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
    </footer>
    </div>
  
  </body>
</html>