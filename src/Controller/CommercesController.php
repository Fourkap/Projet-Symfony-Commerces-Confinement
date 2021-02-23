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

        return $this->render('commerces/listeCommercesAll.html.twig', [
            'controller_name' => 'CommercesController',
            'titre' => 'lite de tous les sites achéologiques de france',
            'listCommercesAll' => $listeCommercesAll,
        ]);
    }

    /**
     * @Route("/commerces/find", name="listvalue" )
     */
    public function listeCommercesbyvalue()
    {
        $tableau2 = ['code_postal'=> '75003'];
        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listeCommercesAll2= $repo->findBy(array('code_postal' => "75003", 'type_de_commerce' => 'Boulangerie - pâtisserie'), array('id'=>'DESC'));
        $listeCommercesAll3 = $listeCommercesAll2;

        return $this->render('commerces/listeCommercesAll.html.twig', [
            'controller_name' => 'CommercesController',
            'titre' => 'lite de tous les sites achéologiques de france',
            'listCommercesAll' => $listeCommercesAll3
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
     * @Route("/commerces/dina" )
     */
    public function Convert()
    {

        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listAllCommerce= $repo->findAll();
        //$listAllFrance= $repo->findBy(array(),array('id'=>'DESC'),10, 0);

        $tableaux = array();

        foreach ($listAllCommerce as $commerce)
        {
            $tableau = array();
            $tableau = $commerce->getGeoPoint2d();
            $regex = "[.0-9]+(,)+";
            $regexaprès = "(,)[.0-9]++";

            $tableaux[] =  [$commerce, $tableau['lat'],$tableau['long']];
        }
        var_dump($tableaux);
        dd($tableaux);
//        return $this->render('france/maps.html.twig',  [
//            'controller_name' => 'FranceController',
//            'titre' => 'Liste de tous les sites de fouilles achéologiques de france',
//            'listAllFrance' => $listAllFrance,
//            'tableau' => $tableaux
//
//        ]);
    }


    /**
     * @Route("/test/test" )
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
        return $this->render('commerces/maps.html.twig',  [
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
