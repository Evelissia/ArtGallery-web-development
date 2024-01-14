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

          <div class="row title-table">
            <h1>Редактирование картины</h1>
          </div>
          <div class="row add-post">
            <div class="mb-12 col-12 col-md-12 err">
              <p>
                <?= $errMsg; ?>
              </p>
            </div>
            <form action="edit.php" method="post" enctype="multipart/form-data">
              <input name="id" value="<?= $id; ?>" type="hidden">
              <div class="col mb-4">
                <input name="description" value="<?= strip_tags($description, ENT_QUOTES); ?>" type="text"
                  class="form-control" placeholder="title" aria-label="Название картины">
              </div>

              <?php if (!empty($img)): ?>
                <div class="col">
                  <img src="<?= BASE_URL . 'documents/img/' . $img; ?>" alt="Current Image"
                    style="max-width: 200px; margin-top: 10px;">
                </div>
              <?php endif; ?>

              <input type="hidden" name="current_img" value="<?= $img; ?>">
              <div class="input-group col">
                <input name="img" type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
              </div>

              <div class="col">
                <label for="editor" class="form-label">Описание картины</label>
                <textarea name="content" class="form-control"
                  rows="6"><?= htmlspecialchars($content, ENT_QUOTES); ?></textarea>
              </div>
              <select name="author_id" class="form-select" aria-label="Default select example">
                <option selected>Выберите автора:</option>
                <?php foreach ($authors as $key => $author): ?>
                  <option value="<?= $author['id']; ?>" <?= ($author['id'] == $author_id) ? 'selected' : ''; ?>>
                    <?= $author['name']; ?>
                  </option>
                <?php endforeach; ?>
              </select>

              <div class="w-100"></div>
              <select name="gallery_id" class="form-select" aria-label="Default select example">
                <option selected>Выберите жанр:</option>
                <?php foreach ($topics as $key => $topic): ?>
                  <option value="<?= $topic['id']; ?>" <?= ($topic['id'] == $gallery_id) ? 'selected' : ''; ?>>
                    <?= $topic['genre']; ?>
                  </option>
                <?php endforeach; ?>
              </select>
              <div class="col">
                <button name="edit_post" class="btn btn-primary" type="submit">Сохранить картину</button>
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
