<?php
$dbUserName = 'root';
$dbPassWord = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassWord
);

$title = filter_input(INPUT_POST, 'title');
$content = filter_input(INPUT_POST, 'content');

session_start();
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $_SESSION['errors'][] = 'POST送信になっていません！';
}
if (empty($title) || empty($content)) {
    $_SESSION['errors'][] = 'タイトルまたは本文が記入されていません！';
}
if (!empty($_SESSION['errors'])) {
    header('Location: ./create.php');
    exit();
}

$sql = 'INSERT INTO pages(title, content) VALUES(:title, :content)';
$statement = $pdo->prepare($sql);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':content', $content, PDO::PARAM_STR);
$statement->execute();

header('Location: index.php');
exit();
?>
