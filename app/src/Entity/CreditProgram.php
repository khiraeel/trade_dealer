<?php

declare(strict_types = 1);

namespace App\Entity;

use App\Entity\ValueObject\InterestRate;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CreditProgramRepository")
 * @ORM\Table(name="credit_programs")
 */
class CreditProgram
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $title;

    /**
     * @ORM\Column(type="float")
     */
    private float $interestRate;


    public function __construct(
        string $title,
        float $interestRate
    )
    {
        $this->title = $title;
        $this->interestRate = (new InterestRate($interestRate))->getValue();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function getInterestRate(): InterestRate
    {
        return new InterestRate($this->interestRate);
    }
}