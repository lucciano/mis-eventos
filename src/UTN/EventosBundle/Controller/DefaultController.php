<?php

namespace UTN\EventosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $eventos = $this->getDoctrine()
            ->getRepository('UTNEventosBundle:Evento')
            ->findAll();
        return array('eventos' => $eventos);
    }

    /**
     * @Route("/logout", name="logout")
     * @Template()
     */
    public function logoutAction()
    {
        $eventos = $this->getDoctrine()
            ->getRepository('UTNEventosBundle:Evento')
            ->findAll();
        return array('eventos' => $eventos);
    }



}
