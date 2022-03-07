<?php
  session_start();
  $errors = $_SESSION['errors'] ?? [];
  unset($_SESSION['errors']);

  $dbUserName = 'root';
  $dbPassWord = 'password';
  $pdo = new PDO(
      'mysql:host=mysql; dbname=memo; charset=utf8',
      $dbUserName,
      $dbPassWord
  );

  if (isset($_GET['order'])) {
    $direction = $_GET['order'];
  } else {
    $direction = 'desc';
  }

  if (isset($_GET['search'])) {
      $title = '%' . $_GET['search'] . '%';
      $content = '%' . $_GET['search'] . '%';
  } else {
      $title = '%%';
      $content = '%%';
  }

  $sql = "SELECT * FROM pages WHERE title LIKE :title OR content LIKE :content ORDER BY id $direction";
  $statement = $pdo->prepare($sql);
  $statement->bindValue(':title', $title, PDO::PARAM_STR);
  $statement->bindValue(':content', $content, PDO::PARAM_STR);
  $statement->execute();
  $pages = $statement->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
 <html>
   <head>
    <meta charset="UTF-8">
    <title>メモ一覧</title>
  </head>
  <body>
    <form action="index.php" method="get">
      <input type="text" name="search" value="<?php echo $search; ?>">
      <input type="submit" value="検索">
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
      <?php foreach ($pages as $page): ?>
      <tr>
        <td><?php echo $page['title']; ?></td>
        <td><?php echo $page['content']; ?></td>
        <td><?php echo $page['created_at']; ?></td>
        <td><a href="edit.php?id=<?php echo $page['id']; ?>">編集</a></td>
        <td><a href="delete.php?id=<?php echo $page['id']; ?>">削除</a></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </body>
</html>