<?php
//session_start();
// Используем абсолютный путь к файлу db.php
include(DOCUMENTS_BASE_PATH . 'database/db.php');

$errMsg = '';
$id = '';
$description = '';
$img = '';
$author_id = '';
$gallery_id = '';

$topics = allGenre('genre', $conn, []);
$authors = allGenre('author', $conn, []);

// код для формы создания картины
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
  $description = trim($_POST['description']);
  $img = $_FILES['img']['name']; // Обработка изображения
  $img_tmp = $_FILES['img']['tmp_name']; // Временное имя файла

  $author_id = $_POST['author_id']; // Получаем ID автора из формы
  $gallery_id = $_POST['gallery_id']; // Получаем ID жанра из формы

  if ($description === '' || $img === '' || $author_id === '' || $gallery_id === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($description, 'UTF8') < 2) {
    $errMsg = "Название картины должно быть более 2-х символов!";
  } else {
    // Проверка на существование жанра в базе
    $pictureExists = selectAll('images', $conn, ['description' => $description]);

    if ($pictureExists) {
      $errMsg = "Такая картина в базе уже существует.";
    } else {
      // Путь к папке, куда нужно сохранить изображение
      $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;

      // Копирование изображения из временной директории в нужную папку
      if (move_uploaded_file($img_tmp, $upload_path)) {
        $pictures = [
          'description' => $description,
          'img' => $img,
          'author_id' => $author_id, // Добавляем автора к картине
          'gallery_id' => $gallery_id // Добавляем жанр к картине
        ];

        // Добавление картины в базу данных
        $id = insert($conn, 'images', $pictures);

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
}

/*echo '<pre>';
print_r(var_dump($data));
echo '</pre>';*/

// Редактирование жанра
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
  $id = $_GET['id'];
  $topic = selectAll('genre', $conn, ['id' => $id]);
  $id = $topic['id'];
  $genre = $topic['genre'];
  $img = $topic['img'];
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genre-edit'])) {

  $genre = trim($_POST['genre']);
  $img = $_FILES['img']['name']; // Обработка изображения
  $img_tmp = $_FILES['img']['tmp_name']; // Временное имя файла

  if ($genre === '' || $img === '') {
    $errMsg = "Не все поля заполнены!";
  } elseif (mb_strlen($genre, 'UTF8') < 2) {
    $errMsg = "Жанр должен быть более 2-х символов!";
  } else {
    // Проверка на существование жанра в базе
    //$userExists = selectAll('genre', $conn, ['genre' => $genre]);
    // Путь к папке, куда нужно сохранить изображение
    $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;

    // Копирование изображения из временной директории в нужную папку
    if (move_uploaded_file($img_tmp, $upload_path)) {
      $genres = [
        'genre' => $genre,
        'img' => $img
      ];

      // Добавление жанра в базу данных
      $id = $_POST['id'];
      $genre_id = update($conn, 'genre', $id, $genres);
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
// Удаление жанра
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  $id = $_GET['del_id'];

  deleteUserById($conn, 'genre', $id);
  header('location' . BASE_URL . 'documents/admin/topics/index.php');
}
?>
