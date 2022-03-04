<?php
$db_username = 'root';
$db_password = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $db_username,
    $db_password
);

$title = $_GET['title'];
$content = $_GET['content'];

$sql = 'INSERT INTO pages(title, content) VALUES(:title, :content)';
$statement = $pdo->prepare($sql);
$params = [':title' => $title, ':content' => $content];
$statement->execute($params);

header('Location: index.php');
exit();
?>
