<?php

namespace App\Repository;

use App\Entity\Visite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Visite>
 */
class VisiteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visite::class);
    }

    /**
     * Enregistrements dont un champ est égal à une valeur 
     * ou tous les enregistrements si la valeur est vide 
     * @param string $champ
     * @param string $ordre
     * @return Visite[]
     */
    public function findByEqualValue($champ, $valeur): array {
    if ($valeur == "") {
        return $this->createQueryBuilder('v')
            ->orderBy('v.' . $champ, 'ASC')
            ->getQuery()
            ->getResult();
    } else {
        return $this->createQueryBuilder('v') //alias de la table
            ->where('v.' . $champ . ' = :valeur')
            ->setParameter('valeur', $valeur)
            ->orderBy('v.datecreation', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
    public function findAllOrdreBy(string $champ, string $ordre = 'DESC'): array
    {
        return $this->createQueryBuilder('v')
                ->orderBy('v.' . $champ, $ordre)
                ->getQuery()
                ->getResult();
}
/** 
 * Supprime unee visite
 * @param Visite $visite
 * @return void
 */

    public function remove(Visite $visite):void
    {
        $this->getEntityManager()->remove($visite);
        $this->getEntityManager()->flush();
    }
    
    /**
     * Ajoute ou modifie une visite
     * @param Visite $visite
     * @return void
     */
    public function add(Visite $visite): void
    {
        $this->getEntityManager()->persist($visite);
        $this->getEntityManager()->flush();
    }
 
    public function findLastVoyages(int $limit = 2):array
    {
        return $this->createQueryBuilder('v')
                ->select('v')
                ->orderBy('v.datecreation', 'DESC')
                ->setMaxResults($limit)
                ->getQuery()
                ->getResult();
    }
}






