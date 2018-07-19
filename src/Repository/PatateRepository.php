<?php

namespace App\Repository;

use App\Entity\Patate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Patate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patate[]    findAll()
 * @method Patate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Patate::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('p')
            ->where('p.something = :value')->setParameter('value', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
