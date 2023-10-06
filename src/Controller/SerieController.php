<?php

namespace App\Controller;

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
    public function List(): Response
    {
        //Aller chercher les series en bdd

        return $this->render('serie/list.html.twig', [

        ]);
    }



    /**
     * @Route("/details{id}", name="details")
     */
    public function Details(int $id): Response
    {
        //Aller chercher la series en bdd
        return $this->render('serie/details.html.twig');

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
