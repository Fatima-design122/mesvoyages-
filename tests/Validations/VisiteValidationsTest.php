<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Tests\Validations;

use App\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Description of VisiteValidationsTest
 *
 * @author ordi2304690
 */
class VisiteValidationsTest  extends KernelTestCase{
    public function getVisite():Visite{
        return (new Visite())
                ->setVille("New York")
                ->setPays("USA");
    }
    
     public function testValidNoteVisite(){
        $visite = $this->getVisite()->setNote(10);
        $this->assertErrors($visite, 0);
                
    }
    
    public function assertErrors(Visite $visite, int $nbErreursAttendues, string $message=""){
        self::bootKernel();
        $validator = self::getContainer()->get(ValidatorInterface::class);
        $error =$validator->validate($visite);
        $this->assertCount($nbErreursAttendues, $error, $message);
    }
     
    #[ORM\Column(nullable:true)]
    #[Assert\Range(min:0, max:20)]
    private ?int $note = null;
    
    public function tesNonValidTempmaxVisite(){
        $visite = $this->getVisite()
                ->setTempmin(20)
                ->setTempmax(18);
        $this->assertErrors($visite,1, "min=20, max=18 devrait échouer");
    }
    
    #[ORM\Column(nullable: true)]
    #[Assrt\GreaterThan(propertyPath:"tempmin")]
    private ?int $tempmax = null;
   
    
}
