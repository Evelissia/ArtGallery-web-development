<?php
include("../../include/path.php");
include("../../controllers/topics.php");
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

  <link rel="stylesheet" href="/admin.css">
  <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
  <title>Галерея живописи</title>

</head>

<body>
  <div class="wrapper">
    <?php include("../../include/header-admin.php"); ?>

    <div class="container">
      <div class="row">
        <?php include "../../include/sidebar-admin.php" ?>
        <div class="posts col-9">
          <!-- ... (Your existing content) ... -->
          <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
              <p>
                <?= $errMsg ?>
              </p>
            </div>
            <form action="edit.php" method="post" enctype="multipart/form-data">
              <input name="id" value="<?= $id; ?>" type="hidden">
              <div class="col">
                <input name="genre" value="<?= $genre; ?>" type="text" class="form-control" placeholder="Название жанра"
                  aria-label="Название жанра">
              </div>

              <?php if (!empty($img)): ?>
                <div class="col">
                  <img src="<?= BASE_URL . 'documents/img/' . $img; ?>" alt="Current Image"
                    style="max-width: 200px; margin-top: 10px;">
                </div>
              <?php endif; ?>

              <div class="input-group col">
                <input name="img" type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
              </div>

              <div class="col">
                <button name="genre-edit" class="btn btn-primary" type="submit">Обновить жанр</button>
              </div>
            </form>
          </div>

        </div>
      </div>
    </div>
  </div>

  <?php include("../../include/footer.php"); ?>
</body>

</html>
