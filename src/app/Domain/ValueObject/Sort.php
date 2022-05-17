<?php
namespace App\Domain\ValueObject;
use \Exception;

final class Sort
{
    const INVALID_MESSAGE = '並べ替えできません。';

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
}
