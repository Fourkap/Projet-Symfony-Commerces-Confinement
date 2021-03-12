<?php

namespace App\Controller;

use App\Entity\Codepostal;
use App\Entity\Commerce;
use Container1o2nEjQ\PaginatorInterface_82dac15;
use Knp\Component\Pager\PaginatorInterface;
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
     * @Route("/commerces/all", name="listeCommerces" )
     * @param Request $request
     * @param PaginatorInterface $paginator
     * @return Response
     */
    public function listeCommercesAll(Request $request,PaginatorInterface $paginator )
    {
        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $liste= $repo->findAll();

        $listeCommercesAll = $paginator->paginate(
            $liste,
            $request->query->getInt('page', 1), //numero de la page en cours defaut 1
            15
        );

        return $this->render('commerces/listeCommercesAll_2.html.twig', [
            'controller_name' => 'CommercesController',
            'titre' => '',
            'listeCommercesAll' => $listeCommercesAll,
        ]);
    }


    /**
     * @Route("/commerces/find", name="tri", methods={"GET"})
     */
    public function findCommerceTri(Request $request)
    {



        $codepostal = explode (  "," , $request->get("codepostal"));
        $type = explode (  "," , $request->get("type"));

        $monArray = ['code_postal' => $codepostal, 'type_de_commerce' => $type];



            $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listeCommercesAll= $repo->findBy($monArray);


        foreach ($listeCommercesAll as $commerce)
        {
            $tableau = array();
            $tableau = $commerce->getGeoPoint2d();
            $regex = "/[.0-9]+(,)+/";
            $regexapres = "/(,)[.0-9]++/";

            $lat = preg_replace($regex, "", $tableau);
            $long = preg_replace($regexapres, "",  $tableau);
            $tableaux[] =  [$commerce, $lat, $long] ;
        }
        return $this->render('commerces/maps_2.html.twig', [
            'controller_name' => 'CommercesController',
            'tableau' => $tableaux
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
     * @Route("/commerces/api/all", name="listAllCommercesJson" )
     */
    public function listeCommercesJson()
    {

        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listCommercesAll= $repo->findAll();

        return $this->json($listCommercesAll);
    }
}
