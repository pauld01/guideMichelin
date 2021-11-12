<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GuideController extends AbstractController{
    public function accueil($nom) {
        return $this->render('guideMichelin/accueil.html.twig', array('nom' => $nom));
    }

    public function menu() {
        return $this->render('guideMichelin/menu.html.twig');
    }
}