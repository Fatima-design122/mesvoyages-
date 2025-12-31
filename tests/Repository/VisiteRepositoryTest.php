<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Test\Repository;

use App\Entity\Visite;
use App\Repository\VisiteRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of VisiteRepositoryTest
 *
 * @author ordi2304690
 */

class VisiteRepositoryTest  extends KernelTestCase{
    public function newVisite():Visite{
        $visite = (new Visite())
                ->setVille("New York")
                ->setPays("USA")
                ->setTempmin(5)
                ->setTempmax(16)
                ->setNote(5)
                ->setDateDepart(new \DateTime('2025-01-01'))
                ->setDatecreation(new \DateTime("now"));
        return $visite;   
    }
    public function recupRepository():VisiteRepository{
        self::bootKernel();
       $repository =self::getContainer()->get(VisiteRepository::class);
       return $repository;
    }
    
    public function testNbVisites(){
        $repository = $this->recupRepository();
        $nbVisites = $repository->count([]);
        $this->assertEquals(3, $nbVisites);
    }
    
    public function testAddVisite(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $nbVisites = $repository->count([]);
        $repository->add($visite, true);
        $this->assertEquals($nbVisites + 1, $repository->count([]), "erreur lors de l'ajout");
    }
    public function testRemoveVisite(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $repository->add($visite, true);
        $nbVisites = $repository->count([]);
        $repository->remove($visite, true);
        $this->assertEquals($nbVisites - 1, $repository->count([]), "erreur lors de la suppression");
    }
    public function testFindByEqualValue(){
        $repository = $this->recupRepository();
        $visite = $this->newVisite();
        $repository->add($visite, true);
        $visites = $repository->findByEqualValue("ville", "New York");
        $nbVisites = count($visites);
        $this->assertEquals(3, $nbVisites);
        $this->assertEquals("New York", $visites[0]->getVille());
    }
}
