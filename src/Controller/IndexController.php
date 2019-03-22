<?php
/**
 * Created by PhpStorm.
 * User: Dimitri
 * Date: 18/01/2019
 * Time: 14:42
 */

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IndexController extends AbstractController
{
    /**
     * Matches /index
     * @Route("/index", name="app_index")
     */
    public function homepage()
    {
        return $this->render('pages/index.html.twig');
    }


}