<?php

// Используем абсолютный путь к файлу db.php
include(DOCUMENTS_BASE_PATH . 'database/db.php');

$errMsg = '';
$genre = '';
$img = '';

//$genres = selectAll($conn, 'genre');

// код для формы создания жанра
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['genre-create'])) {
  $genre = trim($_POST['genre']);
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
          // В случае успешного добавления
          echo "Данные успешно добавлены. ID: " . $id;
        } else {
          // В случае ошибки при добавлении
          echo "Ошибка при добавлении данных. Ошибка MySQL: " . mysqli_error($conn);
        }
      } else {
        // В случае ошибки при копировании изображения
        echo "Ошибка при загрузке изображения.";
      }
    }
  }
}

?>
