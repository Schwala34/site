<?php

// Подключение к базе данных
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Получение имени файла из параметров запроса
$file_name = $_POST["file_name"];

// Выполнение SQL-запроса
$sql = "SELECT * FROM files WHERE name = '$file_name'";
$result = $conn->query($sql);

// Преобразование результатов в JSON
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $json_data = json_decode($row["data"], true);
    print json_encode($json_data);
} else {
    print json_encode(array());
}

// Закрытие соединения с базой данных
$conn->close();

?>
