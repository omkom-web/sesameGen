<?php

namespace Omkom\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HpController extends Controller
{
    public function indexAction(/*$name*/)
    {
        $site = $this->getDoctrine()
            ->getRepository('OmkomSiteBundle:Site')
            ->find(1);
            
        if (!$site) {
            throw $this->createNotFoundException('Oups ! Aucun site n\'est encore présent en base...');
        }
            
        
        $pages = $this->getDoctrine()
            ->getRepository('OmkomSiteBundle:Page')
            ->findAll();
            
        $recopages = $this->getDoctrine()
            ->getRepository('OmkomSiteBundle:Page')
            ->findByViewcount(3);
            
        $return = array(
            'site' => $site,
            'pages' => $pages,
            'recopages' => $recopages
        );
        
        if($site->getGallery())
        {
            $return['gallery'] = $site->getGallery();
            
        }
        
        return $this->render('OmkomSiteBundle:Hp:index.html.twig', $return);
    }
}
