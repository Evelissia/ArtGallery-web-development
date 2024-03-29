<?php

/*require('db_connect.php'); 

function tt($value) {
  echo '<pre>';
  print_r($value);
  echo '</pre>';
}
*/

session_start();

include('db_connect.php');

// Функция для вывода данных в формате tt
function tt($value)
{
  echo '<pre>';
  print_r($value);
  echo '</pre>';
}

// Проверка выполнения запроса к БД
function dbCheckError($conn)
{
  if (mysqli_error($conn)) {
    echo "Ошибка запроса: " . mysqli_error($conn);
    exit();
  }
  return true;
}

// Запрос на получение данных одной таблицы
function selectAll($table, $conn, $params = [])
{
  if (!empty($params)) {
    $sql = "SELECT * FROM $table WHERE ";
    $conditions = [];

    foreach ($params as $key => $value) {
      $conditions[] = "$key = '$value'";
    }

    $sql .= implode(' AND ', $conditions);
  } else {
    $sql = "SELECT * FROM $table";
  }

  $sql .= " LIMIT 1"; // Ограничиваем запрос одной записью

  $result = mysqli_query($conn, $sql);

  dbCheckError($conn); // Проверяем ошибку запроса

  $row = mysqli_fetch_assoc($result);

  mysqli_free_result($result);

  return $row; // Возвращаем только одну запись
}

$params = [
  'admin' => 1,
  'username' => 'VV'
];

function allGenre($table, $conn, $params = [])
{
  if (!empty($params)) {
    $sql = "SELECT * FROM $table WHERE ";
    $conditions = [];

    foreach ($params as $key => $value) {
      $conditions[] = "$key = '$value'";
    }

    $sql .= implode(' AND ', $conditions);
  } else {
    $sql = "SELECT * FROM $table";
  }

  $result = mysqli_query($conn, $sql);

  dbCheckError($conn); // Проверяем ошибку запроса

  $rows = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
  }

  mysqli_free_result($result);

  return $rows; // Возвращаем все записи
}

// Запись в таблицу БД
function insert($conn, $table, $data = [])
{
  if (!empty($data)) {
    $keys = implode(', ', array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $sql = "INSERT INTO $table ($keys) VALUES ($values)";

    if (mysqli_query($conn, $sql)) {
      dbCheckError($conn); // Проверка ошибок
      return mysqli_insert_id($conn);
    } else {
      return null;
    }
  } else {
    return null;
  }
}

// Пример использования функции insert для добавления новой записи
$data = [
  'admin' => '1',
  'username' => 'VikaaaEveliSaturn',
  'email' => 'vikaeveli@test.com',
  'password' => '4444'
];

//$result = insert($conn, 'users', $data);



// обновление строки в таблице
function update($conn, $table, $userId, $params)
{
  $sql = "UPDATE $table SET ";
  $updates = [];

  foreach ($params as $field => $value) {
    $updates[] = "$field = ?";
  }

  $sql .= implode(', ', $updates);
  $sql .= " WHERE id = ?";

  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt) {
    // Формируем типы данных для привязки параметров
    $types = str_repeat('s', count($params)) . 'i';

    // Создаем массив значений
    $paramValues = array_values($params);
    $paramValues[] = $userId; // Добавляем значение для ID пользователя

    // Привязываем параметры
    mysqli_stmt_bind_param($stmt, $types, ...$paramValues);

    // Выполняем запрос
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success ? true : false;
  } else {
    return false;
  }
}

// Пример использования функции для обновления полей у пользователя с id
$params = [
  'admin' => 11
];
$userId = 2;
$tableName = 'users';
//updateUserFields($conn, $tableName, $userId, $params);


// функция удаления запись по айдишнику
function deleteUserById($conn, $table, $id)
{
  $sql = "DELETE FROM $table WHERE id = ?";

  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt) {
    mysqli_stmt_bind_param($stmt, 'i', $id);
    $success = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return $success ? true : false;
  } else {
    return false;
  }
}

// Пример использования функции для удаления записи из таблицы 'users' по ID
$tableName = 'users';
$userIdToDelete = 24; // Замените этот ID на нужный вам




// Выборка картин (posts) с автором в админку
function selectAllFromPostsWithUsers($conn)
{
  $sql = "SELECT images.*, author.name AS author_name
          FROM images
          LEFT JOIN author ON images.author_id = author.id";
  $result = mysqli_query($conn, $sql);

  if (!$result) {
    echo "Ошибка запроса: " . mysqli_error($conn);
    return [];
  }

  $posts = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $posts[] = $row;
  }

  return $posts;
}

function countRow($conn, $table)
{
  $sql = "SELECT COUNT(*) AS count FROM $table";
  $result = mysqli_query($conn, $sql);
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    return $row['count'];
  } else {
    echo "Ошибка запроса: " . mysqli_error($conn);
    return 0;
  }
}




?>
