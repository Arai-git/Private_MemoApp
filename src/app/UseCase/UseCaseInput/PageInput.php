<?php
namespace App\UseCase\UseCaseInput;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\SearchWord;
use App\Domain\ValueObject\Sort;

/**
 * 入力された検索ワードを返す
 */
final class PageInput
{
    /**
     * @var SearchWord
     */
    private $searchWord;

    /**
     * @var Sort
     */
    private $sort;

    /**
     * コンストラクタ
     *
     * @param SearchWord $searchWord
     * @param Sort $sort
     */
    public function __construct(SearchWord $searchWord, Sort $sort)
    {
        $this->searchWord = $searchWord;
        $this->sort = $sort;
    }

    /**
     * $return SearchWord
     */
    public function handler(): SearchWord
    {
        return $this->searchWord;
    }

    /**
     * @return Sort
     */
    public function sort(): Sort
    {
        return $this->sort;
    }
}
