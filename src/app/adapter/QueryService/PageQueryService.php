<?php
namespace App\Adapter\QueryService;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Infrastructure\Dao\PageDao;
use App\Domain\Entity\Page;
use App\Domain\ValueObject\PageId;
use App\Domain\ValueObject\PageTitle;
use App\UseCase\UseCaseInput\PageInput;

/**
 * メモ内容のデータを取得する
 */
final class PageQueryService
{
    /**
     * @var PageDao
     */
    private $pageDao;

    public function __construct()
    {
        $this->pageDao = new PageDao();
    }

    /**
     * ユーザーを全件取得する
     *
     * @return Page[]
     */
    public function createAllPagesData(): array
    {
        $pageMappers = $this->pageDao->fetchAllPagesData() ?? [];
        $pages = $this->createPagesData($pageMappers);
        return $pages;
    }

    /**
     * あいまい検索で入力されたワードの対象となったものを結果を返す
     *
     * @var PageInput
     * @return array
     */
    public function createPagesDataBySearchWord(PageInput $pageInput): array
    {
        $searchWord = $pageInput->handler()->value();
        $sort = $pageInput->sort()->value();
        $pageMappers =
            $this->pageDao->fetchPagesDataSortBySearchWord(
                $searchWord,
                $sort
            ) ?? [];
        $pages = $this->createPagesData($pageMappers);
        return $pages;
    }

    /**
     * バリデーションを通ったメモの内容を返す
     *
     * @var array $pageMappers
     * @return array
     */
    private function createPagesData(array $pageMappers): array
    {
        $pages = [];
        foreach ($pageMappers as $pageMapper) {
            $pages[] = new Page(
                new PageId($pageMapper['id']),
                new PageTitle($pageMapper['title']),
                $pageMapper['content'],
                $pageMapper['created_at']
            );
        }
        return $pages;
    }
}
