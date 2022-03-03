<?php
$id = $_GET['id'];
$db_username = 'root';
$db_password = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $db_username,
    $db_password
);
$sql = 'DELETE from pages WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header('Location: index.php');
exit();
?>
