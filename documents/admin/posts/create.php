<?php
include("../../include/path.php");
include("../../controllers/posts.php");

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
          <div class="button row">
            <a href="<?= BASE_URL . "documents/admin/posts/create.php"; ?>" class="col-3 btn btn-success">Создать</a>
            <span class="col-1"></span>
            <a href="<?= BASE_URL . "documents/admin/posts/index.php"; ?>" class="col-3 btn
              btn-warning">Управление</a>
          </div>
          <div class="row title-table">
            <h1>Добавление картины</h1>

          </div>
          <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
              <p>
                <?= $errMsg; ?>
              </p>
            </div>
            <form action="create.php" method="post" enctype="multipart/form-data">
              <div class="col mb-4">
                <input name="description" value="<?= $description; ?>" type="text" class="form-control"
                  placeholder="title" aria-label="Название картины">
              </div>

              <div class="input-group col">
                <input name="img" value="<?= $img; ?>" type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
              </div>
              <div class="col">
                <label for="editor" class="form-label">Описание картины</label>
                <textarea name="content" value="<?= strip_tags($content, ENT_QUOTES); ?>" class="form-control"
                  rows="6"></textarea>
              </div>
              <select name="author_id" class="form-select" aria-label="Default select example">
                <option selected>Выберите автора:</option>
                <?php foreach ($authors as $key => $author): ?>
                  <option value="<?= $author['id']; ?>">
                    <?= $author['name']; ?>
                  </option>

                <?php endforeach; ?>
              </select>

              <div class="w-100"></div>
              <select name="gallery_id" class="form-select" aria-label="Default select example">
                <option selected>Выберите жанр:</option>
                <?php foreach ($topics as $key => $topic): ?>
                  <option value="<?= $topic['id']; ?>">
                    <?= $topic['genre']; ?>
                  </option>

                <?php endforeach; ?>
              </select>
              <div class="col">
                <button name="add_post" class="btn btn-primary" type="submit">Добавить картину</button>
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
