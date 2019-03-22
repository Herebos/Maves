<?php

namespace App\Controller;

use App\Entity\Instru;
use App\Entity\Style;
use App\Entity\User;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Exception;

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
     * @Route ("/confirm/{id}", name="app_delete")
     * @param $id
     * @return Response
     */
    public function deleteUser($id)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->find($id);

        return $this->render('security/delete.html.twig', [
            'controller_name' => 'SecurityController',
            'user' => $user,
        ]);

    }

    /**
     * @Route("/delete/{id}",defaults={"id" = 0} ,name="app_delete_confirm")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @param $id
     */
    public function deleteUserConfirm($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usrRepo = $em->getRepository(User::class);

        $user = $usrRepo->find($id);
        $currentUserId = $this->getUser()->getId();

        if ($currentUserId == $id) {
            $session = $this->get('session');
            $session = new Session();
            $session->invalidate();
        }
        $em->remove($user);
        $em->flush();

        $this->addFlash('success', 'Vous vous êtes désinscrit');
        return $this->redirectToRoute('app_login');
    }


    /**
     * @Route("/delete/admin/{id}",defaults={"id" = 0} ,name="app_admin_delete_confirm")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @param $id
     */
    public function adminDeleteUserConfirm($id)
    {
        $em = $this->getDoctrine()->getManager();

        $usrRepo = $em->getRepository(User::class);

        $user = $usrRepo->find($id);
        $currentUserId = $this->getUser()->getId();

        //No need to invalidate session, no corruption since
        //user removed is not connected
        if ($currentUserId == $id)
        {
            $em->remove($user);
        }
        $em->flush();

        $this->addFlash('success', 'User désinscrit');
        return $this->redirectToRoute('app_admin_dashboard_user');
    }


    /**
     * @Route("/delete/style/{id}",defaults={"id" = 0} ,name="app_admin_delete_style")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @param $id
     */
    public function adminDeleteStyle($id)
    {
        $em = $this->getDoctrine()->getManager();

        $styleRepo = $em->getRepository(Style::class);
        $style = $styleRepo->find($id);


//        $style = $styleRepo->find($id);
//        $currentStyleId = $this->getStyle()->getId();

        //No need to invalidate session, no corruption since
        //user removed is not connected
        //if ($style == $styleRepo)
        {
            $em->remove($style);
        }
        $em->flush();

        $this->addFlash('success', 'Style supprimer');
        return $this->redirectToRoute('app_admin_dashboard_style_add');
    }

    /**
     * @Route("/delete/instru/{id}",defaults={"id" = 0} ,name="app_admin_delete_instru")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @param $id
     */
    public function adminDeleteInstru($id)
    {
        $em = $this->getDoctrine()->getManager();

        $instruRepo = $em->getRepository(Instru::class);
        $instru = $instruRepo->find($id);


//        $style = $styleRepo->find($id);
//        $currentStyleId = $this->getStyle()->getId();

        //No need to invalidate session, no corruption since
        //user removed is not connected
        //if ($style == $styleRepo)
        {
            $em->remove($instru);
        }
        $em->flush();

        $this->addFlash('success', 'Instrument supprimer');
        return $this->redirectToRoute('app_admin_dashboard_instrument_add');
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        //see security.yaml for redirect and path
    }
}
