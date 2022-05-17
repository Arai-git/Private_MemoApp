<?php
namespace App\Adapter\Presenter;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Adapter\ViewModel\PageViewModel;
use App\UseCase\UseCaseOutput\PageOutput;

/**
 * メモ履歴の全件表示のコントローラ
 */
final class PagePresenter
{
    /**
     * @var PageOutput
     */
    private $pageOutput;

    /**
     * コンストラクタ
     */
    public function __construct(PageOutput $pageOutput)
    {
        $this->pageOutput = $pageOutput;
    }

    /**
     * メモ履歴の全件表示処理
     *
     * @return array
     */
    public function createPageView(): array
    {
        $pageViewModel = new PageViewModel($this->pageOutput);
        return $pageViewModel->convertToWebView();
    }
}
