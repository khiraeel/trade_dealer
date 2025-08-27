<?php

namespace App\Repository;

use App\Entity\LoanApplication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LoanApplication>
 *
 * @method LoanApplication|null find($id, $lockMode = null, $lockVersion = null)
 * @method LoanApplication|null findOneBy(array $criteria, array $orderBy = null)
 * @method LoanApplication[]    findAll()
 * @method LoanApplication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoanApplicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LoanApplication::class);
    }
}
