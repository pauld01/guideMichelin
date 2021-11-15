<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Resto;

class GuideController extends AbstractController{
    public function accueil($nom) {
        return $this->render('guideMichelin/accueil.html.twig', array('nom' => $nom));
    }

    public function menu($nom) {
        return $this->render('guideMichelin/menu.html.twig', array('nom' => $nom));
    }

    public function ajouter($nom,$chef,$etoiles){
        $entityManager = $this->getDoctrine()->getManager();
        $resto = new Resto;
        $resto->setNom($nom);
        $resto->setChef($chef);
        $resto->setEtoiles($etoiles);
        $entityManager->persist($resto);
        $entityManager->flush();
        return $this->render('guideMichelin/ajouter.html.twig', array('resto' => $resto));
    }

    public function voir($id) {
        $resto = $this->getDoctrine()->getRepository(Resto::class)->find($id);
        if(!$resto)
            throw $this->createNotFoundException('Resto[id='.$id.'] inexistante');
        return $this->render('guideMichelin/voir.html.twig', array('resto' => $resto));
    }
}