<?php

declare(strict_types = 1);

namespace App\Entity;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LoanApplicationRepository")
 * @ORM\Table(name="loan_applications")
 */
class LoanApplication
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity=Car::class)
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id", nullable=false)
     */
    private Car $car;

    /**
     * @ORM\ManyToOne(targetEntity=CreditProgram::class)
     * @ORM\JoinColumn(name="program_id", referencedColumnName="id", nullable=false)
     */
    private CreditProgram $creditProgram;

    /**
     * @ORM\Column(type="integer")
     */
    private int $loanTerm;

    public function __construct (
        Car $car,
        CreditProgram $creditProgram,
        int $loanTerm
    ) {
        $this->car = $car;
        $this->creditProgram = $creditProgram;
        $this->loanTerm = $loanTerm;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCar(): Car
    {
        return $this->car;
    }

    public function getCreditProgram(): CreditProgram
    {
        return $this->creditProgram;
    }

    public function getLoanTerm(): int
    {
        return $this->loanTerm;
    }
}