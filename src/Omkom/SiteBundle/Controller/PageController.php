<?php

namespace Omkom\SiteBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Appication\Sonata\MediaBundle\Entity\Gallery as gallery;

class PageController extends Controller
{
    private function getRepository()
    {
        return $this->getDoctrine()->getRepository('OmkomSiteBundle:Page');
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
        return $this->render('OmkomSiteBundle:Page:index.html.twig', $return);
    }
    
    public function viewAction($slug, $id)
    {
        $page = $this->getDoctrine()
            ->getRepository('OmkomSiteBundle:Page')
            ->find($id);

        if (!$page) {
            throw $this->createNotFoundException('Oups ! Cette page n\'existe pas...');
        }
        
        $page->setViewcount($page->getViewcount()+1);
        $em = $this->getDoctrine()->getManager();
        $em->persist($page);
        $em->flush();
        
        $breadcrumb = array($page);
        if($page->getSlug() != $slug OR $page->getId() != $id )
        {
            return $this->redirect($this->generateUrl('omkom_site_page_show', 
                array(
                    'id' => $page->getId(),
                    'slug' => $page->getSlug(),
                ), 301));
        }
        
        $return = array(
            'page' => $page,
            'breadcrumb' => $breadcrumb,
        );
        
        if($page->getGallery())
        {
            $return['gallery'] = $page->getGallery();
        }

        return $this->render('OmkomSiteBundle:Page:view.html.twig', $return);
    }
    
    public function listAction($aInfos = array('type' => 'large'))
    {
        $return = array(
            'pages' => $this->findAll()
        );
        return $this->render('OmkomSiteBundle:Page:list.html.twig', $return);
    }
}
