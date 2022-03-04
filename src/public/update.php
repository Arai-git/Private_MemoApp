<?php
$db_username = 'root';
$db_password = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $db_username,
    $db_password
);
$sql = 'SELECT * FROM pages WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

$title = $_POST['title'];
$content = $_POST['content'];
$id = $_GET['id'];

$db_username = 'root';
$db_password = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $db_username,
    $db_password
);
$sql = 'UPDATE pages SET title = :title, content = :content WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':content', $content, PDO::PARAM_STR);
$statement->execute();

header('Location: index.php');
exit();
?>
