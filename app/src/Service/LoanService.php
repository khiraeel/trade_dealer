<?php

namespace App\Service;

use App\Dto\CreditCalculationDto;
use App\Dto\LoanCreationDto;
use App\Entity\Car;
use App\Entity\CreditProgram;
use App\Entity\LoanApplication;
use App\Exception\CarNotFoundException;
use App\Exception\CreditProgramNotFoundException;
use App\Exception\InvalidArgumentException;
use App\Repository\CarRepository;
use App\Repository\CreditProgramRepository;
use App\Repository\LoanApplicationRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\CreditService as CreditCalculator;
class LoanService
{
    private LoanApplicationRepository $loanApplicationRepository;
    private EntityManagerInterface $entityManager;
    private CarRepository  $carRepository;
    private CreditProgramRepository  $creditProgramRepository;
    private CreditCalculator $creditCalculator;

    public function __construct(
        EntityManagerInterface $entityManager,
        CarRepository $carRepository,
        CreditProgramRepository $creditProgramRepository,
        CreditCalculator $creditCalculator
    ) {
        $this->entityManager = $entityManager;
        $this->carRepository = $carRepository;
        $this->creditProgramRepository = $creditProgramRepository;
        $this->creditCalculator = $creditCalculator;
    }

    /**
     * @throws CreditProgramNotFoundException
     * @throws InvalidArgumentException
     * @throws CarNotFoundException
     */
    public function saveLoan(LoanCreationDto $dto): bool
    {
        $car = $this->carRepository->find($dto->carId);
        if(!$car instanceof Car) {
            throw new CarNotFoundException('Car by id: ' . $dto->carId . ' not found');
        }

        $program = $this->creditProgramRepository->find($dto->programId);
        if(!$program instanceof CreditProgram) {
            throw new CreditProgramNotFoundException('Credit program by id: ' . $dto->programId . ' not found');
        }

        if ($dto->initialPayment > $car->getPrice()) {
            throw new InvalidArgumentException("Initial payment cannot exceed car price");
        }

        $getProgramIdByCalculate = $this->getProgramIdFromCalculator($car->getPrice(), $dto->initialPayment, $dto->loanTerm);
        if($getProgramIdByCalculate !== $program->getId()) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Selected program (id=%d) does not match calculator result (id=%d)",
                    $program->getId(),
                    $getProgramIdByCalculate
                )
            );
        }

        $loanApplication = new LoanApplication(
            $car,
            $program,
            $dto->loanTerm
        );

        $this->entityManager->persist($loanApplication);

        $this->entityManager->flush();

        return true;
    }

    /**
     * @throws CreditProgramNotFoundException
     */
    public function getProgramIdFromCalculator(int $carPrice, int $initialPayment, int $loanTerm): int
    {
        $calcResult = $this->creditCalculator->calculate(
            new CreditCalculationDto($carPrice, $initialPayment, $loanTerm)
        );

        return $calcResult['programId'];
    }
}