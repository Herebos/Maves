<?php

namespace App\Controller;

use App\Form\EditFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EditController extends AbstractController
{
    /**
     * @Route ("/edit", name="app_edit")
     * @param Request $request
     * @return Response
     * @throws \Exception
     * @var \App\Entity\User $user
     */
    public function edit(Request $request): Response
    {
//User is fully auth
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

// returns your User object, or null if the user is not authenticated
        $user = $this->getUser();
        $form = $this->createForm(EditFormType::class, $user);
        $form->handleRequest($request);


//$form->isSubmitted()
        if ($form->isSubmitted() && $form->isValid()) {
//for test
//dump($user);

            $user = $form->getData();

//get Manager via Doctrine
            $em = $this->getDoctrine()->getManager();
//keep info
            $em->persist($user);
//save in DB
            $em->flush();


// do anything else you need here, like send an email
//Message
            $this->addFlash('success', 'Modification réussie !');

            return $this->redirectToRoute('app_profil');

        }


        return $this->render('pages/edit.html.twig', [
            'editForm' => $form->createView(),
        ]);
    }
}