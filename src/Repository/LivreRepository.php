<?php

namespace App\Repository;

use App\Entity\Livre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Livre>
 *
 * @method Livre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Livre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Livre[]    findAll()
 * @method Livre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LivreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Livre::class);
    }

//    /**
//     * @return Livre[] Returns an array of Livre objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Livre
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }

    //Commence par la lettre passée en paramètre
    /** @return Livre[] */
    public function findAllCommencePar($lettre): array
    {
        $qb = $this->createQueryBuilder('l')
            ->andWhere('l.titre LIKE :letter')
            ->setParameter('letter',$lettre.'%');
        $query = $qb->getQuery();
        return $query->execute();
    }

    //Les auteurs ayant écrit plus d'un certain nombre de livres 
    //Pas sûre qu'il fonctionne correctement
    /**
     * @param int $nbLivre
     * @return Livre[]
     */
    public function findAuteurPlusieursLivre($nbLivre): array
    {
        $qb = $this->createQueryBuilder('l')
            ->groupBy('l.auteur')
            ->having('COUNT(l.id) > :nbLivre')
            ->setParameter('nbLivre', $nbLivre);

        $query = $qb->getQuery();
        return $query->execute();
    }

    //Compte le nombre de livre présent en base
    /** @return Livre[] */
    public function findAllCountLivre(): array
    {
        $qb = $this->createQueryBuilder('l')
            ->select('COUNT(l.id)');
        $query = $qb->getQuery();
        return $query->execute();
    }

}
