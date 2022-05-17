<?php
namespace App\Domain\Entity;
require_once __DIR__ . '/../../../vendor/autoload.php';
use App\Domain\ValueObject\PageId;
use App\Domain\ValueObject\PageTitle;

/**
 * ユーザーのEntity
 */
final class Page
{
    private $id;
    private $title;
    private $content;
    private $created_at;

    public function __construct(
        ?PageId $id,
        PageTitle $title,
        string $content,
        string $created_at
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->created_at = $created_at;
    }

    /**
     * @return ?PageId
     */
    public function id(): ?PageId
    {
        return $this->id;
    }

    /**
     * @return PageTitle
     */
    public function title(): PageTitle
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function content(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function created_at(): string
    {
        return $this->created_at;
    }
}
