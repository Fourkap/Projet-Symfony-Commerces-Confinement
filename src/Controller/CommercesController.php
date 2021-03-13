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
            'listeCommercesAll' => $listeCommercesAll,
        ]);
    }


    /**
     * @Route("/commerces/find", name="tri", methods={"GET"})
     */
    public function findCommerceTri(Request $request, PaginatorInterface $paginator)
    {
        $codepostal = explode (  "," , $request->get("codepostal"));
        $type = explode (  "," , $request->get("type"));
        $service = explode(",", $request->get("service"));

        $codepostalsql = $request->get("codepostal");
        $typesql = $request->get("type");
        $servicesql = $request->get("service");

        $monArray = []; //findby

        if ($codepostal != "") $monArray["code_postal" ] = $codepostal;
        if ($type != "") $monArray["type_de_commerce"] = $type;
        if ($service != "") $monArray["services"] = $service;

        dd($monArray);

//        $codepostalsql = ($codepostal == "") ? "*": $codepostalsql;
//        $typesql = ($type == "") ? "*": $typesql;
//        $servicesql = ($service == "") ? "*": $servicesql;



//
   $var = [$codepostalsql, $typesql, $servicesql];
//
//        $var1 = [$codepostal, $type, $service];
//
//        dd($var1);

//
//
//        if ($codepostalsql != "") array_push($monArray, "code_postal" => $codepostal);
//        if ($typesql != "") array_push($monArray, "type_de_commerce" => $type);
//        if ($servicesql != "") array_push($monArray,"services" => $service);
//
//        dd($monArray);


        switch ($var){
            case ($var[0] == "" && $var[1] == "" && $var[2] == ""):
                $this->redirectToRoute('maps');
                break;
            case($var[1] == "" && $var[2] == ""):   $monArray = ["code_postal" => $codepostal];
            break;
            case ($var[0] == "" && $var[2] == ""): $monArray = ['type_de_commerce' => $type];
            break;
            case ($var[0] == "" && $var[1] == ""): $monArray = ['services' => $service];
            break;
            case ($var[0] == ""): $monArray = ['type_de_commerce' => $type, 'services' => $service];
            break;
            case ($var[1] == ""): $monArray = ['code_postal' => $codepostal ,'services' => $service];
            break;
            case ($var[2] == ""): $monArray =  ['code_postal' => $codepostal, 'type_de_commerce' => $type];
            break;
            default: $monArray = ['code_postal' => $codepostal, 'type_de_commerce' => $type, 'services' => $service];
            break;
        }
        dd($monArray);


        $repo=$this->getDoctrine()->getRepository(Commerce::class);
        $listeCommercesAll= $repo->findBy($monArray);


        if (array_filter($listeCommercesAll) == [])
        {
            $this->redirectToRoute('maps');
        }

        $listeCommercesAll = $paginator->paginate(
            $listeCommercesAll,
            $request->query->getInt('page', 1), //numero de la page en cours defaut 1
            15
        );
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
            'listeCommercesAll' => $listeCommercesAll,
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
            'Commerce' => $Commerces
        ]);
    }




    /**
     * @Route("commerces/maps" , name="maps")
     */
    public function maps(Request $request,PaginatorInterface $paginator)
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
        $listeCommercesAll = $paginator->paginate(
            $listAllCommerce,
            $request->query->getInt('page', 1), //numero de la page en cours defaut 1
            15
        );
        //dd($tableaux);
        return $this->render('commerces/maps_2.html.twig',  [
            'controller_name' => 'CommercesController',
            'titre' => 'Liste de tous les commerces ouverts durant ',
            'listeCommercesAll' => $listeCommercesAll,
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
