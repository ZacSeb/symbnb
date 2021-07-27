<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="homepage")
     */

    public function home(){
        $prenoms = ["Jacques" => 1, "Sébastien" => 40, "Paul" => 12];
        return $this->render(
            'home.html.twig',
            [ 
                'title' => "Salut à tous",
                'age' => 1,
                'tableau' => $prenoms
            ]
        );
    }
}
