<?php

namespace App\Repository;

use App\Entity\Livre;
use App\Entity\Auteur;
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

    // //Commence par la lettre passée en paramètre
    // /** @return Livre[] */
    // public function findAllCommencePar($lettre): array
    // {
    //     $qb = $this->createQueryBuilder('l')
    //         ->andWhere('l.titre LIKE :letter')
    //         ->setParameter('letter',$lettre.'%');
    //     $query = $qb->getQuery();
    //     return $query->execute();
    // }

    public function getNbLivres()
    {
        $entityManager = $this->getEntityManager();

        $qry = $entityManager->createQuery(
            "select count(l) as nb
            from App\Entity\Livre l"
        );

        return $qry->getResult()[0]["nb"];
    }


    //Les auteurs ayant écrit plus d'un certain nombre de livres 
    //Pas sûre qu'il fonctionne correctement
    // /**
    //  * @param int $nbLivre
    //  * @return Livre[]
    //  */
    // public function findAuteurPlusieursLivre($nbLivre): array
    // {
    //     $qb = $this->createQueryBuilder('l')
    //         ->groupBy('l.auteur')
    //         ->having('COUNT(l.id) > :nbLivre')
    //         ->setParameter('nbLivre', $nbLivre);

    //     $query = $qb->getQuery();
    //     return $query->execute();
    // }


    public function FindAuteurByNbLivre($nbLivre): array
    {
        $entityManager = $this->getEntityManager();
        $query = $entityManager->createQuery(
                'SELECT a, count(l) AS NbLivres
                FROM App\Entity\Auteur a 
                JOIN a.auteur l 
                GROUP BY a.id
                HAVING NbLivres > :nbLivre'
            )->setParameter('nbLivre', $nbLivre);
        return $query->getResult();
    }

    // //Compte le nombre de livre présent en base
    // /** @return Livre[] */
    // public function findAllCountLivre(): array
    // {
    //     $qb = $this->createQueryBuilder('l')
    //         ->select('COUNT(l.id)');
    //     $query = $qb->getQuery();
    //     return $query->execute();
    // }

    public function getStartBy(string $lettre): array
    {
        $entityManager = $this->getEntityManager();

        $qry = $entityManager->createQuery(
            "select l
            from App\Entity\Livre l
            where l.titre like :lettre
            order by l.titre"
        )->setParameter("lettre", $lettre."%");

        return $qry->getResult();
    } 


}
