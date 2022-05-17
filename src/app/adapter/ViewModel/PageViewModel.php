<?php
namespace App\Adapter\ViewModel;
use App\UseCase\UseCaseOutput\PageOutput;

/**
 * ユーザー情報を表示させる
 */
final class PageViewModel
{
    /**
     * @var PageOutput
     */
    private $pageOutput;

    /**
     * コンストラクタ
     */
    public function __construct(pageOutput $pageOutput)
    {
        $this->pageOutput = $pageOutput;
    }

    /**
     * 取得したデータを履歴ページに出力する
     *
     * @return array
     */
    public function convertToWebView(): array
    {
        $pageEntityList = $this->pageOutput->handler();
        $pageForWeb = [];
        foreach ($pageEntityList as $key => $pageEntity) {
            $pageForWeb[$key]['id'] = $pageEntity->id()->value();
            $pageForWeb[$key]['title'] = $pageEntity->title()->value();
            $pageForWeb[$key]['content'] = $pageEntity->content();
            $pageForWeb[$key]['created_at'] = $pageEntity->created_at();
        }
        return $pageForWeb;
    }
}
