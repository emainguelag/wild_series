<?php

namespace App\Repository;

use App\Entity\Program;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Program>
 *
 * @method Program|null find($id, $lockMode = null, $lockVersion = null)
 * @method Program|null findOneBy(array $criteria, array $orderBy = null)
 * @method Program[]    findAll()
 * @method Program[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Program::class);
    }

    public function save(Program $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Program $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findProgramsByCategory($categoryName): array
    {
        $query = $this->createQueryBuilder('p')
            ->addSelect('c') //to make Doctrine actually use the join
            ->leftJoin('p.category', 'c')
            ->where('c.name = :categoryName')
            ->setParameter('categoryName', $categoryName)
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery();

            return $query->getResult()
        ;
    }

    public function findDurationByProgram(Program $program): array
    {
        $query = $this->createQueryBuilder('p')
            ->addSelect('s', 'e') //to make Doctrine actually use the join
            ->leftJoin('p.seasons', 's')
            ->andWhere('s.program = :program')
            ->leftJoin('s.episodes', 'e')
            ->andWhere('e.season = s.episodes')
            ->setParameter('program', $program)
            ->select('SUM(e.duration) as episodesDuration')
            ->getQuery();

            return $query->getResult()
        ;
    }

//     public function getMyEntityWithRelatedEntity($parameter) 
// {
//     $query = $this->createQueryBuilder('e')
//         ->addSelect('r') //to make Doctrine actually use the join
//         ->leftJoin('e.relatedEntity', 'r')
//         ->where('r.foo = :parameter')
//         ->setParameter('parameter', $parameter)
//         ->getQuery();

//     return $query->getResult();
// }

//    /**
//     * @return Program[] Returns an array of Program objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Program
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
