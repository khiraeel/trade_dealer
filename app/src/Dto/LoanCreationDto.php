<?php

namespace App\Dto;

use App\Entity\ValueObject\InterestRate;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @readonly
 */
class LoanCreationDto
{
    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    public $carId;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
     * @Assert\Positive
     */
    public $programId;

    /**
     * @Assert\NotBlank
     * @Assert\Type("integer")
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
        $carId,
        $programId,
        $initialPayment,
        $loanTerm
    ) {
        $this->carId = $carId;
        $this->programId = $programId;
        $this->initialPayment = $initialPayment;
        $this->loanTerm = $loanTerm;
    }
}