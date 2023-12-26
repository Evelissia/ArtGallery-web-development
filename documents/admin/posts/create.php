<?php session_start();
include("../../include/path.php")
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
            <form action="create.php" method="post">
              <div class="col">
                <input type="text" class="form-control" placeholder="title" aria-label="Название картины">
              </div>
              <div class="col">
                <label for="content" class="form-label">Содержимое записи</label>
                <textarea class="form-control" id="content" rows="6"></textarea>
              </div>
              <div class="input-group col">
                <input type="file" class="form-control" id="inputGroupFile02">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
              </div>
              <select class="form-select" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
              </select>
              <div class="col">
                <button class="btn btn-primary" type="submit">Сохранить запись</button>
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
