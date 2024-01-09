<?php
include(DOCUMENTS_BASE_PATH . 'database/db.php');

$errMsg = '';
$id = '';
$name = '';
$img = '';
$authors = allGenre('author', $conn, []);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author_create'])) {
  $name = trim($_POST['name']);
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
  $name = $author['name'];
  $img = $author['img'];
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['author-edit'])) {

  $name = trim($_POST['name']);
  $img = $_FILES['img']['name'];
  $img_tmp = $_FILES['img']['tmp_name']; // Временное имя файла

  if ($name === '' || $img === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($name, 'UTF8') < 2) {
    $errMsg = "Жанр должен быть более 2-х символов!";
  } else {
    // Проверка на существование автора в базе
    //$userExists = selectAll('genre', $conn, ['genre' => $genre]);
    // Путь к папке, куда нужно сохранить изображение
    $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;
    if (move_uploaded_file($img_tmp, $upload_path)) {
      $authors = [
        'name' => $name,
        'img' => $img
      ];
      // Добавление жанра в базу данных
      $id = $_POST['id'];
      $author_id = update($conn, 'author', $id, $authors);
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
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  // Удаление автора
  $id = $_GET['del_id'];
  deleteUserById($conn, 'author', $id);
  header('location: ' . BASE_URL . 'documents/admin/authors/index.php');
}
?>
