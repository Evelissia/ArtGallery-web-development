<?php

// и здесь переписать с использованием mysqli_connect
/*require('db_connect.php'); 

function tt($value) {
  echo '<pre>';
  print_r($value);
  echo '</pre>';
}

function selectAll($table) {
  global $pdo;

  $sql = "SELECT * FROM $table";
  $query = $pdo->prepare($sql);
  $query->execute();
  $errInfo = $query->errorInfo();
  if($errInfo[0] !== PDO::ERR_NONE){
    echo $errInfo[2];
    exit();
  }

  return $query->fetchAll();

}

tt(selectAll('users'))*/


require('db_connect.php');

// Проверка выполнения запроса к БД
function dbCheckError($conn) {
  if (mysqli_error($conn)) {
    echo "Ошибка запроса: " . mysqli_error($conn);
    exit();
  }
  return true;
}

// Запрос на получение данных одной таблицы
function selectAll($table, $conn, $params = []) {
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

// Запись в таблицу БД
function insert($conn, $table, $data = []) {
  if (!empty($data)) {
    $keys = implode(', ', array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";
  
    $sql = "INSERT INTO $table ($keys) VALUES ($values)";
  
    return mysqli_query($conn, $sql) ? mysqli_insert_id($conn) : null;
  } else {
    return null;
  }
}

// Пример использования функции insert для добавления новой записи
$data = [
  'admin' => '1',
  'username' => '444',
  'email' => 'kuku456@test.com',
  'password' => '4444'
];

$result = insert($conn, 'users', $data);

if ($result !== null) {
  echo "Новая запись добавлена. ID: " . $result;
} else {
  echo "Ошибка при добавлении записи.";
}

// обновление строки в таблице
function updateUserFields($conn, $table, $userId, $params) {
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
  'admin' => 45
];
$userId = 1;
$tableName = 'users';

if (updateUserFields($conn, $tableName, $userId, $params)) {
  echo "Поля успешно обновлены.";
} else {
  echo "Пользователь не найден или возникла ошибка.";
}


// функция удаления запись по айдишнику
function deleteUserById($conn, $table, $id) {
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
$userIdToDelete = 1; // Замените этот ID на нужный вам

if (deleteUserById($conn, $tableName, $userIdToDelete)) {
  echo "Запись успешно удалена.";
} else {
  echo "Ошибка при удалении записи.";
}
?>