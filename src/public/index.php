<?php
require_once __DIR__ . '/../vendor/autoload.php';
use App\UseCase\UseCaseInput\PageInput;
use App\UseCase\UseCaseInteractor\PageInteractor;
use App\Adapter\Presenter\PagePresenter;
use App\Domain\ValueObject\SearchWord;
use App\Domain\ValueObject\Sort;

$inputSearchWord = filter_input(INPUT_GET, 'searchWord');
$inputSort = filter_input(INPUT_GET, 'order');
$searchWord = new SearchWord($inputSearchWord);
$sort = new Sort($inputSort);
$pageInput = new PageInput($searchWord, $sort);
$pageInteractor = new PageInteractor($pageInput);
$pagePresenter = new PagePresenter($pageInteractor->handler());
$pages = $pagePresenter->createPageView();
?>

<!DOCTYPE html>
 <html>
   <head>
    <meta charset="UTF-8">
    <title>メモ一覧</title>
  </head>
  <body>
    <form action="index.php" method="get">
      <input type="text" name="searchWord" value="<?php echo $search; ?>">
      <input type="submit" value="検索">
    </form>
    <h1>メモ一覧</h1>
    <a href="create.php">メモを追加</a>
    <br>
    <form action="index.php?order=desc" name="order" value="desc" method="get">
      <a href="index.php?order=desc">新しい順</a>
    </form>
    <form action="index.php?order=asc" name="order" value="asc" method="get">
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