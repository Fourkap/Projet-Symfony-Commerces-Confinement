<?php

namespace App\Controller;

use App\Entity\Codepostal;
use App\Entity\Commerce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function listeCommercesAll(Request $request)
    {
        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listeCommercesAll= $repo->findAll();

        return $this->render('commerces/listeCommercesAll_2.html.twig', [
            'controller_name' => 'CommercesController',
            'titre' => 'lite de tous les sites achéologiques de france',
            'listCommercesAll' => $listeCommercesAll,
        ]);
    }


    /**
     * @Route("/commerces/find", name="toto", methods={"GET"})
     */
    public function findCommerceTri()
    {
        $tableau2 = ['code_postal'=> '75003'];
        $monArray = ['code_postal' => ["75003", "75002"], 'type_de_commerce' => 'Boulangerie - pâtisserie'];
        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listeCommercesAll2= $repo->findBy($monArray);
        dd($listeCommercesAll2);
        $listeCommercesAll3 = $listeCommercesAll2;

        return $this->render('commerces/listeCommercesAll.html.twig', [
            'controller_name' => 'CommercesController',
            'titre' => 'lite de tous les sites achéologiques de france',
            'listCommercesAll' => $listeCommercesAll3
        ]);
    }

    /**
     * @Route("/commerces/{id}",requirements={"id"="\d+"}, name="listOneCommerces" )
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
     * @Route("commerces/maps" , name="maps")
     */
    public function maps()
    {

        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listAllCommerce= $repo->findAll();
        //$listAllFrance= $repo->findBy(array(),array('id'=>'DESC'),10, 0);
        $tableaux = array();

        foreach ($listAllCommerce as $commerce)
        {
            $tableau = array();
            $tableau = $commerce->getGeoPoint2d();
            $regex = "/[.0-9]+(,)+/";
            $regexapres = "/(,)[.0-9]++/";

            $lat = preg_replace($regex, "", $tableau);
            $long = preg_replace($regexapres, "",  $tableau);
            $tableaux[] =  [$commerce, $lat, $long] ;
        }
        //dd($tableaux);
        return $this->render('commerces/maps_2.html.twig',  [
            'controller_name' => 'CommercesController',
            'titre' => 'Liste de tous les commerces ouverts durant ',
            'listAllCommerces' => $listAllCommerce,
            'tableau' => $tableaux

        ]);
    }

    /**
     * @Route("/codepostal/{id}", name="efdefeff" )
     */
    public function codepostal($id)
    {

        $Commerces = $this->getDoctrine()->getRepository(Codepostal::class)->find($id);

        dd($Commerces);
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
