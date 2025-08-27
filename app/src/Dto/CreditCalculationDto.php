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
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    public $price;

    /**
     * @Assert\NotBlank
     * @Assert\Type("numeric")
     * @Assert\PositiveOrZero
     */
    public $initialPayment;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    public $loanTerm;

    public function __construct(
        $price,
        $initialPayment,
        $loanTerm
    ) {
        $this->price = (int) $price;
        $this->initialPayment = (float) $initialPayment;
        $this->loanTerm = (int) $loanTerm;
    }
}