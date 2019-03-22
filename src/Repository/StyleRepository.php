<?php

namespace App\Repository;

use App\Entity\Style;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\NonUniqueResultException;

/**
 * @method Style|null find($id, $lockMode = null, $lockVersion = null)
 * @method Style|null findOneBy(array $criteria, array $orderBy = null)
 * @method Style[]    findAll()
 * @method Style[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StyleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Style::class);
    }

    public function findOneById($id)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.id = :id')
                ->setParameter('id', $id)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    public function findOneByName($styleName)
    {
        try {
            return $this->createQueryBuilder('u')
                ->andWhere('u.styleName = :name')
                ->setParameter('styleName', $styleName)
                ->getQuery()
                ->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
        }
    }

    // /**
    //  * @return Style[] Returns an array of Style objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Style
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
