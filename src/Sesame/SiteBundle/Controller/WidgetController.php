<?php

namespace Sesame\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class WidgetController extends Controller
{
    public function headerAction(/*$name*/)
    {
        return $this->render('SesameSiteBundle:Widget:header.html.twig', array(/*'name' => $name*/));
    }
    
    public function footerAction()
    {
        
        return $this->render('SesameSiteBundle:Widget:footer.html.twig', array(/*'name' => $name*/));
    }
    
    public function breadcrumbAction($aInfos = array('accueil' => '/'))
    {
        
        return $this->render('SesameSiteBundle:Widget:bloc_breadcrumb.html.twig', $aInfos);
    }
    
    public function infoAction($aInfos = array('type' => 'brand'))
    {
        
        return $this->render('SesameSiteBundle:Widget:bloc_info.html.twig', $aInfos);
    }
    
    public function robotsAction($aInfos = array('type' => 'brand'))
    {
        
        return $this->render('SesameSiteBundle:Widget:robots.txt.twig', $aInfos);
    }

}
