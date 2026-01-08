<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\VisiteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VoyagesController extends AbstractController
{
    private VisiteRepository $repository;

    public function __construct(VisiteRepository $repository)
    {
        $this->repository = $repository;
    }

    #[Route('/voyages', name: 'voyages')]
    public function index(): Response
    {
        $visites = $this->repository->findAll();

        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]);
    }

    #[Route('/voyages/tri/{champ}/{ordre}', name: 'voyages.sort')]
    public function sort(string $champ, string $ordre): Response
    {
        $visites = $this->repository->findBy([], [$champ => $ordre]);

        return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
        ]);
    }

    #[Route('/voyages/recherche/{champ}', name: 'voyages.findallequal')]
    public function findAllEqual(string $champ, Request $request): Response
    {
        if($this->isCsrfTokenValid('filtre_'.$champ, $request->get('_token'))){
            $valeur = $request->get("recherche");
             $visites = $this->repository->findByEqualValue($champ, $valeur);

            return $this->render("pages/voyages.html.twig", [
            'visites' => $visites
            ]);
        }
        return $this->redirectToRoute("voyages");
    }
    #[Route('/voyages/voyage/{id}', name:'voyages.showone')]
    public function showOne($id): Response
    {
        $visite = $this->repository->find($id);
        if (!$visite) {
            throw $this->createNotFoundException('Visite non trouvée.');
            
        }


        return $this->render("pages/voyages_show.html.twig", [
            'visite' => $visite
        ]);
    }

    #[Route('/', name: 'home')]
        public function home(): Response
    {
    // récupère les 2 derniers voyages
    $visites = $this->repository->findBy([], ['datecreation' => 'DESC'], 2);

    return $this->render("pages/home.html.twig", [
        'visites' => $visites
    ]);
    }

}


