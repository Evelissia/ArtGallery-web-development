<?php
include(DOCUMENTS_BASE_PATH . 'database/db.php');

$errMsg = '';
$id = '';
$name = '';
$img = '';
$authors = allGenre('author', $conn, []);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author_create'])) {
  $name = htmlentities(trim($_POST['name']));
  $img = $_FILES['img']['name'];
  $img_tmp = $_FILES['img']['tmp_name'];
  // Проверки на ввод данных (пустые поля, длина имени и пр.)
  // код проверок
  if ($name === '' || $img === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($name, 'UTF8') < 2) {
    $errMsg = "Имя автора должно содержать более 2-х символов!";
  } else {
    $authorExists = selectAll('author', $conn, ['name' => $name]);

    if ($authorExists) {
      $errMsg = "Такой автор уже существует.";
    } else {
      $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;

      if (move_uploaded_file($_FILES['img']['tmp_name'], $upload_path)) {
        $authorData = [
          'name' => $name,
          'img' => $img
        ];

        $id = insert($conn, 'author', $authorData);

        if ($id) {
          $errMsg = "Данные успешно добавлены. ID: " . $id;
        } else {
          $errMsg = "Ошибка при добавлении данных. Ошибка MySQL: " . mysqli_error($conn);
        }
      } else {
        $errMsg = "Ошибка при загрузке изображения.";
      }
    }
  }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  // Редактирование автора
  $id = $_GET['id'];
  $author = selectAll('author', $conn, ['id' => $id]);
  $name = htmlentities($author['name']);
  $img = $author['img'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author-edit'])) {
  $name = htmlentities(trim($_POST['name']));
  $current_img = $_POST['current_img']; // Получаем текущее изображение

  if ($name === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($name, 'UTF8') < 2) {
    $errMsg = "Имя автора должно быть более 2-х символов!";
  } else {
    $img = $current_img; // По умолчанию используем текущее изображение

    // Если выбрано новое изображение, обновляем переменные
    if (!empty($_FILES['img']['name'])) {
      $img = $_FILES['img']['name'];
      $img_tmp = $_FILES['img']['tmp_name'];
    }

    $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;

    if (!empty($_FILES['img']['name'])) {
      // Если выбрано новое изображение, перемещаем его в нужную папку
      if (move_uploaded_file($img_tmp, $upload_path)) {
        $errMsg = "Изображение успешно загружено.";
      } else {
        $errMsg = "Ошибка при загрузке изображения.";
      }
    }

    // Обновляем данные в базе данных
    $authors = [
      'name' => $name,
      'img' => $img
    ];

    $id = $_POST['id'];
    $author_id = update($conn, 'author', $id, $authors);

    if ($id) {
      $errMsg = "Данные успешно обновлены. ID: " . $id;
    } else {
      $errMsg = "Ошибка при обновлении данных. Ошибка MySQL: " . mysqli_error($conn);
    }
  }
}

// Удаление автора
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  // Удаление автора
  $id = $_GET['del_id'];
  deleteUserById($conn, 'author', $id);
  header('Location: ' . BASE_URL . 'documents/admin/authors/index.php');
}
?>
