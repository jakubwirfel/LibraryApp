<?php
//new connection with DB
try {
    $database = new PDO ("mysql:host={$db_access['host']};dbname={$db_access['database']}", $db_access['username'], $db_access['password']);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    array_push($errors, $e->getMessage());
}