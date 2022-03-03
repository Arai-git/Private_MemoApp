<?php
$db_username = 'root';
$db_password = 'password';
$pdo = new PDO(
    'mysql:host=mysql; dbname=memo; charset=utf8',
    $db_username,
    $db_password
);
$sql = 'SELECT * FROM pages';
$stmt = $pdo->prepare($sql);
$stmt->execute();
$results = $stmt->fetchall();

if (!empty($_POST['search_content'])) {
    $statement = $pdo->prepare(
        "SELECT * FROM pages WHERE content LIKE '%" .
            $_POST['search_content'] .
            "%' "
    );
    $statement->execute();
    $results = $statement->fetchAll();
}

if ($_GET['order'] === 'desc') {
    $statement = $pdo->prepare('SELECT * FROM pages ORDER BY created_at DESC');
    $statement->execute();
    $results = $statement->fetchAll();
}

if ($_GET['order'] === 'asc') {
    $statement = $pdo->prepare('SELECT * FROM pages ORDER BY created_at ASC');
    $statement->execute();
    $results = $statement->fetchAll();
}
?>
 
<!DOCTYPE html>
 <html>
   <head>
    <meta charset="UTF-8">
    <title>メモ一覧</title>
  </head>
  <body>
    <form action="index.php" method="post">
      <input type="text" name="search_content" value="<?php echo $search; ?>">
      <input type="submit" name="search" value="検索">
    </form>
    <h1>メモ一覧</h1>
    <a href="create.php">メモを追加</a>
    <br>
    <form name="desc" method="get">
      <a href="index.php?order=desc">新しい順</a>
    </form>
    <form name="asc" method="get">
      <a href="index.php?order=asc">古い順</a>
    </form>
    <table border="1">
      <tr>
        <td>タイトル</td>
        <td>内容</td>
        <td>作成日時</td>
        <td>編集</td>
        <td>削除</td>
      </tr>
      <?php foreach ($results as $result): ?>
      <tr>
        <td><?php echo $result['title']; ?></td>
        <td><?php echo $result['content']; ?></td>
        <td><?php echo $result['created_at']; ?></td>
        <td><a href="edit.php?id=<?php echo $result['id']; ?>">編集</a></td>
        <td><a href="delete.php?id=<?php echo $result['id']; ?>">削除</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>