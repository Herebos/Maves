<?php

namespace App\Controller;


use App\Entity\Instru;
use App\Entity\Style;
use App\Entity\User;
use App\Form\EditFormType;
use App\Form\AddInstruFormType;
use App\Form\AddStyleFormType;
use Psr\Log\LoggerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class AdminController
 * @package App\Controller
 * @IsGranted("ROLE_ADMIN")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/dashboard", name="app_admin_dashboard")
     * @param LoggerInterface $logger
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dashboard(LoggerInterface $logger)
    {
        $logger->debug('Checking account page for '.$this->getUser()->getMail());
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();
        $nbrUser = $em->getRepository(User::class)->findAll();
        $nbrInstru = $em->getRepository(Instru::class)->findAll();
        $nbrStyle = $em->getRepository(Style::class)->findAll();

        $totalUser = count($nbrUser);
        $totalInstru = count($nbrInstru);
        $totalStyle = count($nbrStyle);


        return $this->render('pages/dashboard.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
            'totalUser' => $totalUser,
            'totalInstru' => $totalInstru,
            'totalStyle' => $totalStyle,
        ]);

    }

    /**
     * @Route("/dashboard/user", name="app_admin_dashboard_user")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getAllUser()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository(User::class)->findAll();


        return $this->render('pages/allUser.html.twig', [
            'users' => $users,

        ]);

    }

    /**
     * @Route("/dashboard/user/edit/{id}", name="app_admin_dashboard_user_edit")
     * @return \Symfony\Component\HttpFoundation\Response
     * @param Request $request
     * @param $id
     */
    public function editOneUser(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneById($id);
        $form = $this->createForm(EditFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $instrument = $form->get('instrument')->getData();
            $style = $form->get('style')->getData();

            $user->setInstrument($instrument);
            $user->setStyle($style);
            //get Manager via Doctrine
            $em = $this->getDoctrine()->getManager();
            //keep info
            $em->persist($user);
            //save in DB
            $em->flush();

            //Message
            $this->addFlash('success', 'Modification réussie !');
            return $this->redirectToRoute('app_admin_dashboard_user');
        }

        return $this->render('pages/adminEditUser.html.twig', [
            'editForm' => $form->createView(),
            'user' => $user
        ]);
    }
    /**
     * @Route("/dashboard/instrument/add", name="app_admin_dashboard_instrument_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addInstrument(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $instru = $em->getRepository(Instru::class)->findAll();

        $instrument = new Instru();
        $form = $this->createForm(AddInstruFormType::class, $instrument);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $instrument = $form->getData();
            $instru = $form->get('instrument')->getData();
            $instrument->setInstruName($instru);
            //get Manager via Doctrine
            $em = $this->getDoctrine()->getManager();
            //keep info
            $em->persist($instrument);
            //save in DB
            $em->flush();


            // do anything else you need here, like send an email
            //Message
            $this->addFlash('success', 'Instrument ajouté !');

            return $this->redirectToRoute('app_admin_dashboard_instrument_add');

        }



        return $this->render('pages/adminAddInstru.html.twig', [
            'instru' => $instru,
            'addInstruForm' => $form->createView(),
        ]);

    }

    /**
     * @Route("/dashboard/style/add", name="app_admin_dashboard_style_add")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addStyle(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $styles = $em->getRepository(Style::class)->findAll();

        $style = new Style();
        $form = $this->createForm(AddStyleFormType::class, $style);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $style = $form->getData();
            $styles = $form->get('style')->getData();
            $style->setStyleName($styles);
            //get Manager via Doctrine
            $em = $this->getDoctrine()->getManager();
            //keep info
            $em->persist($style);
            //save in DB
            $em->flush();


            // do anything else you need here, like send an email
            //Message
            $this->addFlash('success', 'Style ajouté !');

            return $this->redirectToRoute('app_admin_dashboard_style_add');

        }



        return $this->render('pages/adminAddStyle.html.twig', [
            'styles' => $styles,
            'addStyleForm' => $form->createView(),
        ]);
    }

}