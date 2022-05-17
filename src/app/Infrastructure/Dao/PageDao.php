<?php
namespace App\Infrastructure\Dao;
use \PDO;

/**
 * ページテーブルとやりとりする抽象クラス
 */
class PageDao extends Dao
{
    /**
     * メモを全件取得
     *
     * @return ?array
     */
    public function fetchAllPagesData(): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM pages');
        $statement->execute();
        $pages = $statement->fetchAll();

        return $pages ? $pages : null;
    }

    /**
     * あいまい検索でデータを取得
     *
     * @var string $searchWord
     * @var string $sort
     * @return ?array
     */
    public function fetchPagesDataSortBySearchWord(
        ?string $searchWord,
        ?string $sort
    ): ?array {
        $wordForAmbiguousSearch = '%' . $searchWord . '%';
        $sql = "SELECT * FROM pages WHERE title LIKE :title OR content LIKE :content ORDER BY id $sort";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(
            ':title',
            $wordForAmbiguousSearch,
            PDO::PARAM_STR
        );
        $statement->bindValue(
            ':content',
            $wordForAmbiguousSearch,
            PDO::PARAM_STR
        );
        $statement->execute();
        $pages = $statement->fetchAll();
        return $pages ? $pages : null;
    }
}
