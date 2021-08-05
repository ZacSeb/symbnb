<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController{

    /**
     * @route("/bonjour/{prenom}/age/{age}", name="hello")
     * @route("/salut", name="hello_base")
     * @route("/bonjour/{prenom}", name="hello_prenom")
     * 
     * Montre la page qui dit bonjour
     * 
     * @return void
     */
    
    public function hello($prenom = "anonyme", $age = 0){
        return $this->render(
            'hello.html.twig',
            [
                'prenom' => $prenom,
                'age' => $age
            ]
        );
    }

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
