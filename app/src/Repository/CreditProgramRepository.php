<?php

namespace App\Repository;

use App\Entity\CreditProgram;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CreditProgram>
 *
 * @method CreditProgram|null find($id, $lockMode = null, $lockVersion = null)
 * @method CreditProgram|null findOneBy(array $criteria, array $orderBy = null)
 * @method CreditProgram[]    findAll()
 * @method CreditProgram[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CreditProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CreditProgram::class);
    }
}
