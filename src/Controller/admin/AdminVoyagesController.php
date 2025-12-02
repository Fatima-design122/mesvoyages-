<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Visite;

 

/**
 * Description of AdminVoyagesController
 *
 * @author ordi2304690
 */
class AdminVoyagesController  extends AbstractController{
    //put your code here
    private VisiteRepository $repository;

    public function __construct(VisiteRepository $repository)
    {
        $this->repository = $repository;
    }
    
    #[Route('/admin', name: 'admin.voyages')]
    public function index(): Response
    {
        $visites = $this->repository->findAllOrdreBy('datecreation', 'DESC');
        return $this->render("admin/admin.voyages.html.twig", [
            'visites' => $visites
        ]);
    }
    #[Route('/admin/suppr/{id}', name: 'admin.voyages.suppr')]
    public function suppr(int $id): Response{
        $visite = $this->repository->find($id);
        if ($visite) {
            $this->repository->remove($visite);
        } else {
            // Optionnel : afficher un message ou rediriger avec erreur
            $this->addFlash('error', 'Visite introuvable.');
        }

        return $this->redirectToRoute('admin.voyages');
    }

}
