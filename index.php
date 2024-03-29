<?php include("documents/include/path.php");
include("documents/database/db.php");
function getRandomImages($conn, $limit)
{
  $sql = "SELECT * FROM images ORDER BY RAND() LIMIT $limit";
  $result = mysqli_query($conn, $sql);

  $images = [];
  while ($row = mysqli_fetch_array($result)) {
    $images[] = $row;
  }

  return $images;
}

$randomImages = getRandomImages($conn, 9);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Описание галереии">

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
  <script src="menu.js"></script>

  <link rel="stylesheet" href="st.css">
  <link rel="shortcut icon" href="documents/img/favicon.ico" type="image/x-icon">
  <title>Галерея живописи</title>

</head>

<body>
  <div class="wrapper">
    <?php include("documents/include/header.php"); ?>
    <div class="parent">
      <div class="block">
        <h2>Добро пожаловать!</h2>

        <h4>Для вашего удобства мы собрали огромную картинную галерею. На нашем сайте вы можете найти список жанров,
          список авторов, все картины определенного автора, все картины выбранного жанра.</h4>
        <h1 class="main-title">Известные картины:</h1>

        <?php
        foreach ($randomImages as $image) {
          echo "<div class='image-item'>";
          echo "<div class='img-container'>";
          echo "<img src='documents/img/" . $image["img"] . "' alt='Картина' class='img-item img-fluid'>";
          echo "<h2 class=''>" . $image["description"] . "</h2>";
          echo "</div>";
          echo "</div>";
        }
        ?>
      </div>
    </div>


  </div>
  <?php include("documents/include/footer.php"); ?>

</body>

</html>
