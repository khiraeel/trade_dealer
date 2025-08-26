<?php

namespace App\Dto;

use App\Entity\ValueObject\InterestRate;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @readonly
 */
class CreditCalculationDto
{
    /**
     * @Assert\Positive
     */
    public int $price;

    /**
     * @Assert\PositiveOrZero
     */
    public float $initialPayment;

    /**
     * @Assert\Positive
     */
    public int $loanTerm;

    public function __construct(
        int $price,
        float $initialPayment,
        int $loanTerm
    ) {
        $this->price = $price;
        $this->initialPayment = $initialPayment;
        $this->loanTerm = $loanTerm;
    }
}