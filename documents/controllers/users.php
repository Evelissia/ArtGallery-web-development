<?php
include("../genre/db.php");

$isSubmit = false; // проверка прохождения формы
$errMsg = ''; //для вывода ошибок
$regStatus = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $admin = 0;
  $login = trim($_POST['login']);
  $email = trim($_POST['mail']);
  $passF = trim($_POST['pass-first']);
  $passS = trim($_POST['pass-second']);



  if ($login === '' || $email === '' || $passF === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($login, 'UTF8') < 2) {
    $errMsg = "Логин должен быть более 2-х символов!";
  } elseif ($passF !== $passS) {
    $errMsg = "Пароли в обоих полях должны совпадать!";
  } else {
    $userExists = selectAll('users', $conn, ['email' => $email]);
    if ($userExists) {
      $errMsg = "Пользователь с таким email уже зарегистрирован.";
    } else {
      $pass = password_hash($passF, PASSWORD_DEFAULT);
      $data = [
        'admin' => $admin,
        'username' => $login,
        'email' => $email,
        'password' => $pass

        /*'login' => $_POST['login'] ?? '',
        'mail' => $_POST['mail'] ?? '',
        'pass-second' => $hashedPassword,
        'admin' => 0*/
      ];

      echo '<pre>';
      print_r(var_dump($data));
      echo '</pre>';
      $isSubmit = true;
      $errMsg = '<span style="color: green;">Пользователь <strong>' . $login . '</strong> успешно зарегистрирован</span>';
    }


    // это само добавление в БД
    if ($isSubmit) {
      $id = insert($conn, 'users', $data);
      if ($id) {
        echo "Данные успешно добавлены. ID: " . $id;
      } else {
        echo "Ошибка при добавлении данных.";
      }
    }
    // $id = insert($conn, 'users', $data);
  }

  /*$id = insert($conn, 'users', $data);
echo $id;*/
} else {
  echo 'GET';
  $login = '';
  $email = '';
}

// очистка полей с данными от лишних пробелов

//$pass = password_hash($_POST['pass-second'], PASSWORD_DEFAULT);
//$hashedPassword = password_hash($_POST['pass-second'], PASSWORD_DEFAULT);
// полученные данные записываем в базу данных для нашего юзера
// это массив самих данных

// вызов ф-ции к-ая будет записывать в базу данных этот массив данных


/*echo '<pre>';
print_r(var_dump($data));
echo '</pre>';*/




?>
