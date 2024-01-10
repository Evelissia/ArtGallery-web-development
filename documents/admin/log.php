<?php include("../include/path.php");
include("../controllers/users.php") ?>


<!DOCTYPE html>
<html lang="ru">

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
  <script src="../../menu.js"></script>

  <link rel="stylesheet" href="/st.css">
  <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
  <title>Галерея живописи</title>

</head>

<body>
  <div class="wrapper">
    <?php include("../include/header.php"); ?>
    <!--END HEADER-->

    <!--FORM-->
    <div class="container reg_form no-images-message-reglog">
      <form class="row justify-content-md-center" method="post" action="log.php">
        <h2>Авторизация</h2>
        <div class="mb-3 col-12 col-md-4 err">
          <p>
            <?= $errMsg ?>
          </p>
        </div>
        <div class="w-100"></div>
        <div class="mt-3 mb-3 col-12 col-md-4">
          <label for="formGroupExampleInput" class="form-label">Ваша почта (при регистрации)</label>
          <input name="mail" value="<?= $email ?>" type="email" class="form-control" id="exampleInputEmail1"
            aria-describedby="emailHelp">
        </div>
        <div class="w-100"></div>

        <div class="mb-3 col-12 col-md-4">
          <label for="exampleInputPassword1" class="form-label">Пароль</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1">
        </div>

        <div class="w-100"></div>
        <div class="mb-3 col-12 col-md-4">
          <button type="submit" name="button-log" class="btn btn-secondary">Войти</button>
          <a href="aut.php">Зарегистрироваться</a>
        </div>
      </form>
    </div>
    <!--END FORM-->

    <!-- FOOTER-->
    <?php include("../include/footer.php"); ?>
  </div>


</body>

</html>
<!--END FOOTER-->
