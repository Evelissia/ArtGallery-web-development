<?php include("../include/path.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Все авторы">
  <!--Bootstrap CSS-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Kalnia:wght@400;600&family=Noto+Sans:wght@300;400;500;700&family=PT+Sans+Caption:wght@400;700&display=swap"
    rel="stylesheet">
  <!--Font Awesome-->
  <script src="https://kit.fontawesome.com/3ace3ebe9b.js" crossorigin="anonymous"></script>
  <script src="../../menu.js"></script>

  <meta property="og:title" content="Известные художники">
  <meta property="og:description" content="На этой странице представлены имена известных художников">
  <link rel="stylesheet" href="/st.css">
  <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
  <title>Авторы</title>

</head>

<body>
  <div class="wrapper">
    <?php include("../include/header.php"); ?>

    <div class="parent">
      <div class="image-container">

        <h1 style="width: 100%; text-align: center;">Авторы:</h1>

        <?php
        require_once '../database/db_connect.php';
        $sql = "SELECT * FROM author";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $authorId = $row["id"]; // Получение ID автора
            echo "<div class='image-item'>";
            $authorLink = "<a href='" . BASE_URL . "documents/autor/pictures.php?id=" . $authorId . "' target='_blank'> title='Картины автора' " . $row["name"] . "</a>";
            echo "<a href='" . BASE_URL . "documents/autor/pictures.php?id=" . $authorId . "' target='_blank'>";
            echo "<div class='img-container'>"; // Добавлен контейнер для изображения и текста
            echo "<img src='../img/" . $row["img"] . "' alt='Изображение автора' class='img-item img-fluid'>";
            echo "<h2 class='name-authors'>" . $row["name"] . "</h2>";
            echo "</div>";
            echo "</a>";
            echo "</div>";
          }
        }
        mysqli_close($conn);
        ?>
      </div>
    </div>

    <div class="btn-print">
      <button onclick="javascript:window.print()">Печать</button>
    </div>
    <?php include("../include/footer.php"); ?>
  </div>

</body>

</html>
