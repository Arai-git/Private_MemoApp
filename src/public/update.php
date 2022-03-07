<?php
$dbUserName = 'root';
$dbPassWord = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassWord
);

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") $_SESSION["errors"][] = "POST送信になっていません！";

$id = filter_input(INPUT_GET, "id");
$title = filter_input(INPUT_POST, "title");
$content = filter_input(INPUT_POST, "content");
    if (empty($title) || empty($content)) $_SESSION["errors"][] = "タイトルまたは本文が記入されていません！";



$sql = 'UPDATE pages SET title = :title, content = :content WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->bindValue(':id', $id);
$statement->bindValue(':title', $title, PDO::PARAM_STR);
$statement->bindValue(':content', $content, PDO::PARAM_STR);
$statement->execute();

if (!empty($_SESSION["errors"])) {
	header('Location: index.php');
	exit;
}
?>