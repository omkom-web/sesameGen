<?php

namespace Omkom\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WidgetController extends Controller
{
    public function headerAction(/*$name*/)
    {
        return $this->render('OmkomSiteBundle:Widget:header.html.twig', array(/*'name' => $name*/));
    }
    
    public function footerAction()
    {
        
        return $this->render('OmkomSiteBundle:Widget:footer.html.twig', array(/*'name' => $name*/));
    }
    
    public function breadcrumbAction($aInfos = array('accueil' => '/'))
    {
        
        return $this->render('OmkomSiteBundle:Widget:bloc_breadcrumb.html.twig', $aInfos);
    }
    
    public function infoAction($aInfos = array('type' => 'brand'))
    {
        
        return $this->render('OmkomSiteBundle:Widget:bloc_info.html.twig', $aInfos);
    }
    
    public function robotsAction($aInfos = array('type' => 'brand'))
    {
        
        return $this->render('OmkomSiteBundle:Widget:robots.txt.twig', $aInfos);
    }

}
