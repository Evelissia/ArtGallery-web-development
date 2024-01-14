<?php
//session_start();
include(DOCUMENTS_BASE_PATH . 'database/db.php');

$errMsg = '';
$id = '';
$genre = '';
$img = '';
$topics = allGenre('genre', $conn, []);
// код для формы создания жанра
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genre-create'])) {
  $genre = htmlentities(trim($_POST['genre']));
  $img = $_FILES['img']['name']; // Обработка изображения
  $img_tmp = $_FILES['img']['tmp_name']; // Временное имя файла

  if ($genre === '' || $img === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($genre, 'UTF8') < 2) {
    $errMsg = "Жанр должен быть более 2-х символов!";
  } else {
    // Проверка на существование жанра в базе
    $userExists = selectAll('genre', $conn, ['genre' => $genre]);

    if ($userExists) {
      $errMsg = "Такой жанр в базе уже существует.";
    } else {
      // Путь к папке, куда нужно сохранить изображение
      $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;

      // Копирование изображения из временной директории в нужную папку
      if (move_uploaded_file($img_tmp, $upload_path)) {
        $genres = [
          'genre' => $genre,
          'img' => $img
        ];

        // Добавление жанра в базу данных
        $id = insert($conn, 'genre', $genres);

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
} else {
  $genre = '';
  $img = '';
}

/*echo '<pre>';
print_r(var_dump($data));
echo '</pre>';*/

// Редактирование жанра
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $topic = selectAll('genre', $conn, ['id' => $id]);
  $id = $topic['id'];
  $genre = htmlentities($topic['genre']);
  $img = $topic['img'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genre-edit'])) {
  $genre = htmlentities(trim($_POST['genre']));
  $current_img = $_POST['current_img']; // Получаем текущее изображение

  if ($genre === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($genre, 'UTF8') < 2) {
    $errMsg = "Название жанра должно быть более 2-х символов!";
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
    $genres = [
      'genre' => $genre,
      'img' => $img
    ];

    $id = $_POST['id'];
    $genre_id = update($conn, 'genre', $id, $genres);

    if ($id) {
      $errMsg = "Данные успешно обновлены. ID: " . $id;
    } else {
      $errMsg = "Ошибка при обновлении данных. Ошибка MySQL: " . mysqli_error($conn);
    }
  }
}

// Удаление жанра
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  $id = $_GET['del_id'];

  deleteUserById($conn, 'genre', $id);
  header('Location: ' . BASE_URL . 'documents/admin/topics/index.php');
}
?>
