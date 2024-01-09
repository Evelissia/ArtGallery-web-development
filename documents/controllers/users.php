<?php
include("../database/db.php");

$isSubmit = false; // проверка прохождения формы
$errMsg = '';
function userAuth($user)
{
  $_SESSION['id'] = $user['id'];
  $_SESSION['login'] = $user['username'];
  $_SESSION['admin'] = $user['admin'];

  if ($_SESSION['admin']) {
    header('location: ' . BASE_URL . '/documents/admin/posts/index.php');
  } else {
    header('location: ' . BASE_URL . '/hello.php');
  }
}
// код для регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
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
      ];
      echo '<pre>';
      print_r(var_dump($data));
      echo '</pre>';
      $isSubmit = true;
      // это само добавление в БД
      if ($isSubmit) {
        $id = insert($conn, 'users', $data);
        if ($id) {
          echo "Данные успешно добавлены. ID: " . $id;
        } else {
          echo "Ошибка при добавлении данных.";
        }
      }
      // создать параметры сессии и передать параметры, к-ые нам нужны
      $user = selectAll('users', $conn, ['id' => $id]);
      userAuth($user);
      /*echo '<pre>';
      print_r(var_dump($_SESSION));
      echo '</pre>';
      exit();*/
      //$isSubmit = true;
    }
  }
} else {
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

// код для формы авторизации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])) {
  $email = trim($_POST['mail']);
  $pass = trim($_POST['password']);

  if ($email === '' || $pass === '') {
    $errMsg = "Не все поля заполнены!";
  } else {
    $existence = selectAll('users', $conn, ['email' => $email]);
    if ($existence && password_verify($pass, $existence['password'])) {
      userAuth($existence);
    } else {
      $errMsg = "Почта либо пароль введены неверно!";
    }
  }
} else {
  $email = '';
}
?>
