<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;

class GuideController {
    public function accueil() {
        return $this->render('guideMichelin/accueil.html.twig');
    }
}
