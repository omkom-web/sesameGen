<?php

namespace Sesame\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    private function getRepository()
    {
        return $this->getDoctrine()->getRepository('SesameSiteBundle:Page');
    }
    
    private function findAll()
    {
        return $this->getRepository()->findAll();
    }
    
    public function indexAction()
    {
        $return = array(
            'pages' => $this->findAll()
        );
        return $this->render('SesameSiteBundle:Page:index.html.twig', $return);
    }
    
    public function viewAction($slug, $id)
    {
        $page = $this->getDoctrine()
            ->getRepository('SesameSiteBundle:Page')
            ->find($id);

        if (!$page) {
            throw $this->createNotFoundException('Oups ! Cette page n\'existe pas...');
        }
        if($page->getSlug() != $slug OR $page->getId() != $id )
        {
            return $this->redirect($this->generateUrl('sesame_site_page_show', 
                array(
                    'id' => $page->getId(),
                    'slug' => $page->getSlug(),
                ), 301));
        }
        $return = array(
            'page' => $page
        );
        return $this->render('SesameSiteBundle:Page:view.html.twig', $return);
    }
    
    public function listAction($aInfos = array('type' => 'large'))
    {
        $return = array(
            'pages' => $this->findAll()
        );
        return $this->render('SesameSiteBundle:Page:list.html.twig', $return);
    }
}
