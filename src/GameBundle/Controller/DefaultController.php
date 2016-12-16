<?php

namespace GameBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $challenges = $em->getRepository('GameBundle:Challenge')->findBy(array('type' => 'public'));

        $user= $this->get('security.token_storage')->getToken()->getUser();

        return $this->render('GameBundle:Default:index.html.twig', array(
            'challenges' => $challenges,
            'user' => $user,
        ));
    }
}
