<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; 
use App\Entity\Visite;

/**
 * Description of AccueilController
 *
 * @author ordi2304690
 */
class AccueilController  extends AbstractController{
    #[Route('/', name: 'accueil')]
    public function index(VisiteRepository $visiteRepository): Response
    {
        $visites = $visiteRepository->findLastVoyages(2);

        return $this->render('pages/accueil.html.twig', [
             'visites' => $visites, 
        ]);
    }
    
    #[Route('/voyage/{id}', name: 'voyage.showone')]
    public function show(Visite $voyage): Response
    {
        return $this->render('pages/voyage.html.twig', [
            'visite' => $voyage,
        ]);
    }

}
