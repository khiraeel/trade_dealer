<?php

namespace App\Service;

use App\Dto\CreditCalculationDto;
use App\Exception\CreditProgramNotFoundException;
use App\Repository\CreditProgramRepository;
use Doctrine\ORM\EntityManagerInterface;

class CreditService
{
    private CreditProgramRepository $creditProgramRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(
        CreditProgramRepository $creditProgramRepository,
        EntityManagerInterface $entityManager
    ) {
        $this->creditProgramRepository = $creditProgramRepository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param CreditCalculationDto $dto
     * @return array
     */
    public function calculate(CreditCalculationDto $dto): array
    {
        $programs = $this->creditProgramRepository->findAll();
        if (empty($programs)) {
            throw new CreditProgramNotFoundException("No credit programs available");
        }

        $initialPayment = $dto->initialPayment;
        $loanTerm = $dto->loanTerm;
        $loanBody = $dto->price - $dto->initialPayment;

        $result = [];
        $selectedProgram = null;
        $selectedMonthlyPayment = null;

        foreach ($programs as $program) {
            $interestRate = $program->getInterestRate();
            $interestRateValue = $interestRate->getValue();

            $monthlyPayment = $this->calculateMonthlyPayment(
                $loanBody,
                $loanTerm,
                $interestRateValue
            );

            if (
                $interestRateValue === 12.3 &&
                $initialPayment > 200000 &&
                $monthlyPayment <= 10000 &&
                $loanTerm < 60
            ) {
                $selectedProgram = $program;
                $selectedMonthlyPayment = $monthlyPayment;
                break;
            }

            if (
                $interestRateValue === 15.0 &&
                $initialPayment <= 200000 &&
                $loanTerm >= 60
            ) {
                $selectedProgram = $program;
                $selectedMonthlyPayment = $monthlyPayment;
                break;
            }

            if (
                $interestRateValue === 18.0
            ) {
                $selectedProgram = $program;
                $selectedMonthlyPayment = $monthlyPayment;
                break;
            }
        }

        return [
            'programId' => (int) $selectedProgram->getId(),
            'interestRate' => $selectedProgram->getInterestRate()->getValue(),
            'monthlyPayment' => (int) $selectedMonthlyPayment,
            'title' => $selectedProgram->getTitle(),
        ];
    }

    private function calculateMonthlyPayment(float $loanBody, int $loanTerm, float $interestRate): float
    {
        $monthlyRate = $interestRate / 12 / 100;

        return (int) round (
            ($loanBody * $monthlyRate) / (1 - pow(1 + $monthlyRate, - $loanTerm))
        );
    }
}