<?php

namespace App\Controller;

use App\Repository\SerieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/series", name="series_")
 */
class SerieController extends AbstractController
{
    /**
     * @Route("", name="list")
     */
    public function List(SerieRepository $serieRepository): Response
    {
        //va chercher toutes les series en bdd
        $series = $serieRepository->findBy([]);

        return $this->render('serie/list.html.twig', [
        "series"=>$series
        ]);
    }



    /**
     * @Route("/details{id}", name="details")
     */
    public function Details(int $id,SerieRepository $serieRepository): Response
    {
        //Va chercher les information de la series en bdd
        $serie = $serieRepository->find($id);

        return $this->render('serie/details.html.twig',[
            "serie"=>$serie
        ]);

    }

    /**
     * @Route("/create", name="create")
     */
    public function Create(): Response
    {
        //creer series en bdd
        return $this->render('serie/create.html.twig');

    }

}
