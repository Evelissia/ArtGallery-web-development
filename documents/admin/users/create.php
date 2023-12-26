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
            <a href="<?= BASE_URL . "documents/admin/users/create.php"; ?>" class="col-3 btn btn-success">Создать</a>
            <span class="col-1"></span>
            <a href="<?= BASE_URL . "documents/admin/users/index.php"; ?>" class="col-3 btn btn-warning">Управление</a>
          </div>
          <div class="row title-table">
            <h1>Создание пользователя</h1>

          </div>
          <div class="row add-post">
            <form action="create.php" method="post">

              <div class="col">
                <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
                <input name="login" value="" type="text" class="form-control" id="formGroupExampleInput"
                  placeholder="Введите ваш логин...">
              </div>
              <div class="col">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input name="mail" value="" type="email" class="form-control" id="exampleInputEmail1"
                  aria-describedby="emailHelp">
              </div>
              <div class="col">
                <label for="exampleInputPassword1" class="form-label">Пароль</label>
                <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1">
              </div>
              <div class="col">
                <label for="exampleInputPassword1" class="form-label">Повторите пароль</label>
                <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2">
              </div>
              <select class="form-select" aria-label="Default select example">
                <option selected>User</option>
                <option value="1">Admin</option>

              </select>


              <div class="col">
                <button class="btn btn-primary" type="submit">Создать</button>
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
