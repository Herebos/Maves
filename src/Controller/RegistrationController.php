<?php

namespace App\Controller;

use App\Entity\Instru;
use App\Entity\Style;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\InstruRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     * @throws \Exception
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        //New user and Form
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user, array('csrf_protection' => false));
        $form->handleRequest($request);

        //$form->isSubmitted()
        if ($form->isSubmitted() && $form->isValid()) {
            //for test
            //dump($user);
            if (true === $form['agreeTerms']->getData()) {
                $user->agreeToTerms();
                $user = $form->getData();
                // encode password
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('password')->getData()
                    )
                );
                $em = $this->getDoctrine()->getManager();

                $instrument = $form->get('instruments')->getData();
                $style = $form->get('styles')->getData();

                $user->setInstrument($instrument);
                $user->setStyle($style);
                $user->setRoles(['ROLE_USER']);
                //keep info
                $em->persist($user);
                //save in DB
                $em->flush();

                // do anything else you need here, like send an email
                //Message
                $this->addFlash('success', 'Inscription réussie ! Connectez-vous ' .$user->getUsername());

                return $this->redirectToRoute('app_login');
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

}
