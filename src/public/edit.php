<?php
$id = filter_input(INPUT_GET, 'id');
$dbUserName = 'root';
$dbPassWord = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $dbUserName,
    $dbPassWord
);

$sql = 'SELECT * FROM pages WHERE id = :id';
$statement = $pdo->prepare($sql);
$statement->execute([':id' => $id]);
$page = $statement->fetch();
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
      <title>メモ編集ページ</title>
  </head>
  <body>
  <h1>メモ編集</h1>
  <form action="update.php?id=<?php echo $page['id']; ?>" method="post">
    <p>title</p>
    <input value="<?php echo $page[
        'title'
    ]; ?>" type="text" name="title" size="20"></input>
    <br>
    <br>
    <p>本文</p>
    <textarea name="content" style="width:300px; height:100px;"><?php echo $page[
        'content'
    ]; ?></textarea><br>
    <br>
    <input type="submit"  value="送信">
  </form>
  </body>
</html>