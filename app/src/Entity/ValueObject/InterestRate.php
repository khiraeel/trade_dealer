<?php

namespace App\Entity\ValueObject;

use App\Exception\InvalidArgumentException;

class InterestRate implements \JsonSerializable
{
    private float $value;

    public function __construct(float $value)
    {
        if($value < 0 || $value > 100)
        {
            throw new InvalidArgumentException("Interest rate must be between 0 and 100");
        }

        $this->value = round($value, 1);
    }

    public function getValue(): float
    {
        return $this->value;
    }

    public function jsonSerialize(): float
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }
}