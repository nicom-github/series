<?php

namespace App\Controller;

use App\Entity\Serie;
use App\Form\SerieType;
use App\Repository\SerieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        $series = $serieRepository->findBestSeries();

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
    public function Create(Request $request, EntityManagerInterface $entityManager): Response
    {
        //creer une nouvelle series en bdd

        //Creation d'un objet serie
        $serie = new Serie();
        $serie->setDateCreated(new \datetime());

        //Afficher le formulaire
        $serieForm = $this->createForm(SerieType::class,$serie);

        //Chargement des données provenant du formulaire
        $serieForm->handleRequest($request);

        //Test de validation 'Le formulaire est transmis' ET 'Le formulaire est valide'
        if($serieForm->isSubmitted() && $serieForm->isValid()){
            $entityManager->persist($serie);
            $entityManager->flush();

            $this->addFlash('Succes','Nouvelle série enregistrée!');
            return $this->redirectToRoute('series_details',['id'=>$serie->getId()]);
        }


        return $this->render('serie/create.html.twig.',[
           'serieForm' => $serieForm->createView()
        ]);

    }

}
