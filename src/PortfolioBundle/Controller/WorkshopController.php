<?php

namespace PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use PortfolioBundle\Entity\Workshop;
use PortfolioBundle\Form\WorkshopType;

/**
 * @Route("/workshop")
 * @Security("has_role('ROLE_USER')")
 */
class WorkshopController extends Controller
{
    /**
     * @Route("/")
     * @Method({"GET"})
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
     * @Method({"GET", "POST"})
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
     * @Method({"GET"})
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
     * @Method({"GET", "POST"})
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
     * @Route("/{slug}/delete", requirements={"method" = "GET"})
     * @Method({"GET"})
     * @Template()
     */
    public function deleteAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = $em->getRepository('PortfolioBundle:Workshop')->findOneBySlug($slug);
        $form = $this->createFormBuilder()
          ->setAction($this->generateUrl('portfolio_workshop_delete', ['slug' => $workshop->getSlug()]))
          ->setMethod('DELETE')
          ->add('submit', SubmitType::class, ['label' => 'Supprimer'])
          ->getForm();

        return ['workshop' => $workshop, 'form' => $form->createView()];
    }
    
    /**
     * @Route("/{slug}/delete", requirements={"method" = "DELETE"})
     * @Method({"DELETE"})
     */
    public function confirmDeleteAction($slug, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $workshop = $em->getRepository('PortfolioBundle:Workshop')->findOneBySlug($slug);
        $em->remove($workshop);
        $em->flush();
        return $this->redirect($this->generateUrl('portfolio_workshop_list'));
    }
}
