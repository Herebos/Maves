<?php

namespace App\Repository;

use App\Entity\Instru;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Instru|null find($id, $lockMode = null, $lockVersion = null)
 * @method Instru|null findOneBy(array $criteria, array $orderBy = null)
 * @method Instru[]    findAll()
 * @method Instru[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InstruRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Instru::class);
    }

    public function findOneById($idInstru)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.IdInstru = :id')
                ->setParameter('id', $idInstru)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function findOneByName($instruName)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.instruName = :name')
                ->setParameter('instruName', $instruName)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    // /**
    //  * @return Instrument[] Returns an array of Instrument objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Instrument
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
