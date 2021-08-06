<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo): Response
    {
        // $repo = $this->getDoctrine()->getRepository(Ad::class); soit de cette manière soit en mettant dans les parenthèses "index" ci-dessus (Adrepository $repo)


        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }

    /**
     * Permet de créer une annonce
     * 
     * @Route("/ads/new", name="ads_new")
     * 
     * @return Response
     */

    public function create(Request $request, EntityManagerInterface $manager): Response {

        $ad = new Ad();

        $form = $this->createForm(AdType::class, $ad);

        $form->handleRequest($request);
        
        // dump($ad); sert à connaitre les infos sur l'annonce ($ad) envoyées grace au handleRequest
        if($form->isSubmitted() && $form->isValid()) {

            // $manager = $this->getDoctrine()->getManager(); ----- Pas besoin de cette ligne de code si on injecte les dépendences dans la fonction "create" avec EntityManagerInterface et $manager
            $manager->persist($ad);
            $manager->flush();

            $this->addFlash(
                'success', "L'annonce <strong>{$ad->getTitle()}</strong> a bien été enregistrée !"
            );

            return $this->redirectToRoute('ads_show', [
                'slug' => $ad->getSlug(),
            ]);
        }

        return $this->render('ad/new.html.twig', [

            'form' => $form->createView(),
        ]);
    }

    /**
     * Permet d'afficher une seule annonce
     * 
     * @Route("/ads/{slug}", name="ads_show")
     * 
     * @return Response
     */


    public function show(Ad $ad): Response
    {
        return $this->render('ad/show.html.twig', [
            'ad' => $ad,
        ]);
    }
}
