<?php

namespace App\Repository;

use App\Data\SearchData;
use App\Entity\Commerce;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Commerce|null find($id, $lockMode = null, $lockVersion = null)
 * @method Commerce|null findOneBy(array $criteria, array $orderBy = null)
 * @method Commerce[]    findAll()
 * @method Commerce[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommerceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commerce::class);
    }

    // /**
    //  * @return Commerce[] Returns an array of Commerce objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    public function retourneCommerce(SearchData $search): array
    {
        $query = $this->CreateQueryBuilder('p')->select('c', 'p')->join('p.Codepostal', 'c');

        if(!empty($search->codePostal)){
            $query = $query->andWhere('c.id IN (:codePostal)' )->setParameter('codePostal', $search->codePostal);
        }

        return $query->getQuery()->getResult();
    }

}
