<?php

namespace App\Domain\ValueObjects;

class TaskStatus
{
    public const INCOMPLETE = 'incomplete';
    public const COMPLETE = 'complete';

    private string $value;

    public function __construct(string $value)
    {
        if (!in_array($value, [self::INCOMPLETE, self::COMPLETE], true)) {
            throw new \InvalidArgumentException('Invalid status value');
        }
        $this->value = $value;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isComplete(): bool
    {
        return $this->value === self::COMPLETE;
    }

    public function isIncomplete(): bool
    {
        return $this->value === self::INCOMPLETE;
    }
}
