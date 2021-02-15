<?php

namespace App\Controller;

use App\Entity\Commerce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CommercesController extends AbstractController
{
    /**
     * @Route("/commerces", name="commerces")
     */
    public function index(): Response
    {
        return $this->render('commerces/index.html.twig', [
            'controller_name' => 'CommercesController',
        ]);
    }

    /**
     * @Route("/commerces/all", name="listAllCommerces" )
     */
    public function listeCommercesAll()
    {

        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listeCommercesAll= $repo->findAll();

        return $this->render('commerces/listeCommercesAll.html.twig', [
            'controller_name' => 'CommercesController',
            'titre' => 'lite de tous les sites achéologiques de france',
            'listCommercesAll' => $listeCommercesAll
        ]);
    }

    /**
     * @Route("/commerces/{id}", name="listOneCommerces" )
     */
    public function listeCommercesOne($id)
    {

        $Commerces = $this->getDoctrine()->getRepository(Commerce::class)->find($id);


        return $this->render('commerces/listeCommercesOne.html.twig', [
            'controller_name' => 'CommercesController',
            'titre' => 'lite de tous les sites achéologiques de france',
            'Commerce' => $Commerces
        ]);
    }

    /**
     * @Route("/commerces/api/all", name="listAllCommercesJson" )
     */
    public function listeCommercesJson()
    {

        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listCommercesAll= $repo->findAll();

        return $this->json($listCommercesAll);
    }
}
