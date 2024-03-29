<?php include("../include/path.php");
include("../database/db.php");
$page = isset($_GET['page']) ? $_GET['page'] : 1;
/*echo '<pre>';
print_r(var_dump($page));
echo '</pre>';*/
$limit = 6;
$offset = $limit * ($page - 1);
$total_pages = round(countRow($conn, 'images') / $limit, 0);

// Формируем SQL-запрос для получения изображений на текущей странице
$sql = "SELECT * FROM images LIMIT $limit OFFSET $offset";
$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Все картины жанров и авторов">
  <!--Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Kalnia:wght@400;600&family=Noto+Sans:wght@300;400;500;700&family=PT+Sans+Caption:wght@400;700&display=swap"
    rel="stylesheet">

  <meta property="og:title" content="Картины известных художников">
  <meta property="og:description" content="На этой странице представлены картины известных художников">
  <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
  <script src="https://kit.fontawesome.com/3ace3ebe9b.js" crossorigin="anonymous"></script>
  <script src="../../menu.js"></script>
  <link rel="stylesheet" href="/st.css">
  <link rel="stylesheet" href="/documents/genre/styleBtn.css">
  <title>Все картины</title>
  <style>

  </style>
</head>

<body>
  <div class="wrapper">

    <?php include("../include/header.php"); ?>

    <div class="image-container">
      <h1 style="width: 100%; text-align: center; margin-top: 30px;">Картины:</h1>
      <?php
      require_once '../database/db_connect.php';
      $sql = "SELECT * FROM images";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<div class='image-item'>";
          echo "<div class='img-container'>";
          echo "<img src='../img/" . $row["img"] . "' alt='Картина' class='img-item img-fluid'>";

          echo "<h2 class='name-authors'>" . $row["description"] . "</h2>";
          echo "<h2 class='content'>" . $row["content"] . "</h2>";
          echo "</div>";
          echo "</a>";
          echo "</div>";
        }
      }
      mysqli_close($conn);
      ?>
    </div>

    <div class="btn-print">
      <button onclick="javascript:window.print()">Печать</button>
    </div>
    <footer class="footer">
      &copy;
      <?php echo date("Y"); ?> Галерея живописи. Все права защищены.
    </footer>
  </div>

</body>

</html>
