<?php include("../include/path.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Описание галереии">

      <!--Bootstrap CSS-->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
      
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;500;600;700&family=Kalnia:wght@400;600&family=Noto+Sans:wght@300;400;500;700&family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">
      
      <!--Font Awesome-->
      <script src="https://kit.fontawesome.com/3ace3ebe9b.js" crossorigin="anonymous"></script>

      <link rel="stylesheet" href="/st.css">
      <link rel="shortcut icon" href="/documents/img/favicon.ico" type="image/x-icon">
      <title>Галерея живописи</title>

  </head>
  <body>
    <div class="wrapper">
    <?php include("./include/header.php"); ?>
    <!--END HEADER-->

    <!--FORM-->
    <div class="container reg_form">
    <form class="row justify-content-md-center" method="post" action="reg.php">
      <h2>Форма регистрации</h2>
    <div class="w-100"></div>
      <div class="mt-3 mb-3 col-12 col-md-4">
        <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите ваш логин...">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">Мы не передадим ваш адрес третьим лицам.</div>
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputPassword1" class="form-label">Повторите пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword2">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <button type="button" class="btn btn-secondary">Регистрация</button>
        <a href="aut.php">Войти</a>
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
