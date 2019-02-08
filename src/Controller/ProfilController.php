<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProfilController
 * @package App\Controller
 * To check if the user is logged in (double tap since security.yml has already this)
 * @IsGranted("ROLE_USER")
 */
class ProfilController extends BaseController
{
    /**
     * @Route("/profil", name="app_profil")
     * @param LoggerInterface $logger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(LoggerInterface $logger)
    {
        $logger->debug('Checking account page for '.$this->getUser()->getMail());


        return $this->render('pages/profil.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    /**
     * @Route("/api/profil", name="api_profil")
     */
    public function profilApi()
    {   //We can call the getUser() safely because of our @IsGranted(**role**)
        $user = $this->getUser();

        return $this->json($user, 200, [], [
            'groups' => ['main'],
        ]);
    }
}
