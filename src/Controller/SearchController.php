<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 14/03/2019
 * Time: 12:15
 */

namespace App\Controller;


use App\Entity\Instru;
use App\Entity\User;
use App\Form\ContactFormType;
use App\Form\SearchFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * Matches /recherche
     * @Route("/recherche", name="app_recherche")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function recherche(Request $request)
    {
        $em = $this->getDoctrine()->getManager();



        $form = $this->createForm(SearchFormType::class);
        $form->handleRequest($request);

        $instrument = $em->getRepository(Instru::class);

        //$user = $em->getRepository(User::class);

        if ($form->isSubmitted()) {

            $instrument = $form->get('instruments')->getData();
            $instru = $instrument->getId();
//            $style = $form->get('styles')->getData();
//            $groupe = $form->get('groupe')->getData();

            //return $user;
//            $url = $this->generateUrl('app_resultat', ['id'=>$instrument]);
//            return $this->redirectToRoute($url);
            return $this->redirectToRoute('app_resultat', [
                'instrument' => $instru,
            ]);

        }




        return $this->render('pages/recherche.html.twig', [
            'searchForm' => $form->createView(),

        ]);
    }

    /**
     * @Route("/resultat/{instrument}", name="app_resultat")
     * @param $instrument
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resultat($instrument)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository(User::class)->findBy(['instrument'=>$instrument]);


        return $this->render('pages/resultat.html.twig', [
            'users' => $user,
        ]);
    }

    /**
     * @Route("/contact/{id}", name="app_contact")
     * @param Request $request
     * @param $id
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function contacter(Request $request, $id, \Swift_Mailer $mailer)
    {
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ContactFormType::class);
        $form->handleRequest($request);


        $user = $em->getRepository(User::class)->findOneById($id);
        $mailUser = $user->getMail();

        if ($form->isSubmitted()) {

            $formData = $form->getData();

            $message = (new \Swift_Message('MAVES', 'objet'))
                              ->setFrom($formData['votreMail'])
                           ->setTo($mailUser)
                           ->setBody($formData['message'],'text/plain');

            $mailer->send($message);

            $this->addFlash('success', 'Message envoyé à ' .$user->getUsername());

            return $this->redirectToRoute('app_profil');
        }


        return $this->render('pages/contact.html.twig', [
            'contactForm' => $form->createView(),
            'user' => $user,
        ]);
    }



}