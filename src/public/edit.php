<?php
$id = $_GET['id'];
$db_username = 'root';
$db_password = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $db_username,
    $db_password
);
$sql = 'select * from pages WHERE id = :id';
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);
$result = $stmt->fetch();

$title = $result['title'];
$content = $result['content'];
?>

<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8">
      <title>メモ編集ページ</title>
  </head>
  <body>
  <!-- //メモの新規作成フォーム -->
  <h1>メモ編集</h1>
  <form action="update.php?id=<?php echo $result['id']; ?>" method="post">
    <p>title</p>
    <input value="<?php echo $title; ?>" type="text" name="title" size="20"></input>
    <br>
    <br>
    <p>本文</p>
    <textarea name="content" style="width:300px; height:100px;"><?php echo $content; ?></textarea><br>
    <br>
    <input type="submit"  value="送信">
  </form>
  </body>
</html>