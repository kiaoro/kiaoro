<?php 

namespace Naissance\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('NaissanceApplicationBundle:Default:index.html.twig', array('name' => $name));
    }
}