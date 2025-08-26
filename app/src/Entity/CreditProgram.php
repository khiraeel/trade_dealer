<?php

declare(strict_types = 1);

namespace App\Entity;

use App\Entity\ValueObject\InterestRate;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
     * @ORM\Column(type="float", precision=10, scale=2)
     */
    private InterestRate $interestRate;


    public function __construct(
        int $id,
        string $title,
        InterestRate $interestRate
    )
    {
        $this->title = $title;
        $this->interestRate = $interestRate;
    }
}