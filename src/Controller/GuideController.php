<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Entity\Resto;
use App\Form\Type\RestoType;

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
            throw $this->createNotFoundException('Resto[id='.$id.'] inexistant');
        return $this->render('guideMichelin/voir.html.twig', array('resto' => $resto));
    }

    public function ajouterRequest(Request $request) {
        $resto = new Resto;
        $form = $this->createForm(RestoType::class, $resto, ['action' => $this->generateUrl('guide_michelin_ajouter_request')]);
        $form->add('submit', SubmitType::class, array('label' => 'Ajouter'));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resto);
            $entityManager->flush();
            return $this->redirectToRoute('guide_michelin_voir', array('id' => $resto->getId()));
        }
        return $this->render('guideMichelin/resto/ajouter.html.twig', array('formAjouterResto' => $form->createView()));
    }

    public function list() {
        $restos = $this->getDoctrine()->getRepository(Resto::class)->findAll();
        return $this->render('guideMichelin/menu.html.twig', array('restos' => $restos,'nom' =>"..."));
    }

    public function modifier($id) {
        $resto = $this->getDoctrine()->getRepository(Resto::class)->find($id);
        if(!$resto)
            throw $this->createNotFoundException('Resto[id='.$id.'] inexistant');
        $form = $this->createForm(RestoType::class, $resto, ['action' => $this->generateUrl('guide_michelin_modifier_soumission', array('id' => $resto->getId()))]);
        $form->add('submit', SubmitType::class, array('label' => 'Modifier'));
        return $this->render('guideMichelin/modifier.html.twig',array('formAjouterResto' => $form->createView()));
    }

    public function modifierSoumission(Request $request, $id) {
        $resto = $this->getDoctrine()->getRepository(Resto::class)->find($id);
        if(!$resto)
            throw $this->createNotFoundException('Reso[id='.$id.'] inexistant');
        $form = $this->createForm(RestoType::class, $resto, ['action' => $this->generateUrl('guide_michelin_modifier_soumission', array('id' => $resto->getId()))]);
        $form->add('submit', SubmitType::class, array('label' => 'Modifier'));
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($resto);
            $entityManager->flush();
            $url = $this->generateUrl('guide_michelin_voir', array('id' => $resto->getId()));
            return $this->redirect($url);
        }
        return $this->render('guideMichelin/modifier.html.twig', array('formAjouterResto' => $form->createView()));
    }

    public function supprimer($id) {
        $em = $this->getDoctrine()->getManager();
        $repo = $this->getDoctrine()->getRepository(Resto::class);
        $resto = $repo->find($id);
        if($resto) {
            $em->remove($resto);
            $em->flush();
            return $this->render('guideMichelin/supprimer.html.twig', array('resto' => $resto));
        }
        else
            throw $this->createNotFoundException('Resto[id='.$id.'] inexistant');
    }
}