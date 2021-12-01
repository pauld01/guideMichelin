<?php

namespace App\Controller;

use App\Entity\Chef;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Form\Type\ChefType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChefController extends AbstractController
{
    /**
     * @Route("/chef", name="chef")
     */
    public function index(): Response
    {
        return $this->render('chef/index.html.twig', [
            'controller_name' => 'ChefController',
        ]);
    }

    /**
     * @Route("/ajout_chef", name="ajout_chef")
     */
    public function ajouter(Request $request) {
        $chef = new Chef;
        $form = $this->createForm(ChefType::class, $chef);
        $form->add('submit', SubmitType::class,
            array('label' => 'Ajouter'));
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chef);
            $entityManager->flush();
            return $this->redirectToRoute('chef');
        }
        return $this->render('chef/ajouter.html.twig',
            array('formAjouterChef' => $form->createView()));}
}
