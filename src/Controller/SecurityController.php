<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

///**
// * @method getId()
// */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();






        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route ("/delete/{id}", name="app_delete")
     * @param $id
     * @return Response
     */
    public function deleteUser($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
//        $user = $this->getUser();
//        $id = $this->getUser()->getId();
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);


            //TODO Confirm action
//            $this->logout();
//            $entityManager->remove($user);
//            $entityManager->flush();
            //TODO error handling

//            $this->addFlash('success', 'Vous vous êtes desinscrit');
//            return $this->redirectToRoute('app_login');

        return $this->render('security/delete.html.twig', [
            'controller_name' => 'SecurityController',
            'user' => $user,
        ]);

    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        //see security.yaml for redirect and path
    }
}
