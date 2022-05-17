<?php
namespace App\UseCase\UseCaseOutput;
require_once __DIR__ . '/../../../vendor/autoload.php';

/**
 * お問い合わせ履歴の全件表示のコントローラ
 */
final class PageOutput
{
    /**
     * @var Page[]
     */
    private $pages;

    /**
     * コンストラクタ
     */
    public function __construct(array $pages)
    {
        $this->pages = $pages;
    }

    /**
     * 全件取得したデータをreturnで返す
     *
     * @return Page[]
     */
    public function handler(): array
    {
        return $this->pages;
    }
}
