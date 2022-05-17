<?php
namespace App\UseCase\UseCaseInteractor;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\QueryService\PageQueryService;
use App\UseCase\UseCaseInput\PageInput;
use App\UseCase\UseCaseOutput\PageOutput;

/**
 * メモアプリの全件表示のユースケース
 */
final class PageInteractor
{
    /**
     * @var PageQueryService
     * @var PageInput
     */
    private $pageQueryService;
    private $pageInput;

    /**
     * コンストラクタ
     */
    public function __construct(PageInput $pageInput)
    {
        $this->pageQueryService = new PageQueryService();
        $this->pageInput = $pageInput;
    }

    /**
     * メモの全件表示処理
     *
     * @return PageOutput
     */
    public function handler(): PageOutput
    {
        if (
            $this->hasSearchWord($this->pageInput) ||
            $this->hasSort($this->pageInput)
        ) {
            $pages = $this->pageQueryService->createPagesDataBySearchWord(
                $this->pageInput
            );
            $pageOutput = new PageOutput($pages);
            return $pageOutput;
        }
        $pages = $this->pageQueryService->createAllPagesData();
        $pageOutput = new PageOutput($pages);
        return $pageOutput;
    }

    /**
     * メモの検索ワードを返す
     */
    private function hasSearchWord($pageInput): bool
    {
        return $pageInput->handler()->hasSearchWord();
    }

    /**
     * ソートの結果を返す
     */
    private function hasSort($pageInput): ?object
    {
        return $pageInput->sort();
    }
}
