<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PortfolioBundle\Entity\Workshop;
use PortfolioBundle\Form\WorkshopType;

/**
 * @Route("/workshop")
 */
class WorkshopController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $workshops = $em->getRepository('PortfolioBundle:Workshop')->findBy([], ['name' => 'ASC']);
        return ['workshops' => $workshops];
    }

    /**
     * @Route("/add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = new Workshop();
        $form = $this->createForm(WorkshopType::class, $workshop);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
          $em->persist($workshop);
          $em->flush();
          return $this->redirect($this->generateUrl('portfolio_workshop_show', ['slug' => $workshop->getSlug()]));
        }
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = $em->getRepository('PortfolioBundle:Workshop')->findOneBySlug($slug);
        return [ 'workshop' => $workshop ];
    }

    /**
     * @Route("/{slug}/edit")
     * @Template()
     */
    public function editAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = $em->getRepository('PortfolioBundle:Workshop')->findOneBySlug($slug);
        $form = $this->createForm(WorkshopType::class, $workshop);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
          $em->flush();
          return $this->redirect($this->generateUrl('portfolio_workshop_show', ['slug' => $workshop->getSlug()]));
        }
        return ['form' => $form->createView(), 'workshop' => $workshop];
    }

    /**
     * @Route("/{slug}/delete")
     * @Template()
     */
    public function deleteAction($slug)
    {
        return [];
    }
}
