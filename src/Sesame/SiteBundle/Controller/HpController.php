<?php

namespace Sesame\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HpController extends Controller
{
    public function indexAction(/*$name*/)
    {
        $pages = $this->getDoctrine()
            ->getRepository('SesameSiteBundle:Page')
            ->findAll();
            
        $return = array(
            'pages' => $pages
        );
        return $this->render('SesameSiteBundle:Hp:index.html.twig', $return);
    }

}
