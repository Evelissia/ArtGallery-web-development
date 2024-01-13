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
$content = '';

$topics = allGenre('genre', $conn, []);
$authors = allGenre('author', $conn, []);
$posts = allGenre('images', $conn, []);

// код для формы создания картины
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])) {
  $description = htmlentities(trim($_POST['description']));
  $img = $_FILES['img']['name']; // Обработка изображения
  $img_tmp = $_FILES['img']['tmp_name']; // Временное имя файла

  $author_id = $_POST['author_id']; // Получаем ID автора из формы
  $gallery_id = $_POST['gallery_id']; // Получаем ID жанра из формы
  $content = htmlentities(trim($_POST['content']));

  if ($description === '' || $img === '' || $author_id === '' || $gallery_id === '' || $content === '') {
    $errMsg = "Не все поля заполнены!";
    //array_push($errMsg, "Не все поля заполнены!");
  } elseif (mb_strlen($description, 'UTF8') < 2) {
    $errMsg = "Название картины должно быть более 2-х символов!";
    //array_push($errMsg, "Название картины должно быть более 2-х символов!");
  } else {
    // Проверка на существование жанра в базе
    $pictureExists = selectAll('images', $conn, ['description' => $description]);

    if ($pictureExists) {
      $errMsg = "Такая картина в базе уже существует.";
      //array_push($errMsg, "Такая картина в базе уже существует.");
    } else {
      // Путь к папке, куда нужно сохранить изображение
      $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;

      // Копирование изображения из временной директории в нужную папку
      if (move_uploaded_file($img_tmp, $upload_path)) {
        $pictures = [
          'description' => $description,
          'img' => $img,
          'author_id' => $author_id, // Добавляем автора к картине
          'gallery_id' => $gallery_id, // Добавляем жанр к картине
          'content' => $content
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
  $description = '';
  $img = '';
  $author_id = '';
  $gallery_id = '';
  $content = '';
}

/*echo '<pre>';
print_r(var_dump($data));
echo '</pre>';*/

// Редактирование картины
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {

  $post = selectAll('images', $conn, ['id' => $_GET['id']]);

  $id = $post['id'];
  $description = htmlentities($post['description']);
  $img = $post['img'];
  $gallery_id = $post['gallery_id'];
  $author_id = $post['author_id'];
  $content = htmlentities($post['content']);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])) {

  $description = htmlentities(trim($_POST['description']));
  $img = $_FILES['img']['name']; // Обработка изображения
  $img_tmp = $_FILES['img']['tmp_name']; // Временное имя файла

  $author_id = $_POST['author_id']; // Получаем ID автора из формы
  $gallery_id = $_POST['gallery_id']; // Получаем ID жанра из формы
  $content = htmlentities(trim($_POST['content']));

  if ($description === '' || $img === '' || $author_id === '' || $gallery_id === '' || $content === '') {
    $errMsg = "Не все поля заполнены!";
    //array_push($errMsg, "Не все поля заполнены!");
  } elseif (mb_strlen($description, 'UTF8') < 2) {
    $errMsg = "Жанр должен быть более 2-х символов!";
    //array_push($errMsg, "Жанр должен быть более 2-х символов!");
  } else {
    // Проверка на существование жанра в базе
    //$userExists = selectAll('genre', $conn, ['genre' => $genre]);
    // Путь к папке, куда нужно сохранить изображение
    $upload_path = 'D:/Programs/Ampps/Ampps/www/documents/img/' . $img;

    // Копирование изображения из временной директории в нужную папку
    if (move_uploaded_file($img_tmp, $upload_path)) {
      $pictures = [
        'description' => $description,
        'img' => $img,
        'gallery_id' => $gallery_id,
        'author_id' => $author_id,
        'content' => $content
      ];

      // Добавление жанра в базу данных
      $id = $_POST['id'];
      $genre_id = update($conn, 'images', $id, $pictures);
      if ($id) {
        $errMsg = "Данные успешно добавлены. ID: " . $id;
      } else {
        $errMsg = "Ошибка при добавлении данных. Ошибка MySQL: " . mysqli_error($conn);
      }
    } else {
      $errMsg = "Ошибка при загрузке изображения.";
      //array_push($errMsg, "Ошибка при загрузке изображения.");
    }

  }
}
// Удаление картины
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
  $id = $_GET['del_id'];

  deleteUserById($conn, 'images', $id);
  header('Location: ' . BASE_URL . 'documents/admin/posts/index.php');
}
?>
