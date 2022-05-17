<?php
namespace App\Domain\ValueObject;
use \Exception;

final class SearchWord
{
    const INVALID_MESSAGE = '検索ワードが不適切です。';

    private $value;

    /**
     * @var ?string $value
     */
    public function __construct(?string $value)
    {
        if (!$this->isInvalid($value)) {
            throw new Exception(self::INVALID_MESSAGE);
        }
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function value(): ?string
    {
        return $this->value;
    }

    /**
     * @var string $value
     * @return bool
     */
    private function isInvalid(?string $value): bool
    {
        return is_string($value) || $value == null;
    }

    /**
     * 検索ワードがあれば、true
     * なければ、falseを返す
     *
     * @return bool
     */
    public function hasSearchWord(): bool
    {
        if ($this->value != null) {
            return true;
        }
        return false;
    }
}
