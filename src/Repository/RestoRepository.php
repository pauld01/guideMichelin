<?php

namespace App\Repository;

use App\Entity\Resto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resto[]    findAll()
 * @method Resto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RestoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resto::class);
    }

    public function findRestoEtoilesInf($etoile) {
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->where('s.etoiles <= :etoile')
            ->setParameter('etoile', $etoile);
        return $queryBuilder->getQuery()->getResult();
    }

    public function findRestoEtoilesSup($etoile) {
        $queryBuilder = $this->createQueryBuilder('s');
        $queryBuilder->where('s.etoiles > :etoile')
            ->setParameter('etoile', $etoile);
        return $queryBuilder->getQuery()->getResult();
    }

    public function plusUneEtoile() {
        $query = $this->getEntityManager()
            ->createQuery("UPDATE App\Entity\Resto s SET s.etoiles = s.etoiles + '1' WHERE s.etoiles <= 3");
        return $query->execute();
    }

    // /**
    //  * @return Resto[] Returns an array of Resto objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Resto
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
